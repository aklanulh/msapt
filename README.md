# 🏢 MSAPT - PT. Mitrajaya Selaras Abadi

## 📋 Procurement & Inventory Management System

**MSAPT** adalah sistem manajemen inventori dan pengadaan untuk PT. Mitrajaya Selaras Abadi yang bergerak di bidang peralatan medis dan laboratorium.

### 🚀 **Live Website**
- **URL:** https://msapt.co.id
- **Repository:** https://github.com/aklanulh/msapt

### ✨ **Fitur Utama**

- 📊 **Dashboard Real-time** - KPI dan analytics inventori
- 📦 **Manajemen Produk** - Katalog peralatan medis & laboratorium
- 📈 **Stock In/Out** - Tracking pergerakan stok otomatis
- 🏥 **Supplier & Customer** - Manajemen partner bisnis
- 📋 **Stock Opname** - Reconciliation fisik vs sistem
- 📊 **Reporting** - Laporan lengkap dengan export Excel
- 🔐 **Security** - Authentication & data protection
- 📱 **Responsive** - Mobile-friendly interface

### 🛠️ **Teknologi**

- **Framework:** Laravel 12 + PHP 8.2
- **Database:** MySQL
- **Frontend:** Tailwind CSS + Alpine.js
- **Charts:** Chart.js
- **Deployment:** Hostinger dengan Git auto-deploy

### 🚀 **Quick Start**

1. **Clone Repository:**
   ```bash
   git clone https://github.com/aklanulh/msapt.git
   cd msapt
   ```

2. **Install Dependencies:**
   ```bash
   composer install
   npm install
   ```

3. **Setup Environment:**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

4. **Setup Database:**
   ```bash
   php artisan migrate --seed
   ```

5. **Run Development Server:**
   ```bash
   php artisan serve
   ```

### 📚 **Dokumentasi Deployment**

- 📖 [Panduan Lengkap Deployment](README-DEPLOYMENT.md)
- ⚡ [Quick Start Hostinger](HOSTINGER-QUICKSTART.md)
- 📋 [Step by Step Guide](STEP-BY-STEP-HOSTINGER.md)

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the [Laravel Partners program](https://partners.laravel.com).

### Premium Partners

- **[Vehikl](https://vehikl.com)**
- **[Tighten Co.](https://tighten.co)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel)**
- **[DevSquad](https://devsquad.com/hire-laravel-developers)**
- **[Redberry](https://redberry.international/laravel-development)**
- **[Active Logic](https://activelogic.com)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
