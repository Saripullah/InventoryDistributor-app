-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 05 Agu 2023 pada 09.31
-- Versi server: 10.1.38-MariaDB
-- Versi PHP: 5.6.40

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `barang1`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `barang`
--

CREATE TABLE `barang` (
  `id_barang` char(7) NOT NULL,
  `nama_barang` varchar(255) NOT NULL,
  `harga` int(11) NOT NULL,
  `stok` int(11) NOT NULL,
  `satuan_id` int(11) NOT NULL,
  `jenis_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `barang`
--

INSERT INTO `barang` (`id_barang`, `nama_barang`, `harga`, `stok`, `satuan_id`, `jenis_id`) VALUES
('B000000', 'ABC APPLE JUICE 24X250ML', 132000, 235, 4, 10),
('B000001', 'ABC GUAVA JUICE 24X250ML', 130000, 14, 4, 10),
('B000002', 'ABC KCP PDS 24X275ML', 280000, 25, 4, 14),
('B000003', 'ROYCO FDS CHICKEN 36X94G', 134000, 58, 4, 14),
('B000004', 'AROMA THERAPY 10 ML pcs', 10000, 17, 7, 15),
('B000005', 'Dancow UHT Chocolate 36x110ml', 76000, 82, 4, 16);

-- --------------------------------------------------------

--
-- Struktur dari tabel `barang_has_stok`
--

CREATE TABLE `barang_has_stok` (
  `id_barang_has_stok` int(11) UNSIGNED NOT NULL,
  `barang_id` char(7) COLLATE utf8mb4_unicode_ci NOT NULL,
  `barang_masuk_id` char(16) COLLATE utf8mb4_unicode_ci DEFAULT 'NULL',
  `stok` int(11) NOT NULL,
  `expired` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `barang_has_stok`
--

INSERT INTO `barang_has_stok` (`id_barang_has_stok`, `barang_id`, `barang_masuk_id`, `stok`, `expired`) VALUES
(112, 'B000000', 'NULL', 0, '0000-00-00'),
(113, 'B000000', 'T-BM-23071400000', 2, '2025-02-02'),
(114, 'B000001', 'NULL', 0, '0000-00-00'),
(115, 'B000001', 'T-BM-23071400001', 1, '2026-03-24'),
(116, 'B000002', 'NULL', 0, '0000-00-00'),
(117, 'B000002', 'T-BM-23071400002', 25, '2026-04-14'),
(118, 'B000003', 'NULL', 0, '0000-00-00'),
(119, 'B000003', 'T-BM-23071400003', 26, '2025-04-16'),
(120, 'B000000', 'T-BM-23071400004', 1, '2025-03-03'),
(121, 'B000003', 'T-BM-23071400005', 20, '2025-07-05'),
(122, 'B000004', 'NULL', 0, '0000-00-00'),
(123, 'B000004', 'T-BM-23071400006', 7, '2025-09-19'),
(124, 'B000005', 'NULL', 0, '0000-00-00'),
(125, 'B000005', 'T-BM-23071400007', 20, '2026-07-14'),
(126, 'B000000', 'T-BM-23071800001', 100, '2023-07-20'),
(127, 'B000005', 'T-BM-23071800001', 50, '2023-07-31'),
(128, 'B000000', 'T-BM-23071800001', 100, '2023-12-31'),
(129, 'B000000', 'T-BM-23071800002', 120, '2023-07-31'),
(130, 'B000005', 'T-BM-23071900001', 12, '2023-07-21'),
(131, 'B000001', 'T-BM-23071900002', 12, '2024-05-15'),
(132, 'B000004', 'T-BM-23071900003', 10, '2025-05-14'),
(133, 'B000000', 'T-BM-23072100000', 12, '2023-07-21');

-- --------------------------------------------------------

--
-- Struktur dari tabel `barang_keluar`
--

CREATE TABLE `barang_keluar` (
  `id_barang_keluar` char(16) NOT NULL,
  `user_id` int(11) NOT NULL,
  `barang_id` char(7) NOT NULL,
  `jumlah_keluar` int(11) NOT NULL,
  `tanggal_keluar` date NOT NULL,
  `tanggal_sekarang` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `barang_keluar`
--

INSERT INTO `barang_keluar` (`id_barang_keluar`, `user_id`, `barang_id`, `jumlah_keluar`, `tanggal_keluar`, `tanggal_sekarang`) VALUES
('T-BK-23071400000', 3, 'B000003', 1, '2023-07-14', '2023-07-14');

--
-- Trigger `barang_keluar`
--
DELIMITER $$
CREATE TRIGGER `update_stok_keluar` BEFORE INSERT ON `barang_keluar` FOR EACH ROW UPDATE `barang` SET `barang`.`stok` = `barang`.`stok` - NEW.jumlah_keluar WHERE `barang`.`id_barang` = NEW.barang_id
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `barang_masuk`
--

CREATE TABLE `barang_masuk` (
  `id_barang_masuk` char(16) NOT NULL,
  `supplier_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `barang_id` char(7) NOT NULL,
  `jumlah_masuk` int(11) NOT NULL,
  `tanggal_masuk` date NOT NULL,
  `expired` date NOT NULL,
  `is_input` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `barang_masuk`
--

INSERT INTO `barang_masuk` (`id_barang_masuk`, `supplier_id`, `user_id`, `barang_id`, `jumlah_masuk`, `tanggal_masuk`, `expired`, `is_input`) VALUES
('T-BM-23071400000', 1, 3, 'B000000', 2, '2023-07-14', '2023-07-20', 1),
('T-BM-23071400001', 1, 3, 'B000001', 1, '2023-07-14', '2023-07-20', 1),
('T-BM-23071400002', 1, 3, 'B000002', 25, '2023-07-14', '2023-07-20', 1),
('T-BM-23071400003', 1, 3, 'B000003', 27, '2023-07-14', '2023-07-20', 1),
('T-BM-23071400005', 1, 3, 'B000003', 20, '2023-07-14', '2023-07-20', 1),
('T-BM-23071400006', 7, 1, 'B000004', 7, '2023-07-14', '2023-07-20', 1),
('T-BM-23071400007', 3, 1, 'B000005', 20, '2023-07-14', '2023-07-20', 1),
('T-BM-23071700001', 1, 2, 'B000005', 50, '2023-07-17', '2023-07-31', 1),
('T-BM-23071700002', 2, 2, 'B000000', 100, '2023-07-17', '2023-12-31', 1),
('T-BM-23071800001', 1, 4, 'B000000', 120, '2023-07-18', '2023-07-31', 1),
('T-BM-23071900000', 1, 3, 'B000005', 12, '2023-07-19', '2023-07-21', 1),
('T-BM-23071900001', 1, 3, 'B000001', 12, '2023-07-19', '2024-05-15', 1),
('T-BM-23071900002', 1, 3, 'B000004', 10, '2023-07-19', '2025-05-14', 1),
('T-BM-23071900003', 1, 3, 'B000001', 1, '2023-07-19', '0000-00-00', 0),
('T-BM-23072000000', 1, 3, 'B000000', 12, '2023-07-20', '2023-07-21', 1);

--
-- Trigger `barang_masuk`
--
DELIMITER $$
CREATE TRIGGER `update_stok_masuk` BEFORE INSERT ON `barang_masuk` FOR EACH ROW UPDATE `barang` SET `barang`.`stok` = `barang`.`stok` + NEW.jumlah_masuk WHERE `barang`.`id_barang` = NEW.barang_id
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `barang_requests`
--

CREATE TABLE `barang_requests` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `barang_id` char(7) CHARACTER SET utf8 NOT NULL,
  `supplier_id` int(11) NOT NULL,
  `satuan_id` int(11) NOT NULL,
  `total` varchar(255) DEFAULT NULL,
  `isPermit` varchar(2) DEFAULT NULL,
  `tanggal` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `barang_requests`
--

INSERT INTO `barang_requests` (`id`, `user_id`, `barang_id`, `supplier_id`, `satuan_id`, `total`, `isPermit`, `tanggal`) VALUES
(13, 2, 'B000005', 1, 6, '12', '5', '2023-07-19 17:16:43'),
(14, 2, 'B000001', 1, 4, '12', '5', '2023-07-20 00:01:44'),
(15, 2, 'B000004', 1, 6, '10', '5', '2023-07-20 00:14:22'),
(17, 2, 'B000003', 1, 4, '12', '5', '2023-07-20 01:13:02'),
(18, 2, 'B000001', 1, 3, '1', '5', '2023-07-20 01:23:36'),
(20, 2, 'B000000', 1, 4, '12', '5', '2023-07-20 10:11:31'),
(21, 2, 'B000003', 1, 4, '12', '0', '2023-08-05 14:09:21');

-- --------------------------------------------------------

--
-- Struktur dari tabel `customer`
--

CREATE TABLE `customer` (
  `id` int(11) NOT NULL,
  `nama` text NOT NULL,
  `alamat` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `customer`
--

INSERT INTO `customer` (`id`, `nama`, `alamat`) VALUES
(3, 'TOKO ZADA PARENGGEAN', 'JL. LESA PARENGGEAN NO 120F '),
(4, 'ANGGUN 1 PARENGGEAN', 'JL. LESA PARENGGEAN'),
(5, 'ANGGUN 2 PARENGGEAN', 'JL LESA PARENGGEAN'),
(6, 'JAWA INDAH PRG', 'JL. LESA PASAR PARENGGEAN'),
(7, 'TK.MAMA NAFIS', 'JL. LESA SHINCAY PARENGGEAN'),
(8, 'TK AHUN 1', 'JL. BAHTERA PARENGGEAN');

-- --------------------------------------------------------

--
-- Struktur dari tabel `jenis`
--

CREATE TABLE `jenis` (
  `id_jenis` int(11) NOT NULL,
  `nama_jenis` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `jenis`
--

INSERT INTO `jenis` (`id_jenis`, `nama_jenis`) VALUES
(1, 'Makanan'),
(2, 'Beras'),
(3, 'Perawatan Wajah'),
(10, 'Minuman'),
(12, 'Sabun'),
(13, 'Shampo'),
(14, 'Bumbu'),
(15, 'Minyak oles'),
(16, 'Susu');

-- --------------------------------------------------------

--
-- Struktur dari tabel `penjualan`
--

CREATE TABLE `penjualan` (
  `id` int(11) NOT NULL,
  `id_barang` char(7) CHARACTER SET utf8 NOT NULL,
  `id_satuan` int(11) NOT NULL,
  `jml` int(255) NOT NULL,
  `harga` int(255) NOT NULL,
  `total` int(255) NOT NULL,
  `tgl` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `penjualan`
--

INSERT INTO `penjualan` (`id`, `id_barang`, `id_satuan`, `jml`, `harga`, `total`, `tgl`) VALUES
(6, 'B000000', 4, 1, 132000, 132000, '2023-07-15'),
(7, 'B000003', 4, 2, 134000, 268000, '2023-07-15'),
(8, 'B000005', 4, 3, 76000, 228000, '2023-07-15'),
(9, 'B000002', 4, 3, 280000, 840000, '2023-07-23');

-- --------------------------------------------------------

--
-- Struktur dari tabel `satuan`
--

CREATE TABLE `satuan` (
  `id_satuan` int(11) NOT NULL,
  `nama_satuan` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `satuan`
--

INSERT INTO `satuan` (`id_satuan`, `nama_satuan`) VALUES
(2, 'BOTOL'),
(3, 'LUSIN'),
(4, 'DUS'),
(6, 'PACK'),
(7, 'PCS');

-- --------------------------------------------------------

--
-- Struktur dari tabel `supplier`
--

CREATE TABLE `supplier` (
  `id_supplier` int(11) NOT NULL,
  `nama_supplier` varchar(50) NOT NULL,
  `no_telp` varchar(15) NOT NULL,
  `alamat` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `supplier`
--

INSERT INTO `supplier` (`id_supplier`, `nama_supplier`, `no_telp`, `alamat`) VALUES
(1, 'UNILEVER', '02180827000', 'Green Office Park Kav. 3Jl BSD Boulevard Barat , BSD City , Tangerang\r\nIndonesia'),
(2, 'PT.FNA (  SARIMURNI )', '0618469110', 'Jl. Mistar No. 28 Kel. Sei Putih Barat Kec. Medan Petisah'),
(3, 'PT. PAPA SAMSU ( NESTLE )', '0821992999222', 'Banjarmasin kalimantan selatan'),
(4, 'CV. BUDIANA', '082191010202', 'Banjar baru Gg. Liar 2 Kalimantan Selatan'),
(5, 'PT. PUJI SURYA INDAH ( SIRUP MARJAN )', '031545214143', 'Jl. Bubutan 144 Surabaya'),
(6, 'PT.SARI MEKAR CAHAYA PERSADA ( VAVE & TEH POCI)', '082191010270', 'Jl. Pasar Baru Kota Banjarmasin, Kalimantan Selatan'),
(7, 'PT.USFI ( MINYAK CAP GAJAH)', '3715451', 'Jl. Kedungcowek No. 345 SURABAYA 60129'),
(9, 'PT.LOTTE INDONESIA (PERMEN KARET)', '622122766700', 'Jl. R.A. Kartini Kav.8. Cilandak Barat, Jakarta Selatan,12430. Tel: +62-21-22766700'),
(10, 'PT.SEKAR LAUT Tbk ( Sambal ulek & kerupuk kurcil)', '082315671371', 'Jl. Raya Darmo 23-25Surabaya 60265East Java-Indonesia'),
(11, 'PT.TRIJAYA ADHIRAJA ABADI ( Dettol)', '082230713888', 'JL. ADAM MALIK NOMOR10 SAMARINDA');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `no_telp` varchar(15) NOT NULL,
  `role` enum('gudang','admin','supervisor') NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` int(11) NOT NULL,
  `foto` text NOT NULL,
  `is_active` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id_user`, `nama`, `username`, `email`, `no_telp`, `role`, `password`, `created_at`, `foto`, `is_active`) VALUES
(1, 'Adminisitrator', 'admin', 'admin@admin.com', '082191010202', 'admin', '$2y$10$w9TKJGwpbBnpr0x0cW4k2ec1OmIo48BmLAPLsp8MqHMICnGPlCjfG', 1568689561, 'd5f22535b639d55be7d099a7315e1f7f.png', 1),
(2, 'user', 'User', 'user@gmail.com', '082191010270', 'gudang', '$2y$10$48hQUu2t5/kVi/Yk61Rx8eVR6Jne5gluLyNYqGiGG0XdLWKLVSYMC', 1689349596, 'user.png', 1),
(3, 'Saripullah', 'Saripullah', 'sarippullah1945@gmail.com', '082191010270', 'supervisor', '$2y$10$komjw/.107V6kO8ORCFZVO7obI5IOGJKSkSpxgA.4vBh7tr/.tb7a', 1689351027, '1d48d3fd8bcb53c70097a365575ab572.png', 1),
(4, 'Sigit Dimas', 'Sigit', 'dimas@gmail.com', '085651901518', 'supervisor', '$2y$10$48hQUu2t5/kVi/Yk61Rx8eVR6Jne5gluLyNYqGiGG0XdLWKLVSYMC', 1689400936, 'user.png', 1);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`id_barang`),
  ADD KEY `satuan_id` (`satuan_id`),
  ADD KEY `kategori_id` (`jenis_id`);

--
-- Indeks untuk tabel `barang_has_stok`
--
ALTER TABLE `barang_has_stok`
  ADD PRIMARY KEY (`id_barang_has_stok`);

--
-- Indeks untuk tabel `barang_keluar`
--
ALTER TABLE `barang_keluar`
  ADD PRIMARY KEY (`id_barang_keluar`),
  ADD KEY `id_user` (`user_id`),
  ADD KEY `barang_id` (`barang_id`);

--
-- Indeks untuk tabel `barang_masuk`
--
ALTER TABLE `barang_masuk`
  ADD PRIMARY KEY (`id_barang_masuk`),
  ADD KEY `id_user` (`user_id`),
  ADD KEY `supplier_id` (`supplier_id`),
  ADD KEY `barang_id` (`barang_id`);

--
-- Indeks untuk tabel `barang_requests`
--
ALTER TABLE `barang_requests`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `supplier_id` (`supplier_id`),
  ADD KEY `barang_id` (`barang_id`),
  ADD KEY `satuan_id` (`satuan_id`);

--
-- Indeks untuk tabel `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `jenis`
--
ALTER TABLE `jenis`
  ADD PRIMARY KEY (`id_jenis`);

--
-- Indeks untuk tabel `penjualan`
--
ALTER TABLE `penjualan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_barang` (`id_barang`),
  ADD KEY `id_satuan` (`id_satuan`);

--
-- Indeks untuk tabel `satuan`
--
ALTER TABLE `satuan`
  ADD PRIMARY KEY (`id_satuan`);

--
-- Indeks untuk tabel `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`id_supplier`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `barang_has_stok`
--
ALTER TABLE `barang_has_stok`
  MODIFY `id_barang_has_stok` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=134;

--
-- AUTO_INCREMENT untuk tabel `barang_requests`
--
ALTER TABLE `barang_requests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT untuk tabel `customer`
--
ALTER TABLE `customer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `jenis`
--
ALTER TABLE `jenis`
  MODIFY `id_jenis` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT untuk tabel `penjualan`
--
ALTER TABLE `penjualan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `satuan`
--
ALTER TABLE `satuan`
  MODIFY `id_satuan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `supplier`
--
ALTER TABLE `supplier`
  MODIFY `id_supplier` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
