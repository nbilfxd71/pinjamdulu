# 📡 Pinjamdulu - API Routes Documentation

Dokumentasi lengkap semua endpoints dan routes di Pinjamdulu.

## 🔐 Public Routes (Tanpa Auth)

| Method | Endpoint | Controller | Deskripsi |
|--------|----------|-----------|-----------|
| GET | `/` | welcome.blade.php | Halaman home |
| GET | `/login` | AuthController@showLoginForm | Form login |
| POST | `/login` | AuthController@login | Process login |
| GET | `/register` | AuthController@showRegisterForm | Form register |
| POST | `/register` | AuthController@register | Process register |

---

## 🔓 Authenticated Routes

### Dashboard
| Method | Endpoint | Controller | Deskripsi |
|--------|----------|-----------|-----------|
| POST | `/logout` | AuthController@logout | Process logout |
| GET | `/dashboard` | AuthController@dashboard | Universal dashboard router |

---

## 👨‍💼 Admin Routes (`/admin/*`)

Middleware: `auth` + `role:admin`

### Dashboard
| Method | Endpoint | Controller | Deskripsi |
|--------|----------|-----------|-----------|
| GET | `/admin/dashboard` | AdminDashboardController@index | Admin dashboard dengan stats |

### Users Management
| Method | Endpoint | Controller | Deskripsi |
|--------|----------|-----------|-----------|
| GET | `/admin/users` | UserController@index | List semua user |
| GET | `/admin/users/create` | UserController@create | Form tambah user |
| POST | `/admin/users` | UserController@store | Save user baru |
| GET | `/admin/users/{user}/edit` | UserController@edit | Form edit user |
| PUT | `/admin/users/{user}` | UserController@update | Update user |
| DELETE | `/admin/users/{user}` | UserController@destroy | Hapus user |

**Catatan**: Setiap action di-log ke aktivitas_logs

### Kategoris Management
| Method | Endpoint | Controller | Deskripsi |
|--------|----------|-----------|-----------|
| GET | `/admin/kategoris` | KategoriController@index | List kategori |
| GET | `/admin/kategoris/create` | KategoriController@create | Form tambah kategori |
| POST | `/admin/kategoris` | KategoriController@store | Save kategori |
| GET | `/admin/kategoris/{kategori}/edit` | KategoriController@edit | Form edit kategori |
| PUT | `/admin/kategoris/{kategori}` | KategoriController@update | Update kategori |
| DELETE | `/admin/kategoris/{kategori}` | KategoriController@destroy | Hapus kategori |

### Alats Management
| Method | Endpoint | Controller | Deskripsi |
|--------|----------|-----------|-----------|
| GET | `/admin/alats` | AdminAlatController@index | List alat |
| GET | `/admin/alats/create` | AdminAlatController@create | Form tambah alat |
| POST | `/admin/alats` | AdminAlatController@store | Save alat |
| GET | `/admin/alats/{alat}/edit` | AdminAlatController@edit | Form edit alat |
| PUT | `/admin/alats/{alat}` | AdminAlatController@update | Update alat |
| DELETE | `/admin/alats/{alat}` | AdminAlatController@destroy | Hapus alat |

**Fields**: nama, deskripsi, kategori_id, stok, stok_tersedia, kondisi, nomor_seri, tahun_perolehan

### Peminjamans Management
| Method | Endpoint | Controller | Deskripsi |
|--------|----------|-----------|-----------|
| GET | `/admin/peminjamans` | AdminPeminjamanController@index | List semua peminjaman |
| GET | `/admin/peminjamans/{peminjaman}` | AdminPeminjamanController@show | Detail peminjaman |
| POST | `/admin/peminjamans/{peminjaman}/approve` | AdminPeminjamanController@approve | Setujui peminjaman |
| POST | `/admin/peminjamans/{peminjaman}/reject` | AdminPeminjamanController@reject | Tolak peminjaman |
| DELETE | `/admin/peminjamans/{peminjaman}` | AdminPeminjamanController@destroy | Hapus peminjaman |

**Status**: pending → disetujui/ditolak → dikembalikan

