# Janji
Saya Farah Diba Nur Malinda dengan NIM 2502083 mengerjakan Tugas Praktikum 8 dalam mata kuliah Desain dan Pemrograman Berorientasi Objek untuk keberkahanNya maka saya tidak melakukan kecurangan seperti yang telah dispesifikasikan. Aamiin

---

# Fitur Utama
Pada program ini terdapat beberapa fitur yang disediakan, meliputi:
- **Data Program Studi (`Departments`):**
  - Menampilkan daftar program studi beserta fakultasnya (*Read*).
  - Menambahkan data program studi baru (*Create*).
  - Mengubah data program studi yang sudah ada (*Update*).
  - Menghapus data program studi (*Delete*).
- **Data Dosen (`Lecturers`):**
  - Menampilkan daftar dosen lengkap dengan atribut tambahan (`NIP`, `Email`, `No. Telepon`, `Tanggal Bergabung`) serta nama Program Studi hasil relasi `LEFT JOIN` (*Read*).
  - Menambah  data dosen baru (*Create*).
  - Mengubah data dosen yang sudah ada (*Update*).
  - Mnghapus data dosen (*Delete*).
- **Data Buku dam Publikasi (`Books`):**
  - Menampilkan daftar buku/publikasi ilmiah (`ISBN`, `Judul Buku`, `Penerbit`, `Tahun Terbit`) beserta nama Dosen Penulis hasil relasi `LEFT JOIN` (*Read*).
  - Menambah data baru (*Create*).
  - mengubah data yang sudah ada (*Update*)
  - Menghapus data buku (*Delete*).
- **Keamanan Query & Validasi:**
  - Menggunakan *Prepared Statements* (`mysqli::prepare`) pada seluruh operasi `INSERT`, `UPDATE`, `DELETE`, dan `SELECT BY ID` untuk mencegah *SQL Injection*.
  - Menggunakan `htmlspecialchars()` pada sisi tampilan untuk mencegah celah keamanan *Cross-Site Scripting (XSS)*.

---

## 2. Struktur Direktori Program

```text
tp_mvc25/
├── assets/                          # Aset CSS & JS Bootstrap 5 lokal
│   ├── bootstrap.min.css
│   ├── bootstrap.bundle.min.js
│   ├── bootstrap.min.js
│   ├── jquery.min.js
│   └── popper.min.js
├── config/
│   └── Database.php                 # Class koneksi ke database MySQL (db_tp_mvc)
├── models/                          # Layer Model (Query SQL & Operasi Database)
│   ├── Department.php
│   ├── Lecturer.php
│   └── Book.php
├── controllers/                     # Layer Controller (Logika Bisnis & Penghubung M-V)
│   ├── DepartmentController.php
│   ├── LecturerController.php
│   └── BookController.php
├── views/                           # Layer View (Antarmuka Pengguna / HTML & Bootstrap)
│   ├── layout/
│   │   ├── header.php               # Template <head> dan Navbar navigasi utama
│   │   └── footer.php               # Template penutup <body> dan script JS
│   ├── departments/
│   │   └── index.php                # Halaman Single-Page CRUD Program Studi
│   ├── lecturers/
│   │   └── index.php                # Halaman Single-Page CRUD Dosen
│   └── books/
│       └── index.php                # Halaman Single-Page CRUD Buku & Publikasi
└── index.php                        # Front Controller / Entry Point & Routing URL
```

---

# Struktur Arsitektur MVC

Program disusun dengan memisahkan tanggung jawab kode ke dalam tiga komponen utama, yaitu:

1. **Model (`models/`):**
   - Bertanggung jawab penuh atas interaksi langsung dengan database MySQL (`db_tp_mvc`).
   - Berisi query `SELECT`, `LEFT JOIN`, `INSERT`, `UPDATE`, dan `DELETE` untuk masing-masing entitas (`Department`, `Lecturer`, `Book`).
2. **View (`views/`):**
   - Bertanggung jawab merender tampilan antarmuka pengguna menggunakan HTML5 dan Bootstrap 5.
   - Tidak mengandung query database sama sekali; hanya menerima variabel (`$result`, `$editData`, `$departments`, `$lecturers`) yang dikirim oleh Controller.
   - Menggunakan template parsial (`views/layout/header.php` dan `views/layout/footer.php`) agar komponen navigasi tidak ditulis berulang.
3. **Controller (`controllers/`):**
   - Menjadi perantara antara **Model** dan **View**.
   - Menerima input pengguna dari *request* HTTP (`$_GET` dan `$_POST`), memanggil method pada Model untuk memproses data, lalu memuat View (`include`) atau mengalihkan halaman (`header("Location: ...")`).
4. **Front Controller / Router (`index.php`):**
   - Satu-satunya pintu masuk akses aplikasi. Membaca parameter `?page=` untuk menentukan Controller yang dipanggil, serta parameter `?action=` (`index`, `create`, `edit`, `delete`) untuk mengeksekusi aksi CRUD.

---

# Relasi Database

<img width="660" height="232" alt="diagram" src="https://github.com/user-attachments/assets/da0b29f2-5b65-447a-9b2b-38ecf948e1eb" />

1. **`departments` dan `lecturers` (1 : N):**
   - Satu Program Studi dapat menaungi banyak Dosen, sedangkan setiap Dosen terdaftar pada satu Program Studi.
2. **`lecturers` dan `books` (1 : N):**
   - Satu Dosen dapat menulis banyak Buku atau Publikasi, sedangkan setiap Buku dicatat atas satu Dosen Penulis utama.
     
---

# Dokumentasi
1. `Departments`
   
   <img width="800" height="450" alt="Department" src="https://github.com/user-attachments/assets/9f30447f-f857-4135-ba50-755029d5d256" />


3. `Lecturers`
   
   <img width="800" height="450" alt="Lecturers" src="https://github.com/user-attachments/assets/14f32f81-2776-4d4f-87a9-ec22e0c847fc" />

5. `Books`
   
   <img width="800" height="450" alt="Books" src="https://github.com/user-attachments/assets/2f73bbac-a410-4cae-8e63-6918eaff1296" />

---
