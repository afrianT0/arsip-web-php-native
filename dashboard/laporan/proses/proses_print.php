<?php
include '../../db/koneksi_db.php';
$con = new koneksi_db;

$surat          = isset($_GET['surat']) ? $_GET['surat'] : '';
$tanggal_awal   = isset($_GET['tanggal_awal']) ? $_GET['tanggal_awal'] : '';
$tanggal_akhir  = isset($_GET['tanggal_akhir']) ? $_GET['tanggal_akhir'] : '';

if (empty($tanggal_awal) || empty($tanggal_akhir)) {
    $query      = $con->get_all_archives();
    $url_cetak  = "print.php";
} else {
    $url_cetak  = "print.php?surat=$surat&tanggal_awal=$tanggal_awal&tanggal_akhir=$tanggal_akhir&filter=true";

    switch ($surat) {
        case 0:
            $query = $con->cetak_semua_surat($tanggal_awal, $tanggal_akhir);
            break;
        case 1:
            $query = $con->cetak_semua_masuk($surat, $tanggal_awal, $tanggal_akhir);
            break;
        case 2:
            $query = $con->cetak_semua_keluar($surat, $tanggal_awal, $tanggal_akhir);
            break;
        default:
            $pesan = 'Pilih jenis surat dahulu.';
            $query = $con->get_all_archives();
            break;
    }
}
