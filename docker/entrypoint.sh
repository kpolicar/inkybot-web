#!/bin/sh
set -e

# Create storage link if it doesn't exist
if [ ! -L "public/storage" ]; then
    php artisan storage:link
fi

# Sync public directory to shared volume for Caddy
if [ -d "/var/www/html/public-caddy" ]; then
    cp -a public/. /var/www/html/public-caddy/
fi

# Run Laravel optimization commands
if [ -f ".env" ]; then
    php artisan config:cache
    php artisan route:trans:cache
    php artisan view:cache
fi

# Run migrations if requested
if [ "${DOCKER_RUN_MIGRATIONS}" = "true" ]; then
    php artisan migrate --force
fi

exec "$@"
