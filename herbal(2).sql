-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 13 Sep 2019 pada 04.26
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
('0001/far/08/asdf/08072019/BN', 'far', '2019-07-08', 11),
('0008/far/08/asdf/08072019/BN', 'far', '2019-07-08', 80);

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
('312', 'tela', 90000, 'grosir', 0, 'Kapsul', 'Ploso_nganjuk1.jpg', 'mantap'),
('99', 'apel', 90, 'ecer', 39, 'Tablet', 'WhatsApp_Image_2019-05-19_at_15_39_25.jpeg', 'jh'),
('a12', 'anggu', 10000, 'grosir', 9, 'Kapsul', 'a1003.jpg', 'gh'),
('io', 'busi', 900, 'grosir', 68, 'Kapsul', 'mangga.jpg', 'ini'),
('l', 'asd', 9102, 'ecer', 20, 'Tablet', 'Controller_barang_masuk3.PNG', 'ini'),
('sad', 'jeruk', 90000, 'ecer', -3, 'Kapsul', 'mangga.jpg', 'reaedsapd');

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
('B002', 'far', '2019-07-05', 0),
('B003', 'far', '2019-07-09', 0),
('B004', 'far', '2019-07-09', 0),
('B005', 'far', '2019-07-10', 0);

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
('B002', 'l', 20),
('B003', 'io', 2),
('B004', '312', 5),
('B005', '312', 2);

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
('PS0001', '312', 1),
('PS0002', '312', 1),
('PS0003', '312', 1),
('PS0003', '312', 1);

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
('0001/far/08/asdf/08072019/BN', 'io', 1),
('0002/far/08/asdf/08072019/Q', '99', 1),
('0003/far/08/asdf/08072019/Q', '99', 1),
('0004/far/08/asdf/08072019/Q', '99', 1),
('0004/far/08/asdf/08072019/Q', 'io', 1),
('0005/far/08/asdf/08072019/Q', '99', 2),
('0006/far/08/asdf/08072019/Q', '99', 3),
('0007/far/08/asdf/08072019/Q', '99', 3),
('0007/far/08/asdf/08072019/Q', 'io', 2),
('0008/far/08/asdf/08072019/BN', '99', 1),
('0009/far/08/asdf/08072019/Q', '99', 2),
('0010/far/08/asdf/08072019/Q', '99', 1),
('0011/far/08/asdf/08072019/Q', '99', 1),
('0012/far/08/asdf/08072019/BN', '99', 1),
('0013/far/08/asdf/08072019/Q', '99', 1),
('0013/far/08/asdf/08072019/Q', 'io', 1),
('0014/far/08/asdf/08072019/Q', '99', 1),
('0015/far/08/asdf/08072019/Q', '99', 1),
('0016/far/08/asdf/08072019/Q', '99', 1),
('0017/far/08/asdf/08072019/Q', '99', 1),
('0018/far/08/asdf/08072019/Q', 'io', 1),
('0019/far/08/asdf/08072019/Q', 'io', 1),
('0019/far/08/asdf/08072019/Q', '99', 2),
('0020/far/08/asdf/08072019/Q', 'io', 1),
('0020/far/08/asdf/08072019/Q', '99', 2),
('0021/far/08/asdf/08072019/Q', 'io', 1),
('0022/far/08/asdf/08072019/Q', '99', 1),
('0023/far/08/asdf/08072019/Q', '99', 1),
('0024/far/08/asdf/08072019/Q', '99', 1),
('0025/far/08/asdf/08072019/Q', 'io', 1),
('0026/far/08/asdf/08072019/Q', '99', 1),
('0027/far/08/asdf/08072019/Q', '99', 1),
('0028/far/08/asdf/08072019/Q', '99', 1),
('0029/far/08/asdf/08072019/Q', '99', 1),
('0001/far/09/jemb/09072019/Q', '99', 2),
('0001/far/09/jemb/09072019/Q', '312', 6),
('0001/far/10/jemb/10072019/Q', '312', 1),
('0002/far/10/jemb/10072019/Q', '312', 1),
('0002/far/10/jemb/10072019/Q', '99', 1),
('0001/far/11/jemb/11092019/Q', '99', 1),
('0002/far/11/kjsa/11092019/Q', '312', 1),
('0003/far/11/jemb/11092019/Q', 'a12', 1),
('0004/far/11/kjsa/11092019/Q', '312', 1);

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
('far', 'faris', '$2y$10$R10Wg6SNLLqataHIzW2S2.o/QAB/uuL.SDwvxlDPb3fqGjZItO3.O', 'Admin'),
('ref', 'refo', '$2y$10$vl2DQuP1fPZ3Ikn04LDmmuna5uRvRnDEGwfFL.p7I5KxP1RohsDdm', 'Admin');

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
('3', 'yusuf', '082245630061', 'jember', 'shsu@gmail.com', 'qwerrt'),
('98', 'jikkk', '90909', 'kjsadf', 'sadfj', 'asdf'),
('aku', 'aku', '09876', 'kampung', 'gsjaueja', 'sysy'),
('berli', 'berliana', '0837373737', 'jember', 'ausush@gmail.com', '123q'),
('C001', 'abdilana', '894454353', 'jember', 'abdilana@gmail.com', '$2y$10$wbqw40Ho2WQXBk9xxA7P9eIa6DLY/Z0iMyFBMomxU.IY0Ey5Nx1iK'),
('C009', 'bulukibubeti', '082234958855', 'jember', 'jjj', '$2y$10$xgbqvgBnImshTevhCj39iOg4eNTXpRZByXau1mgvtO9PHiP29avGm'),
('desti', 'destino', '07373832829', 'jember', 'destino@gmail.com', 'qwerty'),
('jsiis', 'jsiis', '827373', 'hsusus', 'hshsiiss', 'hshsuhss'),
('nugro', 'nugroho', '085736634113', 'jember', 'roti@gmail.com', 'asd'),
('octav', 'octavia', '08981154441', 'melati', 'syavinaoctaviap@gmail.com', 'octavia'),
('syavi', 'syavina', '08981154441', 'jalan melati v', 'syavinaoctaviap@gmail.com', 'syavina');

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
('PS0001', 'far', '3', '2019-07-10', 90000, 90),
('PS0002', 'far', '3', '2019-07-10', 90000, 90000),
('PS0003', 'far', 'C009', '2019-07-10', 90000, 90);

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
('0001/far/08/asdf/08072019/BN', 'far', '3', '2019-07-08', 990, 0, 11, 'kredit'),
('0001/far/09/jemb/09072019/Q', 'far', 'berli', '2019-07-09', 540180, 0, 1000000, 'lunas'),
('0001/far/10/jemb/10072019/Q', 'far', '3', '2019-07-10', 90000, 0, 90000, 'lunas'),
('0001/far/11/jemb/11092019/Q', 'far', '3', '2019-09-11', 90, 0, 100, 'lunas'),
('0002/far/08/asdf/08072019/Q', 'far', '3', '2019-07-08', 90, 0, 100, 'lunas'),
('0002/far/10/jemb/10072019/Q', 'far', '3', '2019-07-10', 45045, 0, 90000, 'lunas'),
('0002/far/11/kjsa/11092019/Q', 'far', '98', '2019-09-11', 90000, 0, 100000, 'lunas'),
('0003/far/08/asdf/08072019/Q', 'far', '3', '2019-07-08', 90, 0, 100, 'lunas'),
('0003/far/11/jemb/11092019/Q', 'far', '3', '2019-09-11', 10000, 0, 20000, 'lunas'),
('0004/far/08/asdf/08072019/Q', 'far', '3', '2019-07-08', 990, 0, 1000, 'lunas'),
('0004/far/11/kjsa/11092019/Q', 'far', '98', '2019-09-11', 90000, 0, 90000, 'lunas'),
('0005/far/08/asdf/08072019/Q', 'far', '3', '2019-07-08', 180, 0, 200, 'lunas'),
('0006/far/08/asdf/08072019/Q', 'far', '3', '2019-07-08', 270, 0, 300, 'lunas'),
('0007/far/08/asdf/08072019/Q', 'far', '3', '2019-07-08', 2070, 0, 2100, 'lunas'),
('0008/far/08/asdf/08072019/BN', 'far', '3', '2019-07-08', 90, 0, 80, 'kredit'),
('0009/far/08/asdf/08072019/Q', 'far', '3', '2019-07-08', 180, 0, 200, 'lunas'),
('0010/far/08/asdf/08072019/Q', 'far', '3', '2019-07-08', 90, 0, 100, 'lunas'),
('0011/far/08/asdf/08072019/Q', 'far', '3', '2019-07-08', 90, 0, 100, 'lunas'),
('0012/far/08/asdf/08072019/BN', 'far', '3', '2019-07-08', 90, 0, 90, 'kredit'),
('0013/far/08/asdf/08072019/Q', 'far', '3', '2019-07-08', 990, 0, 1000, 'lunas'),
('0014/far/08/asdf/08072019/Q', 'far', '3', '2019-07-08', 90, 0, 100, 'lunas'),
('0015/far/08/asdf/08072019/Q', 'far', '3', '2019-07-08', 90, 0, 100, 'lunas'),
('0016/far/08/asdf/08072019/Q', 'far', '3', '2019-07-08', 90, 0, 100, 'lunas'),
('0017/far/08/asdf/08072019/Q', 'far', '3', '2019-07-08', 90, 0, 100, 'lunas'),
('0018/far/08/asdf/08072019/Q', 'far', '3', '2019-07-08', 900, 0, 1000, 'lunas'),
('0019/far/08/asdf/08072019/Q', 'far', '3', '2019-07-08', 1080, 0, 1100, 'lunas'),
('0020/far/08/asdf/08072019/Q', 'far', '3', '2019-07-08', 1080, 0, 1100, 'lunas'),
('0021/far/08/asdf/08072019/Q', 'far', '3', '2019-07-08', 900, 0, 1000, 'lunas'),
('0022/far/08/asdf/08072019/Q', 'far', '3', '2019-07-08', 90, 0, 100, 'lunas'),
('0023/far/08/asdf/08072019/Q', 'far', '3', '2019-07-08', 90, 0, 100, 'lunas'),
('0024/far/08/asdf/08072019/Q', 'far', '3', '2019-07-08', 90, 0, 100, 'lunas'),
('0025/far/08/asdf/08072019/Q', 'far', '3', '2019-07-08', 900, 0, 1000, 'lunas'),
('0026/far/08/asdf/08072019/Q', 'far', '3', '2019-07-08', 90, 0, 100, 'lunas'),
('0027/far/08/asdf/08072019/Q', 'far', '3', '2019-07-08', 90, 0, 100, 'lunas'),
('0028/far/08/asdf/08072019/Q', 'far', '3', '2019-07-08', 90, 0, 100, 'lunas'),
('0029/far/08/asdf/08072019/Q', 'far', '3', '2019-07-08', 90, 0, 100, 'lunas');

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
-- Indeks untuk tabel `detail_barangmasuk`
--
ALTER TABLE `detail_barangmasuk`
  ADD KEY `id_barang` (`id_barang`),
  ADD KEY `id_barangmasuk` (`id_barangmasuk`);

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
  ADD CONSTRAINT `barangmasuk_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `login` (`id_user`) ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `detail_pemesanan`
--
ALTER TABLE `detail_pemesanan`
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
  ADD CONSTRAINT `pemesanan_ibfk_1` FOREIGN KEY (`id_pelanggan`) REFERENCES `pelanggan` (`id_pelanggan`) ON UPDATE CASCADE,
  ADD CONSTRAINT `pemesanan_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `login` (`id_user`) ON UPDATE CASCADE;

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
