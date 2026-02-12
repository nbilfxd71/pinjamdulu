# 🧪 Pinjamdulu - Testing Guide

Panduan lengkap untuk testing setiap fitur dan role dalam Pinjamdulu.

---

## 📋 Pre-Testing Setup

### 1. Database & Seed
```bash
# Terminal di folder project
php artisan migrate:refresh --seed
```

**Output yang diharapkan:**
- ✅ 9 migrations berhasil
- ✅ 1 Admin user dibuat
- ✅ 1 Petugas user dibuat  
- ✅ 5 Peminjam users dibuat
- ✅ 4 Kategori dibuat
- ✅ 10 Alat dengan berbagai stok dibuat

### 2. Start Development Server
```bash
php artisan serve
```

**Output yang diharapkan:**
```
Laravel development server started: http://127.0.0.1:8000
```

### 3. Open Browser
Kunjungi `http://localhost:8000`

---

## 🏠 Homepage Testing

### Expected Result
- [ ] Logo dan title "Pinjamdulu" terlihat
- [ ] Feature cards terlihat (3 Role Sistem, Manajemen Alat, Tracking Real-time)
- [ ] Button "Login" dan "Daftar" terlihat
- [ ] Demo credentials ditampilkan
- [ ] Button bergradient (ungu ke pink)

---

## 🔐 Authentication Testing

### Test 1: Register (New User)
```
Path: /register
```

**Steps:**
1. Klik tombol "Daftar"
2. Isi form:
   - Name: "Test User"
   - Email: "testuser@test.com"
   - Password: "password123"
   - Confirm Password: "password123"
   - Nomor Identitas: "1234567890"
   - Alamat: "Jl. Test, Jakarta"
   - No Telepon: "081234567890"
3. Klik "Daftar"

**Expected Result:**
- [ ] User baru berhasil dibuat
- [ ] Role otomatis "peminjam"
- [ ] Redirect ke dashboard
- [ ] Session aktif sebagai logged in user

### Test 2: Login (Admin)
```
Path: /login
```

**Steps:**
1. Klik "Login"
2. Masukkan:
   - Email: `admin@pinjamdulu.com`
   - Password: `password`
3. Klik "Login"

**Expected Result:**
- [ ] Login berhasil
- [ ] Redirect ke Admin Dashboard (`/admin/dashboard`)
- [ ] Session sebagai admin aktif
- [ ] Sidebar admin terlihat dengan menu lengkap

### Test 3: Logout
**Steps:**
1. Klik tombol "Logout" (biasanya di sidebar)
2. Atau POST ke `/logout`

**Expected Result:**
- [ ] Session dihapus
- [ ] Redirect ke homepage
- [ ] Login button terlihat kembali

---

## 👨‍💼 Admin Testing

Login sebagai: `admin@pinjamdulu.com / password`

### Dashboard Test
**Path:** `/admin/dashboard`

**Steps:**
1. Lihat halaman dashboard

**Expected Result:**
- [ ] Stat cards menampilkan:
  - Total Users (5 peminjam)
  - Total Alat (10)
  - Total Peminjaman
  - Peminjaman Pending
  - Peminjaman Disetujui
  - Peminjaman Dikembalikan
- [ ] Activity log menampilkan 10 aktivitas terbaru
- [ ] Sidebar navigation tertampil dengan semua menu

### User Management Test

#### Create User
**Path:** `/admin/users` → "Tambah User"

**Steps:**
1. Klik "Tambah User"
2. Isi form:
   - Name: "New Petugas"
   - Email: "newpetugas@test.com"
   - Password: "password"
   - Role: "petugas"
   - Nomor Identitas: "1234567890"
   - Alamat: "Jl. Petugas, Jakarta"
   - No Telepon: "081234567890"
3. Klik "Simpan"

**Expected Result:**
- [ ] User baru berhasil dibuat
- [ ] Redirect ke user list
- [ ] New user muncul di tabel
- [ ] Activity log mencatat: "Created User: New Petugas"

#### Edit User
**Steps:**
1. Di halaman user list, cari user
2. Klik "Edit" (icon pensil)
3. Ubah nama menjadi "Updated Petugas"
4. Klik "Simpan"

