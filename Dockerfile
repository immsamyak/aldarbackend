###############################################################################
# ALDAR API — Production Dockerfile
# Multi-stage: Composer build → PHP 8.3-FPM + Nginx (single container)
# Works with Coolify, Docker Compose, or any container platform.
###############################################################################

# ── Stage 1: Install Composer dependencies ──────────────────────────────────
FROM composer:2 AS vendor

WORKDIR /app
COPY composer.json composer.lock ./
RUN composer install \
    --no-dev \
    --no-interaction \
    --prefer-dist \
    --optimize-autoloader \
    --no-scripts

# ── Stage 2: Production image ───────────────────────────────────────────────
FROM php:8.4-fpm-bookworm

# Install system dependencies
RUN apt-get update && apt-get install -y --no-install-recommends \
    nginx \
    supervisor \
    curl \
    zip \
    unzip \
    libpng-dev \
    libjpeg-dev \
    libwebp-dev \
    libfreetype6-dev \
    libonig-dev \
    libxml2-dev \
    libzip-dev \
    libicu-dev \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# Install PHP extensions (use -j1 to avoid OOM on small instances)
RUN docker-php-ext-configure gd --with-freetype --with-jpeg --with-webp \
    && docker-php-ext-install -j1 pdo_mysql mbstring xml zip gd opcache pcntl bcmath

# intl is compiled separately — it's the heaviest extension (C++/ICU)
RUN docker-php-ext-install -j1 intl

# Redis via PECL
RUN pecl install redis && docker-php-ext-enable redis

# PHP production config
RUN mv "$PHP_INI_DIR/php.ini-production" "$PHP_INI_DIR/php.ini"
COPY docker/php.ini /usr/local/etc/php/conf.d/99-app.ini
COPY docker/www.conf /usr/local/etc/php-fpm.d/www.conf

# Nginx config
COPY docker/nginx.conf /etc/nginx/sites-available/default

# Supervisor config (manages nginx + php-fpm + queue worker)
COPY docker/supervisord.conf /etc/supervisor/conf.d/app.conf

# App setup
WORKDIR /var/www/html

# Copy application code
COPY --chown=www-data:www-data . .

# Copy vendor from build stage
COPY --from=vendor --chown=www-data:www-data /app/vendor ./vendor

# Create required directories
RUN mkdir -p storage/logs \
    storage/app/public \
    storage/framework/cache/data \
    storage/framework/sessions \
    storage/framework/views \
    bootstrap/cache \
    && chown -R www-data:www-data storage bootstrap/cache \
    && chmod -R 775 storage bootstrap/cache

# Storage link
RUN php artisan storage:link 2>/dev/null || true

# Entrypoint (runs migrations, caches, then starts supervisor)
COPY docker/entrypoint.sh /usr/local/bin/entrypoint.sh
RUN chmod +x /usr/local/bin/entrypoint.sh

# Expose port
EXPOSE 80

# Health check
HEALTHCHECK --interval=30s --timeout=5s --retries=3 \
    CMD curl -f http://localhost/api/v1/health 2>/dev/null || curl -f http://localhost/ || exit 1

# Start via entrypoint
CMD ["/usr/local/bin/entrypoint.sh"]
