<?php
require_once "../config/c_user.php";

if(isset($_POST['add'])) {
    $nama_user = $_POST['nama_user'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $alamat = $_POST['alamat'];
    $no_telp = $_POST['no_telp'];
    $level = $_POST['level'];

    $user = new User();
    $add = $user->tambah($nama_user, $username, $password, $alamat, $no_telp, $level);
    if($add = "Sukses") {
        echo "<script>window.location='data.php';</script>";
    }
} else if(@$_POST['edit']) {
    $id_user = $_POST['id_user'];
    $nama_user = $_POST['nama_user'];
    $username = $_POST['username'];  
    $alamat = $_POST['alamat'];
    $no_telp = $_POST['no_telp'];
    $level = $_POST['level'];

    $user_edit = new User();
    $edite = $user_edit->update($id_user, $nama_user, $username, $alamat, $no_telp, $level);
    if($edite = "Sukses") {
        echo "<script>window.location='data.php';</script>";
    }
}
?>