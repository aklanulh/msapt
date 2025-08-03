#!/bin/bash

# Set permissions
chmod -R 775 storage
chmod -R 775 bootstrap/cache

# Clear caches first (safe to fail)
php artisan config:clear || true
php artisan cache:clear || true
php artisan view:clear || true
php artisan route:clear || true

# Generate app key if not exists
if [ -z "$APP_KEY" ]; then
    php artisan key:generate --force
fi

# Cache config for production (only if APP_ENV is production)
if [ "$APP_ENV" = "production" ]; then
    php artisan config:cache
    php artisan route:cache
    php artisan view:cache
fi

# Start the server
php artisan serve --host=0.0.0.0 --port=$PORT
