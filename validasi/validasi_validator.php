<?php
if ($_SESSION['level'] != "Administrator" && $_SESSION['level'] != "Validator") {
    header("HTTP/1.1 403 Forbidden");
    exit();
}
