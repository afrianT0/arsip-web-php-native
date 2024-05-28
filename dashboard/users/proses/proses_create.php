<?php
include "../../db/koneksi_db.php";
$con = new koneksi_db;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username   = test_input($_POST['username']);
    $nama       = test_input($_POST['nama']);
    $email      = test_input($_POST['email']);
    $password   = test_input(md5($_POST['password']));
    $level      = isset($_POST['level']) ? test_input($_POST['level']) : '';
    $gambar     = test_input('default.png');

    date_default_timezone_set('Asia/Jakarta');

    if ($con->cek_username($username) && $con->cek_email($email)) {
        $pesanUser  = "Username sudah digunakan!";
        $pesanEmail = "Email sudah digunakan!";
    } elseif ($con->cek_username($username)) {
        $pesanUser  = "Username sudah digunakan!";
    } elseif ($con->cek_email($email)) {
        $pesanEmail = "Email sudah digunakan!";
    } else {
        if (empty($level)) {
            $pesanLevel = 'Mohon pilih level!';
        } else {
            $data = $con->tambah_user($username, $nama, $email, $password, $level, $gambar);

            $_SESSION[$data ? 'sukses' : 'gagal'] = $data ? 'Data berhasil ditambahkan' : 'Data gagal ditambahkan';
            header("location: ./");
            exit();
        }
    }
}
function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
