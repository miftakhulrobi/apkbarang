<?php
class Barang_stok {
    public function __construct() {
        $this->db = new PDO ('mysql:host=localhost;dbname=apkbarang;','root','');
    }

    public function tambah($id_barang, $stok, $total) {
        $sql = "INSERT INTO barang_masuk (id_barang, stok, total) VALUES ('$id_barang', '$stok', '$total')";
        $query = $this->db->query($sql);
        if(!$query) {
            return "Failed";
        } else {
            return "Sukses";
        }
    } 

    public function tampil() {
        $sql = "SELECT * FROM barang_masuk";
        $query = $this->db->query($sql);
        return $query;
    }

    public function edit($id) {
        $sql = "SELECT * FROM barang_masuk WHERE id = '$id'";
        $query = $this->db->query($sql);
        return $query;
    }

    public function tampiljumlah() {
        $sql = "SELECT SUM(total) FROM barang_masuk";
        $query = $this->db->query($sql);
        return $query;
    }

    public function hapus($id) {
        $sql = "DELETE FROM barang_masuk WHERE id = '$id'";
        $query = $this->db->query($sql);
    }

}
?>
