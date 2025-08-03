#!/bin/bash

# Ensure storage directories exist
mkdir -p storage/logs storage/framework/cache storage/framework/sessions storage/framework/views

# Set permissions
chmod -R 775 storage
chmod -R 775 bootstrap/cache

# Generate app key if not exists (but only if we have write permissions)
if [ -z "$APP_KEY" ] && [ -w ".env" ]; then
    php artisan key:generate --force
fi

# Start the server directly without caching (to avoid errors)
php artisan serve --host=0.0.0.0 --port=$PORT
