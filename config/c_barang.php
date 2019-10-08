<?php
class Barang {
    public function __construct() {
        $this->db = new PDO ('mysql:host=localhost;dbname=apkbarang;','root','');
    }

    public function tambah($id_barang, $nama_barang, $deskripsi, $harga_barang, $stok_barang, $total, $gambar_barang) {
        $sql = "INSERT INTO barang (id_barang, nama_barang, deskripsi, harga_barang, stok_barang, total, gambar_barang, tgl_publish) VALUES ('$id_barang', '$nama_barang', '$deskripsi', '$harga_barang', '$stok_barang', '$total', '$gambar_barang', now())";
        $query = $this->db->query($sql);
        if(!$query) {
            return "Failed";
        } else {
            return "Sukses";
        }
    }

    public function edit($id_barang) {
        $sql = "SELECT * FROM barang WHERE id_barang = '$id_barang'";
        $query = $this->db->query($sql);
        return $query;
    }

    public function update($id_barang, $nama_barang, $deskripsi, $harga_barang, $stok_barang, $total, $gambar_barang) {
        $sql = "UPDATE barang SET nama_barang = '$nama_barang', deskripsi = '$deskripsi', harga_barang = '$harga_barang', stok_barang = '$stok_barang', total = '$total', gambar_barang = '$gambar_barang' WHERE id_barang = '$id_barang' ";
        $query = $this->db->query($sql);
        if(!$query) {
            return "Failed";
        } else {
            return "Sukses";
        }
    }

    public function update_no_gmbr($id_barang, $nama_barang, $deskripsi, $harga_barang, $stok_barang, $total) {
        $sql = "UPDATE barang SET nama_barang = '$nama_barang', deskripsi = '$deskripsi', harga_barang = '$harga_barang', stok_barang = '$stok_barang', total = '$total' WHERE id_barang = '$id_barang' ";
        $query = $this->db->query($sql);
        if(!$query) {
            return "Failed";
        } else {
            return "Sukses";
        }
    }

    public function update_stok($id_barang, $stok_barang) {
        $sql = "UPDATE barang SET stok_barang = '$stok_barang' WHERE id_barang = '$id_barang' ";
        $query = $this->db->query($sql);
        if(!$query) {
            return "Failed";
        } else {
            return "Sukses";
        }
    }

    public function tampil() {
        $sql = "SELECT * FROM barang";
        $query = $this->db->query($sql);
        return $query;
    }

    public function tampilgbr($id_barang) {
        $sql = "SELECT * FROM barang WHERE id_barang = '$id_barang'";
        $query = $this->db->query($sql);
        return $query;
    }

    public function tampiljumlah() {
        $sql = "SELECT SUM(total) FROM barang";
        $query = $this->db->query($sql);
        return $query;
    }

    public function hapus($id_barang) {
        $sql = "DELETE FROM barang WHERE id_barang = '$id_barang'";
        $query = $this->db->query($sql);
    }
}
  
?>
