-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 10 Jan 2023 pada 09.46
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

-- --------------------------------------------------------

--
-- Struktur dari tabel `rka_jangka_panjang`
--

CREATE TABLE `rka_jangka_panjang` (
  `uuid` char(36) NOT NULL,
  `nama_file` char(255) NOT NULL,
  `tanggal_upload` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `rka_tahunan`
--

CREATE TABLE `rka_tahunan` (
  `uuid` char(36) NOT NULL,
  `nama_file` char(255) NOT NULL,
  `tanggal_upload` date NOT NULL
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
  ADD PRIMARY KEY (`uuid`);

--
-- Indeks untuk tabel `rka_tahunan`
--
ALTER TABLE `rka_tahunan`
  ADD PRIMARY KEY (`uuid`);

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
