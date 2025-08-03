#!/bin/bash

echo "=== Laravel Startup Debug ==="
echo "Current directory: $(pwd)"
echo "PHP version: $(php -v | head -n 1)"
echo "PORT: ${PORT:-'not set'}"
echo "APP_KEY: ${APP_KEY:-'not set'}"
echo "APP_ENV: ${APP_ENV:-'not set'}"

# Set default PORT
PORT=${PORT:-8080}

echo "Creating storage directories..."
mkdir -p storage/logs storage/framework/cache storage/framework/sessions storage/framework/views bootstrap/cache

echo "Setting permissions..."
chmod -R 777 storage bootstrap/cache

echo "Checking Laravel files..."
ls -la artisan
ls -la composer.json

echo "Testing PHP syntax..."
php -l artisan

echo "Checking if Laravel can boot..."
php artisan --version || echo "Laravel boot failed!"

echo "Creating simple .env if not exists..."
if [ ! -f .env ]; then
    echo "APP_NAME=MSA_Alkes" > .env
    echo "APP_ENV=production" >> .env
    echo "APP_KEY=${APP_KEY:-base64:+WyZZFMnPx4ZHTdpMvJYvkfcoe+g9YmbWSqFPTu5gkw=}" >> .env
    echo "APP_DEBUG=true" >> .env
    echo "APP_URL=http://localhost:$PORT" >> .env
    echo "LOG_CHANNEL=single" >> .env
    echo "LOG_LEVEL=debug" >> .env
fi

echo "Final .env check:"
cat .env

echo "Starting server on 0.0.0.0:$PORT..."
php artisan serve --host=0.0.0.0 --port=$PORT --verbose
