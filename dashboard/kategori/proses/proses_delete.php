<?php
include "../../db/koneksi_db.php";
$con = new koneksi_db;

$id = $_GET['id'];

if ($con->foreignkey_kategori($id)) {
    $_SESSION['gagal'] = 'Data tidak dapat dihapus karena terhubung dengan data lain.';
} else {
    $data = $con->hapus_kategori($id);

    $_SESSION[$data ? 'sukses' : 'gagal'] = $data ? 'Data berhasil dihapus' : 'Data gagal dihapus';
}

header("location: ./");
exit();
