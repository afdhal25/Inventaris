<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Koneksi ke database
$servername = "localhost";
$dbname = "kasir";
$username = "root";
$password = "";

$conn = new mysqli($servername, $username, $password, $dbname);

// Cek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Pastikan ada data di POST sebelum mencoba untuk memproses
    if (isset($_POST['username']) && isset($_POST['password'])) {
        $inputUsername = trim($_POST['username']);
        $inputPassword = trim($_POST['password']);

        // Gunakan prepared statements untuk keamanan
        $sql = "SELECT * FROM user WHERE username = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $inputUsername);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();
            
            // Cek apakah password cocok langsung
            if ($inputPassword === $user['password']) {
                // Password benar, buat sesi login
                $_SESSION['UserID'] = $user['UserID'];
                $_SESSION['role'] = $user['role'];
                header('Location: index.php');
                exit;
            } else {
                $_SESSION['error'] = "Password salah!";
                header("Location: login.php");
                exit;
            }
        } else {
            // Jika username tidak ditemukan
            $_SESSION['error'] = "Username atau password salah!";
            header("Location: login.php");
            exit;
        }

        $stmt->close();
    } else {
        $_SESSION['error'] = "Data login tidak lengkap!";
        header("Location: login.php");
        exit;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="Login.css">
</head>
<body>
    <div class="login-container">
        <h2>Login</h2>
        <?php if (isset($_SESSION['error'])) { echo "<p style='color:red;'>".$_SESSION['error']."</p>"; unset($_SESSION['error']); } ?>
        <form action="" method="POST">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required>

            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>

            <button type="submit">Login</button>
        </form>
    </div>
</body>
</html>