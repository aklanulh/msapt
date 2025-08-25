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
    echo "" >> .env
    
    # Database configuration - use PostgreSQL if DATABASE_URL is set, otherwise SQLite
    if [ -n "$DATABASE_URL" ]; then
        echo "DB_CONNECTION=pgsql" >> .env
        echo "DATABASE_URL=$DATABASE_URL" >> .env
        echo "DB_HOST=${DB_HOST:-localhost}" >> .env
        echo "DB_PORT=${DB_PORT:-5432}" >> .env
        echo "DB_DATABASE=${DB_DATABASE:-railway}" >> .env
        echo "DB_USERNAME=${DB_USERNAME:-postgres}" >> .env
        echo "DB_PASSWORD=${DB_PASSWORD:-}" >> .env
    else
        echo "DB_CONNECTION=sqlite" >> .env
        echo "DB_DATABASE=/var/www/database/database.sqlite" >> .env
    fi
    
    echo "" >> .env
    echo "SESSION_DRIVER=file" >> .env
    echo "SESSION_LIFETIME=120" >> .env
fi

echo "Setting up database..."
# Create SQLite database if using SQLite (fallback)
if [ "$DB_CONNECTION" = "sqlite" ] || [ -z "$DATABASE_URL" ]; then
    mkdir -p database
    touch database/database.sqlite
    chmod 664 database/database.sqlite
fi

echo "Running database migrations..."
php artisan migrate --force || echo "Migration failed, continuing..."

echo "Running database seeders..."
php artisan db:seed --force || echo "Seeding failed, continuing..."

echo "Final .env check:"
cat .env

echo "Starting server on 0.0.0.0:$PORT..."
php artisan serve --host=0.0.0.0 --port=$PORT --verbose
