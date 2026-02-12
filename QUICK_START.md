# 🚀 Pinjamdulu - Quick Start Guide

Panduan cepat untuk menjalankan Sistem Manajemen Peminjaman Alat **Pinjamdulu**.

## ⚡ Langkah Cepat (5 Menit)

Jika Anda sudah memiliki project yang siap dengan semua dependencies teinstall, ikuti langkah ini:

### 1. Persiapan Database
```bash
# Jalankan migrasi untuk membuat semua tabel
php artisan migrate

# Seed database dengan data demo
php artisan db:seed
```

### 2. Jalankan Development Server
```bash
# Terminal 1: Start Laravel server
php artisan serve

# Terminal 2 (opsional): Compile assets jika menggunakan Vite
npm run dev
```

### 3. Akses Aplikasi
Buka browser dan kunjungi:
```
http://localhost:8000
```

---

## 👥 Demo Credentials

Gunakan kredensial berikut untuk login dan explore setiap role:

### Admin Account
- **Email**: `admin@pinjamdulu.com`
- **Password**: `password`
- **Akses**: Kelola user, alat, kategori, peminjaman, pengembalian, dan log aktivitas

### Petugas Account
- **Email**: `petugas1@pinjamdulu.com`
- **Password**: `password`
- **Akses**: Setujui/tolak peminjaman, catat pengembalian, cetak laporan

### Peminjam Accounts
- **Email**: `peminjam1@pinjamdulu.com` (hingga peminjam5)
- **Password**: `password`
- **Akses**: Lihat daftar alat, ajukan peminjaman, kembalikan alat

---

## 📋 Fitur per Role

### 👨‍💼 Admin Dashboard
- 📊 Statistik lengkap sistem (total user, alat, peminjaman, dll)
- 📋 Log aktivitas real-time dari semua user
- 👤 Manajemen user (create, edit, delete)
- 📦 Manajemen alat dan kategori
- ✅ Review semua peminjaman dan pengembalian

### 👨‍💻 Petugas Dashboard
- 📊 Statistik peminjaman pending dan disetujui
- ✅ Daftar peminjaman yang perlu disetujui/ditolak
- 📝 Catat pengembalian alat dan denda
- 📄 Generate laporan (HTML & Print)

### 👤 Peminjam Dashboard
- 📊 Riwayat peminjaman pribadi
- 🔍 Browse alat yang tersedia dengan status stok
- 📅 Ajukan permintaan peminjaman dengan tanggal
- ↩️ Kembalikan alat yang sedang dipinjam

---

## 🗄️ Struktur Database

### Tabel Utama
1. **users**: Menyimpan data user (admin, petugas, peminjam)
2. **kategoris**: Kategori alat (Lab, Olahraga, Kantor, dll)
3. **alats**: Daftar alat/barang yang bisa dipinjam
4. **peminjamans**: Record peminjaman (status: pending, disetujui, ditolak, dikembalikan)
5. **pengembalians**: Record pengembalian (include: denda)
6. **aktivitas_logs**: Audit trail semua aktivitas CRUD

### Relasi Data
```
User
├── hasMany Peminjaman
└── hasMany AktivitasLog

Kategori
└── hasMany Alat

Alat
├── belongsTo Kategori
└── hasMany Peminjaman

Peminjaman
├── belongsTo User
├── belongsTo Alat
└── hasOne Pengembalian

Pengembalian
└── belongsTo Peminjaman
```

---

## 🔧 Troubleshooting

### Migrasi Gagal
```bash
# Reset database dan jalankan ulang
php artisan migrate:refresh --seed
```

### Belum Ada Data Setelah db:seed
```bash
# Pastikan seeders berjalan dengan benar
php artisan db:seed DatabaseSeeder
```

### Error "No application key has been set"
```bash
# Generate APP_KEY baru di .env
php artisan key:generate
```

### Middleware Role Tidak Bekerja
Pastikan bootstrap/app.php sudah mendaftarkan middleware alias:
```php
$middleware->alias([
    'role' => \App\Http\Middleware\CheckRole::class,
    'roles' => \App\Http\Middleware\CheckRoleMultiple::class,
]);
```

---

## 📁 Struktur File Penting

```
pinjamdulu/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── AuthController.php
│   │   │   ├── Admin/          (7 controllers)
│   │   │   ├── Petugas/        (4 controllers)
│   │   │   └── Peminjam/       (4 controllers)
│   │   └── Middleware/
│   │       ├── CheckRole.php
│   │       └── CheckRoleMultiple.php
│   └── Models/
│       ├── User.php
│       ├── Kategori.php
│       ├── Alat.php
│       ├── Peminjaman.php
│       ├── Pengembalian.php
│       └── AktivitasLog.php
├── database/
│   ├── migrations/          (9 migrations)
│   └── seeders/
│       └── DatabaseSeeder.php
├── resources/
│   └── views/
│       ├── auth/            (login, register)
│       ├── admin/           (12 templates)
│       ├── petugas/         (6 templates)
│       ├── peminjam/        (8 templates)
│       └── layouts/
│           └── app.blade.php
├── routes/
│   └── web.php              (40+ routes)
└── bootstrap/
    └── app.php              (middleware registration)
```

---

## 🎯 Testing Workflow

### Test sebagai Admin
1. Login dengan `admin@pinjamdulu.com / password`
2. Lihat dashboard dengan statistik
3. Buat user baru di menu Users
4. Buat kategori alat baru
5. Lihat semua peminjaman dan persetujuan

### Test sebagai Petugas
1. Login dengan `petugas1@pinjamdulu.com / password`
2. Lihat dashboard dengan pending peminjaman
3. Setujui atau tolak peminjaman
4. Catat pengembalian alat
5. Generate laporan peminjaman

### Test sebagai Peminjam
1. Login dengan `peminjam1@pinjamdulu.com / password`
2. Lihat daftar alat yang tersedia
3. Ajukan peminjaman dengan tanggal
4. Monitor status peminjaman
5. Kembalikan alat

---

## 📚 Dokumentasi Lengkap

Untuk dokumentasi lengkap, lihat `INSTALLATION.md`

---

## ❓ FAQ

**Q: Bagaimana cara menambah kategori alat baru?**
A: Login sebagai admin, ke menu "Kategori", klik "Tambah Kategori" baru.

**Q: Alat tidak bisa dipinjam meski tersedia di list?**
A: Periksa stok_tersedia > 0. Admin bisa edit alat untuk menambah stok.

**Q: Bagaimana denda diterapkan?**
A: Petugas dapat input denda saat mencatat pengembalian alat.

**Q: Dapatkah peminjam melihat peminjaman user lain?**
A: Tidak, sistem hanya menampilkan peminjaman milik user tersebut (authorization built-in).

---

## 🚀 Production Deployment

Untuk deploy ke production, ikuti langkah di `INSTALLATION.md` bagian "Deployment".

**Kunci penting:**
- Set `APP_ENV=production` di .env
- Set `APP_DEBUG=false` di .env
- Gunakan MySQL database yang proper
- Jalankan `php artisan optimize`
- Setup proper web server (Nginx/Apache)

---

## 📞 Support

Jika ada error atau pertanyaan, periksa:
1. Error message di terminal
2. Storage/logs/laravel.log
3. Bagian Troubleshooting di atas

---

**Happy Lending! 🎉**