### Pengembalians Management
| Method | Endpoint | Controller | Deskripsi |
|--------|----------|-----------|-----------|
| GET | `/admin/pengembalians` | AdminPengembalianController@index | List pengembalian |
| GET | `/admin/pengembalians/{peminjaman}/create` | AdminPengembalianController@create | Form catat pengembalian |
| POST | `/admin/pengembalians/{peminjaman}` | AdminPengembalianController@store | Save pengembalian |
| GET | `/admin/pengembalians/{pengembalian}` | AdminPengembalianController@show | Detail pengembalian |
| GET | `/admin/pengembalians/{pengembalian}/edit` | AdminPengembalianController@edit | Form edit pengembalian |
| PUT | `/admin/pengembalians/{pengembalian}` | AdminPengembalianController@update | Update pengembalian |
| DELETE | `/admin/pengembalians/{pengembalian}` | AdminPengembalianController@destroy | Hapus pengembalian |

### Aktivitas Log
| Method | Endpoint | Controller | Deskripsi |
|--------|----------|-----------|-----------|
| GET | `/admin/aktivitas` | AktivitasController@index | List aktivitas log |
| GET | `/admin/aktivitas/{aktivitasLog}` | AktivitasController@show | Detail aktivitas |

**Tracked**: User CRUD, Alat CRUD, Kategori CRUD, Peminjaman changes

---

## 👨‍💻 Petugas Routes (`/petugas/*`)

Middleware: `auth` + `role:petugas`

### Dashboard
| Method | Endpoint | Controller | Deskripsi |
|--------|----------|-----------|-----------|
| GET | `/petugas/dashboard` | PetugasDashboardController@index | Petugas dashboard |

### Peminjamans (Persetujuan)
| Method | Endpoint | Controller | Deskripsi |
|--------|----------|-----------|-----------|
| GET | `/petugas/peminjamans` | PetugasPeminjamanController@index | List peminjaman pending |
| GET | `/petugas/peminjamans/{peminjaman}` | PetugasPeminjamanController@show | Detail peminjaman |
| POST | `/petugas/peminjamans/{peminjaman}/approve` | PetugasPeminjamanController@approve | Setujui + kurangi stok |
| POST | `/petugas/peminjamans/{peminjaman}/reject` | PetugasPeminjamanController@reject | Tolak peminjaman |

**Action on Approve**: 
- Status → disetujui
- Alat stok_tersedia berkurang 1

### Pengembalians (Catat Return)
| Method | Endpoint | Controller | Deskripsi |
|--------|----------|-----------|-----------|
| GET | `/petugas/pengembalians` | PetugasPengembalianController@index | List pengembalian |
| GET | `/petugas/pengembalians/{peminjaman}/create` | PetugasPengembalianController@create | Form catat pengembalian |
| POST | `/petugas/pengembalians/{peminjaman}` | PetugasPengembalianController@store | Save pengembalian |
| GET | `/petugas/pengembalians/{pengembalian}` | PetugasPengembalianController@show | Detail pengembalian |

**Action on Store**:
- Create pengembalian record dengan kondisi dan denda
- Status peminjaman → dikembalikan
- Alat stok_tersedia bertambah 1

### Laporan
| Method | Endpoint | Controller | Deskripsi |
|--------|----------|-----------|-----------|
| GET | `/petugas/laporan` | LaporanController@index | Laporan HTML (printable) |
| GET | `/petugas/laporan/print` | LaporanController@print | Laporan print-ready |

**Laporan Shows**:
- Total peminjaman per status
- Total pengembalian
- Alat paling sering dipinjam
- Statistik per kategori

---

## 👤 Peminjam Routes (`/peminjam/*`)

Middleware: `auth` + `role:peminjam`

### Dashboard
| Method | Endpoint | Controller | Deskripsi |
|--------|----------|-----------|-----------|
| GET | `/peminjam/dashboard` | PeminjamDashboardController@index | Peminjam dashboard |

**Shows**: Peminjaman aktif, history, pending count

### Alats (Browse)
| Method | Endpoint | Controller | Deskripsi |
|--------|----------|-----------|-----------|
| GET | `/peminjam/alats` | PeminjamAlatController@index | List alat tersedia |
| GET | `/peminjam/alats/{alat}` | PeminjamAlatController@show | Detail alat |

**Filter**: Hanya alat dengan stok_tersedia > 0

### Peminjamans (Ajukan)
| Method | Endpoint | Controller | Deskripsi |
|--------|----------|-----------|-----------|
| GET | `/peminjam/peminjamans` | PeminjamPeminjamanController@index | List peminjaman user |
| GET | `/peminjam/peminjamans/create` | PeminjamPeminjamanController@create | Form ajukan peminjaman |
| POST | `/peminjam/peminjamans` | PeminjamPeminjamanController@store | Save peminjaman |
| GET | `/peminjam/peminjamans/{peminjaman}` | PeminjamPeminjamanController@show | Detail peminjaman |

