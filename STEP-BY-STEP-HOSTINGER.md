# 🚀 MSAPT - Step by Step ke Hostinger

## 📋 Checklist Persiapan

### ✅ Yang Sudah Siap
- [x] Project MSAPT sudah bersih (file tidak terpakai sudah dihapus)
- [x] Deployment scripts sudah siap (deploy.php, setup-hostinger.php, backup.php)
- [x] Environment config untuk production (.env.hostinger)
- [x] Dokumentasi lengkap
- [x] Domain msapt.co.id sudah dibeli

### 🎯 Yang Perlu Dilakukan
- [ ] Setup domain di Hostinger
- [ ] Buat database MySQL
- [ ] Setup Git deployment
- [ ] Push code ke GitHub
- [ ] Konfigurasi environment
- [ ] Run setup awal
- [ ] Test website

---

## 🔥 LANGKAH 1: Setup Domain di Hostinger

### 1.1 Login ke Hostinger Control Panel
- Buka: https://hpanel.hostinger.com
- Login dengan akun Hostinger Anda

### 1.2 Tambah Domain msapt.co.id
1. **Pergi ke "Domains"**
2. **Klik "Add Domain"**
3. **Masukkan:** `msapt.co.id`
4. **Pilih hosting plan** yang sudah Anda beli
5. **Klik "Add Domain"**

### 1.3 Setup DNS (Jika Belum Otomatis)
Jika domain dibeli di tempat lain, update nameserver ke Hostinger:
```
ns1.dns-parking.com
ns2.dns-parking.com
```

---

## 🔥 LANGKAH 2: Buat Database MySQL

### 2.1 Pergi ke Database Section
1. **Di hPanel, klik "Databases"**
2. **Pilih "MySQL Databases"**

### 2.2 Buat Database Baru
```
Database Name: msapt_db
```

### 2.3 Buat User Database
```
Username: msapt_user
Password: [buat password yang kuat, catat baik-baik]
```

### 2.4 Berikan Akses Penuh
- Pilih database `msapt_db`
- Assign user `msapt_user`
- Berikan **ALL PRIVILEGES**

### 2.5 Catat Informasi Database
```
DB_HOST: localhost
DB_DATABASE: msapt_db
DB_USERNAME: msapt_user
DB_PASSWORD: [password yang Anda buat]
```

---

## 🔥 LANGKAH 3: Setup Git Deployment

### 3.1 Pergi ke Git Section
1. **Di hPanel, klik "Advanced"**
2. **Pilih "Git"**

### 3.2 Create Repository
1. **Klik "Create Repository"**
2. **Repository URL:** `https://github.com/aklanulh/msapt.git`
3. **Branch:** `master`
4. **Target Directory:** `public_html/msapt.co.id` (atau sesuai struktur domain)

### 3.3 Deploy Pertama Kali
- **Klik "Pull Changes"** untuk deploy pertama
- Tunggu sampai selesai (biasanya 1-2 menit)

---

## 🔥 LANGKAH 4: Push Code ke GitHub (Dari Komputer Lokal)

### 4.1 Commit Semua Perubahan
```bash
cd d:\laragon\www\msapt
git add .
git commit -m "MSAPT ready for Hostinger deployment"
git push origin master
```

### 4.2 Verifikasi di GitHub
- Buka: https://github.com/aklanulh/msapt
- Pastikan semua file sudah terupload
- Pastikan file cleanup sudah teraplikasi

---

## 🔥 LANGKAH 5: Konfigurasi Environment di Server

### 5.1 Akses File Manager
1. **Di hPanel, klik "File Manager"**
2. **Navigasi ke folder domain:** `public_html/msapt.co.id`

### 5.2 Copy Environment File
1. **Copy file `.env.hostinger` menjadi `.env`**
2. **Edit file `.env`**

### 5.3 Update Konfigurasi Database
Edit file `.env` dengan informasi database yang sudah dibuat:
```env
APP_NAME="MSAPT"
APP_ENV=production
APP_KEY=
APP_DEBUG=false
APP_URL=https://msapt.co.id

DB_CONNECTION=mysql
DB_HOST=localhost
DB_PORT=3306
DB_DATABASE=msapt_db
DB_USERNAME=msapt_user
DB_PASSWORD=password_yang_anda_buat_tadi
```

---

## 🔥 LANGKAH 6: Setup Awal (Terminal/SSH)

### 6.1 Akses Terminal
1. **Di hPanel, klik "Advanced"**
2. **Pilih "SSH Access"**
3. **Enable SSH** jika belum aktif
4. **Connect via SSH** atau gunakan terminal di hPanel

### 6.2 Navigasi ke Folder Project
```bash
cd public_html/msapt.co.id
```

### 6.3 Jalankan Setup Awal
```bash
php setup-hostinger.php
```

**Script ini akan otomatis:**
- ✅ Generate APP_KEY
- ✅ Setup database & migrations
- ✅ Seed data awal
- ✅ Set permissions
- ✅ Optimize production
- ✅ Backup database pertama

### 6.4 Tunggu Sampai Selesai
Proses biasanya 2-3 menit. Jika berhasil, akan muncul:
```
=== MSAPT Setup Completed Successfully! ===
🎉 Website siap digunakan!
```

---

## 🔥 LANGKAH 7: Test Website

### 7.1 Akses Website
- Buka: **https://msapt.co.id**
- Pastikan website loading dengan baik

### 7.2 Test Login
```
Email: admin@msa.com
Password: password
```

### 7.3 Ganti Password Default
1. **Login ke dashboard**
2. **Pergi ke profile/settings**
3. **Ganti password default**

---

## 🎉 SELESAI! Website Online

### ✅ Yang Sudah Berhasil
- [x] Domain msapt.co.id aktif
- [x] Database MySQL berjalan
- [x] Laravel application online
- [x] Auto deployment aktif
- [x] Backup system berjalan

### 🔄 Update Selanjutnya (Super Mudah!)
```bash
# Di komputer lokal
git add .
git commit -m "Update MSAPT - fitur baru"
git push origin master
```

**Hostinger otomatis update dalam 30 detik!**

---

## 🆘 Troubleshooting

### Jika Website Error 500
```bash
# Cek permissions
chmod -R 755 storage bootstrap/cache

# Cek .env file
cat .env

# Generate key lagi
php artisan key:generate --force
```

### Jika Database Connection Error
1. **Cek konfigurasi database di .env**
2. **Pastikan database dan user sudah dibuat**
3. **Test koneksi:** `php artisan migrate:status`

### Jika Git Deployment Gagal
1. **Cek repository URL benar**
2. **Pastikan branch master ada**
3. **Manual pull:** klik "Pull Changes" di hPanel

---

## 📞 Support

**Jika ada masalah:**
1. Cek Hostinger error logs di hPanel
2. Cek Laravel logs: `storage/logs/laravel.log`
3. Contact Hostinger support jika perlu

**Website MSAPT siap digunakan! 🚀**
