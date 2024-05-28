<?php
include "../../db/koneksi_db.php";
$con = new koneksi_db;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = test_input($_POST['nama']);

    date_default_timezone_set('Asia/Jakarta');

    if ($con->cek_nama_kategori($nama)) {
        $pesan = "Nama sudah digunakan!";
    } else {
        $data = $con->tambah_kategori($nama);

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
