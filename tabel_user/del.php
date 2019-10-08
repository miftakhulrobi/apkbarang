<?php
require_once "../config/c_user.php";
if(isset($_GET['id'])) {
    $lib = new User();
    $del = $lib->hapus($_GET['id']);
    echo "<script>window.location='data.php';</script>";
}
?>