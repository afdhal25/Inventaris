<?php
session_start();
include 'koneksi.php'; // Pastikan koneksi sudah benar

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    // Cek apakah username ada di database
    $stmt = $conn->prepare("SELECT user_id, password FROM user WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();

    // Jika username ditemukan
    if ($stmt->num_rows > 0) {
        $stmt->bind_result($user_id, $hashed_password);
        $stmt->fetch();

        // Verifikasi password yang dimasukkan dengan yang ada di database
        if (password_verify($password, $hashed_password)) {
            // Password benar, buat sesi login
            $_SESSION['user_id'] = $user_id;
            $_SESSION['username'] = $username;
            header("Location: dashboard.php"); // Arahkan ke dashboard
            exit;
        } else {
            $_SESSION['error'] = "Password salah!";
            header("Location: login.php");
            exit;
        }
    } else {
        $_SESSION['error'] = "Username tidak ditemukan!";
        header("Location: login.php");
        exit;
    }

    $stmt->close();
    $conn->close();
}
?>


<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrasi Akun</title>
    <link rel="stylesheet" href="registrasi.css"> 

</head>
<body>
    <h2>Registrasi Akun Baru</h2>
    
    <?php 
    if (isset($_SESSION['error'])) {
        echo "<p style='color: red;'>" . $_SESSION['error'] . "</p>";
        unset($_SESSION['error']); // Hapus pesan setelah ditampilkan
    }
    
    if (isset($_SESSION['success'])) {
        echo "<p style='color: green;'>" . $_SESSION['success'] . "</p>";
        unset($_SESSION['success']);
    }
    ?>

    <form action="registrasi.php" method="POST">
        <label for="username">Username:</label>
        <input type="text" name="username" required><br>
        
        <label for="password">Password:</label>
        <input type="password" name="password" required><br>

        <label for="confirm_password">Konfirmasi Password:</label>
        <input type="password" name="confirm_password" required><br>

        <button type="submit">Daftar</button>
    </form>
</body>
</html>
