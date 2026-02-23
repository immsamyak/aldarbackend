#!/usr/bin/env bash
###############################################################################
# ALDAR GROUP — Deployment Script
# Called by GitHub Actions or manually:
#   cd /var/www/aldar-api && bash deploy/deploy.sh
###############################################################################
set -euo pipefail

APP_DIR="${1:-$(pwd)}"
cd "$APP_DIR"

echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━"
echo "  ALDAR API — Deploying..."
echo "  Directory: ${APP_DIR}"
echo "  Time: $(date)"
echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━"

# ─── 1. Enable maintenance mode ─────────────────────────────────────────────
echo "[1/10] Entering maintenance mode..."
php artisan down --retry=60 --refresh=15 2>/dev/null || true

# ─── 2. Pull latest code ────────────────────────────────────────────────────
echo "[2/10] Pulling latest code..."
git fetch --all
git reset --hard origin/main

# ─── 3. Install Composer dependencies ───────────────────────────────────────
echo "[3/10] Installing Composer dependencies..."
composer install --no-dev --no-interaction --prefer-dist --optimize-autoloader

# ─── 4. Run migrations ──────────────────────────────────────────────────────
echo "[4/10] Running database migrations..."
php artisan migrate --force

# ─── 5. Clear & rebuild caches ──────────────────────────────────────────────
echo "[5/10] Clearing old caches..."
php artisan config:clear
php artisan route:clear
php artisan view:clear
php artisan event:clear

echo "[6/10] Building production caches..."
php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan event:cache

# ─── 7. Storage link ────────────────────────────────────────────────────────
echo "[7/10] Ensuring storage link..."
php artisan storage:link 2>/dev/null || true

# ─── 8. Set permissions ─────────────────────────────────────────────────────
echo "[8/10] Setting file permissions..."
chown -R deployer:www-data storage bootstrap/cache
chmod -R 775 storage bootstrap/cache

# ─── 9. Restart services ────────────────────────────────────────────────────
echo "[9/10] Restarting services..."
sudo service php8.3-fpm restart
sudo service nginx reload
sudo supervisorctl restart aldar-worker:*

# ─── 10. Disable maintenance mode ───────────────────────────────────────────
echo "[10/10] Going live..."
php artisan up

echo ""
echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━"
echo "  ✅ Deployment complete!"
echo "  Time: $(date)"
echo ""
echo "  First time? Import seeded data:"
echo "    bash deploy/restore-db.sh"
echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━"
