<div align="center">
  <a href="https://laravel.com" target="_blank">
    <img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo">
  </a>

  <h1 align="center">📚 Aplikasi Manajemen Perpustakaan 📚</h1>

  <p align="center">
    Sebuah aplikasi full-stack berbasis Laravel untuk mengelola inventaris buku, keanggotaan, dan transaksi peminjaman di perpustakaan kampus.
  </p>

  <p align="center">
    <img src="https://img.shields.io/badge/PHP-8.2%2B-blue.svg?style=for-the-badge&logo=php" alt="PHP 8.2+">
    <img src="https://img.shields.io/badge/Laravel-12.x-red.svg?style=for-the-badge&logo=laravel" alt="Laravel 12.x">
    <img src="https://img.shields.io/badge/Bun-JS-yellow.svg?style=for-the-badge&logo=bun" alt="Bun">
    <img src="https://img.shields.io/badge/MySQL-DB-orange.svg?style=for-the-badge&logo=mysql" alt="MySQL">
    <img src="https://img.shields.io/badge/License-MIT-green.svg?style=for-the-badge" alt="License: MIT">
  </p>
</div>

---

## 🚀 Fitur Utama

Aplikasi ini mencakup fungsionalitas admin yang lengkap, termasuk:

* **Dashboard Utama:** Menampilkan statistik kunci (Total Buku, Kategori, Rak).
* **Layout Modern:** *Sidebar* yang *minimizeable* dan *toggle Dark Mode*.
* **Manajemen Inventaris (Full CRUD):**
    * Manajemen Buku (termasuk *upload cover*).
    * Manajemen Kategori.
    * Manajemen Rak.
* **Manajemen Keanggotaan (Full CRUD):**
    * Didesain untuk kampus (NIM/NIDN, Tipe Anggota).
* **Manajemen Transaksi (Core System):**
    * Fitur **Peminjaman Buku** (mengurangi stok buku secara otomatis).
    * Fitur **Pengembalian Buku** (menambah stok buku secara otomatis).
* **Manajemen Keuangan:**
    * Perhitungan **Denda Keterlambatan** otomatis saat pengembalian.
* **Pusat Laporan (6 Jenis):**
    1.  Laporan Inventaris Buku (dengan filter per kategori).
    2.  Laporan Data Anggota.
    3.  Laporan Buku Terpopuler.
    4.  Laporan Anggota Teraktif.
    5.  Laporan Pemasukan Denda.
    6.  Laporan Keterlambatan (Buku yang belum kembali & telat).
* **Validasi Data:** Mencegah penghapusan data master (Kategori, Rak, Anggota) jika masih terkait dengan data lain.

---

## 1. Prasyarat (Prerequisites)

Pastikan perangkat Anda telah terinstal perangkat lunak berikut:

* **Server Lokal:** XAMPP, MAMP, atau Laragon (yang menyertakan PHP, MySQL, dan phpMyAdmin).
* **Composer:** *Dependency manager* untuk PHP.
* **Bun** (atau **NPM** / **Yarn**): *Package manager* untuk JavaScript.

---

## 2. ⚙️ Langkah-langkah Instalasi

Ikuti langkah-langkah berikut secara berurutan.

### Langkah 1: Ekstrak Proyek
Ekstrak file `.zip` proyek ini ke direktori kerja Anda (misalnya, `htdocs` di XAMPP atau folder proyek kustom Anda).

### Langkah 2: Konfigurasi Database (Import)

Proyek ini menggunakan *database dump* (`.sql`) yang sudah berisi data. Anda **tidak perlu** menjalankan `php artisan migrate`.

1.  Jalankan server lokal (XAMPP/MAMP). Pastikan **MySQL** sudah berjalan.
2.  Buka **phpMyAdmin**.
3.  Buat *database* baru dengan nama persis: <strong>`proyek_perpus`</strong>. (Pastikan *collation* diatur ke `utf8mb4_general_ci`).
4.  Buka *database* `proyek_perpus` yang baru saja Anda buat.
5.  Klik *tab* **"Import"**.
6.  Klik **"Choose File"** dan pilih file **`proyek_perpus.sql`** yang disertakan bersama proyek ini.
7.  Klik tombol **"Import"** (atau "Go") di bagian bawah halaman.

> **Penting:** Setelah proses impor selesai, *database* Anda sudah siap dengan semua tabel dan data yang diperlukan.

### Langkah 3: Konfigurasi Environment (`.env`)

File `.env` berisi konfigurasi koneksi *database* dan *key* aplikasi.

1.  Di dalam folder proyek, buka file **`.env`** (file ini sudah disertakan).
2.  Temukan dan sesuaikan bagian konfigurasi *database* (`DB_...`) agar sesuai dengan pengaturan server lokal (XAMPP/MAMP) Anda:

    ```env
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=8889
    DB_DATABASE=proyek_perpus
    DB_USERNAME=root
    DB_PASSWORD=root
    ```

3.  **Perhatian:**
    * **Jika menggunakan XAMPP:** `DB_PORT` biasanya **`3306`** dan `DB_PASSWORD` biasanya **kosong** (contoh: `DB_PASSWORD=`).
    * **Jika menggunakan MAMP:** Pengaturan di atas (Port `8889`, Password `root`) biasanya sudah benar.

### Langkah 4: Instalasi Dependensi

Buka Terminal atau Command Prompt di dalam direktori utama proyek.

1.  Jalankan perintah berikut untuk menginstal semua *library* PHP (membuat folder `vendor/`):
    ```bash
    composer install
    ```

2.  Jalankan perintah berikut untuk menginstal semua *library* JavaScript (membuat folder `node_modules/`):
    ```bash
    bun install
    ```

### Langkah 5: Finalisasi Proyek

Setelah dependensi terinstal, jalankan dua perintah terakhir ini:

1.  Buat *symlink* agar file *cover* buku yang di-*upload* bisa diakses oleh publik:
    ```bash
    php artisan storage:link
    ```

2.  *Compile* (kompilasi) file CSS dan JavaScript untuk mode produksi:
    ```bash
    bun run build
    ```
    > **Catatan:** Aplikasi ini dirancang untuk berjalan pada mode produksi (setelah di-*build*). Menjalankan `bun run dev` (mode *development*) tidak diperlukan dan dapat menyebabkan *glitch* tampilan pada beberapa *environment*.

---

## 3. 🚀 Menjalankan Aplikasi

Setelah semua langkah instalasi selesai, aplikasi siap dijalankan.

1.  Di terminal Anda, jalankan server *development* Laravel:
    ```bash
    php artisan serve
    ```

2.  Buka *browser* Anda dan akses alamat:
    <h3><a href="http://localhost:8000">http://localhost:8000</a></h3>

Aplikasi akan otomatis mengarahkan Anda ke halaman *login*.

---

## 4. 🔑 Akun Admin Bawaan

Anda dapat *login* menggunakan akun *administrator* bawaan yang telah disiapkan di *database*:

| Email | Password |
| :--- | :--- |
| `admin@admin.com` | `Admin123` |

---

<div align="center">
  <p>Proyek ini dilisensikan di bawah <a href="LICENSE">Lisensi MIT</a>.</p>
</div>