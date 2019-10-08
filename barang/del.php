<?php
require_once "../config/c_barang.php";
if(isset($_GET['id'])) {   
    $lib = new Barang();
    $tampil = $lib->tampil();
    $data = $tampil->fetch(PDO::FETCH_OBJ);
    $data->gambar_barang;
    unlink('../template/assets/img/barang/'.$data->gambar_barang);

    $del = $lib->hapus(@$_GET['id']);
    echo $del;
}
?>