<?php
class Transaksi {
    public function __construct() {
        $this->db = new PDO ('mysql:host=localhost;dbname=apkbarang;','root','');
    }

    public function tambah($id_transaksi, $id_barang, $jumlah, $hasil, $nama_pelanggan) {
        $sql = "INSERT INTO transaksi (id_transaksi, id_barang, jumlah, harga_barang, nama_pelanggan, tgl_transaksi) VALUES ('$id_transaksi', '$id_barang', '$jumlah', '$hasil', '$nama_pelanggan', now())";
        $query = $this->db->query($sql);
        if(!$query) {
            return "Failed";
        } else {
            return "Sukses";
        }
    }

    public function tampil() {
        $sql = "SELECT * FROM transaksi";
        $query = $this->db->query($sql);
        return $query;
    }

    public function edit($id_transaksi) {
        $sql = "SELECT * FROM transaksi WHERE id_transaksi = '$id_transaksi'";
        $query = $this->db->query($sql);
        return $query;
    }

    public function tampiljumlah() {
        $sql = "SELECT SUM(harga_barang) FROM transaksi";
        $query = $this->db->query($sql);
        return $query;
    }

    public function hapus($id_transaksi) {
        $sql = "DELETE FROM transaksi WHERE id_transaksi = '$id_transaksi'";
        $query = $this->db->query($sql);
    }

    public function tampil_tgl($tgl1, $tgl2) {
        $sql = "SELECT * FROM transaksi WHERE tgl_transaksi BETWEEN '$tgl1' AND '$tgl2'";
        $query = $this->db->query($sql);
        return $query;
    }
}
  
?>