**Expected Result:**
- [ ] User berhasil di-update
- [ ] Redirect ke user list
- [ ] Nama di tabel berubah
- [ ] Activity log mencatat update

#### Delete User
**Steps:**
1. Di halaman user list, cari user untuk dihapus
2. Klik "Hapus" (icon trash)
3. Confirm di modal
4. Klik "Ya, Hapus"

**Expected Result:**
- [ ] User berhasil dihapus
- [ ] User hilang dari tabel
- [ ] Activity log mencatat deletion

### Kategori Management Test

#### Create Kategori
**Path:** `/admin/kategoris` → "Tambah Kategori"

**Steps:**
1. Klik "Tambah Kategori"
2. Isi:
   - Nama: "Peralatan Elektronik"
   - Deskripsi: "Alat-alat elektronik untuk lab"
3. Klik "Simpan"

**Expected Result:**
- [ ] Kategori baru muncul di list
- [ ] Activity log mencatat creation

#### CRUD Operations
- [ ] Edit kategori: nama berubah di list
- [ ] Delete kategori: hilang dari list

### Alat Management Test

#### Create Alat
**Path:** `/admin/alats` → "Tambah Alat"

**Steps:**
1. Klik "Tambah Alat"
2. Isi form:
   - Nama: "Multimeter Digital"
   - Kategori: "Peralatan Laboratorium"
   - Nomor Seri: "MM-2025-001"
   - Stok: 5
   - Stok Tersedia: 5
   - Kondisi: "baik"
   - Deskripsi: "Alat ukur listrik digital"
   - Tahun Perolehan: 2023
3. Klik "Simpan"

**Expected Result:**
- [ ] Alat baru muncul di list
- [ ] Stok menampilkan "5/5"
- [ ] Kategori tertelusuri dengan benar

#### Edit Alat
**Steps:**
1. Edit stok dari 5 menjadi 3
2. Ubah kondisi menjadi "rusak_ringan"
3. Simpan

**Expected Result:**
- [ ] Stok berubah di list
- [ ] Kondisi ditampilkan dengan badge
- [ ] Activity log mencatat perubahan

### Peminjaman Management Test

#### View Peminjamans
**Path:** `/admin/peminjamans`

**Expected Result:**
- [ ] List semua peminjaman dari semua user
- [ ] Status ditampilkan dengan badge:
  - 🟡 pending (yellow)
  - 🟢 disetujui (green)
  - 🔴 ditolak (red)
  - 🔵 dikembalikan (blue)
- [ ] Sorting/filtering tersedia

#### Approve Peminjaman
**Steps:**
1. Buka peminjaman dengan status "pending"
2. Klik "Setujui"
3. Confirm di modal
4. Klik "Ya, Setujui"

**Expected Result:**
- [ ] Status berubah menjadi "disetujui"
- [ ] Stok alat berkurang (peminjaman terpercaya)
- [ ] Activity log mencatat approval

#### Reject Peminjaman
**Steps:**
1. Buka peminjaman dengan status "pending"
2. Klik "Tolak"
3. Isi alasan (optional)
4. Klik "Ya, Tolak"

**Expected Result:**
- [ ] Status berubah menjadi "ditolak"
- [ ] Stok tetap
- [ ] Activity log mencatat rejection

### Pengembalian Management Test

#### Create Pengembalian
**Path:** `/admin/pengembalians` → select peminjaman → "Catat Pengembalian"

**Steps:**
1. Pilih peminjaman dengan status "disetujui"
2. Isi form:
   - Tanggal Pengembalian: (hari ini)
   - Kondisi: "baik"
   - Denda: 0 (default)
3. Klik "Simpan"

**Expected Result:**
- [ ] Pengembalian tercatat
- [ ] Status peminjaman → "dikembalikan"
- [ ] Stok alat bertambah kembali
- [ ] Pengembalian muncul di list

#### Edit Pengembalian (add denda)
**Steps:**
1. Edit pengembalian yang sudah dibuat
2. Ubah kondisi menjadi "rusak_ringan"
3. Isi Denda: 50000
4. Isi Keterangan: "Layar pecah"
5. Simpan

