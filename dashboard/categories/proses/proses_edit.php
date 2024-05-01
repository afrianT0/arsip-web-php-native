<?php
include "../../db/koneksi_db.php";
$con = new koneksi_db;
$id = $_GET['id'];
$data = $con->select_categories($id);

$url = htmlspecialchars($_SERVER["PHP_SELF"]) . '?id=' . urlencode($id);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = test_input($_POST['name']);

    date_default_timezone_set('Asia/Jakarta');

    if ($name === $data['name']) {
        $_SESSION[$data ? 'sukses' : 'gagal'] = $data ? 'Data berhasil diubah' : 'Data gagal diubah';
        header("location: ./");
        exit();
    } elseif ($con->cek_name_categories($name)) {
        $pesan = 'Nama sudah digunakan!';
    } else {
        $data = $con->edit_categories($id, $name);

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
