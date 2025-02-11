<?php
// Koneksi ke database
$conn = new mysqli('localhost', 'root', '', 'kasir');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Ambil data produk
$products = $conn->query("SELECT * FROM produk");

// Proses penghapusan produk
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $conn->query("DELETE FROM produk WHERE ProdukID = $id");
    header("Location: manage_products.php"); // Redirect setelah hapus
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Produk</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Manage Produk</h1>

    <table>
        <tr>
            <th>ID</th>
            <th>Nama Produk</th>
            <th>Harga</th>
            <th>Stok</th>
            <th>Aksi</th>
        </tr>
        <?php while($row = $products->fetch_assoc()): ?>
        <tr>
            <td><?php echo $row['ProdukID']; ?></td>
            <td><?php echo $row['NamaProduk']; ?></td>
            <td><?php echo $row['Harga']; ?></td>
            <td><?php echo $row['Stok']; ?></td>
            <td>
                <a href="edit_product.php?id=<?php echo $row['ProdukID']; ?>">Edit</a>
                <a href="?delete=<?php echo $row['ProdukID']; ?>" onclick="return confirm('Are you sure you want to delete?')">Delete</a>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>

    <a href="add_product.php">Tambah Produk</a>
    <a href="index.php">Back to Home</a>
</body>
</html>
