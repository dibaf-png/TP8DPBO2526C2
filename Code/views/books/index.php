<?php include 'views/layout/header.php'; // Memuat komponen header layout halaman ?>

<div class="container"> <!-- Wadah utama Bootstrap untuk mengatur tata letak konten -->
    <!-- Card Form Tambah / Edit Buku -->
    <div class="card mb-4"> <!-- Komponen card Bootstrap dengan margin bawah 4 -->
        <div class="card-header fw-bold"> <!-- Bagian header card dengan teks tebal -->
            <?= $editData ? 'Edit Data Buku & Publikasi' : 'Form Kelola Buku & Publikasi' ?> <!-- Menampilkan judul dinamis sesuai mode edit atau tambah -->
        </div> <!-- Akhir card-header -->
        <div class="card-body"> <!-- Bagian isi/konten utama di dalam card -->
            <form action="index.php?page=books&action=<?= $editData ? 'edit' : 'create' ?>" method="POST"> <!-- Form pengiriman data ke controller dengan aksi dinamis (edit/create) menggunakan metode POST -->
                <?php if ($editData): // Mengecek apakah sedang dalam mode edit data ?>
                    <input type="hidden" name="id" value="<?= $editData['id'] ?>"> <!-- Input tersembunyi untuk menyimpan ID buku yang akan diperbarui -->
                <?php endif; // Akhir pengecekan mode edit ?>

                <div class="row mb-3"> <!-- Baris grid Bootstrap untuk menata kolom-kolom input form -->
                    <div class="col-md-4 mb-2"> <!-- Kolom selebar 4 grid pada layar medium dengan margin bawah 2 -->
                        <label class="form-label">ISBN</label> <!-- Label untuk input nomor ISBN -->
                        <input type="text" name="isbn" class="form-control" value="<?= htmlspecialchars($editData['isbn'] ?? '') ?>" placeholder="Contoh: 978-602-425-812-3" required> <!-- Input teks ISBN dengan sanitasi XSS dan wajib diisi -->
                    </div> <!-- Akhir kolom ISBN -->

                    <div class="col-md-8 mb-2"> <!-- Kolom selebar 8 grid pada layar medium dengan margin bawah 2 -->
                        <label class="form-label">Judul Buku / Publikasi</label> <!-- Label untuk input judul buku -->
                        <input type="text" name="book_title" class="form-control" value="<?= htmlspecialchars($editData['book_title'] ?? '') ?>" placeholder="Masukkan judul buku..." required> <!-- Input teks judul buku dengan nilai default saat edit dan wajib diisi -->
                    </div> <!-- Akhir kolom Judul Buku -->

                    <div class="col-md-5 mb-2"> <!-- Kolom selebar 5 grid pada layar medium dengan margin bawah 2 -->
                        <label class="form-label">Penerbit</label> <!-- Label untuk input nama penerbit -->
                        <input type="text" name="publisher" class="form-control" value="<?= htmlspecialchars($editData['publisher'] ?? '') ?>" placeholder="Masukkan nama penerbit..." required> <!-- Input teks penerbit dengan nilai default saat edit dan wajib diisi -->
                    </div> <!-- Akhir kolom Penerbit -->

                    <div class="col-md-2 mb-2"> <!-- Kolom selebar 2 grid pada layar medium dengan margin bawah 2 -->
                        <label class="form-label">Tahun Terbit</label> <!-- Label untuk input tahun terbit -->
                        <input type="number" name="publish_year" class="form-control" value="<?= htmlspecialchars($editData['publish_year'] ?? '') ?>" min="1990" max="2099" placeholder="2025" required> <!-- Input angka tahun terbit dengan batasan rentang 1990-2099 -->
                    </div> <!-- Akhir kolom Tahun Terbit -->

                    <div class="col-md-5 mb-2"> <!-- Kolom selebar 5 grid pada layar medium dengan margin bawah 2 -->
                        <label class="form-label">Penulis (Dosen)</label> <!-- Label untuk pilihan dropdown dosen penulis -->
                        <select name="lecturer_id" class="form-control" required> <!-- Dropdown pemilihan ID dosen penulis yang wajib dipilih -->
                            <option value="">-- Pilih Dosen Penulis --</option> <!-- Opsi default kosong pada dropdown -->
                            <?php while ($l = $lecturers->fetch_assoc()): // Melakukan perulangan untuk setiap baris data dosen dari database ?>
                                <option value="<?= $l['id'] ?>" <?= (isset($editData['lecturer_id']) && $editData['lecturer_id'] == $l['id']) ? 'selected' : '' ?>> <!-- Opsi pilihan dosen dengan atribut 'selected' otomatis jika sesuai data edit -->
                                    <?= htmlspecialchars($l['name']) ?> <!-- Menampilkan nama dosen dengan aman dari karakter khusus HTML -->
                                </option> <!-- Akhir tag option -->
                            <?php endwhile; // Akhir perulangan data dosen ?>
                        </select> <!-- Akhir elemen select -->
                    </div> <!-- Akhir kolom Penulis -->
                    
                </div> <!-- Akhir baris grid input -->

                <button type="submit" class="btn btn-primary"> <!-- Tombol submit utama berwarna biru -->
                    <?= $editData ? 'Update Buku' : 'Tambah Buku' ?> <!-- Teks tombol dinamis menyesuaikan mode edit atau tambah -->
                </button> <!-- Akhir tombol submit -->
                <a href="index.php?page=books" class="btn btn-secondary">Reset</a> <!-- Tombol tautan untuk mereset form dan kembali ke halaman awal buku -->
            </form> <!-- Akhir elemen form -->
        </div> <!-- Akhir card-body -->
    </div> <!-- Akhir card -->

    <!-- Tabel Daftar Buku -->
    <table class="table table-bordered table-striped"> <!-- Tabel Bootstrap dengan garis tepi (bordered) dan warna baris selang-seling (striped) -->
        <thead class="table-dark"> <!-- Bagian kepala tabel dengan latar belakang gelap -->
            <tr> <!-- Baris judul kolom tabel -->
                <th>No</th> <!-- Header kolom nomor urut -->
                <th>ISBN</th> <!-- Header kolom nomor ISBN -->
                <th>Judul Buku / Publikasi</th> <!-- Header kolom judul buku -->
                <th>Penerbit</th> <!-- Header kolom nama penerbit -->
                <th>Tahun Terbit</th> <!-- Header kolom tahun terbit -->
                <th>Penulis (Dosen)</th> <!-- Header kolom nama dosen penulis -->
                <th>Aksi</th> <!-- Header kolom tombol aksi (edit/hapus) -->
            </tr> <!-- Akhir baris header -->
        </thead> <!-- Akhir kepala tabel -->
        <tbody> <!-- Bagian badan/isi tabel -->
            <?php $no = 1; while ($row = $result->fetch_assoc()): // Inisialisasi nomor urut dan mulai perulangan data buku dari database ?>
            <tr> <!-- Baris data untuk satu entri buku -->
                <td><?= $no++ ?></td> <!-- Menampilkan nomor urut dan menambah nilainya (increment) setiap baris -->
                <td><?= htmlspecialchars($row['isbn']) ?></td> <!-- Menampilkan data ISBN dengan sanitasi HTML -->
                <td><?= htmlspecialchars($row['book_title']) ?></td> <!-- Menampilkan judul buku dengan sanitasi HTML -->
                <td><?= htmlspecialchars($row['publisher']) ?></td> <!-- Menampilkan nama penerbit dengan sanitasi HTML -->
                <td><?= htmlspecialchars($row['publish_year']) ?></td> <!-- Menampilkan tahun terbit dengan sanitasi HTML -->
                <td><?= htmlspecialchars($row['lecturer_name'] ?? '-') ?></td> <!-- Menampilkan nama dosen penulis, atau tanda '-' jika kosong/null -->
                <td> <!-- Sel kolom untuk tombol aksi -->
                    <a href="index.php?page=books&edit_id=<?= $row['id'] ?>" class="btn btn-warning btn-sm">Edit</a> <!-- Tombol kuning kecil untuk masuk ke mode edit berdasarkan ID buku -->
                    <a href="index.php?page=books&action=delete&id=<?= $row['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus data ini?')">Hapus</a> <!-- Tombol merah kecil untuk menghapus data dengan dialog konfirmasi JavaScript -->
                </td> <!-- Akhir sel kolom aksi -->
            </tr> <!-- Akhir baris data buku -->
            <?php endwhile; ?>
        </tbody> <!-- Akhir badan tabel -->
    </table> <!-- Akhir elemen tabel -->
</div> <!-- Akhir container utama -->

<?php include 'views/layout/footer.php'; // Memuat komponen footer layout halaman ?>