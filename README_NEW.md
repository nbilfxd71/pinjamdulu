# 🎉 Pinjamdulu - Sistem Manajemen Peminjaman Alat

<p align="center">
  <strong>Aplikasi web lengkap untuk manajemen peminjaman dan pengembalian alat/barang</strong>
  <br/>
  Built with Laravel 11 • Secure • Scalable • Ready for Production
</p>

---

## ⚡ Quick Start (5 Minutes)

```bash
# 1. Run migrations & seed database
php artisan migrate --seed

# 2. Start development server
php artisan serve

# 3. Open browser
http://localhost:8000
```

**Login dengan:**
- Admin: `admin@pinjamdulu.com / password`
- Petugas: `petugas1@pinjamdulu.com / password`
- Peminjam: `peminjam1@pinjamdulu.com / password`

---

## 📖 Documentation

Dokumentasi lengkap tersedia:

| Dokumen | Deskripsi | Waktu |
|---------|-----------|-------|
| **[DOCUMENTATION_INDEX.md](DOCUMENTATION_INDEX.md)** | 📚 Index semua dokumentasi | - |
| **[QUICK_START.md](QUICK_START.md)** | 🚀 Setup dalam 5 menit | 5 min |
| **[INSTALLATION.md](INSTALLATION.md)** | 🔧 Setup lengkap & troubleshooting | 15 min |
| **[PROJECT_SUMMARY.md](PROJECT_SUMMARY.md)** | 📚 Ringkasan project lengkap | 10 min |
| **[API_ROUTES.md](API_ROUTES.md)** | 📡 Dokumentasi semua endpoints | 20 min |
| **[TESTING_GUIDE.md](TESTING_GUIDE.md)** | 🧪 Testing walkthrough lengkap | 30 min |
| **[DEPLOYMENT.md](DEPLOYMENT.md)** | 🚀 Production deployment guide | 20 min |

**👉 [MULAI DARI SINI: DOCUMENTATION_INDEX.md](DOCUMENTATION_INDEX.md)**

---

## ✨ Fitur Utama

### 👨‍💼 Admin Panel
- ✅ Dashboard dengan statistik lengkap sistem
- ✅ CRUD User (Create, Read, Update, Delete)
- ✅ CRUD Kategori Alat
- ✅ CRUD Alat (dengan stock tracking)
- ✅ Kelola semua Peminjaman
- ✅ Kelola semua Pengembalian
- ✅ Activity Log (audit trail)

### 👨‍💻 Petugas Interface
- ✅ Dashboard dengan statistik peminjaman
- ✅ Approval workflow (setujui/tolak peminjaman)
- ✅ Catat pengembalian alat
- ✅ Kelola denda/biaya kerusakan
- ✅ Generate laporan (HTML & Print)

### 👤 Peminjam Portal
- ✅ Dashboard dengan riwayat peminjaman
- ✅ Browse alat yang tersedia
- ✅ Ajukan peminjaman dengan validasi
- ✅ Monitor status peminjaman
- ✅ Kembalikan alat
- ✅ Privacy (hanya lihat data sendiri)

---

## 🏗️ Teknologi

- **Backend**: Laravel 11 (PHP 8.1+)
- **Database**: SQLite (default) / MySQL
- **Frontend**: Bootstrap 5 + Blade
- **Icons**: Bootstrap Icons
- **Authentication**: Laravel Auth
- **Authorization**: Custom Middleware

---

## 📊 Project Stats

- **13 Controllers**: Auth + 7 Admin + 4 Petugas + 4 Peminjam
- **6 Models**: User, Kategori, Alat, Peminjaman, Pengembalian, AktivitasLog
- **9 Migrations**: Database schema lengkap
- **40+ Routes**: Semua endpoints documented
- **25+ Views**: Template untuk semua fitur
- **2 Middleware**: Role-based access control
- **7 Documentation Files**: Lengkap dengan examples

---

