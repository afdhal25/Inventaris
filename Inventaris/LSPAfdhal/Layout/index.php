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
// Ambil data penjualan
$sales = $conn->query("SELECT * FROM penjualan");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Kasir System</title>
    <link rel="stylesheet" href="index.css">
</head>
<body>
    <div class="sidebar">
        <h2>Kasir Dashboard</h2>
        <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="add_product.php">Add Product</a></li>
            <li><a href="add_customer.php">Add Customer</a></li>
            <li><a href="process_sale.php">Process Sale</a></li>
            <li><a href="logout.php">Logout</a></li>
        </ul>
    </div>

    <div class="main-content">
        <div class="header">
            <h1>Welcome to the Kasir Dashboard</h1>
        </div>
        
        <div class="stats">
            <div class="stat-box">
                <h3>Products</h3>
                <p><?php echo $products->num_rows; ?> Products</p>
            </div>
            <div class="stat-box">
                <h3>Customers</h3>
                <p><?php echo $customers->num_rows; ?> Customers</p>
            </div>
            <div class="stat-box">
                <h3>Sales</h3>
                <p><?php echo $sales->num_rows; ?> Sales</p>
            </div>
        </div>

        <div class="tables">
            <div class="table-container">
                <h2>Products</h2>
                <table>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Price</th>
                        <th>Stock</th>
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
            </div>

            <div class="table-container">
                <h2>Customers</h2>
                <table>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Address</th>
                        <th>Phone</th>
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
            </div>
        </div>
    </div>
</body>
</html>
