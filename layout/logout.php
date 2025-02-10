<?php
session_start();
$_SESSION = []; // Kosongkan array session
session_unset(); // Hapus semua variabel sesi
session_destroy(); // Hapus sesi

// Hapus cookie sesi jika ada
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

// Redirect ke halaman login
header('Location: login.php');
exit;
?>
