# 🚀 Panduan Upload MSAPT ke Hostinger (Tanpa GitHub)

## 📋 Yang Anda Butuhkan
- Akun Hostinger
- File project MSAPT (folder ini)
- Browser (Chrome/Firefox)
- WinRAR atau 7zip (untuk compress)

## 🗂️ Langkah 1: Siapkan File Upload

### A. Buat Folder Bersih
1. Buat folder baru di Desktop: `msapt-clean`
2. Copy semua file dari folder ini ke `msapt-clean`
3. Hapus folder yang tidak perlu:
   - `node_modules` (jika ada)
   - `.git` (jika ada) 
   - `tests`
   - `vendor` (akan diinstall otomatis)

### B. Compress File
1. Klik kanan folder `msapt-clean`
2. Pilih "Add to archive" atau "Compress"
3. Nama file: `msapt-website.zip`

## 🌐 Langkah 2: Upload ke Hostinger

### A. Login Hostinger
1. Buka: https://hpanel.hostinger.com
2. Login dengan akun Anda
3. Pilih domain: msapt.co.id

### B. File Manager
1. Klik "File Manager" di dashboard
2. Masuk ke folder `public_html`
3. HAPUS semua file lama (jika ada)

### C. Upload File
1. Klik tombol "Upload" 
2. Pilih file `msapt-website.zip`
3. Tunggu upload 100%
4. Klik kanan zip → "Extract Here"
5. Hapus file zip setelah extract

## ⚙️ Langkah 3: Setup Otomatis

### A. Jalankan Setup
1. Buka browser: `https://msapt.co.id/setup-hostinger.php`
2. Tunggu proses setup (2-3 menit)
3. Jika sukses: "Setup Completed Successfully!"

### B. Test Website
1. Buka: `https://msapt.co.id`
2. Login admin:
   - Email: admin@msa.com
   - Password: password

## 🔧 Jika Ada Masalah

### Error 500
- Jalankan ulang: `https://msapt.co.id/setup-hostinger.php`

### Database Error
- Cek database di Hostinger panel
- Pastikan database name: `u919556019_msapt_db`

### File Permission Error
Di File Manager, set permission:
- Folder `storage`: 755
- Folder `bootstrap/cache`: 755
- File `.env`: 644

## 🔄 Update Website Nanti

Untuk update selanjutnya:
1. Edit file di local
2. Compress folder baru
3. Upload & extract di Hostinger
4. Jalankan: `https://msapt.co.id/deploy.php`

## 📞 Bantuan
Jika masih error, screenshot error nya dan tanya lagi!

---
**Catatan**: Cara ini JAUH lebih mudah daripada GitHub!
