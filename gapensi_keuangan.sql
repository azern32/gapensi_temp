-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 13 Jan 2023 pada 14.55
-- Versi server: 10.4.22-MariaDB
-- Versi PHP: 7.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gapensi_keuangan`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `daftar_akun`
--

CREATE TABLE `daftar_akun` (
  `uuid` char(38) NOT NULL,
  `kode_akun` char(32) NOT NULL,
  `nama_akun` char(255) NOT NULL,
  `tipe_akun` char(38) NOT NULL,
  `debit` bigint(20) NOT NULL DEFAULT 0,
  `kredit` bigint(20) NOT NULL DEFAULT 0,
  `saldo` bigint(20) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `daftar_akun`
--

INSERT INTO `daftar_akun` (`uuid`, `kode_akun`, `nama_akun`, `tipe_akun`, `debit`, `kredit`, `saldo`) VALUES
('1afa73d2-d5f0-4404-ad8f-d03f32f88eb2', 'yoyo', 'yesooo', '5657c8dc-2c12-4228-888b-ae03679d4c26', 34688225899, 5166584, 34683059315),
('2c5630bc-c9da-4e1f-9008-0a9139688763', 'wah', 'wah wah', '53d515bc-7056-4f42-a98e-10a1a39046cc', 0, 0, 0),
('b00e9f08-96be-425e-a4a4-6a1485eb9e18', 'yo', 'yes', '53d515bc-7056-4f42-a98e-10a1a39046cc', 5166584, 34688225899, -34683059315);

-- --------------------------------------------------------

--
-- Struktur dari tabel `daftar_tipe`
--

CREATE TABLE `daftar_tipe` (
  `uuid` char(38) NOT NULL,
  `kode_tipe` char(36) NOT NULL,
  `nama_tipe` char(255) NOT NULL,
  `kategori` char(36) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `daftar_tipe`
--

INSERT INTO `daftar_tipe` (`uuid`, `kode_tipe`, `nama_tipe`, `kategori`) VALUES
('53d515bc-7056-4f42-a98e-10a1a39046cc', 'sdsd', 'sdsdsd', 'Accumulated Depreciation'),
('5657c8dc-2c12-4228-888b-ae03679d4c26', 'fhg', 'asfhgd', 'Current Assets'),
('d1dc7245-8a46-4c49-9ecf-605fe06f26c3', 'dsdsgg', 'asdasdfsfsf', 'Long-term Liabilities'),
('e42d99e3-181f-4b0d-8d51-51a068cf6d0f', 'undefined', 'undefined', 'undefined');

-- --------------------------------------------------------

--
-- Struktur dari tabel `jurnal`
--

CREATE TABLE `jurnal` (
  `uuid` char(38) NOT NULL,
  `timestamp` bigint(20) NOT NULL,
  `tanggal` date NOT NULL,
  `keterangan` varchar(1000) NOT NULL,
  `nilai` bigint(20) NOT NULL,
  `akun_debet` char(38) NOT NULL,
  `akun_kredit` char(38) NOT NULL,
  `bukti_transaksi` char(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `jurnal`
--

INSERT INTO `jurnal` (`uuid`, `timestamp`, `tanggal`, `keterangan`, `nilai`, `akun_debet`, `akun_kredit`, `bukti_transaksi`) VALUES
('17bb47e6-448b-4957-9470-1db937cc4103', 1673515390710, '2023-01-04', 'datatable is not function', 2525, '1afa73d2-d5f0-4404-ad8f-d03f32f88eb2', 'b00e9f08-96be-425e-a4a4-6a1485eb9e18', '[]'),
('1cb6c79a-7353-4adb-a1dd-f252fe9fae32', 1673514042806, '2023-01-06', '1 kali pi', 47561, '1afa73d2-d5f0-4404-ad8f-d03f32f88eb2', 'b00e9f08-96be-425e-a4a4-6a1485eb9e18', '[]'),
('286bd749-c040-4a81-b341-2275e239f613', 1673513997302, '0000-00-00', 'yang ini mi', 6844, '1afa73d2-d5f0-4404-ad8f-d03f32f88eb2', 'b00e9f08-96be-425e-a4a4-6a1485eb9e18', '[]'),
('2f7b7d48-c9f8-4d95-9852-4c8a40139b13', 1673515506766, '2023-01-11', 'bah', 2333333333, '1afa73d2-d5f0-4404-ad8f-d03f32f88eb2', 'b00e9f08-96be-425e-a4a4-6a1485eb9e18', '[]'),
('42935f45-fb98-4093-9a1e-287babdbc56d', 1673514478798, '2023-01-02', 'asfafaf', 5000, '1afa73d2-d5f0-4404-ad8f-d03f32f88eb2', 'b00e9f08-96be-425e-a4a4-6a1485eb9e18', '[]'),
('4912fdf3-55a9-4282-8e86-3bb9230639cc', 1673515369894, '2023-01-03', 'asdada', 3453636, '1afa73d2-d5f0-4404-ad8f-d03f32f88eb2', 'b00e9f08-96be-425e-a4a4-6a1485eb9e18', '[]'),
('6d4d28e5-d083-4751-a6ad-b31b8e2d7740', 1673521199701, '2023-01-11', 'apakah muncul di atas', 4566584, 'b00e9f08-96be-425e-a4a4-6a1485eb9e18', '1afa73d2-d5f0-4404-ad8f-d03f32f88eb2', '[]'),
('7053b50f-acb9-43e4-8892-6c4b99ce0893', 1673513696038, '2023-01-04', 'asdad', 5000, '1afa73d2-d5f0-4404-ad8f-d03f32f88eb2', 'b00e9f08-96be-425e-a4a4-6a1485eb9e18', '[]'),
('7da815e1-3a1b-490f-95bd-dd971c445630', 1673525851646, '2023-01-08', 'paling atas mi', 600000, 'b00e9f08-96be-425e-a4a4-6a1485eb9e18', '1afa73d2-d5f0-4404-ad8f-d03f32f88eb2', '[]'),
('898986e2-141f-4830-9e2a-cd643ce640c2', 1673515539318, '0000-00-00', 'mas', 7777777, '1afa73d2-d5f0-4404-ad8f-d03f32f88eb2', 'b00e9f08-96be-425e-a4a4-6a1485eb9e18', '[]'),
('abd1926e-aa3c-46a2-b1ad-d7a213a2c2fe', 1673518251557, '2023-02-11', 'wanjir lah', 30000000000, '1afa73d2-d5f0-4404-ad8f-d03f32f88eb2', 'b00e9f08-96be-425e-a4a4-6a1485eb9e18', '[]'),
('bf676d0f-1dc1-4617-b044-68896bdb1cc0', 1673513948006, '2023-01-02', 'asdad', 2342354254, '1afa73d2-d5f0-4404-ad8f-d03f32f88eb2', 'b00e9f08-96be-425e-a4a4-6a1485eb9e18', '[]'),
('ca34c03d-4f20-4a63-b534-396bd022e825', 1673513899230, '2023-01-11', 'mestinya sudah bisa', 30000, '1afa73d2-d5f0-4404-ad8f-d03f32f88eb2', 'b00e9f08-96be-425e-a4a4-6a1485eb9e18', '[]'),
('d48ac7a8-1759-44f8-878e-28fd8d9d8b28', 1673515457094, '2023-01-12', 'pantasan anjir', 1154444, '1afa73d2-d5f0-4404-ad8f-d03f32f88eb2', 'b00e9f08-96be-425e-a4a4-6a1485eb9e18', '[]'),
('d669f08d-b183-422e-ad6e-f241be922754', 1673513329383, '2023-01-03', 'sdfsfsf', 2000, '1afa73d2-d5f0-4404-ad8f-d03f32f88eb2', 'b00e9f08-96be-425e-a4a4-6a1485eb9e18', '[]'),
('e5638ea4-8088-445a-a3db-fe63fde595c0', 1673515199590, '2023-01-05', 'asdadada', 23525, '1afa73d2-d5f0-4404-ad8f-d03f32f88eb2', 'b00e9f08-96be-425e-a4a4-6a1485eb9e18', '[]'),
('f8cbc6fe-df6b-4d28-890b-59e8214f47cb', 1673521230261, '2023-01-03', 'muncul di atas dong', 30000, '1afa73d2-d5f0-4404-ad8f-d03f32f88eb2', 'b00e9f08-96be-425e-a4a4-6a1485eb9e18', '[]');

-- --------------------------------------------------------

--
-- Struktur dari tabel `rka_jangka_panjang`
--

CREATE TABLE `rka_jangka_panjang` (
  `uuid` char(36) NOT NULL,
  `timestamp` bigint(20) NOT NULL,
  `nama_file` char(255) NOT NULL,
  `judul_file` char(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `rka_tahunan`
--

CREATE TABLE `rka_tahunan` (
  `uuid` char(36) NOT NULL,
  `timestamp` bigint(20) NOT NULL DEFAULT 0,
  `nama_file` char(255) NOT NULL,
  `judul_file` char(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `uuid` char(38) NOT NULL,
  `level` tinyint(4) NOT NULL,
  `username` char(31) NOT NULL,
  `password` char(255) NOT NULL,
  `nama_asli` char(63) NOT NULL,
  `jabatan` char(63) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`uuid`, `level`, `username`, `password`, `nama_asli`, `jabatan`) VALUES
('a', 1, 'a', '0cc175b9c0f1b6a831c399e269772661', 'a', 'a'),
('b', 2, 'b', '92eb5ffee6ae2fec3ad71c777531578f', 'b', 'b'),
('root', 9, 'root', '63a9f0ea7bb98050796b649e85481845', 'root', 'root');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `daftar_akun`
--
ALTER TABLE `daftar_akun`
  ADD PRIMARY KEY (`uuid`),
  ADD UNIQUE KEY `kode_akun` (`kode_akun`);

--
-- Indeks untuk tabel `daftar_tipe`
--
ALTER TABLE `daftar_tipe`
  ADD PRIMARY KEY (`uuid`),
  ADD UNIQUE KEY `kode_tipe` (`kode_tipe`);

--
-- Indeks untuk tabel `jurnal`
--
ALTER TABLE `jurnal`
  ADD PRIMARY KEY (`uuid`) USING BTREE;

--
-- Indeks untuk tabel `rka_jangka_panjang`
--
ALTER TABLE `rka_jangka_panjang`
  ADD PRIMARY KEY (`uuid`),
  ADD UNIQUE KEY `timestamp` (`timestamp`);

--
-- Indeks untuk tabel `rka_tahunan`
--
ALTER TABLE `rka_tahunan`
  ADD PRIMARY KEY (`uuid`),
  ADD UNIQUE KEY `timestamp` (`timestamp`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`uuid`),
  ADD UNIQUE KEY `username` (`username`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
