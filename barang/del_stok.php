<?php
require_once "../config/c_barang_masuk.php";
if(isset($_GET['id'])) {
    $lib = new Barang_stok();
    $del = $lib->hapus($_GET['id']);
    echo "<script>window.location='stok_masuk.php';</script>";
}
?>