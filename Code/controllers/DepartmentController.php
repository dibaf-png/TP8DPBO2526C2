<?php
require_once 'config/Database.php'; //Memuat file konfigurasi koneksi database (hanya sekali)
require_once 'models/Department.php'; //Memuat file model Department untuk operasi data jurusan/departemen

class DepartmentController { //Class controller untuk mengatur alur logika dan permintaan (request) terkait data jurusan
    private $model; //Properti private untuk menyimpan instance dari model Department

    public function __construct() { //Constructor yang otomatis dijalankan saat class DepartmentController diinisialisasi
        $db = (new Database())->getConnection(); //Membuat instance Database dan mengambil objek koneksinya
        $this->model = new Department($db); //Menginisialisasi objek Department dengan mengirimkan koneksi database
    }

    public function index() { //Method untuk menampilkan halaman utama daftar jurusan beserta form tambah/edit
        $editData = null; //Variabel penampung data jurusan yang akan diedit (default null jika mode tambah)
        if (isset($_GET['edit_id'])) { //Mengecek apakah ada parameter 'edit_id' pada URL (metode GET)
            $editData = $this->model->getById($_GET['edit_id']); //Mengambil data jurusan spesifik berdasarkan ID untuk ditampilkan di form edit
        }
        $result = $this->model->getAll(); //Mengambil seluruh data jurusan dari database melalui model Department
        include 'views/departments/index.php'; //Memuat file view untuk merender tampilan halaman daftar jurusan
    }

    public function create() { //Method untuk memproses penyimpanan data jurusan baru
        if ($_SERVER['REQUEST_METHOD'] === 'POST') { //Memastikan request yang masuk menggunakan metode HTTP POST
            $this->model->create($_POST['dept_name'], $_POST['faculty']); //Memanggil method create pada model untuk menyimpan nama jurusan dan fakultas dari form POST
        } //Akhir pengecekan metode POST
        header("Location: index.php?page=departments"); //Mengarahkan (redirect) pengguna kembali ke halaman daftar jurusan
        exit; //Menghentikan eksekusi skrip setelah melakukan redirect
    }

    public function edit($id) { //Method untuk memproses pembaruan (update) data jurusan yang sudah ada
        if ($_SERVER['REQUEST_METHOD'] === 'POST') { //Memastikan request yang masuk menggunakan metode HTTP POST
            $this->model->update($_POST['id'], $_POST['dept_name'], $_POST['faculty']); //Memanggil method update pada model untuk memperbarui ID, nama jurusan, dan fakultas dari form POST
        } //Akhir pengecekan metode POST
        header("Location: index.php?page=departments"); //Mengarahkan (redirect) pengguna kembali ke halaman daftar jurusan
        exit; //Menghentikan eksekusi skrip setelah melakukan redirect
    }

    public function delete($id) { //Method untuk memproses penghapusan data jurusan berdasarkan ID
        if ($id) $this->model->delete($id); //Jika parameter ID tersedia/valid, panggil method delete pada model Department
        header("Location: index.php?page=departments"); //Mengarahkan (redirect) pengguna kembali ke halaman daftar jurusan
        exit; //Menghentikan eksekusi skrip setelah melakukan redirect
    } 
} 