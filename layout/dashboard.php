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
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="dashboard.css"> <!-- Link ke file CSS terpisah -->
</head>
<body>

<!-- Sidebar -->
<div class="sidebar">
    <h3>Menu</h3>
    <a href="dashboard.php">Barang</a>
    <a href="detail_pembelian.php">Detail Pembelian</a>
    <a href="pembelian.php">Pembelian</a>
    <a href="supplier.php">Supplier</a>
    
    <h3>User</h3>
    <a href="registrasi.php">Registrasi User</a>
    <a href="logout.php" class="text-danger">Logout</a>
</div>

<!-- Content -->
<div class="content">
    <h2>Dashboard</h2>

    <div class="table-container">
        <h3>Data Barang</h3>
        <table class="table table-striped">
            <thead class="table-dark">
                <tr>    
                    <th>Nama Barang</th>
                    <th>Harga</th>
                    <th>Stok</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql = "SELECT id_barang, nama_barang, harga, stok FROM barang";
                $result = $conn->query($sql);
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>{$row['nama_barang']}</td>";
                    echo "<td>{$row['harga']}</td>";
                    echo "<td>{$row['stok']}</td>";
                    echo "<td>
                            <a href='edit_barang.php?id={$row['id_barang']}' class='btn btn-warning btn-sm'>Edit</a> 
                            <a href='hapus_barang.php?id={$row['id_barang']}' onclick='return confirm(\"Yakin ingin menghapus?\")' class='btn btn-danger btn-sm'>Hapus</a>
                          </td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

    <!-- Form Tambah Barang -->
    <div class="mt-4 form-container">
        <h3>Tambah Barang</h3>
        <form action="tambah_barang.php" method="POST">
            <div class="mb-3">
                <label class="form-label">Nama Barang:</label>
                <input type="text" name="nama_barang" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Harga:</label>
                <input type="text" name="harga" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Stok:</label>
                <input type="number" name="stok" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Tambah</button>
            <div class="mb-3">
    <label class="form-label">Nama Orang:</label>
    <select name="suplier_ID" class="form-control" required>
        <option value="">Pilih Nama</option>
        <?php
        $sql_orang = "SELECT suplier_ID, nama_orang FROM supplier";
        $result_orang = $conn->query($sql_orang);
        while ($orang = $result_orang->fetch_assoc()) {
            echo "<option value='{$orang['suplier_ID']}'>{$orang['nama_orang']}</option>";
        }
        ?>
    </select>
</div>



        </form>
    </div>
        </table>
    </div>
</div>

</body>
</html>