**Expected Result:**
- [ ] Denda tercatat
- [ ] Keterangan denda tersimpan
- [ ] Kondisi alat ter-update

### Activity Log Test

**Path:** `/admin/aktivitas`

**Expected Result:**
- [ ] List semua aktivitas user
- [ ] Setiap CRUD operation tercatat:
  - User creation/update/delete
  - Alat creation/update/delete
  - Kategori changes
  - Peminjaman approval/rejection
- [ ] User yang melakukan aksi tercatat
- [ ] Timestamp akurat
- [ ] Klik detail untuk melihat IP dan detail lengkap

---

## 👨‍💻 Petugas Testing

Login sebagai: `petugas1@pinjamdulu.com / password`

### Dashboard Test
**Path:** `/petugas/dashboard`

**Expected Result:**
- [ ] Stat cards untuk peminjaman pending
- [ ] Quick actions (Setujui Peminjaman, Catat Pengembalian)
- [ ] List peminjaman terbaru
- [ ] Sidebar petugas (berbeda dengan admin)

### Approve Peminjaman Test

**Path:** `/petugas/peminjamans`

**Steps:**
1. Lihat list peminjaman
2. Klik peminjaman "pending"
3. Review detail (user, alat, tanggal)
4. Klik "Setujui"

**Expected Result:**
- [ ] Status → "disetujui"
- [ ] Stok alat berkurang
- [ ] List ter-refresh otomatis
- [ ] Notifikasi sukses tampil

### Pengembalian Test

**Path:** `/petugas/pengembalians`

**Steps:**
1. Klik "Catat Pengembalian"
2. Pilih peminjaman dari dropdown
3. Isi kondisi alat saat dikembalikan
4. Isi denda jika ada kerusakan
5. Klik "Simpan"

**Expected Result:**
- [ ] Pengembalian tercatat
- [ ] Peminjaman status → "dikembalikan"
- [ ] Stok alat bertambah
- [ ] Pengembalian muncul di list
- [ ] Denda tercatat jika ada

### Laporan Test

**Path:** `/petugas/laporan`

**Expected Result:**
- [ ] HTML laporan tampil dengan styling
- [ ] Stat cards menampilkan:
  - Total Peminjaman
  - Total Pengembalian
  - Alat Paling Sering Dipinjam
  - Kategori dengan Peminjaman Terbanyak
- [ ] Tabel peminjaman dan pengembalian
- [ ] Tombol "Print" berfungsi

**Test Print:**
1. Klik tombol "Print"
2. Preview print window
3. Klik "Print" di dialog

**Expected Result:**
- [ ] Laporan print-ready tampil
- [ ] Styling cocok untuk print
- [ ] Bisa di-print langsung ke printer

---

## 👤 Peminjam Testing

Login sebagai: `peminjam1@pinjamdulu.com / password`

### Dashboard Test
**Path:** `/peminjam/dashboard`

**Expected Result:**
- [ ] Stat cards menampilkan:
  - Peminjaman Aktif (ongoing)
  - Peminjaman Selesai
  - Peminjaman Ditolak
- [ ] Riwayat peminjaman user
- [ ] Button "Ajukan Peminjaman Baru"

### Browse Alat Test

**Path:** `/peminjam/alats`

**Expected Result:**
- [ ] Daftar alat dengan stok > 0 ditampilkan
- [ ] Grid layout yang rapi
- [ ] Card menampilkan:
  - Gambar alat (jika ada)
  - Nama alat
  - Kategori
  - Stok tersedia
  - Tombol "Detail/Pinjam"
- [ ] Alat dengan stok=0 TIDAK ditampilkan (hidden)

#### View Alat Detail
**Steps:**
1. Klik alat
2. Lihat halaman detail

**Expected Result:**
- [ ] Detail lengkap alat tampil:
  - Nama, deskripsi
  - Kategori, nomor seri
  - Tahun perolehan
  - Stok (total/tersedia)
  - Kondisi
- [ ] Button "Ajukan Peminjaman"
- [ ] Notifikasi jika stok habis

