<?php
include "../../db/koneksi_db.php";
$con    = new koneksi_db;
$id     = isset($_GET['id']) ? $_GET['id'] : null;
$data   = $con->select_user($id);
$url    = htmlspecialchars($_SERVER["PHP_SELF"]) . '?id=' . urlencode($id);

if ($_SESSION['id'] !== $data['id'] && $_SESSION['level'] !== 'Administrator') {
    header("HTTP/1.1 403 Forbidden");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username   = isset($_POST['username']) ? test_input($_POST['username']) : $data['username'];
    $nama       = isset($_POST['nama']) ? test_input($_POST['nama']) : $data['nama'];
    $email      = isset($_POST['email']) ? test_input($_POST['email']) : $data['email'];
    $level      = test_input($data['level']);

    $password   = !empty($_POST['password']) ? test_input(md5($_POST['password'])) : $password = $data['password'];

    date_default_timezone_set('Asia/Jakarta');

    $nama_file_lengkap  = $_FILES['fileupload']['name'];

    if (!$nama_file_lengkap == '') {
        $ext_file           = pathinfo($nama_file_lengkap, PATHINFO_EXTENSION);
        $tipe_file          = $_FILES['fileupload']['type'];
        $ukuran_file        = $_FILES['fileupload']['size'];
        $tmp_file           = $_FILES['fileupload']['tmp_name'];
        $max_file_size      = 2 * 1024 * 1024; // 2MB

        $allowed_mime_types = array("image/png", "image/jpeg", "image/jpg");

        if ($ukuran_file > $max_file_size) {
            $_SESSION['gagal'] = "Ukuran file terlalu besar. Maksimal 2MB.";
            header("location: ./edit?id=" . urlencode($id));
            exit();
        } elseif (!in_array($tipe_file, $allowed_mime_types)) {
            $_SESSION['gagal'] = "Jenis file tidak didukung. Silakan unggah file .png/.jpeg/.jpg.";
            header("location: ./edit?id=" . urlencode($id));
            exit();
        }

        $filename = "../../assets/images/users/" . $data['gambar'];
        $nama_file_baru = uniqid() . '.' . $ext_file;
        $path = "../../assets/images/users/" . $nama_file_baru;

        if ($username === $data['username'] && $email === $data['email']) {
            $data = $con->edit_user($id, $username, $nama, $email, $password, $level, $nama_file_baru);

            if ($data) {
                if (move_uploaded_file($tmp_file, $path)) {
                    $_SESSION['sukses'] = 'Data berhasil diubah';
                    unlink($filename);
                    header("location: ./");
                    exit();
                } else {
                    $_SESSION['gagal'] = "Terjadi kesalahan saat mengunggah file. Silakan coba lagi.";
                }
            } else {
                $_SESSION['gagal'] = 'Data gagal diubah';
            }
        } elseif ($username !== $data['username'] && $con->cek_username($username)) {
            $pesanUser = "Username sudah digunakan!";
        } elseif ($email !== $data['email'] && $con->cek_email($email)) {
            $pesanEmail = "Email sudah digunakan!";
        } elseif ($con->cek_username($username) && $con->cek_email($email)) {
            $pesanUser = "Username sudah digunakan!";
            $pesanEmail = "Email sudah digunakan!";
        } else {
            unlink($filename);
            $data = $con->edit_user($id, $username, $nama, $email, $password, $level, $nama_file_baru);

            if ($data) {
                if (move_uploaded_file($tmp_file, $path)) {
                    $_SESSION['sukses'] = 'Data berhasil diubah';
                    unlink($filename);
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
        $nama_file_br = $data['gambar'];

        if ($username === $data['username'] && $email === $data['email']) {
            $data = $con->edit_user($id, $username, $nama, $email, $password, $level, $nama_file_br);

            $_SESSION[$data ? 'sukses' : 'gagal'] = $data ? 'Data berhasil diubah' : 'Data gagal diubah';
            header("location: ./");
            exit();
        } elseif ($username !== $data['username'] && $con->cek_username($username)) {
            $pesanUser = "Username sudah digunakan!";
        } elseif ($email !== $data['email'] && $con->cek_email($email)) {
            $pesanEmail = "Email sudah digunakan!";
        } elseif ($con->cek_username($username) && $con->cek_email($email)) {
            $pesanUser = "Username sudah digunakan!";
            $pesanEmail = "Email sudah digunakan!";
        } else {
            $data = $con->edit_user($id, $username, $nama, $email, $password, $level, $nama_file_br);

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
