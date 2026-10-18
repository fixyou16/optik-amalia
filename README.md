# Optik Amalia 👓

Aplikasi web katalog dan pengelolaan toko optik yang dibangun menggunakan **Laravel 12**. Proyek ini menyediakan katalog produk, detail produk, keranjang belanja, checkout, autentikasi pengguna, serta halaman pengelolaan inventaris dan pesanan untuk admin.

**🌐 Aplikasi live:** https://optik-amalia.dockhosting.dev/

> **Penting — katalog DEMO:** Katalog awal berisi produk ilustrasi untuk demonstrasi. Harga dan stoknya hanya contoh, bukan harga jual atau persediaan Optik Amalia yang terkonfirmasi. Gambar merupakan ilustrasi dan spesifikasi produk harus diverifikasi sebelum transaksi nyata.

## 🚀 Fitur

- **Katalog produk:** daftar produk dengan kategori dan pencarian.
- **Lima kategori demo:** `frame`, `lensa`, `sunglasses`, `contact`, dan `accessories`.
- **Detail produk:** gambar, deskripsi, harga, dan informasi stok.
- **Keranjang dan checkout:** alur belanja berbasis sesi dan pembuatan pesanan.
- **Akun pengguna:** autentikasi Laravel dan rute login Google yang disiapkan; login Google memerlukan konfigurasi OAuth yang valid.
- **Inventaris admin:** tambah, ubah, lihat, dan hapus produk melalui area admin.
- **Pengelolaan pesanan:** halaman admin untuk melihat dan memperbarui status pesanan.
- **Ulasan produk:** dukungan rating dan komentar pelanggan.
- **Seeder katalog demo:** dapat dijalankan berulang kali tanpa membuat duplikat untuk produk demo yang sudah ada.

> Fitur seperti laporan keuangan lengkap, pencetakan struk, atau rekam medis mata tidak dinyatakan tersedia dalam README ini kecuali sudah diimplementasikan dan diuji di aplikasi.

## 🛠️ Teknologi

- **Backend:** PHP 8.2+ dan Laravel 12
- **Frontend:** Blade, HTML, CSS, JavaScript, Vite
- **Dependency:** Composer dan NPM
- **Database:** PostgreSQL melalui Supabase pada deployment; konfigurasi database lokal dapat disesuaikan
- **Deployment:** Docker, dengan PHP 8.3 dan Node.js 22 pada tahapan build

## 📋 Prasyarat lokal

Siapkan perangkat berikut:

- PHP **8.2 atau lebih baru** beserta ekstensi yang dibutuhkan Laravel
- Composer
- Node.js dan NPM
- Database yang didukung oleh konfigurasi Laravel (misalnya PostgreSQL atau MySQL)

## ⚙️ Menjalankan secara lokal

### 1. Clone repository

```bash
git clone https://github.com/fixyou16/optik-amalia.git
cd optik-amalia
```

### 2. Instal dependensi

```bash
composer install
npm install
npm run build
```

### 3. Siapkan file environment

Salin `.env.example` menjadi `.env`.

**Windows PowerShell:**
```powershell
Copy-Item .env.example .env
```

**Linux/macOS:**
```bash
cp .env.example .env
```

### 4. Buat application key

```bash
php artisan key:generate
```

### 5. Konfigurasikan database

Edit file `.env` dan masukkan pengaturan database lokal Anda. Contoh untuk PostgreSQL:

```dotenv
DB_CONNECTION=pgsql
DB_HOST=127.0.0.1
DB_PORT=5432
DB_DATABASE=optik_amalia
DB_USERNAME=postgres
DB_PASSWORD=password_database_anda
```

Gunakan kredensial milik Anda sendiri. Jangan commit file `.env`, password, atau secret ke GitHub.

### 6. Jalankan migrasi

Pastikan database yang dipilih sudah dibuat dan dapat diakses, kemudian jalankan:

```bash
php artisan migrate
```

### 7. Tambahkan katalog demo (opsional)

Untuk mengisi katalog contoh:

```bash
php artisan db:seed --class=ProductSeeder
```

Seeder ini hanya menambahkan produk demo yang belum ada. Ia tidak memperbarui produk demo yang sudah ada, sehingga perubahan pada produk tersebut tidak ditimpa saat seeder dijalankan lagi.

**Jangan menjalankan `php artisan db:seed` atau `php artisan migrate:fresh` secara sembarangan.** `DatabaseSeeder` pada repository ini membuat akun demo, sementara `migrate:fresh` menghapus seluruh tabel sebelum migrasi ulang. Jangan gunakan keduanya pada database produksi.

### 8. Jalankan aplikasi

```bash
php artisan serve
```

Buka http://127.0.0.1:8000/ di browser.

## 🔐 Konfigurasi login Google

Login Google memerlukan OAuth Client ID dan Client Secret dari Google Cloud Console serta redirect URI yang sesuai dengan rute callback aplikasi. Atur nilai rahasia melalui environment lokal atau pengaturan environment di penyedia hosting. **Jangan menaruh secret di repository atau README.**

Untuk deployment, pastikan redirect URI yang didaftarkan di Google Cloud Console sama persis dengan URL callback aplikasi yang benar-benar digunakan.

## 🚢 Deployment

Aplikasi live tersedia di:

https://optik-amalia.dockhosting.dev/

Repository menggunakan Dockerfile untuk membangun aset frontend, memasang dependensi PHP, menjalankan migrasi, dan menjalankan `ProductSeeder` agar katalog demo tersedia. Seeder produk tidak sama dengan `DatabaseSeeder` dan tidak dibuat untuk mengisi akun demo.

Sebelum menggunakan aplikasi untuk transaksi nyata:
- Ganti katalog demo dengan produk, harga, dan stok yang sudah diverifikasi.
- Pastikan konfigurasi database dan autentikasi di hosting benar.
- Uji alur login, keranjang, checkout, dan pengelolaan pesanan.
- Pastikan kebijakan backup dan keamanan database sudah diterapkan.

## 🛡️ Pelaporan keamanan

Jika menemukan kerentanan, jangan publikasikan kredensial, data pribadi, atau detail eksploitasi di issue publik. Hubungi maintainer repository secara privat melalui kanal GitHub yang tersedia.

## 📄 Lisensi

Repository ini menyatakan penggunaan lisensi MIT. Lihat file [LICENSE](LICENSE) jika tersedia di repository.

---

Dikelola oleh [fixyou16](https://github.com/fixyou16).
