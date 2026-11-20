<?php
class Lecturer { // Class model untuk mengelola operasi database (CRUD) pada tabel dosen
    private $conn; // Properti private untuk menyimpan objek koneksi database
    private $table = "lecturers"; // Properti private yang menyimpan nama tabel di database

    public function __construct($db) { $this->conn = $db; } // Constructor untuk menerima dan menyimpan koneksi database saat class diinisialisasi

    public function getAll() { // Method untuk mengambil seluruh data dosen beserta nama jurusannya
        $sql = "SELECT lecturers.*, departments.dept_name 
                FROM lecturers 
                LEFT JOIN departments ON lecturers.department_id = departments.id"; 
        return $this->conn->query($sql); // Menjalankan query SQL dan mengembalikan hasilnya
    } 

    public function getById($id) { // Method untuk mengambil satu data dosen spesifik berdasarkan ID
        $stmt = $this->conn->prepare("SELECT * FROM {$this->table} WHERE id = ?"); // Menyiapkan prepared statement untuk mencegah SQL injection
        $stmt->bind_param("i", $id); // Mengikat parameter $id sebagai tipe data integer ("i") ke placeholder (?)
        $stmt->execute(); // Menjalankan query yang telah disiapkan
        return $stmt->get_result()->fetch_assoc(); // Mengambil hasil query dan mengembalikannya dalam bentuk array asosiatif
    } 

    public function create($name, $nip, $phone, $email, $join_date, $department_id) { // Method untuk menambahkan data dosen baru ke database
        $stmt = $this->conn->prepare("INSERT INTO {$this->table} (name, nip, phone, email, join_date, department_id) VALUES (?, ?, ?, ?, ?, ?)"); // Menyiapkan query INSERT dengan 6 placeholder parameter
        $stmt->bind_param("sssssi", $name, $nip, $phone, $email, $join_date, $department_id); // Mengikat 6 variabel sesuai tipe datanya (5 string "sssss" dan 1 integer "i")
        return $stmt->execute(); // Menjalankan query INSERT dan mengembalikan status berhasil/gagal (true/false)
    } 

    public function update($id, $name, $nip, $phone, $email, $join_date, $department_id) { // Method untuk memperbarui data dosen yang sudah ada berdasarkan ID
        $stmt = $this->conn->prepare("UPDATE {$this->table} SET name = ?, nip = ?, phone = ?, email = ?, join_date = ?, department_id = ? WHERE id = ?"); // Menyiapkan query UPDATE dengan 7 placeholder parameter
        $stmt->bind_param("sssssii", $name, $nip, $phone, $email, $join_date, $department_id, $id); // Mengikat 7 variabel sesuai tipe datanya (5 string "sssss" dan 2 integer "ii")
        return $stmt->execute(); // Menjalankan query UPDATE dan mengembalikan status berhasil/gagal (true/false)
    } 


    public function delete($id) { // Method untuk menghapus data dosen dari database berdasarkan ID
        $stmt = $this->conn->prepare("DELETE FROM {$this->table} WHERE id = ?"); // Menyiapkan query DELETE dengan 1 placeholder parameter ID
        $stmt->bind_param("i", $id); // Mengikat parameter $id sebagai tipe data integer ("i")
        return $stmt->execute(); // Menjalankan query DELETE dan mengembalikan status berhasil/gagal (true/false)
    } 
} 