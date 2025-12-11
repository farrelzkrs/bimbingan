# Sistem Bimbingan Skripsi

Sistem manajemen bimbingan skripsi yang dibangun dengan Laravel 11 dan Star Admin 2 template.

## 📋 Fitur Utama

### 1. **Management Skripsi**
- CRUD (Create, Read, Update, Delete) untuk data skripsi
- Tracking status skripsi: Menunggu, Berjalan, Selesai
- Upload dokumen skripsi (PDF, DOCX)
- Relasi dengan mahasiswa dan dosen pembimbing

### 2. **Management Mahasiswa**
- CRUD untuk data mahasiswa
- Pencatatan NIM dan angkatan
- Relasi dengan user account
- Tracking skripsi mahasiswa

### 3. **Management Dosen**
- CRUD untuk data dosen pembimbing
- Pencatatan NIP dan spesialisasi
- Relasi dengan user account
- Tracking skripsi yang dibimbing

### 4. **Dashboard yang Responsif**
- Dashboard untuk Admin (Dosen) dengan statistik dan tabel skripsi
- Dashboard untuk Mahasiswa menampilkan informasi skripsi mereka
- Template Star Admin 2 untuk UI yang modern
- Sidebar navigation yang intuitif

### 5. **Authentication & Authorization**
- System login dengan role-based access control
- Admin role untuk dosen dan pendamping
- User role untuk mahasiswa
- Middleware untuk proteksi route

## 🗄️ Struktur Database

### Table: `users`
- Autentikasi dan user management
- Role: admin (dosen) atau user (mahasiswa)

### Table: `mahasiswas`
- Informasi data mahasiswa
- Fields: nama, nim, angkatan, foto
- Foreign Key: user_id

### Table: `dosens`
- Informasi data dosen pembimbing
- Fields: nama, nip, spesialisasi, foto
- Foreign Key: user_id

### Table: `skripsis` (Ganti dari `proyeks`)
- Informasi skripsi mahasiswa
- Fields: judul, deskripsi, dokumen, status
- Foreign Keys: mahasiswa_id, dosen_id

## 📊 Relasi Data

```
User (1) ──┬──> Mahasiswa (1)
           │
           └──> Dosen (1)

Mahasiswa (1) ──┬──> Skripsi (1)
                │
                └──> User (1)

Dosen (1) ──┬──> Skripsi (Many)
            │
            └──> User (1)

Skripsi (Many) ──┬──> Mahasiswa (1)
                 │
                 └──> Dosen (1)
```

## 🎯 Route Utama

### Public Routes
- `GET /` - Login page
- `POST /login` - Login
- `POST /logout` - Logout

### Protected Routes (Auth)
- `GET /dashboard` - Main dashboard
- `GET /profile` - Edit profile
- `GET /mahasiswa/profile` - Profil mahasiswa
- `GET /dosen/profile` - Profil dosen
- `GET /my-projects` - Daftar skripsi saya

### Admin Routes (Auth + Admin Middleware)
- `GET /skripsi` - Daftar skripsi
- `POST /skripsi` - Buat skripsi
- `GET /skripsi/create` - Form tambah skripsi
- `GET /skripsi/{id}/edit` - Form edit skripsi
- `PUT /skripsi/{id}` - Update skripsi
- `DELETE /skripsi/{id}` - Hapus skripsi

- `GET /mahasiswa` - Daftar mahasiswa
- `POST /mahasiswa` - Buat mahasiswa
- `GET /mahasiswa/create` - Form tambah mahasiswa
- `GET /mahasiswa/{id}/edit` - Form edit mahasiswa
- `PUT /mahasiswa/{id}` - Update mahasiswa
- `DELETE /mahasiswa/{id}` - Hapus mahasiswa

- `GET /dosen` - Daftar dosen
- `POST /dosen` - Buat dosen
- `GET /dosen/create` - Form tambah dosen
- `GET /dosen/{id}/edit` - Form edit dosen
- `PUT /dosen/{id}` - Update dosen
- `DELETE /dosen/{id}` - Hapus dosen

