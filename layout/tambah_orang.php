<?php
session_start();
include 'koneksi.php'; // Pastikan file koneksi database sudah benar

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama_orang = trim($_POST['nama_orang']); // Ambil nama orang dari form

    if (!empty($nama_orang)) {
        // Simpan data ke tabel supplier (atau ganti ke tabel yang digunakan)
        $sql = "INSERT INTO supplier (nama_orang) VALUES (?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $nama_orang);

        if ($stmt->execute()) {
            echo "<script>alert('Nama berhasil ditambahkan!'); window.location='supplier.php';</script>";
        } else {
            echo "<script>alert('Gagal menambahkan nama: " . $stmt->error . "'); window.location='supplier.php';</script>";
        }

        $stmt->close();
    } else {
        echo "<script>alert('Nama tidak boleh kosong!'); window.location='supplier.php';</script>";
    }
}

$conn->close();
?>
