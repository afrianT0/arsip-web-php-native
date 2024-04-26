<?php
include "../../db/koneksi_db.php";
$con = new koneksi_db;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $category           = test_input($_POST['category']);
    $instansi           = test_input($_POST['instansi']);
    $nomor              = test_input($_POST['nomor']);
    $nama               = test_input($_POST['nama']);
    $tanggal_surat      = test_input($_POST['tanggal']);
    $deskripsi          = test_input($_POST['deskripsi']);
    $tipe_surat         = 1; // 1 = Surat Masuk, 2 = Surat Keluar
    $petugas            = $_SESSION['id'];

    $tanggal            = date('Y-m-d', strtotime($tanggal_surat));

    date_default_timezone_set('Asia/Jakarta');

    $nama_file_lengkap  = $_FILES['fileupload']['name'];
    $ext_file           = pathinfo($nama_file_lengkap, PATHINFO_EXTENSION);
    $tipe_file          = $_FILES['fileupload']['type'];
    $ukuran_file        = $_FILES['fileupload']['size'];
    $tmp_file           = $_FILES['fileupload']['tmp_name'];

    $max_file_size = 2 * 1024 * 1024; // 2MB

    if (isset($_FILES['fileupload'])) {
        if ($ukuran_file > $max_file_size) {
            $_SESSION['gagal'] = "Ukuran file terlalu besar. Maksimal 2MB.";
            // header("location: ./create");
            // exit();
        } elseif ($tipe_file  != "application/pdf") {
            $_SESSION['gagal'] = "Jenis file tidak didukung. Silakan unggah file PDF.";
            // header("location: ./create");
            // exit();
        } else {
            $nama_file_baru = $tanggal . '-' . uniqid() . '.' . $ext_file;

            $path = "../in-archives/file/" . $nama_file_baru;
            if ($con->cek_number_archives($nomor)) {
                $pesanNomor = "Nomor surat sudah digunakan!";
            } else {
                $data = $con->tambah_archives($category, $petugas, $instansi, $nama, $nomor, $tanggal, $deskripsi, $nama_file_baru, $tipe_surat);

                if ($data) {
                    if (move_uploaded_file($tmp_file, $path)) {
                        $_SESSION['sukses'] = 'Data berhasil ditambahkan';
                        header("location: ./");
                        exit();
                    } else {
                        $_SESSION['gagal'] = "Terjadi kesalahan saat mengunggah file. Silakan coba lagi.";
                    }
                } else {
                    $_SESSION['gagal'] = 'Data gagal ditambahkan';
                }
            }
        }
    } else {
        $_SESSION['gagal'] = "Tidak ada file yang diunggah.";
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
