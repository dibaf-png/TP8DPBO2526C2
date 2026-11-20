<?php
require_once 'controllers/LecturerController.php'; // Memuat file controller untuk mengelola fitur Dosen
require_once 'controllers/DepartmentController.php'; // Memuat file controller untuk mengelola fitur Program Studi/Jurusan
require_once 'controllers/BookController.php'; // Memuat file controller untuk mengelola fitur Buku & Publikasi

$page   = $_GET['page'] ?? 'lecturers'; // Mengambil parameter 'page' dari URL untuk menentukan halaman tujuan (default ke 'lecturers')
$action = $_GET['action'] ?? 'index'; // Mengambil parameter 'action' dari URL untuk menentukan aksi yang dijalankan (default ke 'index')
$id     = $_GET['id'] ?? null; // Mengambil parameter 'id' dari URL jika ada (default null jika tidak tersedia)

switch ($page){ // Memilih controller yang sesuai berdasarkan nilai parameter $page
    case 'departments': // Jika nilai $page adalah 'departments'
        $controller = new DepartmentController(); // Membuat instance objek dari DepartmentController
        break; // Menghentikan pengecekan switch setelah kondisi terpenuhi
    case 'books': // Jika nilai $page adalah 'books'
        $controller = new BookController(); // Membuat instance objek dari BookController
        break; // Menghentikan pengecekan switch setelah kondisi terpenuhi
    default: // Jika nilai $page adalah 'lecturers' atau tidak cocok dengan opsi di atas
        $controller = new LecturerController(); // Membuat instance objek dari LecturerController sebagai halaman bawaan
        break; // Menghentikan pengecekan switch
} 

switch ($action){ // Menjalankan method pada controller terpilih berdasarkan nilai parameter $action
    case 'create': // Jika nilai $action adalah 'create'
        $controller->create(); // Memanggil method create() untuk memproses penambahan data baru
        break; // Menghentikan pengecekan switch
    case 'edit': // Jika nilai $action adalah 'edit'
        $controller->edit($id); // Memanggil method edit() dengan mengirimkan parameter $id untuk memperbarui data
        break; // Menghentikan pengecekan switch
    case 'delete': // Jika nilai $action adalah 'delete'
        $controller->delete($id); // Memanggil method delete() dengan mengirimkan parameter $id untuk menghapus data
        break; // Menghentikan pengecekan switch
    default: // Jika nilai $action adalah 'index' atau tidak cocok dengan opsi di atas
        $controller->index(); // Memanggil method index() untuk menampilkan halaman utama daftar data
        break; // Menghentikan pengecekan switch
} 