## 👥 Data Seeder

Sistem dilengkapi dengan seeder yang membuat data sample:

### Dosen (4 records)
1. Dr. Ari Santoso - Sistem Informasi
2. Dr. Lina Putri - Kecerdasan Buatan
3. Prof. Budi Hartono - Basis Data
4. Dr. Siti Rahayu - Jaringan Komputer

### Mahasiswa (6 records)
1. Andi Pratama (2023001) - Angkatan 2023
2. Siti Nurhaliza (2023002) - Angkatan 2023
3. Roni Wijaya (2023003) - Angkatan 2023
4. Dina Kusuma (2023004) - Angkatan 2023
5. Fajar Hermawan (2024001) - Angkatan 2024
6. Nisa Rahmatika (2024002) - Angkatan 2024

### Skripsi (6 records)
Setiap mahasiswa memiliki satu skripsi dengan status bervariasi (pending, ongoing, completed)

## 🚀 Setup & Installation

### Prasyarat
- PHP 8.1+
- MySQL/MariaDB
- Composer
- Node.js & npm

### Instalasi

1. **Clone repository**
```bash
cd c:\XAMPP\htdocs\bimbingan
```

2. **Install dependencies**
```bash
composer install
npm install
```

3. **Setup environment**
```bash
cp .env.example .env
php artisan key:generate
```

4. **Database setup**
```bash
php artisan migrate:fresh --seed
```

5. **Jalankan development server**
```bash
php artisan serve
```

Server akan berjalan di `http://127.0.0.1:8000`

## 📝 Credentials Default

### Admin (Dosen)
- Email: `ari.santoso@example.test`
- Password: `password`
- Role: Admin

### Mahasiswa
- Email: `andi.pratama@example.test`
- Password: `password`
- Role: User

## 🎨 Template & Design

- **Template**: Star Admin 2 Free Admin Template
- **CSS Framework**: Bootstrap 5
- **Icons**: Material Design Icons, Font Awesome
- **Responsive Design**: Mobile-first approach

## 📂 Struktur Folder

```
app/
├── Http/
│   ├── Controllers/
│   │   ├── SkripsiController.php
│   │   ├── MahasiswaController.php
│   │   ├── DosenController.php
│   │   └── ...
│   └── Middleware/
│       └── AdminMiddleware.php
└── Models/
    ├── Skripsi.php
    ├── Mahasiswa.php
    ├── Dosen.php
    └── User.php

database/
├── migrations/
│   ├── create_mahasiswas_table.php
│   ├── create_dosens_table.php
│   └── create_skripsis_table.php
└── seeders/
    └── DatabaseSeeder.php

resources/
└── views/
    ├── dashboard.blade.php
    ├── skripsi/
    │   ├── index.blade.php
    │   ├── create.blade.php
    │   └── edit.blade.php
    ├── mahasiswa/
    │   ├── index.blade.php
    │   ├── create.blade.php
    │   ├── edit.blade.php
    │   └── profile.blade.php
    └── dosen/
        ├── index.blade.php
        ├── create.blade.php
        ├── edit.blade.php
        └── profile.blade.php

routes/
├── web.php
├── auth.php
└── ...
```

## 🔧 Customization

### Mengganti Nama Proyek
Edit `config/app.name` atau file `.env` untuk mengubah nama aplikasi

### Menambah Field pada Skripsi
1. Buat migration: `php artisan make:migration add_field_to_skripsis_table`
2. Update model Skripsi
3. Update form di view

### Menambah Route Baru
Edit `routes/web.php` dan tambahkan resource atau route yang diperlukan

## 📧 Kontak & Support

Untuk pertanyaan atau saran, silakan hubungi tim development.

## 📄 Lisensi

MIT License - 2025

---

**Terakhir diupdate**: 11 Desember 2025
**Versi**: 1.0
