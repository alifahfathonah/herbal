-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 03 Jul 2019 pada 21.55
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
('l', 'asd', 9102, 'ecer', 0, 'Tablet', 'default.jpg', 'sdaf'),
('sad', 'jeruk', 90000, 'grosir', 9, 'Kapsul', 'jeruk.jpg', 'asdf');

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
('PS0002', 'sad', 1),
('PS0003', 'sad', 1),
('PS0001', 'sad', 2),
('PS0004', 'sad', 1),
('PS0005', 'sad', 1),
('PS0006', 'sad', 1),
('PS0007', 'sad', 1);

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
('0003/far/28/asdf/28062019/BN', 'sad', 1),
('0001/far/29/asdf/29062019/Q', 'sad', 1),
('0002/far/29/asdf/29062019/Q', 'sad', 12);

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
-- Stand-in struktur untuk tampilan `hmmm`
-- (Lihat di bawah untuk tampilan aktual)
--
CREATE TABLE `hmmm` (
`tangal` varchar(10)
,`nofaktur` varchar(30)
,`penjual` text
,`pelanggan` varchar(30)
,`total` int(10)
,`kategori` varchar(10)
);

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
-- Stand-in struktur untuk tampilan `laporan_pemesanan`
-- (Lihat di bawah untuk tampilan aktual)
--
CREATE TABLE `laporan_pemesanan` (
`kode_pemesanan` varchar(30)
,`username` text
,`nama` varchar(30)
,`tanggal` date
,`total` int(10)
,`bayar` int(10)
,`pesan` text
);

-- --------------------------------------------------------

--
-- Stand-in struktur untuk tampilan `laporan_transaksi`
-- (Lihat di bawah untuk tampilan aktual)
--
CREATE TABLE `laporan_transaksi` (
`tangal` varchar(10)
,`nofaktur` varchar(30)
,`penjual` text
,`pelanggan` varchar(30)
,`total` int(10)
,`kategori` varchar(10)
);

-- --------------------------------------------------------

--
-- Stand-in struktur untuk tampilan `laporan_transaksibulanan`
-- (Lihat di bawah untuk tampilan aktual)
--
CREATE TABLE `laporan_transaksibulanan` (
`tangal` varchar(10)
,`nofaktur` varchar(30)
,`penjual` text
,`pelanggan` varchar(30)
,`total` int(10)
,`kategori` varchar(10)
);

-- --------------------------------------------------------

--
-- Stand-in struktur untuk tampilan `laporan_transaksiharian`
-- (Lihat di bawah untuk tampilan aktual)
--
CREATE TABLE `laporan_transaksiharian` (
`tangal` varchar(10)
,`nofaktur` varchar(30)
,`penjual` text
,`pelanggan` varchar(30)
,`total` int(10)
,`kategori` varchar(10)
);

-- --------------------------------------------------------

--
-- Stand-in struktur untuk tampilan `laporan_transaksimingguan`
-- (Lihat di bawah untuk tampilan aktual)
--
CREATE TABLE `laporan_transaksimingguan` (
`tangal` varchar(10)
,`nofaktur` varchar(30)
,`penjual` text
,`pelanggan` varchar(30)
,`total` int(10)
,`kategori` varchar(10)
);

-- --------------------------------------------------------

