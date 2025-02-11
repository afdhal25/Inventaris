-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 10 Feb 2025 pada 16.33
-- Versi server: 10.4.24-MariaDB
-- Versi PHP: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `inventaris`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `barang`
--

CREATE TABLE `barang` (
  `id_barang` int(11) NOT NULL,
  `nama_barang` varchar(255) NOT NULL,
  `harga` int(50) NOT NULL,
  `stok` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `barang`
--

INSERT INTO `barang` (`id_barang`, `nama_barang`, `harga`, `stok`) VALUES
(55, 'ikan', 12345, 5),
(56, 'susu', 2147483647, 8),
(57, 'lele', 10000, 5),
(58, 'laptop', 5000, 5),
(59, 'mobil', 12000, 4),
(60, 'yoyo', 10000, 5);

-- --------------------------------------------------------

--
-- Struktur dari tabel `detail_pembelian`
--

CREATE TABLE `detail_pembelian` (
  `detail_pembelian_id` int(11) NOT NULL,
  `pembelian_id` int(11) NOT NULL,
  `id_barang` int(11) NOT NULL,
  `jumlah` decimal(50,0) NOT NULL,
  `sub_total` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `pembelian`
--

CREATE TABLE `pembelian` (
  `IDpembelian` int(11) NOT NULL,
  `tanggal_pembelian` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `suplier_ID` int(11) NOT NULL,
  `user_id` int(12) NOT NULL,
  `id_barang` int(11) NOT NULL,
  `total_harga` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `pembelian`
--

INSERT INTO `pembelian` (`IDpembelian`, `tanggal_pembelian`, `suplier_ID`, `user_id`, `id_barang`, `total_harga`) VALUES
(1, '2025-02-09 17:00:00', 0, 2, 36, '2000'),
(2, '2025-02-10 06:06:37', 1, 2, 40, '264000'),
(3, '2025-02-10 06:07:12', 2, 2, 41, '24000'),
(4, '2025-02-10 06:13:05', 2, 2, 42, '20000'),
(5, '2025-02-10 07:10:36', 1, 2, 43, '30000'),
(6, '2025-02-10 07:10:58', 2, 2, 44, '20000'),
(7, '2025-02-10 08:31:43', 2, 2, 45, '40000'),
(8, '2025-02-10 08:46:51', 1, 2, 46, '30000'),
(9, '2025-02-10 08:59:54', 1, 2, 47, '15000'),
(10, '2025-02-10 09:02:51', 1, 2, 48, '40000'),
(11, '2025-02-10 09:42:47', 3, 2, 49, '40000'),
(12, '2025-02-10 09:44:20', 2, 2, 50, '55555555555'),
(13, '2025-02-10 11:58:40', 3, 2, 51, '40000'),
(14, '2025-02-10 12:01:02', 1, 2, 52, '33333333333'),
(15, '2025-02-10 12:01:41', 2, 2, 53, '40000'),
(16, '2025-02-10 12:23:17', 2, 2, 54, '304038'),
(17, '2025-02-10 12:24:51', 2, 2, 55, '61725'),
(18, '2025-02-10 12:27:02', 1, 2, 56, '88888888888'),
(19, '2025-02-10 13:25:21', 1, 2, 57, '50000'),
(20, '2025-02-10 13:44:13', 1, 2, 58, '25000'),
(21, '2025-02-10 14:23:35', 2, 2, 59, '48000'),
(22, '2025-02-10 14:40:17', 4, 2, 60, '50000');

-- --------------------------------------------------------

--
-- Struktur dari tabel `supplier`
--

CREATE TABLE `supplier` (
  `suplier_ID` int(11) NOT NULL,
  `nama_orang` varchar(255) NOT NULL,
  `alamat` varchar(25) NOT NULL,
  `no_hp` int(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `supplier`
--

INSERT INTO `supplier` (`suplier_ID`, `nama_orang`, `alamat`, `no_hp`) VALUES
(1, 'fajri', '', 0),
(2, 'hakim', '', 0),
(3, 'chelsea', '', 0),
(4, 'mezu', '', 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `user_id` int(12) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('Administrator','Petugas') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`user_id`, `username`, `password`, `role`) VALUES
(2, 'afdhal', '123456', 'Administrator'),
(3, 'satya', '123456', 'Administrator'),
(4, 'chelsea', '123456', 'Administrator'),
(5, 'ridwan', '$2y$10$iJmYNLKGGXNeSdZFVH7BSudlKeQfi.Mj3xB.otioQWHTDBDrptT86', 'Administrator'),
(6, 'agha', '$2y$10$mkpbjkKJapRak5mMehl5Bexyp77fip/ujkAXj4vSgubC0649mQu/y', 'Administrator'),
(7, 'hakim', '$2y$10$6BIOHmVycOT1/k/FgUMqKOQ3EfFmbW6ho6jw3QydQmyTzY2Hb3oIG', 'Administrator'),
(8, 'reza', '$2y$10$4u0v4DUHsZio064.3KbPLuPRdl86i/tu.gNAR1lkRZvxmy.9ctMZq', 'Administrator'),
(9, 'rizal', '$2y$10$gf5WisqGc7YSPTqR./0QguT5BJCdEUUcq2krUurHrM/9k36TNrG/2', 'Administrator'),
(10, 'satria', '$2y$10$C35y.fVAQO8ySWNL6PXv1OT3a5H6ZmFPcxvisdtK.qcg2IB2LQX/.', 'Administrator'),
(11, 'erni', '$2y$10$gCTHfPZDKwjdDbvxSmJ5UOD6ArCHFqOONT4hmObvd4KI8G/.WZIzm', 'Administrator');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`id_barang`);

--
-- Indeks untuk tabel `detail_pembelian`
--
ALTER TABLE `detail_pembelian`
  ADD PRIMARY KEY (`detail_pembelian_id`),
  ADD KEY `IDpembelian` (`pembelian_id`),
  ADD KEY `barang_id` (`id_barang`),
  ADD KEY `id_barang` (`id_barang`);

--
-- Indeks untuk tabel `pembelian`
--
ALTER TABLE `pembelian`
  ADD PRIMARY KEY (`IDpembelian`),
  ADD UNIQUE KEY `id_barang` (`IDpembelian`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `id_barang_2` (`id_barang`),
  ADD KEY `suplier_ID` (`suplier_ID`);

--
-- Indeks untuk tabel `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`suplier_ID`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `barang`
--
ALTER TABLE `barang`
  MODIFY `id_barang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT untuk tabel `detail_pembelian`
--
ALTER TABLE `detail_pembelian`
  MODIFY `detail_pembelian_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `pembelian`
--
ALTER TABLE `pembelian`
  MODIFY `IDpembelian` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT untuk tabel `supplier`
--
ALTER TABLE `supplier`
  MODIFY `suplier_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `detail_pembelian`
--
ALTER TABLE `detail_pembelian`
  ADD CONSTRAINT `detail_pembelian_ibfk_1` FOREIGN KEY (`id_barang`) REFERENCES `barang` (`id_barang`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `pembelian`
--
ALTER TABLE `pembelian`
  ADD CONSTRAINT `pembelian_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
