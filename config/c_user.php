<?php
class User {
    public function __construct() {
        $this->db = new PDO ('mysql:host=localhost;dbname=apkbarang;','root','');
    }

    public function tambah($nama_user, $username, $password, $alamat, $no_telp, $level) {
        $sql = "INSERT INTO user (nama_user, username, password, alamat, no_telp, level) VALUES ('$nama_user', '$username', '$password', '$alamat', '$no_telp', '$level')";
        $query = $this->db->query($sql);
        if(!$query) {
            return "Failed";
        } else {
            return "Sukses";
        }
    }

    public function edit($id_user) {
        $sql = "SELECT * FROM user WHERE id_user = '$id_user'";
        $query = $this->db->query($sql);
        return $query;
    }

    public function update($id_user, $nama_user, $username, $alamat, $no_telp, $level) {
        $sql = "UPDATE user SET nama_user = '$nama_user', username = '$username', alamat = '$alamat', no_telp = '$no_telp', level = '$level' WHERE id_user = '$id_user' ";
        $query = $this->db->query($sql);
        if(!$query) {
            return "Failed";
        } else {
            return "Sukses";
        }
    }

    public function tampil() {
        $sql = "SELECT * FROM user";
        $query = $this->db->query($sql);
        return $query;
    }

    public function hapus($id_user) {
        $sql = "DELETE FROM user WHERE id_user = '$id_user'";
        $query = $this->db->query($sql);
    }
}
  
?>
