<?php
require_once "../config/c_transaksi.php";

if(isset($_POST['add'])) {
    $id_transaksi = $_POST['id_transaksi'];
    $id_barang = $_POST['id_barang'];
    $jumlah = $_POST['jumlah'];
    $harga_barang = $_POST['harga_barang'];
    $nama_pelanggan = $_POST['nama_pelanggan'];

    $hasil = $jumlah * $harga_barang;

    $transaksi = new Transaksi();
    $add = $transaksi->tambah($id_transaksi, $id_barang, $jumlah, $hasil, $nama_pelanggan);
    if($add = "Sukses") {
        echo "<script>window.location='data.php';</script>";
    }
} 
?>