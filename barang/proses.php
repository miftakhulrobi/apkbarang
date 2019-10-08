<?php
require_once "../config/c_barang.php";

if(isset($_POST['add'])) {
    $id_barang = $_POST['id_barang'];
    $nama_barang = $_POST['nama_barang'];
    $deskripsi = $_POST['deskripsi'];
    $harga_barang = $_POST['harga_barang'];
    $stok_barang = $_POST['stok_barang'];

    $total = $harga_barang * $stok_barang;

    $extensi = explode(".", $_FILES['gambar_barang']['name']);
    $gambar_barang = "brg-".round(microtime(false)).".".end($extensi);
    $sumber = $_FILES['gambar_barang']['tmp_name'];
    $upload = move_uploaded_file($sumber, "../template/assets/img/barang/".$gambar_barang);

    $lib = new Barang();
    $add = $lib->tambah($id_barang, $nama_barang, $deskripsi, $harga_barang, $stok_barang, $total, $gambar_barang);
    if($add = "Sukses") {
        echo "<script>window.location='data.php';</script>";
    }
} else if(isset($_POST['edit'])) {
    $id_barang = $_POST['id_barang'];
    $nama_barang = $_POST['nama_barang'];
    $deskripsi = $_POST['deskripsi'];
    $harga_barang = $_POST['harga_barang'];
    $stok_barang = $_POST['stok_barang'];

    $total = $harga_barang * $stok_barang;

    $pict = $_FILES['gambar_barang']['name'];
    $extensi = explode(".", $_FILES['gambar_barang']['name']);
    $gambar_barang = "brg-".round(microtime(false)).".".end($extensi);
    $sumber = $_FILES['gambar_barang']['tmp_name'];

    if($pict == "") {
    $lib = new Barang();
    $add = $lib->update_no_gmbr($id_barang, $nama_barang, $deskripsi, $harga_barang, $stok_barang, $total);
        if($add = "Sukses") {
            echo "<script>window.location='data.php';</script>";
        }
    } else {
        $lib = new Barang();
        $gbr = $lib->tampil();
        $gbr_awal = $gbr->fetch(PDO::FETCH_OBJ);
        $gbr_hps = $gbr_awal->gambar_barang;
        unlink("../template/assets/img/barang/".$gbr_hps);
      
        $upload = move_uploaded_file($sumber, "../template/assets/img/barang/".$gambar_barang);
        $lib = new Barang();
        $ad = $lib->update($id_barang, $nama_barang, $deskripsi, $harga_barang, $stok_barang, $total, $gambar_barang);
        if($ad = "Sukses") {
            echo "<script>window.location='data.php';</script>";
        }
    }
}


?>
    