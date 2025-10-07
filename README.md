# MSAPT

PT. Mitrajaya Selaras Abadi - Procurement & Inventory Management System

## MSAPT - Medical Surgical Alat Kesehatan

Laravel-based website for MSAPT (Medical Surgical Alat Kesehatan) company.

##  Deployment Workflow

### For Development:
1. Make changes in local development
2. `git add . && git commit -m "Your message"`
3. `git push origin master`

### For Server Update:
1. SSH to Hostinger server
2. `cd ~/domains/msapt.co.id/public_html`
3. `git pull origin master`
4. `php deploy-master.php`

### What deploy-master.php does:
-  Fix nested directory issues (Hostinger git push problem)
-  Fix environment file encoding (.env BOM, line endings)
-  Force MySQL database configuration
-  Generate/verify APP_KEY
-  Set proper file permissions
-  Clear all caches (config, route, view, application)
-  Test database connection
-  Run migrations
-  Optimize for production
-  Test website response

##  Website
- **Production:** https://msapt.co.id
- **Server:** Hostinger (id-dci-web1365.websitehostserver.net)
- **Database:** MySQL (u919556019_msapt_db)

## Requirements

- PHP 8.2+
- MySQL 5.7+
- Node.js & NPM

## Installation

1. Clone repository
2. Install dependencies: `composer install`
3. Setup environment: `cp .env.example .env`
4. Generate key: `php artisan key:generate`
5. Run migrations: `php artisan migrate --seed`
6. Start server: `php artisan serve`

## License

Proprietary - All rights reserved.
