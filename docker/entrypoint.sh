#!/bin/sh
set -e

# Fix permissions on volumes (volume mounts override build-time permissions)
chown -R www-data:www-data storage/ bootstrap/cache/
find storage/ bootstrap/cache/ -type d -exec chmod 775 {} \;
find storage/ bootstrap/cache/ -type f -exec chmod 664 {} \;

# OAuth keys need restricted permissions
if [ -f "storage/oauth-private.key" ]; then
    chmod 600 storage/oauth-private.key
fi
if [ -f "storage/oauth-public.key" ]; then
    chmod 600 storage/oauth-public.key
fi

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
