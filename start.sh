#!/bin/bash

echo "=== MSA ALKES STARTUP SCRIPT ==="
echo "Checking PostgreSQL connection..."
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

echo "Checking PHP extensions..."
php -m | grep -i pdo
php -m | grep -i pgsql
echo "Available PDO drivers:"
php -r "print_r(PDO::getAvailableDrivers());"

echo "Checking if Laravel can boot..."
php artisan --version || echo "Laravel boot failed!"

echo "Creating/updating .env file..."
# Always recreate .env to ensure correct database settings
echo "APP_NAME=MSA_Alkes" > .env
echo "APP_ENV=production" >> .env
echo "APP_KEY=${APP_KEY:-base64:+WyZZFMnPx4ZHTdpMvJYvkfcoe+g9YmbWSqFPTu5gkw=}" >> .env
echo "APP_DEBUG=true" >> .env
if [ -n "$RAILWAY_PUBLIC_DOMAIN" ]; then
  echo "APP_URL=https://$RAILWAY_PUBLIC_DOMAIN" >> .env
else
  echo "APP_URL=http://localhost:$PORT" >> .env
fi
echo "LOG_CHANNEL=single" >> .env
echo "LOG_LEVEL=debug" >> .env
echo "" >> .env

# Force PostgreSQL connection - use Railway default
export DB_CONNECTION=pgsql
echo "DB_CONNECTION=pgsql" >> .env

