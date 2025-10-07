# MSAPT - Medical Supplies & Alat Kesehatan

PT. Mitrajaya Selaras Abadi - Laravel-based web application for managing medical supplies and healthcare equipment.

## Features

- User authentication and authorization
- Medical supplies inventory management
- Healthcare equipment tracking
- Admin dashboard
- Responsive design

## Requirements

- PHP 8.2+
- MySQL 8.0+
- Composer
- Laravel 12.x

## Local Development

1. Clone repository
2. Install dependencies: `composer install`
3. Copy `.env.example` to `.env`
4. Configure MySQL database in `.env`
5. Generate app key: `php artisan key:generate`
6. Run migrations: `php artisan migrate`
7. Seed database: `php artisan db:seed`
8. Start server: `php artisan serve`

## Hostinger Deployment

### Standard Laravel Deployment
1. Upload files via FTP or git
2. Copy `.env.hostinger` to `.env`
3. Run standard Laravel commands:
   ```bash
   composer install --no-dev --optimize-autoloader
   php artisan key:generate --force
   php artisan migrate --force
   php artisan config:cache
   php artisan route:cache
   php artisan view:cache
   ```

## Database Configuration

This project is configured to use **MySQL only**. All SQLite references have been removed for Hostinger compatibility.

- Local: MySQL via XAMPP/Laragon
- Production: MySQL via Hostinger

## Environment Files

- `.env.example` - Template for local development
- `.env.hostinger` - Production configuration for Hostinger

## License

Private project - All rights reserved.
