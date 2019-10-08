<?php
require_once "../config/c_dashboard.php";

if(isset($_POST['edit'])) {
    $header = $_POST['header'];
    $alamat = $_POST['alamat'];
    $isi = $_POST['isi'];
    $footer = $_POST['footer'];

    $lib = new Dashboard();
    $upd = $lib->update($header, $alamat, $isi, $footer);
    if($upd == "Sukses") {
        header("location: index.php");
    }
}
?>

