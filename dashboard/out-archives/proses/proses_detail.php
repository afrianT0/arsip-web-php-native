<?php
include "../../db/koneksi_db.php";
$con = new koneksi_db;

$id     = isset($_GET['id']) ? $_GET['id'] : null;
$data   = $con->select_archives($id);
