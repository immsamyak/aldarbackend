# syntax=docker/dockerfile:1
###############################################################################
# ALDAR API — Production Dockerfile
# Multi-stage: Composer build → PHP 8.4-FPM + Nginx (single container)
# Optimized for layer caching — system deps & PHP extensions only rebuild
# when this Dockerfile changes, NOT when app code changes.
###############################################################################

# ── Stage 1: Base image with system deps + PHP extensions ───────────────────
# This layer is ~600 MB but only rebuilds when you change extensions/system pkgs.
FROM php:8.4-fpm-bookworm AS base

# Install system dependencies (cached unless this block changes)
RUN --mount=type=cache,target=/var/cache/apt,sharing=locked \
    --mount=type=cache,target=/var/lib/apt/lists,sharing=locked \
    apt-get update && apt-get install -y --no-install-recommends \
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
    libicu-dev

# Install PHP extensions (cached unless this block changes)
RUN docker-php-ext-configure gd --with-freetype --with-jpeg --with-webp \
    && docker-php-ext-install -j$(nproc) pdo_mysql mbstring xml zip gd opcache pcntl bcmath \
    && docker-php-ext-install -j$(nproc) intl

# Redis via PECL
RUN pecl install redis && docker-php-ext-enable redis

# PHP production config
RUN mv "$PHP_INI_DIR/php.ini-production" "$PHP_INI_DIR/php.ini"

# ── Stage 2: Install Composer dependencies ──────────────────────────────────
FROM composer:2 AS vendor

WORKDIR /app
COPY composer.json composer.lock ./
RUN --mount=type=cache,target=/root/.composer/cache \
    composer install \
    --no-dev \
    --no-interaction \
    --prefer-dist \
    --optimize-autoloader \
    --no-scripts

# ── Stage 3: Production image ───────────────────────────────────────────────
FROM base AS production

# Copy config files (only rebuilds if docker/ config changes)
COPY docker/php.ini /usr/local/etc/php/conf.d/99-app.ini
COPY docker/www.conf /usr/local/etc/php-fpm.d/www.conf
COPY docker/nginx.conf /etc/nginx/sites-available/default
COPY docker/supervisord.conf /etc/supervisor/conf.d/app.conf

# App setup
WORKDIR /var/www/html

# Copy application code (this layer changes on every deploy — that's fine)
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