### Ajukan Peminjaman Test

**Path:** `/peminjam/peminjamans` → "Ajukan Peminjaman"

**Steps:**
1. Klik "Ajukan Peminjaman Baru"
2. Select alat dari dropdown
3. Isi tanggal peminjaman (dari hari ini)
4. Isi tanggal kembali (10 hari kemudian)
5. Isi keterangan (optional): "Untuk praktik lab"
6. Klik "Ajukan"

**Expected Result:**
- [ ] Peminjaman tercatat dengan status "pending"
- [ ] Redirect ke list peminjaman
- [ ] Peminjaman baru muncul di list
- [ ] Status badge "Pending (menunggu approval)"

### Monitor Peminjaman Test

**Path:** `/peminjam/peminjamans`

**Steps:**
1. Lihat list peminjaman user

**Expected Result:**
- [ ] Hanya peminjaman user sendiri ditampilkan
- [ ] Peminjaman user lain TIDAK terlihat (authorization)
- [ ] Status ditampilkan dengan jelas:
  - 🟡 pending
  - 🟢 disetujui
  - 🔴 ditolak
  - 🔵 dikembalikan
- [ ] Tanggal peminjaman dan kembali terlihat

#### Peminjaman yang disetujui
**Steps:**
1. Tunggu admin/petugas menyetujui
2. Refresh halaman atau login ulang
3. Status harus berubah menjadi "disetujui"

**Expected Result:**
- [ ] Status berubah dari pending menjadi disetujui
- [ ] Button "Kembalikan" tampil
- [ ] Detail menampilkan tanggal approval

### Kembalikan Alat Test

**Path:** `/peminjam/pengembalians`

**Steps:**
1. Klik "Kembalikan Alat"
2. Atau dari halaman peminjaman, klik "Kembalikan"
3. Isi kondisi alat
4. Isi catatan (optional)
5. Klik "Kembalikan"

**Expected Result:**
- [ ] Pengembalian tercatat
- [ ] Peminjaman status → "dikembalikan"
- [ ] Pengembalian muncul di list history
- [ ] Alat bisa dipinjam lagi

### Authorization Test

**Objective**: Verifikasi peminjam TIDAK bisa akses data user lain

**Steps:**
1. Login sebagai peminjam1
2. Copy URL peminjaman peminjam2
3. Paste URL di browser: `/peminjam/peminjamans/{peminjaman_id_peminjam2}`

**Expected Result:**
- [ ] 403 Forbidden error
- [ ] Pesan "Unauthorized"
- [ ] Peminjam tidak bisa akses data user lain

---

## 🔓 Role-Based Access Control Test

### Test Admin Access
| Route | Admin | Petugas | Peminjam | Expected |
|-------|-------|---------|----------|----------|
| `/admin/dashboard` | ✅ | ❌ | ❌ | 403 Forbidden |
| `/admin/users` | ✅ | ❌ | ❌ | 403 Forbidden |
| `/admin/kategoris` | ✅ | ❌ | ❌ | 403 Forbidden |

### Test Petugas Access
| Route | Admin | Petugas | Peminjam | Expected |
|-------|-------|---------|----------|----------|
| `/petugas/dashboard` | ❌ | ✅ | ❌ | 403 Forbidden |
| `/petugas/peminjamans` | ❌ | ✅ | ❌ | 403 Forbidden |
| `/admin/users` | ❌ | ❌ | ❌ | 403 Forbidden |

### Test Peminjam Access
| Route | Admin | Petugas | Peminjam | Expected |
|-------|-------|---------|----------|----------|
| `/peminjam/dashboard` | ❌ | ❌ | ✅ | 403 Forbidden |
| `/peminjam/alats` | ❌ | ❌ | ✅ | 403 Forbidden |
| `/admin/users` | ❌ | ❌ | ❌ | 403 Forbidden |

---

## 📊 Business Logic Testing

### Stock Management Test

**Scenario**: Ajukan, setujui, dan kembalikan alat

**Initial State**:
- Alat "Multimeter" stok: 5/5