**Authorization**: User hanya bisa lihat peminjaman miliknya sendiri

**Create Validation**:
- Tanggal peminjaman required
- Tanggal kembali ≥ tanggal peminjaman
- Alat harus tersedia

### Pengembalians
| Method | Endpoint | Controller | Deskripsi |
|--------|----------|-----------|-----------|
| GET | `/peminjam/pengembalians` | PeminjamPengembalianController@index | List pengembalian user |
| GET | `/peminjam/pengembalians/create` | PeminjamPengembalianController@create | Form kembalikan alat |
| POST | `/peminjam/pengembalians` | PeminjamPengembalianController@store | Save pengembalian |

---

## 📊 Data Models & Fields

### Users
```
- id (PK)
- name
- email (unique)
- password
- role (enum: admin, petugas, peminjam)
- nomor_identitas
- alamat
- no_telepon
- email_verified_at
- created_at
- updated_at
```

### Kategoris
```
- id (PK)
- nama
- deskripsi (optional)
- created_at
- updated_at
```

### Alats
```
- id (PK)
- kategori_id (FK → kategoris)
- nama
- deskripsi (optional)
- nomor_seri (optional)
- tahun_perolehan (optional)
- stok (total)
- stok_tersedia (available)
- kondisi (baik, rusak_ringan, rusak_berat)
- created_at
- updated_at
```

### Peminjamans
```
- id (PK)
- user_id (FK → users)
- alat_id (FK → alats)
- tanggal_peminjaman
- tanggal_kembali_dijadwalkan
- status (enum: pending, disetujui, ditolak, dikembalikan)
- keterangan (optional)
- created_at
- updated_at
```

### Pengembalians
```
- id (PK)
- peminjaman_id (FK → peminjamans)
- tanggal_pengembalian
- kondisi_saat_dikembalikan (baik, rusak_ringan, rusak_berat)
- denda (optional, default: 0)
- keterangan_denda (optional)
- created_at
- updated_at
```

### Aktivitas_Logs
```
- id (PK)
- user_id (FK → users)
- action (created, updated, deleted)
- entity_type (User, Alat, Kategori, Peminjaman)
- entity_id
- detail (JSON)
- ip_address
- created_at
```

---

## 🔒 Authorization Rules

### Admin
- ✅ Akses semua route `/admin/*`
- ✅ Bisa CRUD user, alat, kategori
- ✅ Bisa manage semua peminjaman/pengembalian
- ✅ Bisa lihat semua aktivitas log

### Petugas
- ✅ Akses semua route `/petugas/*`
- ✅ Bisa setujui/tolak peminjaman
- ✅ Bisa catat pengembalian
- ✅ Bisa generate laporan
- ❌ Tidak bisa CRUD user/alat/kategori

### Peminjam
- ✅ Akses semua route `/peminjam/*`
- ✅ Bisa lihat daftar alat
- ✅ Bisa ajukan peminjaman
- ✅ Bisa kembalikan alat
- ✅ Hanya bisa lihat peminjaman miliknya
- ❌ Tidak bisa lihat peminjaman user lain

---

## 📝 Request/Response Examples

### Login
```
POST /login
Content-Type: application/x-www-form-urlencoded

email=admin@pinjamdulu.com&password=password

Response: 302 Redirect to /dashboard
```

### Create Peminjaman (Peminjam)
```
POST /peminjam/peminjamans
Content-Type: application/x-www-form-urlencoded

alat_id=1&tanggal_peminjaman=2025-02-15&tanggal_kembali=2025-02-20&keterangan=Untuk praktik

Response: 
- 422 (validation error)
- 201 Redirect to /peminjam/peminjamans/{id}
```

### Approve Peminjaman (Petugas/Admin)
```
POST /petugas/peminjamans/{peminjaman}/approve
Content-Type: application/x-www-form-urlencoded

Response: 302 Redirect to /petugas/peminjamans
```

---

## 🧪 Testing Routes

Untuk test, gunakan demo credentials:

```bash
# Terminal 1: Start server
php artisan serve

# Terminal 2: Test login
curl -X POST http://localhost:8000/login \
  -d "email=admin@pinjamdulu.com&password=password"

# Test authenticated route
curl -X GET http://localhost:8000/admin/dashboard \
  --cookie "PHPSESSID=..."
```

---

**Last Updated**: February 2025  
**Version**: 1.0  
**Framework**: Laravel 11
