#!/bin/bash
set -e

echo "Starting Laravel application..."

# Set default PORT if not provided
PORT=${PORT:-8080}
echo "Using PORT: $PORT"

# Ensure storage directories exist
mkdir -p storage/logs storage/framework/cache storage/framework/sessions storage/framework/views bootstrap/cache

# Set permissions
chmod -R 775 storage bootstrap/cache

# Check if APP_KEY is set
if [ -z "$APP_KEY" ]; then
    echo "Warning: APP_KEY is not set. This may cause issues."
fi

# Clear any existing caches (safe to fail)
php artisan config:clear 2>/dev/null || true
php artisan cache:clear 2>/dev/null || true

echo "Starting PHP built-in server on 0.0.0.0:$PORT"

# Start the server
exec php artisan serve --host=0.0.0.0 --port=$PORT
