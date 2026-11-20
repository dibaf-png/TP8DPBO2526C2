<?php
class Database { // Class ini mengatur konfigurasi dan proses koneksi ke database
    private $servername = "localhost"; // Nama host server database (bersifat private)
    private $username = "root"; // Username default MySQL (bersifat private)
    private $password = ""; // Password default MySQL, kosong (bersifat private)
    private $db_name = "db_tp_mvc"; // Nama database yang akan digunakan (bersifat private)
    public $conn; // Properti untuk menyimpan objek koneksi database (bersifat public)

    public function getConnection(){ // Method untuk membuka dan mengembalikan koneksi database
        $this->conn = new mysqli($this->servername, $this->username, $this->password, $this->db_name); // Membuat instance koneksi baru menggunakan ekstensi MySQLi
        if ($this->conn->connect_error) { // Mengecek apakah terjadi error saat proses koneksi
            die("Connection failed: " . $this->conn->connect_error); // Menghentikan eksekusi program dan menampilkan pesan error jika koneksi gagal
        } 
        return $this->conn; // Mengembalikan objek koneksi yang berhasil dibuat
    } 

} 