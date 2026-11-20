<!DOCTYPE html> <!-- Mendeklarasikan tipe dokumen sebagai HTML5 -->
<html lang="id"> <!-- Membuka elemen root HTML dengan atribut bahasa Indonesia ("id") -->
<head> <!-- Bagian kepala dokumen untuk menyimpan metadata dan pemanggilan stylesheet -->
    <meta charset="UTF-8"> <!-- Mengatur pengkodean karakter menjadi UTF-8 agar mendukung berbagai simbol dan karakter -->
    <title>Academic System - MVC</title> <!-- Menentukan judul halaman yang tampil pada tab browser -->
    <link rel="stylesheet" href="assets/bootstrap.min.css"> <!-- Memuat file CSS Bootstrap lokal untuk styling tata letak dan komponen -->
</head> <!-- Menutup bagian kepala dokumen -->
<body> <!-- Membuka bagian badan dokumen yang berisi konten utama halaman -->
<?php $current_page = $_GET['page'] ?? 'lecturers'; // Mengambil parameter 'page' dari URL untuk menandai menu aktif (default ke 'lecturers') ?>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4"> <!-- Membuat bilah navigasi (navbar) Bootstrap berwarna gelap dengan margin bawah 4 -->
    <div class="container"> <!-- Wadah Bootstrap untuk membatasi lebar dan merapikan konten di dalam navbar -->
        <a class="navbar-brand" href="index.php">Academic MVC</a> <!-- Logo atau teks merek aplikasi yang mengarah ke halaman utama -->
        <div class="navbar-nav"> <!-- Wadah untuk menampung daftar tautan navigasi -->
            <a class="nav-link <?= $current_page === 'lecturers' ? 'active' : '' ?>" href="index.php?page=lecturers">Lecturers</a> <!-- Tautan ke halaman Dosen, otomatis diberi class 'active' jika sedang dibuka -->
            <a class="nav-link <?= $current_page === 'departments' ? 'active' : '' ?>" href="index.php?page=departments">Departments</a> <!-- Tautan ke halaman Program Studi, otomatis diberi class 'active' jika sedang dibuka -->
            <a class="nav-link <?= $current_page === 'books' ? 'active' : '' ?>" href="index.php?page=books">Books</a> <!-- Tautan ke halaman Buku, otomatis diberi class 'active' jika sedang dibuka -->
        </div> <!-- Menutup wadah daftar tautan navigasi -->
    </div> <!-- Menutup container navbar -->
</nav> <!-- Menutup elemen navigasi -->