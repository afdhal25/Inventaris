<?php
session_start();
include 'koneksi.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

// Query hanya menampilkan DetailID, PenjualanID, ProdukID, JumlahProduk, Subtotal, dan UserID
$sql = "SELECT DetailID, PenjualanID, ProdukID, JumlahProduk, Subtotal, UserID FROM detailpenjualan";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Penjualan</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>

<div class="container mt-4">
    <h2>Detail Penjualan</h2>

    <table class="table table-striped mt-4">
        <thead>
            <tr>
                <th>ID Detail</th>
                <th>ID Penjualan</th>
                <th>ID Produk</th>
                <th>Jumlah Produk</th>
                <th>Subtotal</th>
                <th>User ID</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) { ?>
                    <tr>
                        <td><?= $row['DetailID']; ?></td>
                        <td><?= $row['PenjualanID']; ?></td>
                        <td><?= $row['ProdukID']; ?></td>
                        <td><?= $row['JumlahProduk']; ?></td>
                        <td>Rp<?= number_format($row['Subtotal'], 0, ',', '.'); ?></td>
                        <td><?= $row['UserID']; ?></td>
                    </tr>
                <?php } 
            } else { ?>
                <tr>
                    <td colspan="6" class="text-center">Tidak ada data penjualan.</td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>

</body>
</html>
