# Aplikasi Peminjaman Alat Kampus

Sistem informasi berbasis web untuk memudahkan proses peminjaman alat-alat kampus seperti proyektor, microphone, sound system, dan lain-lain. Dikembangkan menggunakan framework Laravel dengan metode Waterfall.

## Latar Belakang

Di lingkungan kampus, mahasiswa dan organisasi sering membutuhkan alat penunjang acara. Namun, sistem manual sering menyebabkan masalah seperti:

- Duplikasi peminjaman
- Ketidakteraturan pencatatan
- Minimnya informasi ketersediaan alat

Aplikasi ini dirancang untuk menyelesaikan permasalahan tersebut secara efisien dan terdokumentasi dengan baik.

## Tujuan

- Mempermudah proses peminjaman dan pengembalian alat
- Menyediakan informasi ketersediaan alat secara real-time
- Menghindari bentrok jadwal penggunaan alat

## Metodologi Pengembangan

Metode yang digunakan adalah **Waterfall** dengan tahapan:

1. Analisis Kebutuhan Sistem  
2. Perancangan Sistem  
3. Implementasi Sistem (Laravel/PHP)  
4. Pengujian Sistem  
5. Deployment dan Maintenance  

## Fitur Utama

- Registrasi & Login Pengguna (Mahasiswa & Admin)
- Dashboard Mahasiswa dan Admin
- Form Peminjaman Alat
- Manajemen Alat & Jadwal Peminjaman
- Status Ketersediaan Alat
- Riwayat Peminjaman
- Notifikasi Persetujuan & Pengingat
- Laporan Kerusakan Alat

## Deskripsi Fitur

### Registrasi & Login
Mahasiswa dan admin dapat mendaftar/login. Role pengguna menentukan akses menu.

### Dashboard
- Mahasiswa: Lihat alat tersedia, pinjam alat, lihat riwayat, notifikasi
- Admin: Lihat permintaan, kelola alat, kelola jadwal, tangani kerusakan

### Form Peminjaman
Mahasiswa memilih alat, tanggal pinjam/kembali, dan mengisi tujuan peminjaman.

### Manajemen Alat
Admin dapat menambah/edit/hapus alat, menyetujui peminjaman, melihat jadwal, dan status alat.

### Ketersediaan Alat
Status real-time: tersedia, dipinjam, rusak, atau dalam pemeliharaan.

### Riwayat
Daftar lengkap peminjaman oleh pengguna, termasuk tanggal pinjam/kembali dan status.

### Notifikasi
Status peminjaman dikirim ke pengguna, termasuk pengingat pengembalian dan laporan kerusakan.

### Laporan Kerusakan
Pengguna dapat melaporkan kerusakan alat disertai detail dan dokumentasi.

## Teknologi yang Digunakan

| Komponen   | Teknologi               |
|------------|-------------------------|
| Frontend   | HTML, CSS, JavaScript   |
| Backend    | Laravel (PHP Framework) |
| Database   | MySQL                   |
| Web Server | Apache (XAMPP/Laragon)  |

## Cara Menjalankan Proyek
1. git clone https://github.com/laurensiusryann/website-peminjaman-alat.git
2. composer install
3. cp .env.example .env
4. buka env, ganti DB_DATABASE misal jadi web_peminjaman, ctrl+s atau save
5. php artisan key:generate
6. php artisan migrate
7. php artisan serve
