<?php
require_once "../config/c_transaksi.php";
if(isset($_GET['id'])) {
    $lib = new Transaksi();
    $del = $lib->hapus($_GET['id']);
    echo "<script>window.location='data.php';</script>";
}
?>