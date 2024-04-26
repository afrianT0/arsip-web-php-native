<?php
if ($_SESSION['level'] != "Administrator") {
    header("HTTP/1.1 403 Forbidden");
    require_once('../../error403.php');
    exit();
}
