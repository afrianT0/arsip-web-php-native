<?php
session_start();
//Jika belum login
if (!isset($_SESSION["id"])) {
    $_SESSION['gagal'] = 'Anda belum login!';
    header("location: ../");
    exit();
}

//Jika tidak ada aktivitas
$timeout = 3600; // 1 JAM
if (isset($_SESSION['last_activity']) && (time() - $_SESSION['last_activity']) > $timeout) {
    session_unset();
    session_destroy();
    header('location: ../?pesan=timeout');
    exit();
} else {
    $_SESSION['last_activity'] = time();
}
