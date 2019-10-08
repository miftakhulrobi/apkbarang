<?php
require_once "../config/c_barang_masuk.php";

if(isset($_POST['add_stok'])) {
    $id_barang = $_POST['id_barang'];
    $stok = $_POST['stok'];
    $harga_barang = $_POST['harga_barang'];

    $total = $stok * $harga_barang;

    $t = new Barang_stok();
    $add_stok = $t->tambah($id_barang, $stok, $total);
    if($add_stok == "Sukses") {
        echo "<script>window.location='data.php';</script>";
    }
}
?>