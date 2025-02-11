<?php
$host = 'localhost';
$user = 'root'; // Ganti sesuai dengan user database Anda
$pass = ''; // Ganti sesuai dengan password database Anda
$dbname = 'kasir';

$conn = new mysqli($host, $user, $pass, $dbname);

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}
?>
