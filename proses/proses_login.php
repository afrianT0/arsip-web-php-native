<?php
session_start();
include "../db/koneksi_db.php";
$con = new koneksi_db;

$username = test_input($_POST['username']);
$password = test_input(md5($_POST['password']));

$data = $con->login($username);
// $isi = $data->fetch_assoc();

if ($data > 0 && $password == $data["password"]) {
    $_SESSION["id"] = $data["id"];
    $_SESSION["username"] = $data["username"];
    $_SESSION["email"] = $data["email"];
    $_SESSION["level"] = $data["level"];
    $_SESSION["picture"] = $data["picture"];

    if (isset($_POST['remember'])) {
        $time = time();
        setcookie('login', $username, $time + 3600);
    }

    // $_SESSION['sukses'] = 'Berhasil Login!';
    header("location: ../dashboard");
    exit();
} else {
    $_SESSION['gagal'] = 'Username atau Password salah!';
    header("location: ../");
    exit();
}

function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
