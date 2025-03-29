# AntrianKu - Sistem Manajemen Antrian

AntrianKu adalah sistem manajemen antrian berbasis web yang membantu bisnis mengelola antrian pelanggan secara efisien di berbagai bagian. Sistem ini menyediakan tampilan nomor antrian real-time, kontrol admin, dan antarmuka yang ramah pengguna untuk pelanggan dan administrator.

## Fitur

- Tampilan nomor antrian real-time untuk beberapa bagian (A, B, C)
- Pembaruan nomor antrian otomatis setiap 5 detik
- Dashboard admin untuk manajemen antrian
- Sistem autentikasi pengguna
- Cetak tiket antrian
- Pengumuman audio untuk nomor antrian
- Desain responsif menggunakan Bootstrap 5
- Database SQLite untuk penyimpanan data ringan
- API RESTful untuk pembaruan antrian

## Persyaratan

- PHP 7.4 atau lebih tinggi
- SQLite3
- Web server (Apache/Nginx)
- Browser web modern dengan JavaScript diaktifkan
- Izin tulis untuk file `queue.db`
- Kemampuan pemutaran audio untuk pengumuman antrian

## Instalasi

1. Clone repositori ke direktori web server Anda:
```bash
git clone https://github.com/uthadehikaru/antrianku.git
```

2. Atur web server Anda (Apache/Nginx) untuk menunjuk ke direktori proyek

3. Atur izin yang sesuai:
```bash
chmod 755 -R /path/to/antrianku
chmod 777 queue.db
```

4. Konfigurasi web server Anda untuk menangani file PHP

5. Akses aplikasi melalui browser web Anda:
```
http://localhost/antrianku
```

### Menjalankan Tanpa Web Server

Anda juga dapat menjalankan aplikasi tanpa menginstal web server menggunakan PHP built-in server:

1. Buka terminal/command prompt
2. Masuk ke direktori proyek:
```bash
cd /path/to/antrianku
```

3. Jalankan server PHP:
```bash
php -S localhost:8000
```

4. Buka browser dan akses:
```
http://localhost:8000
```

> **Catatan**: Server built-in PHP hanya direkomendasikan untuk pengembangan dan pengujian. Untuk penggunaan produksi, gunakan web server seperti Apache atau Nginx.

## Konfigurasi

1. Kredensial admin default:
   - Username: admin
   - Password: admin123
   (Silakan ubah kredensial ini setelah login pertama)

2. Konfigurasi database:
   - Sistem menggunakan SQLite3 dengan file database `queue.db`
   - Tidak diperlukan konfigurasi database tambahan

3. Pengaturan audio:
   - File audio disimpan di direktori `audio/`
   - Format yang didukung: MP3, WAV

## Struktur File

- `index.php` - Halaman tampilan utama nomor antrian
- `admin.php` - Dashboard admin untuk manajemen antrian
- `login.php` - Halaman login admin
- `form.php` - Formulir untuk menambah nomor antrian baru
- `api.php` - Endpoint API untuk pembaruan antrian
- `function.php` - Fungsi inti dan operasi database
- `print.php` - Fungsi cetak tiket antrian
- `queue.db` - File database SQLite
- `bootstrap/` - File framework CSS Bootstrap
- `audio/` - File audio untuk pengumuman antrian
- `navbar.php` - Komponen bar navigasi
- `logout.php` - Fungsi logout

## Penggunaan

### Untuk Pelanggan
1. Kunjungi halaman utama untuk melihat nomor antrian saat ini
2. Nomor antrian diperbarui secara otomatis setiap 5 detik
3. Dengarkan pengumuman audio untuk nomor antrian
4. Nomor antrian ditampilkan dalam format: BAGIAN + 3 digit angka (contoh: A001)

### Untuk Administrator
1. Login melalui panel admin di `/login.php`
2. Kelola nomor antrian untuk berbagai bagian
3. Cetak tiket antrian
4. Pantau status antrian
5. Reset nomor antrian saat diperlukan

## Keamanan

- Autentikasi admin diperlukan untuk fungsi manajemen
- Database SQLite untuk penyimpanan data yang aman
- Validasi dan sanitasi input diimplementasikan
- Autentikasi berbasis sesi
- Tindakan perlindungan XSS

2. Jika audio tidak dimainkan:
   - Verifikasi file audio ada di direktori `audio/`
   - Periksa izin audio browser
   - Pastikan file audio dalam format yang didukung

## Lisensi

Proyek ini dilisensikan di bawah Lisensi MIT - lihat file LICENSE untuk detail.

## Dukungan

Untuk dukungan, silakan buka issue di repositori GitHub atau hubungi pengelola. 