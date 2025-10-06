# 🗄️ Cara Membuat Database MySQL di Hostinger

## 📋 Panduan Step-by-Step dengan Gambar

### **Langkah 1: Login ke Hostinger Control Panel**

1. **Buka browser** dan pergi ke: https://hpanel.hostinger.com
2. **Login** dengan email dan password akun Hostinger Anda
3. **Pilih hosting plan** yang sudah Anda beli untuk domain msapt.co.id

---

### **Langkah 2: Masuk ke Menu Database**

1. **Di dashboard utama hPanel**, cari menu **"Databases"**
2. **Klik "Databases"** (biasanya ada di sidebar kiri atau menu utama)
3. **Pilih "Manajemen"** dari pilihan yang tersedia:
   - ✅ **Manajemen** ← Pilih ini untuk membuat database
   - phpMyAdmin (untuk mengelola database yang sudah ada)
   - Remote MySQL (untuk akses dari luar)

---

### **Langkah 3: Buat Database Baru**

#### **3.1 Klik "Create Database"**
- Di halaman MySQL Databases, cari tombol **"Create Database"** atau **"+ Create"**
- Klik tombol tersebut

#### **3.2 Isi Nama Database**
```
Database Name: msapt_db
```
- **PENTING:** Hostinger biasanya menambahkan prefix otomatis
- Jadi nama lengkapnya mungkin jadi: `u123456789_msapt_db`
- **Catat nama lengkap ini!**

#### **3.3 Klik "Create"**
- Klik tombol **"Create Database"**
- Tunggu beberapa detik sampai database terbuat

---

### **Langkah 4: Buat User Database**

#### **4.1 Klik "Create User"**
- Setelah database terbuat, cari tombol **"Create User"** atau **"Add User"**

#### **4.2 Isi Data User**
```
Username: msapt_user
Password: [buat password yang KUAT]
```

⚠️ **PENTING - Jangan Gunakan Username Berbahaya:**
- ❌ **JANGAN:** root, admin, administrator, user, mysql
- ✅ **GUNAKAN:** msapt_user, msapt_admin, msapt_db_user

**Alasan Keamanan:**
- Username "root" adalah target utama hacker
- Username generik mudah ditebak dan diserang
- Gunakan nama yang spesifik untuk aplikasi Anda

**Contoh password kuat:**
```
MsaPt2024!@#$SecurE
```

#### **4.3 Konfirmasi Password**
- Ketik ulang password yang sama
- **CATAT password ini baik-baik!**

#### **4.4 Klik "Create User"**

---

### **Langkah 5: Berikan Akses User ke Database**

#### **Metode 1: Via Halaman Manajemen (Jika Ada)**
- Di halaman MySQL Databases, cari section **"Assign Users to Databases"**
- **Pilih User:** `msapt_user` (atau dengan prefix)
- **Pilih Database:** `msapt_db` (atau dengan prefix)
- **Centang "ALL PRIVILEGES"** dan klik **"Assign"**

#### **Metode 2: Via phpMyAdmin (Jika Metode 1 Tidak Ada)**

**5.1 Buka phpMyAdmin**
- Kembali ke menu **"Databases"**
- **Klik "phpMyAdmin"**
- Login otomatis ke phpMyAdmin

**5.2 Set User Privileges**
- Di phpMyAdmin, klik tab **"User accounts"** atau **"Privileges"**
- Cari user: `u919556019_supermsaroot`
- Klik **"Edit privileges"** atau ikon pensil
- Pastikan user punya akses ke database `u919556019_msapt_db`

**5.3 Grant All Privileges**
- Centang **"Check all"** untuk memberikan semua permission
- Klik **"Go"** atau **"Save"**

---

### **Langkah 6: Catat Informasi Database**

Setelah selesai, **CATAT INFORMASI INI** untuk konfigurasi website:

```
DB_HOST: localhost
DB_PORT: 3306
DB_DATABASE: u123456789_msapt_db    (nama lengkap dengan prefix)
DB_USERNAME: u123456789_msapt_user  (nama lengkap dengan prefix)
DB_PASSWORD: MsaPt2024!@#$SecurE    (password yang Anda buat)
```

---

## 🎯 **Contoh Tampilan di Hostinger**

### **Menu Databases akan terlihat seperti ini:**
```
📊 Databases
   ├── MySQL Databases     ← Klik ini
   ├── phpMyAdmin
   └── Remote MySQL
```

### **Halaman MySQL Databases:**
```
🗄️ MySQL Databases

[+ Create Database]

📋 Existing Databases:
┌─────────────────────────────────┐
│ u123456789_msapt_db            │
│ Created: 2024-10-06            │
│ Size: 0 MB                     │
└─────────────────────────────────┘

👤 Database Users:
┌─────────────────────────────────┐
│ u123456789_msapt_user          │
│ Privileges: ALL                │
└─────────────────────────────────┘
```

---

## ❗ **Tips Penting**

### **1. Nama Database dengan Prefix**
Hostinger otomatis menambahkan prefix seperti `u123456789_`
- Database: `u123456789_msapt_db`
- User: `u123456789_msapt_user`

### **2. Password Kuat**
Gunakan kombinasi:
- Huruf besar: A-Z
- Huruf kecil: a-z  
- Angka: 0-9
- Simbol: !@#$%^&*

### **3. Catat Semua Informasi**
Simpan di tempat aman:
- Nama database lengkap
- Username lengkap
- Password
- Host (selalu `localhost`)

---

## 🆘 **Troubleshooting**

### **Tidak Ada Menu "Databases"?**
- Cek apakah hosting plan Anda mendukung MySQL
- Coba refresh halaman
- Contact support Hostinger

### **Error "Database Already Exists"?**
- Ganti nama database: `msapt_db2` atau `msapt_main`
- Atau hapus database lama jika tidak terpakai

### **Lupa Password Database?**
- Di halaman MySQL Databases
- Klik "Change Password" pada user
- Buat password baru

---

## ✅ **Setelah Database Siap**

Lanjut ke **STEP-BY-STEP-HOSTINGER.md** bagian:
- **Langkah 3: Setup Git Deployment**

Database MySQL sudah siap untuk website MSAPT! 🎉
