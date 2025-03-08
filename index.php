<?php
session_start(); // Memulai sesi

// Class Mahasiswa
class Mahasiswa {
    public $nim;
    public $nama;

    public function __construct($nim, $nama) {
        $this->nim = $nim;
        $this->nama = $nama;
    }

    public function getInfo() {
        return [$this->nim, $this->nama];
    }
}

// Inisialisasi array mahasiswa di session jika belum ada
if (!isset($_SESSION['mahasiswaList'])) {
    $_SESSION['mahasiswaList'] = [];
}

// Menambahkan mahasiswa baru
if (isset($_POST['submit'])) {
    $nim = $_POST['nim'];
    $nama = $_POST['nama'];

    if (!empty($nim) && !empty($nama)) {
        $mahasiswaBaru = new Mahasiswa($nim, $nama);
        $_SESSION['mahasiswaList'][] = $mahasiswaBaru;
    }
}

// Menghapus mahasiswa berdasarkan index
if (isset($_POST['hapus'])) {
    $index = $_POST['hapus'];
    if (isset($_SESSION['mahasiswaList'][$index])) {
        unset($_SESSION['mahasiswaList'][$index]);
        $_SESSION['mahasiswaList'] = array_values($_SESSION['mahasiswaList']); // Reindex array
    }
}

// Reset semua data mahasiswa
if (isset($_POST['reset'])) {
    $_SESSION['mahasiswaList'] = [];
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Form Input Mahasiswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-dark">
    <div class="container-fluid bg-dark vh-auto d-flex justify-content-center flex-column align-items-center">
        <h1 class="text-uppercase text-light text-center">Input Data Mahasiswa</h1>
        <form method="post" action="" class="container w-75">
            <div class="form-floating mb-3">
                <input type="text" class="form-control" name="nim" id="floatingInput" placeholder="Masukan NIM">
                <label for="floatingInput">NIM</label>
            </div>
            <div class="form-floating">
                <input type="text" class="form-control" name="nama" id="floatingNama" placeholder="Masukan Nama">
                <label for="floatingNama">NAMA</label>
            </div>
            <button type="submit" name="submit" class="w-100 h-25 mt-3 btn btn-outline-light">
                <b class="text-uppercase fs-5">Kirim</b>
            </button>
        </form>

        <!-- Tabel Menampilkan Mahasiswa -->
        <?php if (!empty($_SESSION['mahasiswaList'])): ?>
            <div class="mt-5 bg-light p-3 rounded w-75">
                <h2 class="text-center">Daftar Mahasiswa</h2>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>NIM</th>
                            <th>Nama</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($_SESSION['mahasiswaList'] as $index => $mhs): ?>
                            <?php list($nim, $nama) = $mhs->getInfo(); ?>
                            <tr>
                                <td><?= htmlspecialchars($nim); ?></td>
                                <td><?= htmlspecialchars($nama); ?></td>
                                <td>
                                    <form method="post" style="display:inline;">
                                        <button type="submit" name="hapus" value="<?= $index; ?>" class="btn btn-danger btn-sm">X</button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>

                <!-- Tombol Reset -->
                <form method="post">
                    <button type="submit" name="reset" class="btn btn-warning w-100 mt-3">Reset Data</button>
                </form>
            </div>
        <?php endif; ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
