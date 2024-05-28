<?php
include "../../db/koneksi_db.php";
$con = new koneksi_db;

$id = $_GET['id'];
$data = $con->select_surat($id);

if (($_SESSION['id'] ?? null) !== ($data['user_id'] ?? null) && ($_SESSION['level'] ?? null) !== 'Administrator') {
    header("HTTP/1.1 403 Forbidden");
    exit();
}

$filename = "../../assets/file/" . $data['file'];

$data = $con->hapus_surat($id);

if ($data) {
    unlink($filename);
    $_SESSION['sukses'] = 'Data berhasil dihapus!';
} else {
    $_SESSION['gagal'] = 'Data gagal dihapus!';
}

header("location: ./");
exit();
