CREATE DATABASE IF NOT EXISTS db_tp_mvc;
USE db_tp_mvc;


CREATE TABLE departments (
    id INT AUTO_INCREMENT PRIMARY KEY,
    dept_name VARCHAR(100) NOT NULL,
    faculty VARCHAR(100) NOT NULL
);


CREATE TABLE lecturers (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    nip VARCHAR(20) NOT NULL,
    phone VARCHAR(20) NOT NULL,
    email VARCHAR(100) NOT NULL,         
    join_date DATE NOT NULL,
    department_id INT,                    
    FOREIGN KEY (department_id) REFERENCES departments(id) ON DELETE SET NULL
);


CREATE TABLE books (
    id INT AUTO_INCREMENT PRIMARY KEY,
    isbn VARCHAR(30) NOT NULL,
    book_title VARCHAR(150) NOT NULL,
    publisher VARCHAR(100) NOT NULL,
    publish_year INT NOT NULL,
    lecturer_id INT,
    FOREIGN KEY (lecturer_id) REFERENCES lecturers(id) ON DELETE CASCADE
);


INSERT INTO departments (dept_name, faculty) VALUES 
('Ilmu Komputer', 'FPMIPA'),
('Pendidikan Ilmu Komputer', 'FPMIPA'),
('Rekayasa Perangkat Lunak', 'FPMIPA');


INSERT INTO lecturers (name, nip, phone, email, join_date, department_id) VALUES 
('Dr. Budi Santoso, M.Kom.', '198508122018091001', '081234567890', 'budi.santoso@upi.edu', '2018-09-01', 1),
('Yuni Saraswati, S.Kom., M.T.', '199003152019032004', '082198765432', 'yuni.saraswati@upi.edu', '2019-03-15', 2),
('H. Rizky Pratama, M.T.', '199211202021011002', '085711223344', 'rizky.pratama@upi.edu', '2021-01-20', 3);


INSERT INTO books (isbn, book_title, publisher, publish_year, lecturer_id) VALUES 
('978-602-425-812-3', 'Algoritma dan Pemrograman Berorientasi Objek', 'Rajawali Pers', 2023, 1),
('978-623-01-1945-7', 'Rekayasa Perangkat Lunak Modern', 'Andi Publisher', 2024, 2),
('978-602-8759-99-1', 'Arsitektur Sistem Informasi & Basis Data', 'Informatika Bandung', 2025, 3);