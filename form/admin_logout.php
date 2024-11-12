<?php
// Mulai sesi
session_start();

// Hancurkan semua data sesi
session_unset();
session_destroy();

// Arahkan kembali ke halaman login
header("Location: /vitonbook-native/admin/admin_login.php");
exit();
?>
