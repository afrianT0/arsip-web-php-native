<?php
include "../../db/koneksi_db.php";
$con = new koneksi_db;

$id = $_GET['id'];
$data = $con->select_archives($id);

if ($_SESSION['id'] !== $data['user_id'] && $_SESSION['level'] !== 'Administrator') {
    header("HTTP/1.1 403 Forbidden");
    require_once('../../error403.php');
    exit();
}

$filename = "../out-archives/file/" . $data['file'];

$data = $con->hapus_archives($id);

if ($data) {
    unlink($filename);
    $_SESSION['sukses'] = 'Data berhasil dihapus!';
} else {
    $_SESSION['gagal'] = 'Data gagal dihapus!';
}

header("location: ./");
exit();
