<?php include 'views/layout/header.php'; // Memuat komponen header layout halaman ?>

<div class="container"> <!-- Wadah utama Bootstrap untuk mengatur tata letak konten -->
    <!-- Card Form Tambah / Edit Dosen -->
    <div class="card mb-4"> <!-- Komponen card Bootstrap dengan margin bawah 4 -->
        <div class="card-header fw-bold"> <!-- Bagian header card dengan teks tebal -->
            <?= $editData ? 'Edit Data Dosen' : 'Form Kelola Dosen' ?> <!-- Menampilkan judul dinamis sesuai mode edit atau tambah -->
        </div> <!-- Akhir card-header -->
        <div class="card-body"> <!-- Bagian isi/konten utama di dalam card -->
            <form action="index.php?page=lecturers&action=<?= $editData ? 'edit' : 'create' ?>" method="POST"> <!-- Form pengiriman data ke controller dengan aksi dinamis (edit/create) menggunakan metode POST -->
                <?php if ($editData): // Mengecek apakah sedang dalam mode edit data ?>
                    <input type="hidden" name="id" value="<?= $editData['id'] ?>"> <!-- Input tersembunyi untuk menyimpan ID dosen yang akan diperbarui -->
                <?php endif; // Akhir pengecekan mode edit ?>

                <div class="row mb-3"> <!-- Baris grid Bootstrap untuk menata kolom-kolom input form -->
                    <div class="col-md-4 mb-2"> <!-- Kolom selebar 4 grid pada layar medium dengan margin bawah 2 -->
                        <label class="form-label">Nama Dosen</label> <!-- Label untuk input nama dosen -->
                        <input type="text" name="name" class="form-control" value="<?= htmlspecialchars($editData['name'] ?? '') ?>" placeholder="Masukkan nama dosen..." required> <!-- Input teks nama dosen dengan sanitasi XSS, nilai default saat edit, dan wajib diisi -->
                    </div> <!-- Akhir kolom Nama Dosen -->

                    <div class="col-md-4 mb-2"> <!-- Kolom selebar 4 grid pada layar medium dengan margin bawah 2 -->
                        <label class="form-label">NIP</label> <!-- Label untuk input nomor induk pegawai (NIP) -->
                        <input type="text" name="nip" class="form-control" value="<?= htmlspecialchars($editData['nip'] ?? '') ?>" placeholder="Masukkan NIP..." required> <!-- Input teks NIP dengan sanitasi XSS, nilai default saat edit, dan wajib diisi -->
                    </div> <!-- Akhir kolom NIP -->

                    <div class="col-md-4 mb-2"> <!-- Kolom selebar 4 grid pada layar medium dengan margin bawah 2 -->
                        <label class="form-label">No. Telepon</label> <!-- Label untuk input nomor telepon -->
                        <input type="text" name="phone" class="form-control" value="<?= htmlspecialchars($editData['phone'] ?? '') ?>" placeholder="Masukkan no. telepon..." required> <!-- Input teks nomor telepon dengan sanitasi XSS, nilai default saat edit, dan wajib diisi -->
                    </div> <!-- Akhir kolom No. Telepon -->

                    <div class="col-md-4 mb-2"> <!-- Kolom selebar 4 grid pada layar medium dengan margin bawah 2 -->
                        <label class="form-label">Email</label> <!-- Label untuk input alamat email -->
                        <input type="email" name="email" class="form-control" value="<?= htmlspecialchars($editData['email'] ?? '') ?>" placeholder="Masukkan email..." required> <!-- Input email dengan validasi format email bawaan browser dan wajib diisi -->
                    </div> <!-- Akhir kolom Email -->

                    <div class="col-md-4 mb-2"> <!-- Kolom selebar 4 grid pada layar medium dengan margin bawah 2 -->
                        <label class="form-label">Tanggal Bergabung</label> <!-- Label untuk input tanggal bergabung -->
                        <input type="date" name="join_date" class="form-control" value="<?= htmlspecialchars($editData['join_date'] ?? '') ?>" required> <!-- Input pemilih tanggal (date picker) dengan nilai default saat edit dan wajib diisi -->
                    </div> <!-- Akhir kolom Tanggal Bergabung -->
                    
                    <div class="col-md-4 mb-2"> <!-- Kolom selebar 4 grid pada layar medium dengan margin bawah 2 -->
                        <label class="form-label">Program Studi</label> <!-- Label untuk pilihan dropdown program studi -->
                        <select name="department_id" class="form-control" required> <!-- Dropdown pemilihan ID program studi yang wajib dipilih -->
                            <option value="">-- Pilih Program Studi --</option> <!-- Opsi default kosong pada dropdown -->
                            <?php while ($d = $departments->fetch_assoc()): // Melakukan perulangan untuk setiap baris data program studi dari database ?>
                                <option value="<?= $d['id'] ?>" <?= (isset($editData['department_id']) && $editData['department_id'] == $d['id']) ? 'selected' : '' ?>> <!-- Opsi pilihan program studi dengan atribut 'selected' otomatis jika sesuai data edit -->
                                    <?= htmlspecialchars($d['dept_name']) ?> <!-- Menampilkan nama program studi dengan aman dari karakter khusus HTML -->
                                </option> <!-- Akhir tag option -->
                            <?php endwhile; // Akhir perulangan data program studi ?>
                        </select> <!-- Akhir elemen select -->
                    </div> <!-- Akhir kolom Program Studi -->
                </div> <!-- Akhir baris grid input -->

                <button type="submit" class="btn btn-primary"> <!-- Tombol submit utama berwarna biru -->
                    <?= $editData ? 'Update Dosen' : 'Tambah Dosen' ?> <!-- Teks tombol dinamis menyesuaikan mode edit atau tambah -->
                </button> <!-- Akhir tombol submit -->
                <a href="index.php?page=lecturers" class="btn btn-secondary">Reset</a> <!-- Tombol tautan untuk mereset form dan kembali ke halaman awal dosen -->
            </form> <!-- Akhir elemen form -->
        </div> <!-- Akhir card-body -->
    </div> <!-- Akhir card -->

    <!-- Tabel Daftar Dosen -->
    <table class="table table-bordered table-striped"> <!-- Tabel Bootstrap dengan garis tepi (bordered) dan warna baris selang-seling (striped) -->
        <thead class="table-dark"> <!-- Bagian kepala tabel dengan latar belakang gelap -->
            <tr> <!-- Baris judul kolom tabel -->
                <th>No</th> <!-- Header kolom nomor urut -->
                <th>Nama Dosen</th> <!-- Header kolom nama dosen -->
                <th>NIP</th> <!-- Header kolom NIP -->
                <th>Telepon</th> <!-- Header kolom nomor telepon -->
                <th>Email</th> <!-- Header kolom alamat email -->
                <th>Tgl Bergabung</th> <!-- Header kolom tanggal bergabung -->
                <th>Program Studi</th> <!-- Header kolom nama program studi -->
                <th>Aksi</th> <!-- Header kolom tombol aksi (edit/hapus) -->
            </tr> <!-- Akhir baris header -->
        </thead> <!-- Akhir kepala tabel -->
        <tbody> <!-- Bagian badan/isi tabel -->
            <?php $no = 1; while ($row = $result->fetch_assoc()): // Inisialisasi nomor urut dan mulai perulangan data dosen dari database ?>
            <tr> <!-- Baris data untuk satu entri dosen -->
                <td><?= $no++ ?></td> <!-- Menampilkan nomor urut dan menambah nilainya (increment) setiap baris -->
                <td><?= htmlspecialchars($row['name']) ?></td> <!-- Menampilkan nama dosen dengan sanitasi HTML -->
                <td><?= htmlspecialchars($row['nip']) ?></td> <!-- Menampilkan NIP dengan sanitasi HTML -->
                <td><?= htmlspecialchars($row['phone']) ?></td> <!-- Menampilkan nomor telepon dengan sanitasi HTML -->
                <td><?= htmlspecialchars($row['email']) ?></td> <!-- Menampilkan alamat email dengan sanitasi HTML -->
                <td><?= htmlspecialchars($row['join_date']) ?></td> <!-- Menampilkan tanggal bergabung dengan sanitasi HTML -->
                <td><?= htmlspecialchars($row['dept_name'] ?? '-') ?></td> <!-- Menampilkan nama program studi, atau tanda '-' jika kosong/null -->
                <td> <!-- Sel kolom untuk tombol aksi -->
                    <a href="index.php?page=lecturers&edit_id=<?= $row['id'] ?>" class="btn btn-warning btn-sm">Edit</a> <!-- Tombol kuning kecil untuk masuk ke mode edit berdasarkan ID dosen -->
                    <a href="index.php?page=lecturers&action=delete&id=<?= $row['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus data ini?')">Hapus</a> <!-- Tombol merah kecil untuk menghapus data dengan dialog konfirmasi JavaScript -->
                </td> <!-- Akhir sel kolom aksi -->
            </tr> <!-- Akhir baris data dosen -->
            <?php endwhile;?>
        </tbody> <!-- Akhir badan tabel -->
    </table> <!-- Akhir elemen tabel -->
</div> <!-- Akhir container utama -->

<?php include 'views/layout/footer.php'; // Memuat komponen footer layout halaman ?>