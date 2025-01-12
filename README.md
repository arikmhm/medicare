# MediCare - Healthcare Management System

## Overview

MediCare adalah sistem manajemen kesehatan sederhana yang dapat mengelola data pasien, dokter, dan obat. Aplikasi ini dibuat menggunakan PHP, MySQL, dan Bootstrap dengan fitur-fitur dasar untuk pengelolaan data kesehatan.

## Fitur Utama

- Manajemen Data Pasien
- Manajemen Data Dokter
- Manajemen Data Obat
- Dashboard dengan visualisasi data
- Authentication system
- Responsive design

## Teknologi yang Digunakan

- PHP 7.4+
- MySQL 5.7+
- Bootstrap 4
- Chart.js untuk visualisasi data
- FontAwesome 5 untuk icons
- jQuery 3.3.1

## Cara Install

1. **Download File Zip**

   - Unduh file zip dari repositori atau sumber yang telah disediakan.

2. **Ekstrak File**

   - Ekstrak file zip yang telah diunduh ke lokasi yang diinginkan.

3. **Simpan ke Folder htdocs XAMPP**

   - Pindahkan folder hasil ekstraksi ke dalam direktori `htdocs` pada XAMPP.

4. **Buat Database**

   - Buka phpMyAdmin melalui XAMPP.
   - Buat database baru dengan nama `medicare`.

5. **Import File SQL**

   - Masuk ke database yang telah dibuat.
   - Pilih menu "Import" dan unggah file `medicare.sql` yang berada di dalam folder `database`.

6. **Start XAMPP**

   - Jalankan Apache dan MySQL di panel kontrol XAMPP.

7. **Jalankan di Browser**
   - Buka browser dan akses URL: `http://localhost/medicare`

## Struktur Database

1. **Tabel users**

   - id (Primary Key)
   - username
   - password
   - created_at

2. **Tabel pasien**

   - id (Primary Key)
   - nomor_rm (Unique)
   - nama_lengkap
   - tanggal_lahir
   - jenis_kelamin (Enum: 'L', 'P')
   - alamat
   - nomor_telepon
   - golongan_darah (Enum: 'A', 'B', 'AB', 'O')
   - created_at
   - updated_at

3. **Tabel dokter**

   - id (Primary Key)
   - kode_dokter (Unique)
   - nama_lengkap
   - spesialisasi
   - no_str (Unique)
   - jenis_kelamin (Enum: 'L', 'P')
   - no_telepon
   - alamat
   - created_at
   - updated_at

4. **Tabel obat**
   - id (Primary Key)
   - kode_obat (Unique)
   - nama_obat
   - jenis_obat (Enum: 'Tablet', 'Kapsul', 'Sirup', 'Salep', 'Injeksi')
   - stok
   - harga_satuan
   - tanggal_kadaluarsa
   - keterangan
   - created_at
   - updated_at

## Struktur Folder

```
medicare/
├── bootstrap4/          # File-file Bootstrap
├── css/                 # File CSS custom
├── database/           # File SQL
├── assets/             # Aset gambar dan lainnya
├── fungsi.php          # File koneksi database
├── index.php           # Halaman login
├── dashboard.php       # Halaman dashboard
├── pasien.php          # Halaman manajemen pasien
├── dokter.php          # Halaman manajemen dokter
├── obat.php            # Halaman manajemen obat
└── README.md
```

## Login Default

- Username: admin
- Password: admin

## Panduan Penggunaan

1. Login menggunakan akun default
2. Dashboard menampilkan statistik dan visualisasi data
3. Menu Pasien untuk mengelola data pasien
4. Menu Dokter untuk mengelola data dokter
5. Menu Obat untuk mengelola data obat

## Catatan Penting

- Pastikan XAMPP versi terbaru sudah terinstal
- PHP minimum versi 7.4
- MySQL minimum versi 5.7
- Browser modern yang mendukung JavaScript ES6
- Pastikan folder memiliki permission yang tepat
- Sesuaikan konfigurasi database di file `fungsi.php` jika diperlukan
- Gunakan data dummy yang disediakan untuk testing

## Kontribusi

## Lisensi

MIT License