**Steps**:
1. Peminjam ajukan peminjaman Multimeter
2. Admin setujui peminjaman
3. Check stok → harus 4/5
4. Peminjam kembalikan alat
5. Check stok → harus 5/5

**Expected Result**:
- [ ] Stok berkurang saat approved
- [ ] Stok bertambah saat returned
- [ ] Tidak ada negative stok

### Peminjaman Status Flow Test

**Complete Flow**:
```
pending → disetujui → dikembalikan

Atau:

pending → ditolak (end)
```

**Test Steps**:
1. Ajukan peminjaman (status: pending)
2. Admin setujui (status: disetujui)
3. Kembalikan alat (status: dikembalikan)
4. Verify flow lengkap

**Expected Result**:
- [ ] Status transition sesuai flow
- [ ] Setiap transisi ter-log

### Activity Logging Test

**Objective**: Verifikasi setiap action dicatat

**Steps**:
1. Buat kategori baru
2. Edit kategori
3. Buat alat
4. Edit alat
5. Admin lihat aktivitas log

**Expected Result**:
- [ ] Setiap create/update/delete ter-log
- [ ] User yang melakukan tercatat
- [ ] Timestamp akurat
- [ ] Detail perubahan tersimpan

---

## 🐛 Edge Cases & Error Handling

### Test 1: Ajukan Peminjaman Alat Habis
**Steps**:
1. Alat dengan stok=0
2. Coba ajukan peminjaman

**Expected Result**:
- [ ] Alat tidak tampil di list
- [ ] Error jika coba force request

### Test 2: Login dengan Email Salah
**Steps**:
1. Masukkan email: wrong@email.com
2. Password: password
3. Submit

**Expected Result**:
- [ ] Error: "Email atau password salah"
- [ ] Tetap di halaman login

### Test 3: Password Terlalu Pendek saat Register
**Steps**:
1. Register dengan password: "123"
2. Submit

**Expected Result**:
- [ ] Validation error
- [ ] Pesan: "Password minimal 8 karakter"

### Test 4: Reject Peminjaman yang Sudah Disetujui
**Steps**:
1. Setujui peminjaman
2. Coba edit status kembali ke pending
3. Coba reject

**Expected Result**:
- [ ] Tidak bisa reject sudah disetujui
- [ ] Status tetap
- [ ] Atau only allowed pada status pending

### Test 5: Hapus User yang Punya Peminjaman Aktif
**Steps**:
1. User punya peminjaman aktif
2. Admin coba delete user
3. Submit

**Expected Result**:
- [ ] Error atau soft delete
- [ ] Data integritas terjaga
- [ ] Peminjaman tidak orphaned

---

## ✅ Checklist Akhir

- [ ] Homepage loading sempurna
- [ ] Semua 3 role bisa login
- [ ] Admin CRUD user/alat/kategori berfungsi
- [ ] Petugas bisa approve/reject peminjaman
- [ ] Petugas bisa catat pengembalian
- [ ] Peminjam bisa ajukan peminjaman
- [ ] Peminjam bisa lihat riwayat
- [ ] Stock management bekerja dengan baik
- [ ] Activity logging mencatat semua action
- [ ] Role-based access control enforce
- [ ] All forms validate correctly
- [ ] Database relationships working
- [ ] No console errors di browser DevTools
- [ ] All buttons/links working
- [ ] Responsive design pada mobile
- [ ] Laporan bisa di-generate dan di-print

---

## 🎓 Troubleshooting Common Issues

### "No User found" Error saat Login
```bash
php artisan db:seed DatabaseSeeder
```

### Stok tidak berkurang setelah approve
- Check: Admin/PeminjamanController@approve logic
- Verify: `alat.stok_tersedia--` dijalankan

### Peminjam bisa akses peminjaman user lain
- Check: PeminjamPeminjamanController authorization
- Add: `$this->authorize('view', $peminjaman);`

### Activity Log tidak ter-record
- Check: AktivitasLog::create() di setiap controller
- Verify: User ID tercatat dengan benar

### Database table tidak ada
```bash
php artisan migrate
php artisan migrate:refresh
```

---

**Happy Testing! 🎉**

Jika ada issue, cek `storage/logs/laravel.log` untuk debug info.
