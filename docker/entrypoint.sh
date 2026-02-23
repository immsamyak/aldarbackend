#!/bin/bash
###############################################################################
# ALDAR API — Docker Entrypoint
# Runs migrations, caches config, then starts supervisor
###############################################################################
set -e

echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━"
echo "  ALDAR API — Starting container..."
echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━"

# Wait for MySQL to be ready
echo "[1/5] Waiting for database..."
max_tries=30
count=0
until php artisan db:monitor --databases=mysql 2>/dev/null || [ $count -ge $max_tries ]; do
    sleep 2
    count=$((count + 1))
    echo "  Waiting for MySQL... ($count/$max_tries)"
done

# Run migrations
echo "[2/5] Running migrations..."
php artisan migrate --force

# Cache config for performance
echo "[3/5] Caching configuration..."
php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan event:cache

# Storage link
echo "[4/5] Ensuring storage link..."
php artisan storage:link 2>/dev/null || true

# Fix permissions
echo "[5/5] Setting permissions..."
chown -R www-data:www-data storage bootstrap/cache
chmod -R 775 storage bootstrap/cache

echo ""
echo "  ✅ Ready! Starting Nginx + PHP-FPM + Queue Worker"
echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━"

# Start supervisor (manages nginx, php-fpm, queue workers)
exec /usr/bin/supervisord -c /etc/supervisor/conf.d/app.conf
