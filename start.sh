#!/bin/bash

# Set permissions
chmod -R 775 storage
chmod -R 775 bootstrap/cache

# Clear and cache config
php artisan config:clear
php artisan cache:clear
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Start the server
php artisan serve --host=0.0.0.0 --port=$PORT
