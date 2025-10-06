# 🚀 MSAPT - Hostinger Quick Start Guide

## Deployment Mudah & Aman Tanpa Drag-Drop

### 📋 Checklist Sebelum Deploy

- [ ] Akun Hostinger dengan Git deployment support
- [ ] Database MySQL sudah dibuat di Hostinger
- [ ] Domain sudah pointing ke Hostinger
- [ ] SSH access tersedia (untuk setup awal)

---

## 🎯 Langkah Deploy (5 Menit)

### 1. Setup di Hostinger Control Panel

1. **Buat Database MySQL:**
   ```
   Database Name: msapt_db
   Username: msapt_user
   Password: [strong password]
   ```

2. **Setup Git Deployment:**
   - Pergi ke **Advanced** → **Git**
   - Repository URL: `https://github.com/aklanulh/msapt.git`
   - Branch: `master`
   - Target: `public_html`

### 2. Konfigurasi Environment

1. **Edit file .env di server:**
   ```bash
   # Via File Manager atau SSH
   cp .env.hostinger .env
   nano .env
   ```

2. **Update konfigurasi database:**
   ```env
   DB_DATABASE=msapt_db
   DB_USERNAME=msapt_user
   DB_PASSWORD=your_strong_password
   APP_URL=https://msapt.co.id
   ```

### 3. Setup Awal (Sekali Saja)

```bash
# Via SSH atau Terminal di Hostinger
php setup-hostinger.php
```

**Script ini akan otomatis:**
- ✅ Generate APP_KEY
- ✅ Setup database & migrations
- ✅ Seed data awal
- ✅ Set permissions
- ✅ Optimize untuk production
- ✅ Backup database pertama

---

## 🔄 Update Website (Super Mudah!)

Setelah setup awal, untuk update website:

```bash
# Di komputer lokal
git add .
git commit -m "Update MSAPT - fitur baru"
git push origin master
```

**Hostinger otomatis:**
1. Pull perubahan dari GitHub
2. Backup database
3. Update dependencies
4. Clear caches
5. Run migrations
6. Optimize production

**⏱️ Total waktu: ~30 detik**

---

## 🛡️ Keamanan Data Terjamin

### Auto Backup System
- Database di-backup sebelum setiap update
- Backup disimpan di `storage/backups/`
- Maksimal 10 backup (auto cleanup)
- Manual backup: `php backup.php`

### Security Features
- HTTPS enforcement
- Security headers aktif
- Sensitive files protected
- SQL injection protection
- XSS protection

---

## 📊 Default Login

Setelah deployment berhasil:

```
URL: https://msapt.co.id
Email: admin@msa.com
Password: password
```

**⚠️ Ganti password setelah login pertama!**

---

## 🆘 Troubleshooting

### Error 500
```bash
# Cek logs
tail -f storage/logs/laravel.log

# Fix permissions
chmod -R 755 storage bootstrap/cache
```

### Database Error
```bash
# Test koneksi
php artisan migrate:status

# Reset database (hati-hati!)
php artisan migrate:fresh --seed
```

### Git Deployment Gagal
1. Cek repository URL benar
2. Pastikan branch `master` ada
3. Verifikasi target directory

---

## 📞 Support

Jika ada masalah:
1. Cek Hostinger error logs
2. Cek Laravel logs: `storage/logs/`
3. Cek PHP error logs di control panel

---

## 🎉 Selesai!

Website MSAPT siap digunakan dengan:
- ✅ Update mudah via Git push
- ✅ Data aman dengan auto backup
- ✅ Performance optimal
- ✅ Security terjamin

**Tidak perlu drag-drop file lagi! 🚫📁**
