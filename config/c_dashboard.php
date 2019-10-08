<?php
class Dashboard {
    public function __construct() {
        $this->db = new PDO ('mysql:host=localhost;dbname=apkbarang;','root','');
    }


    public function update($header, $alamat, $isi, $footer) {
        $sql = "UPDATE dashboard SET header = '$header', alamat = '$alamat', isi = '$isi', footer = '$footer' ";
        $query = $this->db->query($sql);
        if(!$query) {
            return "Failed";
        } else {
            return "Sukses";
        }
    }

    public function tampil() {
        $sql = "SELECT * FROM dashboard";
        $query = $this->db->query($sql);
        return $query;
    }

}
?>