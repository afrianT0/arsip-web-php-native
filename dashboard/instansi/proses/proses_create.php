<?php
include "../../db/koneksi_db.php";
$con = new koneksi_db;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = test_input($_POST['name']);
    $address = test_input($_POST['address']);
    $phone = test_input($_POST['phone']);

    date_default_timezone_set('Asia/Jakarta');

    if ($con->cek_name_instansi($name)) {
        $pesan = "Nama sudah digunakan!";
    } else {
        $data = $con->tambah_instansi($name, $address, $phone);

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
