-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 05, 2019 at 05:01 PM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.3.3

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
-- Table structure for table `angsuran`
--

CREATE TABLE `angsuran` (
  `nofaktur` varchar(30) NOT NULL,
  `id_user` varchar(5) NOT NULL,
  `tanggal` date NOT NULL,
  `bayar` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `angsuran`
--

INSERT INTO `angsuran` (`nofaktur`, `id_user`, `tanggal`, `bayar`) VALUES
('0001/far/28/asdf/28062019/BN', 'far', '2019-06-28', 100),
('0003/far/28/asdf/28062019/BN', 'far', '2019-06-28', 1000),
('0001/far/28/asdf/28062019/BN', 'far', '2019-06-28', 100),
('0001/far/28/asdf/28062019/BN', 'far', '2019-06-28', 100),
('0003/far/28/asdf/28062019/BN', 'far', '2019-06-28', 1000),
('0001/far/28/asdf/28062019/BN', 'far', '2019-06-28', 100);

-- --------------------------------------------------------

--
-- Table structure for table `barang`
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
-- Dumping data for table `barang`
--

INSERT INTO `barang` (`id_barang`, `namabarang`, `harga`, `satuan`, `stok`, `kategori`, `gambar`, `deskripsi`) VALUES
('99', 'apel', 90, 'ecer', 89, 'Tablet', 'WhatsApp_Image_2019-05-19_at_15_39_25.jpeg', 'jh'),
('io', 'busi', 900, 'grosir', 84, 'Kapsul', 'WhatsApp_Image_2019-05-19_at_15_39_26.jpeg', 'busi'),
('l', 'asd', 9102, 'ecer', 20, 'Tablet', 'default.jpg', 'sdaf'),
('sad', 'jeruk', 90000, 'grosir', -3, 'Kapsul', 'jeruk.jpg', 'asdf');

-- --------------------------------------------------------

--
-- Table structure for table `barangmasuk`
--

CREATE TABLE `barangmasuk` (
  `id_barangmasuk` varchar(10) NOT NULL,
  `id_barang` varchar(10) NOT NULL,
  `id_user` varchar(5) NOT NULL,
  `tanggal` date NOT NULL,
  `jumlah` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `barangmasuk`
--

INSERT INTO `barangmasuk` (`id_barangmasuk`, `id_barang`, `id_user`, `tanggal`, `jumlah`) VALUES
('B001', '', 'far', '2019-07-05', 0),
('B002', '', 'far', '2019-07-05', 0);

-- --------------------------------------------------------

--
-- Stand-in structure for view `detail_barang`
-- (See below for the actual view)
--
CREATE TABLE `detail_barang` (
`namabarang` text
,`jumlah` int(5)
);

-- --------------------------------------------------------

--
-- Table structure for table `detail_barangmasuk`
--

CREATE TABLE `detail_barangmasuk` (
  `id_barangmasuk` varchar(10) NOT NULL,
  `id_barang` varchar(10) NOT NULL,
  `jumlah` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `detail_barangmasuk`
--

INSERT INTO `detail_barangmasuk` (`id_barangmasuk`, `id_barang`, `jumlah`) VALUES
('Q001', '21321', 22),
('Q001', 'l', 2),
('Q001', '21321', 22),
('Q001', 'l', 1000),
('Q01', '21321', 3),
('0001/far/1', '21321', 2),
('Q0012', '21321', 37),
('0001', '20134', 22),
('Q00123', '121', 22),
('Q00111', '121', 16),
('Q001', '121', 12),
('Q001', '20134', 4),
('Q002', '20134', 1),
('Q015', '211', 3),
('Q016', '20134', 11),
('Q017', '121', 1),
('Q018', '20134', 14),
('B001', 'io', 20),
('B002', 'l', 20);

--
-- Triggers `detail_barangmasuk`
--
DELIMITER $$
CREATE TRIGGER `StokPlusOnBrgMskIns` AFTER INSERT ON `detail_barangmasuk` FOR EACH ROW BEGIN
	UPDATE barang SET stok=stok+NEW.jumlah 
	WHERE id_barang=NEW.id_barang ;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `detail_pemesanan`
--

CREATE TABLE `detail_pemesanan` (
  `kode_pemesanan` varchar(30) NOT NULL,
  `id_barang` varchar(10) NOT NULL,
  `jumlah` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `detail_pemesanan`
--

INSERT INTO `detail_pemesanan` (`kode_pemesanan`, `id_barang`, `jumlah`) VALUES
('PS0001', 'sad', 2),
('PS0002', 'sad', 1),
('PS0003', 'sad', 1),
('PS0004', 'sad', 1),
('PS0005', 'sad', 1),
('PS0006', 'io', 1),
('PS0007', 'io', 1),
('PS0001', 'sad', 2),
('PS0002', 'sad', 1),
('PS0003', 'sad', 1),
('PS0004', 'sad', 1),
('PS0005', 'sad', 1),
('PS0006', 'io', 1),
('PS0007', 'io', 1);

--
-- Triggers `detail_pemesanan`
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
-- Table structure for table `detail_transaksi`
--

CREATE TABLE `detail_transaksi` (
  `nofaktur` varchar(30) NOT NULL,
  `id_barang` varchar(10) NOT NULL,
  `jumlah` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Triggers `detail_transaksi`
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
-- Stand-in structure for view `hmmm`
-- (See below for the actual view)
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
-- Stand-in structure for view `laporan_angsuran`
-- (See below for the actual view)
--
CREATE TABLE `laporan_angsuran` (
`nofaktur` varchar(30)
,`pelanggan` varchar(30)
,`total` int(10)
,`masuk` decimal(32,0)
,`sisa` decimal(33,0)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `laporan_pemesanan`
-- (See below for the actual view)
--
CREATE TABLE `laporan_pemesanan` (
`kode_pemesanan` varchar(30)
,`kasir` varchar(5)
,`pemesan` varchar(30)
,`tanggal` date
,`total` int(10)
,`bayar` int(10)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `laporan_transaksi`
-- (See below for the actual view)
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
-- Stand-in structure for view `laporan_transaksibulanan`
-- (See below for the actual view)
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
-- Stand-in structure for view `laporan_transaksiharian`
-- (See below for the actual view)
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
-- Stand-in structure for view `laporan_transaksimingguan`
-- (See below for the actual view)
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
-- Stand-in structure for view `laporan_transaksitahunan`
-- (See below for the actual view)
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
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `id_user` varchar(5) NOT NULL,
  `username` text NOT NULL,
  `password` varchar(255) NOT NULL,
  `level` enum('Admin','Marketing','SuperUser') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`id_user`, `username`, `password`, `level`) VALUES
('1', 'samo', 'asdf', 'Marketing'),
('far', 'faris', '$2y$10$R10Wg6SNLLqataHIzW2S2.o/QAB/uuL.SDwvxlDPb3fqGjZItO3.O', 'Admin');

-- --------------------------------------------------------

--
-- Table structure for table `pelanggan`
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
-- Dumping data for table `pelanggan`
--

INSERT INTO `pelanggan` (`id_pelanggan`, `nama`, `nohp`, `alamat`, `email`, `password`) VALUES
('3', 'khizam', '089682424905', 'asdfsdf', 'dsafsdf', '$2y$10$j2W5LQakmahlUK2X8.uG1.wY/Kv/uk8cln4PHXyekjDxdzfU1QzX2');

-- --------------------------------------------------------

--
-- Table structure for table `pemesanan`
--

CREATE TABLE `pemesanan` (
  `kode_pemesanan` varchar(30) NOT NULL,
  `id_user` varchar(5) NOT NULL,
  `id_pelanggan` varchar(5) NOT NULL,
  `tanggal` date NOT NULL,
  `total` int(10) NOT NULL,
  `bayar` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pemesanan`
--

INSERT INTO `pemesanan` (`kode_pemesanan`, `id_user`, `id_pelanggan`, `tanggal`, `total`, `bayar`) VALUES
('PS0001', 'far', '3', '2019-07-04', 180000, 90),
('PS0002', 'far', '3', '2019-07-04', 90000, 90),
('PS0003', 'far', '3', '2019-07-04', 90000, 90),
('PS0004', 'far', '3', '2019-07-04', 90000, 100),
('PS0005', 'far', '3', '2019-07-04', 90000, 100),
('PS0006', 'far', '3', '2019-07-04', 900, 80),
('PS0007', 'far', '3', '2019-07-04', 900, 89);

-- --------------------------------------------------------

--
-- Stand-in structure for view `riwayat`
-- (See below for the actual view)
--
CREATE TABLE `riwayat` (
`nama` varchar(30)
,`bayar` int(10)
);

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
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
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`nofaktur`, `id_user`, `id_pelanggan`, `tanggal`, `total`, `potongan`, `bayar`, `kategori`) VALUES
('0001/far/28/asdf/28062019/BN', 'far', '3', '2019-06-28', 9102, 0, 100, 'kredit'),
('0001/far/29/asdf/29062019/Q', 'far', '3', '2019-06-29', 45000, 0, 50000, ''),
('0002/far/28/asdf/28062019/Q', '1', '3', '2019-06-15', 9102, 0, 10000, ''),
('0002/far/29/asdf/29062019/Q', 'far', '3', '2019-05-29', 1080000, 0, 1080000, ''),
('0003/far/28/asdf/28062019/BN', 'far', '3', '2018-06-28', 99102, 0, 1000, 'kredit');

--
-- Triggers `transaksi`
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
-- Structure for view `detail_barang`
--
DROP TABLE IF EXISTS `detail_barang`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `detail_barang`  AS  select `barang`.`namabarang` AS `namabarang`,`detail_transaksi`.`jumlah` AS `jumlah` from ((`transaksi` join `detail_transaksi`) join `barang`) where ((`barang`.`id_barang` = `detail_transaksi`.`id_barang`) and (`detail_transaksi`.`nofaktur` = `transaksi`.`nofaktur`)) ;

-- --------------------------------------------------------

--
-- Structure for view `hmmm`
--
DROP TABLE IF EXISTS `hmmm`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `hmmm`  AS  select date_format(`transaksi`.`tanggal`,'%d/%m/%Y') AS `tangal`,`transaksi`.`nofaktur` AS `nofaktur`,`login`.`username` AS `penjual`,`pelanggan`.`nama` AS `pelanggan`,`transaksi`.`total` AS `total`,`transaksi`.`kategori` AS `kategori` from ((`transaksi` join `login`) join `pelanggan`) where ((`transaksi`.`id_user` = `login`.`id_user`) and (`transaksi`.`id_pelanggan` = `pelanggan`.`id_pelanggan`)) order by date_format(`transaksi`.`tanggal`,'%d/%m/%Y') desc,`transaksi`.`nofaktur` desc ;

-- --------------------------------------------------------

--
-- Structure for view `laporan_angsuran`
--
DROP TABLE IF EXISTS `laporan_angsuran`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `laporan_angsuran`  AS  select `transaksi`.`nofaktur` AS `nofaktur`,`pelanggan`.`nama` AS `pelanggan`,`transaksi`.`total` AS `total`,sum(`angsuran`.`bayar`) AS `masuk`,(sum(`angsuran`.`bayar`) - `transaksi`.`total`) AS `sisa` from (((`transaksi` join `angsuran`) join `login`) join `pelanggan`) where ((`angsuran`.`nofaktur` = `transaksi`.`nofaktur`) and (`pelanggan`.`id_pelanggan` = `transaksi`.`id_pelanggan`) and (`login`.`id_user` = `transaksi`.`id_user`)) group by `transaksi`.`nofaktur` order by `transaksi`.`nofaktur` desc ;

-- --------------------------------------------------------

--
-- Structure for view `laporan_pemesanan`
--
DROP TABLE IF EXISTS `laporan_pemesanan`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `laporan_pemesanan`  AS  select `pemesanan`.`kode_pemesanan` AS `kode_pemesanan`,`login`.`id_user` AS `kasir`,`pelanggan`.`nama` AS `pemesan`,`pemesanan`.`tanggal` AS `tanggal`,`pemesanan`.`total` AS `total`,`pemesanan`.`bayar` AS `bayar` from ((`pemesanan` join `login`) join `pelanggan`) where ((`pemesanan`.`id_user` = `login`.`id_user`) and (`pemesanan`.`id_pelanggan` = `pelanggan`.`id_pelanggan`)) order by `pemesanan`.`kode_pemesanan` desc ;

-- --------------------------------------------------------

--
-- Structure for view `laporan_transaksi`
--
DROP TABLE IF EXISTS `laporan_transaksi`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `laporan_transaksi`  AS  select date_format(`transaksi`.`tanggal`,'%d/%m/%Y') AS `tangal`,`transaksi`.`nofaktur` AS `nofaktur`,`login`.`username` AS `penjual`,`pelanggan`.`nama` AS `pelanggan`,`transaksi`.`total` AS `total`,`transaksi`.`kategori` AS `kategori` from ((`transaksi` join `login`) join `pelanggan`) where ((`transaksi`.`id_user` = `login`.`id_user`) and (`transaksi`.`id_pelanggan` = `pelanggan`.`id_pelanggan`)) order by date_format(`transaksi`.`tanggal`,'%d/%m/%Y'),`transaksi`.`nofaktur` desc ;

-- --------------------------------------------------------

--
-- Structure for view `laporan_transaksibulanan`
--
DROP TABLE IF EXISTS `laporan_transaksibulanan`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `laporan_transaksibulanan`  AS  select date_format(`transaksi`.`tanggal`,'%d/%m/%Y') AS `tangal`,`transaksi`.`nofaktur` AS `nofaktur`,`login`.`username` AS `penjual`,`pelanggan`.`nama` AS `pelanggan`,`transaksi`.`total` AS `total`,`transaksi`.`kategori` AS `kategori` from ((`transaksi` join `login`) join `pelanggan`) where ((`transaksi`.`id_user` = `login`.`id_user`) and (`transaksi`.`id_pelanggan` = `pelanggan`.`id_pelanggan`) and (month(`transaksi`.`tanggal`) = month(now()))) order by date_format(`transaksi`.`tanggal`,'%d/%m/%Y'),`transaksi`.`nofaktur` desc ;

-- --------------------------------------------------------

--
-- Structure for view `laporan_transaksiharian`
--
DROP TABLE IF EXISTS `laporan_transaksiharian`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `laporan_transaksiharian`  AS  select date_format(`transaksi`.`tanggal`,'%d/%m/%Y') AS `tangal`,`transaksi`.`nofaktur` AS `nofaktur`,`login`.`username` AS `penjual`,`pelanggan`.`nama` AS `pelanggan`,`transaksi`.`total` AS `total`,`transaksi`.`kategori` AS `kategori` from ((`transaksi` join `login`) join `pelanggan`) where ((`transaksi`.`id_user` = `login`.`id_user`) and (`transaksi`.`id_pelanggan` = `pelanggan`.`id_pelanggan`) and (`transaksi`.`tanggal` = cast(now() as date))) order by date_format(`transaksi`.`tanggal`,'%d/%m/%Y') desc,`transaksi`.`nofaktur` desc ;

-- --------------------------------------------------------

--
-- Structure for view `laporan_transaksimingguan`
--
DROP TABLE IF EXISTS `laporan_transaksimingguan`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `laporan_transaksimingguan`  AS  select date_format(`transaksi`.`tanggal`,'%d/%m/%Y') AS `tangal`,`transaksi`.`nofaktur` AS `nofaktur`,`login`.`username` AS `penjual`,`pelanggan`.`nama` AS `pelanggan`,`transaksi`.`total` AS `total`,`transaksi`.`kategori` AS `kategori` from ((`transaksi` join `login`) join `pelanggan`) where ((`transaksi`.`id_user` = `login`.`id_user`) and (`transaksi`.`id_pelanggan` = `pelanggan`.`id_pelanggan`) and (yearweek(`transaksi`.`tanggal`,0) = yearweek(now(),0))) order by date_format(`transaksi`.`tanggal`,'%d/%m/%Y') desc,`transaksi`.`nofaktur` desc ;

-- --------------------------------------------------------

--
-- Structure for view `laporan_transaksitahunan`
--
DROP TABLE IF EXISTS `laporan_transaksitahunan`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `laporan_transaksitahunan`  AS  select date_format(`transaksi`.`tanggal`,'%d/%m/%Y') AS `tangal`,`transaksi`.`nofaktur` AS `nofaktur`,`login`.`username` AS `penjual`,`pelanggan`.`nama` AS `pelanggan`,`transaksi`.`total` AS `total`,`transaksi`.`kategori` AS `kategori` from ((`transaksi` join `login`) join `pelanggan`) where ((`transaksi`.`id_user` = `login`.`id_user`) and (`transaksi`.`id_pelanggan` = `pelanggan`.`id_pelanggan`) and (year(`transaksi`.`tanggal`) = year(now()))) order by date_format(`transaksi`.`tanggal`,'%d/%m/%Y') desc,`transaksi`.`nofaktur` desc ;

-- --------------------------------------------------------

--
-- Structure for view `riwayat`
--
DROP TABLE IF EXISTS `riwayat`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `riwayat`  AS  select `pelanggan`.`nama` AS `nama`,`angsuran`.`bayar` AS `bayar` from ((`angsuran` join `transaksi`) join `pelanggan`) where ((`angsuran`.`nofaktur` = `transaksi`.`nofaktur`) and (`transaksi`.`id_pelanggan` = `pelanggan`.`id_pelanggan`)) ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `angsuran`
--
ALTER TABLE `angsuran`
  ADD KEY `nofaktur` (`nofaktur`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`id_barang`);

--
-- Indexes for table `barangmasuk`
--
ALTER TABLE `barangmasuk`
  ADD PRIMARY KEY (`id_barangmasuk`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `detail_pemesanan`
--
ALTER TABLE `detail_pemesanan`
  ADD KEY `kode_pemesanan` (`kode_pemesanan`),
  ADD KEY `id_barang` (`id_barang`);

--
-- Indexes for table `detail_transaksi`
--
ALTER TABLE `detail_transaksi`
  ADD KEY `nofaktur` (`nofaktur`),
  ADD KEY `id_barang` (`id_barang`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`id_user`);

--
-- Indexes for table `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD PRIMARY KEY (`id_pelanggan`);

--
-- Indexes for table `pemesanan`
--
ALTER TABLE `pemesanan`
  ADD PRIMARY KEY (`kode_pemesanan`),
  ADD KEY `id_pelanggan` (`id_pelanggan`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`nofaktur`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_pelanggan` (`id_pelanggan`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `angsuran`
--
ALTER TABLE `angsuran`
  ADD CONSTRAINT `angsuran_ibfk_1` FOREIGN KEY (`nofaktur`) REFERENCES `transaksi` (`nofaktur`) ON UPDATE CASCADE,
  ADD CONSTRAINT `angsuran_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `login` (`id_user`) ON UPDATE CASCADE;

--
-- Constraints for table `barangmasuk`
--
ALTER TABLE `barangmasuk`
  ADD CONSTRAINT `barangmasuk_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `login` (`id_user`) ON UPDATE CASCADE,
  ADD CONSTRAINT `barangmasuk_ibfk_2` FOREIGN KEY (`id_barang`) REFERENCES `barang` (`id_barang`) ON UPDATE CASCADE;

--
-- Constraints for table `detail_pemesanan`
--
ALTER TABLE `detail_pemesanan`
  ADD CONSTRAINT `detail_pemesanan_ibfk_3` FOREIGN KEY (`kode_pemesanan`) REFERENCES `pemesanan` (`kode_pemesanan`) ON UPDATE CASCADE,
  ADD CONSTRAINT `detail_pemesanan_ibfk_4` FOREIGN KEY (`id_barang`) REFERENCES `barang` (`id_barang`) ON UPDATE CASCADE;

--
-- Constraints for table `detail_transaksi`
--
ALTER TABLE `detail_transaksi`
  ADD CONSTRAINT `detail_transaksi_ibfk_1` FOREIGN KEY (`id_barang`) REFERENCES `barang` (`id_barang`) ON UPDATE CASCADE,
  ADD CONSTRAINT `detail_transaksi_ibfk_2` FOREIGN KEY (`nofaktur`) REFERENCES `transaksi` (`nofaktur`) ON UPDATE CASCADE;

--
-- Constraints for table `pemesanan`
--
ALTER TABLE `pemesanan`
  ADD CONSTRAINT `pemesanan_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `login` (`id_user`) ON UPDATE CASCADE,
  ADD CONSTRAINT `pemesanan_ibfk_2` FOREIGN KEY (`id_pelanggan`) REFERENCES `pelanggan` (`id_pelanggan`) ON UPDATE CASCADE;

--
-- Constraints for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD CONSTRAINT `transaksi_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `login` (`id_user`) ON UPDATE CASCADE,
  ADD CONSTRAINT `transaksi_ibfk_2` FOREIGN KEY (`id_pelanggan`) REFERENCES `pelanggan` (`id_pelanggan`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
