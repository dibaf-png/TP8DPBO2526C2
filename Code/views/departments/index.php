<?php include 'views/layout/header.php'; // Memuat komponen header layout halaman ?>

<div class="container"> <!-- Wadah utama Bootstrap untuk mengatur tata letak konten -->
    <!-- Card Form Tambah / Edit Program Studi -->
    <div class="card mb-4"> <!-- Komponen card Bootstrap dengan margin bawah 4 -->
        <div class="card-header fw-bold"> <!-- Bagian header card dengan teks tebal -->
            <?= $editData ? 'Edit Program Studi' : 'Form Kelola Program Studi' ?> <!-- Menampilkan judul dinamis sesuai mode edit atau tambah -->
        </div> <!-- Akhir card-header -->
        <div class="card-body"> <!-- Bagian isi/konten utama di dalam card -->
            <form action="index.php?page=departments&action=<?= $editData ? 'edit' : 'create' ?>" method="POST"> <!-- Form pengiriman data ke controller dengan aksi dinamis (edit/create) menggunakan metode POST -->
                <?php if ($editData): // Mengecek apakah sedang dalam mode edit data ?>
                    <input type="hidden" name="id" value="<?= $editData['id'] ?>"> <!-- Input tersembunyi untuk menyimpan ID program studi yang akan diperbarui -->
                <?php endif; // Akhir pengecekan mode edit ?>

                <div class="row mb-3"> <!-- Baris grid Bootstrap untuk menata kolom-kolom input form -->
                    <div class="col-md-6"> <!-- Kolom selebar 6 grid (setengah lebar baris) pada layar medium -->
                        <label class="form-label">Nama Program Studi</label> <!-- Label untuk input nama program studi -->
                        <input type="text" name="dept_name" class="form-control" value="<?= htmlspecialchars($editData['dept_name'] ?? '') ?>" placeholder="Masukkan nama prodi..." required> <!-- Input teks nama prodi dengan sanitasi XSS, nilai default saat edit, dan wajib diisi -->
                    </div> <!-- Akhir kolom Nama Program Studi -->
                    
                    <div class="col-md-6"> <!-- Kolom selebar 6 grid (setengah lebar baris) pada layar medium -->
                        <label class="form-label">Fakultas</label> <!-- Label untuk input nama fakultas -->
                        <input type="text" name="faculty" class="form-control" value="<?= htmlspecialchars($editData['faculty'] ?? '') ?>" placeholder="Masukkan nama fakultas..." required> <!-- Input teks fakultas dengan sanitasi XSS, nilai default saat edit, dan wajib diisi -->
                    </div> <!-- Akhir kolom Fakultas -->
                </div> <!-- Akhir baris grid input -->

                <button type="submit" class="btn btn-primary"> <!-- Tombol submit utama berwarna biru -->
                    <?= $editData ? 'Update Program Studi' : 'Tambah Program Studi' ?> <!-- Teks tombol dinamis menyesuaikan mode edit atau tambah -->
                </button> <!-- Akhir tombol submit -->
                <a href="index.php?page=departments" class="btn btn-secondary">Reset</a> <!-- Tombol tautan untuk mereset form dan kembali ke halaman awal program studi -->
            </form> <!-- Akhir elemen form -->
        </div> <!-- Akhir card-body -->
    </div> <!-- Akhir card -->

    <!-- Tabel Daftar Program Studi -->
    <table class="table table-bordered table-striped"> <!-- Tabel Bootstrap dengan garis tepi (bordered) dan warna baris selang-seling (striped) -->
        <thead class="table-dark"> <!-- Bagian kepala tabel dengan latar belakang gelap -->
            <tr> <!-- Baris judul kolom tabel -->
                <th>No</th> <!-- Header kolom nomor urut -->
                <th>Nama Program Studi</th> <!-- Header kolom nama program studi -->
                <th>Fakultas</th> <!-- Header kolom nama fakultas -->
                <th>Aksi</th> <!-- Header kolom tombol aksi (edit/hapus) -->
            </tr> <!-- Akhir baris header -->
        </thead> <!-- Akhir kepala tabel -->
        <tbody> <!-- Bagian badan/isi tabel -->
            <?php $no = 1; while ($row = $result->fetch_assoc()): // Inisialisasi nomor urut dan mulai perulangan data program studi dari database ?>
            <tr> <!-- Baris data untuk satu entri program studi -->
                <td><?= $no++ ?></td> <!-- Menampilkan nomor urut dan menambah nilainya (increment) setiap baris -->
                <td><?= htmlspecialchars($row['dept_name']) ?></td> <!-- Menampilkan nama program studi dengan sanitasi HTML -->
                <td><?= htmlspecialchars($row['faculty']) ?></td> <!-- Menampilkan nama fakultas dengan sanitasi HTML -->
                <td> <!-- Sel kolom untuk tombol aksi -->
                    <a href="index.php?page=departments&edit_id=<?= $row['id'] ?>" class="btn btn-warning btn-sm">Edit</a> <!-- Tombol kuning kecil untuk masuk ke mode edit berdasarkan ID program studi -->
                    <a href="index.php?page=departments&action=delete&id=<?= $row['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus data ini?')">Hapus</a> <!-- Tombol merah kecil untuk menghapus data dengan dialog konfirmasi JavaScript -->
                </td> <!-- Akhir sel kolom aksi -->
            </tr> <!-- Akhir baris data program studi -->
            <?php endwhile; ?>
        </tbody> <!-- Akhir badan tabel -->
    </table> <!-- Akhir elemen tabel -->
</div> <!-- Akhir container utama -->

<?php include 'views/layout/footer.php'; // Memuat komponen footer layout halaman ?>