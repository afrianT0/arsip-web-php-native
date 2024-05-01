<?php
include "../../db/koneksi_db.php";
$con = new koneksi_db;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = test_input($_POST['name']);

    date_default_timezone_set('Asia/Jakarta');

    if ($con->cek_name_categories($name)) {
        $pesan = "Nama sudah digunakan!";
    } else {
        $data = $con->tambah_categories($name);

        $_SESSION[$data ? 'sukses' : 'gagal'] = $data ? 'Data berhasil ditambahkan' : 'Data gagal ditambahkan';
        header("location: ./");
        exit();
    }
}

function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
