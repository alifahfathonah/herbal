-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 28 Jun 2019 pada 17.30
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
('0001/far/28/asdf/28062019/BN', 'far', '2019-06-28', 100),
('0003/far/28/asdf/28062019/BN', 'far', '2019-06-28', 1000),
('0001/far/28/asdf/28062019/BN', 'far', '2019-06-28', 100);

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
('l', 'asd', 9102, 'ecer', 2, 'Tablet', 'default.jpg', 'sdaf'),
('sad', 'jeruk', 90000, 'grosir', 31, 'Kapsul', 'jeruk.jpg', 'asdf');

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
-- Stand-in struktur untuk tampilan `detail_barang`
-- (Lihat di bawah untuk tampilan aktual)
--
CREATE TABLE `detail_barang` (
`namabarang` text
,`jumlah` int(5)
);

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
-- Dumping data untuk tabel `detail_pemesanan`
--

INSERT INTO `detail_pemesanan` (`kode_pemesanan`, `id_barang`, `jumlah`) VALUES
('0001/far/15/asdf/15062019/Q', 'sad', 2);

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
('0001/far/28/asdf/28062019/BN', 'l', 1),
('0002/far/28/asdf/28062019/Q', 'l', 1),
('0003/far/28/asdf/28062019/BN', 'l', 1),
('0003/far/28/asdf/28062019/BN', 'sad', 1);

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
-- Stand-in struktur untuk tampilan `laporan_angsuran`
-- (Lihat di bawah untuk tampilan aktual)
--
CREATE TABLE `laporan_angsuran` (
`nofaktur` varchar(30)
,`total` int(10)
,`totalAngsuran` decimal(32,0)
,`nama` varchar(30)
,`sisa` decimal(33,0)
);

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
('far', 'faris', '$2y$10$R10Wg6SNLLqataHIzW2S2.o/QAB/uuL.SDwvxlDPb3fqGjZItO3.O', 'Admin');

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
('3', 'khizam', '089765', 'asdfsdf', 'dsafsdf', 'sadfds');

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

--
-- Dumping data untuk tabel `pemesanan`
--

INSERT INTO `pemesanan` (`kode_pemesanan`, `id_user`, `id_pelanggan`, `tanggal`, `total`, `potongan`, `bayar`, `kategori`) VALUES
('0001/far/15/asdf/15062019/Q', 'far', '3', '2019-06-15', 180000, 0, 10, '');

-- --------------------------------------------------------

--
-- Stand-in struktur untuk tampilan `riwayat`
-- (Lihat di bawah untuk tampilan aktual)
--
CREATE TABLE `riwayat` (
`nama` varchar(30)
,`bayar` int(10)
);

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
('0001/far/28/asdf/28062019/BN', 'far', '3', '2019-06-28', 9102, 0, 100, 'kredit'),
('0002/far/28/asdf/28062019/Q', 'far', '3', '2019-06-28', 9102, 0, 10000, ''),
('0003/far/28/asdf/28062019/BN', 'far', '3', '2019-06-28', 99102, 0, 1000, 'kredit');

--
-- Trigger `transaksi`
--
DELIMITER $$
CREATE TRIGGER `riwayatAngsr` AFTER INSERT ON `transaksi` FOR EACH ROW BEGIN 
	IF new.bayar < new.total THEN
    	INSERT INTO angsuran (nofaktur, id_user, tanggal, bayar)
        VALUES (new.nofaktur, new.id_user, new.tanggal, new.bayar);
      END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur untuk view `detail_barang`
--
DROP TABLE IF EXISTS `detail_barang`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `detail_barang`  AS  select `barang`.`namabarang` AS `namabarang`,`detail_transaksi`.`jumlah` AS `jumlah` from ((`transaksi` join `detail_transaksi`) join `barang`) where ((`barang`.`id_barang` = `detail_transaksi`.`id_barang`) and (`detail_transaksi`.`nofaktur` = `transaksi`.`nofaktur`)) ;

-- --------------------------------------------------------

--
-- Struktur untuk view `laporan_angsuran`
--
DROP TABLE IF EXISTS `laporan_angsuran`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `laporan_angsuran`  AS  select `t`.`nofaktur` AS `nofaktur`,`t`.`total` AS `total`,sum(`a`.`bayar`) AS `totalAngsuran`,`p`.`nama` AS `nama`,(`t`.`total` - sum(`a`.`bayar`)) AS `sisa` from ((`transaksi` `t` join `angsuran` `a`) join `pelanggan` `p`) where ((`t`.`nofaktur` = `a`.`nofaktur`) and (`t`.`id_pelanggan` = `p`.`id_pelanggan`)) group by `a`.`nofaktur` ;

-- --------------------------------------------------------

--
-- Struktur untuk view `riwayat`
--
DROP TABLE IF EXISTS `riwayat`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `riwayat`  AS  select `pelanggan`.`nama` AS `nama`,`angsuran`.`bayar` AS `bayar` from ((`angsuran` join `transaksi`) join `pelanggan`) where ((`angsuran`.`nofaktur` = `transaksi`.`nofaktur`) and (`transaksi`.`id_pelanggan` = `pelanggan`.`id_pelanggan`)) ;

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
