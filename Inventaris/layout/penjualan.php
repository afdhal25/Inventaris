<?php
session_start();
include 'koneksi.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

// Ambil daftar pelanggan untuk dropdown
$pelanggan_result = $conn->query("SELECT PelangganID, NamaPelanggan FROM pelanggan");

// Proses tambah penjualan jika form dikirim
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $penjualan_id = trim($_POST['PenjualanID']);
    $tanggal_penjualan = $_POST['TanggalPenjualan'];
    $total_harga = (int) $_POST['TotalHarga'];
    $pelanggan_id = trim($_POST['PelangganID']);

    // Cek apakah PelangganID ada di tabel pelanggan
    $cek_pelanggan = $conn->query("SELECT * FROM pelanggan WHERE PelangganID = '$pelanggan_id'");
    if ($cek_pelanggan->num_rows > 0) {
        // Query untuk menambahkan data ke database
        $sql = "INSERT INTO penjualan (PenjualanID, TanggalPenjualan, TotalHarga, PelangganID) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("isii", $penjualan_id, $tanggal_penjualan, $total_harga, $pelanggan_id);

        if ($stmt->execute()) {
            $_SESSION['success'] = "Penjualan berhasil ditambahkan!";
        } else {
            $_SESSION['error'] = "Gagal menambahkan penjualan.";
        }

        $stmt->close();
        header("Location: penjualan.php");
        exit;
    } else {
        $_SESSION['error'] = "Pelanggan dengan ID tersebut tidak ditemukan!";
    }
}

// Ambil data penjualan dari database
$sql = "SELECT PenjualanID, TanggalPenjualan, TotalHarga, PelangganID FROM penjualan";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Penjualan</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>

<div class="container mt-4">
    <h2>Data Penjualan</h2>

    <!-- Tampilkan Pesan -->
    <?php if (isset($_SESSION['success'])) { ?>
        <div class="alert alert-success"><?= $_SESSION['success']; ?></div>
        <?php unset($_SESSION['success']); ?>
    <?php } elseif (isset($_SESSION['error'])) { ?>
        <div class="alert alert-danger"><?= $_SESSION['error']; ?></div>
        <?php unset($_SESSION['error']); ?>
    <?php } ?>

    <!-- Form Tambah Penjualan -->
    <form action="" method="POST" class="mb-4">
        <div class="mb-3">
            <label for="PenjualanID" class="form-label">ID Penjualan</label>
            <input type="number" name="PenjualanID" id="PenjualanID" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="TanggalPenjualan" class="form-label">Tanggal Penjualan</label>
            <input type="date" name="TanggalPenjualan" id="TanggalPenjualan" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="TotalHarga" class="form-label">Total Harga</label>
            <input type="number" name="TotalHarga" id="TotalHarga" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="PelangganID" class="form-label">Pilih Pelanggan</label>
            <select name="PelangganID" id="PelangganID" class="form-control" required>
                <option value="">-- Pilih Pelanggan --</option>
                <?php while ($row = $pelanggan_result->fetch_assoc()) { ?>
                    <option value="<?= $row['PelangganID']; ?>"><?= $row['NamaPelanggan']; ?> (ID: <?= $row['PelangganID']; ?>)</option>
                <?php } ?>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Tambah Penjualan</button>
    </form>

    <!-- Tabel Data Penjualan -->
    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID Penjualan</th>
                <th>Tanggal Penjualan</th>
                <th>Total Harga</th>
                <th>ID Pelanggan</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) { ?>
                    <tr>
                        <td><?= $row['PenjualanID']; ?></td>
                        <td><?= $row['TanggalPenjualan']; ?></td>
                        <td>Rp<?= number_format($row['TotalHarga'], 0, ',', '.'); ?></td>
                        <td><?= $row['PelangganID']; ?></td>
                    </tr>
                <?php } 
            } else { ?>
                <tr>
                    <td colspan="4" class="text-center">Tidak ada data penjualan.</td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>

</body>
</html>
