#!/usr/bin/env bash
###############################################################################
# ALDAR GROUP — One-time EC2 Ubuntu 24.04 Server Provisioning
# Run this ONCE on a fresh EC2 instance:
#   chmod +x server-setup.sh && sudo ./server-setup.sh
###############################################################################
set -euo pipefail

# ─── Configuration ───────────────────────────────────────────────────────────
APP_USER="deployer"
APP_DIR="/var/www/aldar-api"
DOMAIN="${1:-api.aldargroup.com}"       # pass domain as arg or edit default
DB_NAME="aldar"
DB_USER="aldar_user"
DB_PASS="AldarDB@2026!"                # CHANGE THIS in production

echo "==========================================="
echo " ALDAR API — Server Setup (Ubuntu 24.04)"
echo "==========================================="
echo " Domain : ${DOMAIN}"
echo " App Dir: ${APP_DIR}"
echo " DB     : ${DB_NAME}"
echo "==========================================="

# ─── 1. System update ───────────────────────────────────────────────────────
echo "[1/9] Updating system packages..."
export DEBIAN_FRONTEND=noninteractive
apt-get update -y && apt-get upgrade -y

# ─── 2. Install essential packages ──────────────────────────────────────────
echo "[2/9] Installing essential packages..."
apt-get install -y \
    curl wget git unzip zip software-properties-common \
    ufw fail2ban supervisor acl htop

# ─── 3. Install PHP 8.3 + extensions ────────────────────────────────────────
echo "[3/9] Installing PHP 8.3..."
add-apt-repository -y ppa:ondrej/php
apt-get update -y
apt-get install -y \
    php8.3-fpm php8.3-cli php8.3-common \
    php8.3-mysql php8.3-pgsql php8.3-sqlite3 \
    php8.3-mbstring php8.3-xml php8.3-curl php8.3-zip \
    php8.3-gd php8.3-intl php8.3-bcmath php8.3-soap \
    php8.3-readline php8.3-tokenizer php8.3-fileinfo \
    php8.3-opcache php8.3-redis

# Configure PHP-FPM for production
PHP_INI="/etc/php/8.3/fpm/php.ini"
sed -i 's/upload_max_filesize = .*/upload_max_filesize = 20M/' "$PHP_INI"
sed -i 's/post_max_size = .*/post_max_size = 25M/' "$PHP_INI"
sed -i 's/memory_limit = .*/memory_limit = 256M/' "$PHP_INI"
sed -i 's/max_execution_time = .*/max_execution_time = 60/' "$PHP_INI"
sed -i 's/;cgi.fix_pathinfo=1/cgi.fix_pathinfo=0/' "$PHP_INI"

# OPcache settings for production
cat >> /etc/php/8.3/fpm/conf.d/99-opcache-production.ini <<'EOF'
opcache.enable=1
opcache.memory_consumption=128
opcache.interned_strings_buffer=8
opcache.max_accelerated_files=10000
opcache.revalidate_freq=0
opcache.validate_timestamps=0
EOF

systemctl restart php8.3-fpm

# ─── 4. Install Composer ────────────────────────────────────────────────────
echo "[4/9] Installing Composer..."
curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
composer --version

# ─── 5. Install Nginx ───────────────────────────────────────────────────────
echo "[5/9] Installing Nginx..."
apt-get install -y nginx
systemctl enable nginx

# ─── 6. Install MySQL 8 ─────────────────────────────────────────────────────
echo "[6/9] Installing MySQL 8..."
apt-get install -y mysql-server
systemctl enable mysql
systemctl start mysql

