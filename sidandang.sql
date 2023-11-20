-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Waktu pembuatan: 04 Okt 2023 pada 08.01
-- Versi server: 10.9.3-MariaDB-log
-- Versi PHP: 7.3.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sidandang`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengaduan`
--

CREATE TABLE `pengaduan` (
  `id` varchar(6) NOT NULL,
  `n_pelapor` varchar(30) NOT NULL,
  `tlp_pelapor` varchar(30) NOT NULL,
  `j_pelapor` varchar(30) NOT NULL,
  `d_pelapor` varchar(30) NOT NULL,
  `n_barang` varchar(30) NOT NULL,
  `ket` varchar(100) NOT NULL,
  `status` text NOT NULL,
  `ket_petugas` varchar(100) NOT NULL,
  `tgl_lapor` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `pengaduan`
--

INSERT INTO `pengaduan` (`id`, `n_pelapor`, `tlp_pelapor`, `j_pelapor`, `d_pelapor`, `n_barang`, `ket`, `status`, `ket_petugas`, `tgl_lapor`) VALUES
('NP0001', 'dewan', '087565334', 'Staff IT', 'SIMRS', 'Software', 'Rusak', 'Selesai diproses', 'Ok', '2023-10-04 14:40:32'),
('NP0002', 'Dew', '089455355', 'Staff IT', 'SIMRS', 'Hardware', 'Mati', 'Selesai diproses', 'OK', '2023-10-04 15:00:38');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `user_id` varchar(16) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(255) NOT NULL,
  `name` varchar(30) NOT NULL,
  `img` varchar(255) NOT NULL,
  `status` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`user_id`, `username`, `password`, `name`, `img`, `status`) VALUES
('1', 'admin', '$2y$10$vx9rULGqEcbI1khsJ2su8eRHIhZlpmvQW5sPZu3jmk471MtfaNqrm', 'Admin', '168542703_datu.png', 1);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `pengaduan`
--
ALTER TABLE `pengaduan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