## 🗂️ Project Structure

```
pinjamdulu/
├── 📄 DOCUMENTATION_INDEX.md   ← Mulai dari sini!
├── 📄 QUICK_START.md
├── 📄 INSTALLATION.md
├── 📄 PROJECT_SUMMARY.md
├── 📄 API_ROUTES.md
├── 📄 TESTING_GUIDE.md
├── 📄 DEPLOYMENT.md
│
├── app/
│   ├── Http/Controllers/        (13 controllers)
│   ├── Models/                  (6 models)
│   └── Middleware/              (2 middleware)
│
├── database/
│   ├── migrations/              (9 migrations)
│   └── seeders/
│       └── DatabaseSeeder.php
│
├── resources/views/             (25+ templates)
│   ├── auth/
│   ├── admin/
│   ├── petugas/
│   ├── peminjam/
│   └── layouts/
│
├── routes/
│   └── web.php                  (40+ routes)
│
└── bootstrap/
    └── app.php                  (config)
```

---

## 🚀 Mulai Sekarang

### 1️⃣ Setup (5 menit)
```bash
php artisan migrate --seed
php artisan serve
```

### 2️⃣ Login & Explore
Buka `http://localhost:8000` dengan credentials di atas

### 3️⃣ Test Fitur
Ikuti [TESTING_GUIDE.md](TESTING_GUIDE.md) untuk step-by-step testing

### 4️⃣ Deploy
Baca [DEPLOYMENT.md](DEPLOYMENT.md) untuk production setup

---

## 📋 Features Checklist

### Database ✅
- [x] 9 migrations properly structured
- [x] Proper relationships & foreign keys
- [x] Enums for status, conditions, roles
- [x] Full seeding data

### Models ✅
- [x] 6 models dengan relationships
- [x] Fillable & casts configured
- [x] Proper type hints & documentation

### Controllers ✅
- [x] 13 controllers dengan full CRUD
- [x] Business logic implemented
- [x] Validation rules
- [x] Error handling

### Routes ✅
- [x] 40+ named routes
- [x] Role-based middleware
- [x] Public/protected routes

### Views ✅
- [x] 25+ Blade templates
- [x] Bootstrap 5 styling
- [x] Form validation feedback
- [x] Responsive design
- [x] Status badges

### Middleware ✅
- [x] CheckRole (single role)
- [x] CheckRoleMultiple (multiple roles)

### Security ✅
- [x] Laravel authentication
- [x] CSRF protection
- [x] Password hashing
- [x] Authorization checks
- [x] Activity logging

### Documentation ✅
- [x] 7 documentation files
- [x] Quick start guide
- [x] Installation guide
- [x] API documentation
- [x] Testing guide
- [x] Deployment guide
- [x] Project summary

---

## 🔐 Security Features

✅ Password hashing dengan Bcrypt  
✅ CSRF token protection  
✅ SQL injection prevention  
✅ XSS protection  
✅ Role-based access control  
✅ Authorization middleware  
✅ Activity logging  
✅ Session management  

---

## 🧪 Testing

Lengkap dengan testing guide:
- Setup instructions
- Test cases untuk setiap role
- Business logic validation
- Edge cases & error handling
- Authorization testing
- Checklist QA lengkap

**[Baca Testing Guide](TESTING_GUIDE.md)**

---

## 🌐 Browser Support

- Chrome/Chromium ✅
- Firefox ✅
- Safari ✅
- Edge ✅
- Mobile browsers ✅

---

## 📱 Responsive Design

- ✅ Desktop (1200px+)
- ✅ Tablet (768px - 1199px)
- ✅ Mobile (< 768px)
- ✅ Touch-friendly UI

---

## ⚙️ System Requirements

- PHP 8.1 atau lebih tinggi
- MySQL 5.7+ (atau SQLite)
- Composer
- Node.js (untuk asset compilation)
- 512MB RAM minimum
- 50MB disk space

---

