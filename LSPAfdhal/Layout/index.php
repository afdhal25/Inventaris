<?php
// Koneksi ke database
$conn = new mysqli('localhost', 'root', '', 'kasir');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Ambil data produk
$products = $conn->query("SELECT * FROM produk");
// Ambil data pelanggan
$customers = $conn->query("SELECT * FROM pelanggan");
?>

<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kasir</title>
    <link rel="stylesheet" href="index.css">
</head>
<body>
    <h1>Kasir System</h1>

    <h2>Products</h2>
    <table>
        <tr>
            <th>ID</th>
            <th>Nama Produk</th>
            <th>Harga</th>
            <th>Stok</th>
        </tr>
        <?php while($row = $products->fetch_assoc()): ?>
        <tr>
            <td><?php echo $row['ProdukID']; ?></td>
            <td><?php echo $row['NamaProduk']; ?></td>
            <td><?php echo $row['Harga']; ?></td>
            <td><?php echo $row['Stok']; ?></td>
        </tr>
        <?php endwhile; ?>
    </table>

    <h2>Customers</h2>
    <table>
        <tr>
            <th>ID</th>
            <th>Nama Pelanggan</th>
            <th>Alamat</th>
            <th>Nomor Telepon</th>
        </tr>
        <?php while($row = $customers->fetch_assoc()): ?>
        <tr>
            <td><?php echo $row['PelangganID']; ?></td>
            <td><?php echo $row['NamaPelanggan']; ?></td>
            <td><?php echo $row['Alamat']; ?></td>
            <td><?php echo $row['NomorTelepon']; ?></td>
        </tr>
        <?php endwhile; ?>
    </table>

    <a href="add_product.php">Add Product</a>
    <a href="add_customer.php">Add Customer</a>
    <a href="process_sale.php">Process Sale</a>
</body>
</html>