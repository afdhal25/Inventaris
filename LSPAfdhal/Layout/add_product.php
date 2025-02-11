<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $conn = new mysqli('localhost', 'root', '', 'kasir');
    $namaProduk = $_POST['namaProduk'];
    $harga = $_POST['harga'];
    $stok = $_POST['stok'];

    $sql = "INSERT INTO produk (NamaProduk, Harga, Stok) VALUES ('$namaProduk', '$harga', '$stok')";
    if ($conn->query($sql) === TRUE) {
        echo "New product added successfully";
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
    <title>Add Product</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Add Product</h1>
    <form method="post">
        <label for="namaProduk">Nama Produk:</label>
        <input type="text" id="namaProduk" name="namaProduk" required><br>
        <label for="harga">Harga:</label>
        <input type="number" id="harga" name="harga" required><br>
        <label for="stok">Stok:</label>
        <input type="number" id="stok" name="stok" required><br>
        <button type="submit">Add Product</button>
    </form>
    <a href="index.php">Back to Home</a>
</body>
</html>