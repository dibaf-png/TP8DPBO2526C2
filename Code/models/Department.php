<?php
class Department { // Class model untuk mengelola operasi database (CRUD) pada tabel jurusan/departemen
    private $conn; // Properti private untuk menyimpan objek koneksi database
    private $table = "departments"; // Properti private yang menyimpan nama tabel di database

    public function __construct($db) { $this->conn = $db; } // Constructor untuk menerima dan menyimpan koneksi database saat class diinisialisasi

    public function getAll() { // Method untuk mengambil seluruh data jurusan dari database
        return $this->conn->query("SELECT * FROM {$this->table}"); // Menjalankan query SELECT semua data dan mengembalikan hasilnya
    } 

    public function getById($id) { // Method untuk mengambil satu data jurusan spesifik berdasarkan ID
        $stmt = $this->conn->prepare("SELECT * FROM {$this->table} WHERE id = ?"); // Menyiapkan prepared statement untuk mencegah SQL injection
        $stmt->bind_param("i", $id); // Mengikat parameter $id sebagai tipe data integer ("i") ke placeholder (?)
        $stmt->execute(); // Menjalankan query yang telah disiapkan
        return $stmt->get_result()->fetch_assoc(); // Mengambil hasil query dan mengembalikannya dalam bentuk array asosiatif
    }

    public function create($dept_name, $faculty) { // Method untuk menambahkan data jurusan baru ke database
        $stmt = $this->conn->prepare("INSERT INTO {$this->table} (dept_name, faculty) VALUES (?, ?)"); // Menyiapkan query INSERT dengan 2 placeholder parameter
        $stmt->bind_param("ss", $dept_name, $faculty); // Mengikat 2 variabel bertipe string ("ss") untuk nama jurusan dan fakultas
        return $stmt->execute(); // Menjalankan query INSERT dan mengembalikan status berhasil/gagal (true/false)
    } 

    public function update($id, $dept_name, $faculty) { // Method untuk memperbarui data jurusan yang sudah ada berdasarkan ID
        $stmt = $this->conn->prepare("UPDATE {$this->table} SET dept_name = ?, faculty = ? WHERE id = ?"); // Menyiapkan query UPDATE dengan 3 placeholder parameter
        $stmt->bind_param("ssi", $dept_name, $faculty, $id); // Mengikat 3 variabel sesuai tipe datanya (2 string "ss" dan 1 integer "i")
        return $stmt->execute(); // Menjalankan query UPDATE dan mengembalikan status berhasil/gagal (true/false)
    }

    public function delete($id) { // Method untuk menghapus data jurusan dari database berdasarkan ID
        $stmt = $this->conn->prepare("DELETE FROM {$this->table} WHERE id = ?"); // Menyiapkan query DELETE dengan 1 placeholder parameter ID
        $stmt->bind_param("i", $id); // Mengikat parameter $id sebagai tipe data integer ("i")
        return $stmt->execute(); // Menjalankan query DELETE dan mengembalikan status berhasil/gagal (true/false)
    } 
} 