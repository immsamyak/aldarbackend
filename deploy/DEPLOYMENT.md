# ALDAR API — AWS EC2 Deployment Guide

## Architecture

```
GitHub (push to main)
    ↓
GitHub Actions (test → deploy)
    ↓ SSH
EC2 Ubuntu 24.04
    ├── Nginx (reverse proxy, port 80/443)
    ├── PHP 8.3-FPM (Laravel app)
    ├── MySQL 8 (database)
    ├── Supervisor (queue workers)
    └── Certbot (SSL)
```

## Files

| File | Purpose |
|------|---------|
| `deploy/server-setup.sh` | One-time EC2 provisioning (PHP, Nginx, MySQL, firewall) |
| `deploy/nginx.conf` | Nginx virtual host configuration |
| `deploy/deploy.sh` | Zero-downtime deploy script (pulled by CI/CD) |
| `deploy/.env.production` | Production environment template |
| `.github/workflows/deploy.yml` | GitHub Actions CI/CD pipeline |

---

## Step-by-Step Setup

### 1. Launch EC2 Instance

- **AMI**: Ubuntu 24.04 LTS
- **Instance type**: t3.small (minimum) or t3.medium (recommended)
- **Storage**: 20 GB gp3
- **Security Group**:
  - SSH (22) — your IP only
  - HTTP (80) — 0.0.0.0/0
  - HTTPS (443) — 0.0.0.0/0

### 2. SSH into the server

```bash
ssh -i your-key.pem ubuntu@YOUR_EC2_IP
```

### 3. Run the server setup script

```bash
# Upload the deploy folder, or clone the repo first
cd /tmp
git clone https://github.com/immsamyak/aldarbackend.git
cd aldarbackend/deploy

# Run setup (pass your domain as argument)
sudo chmod +x server-setup.sh
sudo ./server-setup.sh api.aldargroup.com
```

This installs: PHP 8.3, Nginx, MySQL 8, Composer, Certbot, Supervisor, UFW firewall.

### 4. Setup the deployer SSH key (for GitHub Actions)

```bash
# On the server, switch to deployer user
sudo su - deployer

# Generate SSH key pair
ssh-keygen -t ed25519 -C "github-actions" -f ~/.ssh/github_deploy -N ""

# Add public key to authorized_keys
cat ~/.ssh/github_deploy.pub >> ~/.ssh/authorized_keys
chmod 600 ~/.ssh/authorized_keys

# Display private key (copy this for GitHub Secrets)
cat ~/.ssh/github_deploy
```

### 5. Clone the repository

```bash
# As deployer user
sudo su - deployer
git clone https://github.com/immsamyak/aldarbackend.git /var/www/aldar-api
cd /var/www/aldar-api
```

### 6. Configure environment

```bash
cp deploy/.env.production .env
nano .env   # Fill in all CHANGE_ME values

# Generate keys
php artisan key:generate
php artisan jwt:secret
```

### 7. First deployment

```bash
cd /var/www/aldar-api
bash deploy/deploy.sh
```

### 8. Seed the database (first time only)

```bash
php artisan db:seed --class=AldarSeeder
```

### 9. Setup SSL certificate

```bash
sudo certbot --nginx -d api.aldargroup.com
# Follow the prompts, certbot auto-renews
```

### 10. Point your domain

Add an **A record** in your DNS:
```
api.aldargroup.com  →  YOUR_EC2_ELASTIC_IP
```

---

## GitHub Actions CI/CD Setup

### Add Repository Secrets

Go to **GitHub → Repository → Settings → Secrets and variables → Actions** and add:

| Secret | Value |
|--------|-------|
| `EC2_HOST` | Your EC2 public IP or Elastic IP |
| `EC2_USER` | `deployer` |
| `EC2_SSH_KEY` | Contents of `~/.ssh/github_deploy` (private key) |
| `EC2_APP_DIR` | `/var/www/aldar-api` |

### How it works

1. **Push to `main`** → triggers the workflow
2. **Test job**: Spins up MySQL, installs dependencies, runs migrations + tests
3. **Deploy job** (only if tests pass): SSHs into EC2 and runs `deploy/deploy.sh`
4. Deploy script: pulls code, installs deps, migrates DB, clears caches, restarts services

### Manual trigger

You can also trigger deployment manually from GitHub → Actions → "Deploy ALDAR API" → "Run workflow".

---

## Common Commands (on the server)

```bash
# Switch to deployer
sudo su - deployer
cd /var/www/aldar-api

# Check app status
php artisan about

# View logs
tail -f storage/logs/laravel.log

# Queue worker status
sudo supervisorctl status aldar-worker:*

# Restart queue workers
sudo supervisorctl restart aldar-worker:*

# Clear all caches
php artisan optimize:clear

# Run migrations
php artisan migrate --force

# Maintenance mode
php artisan down
php artisan up

# Manual deploy
bash deploy/deploy.sh

# Check Nginx config
sudo nginx -t
sudo service nginx reload

# Check PHP-FPM
sudo service php8.3-fpm status

# SSL certificate renewal test
sudo certbot renew --dry-run

# Check disk space
df -h

# Check memory
free -m
```

---

## Rollback

If a deployment breaks something:

```bash
cd /var/www/aldar-api

# See recent commits
git log --oneline -10

# Rollback to specific commit
git reset --hard <commit-hash>
composer install --no-dev --optimize-autoloader
php artisan migrate --force
php artisan optimize
sudo service php8.3-fpm restart
sudo service nginx reload
php artisan up
```

---

## Security Checklist

- [x] UFW firewall enabled (SSH + HTTP + HTTPS only)
- [x] fail2ban installed
- [x] PHP `cgi.fix_pathinfo=0`
- [x] `.env` not in git
- [x] `APP_DEBUG=false` in production
- [x] Dotfiles blocked by Nginx
- [x] vendor/node_modules blocked by Nginx
- [x] Separate MySQL user (not root)
- [ ] SSH key-only auth (disable password login)
- [ ] Regular backups (add cron for `mysqldump`)

---

## Database Backup (recommended cron)

```bash
# Add to deployer's crontab: crontab -e
0 3 * * * mysqldump -u aldar_user -p'AldarDB@2026!' aldar | gzip > /var/www/aldar-api/storage/backups/aldar-$(date +\%Y\%m\%d).sql.gz
```

Create the backup directory:
```bash
mkdir -p /var/www/aldar-api/storage/backups
```
