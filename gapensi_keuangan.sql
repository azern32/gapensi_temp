-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 26 Jan 2023 pada 02.44
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
('0498d286-b362-4b94-911d-cc0a7a0570ec', '1-11002', 'Cash On Hand', '1bf6e0db-804b-4e76-9f99-586c5286699c', 0, 355000, -355000),
('09fc4e3e-47a4-463d-90c3-345e07474247', '1-13004', 'Other Receivable', 'bc82375d-48ed-4611-9475-d381d296d801', 0, 0, 0),
('0b47e690-2cf6-4859-9902-80f2b07e93ac', '2-50002', 'Witholding Tax Art. 4(2)', 'c4a0b5bf-bdaa-46e3-85eb-1255d8de16f4', 0, 0, 0),
('107db034-89fc-4af6-8b35-7c1abf0ec22e', '2-50007', 'Witholding Tax Art. 26', 'c4a0b5bf-bdaa-46e3-85eb-1255d8de16f4', 0, 0, 0),
('1b2969dc-6c95-4048-ae8b-b9bedacaa81b', '3-20000', 'Equities', '0c794c2a-d830-4e63-83e2-888d55580c21', 0, 0, 0),
('1f29ce97-65d2-4553-baf5-336f978ff6be', '2-40000', 'Other Payables', 'c403ca3d-227d-4e8a-a4d2-ec47feb6949c', 0, 0, 0),
('2fefa4a4-35f7-4e58-be5b-6c35f0b4204c', '1-21001', 'Building & Land', 'bdcdb1a0-556b-465b-8ab5-49bbc76d500f', 0, 0, 0),
('3ae67a7d-5bcf-4ca9-bd4e-46d0e6c49a70', '1-11001', 'Petty Cash', '4112b077-3a72-4891-bcd5-555a02a329a1', 0, 500000, -500000),
('3bd8b0a0-21e8-4d25-bf8f-6568f28c0a98', '3-10000', 'Equity', 'c9b99d66-8ab2-48ae-bcf8-06091ec5081c', 0, 0, 0),
('3e5fc1ef-a130-4987-9f20-22f942381753', '1-30001', 'Other Assets', '3023ea17-6c62-4a2b-988b-7df5f2a2044c', 800000, 0, 800000),
('4f7266e0-ef16-43f6-9b3a-abe28f93ddf5', '3-30000', 'Retained Earning', '7a99d09c-14db-4c6c-886c-976b11a49022', 0, 0, 0),
('5433144d-be8f-49aa-9733-bc2c5d65655e', '1-22003', 'Accumulated Depreciation - Vehicles', '486763c3-48d8-4821-8617-29143e9aea41', 0, 0, 0),
('6caa972e-b9e7-45e5-a2d6-4175fb4daf0c', '4-20000', 'Product Revenue', '3adb93d5-4408-4896-8b3f-fa440b181b7f', 0, 0, 0),
('8730f869-1614-4d72-a9ff-6c1910fff54e', '1-21003', 'Vehicles', 'd715753e-2e4f-482c-84f3-0a6256b6be38', 50000, 0, 50000),
('8c4bc0fe-43cb-47f9-808e-a8bce278ba94', '1-22001', 'Accumulated Depreciation - Building & Land', 'f8b6f2c2-b769-43e4-8fd4-565b7c396b87', 5000, 0, 5000),
('8e446183-4d4e-4862-8312-d1443f54789c', '1-15001', 'Prepaid Exp', 'a5fdc31b-17a4-406a-9f55-cf46f0c09b52', 0, 0, 0),
('95470324-ab33-4017-a955-dd781a7f1cf5', '2-50003', 'Witholding Tax Art. 21', 'c4a0b5bf-bdaa-46e3-85eb-1255d8de16f4', 0, 0, 0),
('9f2c4993-18e9-4d64-9b44-7f35d284ad1a', '1-22004', 'Accumulated Depreciation - Furnitures & Fixtures', 'b0e1c851-d1ca-47d2-8c6a-843baff998e6', 0, 0, 0),
('9f2fcf41-1cec-4813-8da5-2c5c83435018', '1-15003', 'Value Added Tax - In', 'a5fdc31b-17a4-406a-9f55-cf46f0c09b52', 0, 0, 0),
('a4a26edf-7dcf-44fb-b47a-4d04ca7c9e7c', '3-40000', 'Net Profit (Loss)', '3adb93d5-4408-4896-8b3f-fa440b181b7f', 0, 0, 0),
('a9720a3e-1dc4-4959-ba28-53c58187e2f9', '1-11003', 'RCC', '210e2f37-1f5e-4522-9a1d-ba1c73b2a54f', 0, 0, 0),
('aa84dc93-b7b0-40d5-be5f-ab2b1ec661cd', '1-40001', 'Deposito', 'eab3d882-852c-427d-941c-d0897aab46fd', 0, 0, 0),
('ad9c86a9-d4d6-4c3d-8812-a5f3531fbc72', '1-22002', 'Accumulated Depreciation - Equipment', '2ebc49e7-4b2e-42ab-9931-d2379a135af6', 0, 0, 0),
('adb05171-0e2d-4683-8937-3a6eec082bc1', '1-21002', 'Equipment', '13414a12-ee2b-4ef0-a506-1166832ad0b2', 0, 0, 0),
('b295db6e-94bb-4229-aa8e-1eeccacee0ac', '2-50006', 'Witholding Tax Art. 25', 'c4a0b5bf-bdaa-46e3-85eb-1255d8de16f4', 0, 0, 0),
('b933e620-b611-47dc-8dc9-bb5a2c715228', '2-30000', 'Bank Loan', 'ae8179cb-b253-4281-8013-5dd24799c0c1', 0, 0, 0),
('c038630c-0573-425c-8c00-e577fa6c3883', '5-11001', 'Salary', '3adb93d5-4408-4896-8b3f-fa440b181b7f', 0, 0, 0),
('c2c61c27-66b9-4e25-8598-6f75b90b1a29', '2-50005', 'Witholding Tax Art. 23', 'c4a0b5bf-bdaa-46e3-85eb-1255d8de16f4', 0, 0, 0),
('c2e135df-c97f-469c-9536-65124da76dc1', '2-11000', 'Account Payables', 'f9959b83-d1a1-4501-8747-fd5788a3818a', 0, 0, 0),
('c9615d0c-4b9b-4d89-b2dc-2da95f606fd5', '2-50004', 'Witholding Tax Art. 22', 'c4a0b5bf-bdaa-46e3-85eb-1255d8de16f4', 0, 0, 0),
('e2ec2046-53d1-49f1-a571-40cc6d1e951c', '2-50001', 'Value Added Tax - Out', 'c4a0b5bf-bdaa-46e3-85eb-1255d8de16f4', 0, 0, 0),
('e908bf1c-0000-4e44-bdc1-df8f7ff15c73', '2-60001', 'Accrued Expenses', 'c2592b4d-e2ad-4aac-ad04-2d4faa28c7d1', 0, 0, 0),
('e964c2a9-26d4-41ed-bdc3-3b3676129a3a', '4-10000', 'Service Revenue', '3adb93d5-4408-4896-8b3f-fa440b181b7f', 0, 0, 0),
('eb9fa6d0-37dc-48cc-9da8-6bf27e22df3d', '1-21004', 'Furnitures & Fixtures', '5f59542b-6e83-469e-b6ab-e97bc349308e', 0, 0, 0),
('ee30af80-f42b-4c04-beba-49f489e39c66', '2-50008', 'Witholding Tax Art. 29', 'c4a0b5bf-bdaa-46e3-85eb-1255d8de16f4', 0, 0, 0),
('f2d3915d-ee67-47f9-93c0-1d43f54d96b9', '1-13001', 'Trade Receivable', '2e92c5f9-d8bd-4a3b-a12d-8b7bd62af65a', 0, 0, 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `daftar_tipe`
--

CREATE TABLE `daftar_tipe` (
  `uuid` char(38) NOT NULL,
  `nama_tipe` char(255) NOT NULL,
  `kategori` char(36) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `daftar_tipe`
--

INSERT INTO `daftar_tipe` (`uuid`, `nama_tipe`, `kategori`) VALUES
('021ad19d-8007-492a-b1af-2f0219a96efe', 'Prepaid Tax', 'Current Assets'),
('0c794c2a-d830-4e63-83e2-888d55580c21', 'EQUITIES', 'Long-term Liabilities'),
('13414a12-ee2b-4ef0-a506-1166832ad0b2', 'Equipment', 'Fixed Assets'),
('1bf6e0db-804b-4e76-9f99-586c5286699c', 'Cash On Hand', 'Current Assets'),
('210e2f37-1f5e-4522-9a1d-ba1c73b2a54f', 'RCC', 'Current Assets'),
('2e92c5f9-d8bd-4a3b-a12d-8b7bd62af65a', 'Trade Receivable', 'Current Assets'),
('2ebc49e7-4b2e-42ab-9931-d2379a135af6', 'Accumulated Depreciation - Equipment', 'Accumulated Depreciation'),
('3023ea17-6c62-4a2b-988b-7df5f2a2044c', 'Other Assets', 'Other Assets'),
('3adb93d5-4408-4896-8b3f-fa440b181b7f', 'Net Profit (Loss)', 'Balance of Profit'),
('3dd91737-9bb3-4a3e-8d0c-69a3a26c3703', 'Supplies', 'Current Assets'),
('4112b077-3a72-4891-bcd5-555a02a329a1', 'Petty Cash', 'Current Assets'),
('45e29ca6-003f-4b2c-bbef-c462ef99643a', 'Fixed Assets', 'Fixed Assets'),
('4650fe40-2e7c-4d67-924f-89993ffcad86', 'Cash Advance', 'Current Assets'),
('486763c3-48d8-4821-8617-29143e9aea41', 'Accumulated Depreciation - Vehicles', 'Accumulated Depreciation'),
('579c9a8e-3a88-4dc7-a51e-b6e7bc5ca871', 'Non-Trade Payables', 'Liabilities'),
('5f59542b-6e83-469e-b6ab-e97bc349308e', 'Furnitures & Fixtures', 'Fixed Assets'),
('649fa2bf-674d-4a78-8988-a67ad730f197', 'Accumulated Depreciation', 'Accumulated Depreciation'),
('6775e7b3-2650-49e5-aa5d-08941bc6ea10', 'Employee Receivable', 'Current Assets'),
('72eb6b56-acaa-406d-9422-44abf059af9c', 'Cash In Bank - USD', 'Current Assets'),
('7a99d09c-14db-4c6c-886c-976b11a49022', 'Retained Earning', 'Balance of Profit'),
('849e610f-8280-4787-b95b-70a287bb59ea', 'Trade Payables', 'Liabilities'),
('9c20b536-62f2-4a02-a1c1-96709e4d05a0', 'Current Liabilities', 'Liabilities'),
('a5fdc31b-17a4-406a-9f55-cf46f0c09b52', 'Prepaid Exp', 'Current Assets'),
('ae8179cb-b253-4281-8013-5dd24799c0c1', 'Bank Loan', 'Liabilities'),
('b0e1c851-d1ca-47d2-8c6a-843baff998e6', 'Accumulated Depreciation - Furnitures & Fixtures', 'Accumulated Depreciation'),
('b87fae8a-db3f-4596-be19-119223517a60', 'Cash In Bank - IDR', 'Current Assets'),
('bc82375d-48ed-4611-9475-d381d296d801', 'Other Receivable', 'Current Assets'),
('bdcdb1a0-556b-465b-8ab5-49bbc76d500f', 'Building & Land', 'Fixed Assets'),
('c2592b4d-e2ad-4aac-ad04-2d4faa28c7d1', 'Accrued Expenses', 'Liabilities'),
('c403ca3d-227d-4e8a-a4d2-ec47feb6949c', 'Other Payables', 'Liabilities'),
('c4a0b5bf-bdaa-46e3-85eb-1255d8de16f4', 'Tax Payable', 'Liabilities'),
('c9b99d66-8ab2-48ae-bcf8-06091ec5081c', 'EQUITY', 'Long-term Liabilities'),
('d715753e-2e4f-482c-84f3-0a6256b6be38', 'Vehicles', 'Fixed Assets'),
('dd6b86b1-f3ca-4d6b-91c7-d3035d692492', 'Non-Trade Receivable', 'Current Assets'),
('eab3d882-852c-427d-941c-d0897aab46fd', 'Deposit', 'Deposit'),
('f8b6f2c2-b769-43e4-8fd4-565b7c396b87', 'Accumulated Depreciation - Building & Land', 'Accumulated Depreciation'),
('f9959b83-d1a1-4501-8747-fd5788a3818a', 'Account Payables', 'Liabilities');

-- --------------------------------------------------------

--
-- Struktur dari tabel `jurnal`
--

CREATE TABLE `jurnal` (
  `uuid` char(38) NOT NULL,
  `timestamp` bigint(20) NOT NULL,
  `tanggal` date NOT NULL,
  `tahun` year(4) NOT NULL,
  `keterangan` varchar(1000) NOT NULL,
  `nilai` bigint(20) NOT NULL,
  `akun_debet` char(38) NOT NULL,
  `akun_kredit` char(38) NOT NULL,
  `bukti_transaksi` char(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `jurnal`
--

INSERT INTO `jurnal` (`uuid`, `timestamp`, `tanggal`, `tahun`, `keterangan`, `nilai`, `akun_debet`, `akun_kredit`, `bukti_transaksi`) VALUES
('55f50233-6842-4853-881b-a7bfb48cf4f7', 1674203249618, '2023-01-10', 2023, 'Tes tanggal saja', 50000, '8730f869-1614-4d72-a9ff-6c1910fff54e', '0498d286-b362-4b94-911d-cc0a7a0570ec', '[\"texture sonpoltek.png\",\"texturesdvx.png\"]'),
('757ef97e-dbd6-4b2a-b287-55398df86349', 1674466284323, '2023-01-17', 2023, 'why', 5000, '8c4bc0fe-43cb-47f9-808e-a8bce278ba94', '0498d286-b362-4b94-911d-cc0a7a0570ec', '[]'),
('dab5104a-3e9b-4073-a8c2-3e49aeecb5b4', 1674207233907, '2023-05-24', 2023, 'ljiyf', 300000, '3e5fc1ef-a130-4987-9f20-22f942381753', '0498d286-b362-4b94-911d-cc0a7a0570ec', '[]'),
('e5c7ed95-2f65-4e4c-af13-20c78fa2b0f8', 1674206891971, '2023-02-24', 2023, 'Wahahaha', 500000, '3e5fc1ef-a130-4987-9f20-22f942381753', '3ae67a7d-5bcf-4ca9-bd4e-46d0e6c49a70', '[\"[Judas] Gintama - S01E25 (025).mkv_snapshot_15.45.247.jpg\",\"4f225cb7e63c5d9bb22806922c4dbba8.jpg\"]');

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
  `tahun` year(4) NOT NULL,
  `nama_file` char(255) NOT NULL,
  `judul_file` char(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `rka_tahunan`
--

INSERT INTO `rka_tahunan` (`uuid`, `timestamp`, `tahun`, `nama_file`, `judul_file`) VALUES
('b2b77e1b-2ac6-45e9-b20d-3f6d37fa7238', 1673964013323, 0000, 'mama.pdf', 'Apatadi itu');

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
  ADD PRIMARY KEY (`uuid`);

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
