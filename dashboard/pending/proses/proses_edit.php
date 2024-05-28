<?php
session_start();
include "../../../db/koneksi_db.php";
$con    = new koneksi_db;
$id     = isset($_GET['id']) ? $_GET['id'] : null;
$data   = $con->select_surat($id);

if (($_SESSION['level'] ?? null) !== 'Validator' && ($_SESSION['level'] ?? null) !== 'Administrator') {
    header("HTTP/1.1 403 Forbidden");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $kategori   = test_input($data['kategori_id']);
    $petugas    = test_input($data['user_id']);
    $instansi   = test_input($data['instansi_id']);
    $nama       = test_input($data['nama']);
    $nomor      = test_input($data['nomor']);
    $tanggal    = test_input($data['tanggal']);
    $deskripsi  = test_input($data['deskripsi']);
    $file       = test_input($data['file']);
    $tipe_surat = test_input($data['tipe_surat']);

    $status     = isset($_POST['status']) ? test_input($_POST['status']) : $data['status'];

    date_default_timezone_set('Asia/Jakarta');

    $data = $con->edit_surat($id, $kategori, $petugas, $instansi, $nama, $nomor, $tanggal, $deskripsi, $file, $status, $tipe_surat);

    $_SESSION[$data ? 'sukses' : 'gagal'] = $data ? 'Data berhasil diubah' : 'Data gagal diubah';
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
