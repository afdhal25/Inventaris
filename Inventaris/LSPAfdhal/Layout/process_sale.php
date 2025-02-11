<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $conn = new mysqli('localhost', 'root', '', 'kasir');
    $pelangganID = $_POST['pelangganID'];
    $produkID = $_POST['produkID'];
    $jumlahProduk = $_POST['jumlahProduk'];

    // Ambil harga produk
    $result = $conn->query("SELECT Harga FROM produk WHERE ProdukID = $produkID");
    $row = $result->fetch_assoc();
    $harga = $row['Harga'];
    $subtotal = $harga * $jumlahProduk;

    // Insert ke tabel penjualan
    $sql = "INSERT INTO penjualan (TanggalPenjualan, TotalHarga, PelangganID) VALUES (NOW(), '$subtotal', '$pelangganID')";
    if ($conn->query($sql) === TRUE) {
        $penjualanID = $conn->insert_id;
        // Insert ke tabel detailpenjualan
        $sql = "INSERT INTO detailpenjualan (PenjualanID, ProdukID, JumlahProduk, Subtotal, UserID) VALUES ('$penjualanID', '$produkID', '$jumlahProduk', '$subtotal', 1)";
        if ($conn->query($sql) === TRUE) {
            echo "Sale processed successfully";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Process Sale</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Process Sale</h1>
    <form method="post">
        <label for="pelangganID">Pelanggan ID:</label>
        <input type="number" id="pelangganID" name="pelangganID" required><br>
        <label for="produkID">Produk ID:</label>
        <input type="number" id="produkID" name="produkID" required><br>
        <label for="jumlahProduk">Jumlah Produk:</label>
        <input type="number" id="jumlahProduk" name="jumlahProduk" required><br>
        <button type="submit">Process Sale</button>
    </form>
    <a href="index.php">Back to Home</a>
</body>
</html>