## 🚀 Production Deployment

Lengkap dengan deployment guide:
- Linux/Ubuntu server setup
- Nginx configuration
- MySQL database setup
- SSL/TLS certificates
- Performance optimization
- Security hardening
- Monitoring setup
- Backup strategy

**[Baca Deployment Guide](DEPLOYMENT.md)**

---

## 💡 Key Concepts

### Peminjaman Workflow
```
Pending → Disetujui → Dikembalikan
         → Ditolak
```

### Stock Management
- Create: stok=5, stok_tersedia=5
- Approve: stok_tersedia berkurang 1
- Return: stok_tersedia naik 1

### Activity Logging
Setiap CRUD operation dicatat:
- User yang melakukan
- Jenis action (create/update/delete)
- Entity type & ID
- Detail perubahan
- IP address & timestamp

---

## 🎯 Use Cases

### Admin
- Kelola user, alat, kategori
- Monitor semua peminjaman
- Lihat activity log
- Generate reports

### Petugas
- Setujui/tolak peminjaman
- Catat pengembalian & denda
- Generate laporan peminjaman
- Monitor stock

### Peminjam
- Browse alat tersedia
- Ajukan peminjaman
- Track status
- Kembalikan alat

---

## 📊 Database Models

```
User → Peminjaman → Pengembalian
    → AktivitasLog

Kategori → Alat → Peminjaman
```

---

## 🔧 Configuration

### Environment Variables
```env
APP_NAME=Pinjamdulu
APP_ENV=local
APP_DEBUG=true
APP_URL=http://localhost:8000

DB_CONNECTION=sqlite
# Atau MySQL:
# DB_CONNECTION=mysql
# DB_HOST=127.0.0.1
# DB_DATABASE=pinjamdulu
# DB_USERNAME=root
# DB_PASSWORD=
```

---

## 📦 Dependencies

- Laravel 11
- Bootstrap 5.1.3
- Bootstrap Icons
- PHP 8.1+
- Composer

---

## 🆘 Troubleshooting

**Issue?**

1. Cek [QUICK_START.md - Troubleshooting](QUICK_START.md#-troubleshooting)
2. Baca error di `storage/logs/laravel.log`
3. Verify `.env` configuration
4. Run `php artisan migrate:refresh --seed`

---

## ❓ FAQ

**Q: Berapa lama setup?**  
A: 5 menit dengan [QUICK_START.md](QUICK_START.md)

**Q: Bisa pakai MySQL?**  
A: Ya, edit .env dan run migrations

**Q: Gimana caranya test?**  
A: Ikuti [TESTING_GUIDE.md](TESTING_GUIDE.md)

**Q: Mau deploy production?**  
A: Baca [DEPLOYMENT.md](DEPLOYMENT.md)

**Q: Ada API endpoints?**  
A: Lihat [API_ROUTES.md](API_ROUTES.md)

---

## 🎓 Learning Resources

- [Laravel Docs](https://laravel.com/docs)
- [Bootstrap Docs](https://getbootstrap.com/docs)
- [PHP Docs](https://www.php.net/docs.php)

---

## 📝 License

Open source - free untuk digunakan

---

## 🙏 Credits

Dibangun dengan Laravel 11 dan Bootstrap 5

---

## 🎉 Ready?

**Start here**: [DOCUMENTATION_INDEX.md](DOCUMENTATION_INDEX.md)

**Quick setup**: [QUICK_START.md](QUICK_START.md)

---

## 📞 Support

- Check logs: `storage/logs/laravel.log`
- Read docs: [DOCUMENTATION_INDEX.md](DOCUMENTATION_INDEX.md)
- Check API: [API_ROUTES.md](API_ROUTES.md)
- Test guide: [TESTING_GUIDE.md](TESTING_GUIDE.md)

---

**Status**: ✅ Production Ready

**Version**: 1.0

**Last Updated**: February 2025

---

Made with ❤️ for team lending management.
