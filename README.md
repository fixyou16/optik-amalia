```
# Optik Amalia 👓

Sistem Informasi Manajemen dan Point of Sales (POS) khusus untuk Optik Amalia. Aplikasi ini dibangun menggunakan framework [Laravel](https://laravel.com) untuk mendigitalisasi dan memudahkan pengelolaan inventaris kacamata, lensa, data pelanggan, rekam medis mata, serta transaksi penjualan harian.

**🌐 Live Demo (Akses Lokal):** [http://127.0.0.1:8000/](http://127.0.0.1:8000/) *(Catatan: Server lokal harus dijalankan terlebih dahulu)*

## 🚀 Fitur Utama

- **Manajemen Inventaris:** Pencatatan dan monitoring stok *frame* kacamata, lensa (berbagai jenis dan ukuran), serta aksesoris.
- **Data Pelanggan & Resep:** Penyimpanan data pelanggan yang terintegrasi dengan riwayat resep ukuran kacamata (minus, plus, silinder, dll).
- **Transaksi Penjualan (POS):** Sistem kasir digital untuk mencatat pesanan, memproses pembayaran, dan mencetak nota/struk.
- **Laporan Keuangan:** Pembuatan laporan penjualan harian, mingguan, bulanan, serta laporan stok barang masuk dan keluar.
- **Manajemen Pengguna:** Akses sistem dengan multi-peran (Admin, Kasir, Pemilik/Owner) dengan hak akses yang disesuaikan.

## 🛠️ Teknologi yang Digunakan

- **Backend:** Laravel (PHP)
- **Database:** MySQL / MariaDB
- **Frontend:** HTML, CSS, JavaScript
- **Package Manager:** Composer & NPM

## 📋 Prasyarat

Pastikan komputer atau server Anda sudah terinstal:
- PHP >= 8.1
- Composer
- MySQL atau MariaDB
- Node.js & NPM (untuk kompilasi aset *frontend*)

## ⚙️ Cara Instalasi

Ikuti langkah-langkah berikut untuk menjalankan proyek ini di *local environment* Anda:

1. **Clone repositori ini:**
   ```bash
   git clone [https://github.com/username-anda/optik-amalia.git](https://github.com/username-anda/optik-amalia.git)


```






1. **Masuk ke direktori proyek:**

Bashcd optik-amalia

2. **Instal dependensi PHP:**

Bashcomposer install

3. **Instal dependensi JavaScript/Node:**

Bashnpm install && npm run build

4. **Siapkan environment file:** Salin file `.env.example` menjadi `.env`.

Bashcp .env.example .env

5. **Generate *Application Key*:**

Bashphp artisan key:generate

6. **Konfigurasi Database:** Buka file `.env` dan sesuaikan kredensial database Anda:

Cuplikan kodeDB_CONNECTION=mysql

DB_HOST=127.0.0.1

DB_PORT=3306

DB_DATABASE=optik_amalia

DB_USERNAME=root

DB_PASSWORD=

7. **Jalankan Migrasi dan Seeder (jika ada):**

Bashphp artisan migrate --seed

8. **Jalankan Server Lokal:**

Bashphp artisan serve

Aplikasi sekarang dapat diakses melalui `http://127.0.0.1:8000/`.



## 🛡️ Keamanan (Vulnerabilities)


Jika Anda menemukan celah keamanan dalam sistem ini, harap jangan membuat *issue* publik. Silakan laporkan langsung melalui email ke [email-anda@example.com](https://www.google.com/search?q=mailto%3Aemail-anda%40example.com).


## 📄 Lisensi


Proyek ini adalah perangkat lunak *open-source* yang dilisensikan di bawah [MIT license](https://opensource.org/licenses/MIT).


*Commit Hash Referensi:* `5bf6ffb683cc99057b96f3c0e5198a465f0028ac`
