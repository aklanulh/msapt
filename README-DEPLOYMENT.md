# MSAPT - Hostinger Deployment Guide

## 🚀 Panduan Deployment ke Hostinger dengan Git Push (Aman & Mudah Update)

### ✅ Prasyarat
1. Akun Hostinger dengan paket hosting yang mendukung Git deployment
2. Repository GitHub sudah terhubung: `https://github.com/aklanulh/msapt.git`
3. Database MySQL di Hostinger
4. SSH/Terminal access ke hosting (untuk setup awal)

### Langkah-langkah Deployment

#### 1. Setup di Hostinger Control Panel

1. **Login ke Hostinger Control Panel**
2. **Buat Database MySQL:**
   - Pergi ke "Databases" → "MySQL Databases"
   - Buat database baru (contoh: `msapt_db`)
   - Buat user database dan berikan akses penuh
   - Catat: database name, username, password

3. **Setup Git Deployment:**
   - Pergi ke "Advanced" → "Git"
   - Klik "Create Repository"
   - Masukkan URL repository GitHub: `https://github.com/aklanulh/msapt.git`
   - Branch: `master`
   - Target directory: `public_html` (atau sesuai domain)

#### 2. Konfigurasi Environment

1. **Upload file .env:**
   - Copy `.env.hostinger` ke `.env` di server
   - Update konfigurasi database:
     ```
     DB_DATABASE=msapt_db
     DB_USERNAME=msapt_user
     DB_PASSWORD=your_db_password
     ```
   - Update APP_URL dengan domain Anda:
     ```
     APP_URL=https://msapt.co.id
     ```

2. **Generate Application Key:**
   ```bash
   php artisan key:generate
   ```

#### 3. Setup Database

1. **Run Migrations:**
   ```bash
   php artisan migrate --force
   ```

2. **Seed Database:**
   ```bash
   php artisan db:seed --force
   ```

#### 4. Optimize untuk Production

```bash
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

#### 5. Set Permissions

```bash
chmod -R 755 storage
chmod -R 755 bootstrap/cache
```

### 🔄 Auto Deployment (Update Mudah & Aman)

Setelah setup awal, setiap kali Anda ingin update website:

```bash
# 1. Backup database dulu (opsional, tapi recommended)
php backup.php

# 2. Commit perubahan
git add .
git commit -m "Update MSAPT - [deskripsi perubahan]"
git push origin master
```

**Hostinger akan otomatis:**
1. ✅ Pull perubahan terbaru dari GitHub
2. ✅ Backup database sebelum update
3. ✅ Update dependencies (composer install)
4. ✅ Clear semua caches
5. ✅ Run database migrations
6. ✅ Optimize untuk production
7. ✅ Set permissions yang benar

**🛡️ Keamanan Data:**
- Database di-backup otomatis sebelum setiap update
- Backup disimpan di `storage/backups/`
- Hanya 10 backup terbaru yang disimpan (auto cleanup)
- Rollback mudah jika ada masalah

### Troubleshooting

#### Error 500
- Cek file `.env` sudah ada dan konfigurasi benar
- Pastikan APP_KEY sudah di-generate
- Cek permissions folder storage dan bootstrap/cache

#### Database Connection Error
- Verifikasi konfigurasi database di `.env`
- Pastikan database dan user sudah dibuat di Hostinger

#### Git Deployment Tidak Jalan
- Cek repository URL benar
- Pastikan branch `master` ada
- Cek target directory sesuai

### Default Login

Setelah deployment berhasil:
- **URL:** https://msapt.co.id
- **Email:** admin@msa.com
- **Password:** password

### File Penting

- `.env.hostinger` - Template environment untuk production
- `deploy.php` - Script auto deployment
- `.htaccess` - Konfigurasi Apache untuk redirect ke public
- `public/.htaccess` - Laravel rewrite rules

### Support

Jika ada masalah deployment, cek:
1. Hostinger error logs
2. Laravel logs di `storage/logs/`
3. PHP error logs di control panel
