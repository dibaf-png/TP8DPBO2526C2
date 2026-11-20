<?php
require_once 'config/Database.php'; // Memuat file konfigurasi koneksi database (hanya sekali)
require_once 'models/Book.php'; // Memuat file model Book untuk operasi data buku
require_once 'models/Lecturer.php'; // Memuat file model Lecturer untuk operasi data dosen

class BookController { // Class controller untuk mengatur alur logika dan permintaan (request) terkait data buku
    private $bookModel; // Properti private untuk menyimpan instance dari model Book
    private $lecturerModel; // Properti private untuk menyimpan instance dari model Lecturer

    public function __construct() { // Constructor yang otomatis dijalankan saat class BookController diinisialisasi
        $db = (new Database())->getConnection(); // Membuat instance Database dan mengambil objek koneksinya
        $this->bookModel = new Book($db); // Menginisialisasi objek Book dengan mengirimkan koneksi database
        $this->lecturerModel = new Lecturer($db); // Menginisialisasi objek Lecturer dengan mengirimkan koneksi database
    } 

    public function index() { // Method untuk menampilkan halaman utama daftar buku beserta form tambah/edit
        $editData = null; // Variabel penampung data buku yang akan diedit (default null jika mode tambah)
        if (isset($_GET['edit_id'])) { // Mengecek apakah ada parameter 'edit_id' pada URL (metode GET)
            $editData = $this->bookModel->getById($_GET['edit_id']); // Mengambil data buku spesifik berdasarkan ID untuk ditampilkan di form edit
        } // Akhir pengecekan parameter edit_id
        $result = $this->bookModel->getAll(); // Mengambil seluruh data buku dari database melalui model Book
        $lecturers = $this->lecturerModel->getAll(); // Mengambil seluruh data dosen dari database untuk pilihan dropdown pada form
        include 'views/books/index.php'; // Memuat file view untuk merender tampilan halaman daftar buku
    } 

    public function create() { // Method untuk memproses penyimpanan data buku baru
        if ($_SERVER['REQUEST_METHOD'] === 'POST') { // Memastikan request yang masuk menggunakan metode HTTP POST
            $this->bookModel->create( // Memanggil method create pada model Book untuk menyimpan data ke database
                $_POST['isbn'], $_POST['book_title'], $_POST['publisher'], // Mengirimkan input ISBN, judul buku, dan penerbit dari form POST
                $_POST['publish_year'], $_POST['lecturer_id'] // Mengirimkan input tahun terbit dan ID dosen penulis dari form POST
            ); 
        } 
        header("Location: index.php?page=books"); // Mengarahkan (redirect) pengguna kembali ke halaman daftar buku
        exit; // Menghentikan eksekusi skrip setelah melakukan redirect
    } 


    public function edit($id) { // Method untuk memproses pembaruan (update) data buku yang sudah ada
        if ($_SERVER['REQUEST_METHOD'] === 'POST') { // Memastikan request yang masuk menggunakan metode HTTP POST
            $this->bookModel->update( // Memanggil method update pada model Book untuk memperbarui data di database
                $_POST['id'], $_POST['isbn'], $_POST['book_title'], // Mengirimkan ID buku, ISBN, dan judul buku baru dari form POST
                $_POST['publisher'], $_POST['publish_year'], $_POST['lecturer_id'] // Mengirimkan penerbit, tahun terbit, dan ID dosen baru dari form POST
            ); // Akhir pemanggilan method update
        } // Akhir pengecekan metode POST
        header("Location: index.php?page=books"); // Mengarahkan (redirect) pengguna kembali ke halaman daftar buku
        exit; // Menghentikan eksekusi skrip setelah melakukan redirect
    } 

    public function delete($id) { // Method untuk memproses penghapusan data buku berdasarkan ID
        if ($id) $this->bookModel->delete($id); // Jika parameter ID tersedia/valid, panggil method delete pada model Book
        header("Location: index.php?page=books"); // Mengarahkan (redirect) pengguna kembali ke halaman daftar buku
        exit; // Menghentikan eksekusi skrip setelah melakukan redirect

    } 
} 