-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 07 Jul 2019 pada 19.12
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
('0001/far/08/asdf/08072019/BN', 'far', '2019-07-08', 11);

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
('99', 'apel', 90, 'ecer', 82, 'Tablet', 'WhatsApp_Image_2019-05-19_at_15_39_25.jpeg', 'jh'),
('io', 'busi', 900, 'grosir', 75, 'Kapsul', 'WhatsApp_Image_2019-05-19_at_15_39_26.jpeg', 'busi'),
('l', 'asd', 9102, 'ecer', 20, 'Tablet', 'default.jpg', 'sdaf'),
('sad', 'jeruk', 90000, 'grosir', -3, 'Kapsul', 'jeruk.jpg', 'asdf');

-- --------------------------------------------------------

--
-- Struktur dari tabel `barangmasuk`
--

CREATE TABLE `barangmasuk` (
  `id_barangmasuk` varchar(10) NOT NULL,
  `id_user` varchar(5) NOT NULL,
  `tanggal` date NOT NULL,
  `jumlah` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `barangmasuk`
--

INSERT INTO `barangmasuk` (`id_barangmasuk`, `id_user`, `tanggal`, `jumlah`) VALUES
('B001', 'far', '2019-07-05', 0),
('B002', 'far', '2019-07-05', 0);

-- --------------------------------------------------------

--
-- Stand-in struktur untuk tampilan `cekcok`
-- (Lihat di bawah untuk tampilan aktual)
--
CREATE TABLE `cekcok` (
`kode_pemesanan` varchar(30)
,`kasir` varchar(5)
,`pemesan` varchar(30)
,`alamat` text
,`tanggal` date
,`bayar` int(10)
,`total` int(10)
);

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
-- Struktur dari tabel `detail_barangmasuk`
--

CREATE TABLE `detail_barangmasuk` (
  `id_barangmasuk` varchar(10) NOT NULL,
  `id_barang` varchar(10) NOT NULL,
  `jumlah` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `detail_barangmasuk`
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
-- Trigger `detail_barangmasuk`
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
('0001/far/08/asdf/08072019/BN', '99', 1),
('0001/far/08/asdf/08072019/BN', 'io', 1);

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
DELIMITER $$
CREATE TRIGGER `update` AFTER UPDATE ON `detail_pemesanan` FOR EACH ROW BEGIN
    INSERT INTO detail_transaksi
    set nofaktur = NEW.kode_pemesanan,
    id_barang=OLD.id_barang,
    jumlah=old.jumlah;
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
('0001/far/08/asdf/08072019/BN', '99', 1),
('0001/far/08/asdf/08072019/BN', 'io', 1);

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
,`pelanggan` varchar(30)
,`total` int(10)
,`masuk` decimal(32,0)
,`sisa` decimal(33,0)
);

-- --------------------------------------------------------

--
-- Stand-in struktur untuk tampilan `laporan_pemesanan`
-- (Lihat di bawah untuk tampilan aktual)
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
  `bayar` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `pemesanan`
--

INSERT INTO `pemesanan` (`kode_pemesanan`, `id_user`, `id_pelanggan`, `tanggal`, `total`, `bayar`) VALUES
('0001/far/08/asdf/08072019/BN', 'far', '3', '2019-07-08', 990, 11);

--
-- Trigger `pemesanan`
--
DELIMITER $$
CREATE TRIGGER `updatepemesanan` BEFORE UPDATE ON `pemesanan` FOR EACH ROW BEGIN
	IF old.total > new.bayar THEN
    INSERT INTO transaksi
    set nofaktur = NEW.kode_pemesanan,
    id_user=OLD.id_user,
    id_pelanggan=old.id_pelanggan,
    tanggal = NOW(),
    total=old.total,
    bayar=new.bayar,
    kategori='kredit';
    END IF;
    
    IF old.total <= new.bayar THEN
    INSERT INTO transaksi
    set nofaktur = NEW.kode_pemesanan,
    id_user=OLD.id_user,
    id_pelanggan=old.id_pelanggan,
    tanggal = NOW(),
    total=old.total,
    bayar=new.bayar;
    END IF;
    
END
$$
DELIMITER ;

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
('0001/far/08/asdf/08072019/BN', 'far', '3', '2019-07-08', 990, 0, 11, 'kredit');

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
-- Struktur untuk view `cekcok`
--
DROP TABLE IF EXISTS `cekcok`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `cekcok`  AS  select `pemesanan`.`kode_pemesanan` AS `kode_pemesanan`,`login`.`id_user` AS `kasir`,`pelanggan`.`nama` AS `pemesan`,`pelanggan`.`alamat` AS `alamat`,`pemesanan`.`tanggal` AS `tanggal`,`pemesanan`.`bayar` AS `bayar`,`pemesanan`.`total` AS `total` from ((`pemesanan` join `login`) join `pelanggan`) where ((`pemesanan`.`id_user` = `login`.`id_user`) and (`pemesanan`.`id_pelanggan` = `pelanggan`.`id_pelanggan`)) ;

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

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `laporan_angsuran`  AS  select `transaksi`.`nofaktur` AS `nofaktur`,`pelanggan`.`nama` AS `pelanggan`,`transaksi`.`total` AS `total`,sum(`angsuran`.`bayar`) AS `masuk`,(sum(`angsuran`.`bayar`) - `transaksi`.`total`) AS `sisa` from (((`transaksi` join `angsuran`) join `login`) join `pelanggan`) where ((`angsuran`.`nofaktur` = `transaksi`.`nofaktur`) and (`pelanggan`.`id_pelanggan` = `transaksi`.`id_pelanggan`) and (`login`.`id_user` = `transaksi`.`id_user`)) group by `transaksi`.`nofaktur` order by `transaksi`.`nofaktur` desc ;

-- --------------------------------------------------------

--
-- Struktur untuk view `laporan_pemesanan`
--
DROP TABLE IF EXISTS `laporan_pemesanan`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `laporan_pemesanan`  AS  select `pemesanan`.`kode_pemesanan` AS `kode_pemesanan`,`login`.`id_user` AS `kasir`,`pelanggan`.`nama` AS `pemesan`,`pemesanan`.`tanggal` AS `tanggal`,`pemesanan`.`total` AS `total`,`pemesanan`.`bayar` AS `bayar` from ((`pemesanan` join `login`) join `pelanggan`) where ((`pemesanan`.`id_user` = `login`.`id_user`) and (`pemesanan`.`id_pelanggan` = `pelanggan`.`id_pelanggan`)) order by `pemesanan`.`kode_pemesanan` desc ;

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
-- Ketidakleluasaan untuk tabel `detail_pemesanan`
--
ALTER TABLE `detail_pemesanan`
  ADD CONSTRAINT `detail_pemesanan_ibfk_4` FOREIGN KEY (`id_barang`) REFERENCES `barang` (`id_barang`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
