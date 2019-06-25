-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 28 Bulan Mei 2019 pada 04.32
-- Versi server: 10.1.38-MariaDB
-- Versi PHP: 7.3.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `herbal`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `angsuran`
--

CREATE TABLE `angsuran` (
  `nofaktur` varchar(30) NOT NULL,
  `id_user` varchar(5) NOT NULL,
  `tanggal` date NOT NULL,
  `bayar` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `angsuran`
--

INSERT INTO `angsuran` (`nofaktur`, `id_user`, `tanggal`, `bayar`) VALUES
('0020/far/27/asdf/27052019/BN', 'far', '2019-05-27', 0),
('0022/far/27/asdf/27052019/BN', 'far', '2019-05-27', 0),
('0023/far/27/XXXX/27052019/BN', 'far', '2019-05-27', 0),
('0024/far/27/asdf/27052019/BN', 'far', '2019-05-27', 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `barang`
--

CREATE TABLE `barang` (
  `id_barang` varchar(10) NOT NULL,
  `namabarang` text NOT NULL,
  `harga` int(10) NOT NULL,
  `satuan` enum('ecer','grosir') NOT NULL,
  `stok` int(10) NOT NULL,
  `kategori` enum('Tablet','Kapsul','Bubuk') NOT NULL,
  `gambar` varchar(255) NOT NULL DEFAULT 'default.jpg',
  `deskripsi` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `barang`
--

INSERT INTO `barang` (`id_barang`, `namabarang`, `harga`, `satuan`, `stok`, `kategori`, `gambar`, `deskripsi`) VALUES
('l', 'asd', 9102, 'ecer', 13, 'Tablet', 'default.jpg', 'sdaf'),
('sad', 'jeruk', 90000, 'grosir', 55, 'Kapsul', 'jeruk.jpg', 'asdf');

-- --------------------------------------------------------

--
-- Struktur dari tabel `barangmasuk`
--

CREATE TABLE `barangmasuk` (
  `id_barangmasuk` varchar(10) NOT NULL,
  `id_barang` varchar(10) NOT NULL,
  `id_user` varchar(5) NOT NULL,
  `tanggal` date NOT NULL,
  `jumlah` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Trigger `barangmasuk`
--
DELIMITER $$
CREATE TRIGGER `StokPlusOnBrgMskIns` AFTER INSERT ON `barangmasuk` FOR EACH ROW BEGIN
	UPDATE barang SET stok=stok+NEW.jumlah
    WHERE id_barang=NEW.id_barang ;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `detail_pemesanan`
--

CREATE TABLE `detail_pemesanan` (
  `kode_pemesanan` varchar(30) NOT NULL,
  `id_barang` varchar(10) NOT NULL,
  `jumlah` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Trigger `detail_pemesanan`
--
DELIMITER $$
CREATE TRIGGER `DetPsnAfterIsrt` AFTER INSERT ON `detail_pemesanan` FOR EACH ROW BEGIN
	UPDATE barang SET stok=stok - NEW.jumlah
    WHERE id_barang=NEW.id_barang;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `detail_transaksi`
--

CREATE TABLE `detail_transaksi` (
  `nofaktur` varchar(30) NOT NULL,
  `id_barang` varchar(10) NOT NULL,
  `jumlah` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `detail_transaksi`
--

INSERT INTO `detail_transaksi` (`nofaktur`, `id_barang`, `jumlah`) VALUES
('0006/far/26/asdf/26052019/Q', 'sad', 3),
('0006/far/26/asdf/26052019/Q', 'l', 9),
('0007/far/26/asdf/26052019/Q', 'l', 1),
('0007/far/26/asdf/26052019/Q', 'sad', 1),
('0008/far/27/asdf/27052019/Q', 'sad', 1),
('0009/far/27/asdf/27052019/Q', 'sad', 1),
('0010/far/27/asdf/27052019/Q', 'sad', 1),
('0011/far/27/asdf/27052019/Q', 'sad', 1),
('0012/far/27/asdf/27052019/Q', 'sad', 1),
('0013/far/27/asdf/27052019/Q', 'sad', 1),
('0016/far/27/asdf/27052019/Q', 'sad', 1),
('0017/far/27/asdf/27052019/Q', 'sad', 1),
('0018/far/27/asdf/27052019/Q', 'sad', 1),
('0019/far/27/asdf/27052019/BN', 'sad', 1),
('0020/far/27/asdf/27052019/BN', 'sad', 1),
('0021/far/27/asdf/27052019/Q', 'l', 1),
('0022/far/27/asdf/27052019/BN', 'sad', 1),
('0023/far/27/XXXX/27052019/BN', 'sad', 1),
('0024/far/27/asdf/27052019/BN', 'l', 1),
('0025/far/27/asdf/27052019/Q', 'sad', 1),
('0025/far/27/asdf/27052019/Q', 'l', 2);

--
-- Trigger `detail_transaksi`
--
DELIMITER $$
CREATE TRIGGER `MinStokOnDTInsert` AFTER INSERT ON `detail_transaksi` FOR EACH ROW BEGIN
	UPDATE barang SET stok=stok - NEW.jumlah
    WHERE id_barang=NEW.id_barang;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `login`
--

CREATE TABLE `login` (
  `id_user` varchar(5) NOT NULL,
  `username` text NOT NULL,
  `password` varchar(255) NOT NULL,
  `level` enum('Admin','Marketing','SuperUser') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `login`
--

INSERT INTO `login` (`id_user`, `username`, `password`, `level`) VALUES
('far', 'faris', '$2y$10$R10Wg6SNLLqataHIzW2S2.o/QAB/uuL.SDwvxlDPb3fqGjZItO3.O', 'Admin'),
('saf', 'safina', '$2y$10$bo5qhZ1FhbVYevlDNAS97uEOJ3PsRqi0dDuCy6v4XoU4LaDTpSgwO', 'Marketing');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pelanggan`
--

CREATE TABLE `pelanggan` (
  `id_pelanggan` varchar(5) NOT NULL,
  `nama` varchar(30) NOT NULL,
  `nohp` varchar(16) NOT NULL,
  `alamat` text NOT NULL,
  `email` text NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `pelanggan`
--

INSERT INTO `pelanggan` (`id_pelanggan`, `nama`, `nohp`, `alamat`, `email`, `password`) VALUES
('3', 'faris', '089765', 'asdfsdf', 'dsafsdf', 'sadfds');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pemesanan`
--

CREATE TABLE `pemesanan` (
  `kode_pemesanan` varchar(30) NOT NULL,
  `id_user` varchar(5) NOT NULL,
  `id_pelanggan` varchar(5) NOT NULL,
  `tanggal` date NOT NULL,
  `total` int(10) NOT NULL,
  `potongan` int(10) NOT NULL,
  `bayar` int(10) NOT NULL,
  `kategori` enum('cash','kredit') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaksi`
--

CREATE TABLE `transaksi` (
  `nofaktur` varchar(30) NOT NULL,
  `id_user` varchar(5) NOT NULL,
  `id_pelanggan` varchar(5) NOT NULL,
  `tanggal` date NOT NULL,
  `total` int(10) NOT NULL,
  `potongan` int(10) NOT NULL,
  `bayar` int(10) NOT NULL,
  `kategori` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `transaksi`
--

INSERT INTO `transaksi` (`nofaktur`, `id_user`, `id_pelanggan`, `tanggal`, `total`, `potongan`, `bayar`, `kategori`) VALUES
('0001/far/26/asdf/26052019/Q', 'far', '3', '2019-05-26', 90000, 0, 0, ''),
('0002/far/26/asdf/26052019/Q', 'far', '3', '2019-05-26', 90000, 0, 0, ''),
('0003/far/26/asdf/26052019/Q', 'far', '3', '2019-05-26', 90000, 0, 0, ''),
('0004/far/26/asdf/26052019/Q', 'far', '3', '2019-05-26', 108204, 0, 0, ''),
('0005/far/26/asdf/26052019/Q', 'far', '3', '2019-05-26', 0, 0, 0, ''),
('0006/far/26/asdf/26052019/Q', 'far', '3', '2019-05-26', 351918, 0, 0, ''),
('0007/far/26/asdf/26052019/Q', 'far', '3', '2019-05-26', 99102, 0, 0, ''),
('0008/far/27/asdf/27052019/Q', 'far', '3', '2019-05-27', 90000, 0, 0, ''),
('0009/far/27/asdf/27052019/Q', 'far', '3', '2019-05-27', 90000, 0, 0, ''),
('0010/far/27/asdf/27052019/Q', 'far', '3', '2019-05-27', 90000, 0, 0, ''),
('0011/far/27/asdf/27052019/Q', 'far', '3', '2019-05-27', 90000, 0, 100000, ''),
('0012/far/27/asdf/27052019/Q', 'far', '3', '2019-05-27', 90000, 0, 100000, ''),
('0013/far/27/asdf/27052019/Q', 'far', '3', '2019-05-27', 90000, 0, 100000, ''),
('0014/far/27/asdf/27052019/Q', 'far', '3', '2019-05-27', 0, 0, 0, ''),
('0015/far/27/asdf/27052019/Q', 'far', '3', '2019-05-27', 0, 0, 0, ''),
('0016/far/27/asdf/27052019/Q', 'far', '3', '2019-05-27', 90000, 0, 0, ''),
('0017/far/27/asdf/27052019/Q', 'far', '3', '2019-05-27', 90000, 0, 0, ''),
('0018/far/27/asdf/27052019/Q', 'far', '3', '2019-05-27', 90000, 0, 100000, ''),
('0019/far/27/asdf/27052019/BN', 'far', '3', '2019-05-27', 90000, 0, 0, 'kredit'),
('0020/far/27/asdf/27052019/BN', 'far', '3', '2019-05-27', 90000, 0, 0, 'kredit'),
('0021/far/27/asdf/27052019/Q', 'far', '3', '2019-05-27', 9102, 0, 10000, ''),
('0022/far/27/asdf/27052019/BN', 'far', '3', '2019-05-27', 90000, 0, 0, 'kredit'),
('0023/far/27/XXXX/27052019/BN', 'far', '3', '2019-05-27', 90000, 0, 0, 'kredit'),
('0024/far/27/asdf/27052019/BN', 'far', '3', '2019-05-27', 9102, 0, 0, 'kredit'),
('0025/far/27/asdf/27052019/Q', 'far', '3', '2019-05-27', 108204, 0, 10000000, '');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `angsuran`
--
ALTER TABLE `angsuran`
  ADD KEY `nofaktur` (`nofaktur`),
  ADD KEY `id_user` (`id_user`);

--
-- Indeks untuk tabel `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`id_barang`);

--
-- Indeks untuk tabel `barangmasuk`
--
ALTER TABLE `barangmasuk`
  ADD PRIMARY KEY (`id_barangmasuk`),
  ADD UNIQUE KEY `id_barang` (`id_barang`),
  ADD KEY `id_barang_2` (`id_barang`),
  ADD KEY `id_user` (`id_user`);

--
-- Indeks untuk tabel `detail_pemesanan`
--
ALTER TABLE `detail_pemesanan`
  ADD UNIQUE KEY `id_barang` (`id_barang`),
  ADD KEY `kode_pemesanan` (`kode_pemesanan`);

--
-- Indeks untuk tabel `detail_transaksi`
--
ALTER TABLE `detail_transaksi`
  ADD KEY `nofaktur` (`nofaktur`),
  ADD KEY `id_barang` (`id_barang`);

--
-- Indeks untuk tabel `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`id_user`);

--
-- Indeks untuk tabel `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD PRIMARY KEY (`id_pelanggan`);

--
-- Indeks untuk tabel `pemesanan`
--
ALTER TABLE `pemesanan`
  ADD PRIMARY KEY (`kode_pemesanan`),
  ADD KEY `id_pelanggan` (`id_pelanggan`),
  ADD KEY `id_user` (`id_user`);

--
-- Indeks untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`nofaktur`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_pelanggan` (`id_pelanggan`);

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `angsuran`
--
ALTER TABLE `angsuran`
  ADD CONSTRAINT `angsuran_ibfk_1` FOREIGN KEY (`nofaktur`) REFERENCES `transaksi` (`nofaktur`) ON UPDATE CASCADE,
  ADD CONSTRAINT `angsuran_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `login` (`id_user`) ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `barangmasuk`
--
ALTER TABLE `barangmasuk`
  ADD CONSTRAINT `barangmasuk_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `login` (`id_user`) ON UPDATE CASCADE,
  ADD CONSTRAINT `barangmasuk_ibfk_2` FOREIGN KEY (`id_barang`) REFERENCES `barang` (`id_barang`) ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `detail_pemesanan`
--
ALTER TABLE `detail_pemesanan`
  ADD CONSTRAINT `detail_pemesanan_ibfk_2` FOREIGN KEY (`id_barang`) REFERENCES `barang` (`id_barang`) ON UPDATE CASCADE,
  ADD CONSTRAINT `detail_pemesanan_ibfk_3` FOREIGN KEY (`kode_pemesanan`) REFERENCES `pemesanan` (`kode_pemesanan`) ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `detail_transaksi`
--
ALTER TABLE `detail_transaksi`
  ADD CONSTRAINT `detail_transaksi_ibfk_1` FOREIGN KEY (`id_barang`) REFERENCES `barang` (`id_barang`) ON UPDATE CASCADE,
  ADD CONSTRAINT `detail_transaksi_ibfk_2` FOREIGN KEY (`nofaktur`) REFERENCES `transaksi` (`nofaktur`) ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `pemesanan`
--
ALTER TABLE `pemesanan`
  ADD CONSTRAINT `pemesanan_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `login` (`id_user`) ON UPDATE CASCADE,
  ADD CONSTRAINT `pemesanan_ibfk_2` FOREIGN KEY (`id_pelanggan`) REFERENCES `pelanggan` (`id_pelanggan`) ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  ADD CONSTRAINT `transaksi_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `login` (`id_user`) ON UPDATE CASCADE,
  ADD CONSTRAINT `transaksi_ibfk_2` FOREIGN KEY (`id_pelanggan`) REFERENCES `pelanggan` (`id_pelanggan`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
