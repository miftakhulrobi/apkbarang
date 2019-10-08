-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 08 Okt 2019 pada 12.18
-- Versi server: 10.1.37-MariaDB
-- Versi PHP: 7.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `apkbarang`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `barang`
--

CREATE TABLE `barang` (
  `id_barang` varchar(10) NOT NULL,
  `nama_barang` varchar(50) NOT NULL,
  `deskripsi` text NOT NULL,
  `harga_barang` varchar(30) NOT NULL,
  `stok_barang` varchar(30) NOT NULL,
  `total` varchar(100) NOT NULL,
  `gambar_barang` varchar(200) NOT NULL,
  `tgl_publish` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `barang`
--

INSERT INTO `barang` (`id_barang`, `nama_barang`, `deskripsi`, `harga_barang`, `stok_barang`, `total`, `gambar_barang`, `tgl_publish`) VALUES
('B001', 'Meja Kursi Belajar', 'Keren elegant', '700000', '9', '6300000', 'brg-0.jpg', '2019-02-08'),
('B002', 'Tempat tidur tingkat', 'Kuat Kokoh', '800000', '14', '20000000', 'brg-1549609402.jpg', '2019-02-08'),
('B003', 'Meja makan dapur', 'Bagus kayu jati', '650000', '5', '4550000', 'brg-1549609501.jpg', '2019-02-08');

-- --------------------------------------------------------

--
-- Struktur dari tabel `barang_masuk`
--

CREATE TABLE `barang_masuk` (
  `id` int(11) NOT NULL,
  `id_barang` varchar(50) NOT NULL,
  `stok` varchar(100) NOT NULL,
  `total` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `barang_masuk`
--

INSERT INTO `barang_masuk` (`id`, `id_barang`, `stok`, `total`) VALUES
(8, 'B002', '5', '4000000'),
(9, 'B002', '5', '4000000');

--
-- Trigger `barang_masuk`
--
DELIMITER $$
CREATE TRIGGER `masuk` AFTER INSERT ON `barang_masuk` FOR EACH ROW BEGIN
	UPDATE barang SET stok_barang=stok_barang+NEW.stok
    WHERE id_barang = NEW.id_barang;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `masukk` BEFORE INSERT ON `barang_masuk` FOR EACH ROW BEGIN
	UPDATE barang SET total=total+NEW.total
    WHERE id_barang = NEW.id_barang;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `dashboard`
--

CREATE TABLE `dashboard` (
  `header` text NOT NULL,
  `alamat` text NOT NULL,
  `isi` text NOT NULL,
  `footer` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `dashboard`
--

INSERT INTO `dashboard` (`header`, `alamat`, `isi`, `footer`) VALUES
('<p><span style=\"font-size:20px\"><span style=\"color:#4e5f70\"><span style=\"font-family:Georgia,serif\"><strong><span style=\"background-color:#ffffff\">TOKO BARANG MUGI BAROKAH</span></strong></span></span></span></p>\r\n', '<p><strong><span style=\"font-family:Comic Sans MS,cursive\"><em>Ds. Kedungputri Kec. Paron Kab Ngawi</em></span></strong></p>\r\n', '<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Alias nemo itaque voluptates odit aspernatur. Porro rerum pariatur harum quasi, nihil ab cum consequuntur incidunt et deleniti hic repellendus vitae dolores.</p>\r\n\r\n<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Alias nemo itaque voluptates odit aspernatur. Porro rerum pariatur harum quasi, nihil ab cum consequuntur incidunt et deleniti hic repellendus vitae dolores.</p>\r\n', '<p><strong><span style=\"font-family:Courier New,Courier,monospace\">Copyright - Miftakhul Muqorobin</span></strong></p>\r\n');

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaksi`
--

CREATE TABLE `transaksi` (
  `id_transaksi` varchar(50) NOT NULL,
  `id_barang` varchar(50) NOT NULL,
  `jumlah` varchar(20) NOT NULL,
  `harga_barang` varchar(50) NOT NULL,
  `nama_pelanggan` varchar(100) NOT NULL,
  `tgl_transaksi` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `transaksi`
--

INSERT INTO `transaksi` (`id_transaksi`, `id_barang`, `jumlah`, `harga_barang`, `nama_pelanggan`, `tgl_transaksi`) VALUES
('T001', 'B001', '1', '720000', 'Pelisa', '2019-02-08'),
('T002', 'B002', '10', '8100000', 'Sutrisno', '2019-02-08'),
('T003', 'B002', '1', '800000', 'Nam', '2019-02-08'),
('T004', 'B003', '2', '1300000', 'Ben', '2019-02-08'),
('T005', 'B004', '1', '55', 'htght', '2019-02-10');

--
-- Trigger `transaksi`
--
DELIMITER $$
CREATE TRIGGER `batal` AFTER DELETE ON `transaksi` FOR EACH ROW BEGIN
	UPDATE barang SET stok_barang=stok_barang+OLD.jumlah
    WHERE id_barang = OLD.id_barang;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `jual` AFTER INSERT ON `transaksi` FOR EACH ROW BEGIN
	UPDATE barang SET stok_barang=stok_barang-NEW.jumlah
    WHERE id_barang = NEW.id_barang;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `nama_user` varchar(100) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `alamat` text NOT NULL,
  `no_telp` varchar(15) NOT NULL,
  `level` enum('admin','operator') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id_user`, `nama_user`, `username`, `password`, `alamat`, `no_telp`, `level`) VALUES
(9, 'Shofa Miftakhul', 'admin', 'admin', 'Kedungputri paron Ngawi', '085607030051', 'admin'),
(10, 'Ibnu Asfiyak Mashuri', 'operator', 'operator', 'Kedungputri', '08655445666', 'operator');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`id_barang`);

--
-- Indeks untuk tabel `barang_masuk`
--
ALTER TABLE `barang_masuk`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id_transaksi`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `barang_masuk`
--
ALTER TABLE `barang_masuk`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