--
-- Stand-in struktur untuk tampilan `laporan_transaksitahunan`
-- (Lihat di bawah untuk tampilan aktual)
--
CREATE TABLE `laporan_transaksitahunan` (
`tangal` varchar(10)
,`nofaktur` varchar(30)
,`penjual` text
,`pelanggan` varchar(30)
,`total` int(10)
,`kategori` varchar(10)
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
('1', 'samo', 'asdf', 'Marketing'),
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
('3', 'khizam', '089682424905', 'asdfsdf', 'dsafsdf', '$2y$10$j2W5LQakmahlUK2X8.uG1.wY/Kv/uk8cln4PHXyekjDxdzfU1QzX2');

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
  `bayar` int(10) NOT NULL,
  `pesan` text NOT NULL,
  `via` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `pemesanan`
--

INSERT INTO `pemesanan` (`kode_pemesanan`, `id_user`, `id_pelanggan`, `tanggal`, `total`, `bayar`, `pesan`, `via`) VALUES
('PS0001', 'far', '3', '2019-07-03', 180000, 9, '', ''),
('PS0002', 'far', '3', '2019-07-01', 90000, 100, '', ''),
('PS0003', 'far', '3', '2019-07-03', 90000, 100, '', ''),
('PS0004', 'far', '3', '2019-07-03', 90000, 100, 'PS0004 atas nama khizam, biaya pesanan Anda RP. 90000.  Anda telah bayar sebesar RP. 100', ''),
('PS0005', 'far', '3', '2019-07-03', 90000, 100, 'PS0005 atas nama khizam, biaya pesanan Anda RP. 90000.  Anda telah bayar sebesar RP. 100', ''),
('PS0006', 'far', '3', '2019-07-03', 90000, 100, 'PS0006 atas nama khizam, biaya pesanan Anda RP. 90000. \n Anda telah bayar sebesar RP. 100', 'web'),
('PS0007', 'far', '3', '2019-07-03', 90000, 100, 'PS0007 atas nama khizam, biaya pesanan Anda RP. 90000. \n Anda telah bayar sebesar RP. 100', 'web');

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
('0001/far/29/asdf/29062019/Q', 'far', '3', '2019-06-29', 45000, 0, 50000, ''),
('0002/far/28/asdf/28062019/Q', '1', '3', '2019-06-15', 9102, 0, 10000, ''),
('0002/far/29/asdf/29062019/Q', 'far', '3', '2019-05-29', 1080000, 0, 1080000, ''),
('0003/far/28/asdf/28062019/BN', 'far', '3', '2018-06-28', 99102, 0, 1000, 'kredit');

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
-- Struktur untuk view `hmmm`
--
DROP TABLE IF EXISTS `hmmm`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `hmmm`  AS  select date_format(`transaksi`.`tanggal`,'%d/%m/%Y') AS `tangal`,`transaksi`.`nofaktur` AS `nofaktur`,`login`.`username` AS `penjual`,`pelanggan`.`nama` AS `pelanggan`,`transaksi`.`total` AS `total`,`transaksi`.`kategori` AS `kategori` from ((`transaksi` join `login`) join `pelanggan`) where ((`transaksi`.`id_user` = `login`.`id_user`) and (`transaksi`.`id_pelanggan` = `pelanggan`.`id_pelanggan`)) order by date_format(`transaksi`.`tanggal`,'%d/%m/%Y') desc,`transaksi`.`nofaktur` desc ;

-- --------------------------------------------------------

--
-- Struktur untuk view `laporan_angsuran`
--
DROP TABLE IF EXISTS `laporan_angsuran`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `laporan_angsuran`  AS  select `t`.`nofaktur` AS `nofaktur`,`t`.`total` AS `total`,sum(`a`.`bayar`) AS `totalAngsuran`,`p`.`nama` AS `nama`,(`t`.`total` - sum(`a`.`bayar`)) AS `sisa` from ((`transaksi` `t` join `angsuran` `a`) join `pelanggan` `p`) where ((`t`.`nofaktur` = `a`.`nofaktur`) and (`t`.`id_pelanggan` = `p`.`id_pelanggan`)) group by `a`.`nofaktur` ;

-- --------------------------------------------------------

--
-- Struktur untuk view `laporan_pemesanan`
--
DROP TABLE IF EXISTS `laporan_pemesanan`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `laporan_pemesanan`  AS  select `p`.`kode_pemesanan` AS `kode_pemesanan`,`l`.`username` AS `username`,`pe`.`nama` AS `nama`,`p`.`tanggal` AS `tanggal`,`p`.`total` AS `total`,`p`.`bayar` AS `bayar`,`p`.`pesan` AS `pesan` from ((`pemesanan` `p` join `login` `l`) join `pelanggan` `pe`) where ((`l`.`id_user` = `p`.`id_user`) and (`pe`.`id_pelanggan` = `p`.`id_pelanggan`)) ;

-- --------------------------------------------------------

--
-- Struktur untuk view `laporan_transaksi`
--
DROP TABLE IF EXISTS `laporan_transaksi`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `laporan_transaksi`  AS  select date_format(`transaksi`.`tanggal`,'%d/%m/%Y') AS `tangal`,`transaksi`.`nofaktur` AS `nofaktur`,`login`.`username` AS `penjual`,`pelanggan`.`nama` AS `pelanggan`,`transaksi`.`total` AS `total`,`transaksi`.`kategori` AS `kategori` from ((`transaksi` join `login`) join `pelanggan`) where ((`transaksi`.`id_user` = `login`.`id_user`) and (`transaksi`.`id_pelanggan` = `pelanggan`.`id_pelanggan`)) order by date_format(`transaksi`.`tanggal`,'%d/%m/%Y'),`transaksi`.`nofaktur` desc ;

-- --------------------------------------------------------

--
-- Struktur untuk view `laporan_transaksibulanan`
--
DROP TABLE IF EXISTS `laporan_transaksibulanan`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `laporan_transaksibulanan`  AS  select date_format(`transaksi`.`tanggal`,'%d/%m/%Y') AS `tangal`,`transaksi`.`nofaktur` AS `nofaktur`,`login`.`username` AS `penjual`,`pelanggan`.`nama` AS `pelanggan`,`transaksi`.`total` AS `total`,`transaksi`.`kategori` AS `kategori` from ((`transaksi` join `login`) join `pelanggan`) where ((`transaksi`.`id_user` = `login`.`id_user`) and (`transaksi`.`id_pelanggan` = `pelanggan`.`id_pelanggan`) and (month(`transaksi`.`tanggal`) = month(now()))) order by date_format(`transaksi`.`tanggal`,'%d/%m/%Y'),`transaksi`.`nofaktur` desc ;

-- --------------------------------------------------------

--
-- Struktur untuk view `laporan_transaksiharian`
--
DROP TABLE IF EXISTS `laporan_transaksiharian`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `laporan_transaksiharian`  AS  select date_format(`transaksi`.`tanggal`,'%d/%m/%Y') AS `tangal`,`transaksi`.`nofaktur` AS `nofaktur`,`login`.`username` AS `penjual`,`pelanggan`.`nama` AS `pelanggan`,`transaksi`.`total` AS `total`,`transaksi`.`kategori` AS `kategori` from ((`transaksi` join `login`) join `pelanggan`) where ((`transaksi`.`id_user` = `login`.`id_user`) and (`transaksi`.`id_pelanggan` = `pelanggan`.`id_pelanggan`) and (`transaksi`.`tanggal` = cast(now() as date))) order by date_format(`transaksi`.`tanggal`,'%d/%m/%Y') desc,`transaksi`.`nofaktur` desc ;

-- --------------------------------------------------------

--
-- Struktur untuk view `laporan_transaksimingguan`
--
DROP TABLE IF EXISTS `laporan_transaksimingguan`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `laporan_transaksimingguan`  AS  select date_format(`transaksi`.`tanggal`,'%d/%m/%Y') AS `tangal`,`transaksi`.`nofaktur` AS `nofaktur`,`login`.`username` AS `penjual`,`pelanggan`.`nama` AS `pelanggan`,`transaksi`.`total` AS `total`,`transaksi`.`kategori` AS `kategori` from ((`transaksi` join `login`) join `pelanggan`) where ((`transaksi`.`id_user` = `login`.`id_user`) and (`transaksi`.`id_pelanggan` = `pelanggan`.`id_pelanggan`) and (yearweek(`transaksi`.`tanggal`,0) = yearweek(now(),0))) order by date_format(`transaksi`.`tanggal`,'%d/%m/%Y') desc,`transaksi`.`nofaktur` desc ;

-- --------------------------------------------------------

--
-- Struktur untuk view `laporan_transaksitahunan`
--
DROP TABLE IF EXISTS `laporan_transaksitahunan`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `laporan_transaksitahunan`  AS  select date_format(`transaksi`.`tanggal`,'%d/%m/%Y') AS `tangal`,`transaksi`.`nofaktur` AS `nofaktur`,`login`.`username` AS `penjual`,`pelanggan`.`nama` AS `pelanggan`,`transaksi`.`total` AS `total`,`transaksi`.`kategori` AS `kategori` from ((`transaksi` join `login`) join `pelanggan`) where ((`transaksi`.`id_user` = `login`.`id_user`) and (`transaksi`.`id_pelanggan` = `pelanggan`.`id_pelanggan`) and (year(`transaksi`.`tanggal`) = year(now()))) order by date_format(`transaksi`.`tanggal`,'%d/%m/%Y') desc,`transaksi`.`nofaktur` desc ;

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
  ADD KEY `kode_pemesanan` (`kode_pemesanan`),
  ADD KEY `id_barang` (`id_barang`);

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
  ADD CONSTRAINT `detail_pemesanan_ibfk_3` FOREIGN KEY (`kode_pemesanan`) REFERENCES `pemesanan` (`kode_pemesanan`) ON UPDATE CASCADE,
  ADD CONSTRAINT `detail_pemesanan_ibfk_4` FOREIGN KEY (`id_barang`) REFERENCES `barang` (`id_barang`) ON UPDATE CASCADE;

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
