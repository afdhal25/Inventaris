<?php
session_start();
include 'koneksi.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

// Query yang benar untuk mengambil detail pembelian lengkap
$sql = "SELECT 
            dp.detail_pembelian_id, 
            b.nama_barang, 
            b.harga, 
            dp.jumlah, 
            (b.harga * dp.jumlah) AS subtotal, 
            p.IDpembelian, 
            p.tanggal_pembelian, 
            p.total_harga 
        FROM detail_pembelian dp
        JOIN barang b ON dp.id_barang = b.id_barang
        JOIN pembelian p ON dp.pembelian_id = p.IDpembelian"; // Tambahkan JOIN ke pembelian

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Pembelian</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>

<div class="container mt-4">
    <h2>Detail Pembelian</h2>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID Pembelian</th>
                <th>Tanggal Pembelian</th>
                <th>Nama Barang</th>
                <th>Harga</th>
                <th>Jumlah</th>
                <th>Subtotal</th>
                <th>Total Harga</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) { ?>
                    <tr>
                        <td><?= $row['IDpembelian']; ?></td>
                        <td><?= $row['tanggal_pembelian']; ?></td>
                        <td><?= $row['nama_barang']; ?></td>
                        <td>Rp<?= number_format($row['harga'], 0, ',', '.'); ?></td>
                        <td><?= $row['jumlah']; ?></td>
                        <td>Rp<?= number_format($row['subtotal'], 0, ',', '.'); ?></td>
                        <td>Rp<?= number_format($row['total_harga'], 0, ',', '.'); ?></td>
                    </tr>
                <?php } 
            } else { ?>
                <tr>
                    <td colspan="7" class="text-center">Tidak ada data pembelian.</td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>

</body>
</html>
