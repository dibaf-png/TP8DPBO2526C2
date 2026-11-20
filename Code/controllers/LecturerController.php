<?php
require_once 'config/Database.php'; // Memuat file konfigurasi koneksi database (hanya sekali)
require_once 'models/Lecturer.php'; // Memuat file model Lecturer untuk operasi data dosen
require_once 'models/Department.php'; // Memuat file model Department untuk operasi data jurusan/departemen

class LecturerController { // Class controller untuk mengatur alur logika dan permintaan (request) terkait data dosen
    private $lecturerModel; // Properti private untuk menyimpan instance dari model Lecturer
    private $departmentModel; // Properti private untuk menyimpan instance dari model Department

    public function __construct() { // Constructor yang otomatis dijalankan saat class LecturerController diinisialisasi
        $db = (new Database())->getConnection(); // Membuat instance Database dan mengambil objek koneksinya
        $this->lecturerModel = new Lecturer($db); // Menginisialisasi objek Lecturer dengan mengirimkan koneksi database
        $this->departmentModel = new Department($db); // Menginisialisasi objek Department dengan mengirimkan koneksi database
    }

    public function index() { // Method untuk menampilkan halaman utama daftar dosen beserta form tambah/edit
        $editData = null; // Variabel penampung data dosen yang akan diedit (wajib diinisialisasi null agar tidak muncul error Undefined variable)
        if (isset($_GET['edit_id'])) { // Mengecek apakah ada parameter 'edit_id' pada URL (metode GET)
            $editData = $this->lecturerModel->getById($_GET['edit_id']); // Mengambil data dosen spesifik berdasarkan ID untuk ditampilkan di form edit
        } 
        $result = $this->lecturerModel->getAll(); // Mengambil seluruh data dosen dari database melalui model Lecturer
        $departments = $this->departmentModel->getAll(); // Mengambil seluruh data jurusan dari database untuk pilihan dropdown pada form
        include 'views/lecturers/index.php'; // Memuat file view untuk merender tampilan halaman daftar dosen
    }

    public function create() { // Method untuk memproses penyimpanan data dosen baru
        if ($_SERVER['REQUEST_METHOD'] === 'POST') { // Memastikan request yang masuk menggunakan metode HTTP POST
            $this->lecturerModel->create( // Memanggil method create pada model Lecturer untuk menyimpan data ke database
                $_POST['name'], $_POST['nip'], $_POST['phone'], // Mengirimkan input nama, NIP, dan nomor telepon dari form POST
                $_POST['email'], $_POST['join_date'], $_POST['department_id'] // Mengirimkan input email, tanggal bergabung, dan ID jurusan dari form POST
            ); 
        }
        header("Location: index.php?page=lecturers"); // Mengarahkan (redirect) pengguna kembali ke halaman daftar dosen
        exit; // Menghentikan eksekusi skrip setelah melakukan redirect
    }

    public function edit($id) { // Method untuk memproses pembaruan (update) data dosen yang sudah ada
        if ($_SERVER['REQUEST_METHOD'] === 'POST') { // Memastikan request yang masuk menggunakan metode HTTP POST
            $this->lecturerModel->update( // Memanggil method update pada model Lecturer untuk memperbarui data di database
                $_POST['id'], $_POST['name'], $_POST['nip'], $_POST['phone'], // Mengirimkan ID dosen, nama, NIP, dan nomor telepon baru dari form POST
                $_POST['email'], $_POST['join_date'], $_POST['department_id'] // Mengirimkan email, tanggal bergabung, dan ID jurusan baru dari form POST
            );
        } 
        header("Location: index.php?page=lecturers"); // Mengarahkan (redirect) pengguna kembali ke halaman daftar dosen
        exit; // Menghentikan eksekusi skrip setelah melakukan redirect
    } 

    public function delete($id) { // Method untuk memproses penghapusan data dosen berdasarkan ID
        if ($id) $this->lecturerModel->delete($id); // Jika parameter ID tersedia/valid, panggil method delete pada model Lecturer
        header("Location: index.php?page=lecturers"); // Mengarahkan (redirect) pengguna kembali ke halaman daftar dosen
        exit; // Menghentikan eksekusi skrip setelah melakukan redirect
    }
} 