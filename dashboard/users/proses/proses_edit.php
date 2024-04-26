<?php
include "../../db/koneksi_db.php";
$con = new koneksi_db;

$id     = isset($_GET['id']) ? $_GET['id'] : null;
$data   = $con->select_user($id);

$url = htmlspecialchars($_SERVER["PHP_SELF"]) . '?id=' . urlencode($id);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username   = isset($_POST['username']) ? test_input($_POST['username']) : $data['username'];
    $email      = isset($_POST['email']) ? test_input($_POST['email']) : $data['email'];
    $level      = isset($_POST['level']) ? test_input($_POST['level']) : '';
    $picture    = isset($_SESSION['picture']) ? test_input($_SESSION['picture']) : '';

    date_default_timezone_set('Asia/Jakarta');

    $password = !empty($_POST['password']) ? test_input(md5($_POST['password'])) : $password = $data['password'];

    if ($username === $data['username'] && $email === $data['email']) {
        $data = $con->edit_user($id, $username, $email, $password, $level, $picture);

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
        if (empty($level)) {
            $pesanLevel = 'Mohon pilih level!';
        } else {
            $data = $con->edit_user($id, $username, $email, $password, $level, $picture);

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
