# Pinjamdulu - Sistem Manajemen Peminjaman Alat

Aplikasi web untuk manajemen peminjaman dan pengembalian alat/barang dengan fitur lengkap untuk admin, petugas, dan peminjam.

## Fitur Utama

### 1. Admin
- **Dashboard**: Statistik keseluruhan sistem
- **CRUD User**: Kelola user (admin, petugas, peminjam)
- **CRUD Alat**: Kelola daftar alat yang tersedia
- **CRUD Kategori**: Kelola kategori alat
- **CRUD Peminjaman**: Lihat dan kelola semua peminjaman
- **CRUD Pengembalian**: Catat dan kelola pengembalian alat
- **Log Aktivitas**: Monitor semua aktivitas sistem

### 2. Petugas
- **Dashboard**: Statistik peminjaman dan pengembalian
- **Kelola Peminjaman**: Menyetujui atau menolak permintaan peminjaman
- **Pantau Pengembalian**: Memonitor dan mencatat pengembalian alat
- **Cetak Laporan**: Generate laporan peminjaman dalam format print

### 3. Peminjam
- **Dashboard**: Riwayat peminjaman pribadi
- **Lihat Daftar Alat**: Browse alat yang tersedia
- **Ajukan Peminjaman**: Mengajukan permintaan peminjaman
- **Kembalikan Alat**: Mengembalikan alat yang dipinjam

## Teknologi yang Digunakan

- **Laravel 11**: PHP Framework
- **MySQL**: Database
- **Bootstrap 5**: CSS Framework
- **Blade**: Template Engine

## Persyaratan Sistem

- PHP 8.1 atau lebih tinggi
- Composer
- MySQL 5.7 atau lebih tinggi
- Node.js (untuk asset compilation)

## Instalasi

### 1. Clone Repository
```bash
git clone <repository-url>
cd pinjamdulu
```

### 2. Install Dependencies
```bash
composer install
npm install
```

### 3. Setup Environment
```bash
cp .env.example .env
php artisan key:generate
```

### 4. Konfigurasi Database
Edit file `.env`:
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=pinjamdulu
DB_USERNAME=root
DB_PASSWORD=
```

### 5. Migrasi Database
```bash
php artisan migrate
php artisan db:seed
```

### 6. Build Assets
```bash
npm run dev
```

### 7. Jalankan Server
```bash
php artisan serve
```

Aplikasi akan berjalan di `http://localhost:8000`

## Akun Default Setelah Seeding

### Admin
- Email: `admin@pinjamdulu.com`
- Password: `password`

### Petugas
- Email: `petugas1@pinjamdulu.com`
- Password: `password`

### Peminjam (5 akun)
- Email: `peminjam1@pinjamdulu.com` hingga `peminjam5@pinjamdulu.com`
- Password: `password` (untuk semua akun)

## Struktur Database

### Tabel Users
Menyimpan data user dengan role: admin, petugas, peminjam

### Tabel Kategoris
Menyimpan kategori-kategori alat

### Tabel Alats
Menyimpan data alat dengan tracking stok

### Tabel Peminjamans
Menyimpan data peminjaman dengan status: pending, disetujui, ditolak, dikembalikan

### Tabel Pengembalians
Menyimpan data pengembalian alat dengan denda

### Tabel Aktivitas_Logs
Menyimpan log semua aktivitas user

## Alur Peminjaman

1. **Peminjam** mengajukan permintaan peminjaman
2. **Petugas** menerima notifikasi dan melakukan approval/reject
3. Jika disetujui, stok alat berkurang
4. **Peminjam** mengembalikan alat melalui fitur pengembalian
5. **Petugas** mencatat pengembalian dan kondisi alat
6. Stok alat dikembalikan ke kondisi semula

## Fitur Keamanan

- Authentication system untuk semua user
- Role-based access control (RBAC)
- CSRF protection
- Password hashing dengan bcrypt
- Session management
- Activity logging untuk audit trail

## Kontribusi

Silakan buat pull request untuk kontribusi. Untuk perubahan besar, buka issue terlebih dahulu.

## Lisensi

Proyek ini bersifat open source dan bebas untuk digunakan.

## Support

Untuk pertanyaan atau masalah, silakan buka issue atau hubungi tim development.
