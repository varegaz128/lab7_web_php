# Laporan Praktikum 7 - Pemrograman Web (PHP Server-Side)

## 1. Tujuan Praktikum
- Memahami konsep dasar pemrosesan *server-side* menggunakan bahasa pemrograman PHP.
- Menguasai penggunaan variabel, operator, percabangan, perulangan, dan fungsi pada PHP.
- Mampu mengolah data formulir (*form processing*) menggunakan metode `GET` dan `POST`.
- Menerapkan validasi data di sisi server (*server-side validation*) serta pencegahan celah keamanan XSS (*Cross-Site Scripting*).

---

## 2. Perangkat & Lingkungan Pengembangan
- **Web Server:** XAMPP (Apache Web Server & PHP 8.x)
- **Code Editor:** Visual Studio Code
- **Web Browser:** Google Chrome / Microsoft Edge
- **Sistem Operasi:** Windows

---

## 3. Petunjuk Menjalankan Server Lokal
1. Pastikan folder proyek bernama `Lab7Web_PHP` sudah diletakkan di dalam direktori `htdocs` XAMPP:
   `C:\xampp\htdocs\Lab7Web_PHP\`
2. Buka aplikasi **XAMPP Control Panel**.
3. Pada modul **Apache**, klik tombol **Start** hingga indikator berubah menjadi warna hijau dan port (80, 443) tampil.
4. Buka browser dan jalankan URL berikut sesuai dengan file yang ingin diuji:
   - **Latihan 1 – 7:** [http://localhost/Lab7Web_PHP/index.php](http://localhost/Lab7Web_PHP/index.php)
   - **Mini Project & Eksperimen Mandiri:** [http://localhost/Lab7Web_PHP/index2.php](http://localhost/Lab7Web_PHP/index2.php)

---

## 4. Struktur File Proyek
```text
Lab7Web_PHP/
├── index.php     # Menggabungkan Latihan 1 hingga Latihan 7 (Variabel, Loop, Function, GET, POST, Pengolahan Data)
├── index2.php    # Menggabungkan Mini Project (Form Data Mahasiswa) dan Eksperimen Mandiri 1–5
└── README.md     # Dokumentasi resmi praktikum
```

---

## 5. Ringkasan Hasil Pengujian & Validasi

### A. Pengujian Latihan 1–7 (`index.php`)
- **Latihan 1:** Berhasil menampilkan teks dan waktu server dinamis.
- **Latihan 2:** Berhasil menghitung nilai akhir ($84.90$) dan menentukan predikat nilai (**B**).
- **Latihan 3:** Iterasi daftar mahasiswa menggunakan `foreach` di dalam elemen HTML `<ol>`.
- **Latihan 4:** Mengujikan fungsi diskon harga dengan keluaran angka berformat Rupiah.
- **Latihan 5 & 6:** Pengiriman data form menggunakan metode `GET` (terlihat di URL) dan `POST` (tersembunyi pada HTTP Body).
- **Latihan 7:** Pengolahan data transaksi barang dengan pencetakan subtotal secara *server-side*.

### B. Mini Project & Eksperimen Mandiri (`index2.php`)
- **Form Data Mahasiswa:** Memverifikasi kolom wajib diisi, format email menggunakan `filter_var()`, serta semester dalam rentang 1–14 menggunakan `ctype_digit()`.
- **Sanitasi XSS:** Penggunaan `htmlspecialchars()` mencegah eksekusi tag HTML/Script berbahaya dari input pengguna.
- **Validasi NIM:** Mengecek apakah NIM persis terdiri dari 10 digit angka.
- **Tombol Reset:** Menjelaskan perbedaan pembersihan form secara *client-side* (tanpa request HTTP) dibanding pemrosesan *server-side*.

---

## 6. Kasus Pengujian Input

| Kategori | Input Contoh | Hasil Ekspektasi Server | Status Validasi |
| :--- | :--- | :--- | :--- |
| **Valid 1** | Nama: Tegar, NIM: 3125100310, Semester: 3, Email: tegar@example.com | Data diterima, ringkasan tampil bersih | **BERHASIL** |
| **Valid 2** | Nama: Siti, NIM: 1234567890, Semester: 14, Email: siti@domain.ac.id | Data diterima (berada pada batas maksimum rentang) | **BERHASIL** |
| **Invalid 1** | Email: `budi.gmail.com` (tanpa `@`) | Penolakan oleh `filter_var()`, pesan error dipicu | **GAGAL (Sesuai)** |
| **Invalid 2** | NIM: `ABC12345`, Semester: `18` | `ctype_digit()` atau batas semester (1-14) gagal | **GAGAL (Sesuai)** |

---
*Dokumentasi Praktikum 7 - Pemrograman Web OBE*