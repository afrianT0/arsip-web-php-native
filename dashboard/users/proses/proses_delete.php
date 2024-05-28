<?php
include "../../db/koneksi_db.php";
$con = new koneksi_db;

$id = $_GET['id'];

$gambar = "../../assets/images/users/" . $data['gambar'];

if ($con->foreignkey_user($id)) {
    $_SESSION['gagal'] = 'Data tidak dapat dihapus karena terhubung dengan data lain.';
} else {
    if ($data['gambar'] != 'default.png') {
        unlink($gambar);
    }
    $data = $con->hapus_user($id);
    $_SESSION[$data ? 'sukses' : 'gagal'] = $data ? 'Data berhasil dihapus!' : 'Data gagal dihapus!';
}



header("location: ./");
exit();