# Create database and user
mysql -u root <<EOSQL
CREATE DATABASE IF NOT EXISTS \`${DB_NAME}\` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
CREATE USER IF NOT EXISTS '${DB_USER}'@'localhost' IDENTIFIED BY '${DB_PASS}';
GRANT ALL PRIVILEGES ON \`${DB_NAME}\`.* TO '${DB_USER}'@'localhost';
FLUSH PRIVILEGES;
EOSQL
echo "  → Database '${DB_NAME}' and user '${DB_USER}' created."

# ─── 7. Create deploy user & app directory ──────────────────────────────────
echo "[7/9] Creating deployer user and app directory..."
if ! id "$APP_USER" &>/dev/null; then
    adduser --disabled-password --gecos "" "$APP_USER"
fi

# Add deployer to www-data group
usermod -aG www-data "$APP_USER"

# Create app directory
mkdir -p "$APP_DIR"
chown -R "${APP_USER}:www-data" "$APP_DIR"
chmod -R 775 "$APP_DIR"

# Allow deployer to restart services without password
cat > /etc/sudoers.d/deployer <<'EOF'
deployer ALL=(ALL) NOPASSWD: /usr/sbin/service nginx restart, /usr/sbin/service php8.3-fpm restart, /usr/bin/supervisorctl *, /usr/sbin/service nginx reload
EOF

# ─── 8. Install Certbot (SSL) ───────────────────────────────────────────────
echo "[8/9] Installing Certbot for SSL..."
apt-get install -y certbot python3-certbot-nginx

# ─── 9. Configure firewall ──────────────────────────────────────────────────
echo "[9/9] Configuring firewall..."
ufw default deny incoming
ufw default allow outgoing
ufw allow OpenSSH
ufw allow 'Nginx Full'
ufw --force enable
ufw status verbose

# ─── Copy Nginx config ──────────────────────────────────────────────────────
SCRIPT_DIR="$(cd "$(dirname "${BASH_SOURCE[0]}")" && pwd)"
if [ -f "${SCRIPT_DIR}/nginx.conf" ]; then
    cp "${SCRIPT_DIR}/nginx.conf" /etc/nginx/sites-available/aldar-api
    # Replace placeholder domain
    sed -i "s/api.aldargroup.com/${DOMAIN}/g" /etc/nginx/sites-available/aldar-api
    # Replace app dir
    sed -i "s|/var/www/aldar-api|${APP_DIR}|g" /etc/nginx/sites-available/aldar-api
    ln -sf /etc/nginx/sites-available/aldar-api /etc/nginx/sites-enabled/
    rm -f /etc/nginx/sites-enabled/default
    nginx -t && systemctl reload nginx
    echo "  → Nginx configured for ${DOMAIN}"
fi

# ─── Setup Supervisor for queue worker ───────────────────────────────────────
cat > /etc/supervisor/conf.d/aldar-worker.conf <<EOF
[program:aldar-worker]
process_name=%(program_name)s_%(process_num)02d
command=php ${APP_DIR}/artisan queue:work database --sleep=3 --tries=3 --max-time=3600
autostart=true
autorestart=true
stopasgroup=true
killasgroup=true
user=${APP_USER}
numprocs=2
redirect_stderr=true
stdout_logfile=${APP_DIR}/storage/logs/worker.log
stopwaitsecs=3600
EOF

supervisorctl reread
supervisorctl update

# ─── Print summary ──────────────────────────────────────────────────────────
echo ""
echo "==========================================="
echo " ✅ Server provisioning complete!"
echo "==========================================="
echo ""
echo " Next steps:"
echo "  1. Clone your repo:  sudo -u deployer git clone https://github.com/immsamyak/aldarbackend.git ${APP_DIR}"
echo "  2. Copy .env:        cp ${APP_DIR}/deploy/.env.production ${APP_DIR}/.env"
echo "  3. Edit .env:        nano ${APP_DIR}/.env   (update DB_PASS, APP_KEY, JWT_SECRET, DOMAIN)"
echo "  4. Run deploy:       cd ${APP_DIR} && sudo -u deployer bash deploy/deploy.sh"
echo "  5. SSL cert:         sudo certbot --nginx -d ${DOMAIN}"
echo ""
echo "  DB Name:     ${DB_NAME}"
echo "  DB User:     ${DB_USER}"
echo "  DB Password: ${DB_PASS}"
echo ""
echo "  GitHub Actions: Add these repo secrets:"
echo "    - EC2_HOST        (your EC2 public IP)"
echo "    - EC2_USER        (deployer)"
echo "    - EC2_SSH_KEY     (private key for deployer user)"
echo "    - EC2_APP_DIR     (${APP_DIR})"
echo "==========================================="
