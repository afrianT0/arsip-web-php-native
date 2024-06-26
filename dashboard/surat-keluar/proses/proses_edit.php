<?php
include "../../db/koneksi_db.php";
$con = new koneksi_db;

$id     = isset($_GET['id']) ? $_GET['id'] : null;
$data   = $con->select_surat($id);

$url = htmlspecialchars($_SERVER["PHP_SELF"]) . '?id=' . urlencode($id);

if (($_SESSION['id'] ?? null) !== ($data['user_id'] ?? null) && ($_SESSION['level'] ?? null) !== 'Administrator') {
    header("HTTP/1.1 403 Forbidden");
    exit();
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $kategori   = test_input($_POST['kategori']);
    $instansi   = test_input($_POST['instansi']);
    $nama       = test_input($_POST['nama']);
    $nomor      = test_input($_POST['nomor']);
    $tanggal    = test_input($_POST['tanggal']);
    $deskripsi  = test_input($_POST['deskripsi']);
    $tipe_surat = test_input($data['tipe_surat']);
    $petugas    = test_input($data['user_id']);
    $status     = test_input($data['status']);

    date_default_timezone_set('Asia/Jakarta');

    $nama_file_lengkap  = $_FILES['fileupload']['name'];

    if (!$nama_file_lengkap == '') {
        $ext_file           = pathinfo($nama_file_lengkap, PATHINFO_EXTENSION);
        $tipe_file          = $_FILES['fileupload']['type'];
        $ukuran_file        = $_FILES['fileupload']['size'];
        $tmp_file           = $_FILES['fileupload']['tmp_name'];
        $max_file_size      = 2 * 1024 * 1024; // 2MB

        if ($ukuran_file > $max_file_size) {
            $_SESSION['gagal'] = "Ukuran file terlalu besar. Maksimal 2MB.";
            header("location: ./edit?id=" . urlencode($id));
            exit();
        } elseif ($tipe_file  != "application/pdf") {
            $_SESSION['gagal'] = "Jenis file tidak didukung. Silakan unggah file PDF.";
            header("location: ./edit?id=" . urlencode($id));
            exit();
        }

        $filename = "../../assets/file/" . $data['file'];
        unlink($filename);

        $nama_file_baru = 'surat-keluar/' . $tanggal . '-' . uniqid() . '.' . $ext_file;

        $path = "../../assets/file/" . $nama_file_baru;
        if ($nomor === $data['nomor']) {
            $data = $con->edit_surat($id, $kategori, $petugas, $instansi, $nama,  $nomor, $tanggal, $deskripsi, $nama_file_baru, $status, $tipe_surat);

            if ($data) {
                if (move_uploaded_file($tmp_file, $path)) {
                    $_SESSION['sukses'] = 'Data berhasil diubah';
                    header("location: ./");
                    exit();
                } else {
                    $_SESSION['gagal'] = "Terjadi kesalahan saat mengunggah file. Silakan coba lagi.";
                }
            } else {
                $_SESSION['gagal'] = 'Data gagal diubah';
            }
        } elseif ($con->cek_nomor_surat($nomor)) {
            $pesanNomor = "Nomor surat sudah digunakan!";
        } else {
            $data = $con->edit_surat($id, $kategori, $petugas, $instansi, $nama, $nomor, $tanggal, $deskripsi, $nama_file_baru, $status, $tipe_surat);

            if ($data) {
                if (move_uploaded_file($tmp_file, $path)) {
                    $_SESSION['sukses'] = 'Data berhasil diubah';
                    header("location: ./");
                    exit();
                } else {
                    $_SESSION['gagal'] = "Terjadi kesalahan saat mengunggah file. Silakan coba lagi.";
                }
            } else {
                $_SESSION['gagal'] = 'Data gagal diubah';
            }
        }
    } else {
        $nama_file_br = $data['file'];
        if ($nomor === $data['nomor']) {
            $data = $con->edit_surat($id, $kategori, $petugas, $instansi, $nama, $nomor, $tanggal, $deskripsi, $nama_file_br, $status, $tipe_surat);

            $_SESSION[$data ? 'sukses' : 'gagal'] = $data ? 'Data berhasil diubah' : 'Data gagal diubah';
            header("location: ./");
            exit();
        } elseif ($con->cek_nomor_surat($nomor)) {
            $pesanNomor = "Nomor surat sudah digunakan!";
        } else {
            $data = $con->edit_surat($id, $kategori, $petugas, $instansi, $nama, $nomor, $tanggal, $deskripsi, $nama_file_br, $status, $tipe_surat);

            $_SESSION[$data ? 'sukses' : 'gagal'] = $data ? 'Data berhasil diubah' : 'Data gagal diubah';
            header("location: ./");
            exit();
        }
    }
}

function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
