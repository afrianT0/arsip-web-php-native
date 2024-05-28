<?php
include "../../db/koneksi_db.php";
$con = new koneksi_db;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama       = test_input($_POST['nama']);
    $alamat     = test_input($_POST['alamat']);
    $telepon    = test_input($_POST['telepon']);

    date_default_timezone_set('Asia/Jakarta');

    if ($con->cek_nama_instansi($nama)) {
        $pesan = "Nama sudah digunakan!";
    } else {
        $data = $con->tambah_instansi($nama, $alamat, $telepon);

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