# Parse DATABASE_URL if it exists and use PostgreSQL
if [ -n "$DATABASE_URL" ]; then
    echo "DATABASE_URL=$DATABASE_URL" >> .env
    echo "Parsing DATABASE_URL: $DATABASE_URL"
    
    # Extract PostgreSQL connection details from DATABASE_URL
    # Format: postgresql://user:password@host:port/database or postgres://user:password@host:port/database
    if [[ $DATABASE_URL == postgres://* ]] || [[ $DATABASE_URL == postgresql://* ]]; then
        # Remove postgres:// or postgresql:// prefix
        if [[ $DATABASE_URL == postgres://* ]]; then
            DB_FULL="${DATABASE_URL#postgres://}"
        else
            DB_FULL="${DATABASE_URL#postgresql://}"
        fi
        
        # Split user:password and host:port/database
        DB_USER_PASS="${DB_FULL%%@*}"
        DB_HOST_PORT_DB="${DB_FULL#*@}"
        
        # Extract host:port and database
        DB_HOST_PORT="${DB_HOST_PORT_DB%/*}"
        DB_NAME="${DB_HOST_PORT_DB##*/}"
        
        # Extract host and port
        DB_HOST_EXTRACTED="${DB_HOST_PORT%:*}"
        DB_PORT_EXTRACTED="${DB_HOST_PORT#*:}"
        
        # Extract username and password
        DB_USERNAME_EXTRACTED="${DB_USER_PASS%:*}"
        DB_PASSWORD_EXTRACTED="${DB_USER_PASS#*:}"
        
        # Set environment variables
        export DB_HOST="$DB_HOST_EXTRACTED"
        export DB_PORT="$DB_PORT_EXTRACTED"
        export DB_DATABASE="$DB_NAME"
        export DB_USERNAME="$DB_USERNAME_EXTRACTED"
        export DB_PASSWORD="$DB_PASSWORD_EXTRACTED"
        
        echo "DB_HOST=$DB_HOST" >> .env
        echo "DB_PORT=$DB_PORT" >> .env
        echo "DB_DATABASE=$DB_DATABASE" >> .env
        echo "DB_USERNAME=$DB_USERNAME" >> .env
        echo "DB_PASSWORD=$DB_PASSWORD" >> .env
        
        echo "Extracted DB config:"
        echo "  Host: $DB_HOST"
        echo "  Port: $DB_PORT"
        echo "  Database: $DB_DATABASE"
        echo "  Username: $DB_USERNAME"
    else
        echo "DATABASE_URL not recognized as PostgreSQL; falling back to environment variables"
        echo "DB_HOST=${DB_HOST:-localhost}" >> .env
        echo "DB_PORT=${DB_PORT:-5432}" >> .env
        echo "DB_DATABASE=${DB_DATABASE:-railway}" >> .env
        echo "DB_USERNAME=${DB_USERNAME:-postgres}" >> .env
        echo "DB_PASSWORD=${DB_PASSWORD:-}" >> .env
    fi
else
    echo "No DATABASE_URL found, using environment variables"
    echo "DB_HOST=${DB_HOST:-localhost}" >> .env
    echo "DB_PORT=${DB_PORT:-5432}" >> .env
    echo "DB_DATABASE=${DB_DATABASE:-railway}" >> .env
    echo "DB_USERNAME=${DB_USERNAME:-postgres}" >> .env
    echo "DB_PASSWORD=${DB_PASSWORD:-}" >> .env
fi

echo "" >> .env
echo "SESSION_DRIVER=file" >> .env
echo "SESSION_LIFETIME=120" >> .env

echo "Setting up database..."
# Skip SQLite setup since we're forcing MySQL

echo "Debug: Environment variables before Laravel commands"
echo "DB_CONNECTION: $DB_CONNECTION"
echo "DB_HOST: $DB_HOST"
echo "DB_DATABASE: $DB_DATABASE"

echo "Clearing Laravel config cache..."
php artisan config:clear || echo "Config clear failed, continuing..."
php artisan cache:clear || echo "Cache clear failed, continuing..."

echo "Setting runtime environment for Laravel..."
export DB_CONNECTION=pgsql

# Clear ALL Laravel caches that might have wrong database settings
echo "Clearing ALL Laravel caches..."
php artisan config:clear || echo "Config clear failed, continuing..."
php artisan cache:clear || echo "Cache clear failed, continuing..."
php artisan route:clear || echo "Route clear failed, continuing..."
php artisan view:clear || echo "View clear failed, continuing..."
php artisan event:clear || echo "Event clear failed, continuing..."

# Force PostgreSQL in environment BEFORE caching
echo "Forcing PostgreSQL environment variables..."
export DB_CONNECTION=pgsql
export DATABASE_DEFAULT=pgsql

# DO NOT cache config - let it read from .env dynamically
echo "Skipping config cache to force dynamic .env reading..."
# php artisan config:cache || echo "Config cache failed, continuing..."

echo "Testing database connection..."
echo "First checking if PostgreSQL driver is available..."
php -r "
if (!extension_loaded('pdo_pgsql')) {
    echo 'ERROR: pdo_pgsql extension not loaded!' . PHP_EOL;
    echo 'Available PDO drivers: ' . implode(', ', PDO::getAvailableDrivers()) . PHP_EOL;
    exit(1);
} else {
    echo 'SUCCESS: pdo_pgsql extension is loaded' . PHP_EOL;
}
"
timeout 30 php artisan tinker --execute="echo 'Testing DB connection...'; try { \$pdo = \DB::connection()->getPdo(); echo 'Database connected successfully to: ' . \$pdo->getAttribute(PDO::ATTR_CONNECTION_STATUS); } catch(Exception \$e) { echo 'Database connection failed: ' . \$e->getMessage(); exit(1); }" || echo "Connection test failed"

echo "Checking database accessibility..."
timeout 30 php artisan tinker --execute="try { \DB::select('SELECT 1'); echo 'Database accessible'; } catch(Exception \$e) { echo 'Database NOT accessible: ' . \$e->getMessage(); exit(1); }" || echo "Database check failed"

echo "Running database migrations with timeout..."
timeout 120 php artisan migrate --force --verbose || {
    echo "Migration failed, retrying once..."
    sleep 5
    timeout 120 php artisan migrate --force --verbose || echo "Migration failed completely"
}

echo "Running database seeders..."
php artisan db:seed --force --verbose || echo "Seeding failed, continuing..."

echo "Skipping full .env dump to avoid leaking secrets. Showing key DB settings:"
echo "APP_URL=$(grep ^APP_URL= .env | cut -d'=' -f2-)"
echo "DB_CONNECTION=$DB_CONNECTION"
echo "DB_HOST=$DB_HOST"
echo "DB_PORT=$DB_PORT"
echo "DB_DATABASE=$DB_DATABASE"

echo "Starting server on 0.0.0.0:$PORT..."
php artisan serve --host=0.0.0.0 --port=$PORT --verbose
