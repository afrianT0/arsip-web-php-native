<?php
include "../../db/koneksi_db.php";
$con = new koneksi_db;
$id = $_GET['id'];
$data = $con->select_instansi($id);

$url = htmlspecialchars($_SERVER["PHP_SELF"]) . '?id=' . urlencode($id);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama       = isset($_POST['nama']) ? test_input($_POST['nama']) : $data['nama'];
    $alamat     = isset($_POST['alamat']) ? test_input($_POST['alamat']) : $data['alamat'];
    $telepon    = isset($_POST['telepon']) ? test_input($_POST['telepon']) : $data['telepon'];

    date_default_timezone_set('Asia/Jakarta');

    if ($nama === $data['nama']) {
        $data = $con->edit_instansi($id, $nama, $alamat, $telepon);

        $_SESSION[$data ? 'sukses' : 'gagal'] = $data ? 'Data berhasil diubah' : 'Data gagal diubah';
        header("location: ./");
        exit();
    } elseif ($con->cek_nama_instansi($nama)) {
        $pesan = 'Nama sudah digunakan!';
    } else {
        $data = $con->edit_instansi($id, $nama, $alamat, $telepon);

        $_SESSION[$data ? 'sukses' : 'gagal'] = $data ? 'Data berhasil diubah' : 'Data gagal diubah';
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
