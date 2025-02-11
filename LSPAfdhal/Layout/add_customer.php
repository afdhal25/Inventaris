<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $conn = new mysqli('localhost', 'root', '', 'kasir');
    $namaPelanggan = $_POST['namaPelanggan'];
    $alamat = $_POST['alamat'];
    $nomorTelepon = $_POST['nomorTelepon'];

    $sql = "INSERT INTO pelanggan (NamaPelanggan, Alamat, NomorTelepon) VALUES ('$namaPelanggan', '$alamat', '$nomorTelepon')";
    if ($conn->query($sql) === TRUE) {
        echo "New customer added successfully";
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
    <title>Add Customer</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Add Customer</h1>
    <form method="post">
        <label for="namaPelanggan">Nama Pelanggan:</label>
        <input type="text" id="namaPelanggan" name="namaPelanggan" required><br>
        <label for="alamat">Alamat:</label>
        <input type="text" id="alamat" name="alamat" required><br>
        <label for="nomorTelepon">Nomor Telepon:</label>
        <input type="text" id="nomorTelepon" name="nomorTelepon" required><br>
        <button type="submit">Add Customer</button>
    </form>
    <a href="index.php">Back to Home</a>
</body>
</html>