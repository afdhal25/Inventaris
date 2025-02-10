<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

include 'koneksi.php'; // Pastikan file koneksi sudah benar
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pembelian</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="dashboard.css"> <!-- Link ke file CSS terpisah -->
</head>
<body>

<!-- Sidebar -->
<div class="sidebar">
    <h3>Menu</h3>
    <a href="dashboard.php">Barang</a>
    <a href="detail_pembelian.php">Detail Pembelian</a>
    <a href="supplier.php">Supplier</a>
    <a href="pembelian.php">Pembelian</a> <!-- Menu Pembelian ditambahkan di sini -->
    
    <h3>User</h3>
    <a href="registrasi.php">Registrasi User</a>
    <a href="logout.php" class="text-danger">Logout</a>
</div>

<!-- Content -->
<div class="content">
    <h2>Pembelian</h2>

    <div class="table-container">
        <h3>Data Pembelian</h3>
        <table class="table table-striped">
            <thead class="table-dark">
                <tr>
                    <th>ID Pembelian</th>
                    <th>Tanggal Pembelian</th>
                    <th>Nama Supplier</th>
                    <th>Nama User</th>
                    <th>Total Harga</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Query untuk mengambil data pembelian dan menghubungkan dengan data supplier dan user
                $sql = "SELECT p.IDpembelian, p.tanggal_pembelian, s.nama_orang AS nama_supplier, u.username AS nama_user, p.total_harga
                        FROM pembelian p
                        JOIN supplier s ON p.suplier_ID = s.suplier_ID
                        JOIN user u ON p.user_id = u.user_id";
                $result = $conn->query($sql);
                
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>{$row['IDpembelian']}</td>";
                    echo "<td>{$row['tanggal_pembelian']}</td>";
                    echo "<td>{$row['nama_supplier']}</td>";
                    echo "<td>{$row['nama_user']}</td>";
                    echo "<td>{$row['total_harga']}</td>";
                    echo "<td>
                            <a href='edit_pembelian.php?id={$row['IDpembelian']}' class='btn btn-warning btn-sm'>Edit</a> 
                            <a href='hapus_pembelian.php?id={$row['IDpembelian']}' onclick='return confirm(\"Yakin ingin menghapus?\")' class='btn btn-danger btn-sm'>Hapus</a>
                          </td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</div>

</body>
</html>
