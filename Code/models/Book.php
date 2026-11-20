<?php
class Book { // Class model untuk mengelola operasi database (CRUD) pada tabel buku
    private $conn; // Properti private untuk menyimpan objek koneksi database
    private $table = "books"; // Properti private yang menyimpan nama tabel di database

    public function __construct($db) { $this->conn = $db; } // Constructor untuk menerima dan menyimpan koneksi database saat class diinisialisasi

    public function getAll() { // Method untuk mengambil seluruh data buku beserta nama dosen penulisnya
        $sql = "SELECT books.*, lecturers.name AS lecturer_name 
                FROM books 
                LEFT JOIN lecturers ON books.lecturer_id = lecturers.id"; 
        return $this->conn->query($sql); // Menjalankan query SQL dan mengembalikan hasilnya
    } 

    public function getById($id) { // Method untuk mengambil satu data buku spesifik berdasarkan ID
        $stmt = $this->conn->prepare("SELECT * FROM {$this->table} WHERE id = ?"); // Menyiapkan prepared statement untuk mencegah SQL injection
        $stmt->bind_param("i", $id); // Mengikat parameter $id sebagai tipe data integer ("i") ke placeholder (?)
        $stmt->execute(); // Menjalankan query yang telah disiapkan
        return $stmt->get_result()->fetch_assoc(); // Mengambil hasil query dan mengembalikannya dalam bentuk array asosiatif
    } 

    public function create($isbn, $book_title, $publisher, $publish_year, $lecturer_id) { // Method untuk menambahkan data buku baru ke database
        $stmt = $this->conn->prepare("INSERT INTO {$this->table} (isbn, book_title, publisher, publish_year, lecturer_id) VALUES (?, ?, ?, ?, ?)"); // Menyiapkan query INSERT dengan 5 placeholder parameter
        $stmt->bind_param("sssii", $isbn, $book_title, $publisher, $publish_year, $lecturer_id); // Mengikat 5 variabel sesuai tipe datanya (3 string "sss" dan 2 integer "ii")
        return $stmt->execute(); // Menjalankan query INSERT dan mengembalikan status berhasil/gagal (true/false)
    } 

    public function update($id, $isbn, $book_title, $publisher, $publish_year, $lecturer_id) { // Method untuk memperbarui data buku yang sudah ada berdasarkan ID
        $stmt = $this->conn->prepare("UPDATE {$this->table} SET isbn = ?, book_title = ?, publisher = ?, publish_year = ?, lecturer_id = ? WHERE id = ?"); // Menyiapkan query UPDATE dengan 6 placeholder parameter
        $stmt->bind_param("sssiii", $isbn, $book_title, $publisher, $publish_year, $lecturer_id, $id); // Mengikat 6 variabel sesuai tipe datanya (3 string "sss" dan 3 integer "iii")
        return $stmt->execute(); // Menjalankan query UPDATE dan mengembalikan status berhasil/gagal (true/false)
    }

    public function delete($id) { // Method untuk menghapus data buku dari database berdasarkan ID
        $stmt = $this->conn->prepare("DELETE FROM {$this->table} WHERE id = ?"); // Menyiapkan query DELETE dengan 1 placeholder parameter ID
        $stmt->bind_param("i", $id); // Mengikat parameter $id sebagai tipe data integer ("i")
        return $stmt->execute(); // Menjalankan query DELETE dan mengembalikan status berhasil/gagal (true/false)
    } 
} 