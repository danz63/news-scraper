-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Waktu pembuatan: 27 Mar 2021 pada 08.16
-- Versi server: 10.3.27-MariaDB-0+deb10u1
-- Versi PHP: 7.4.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `news_scraper`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `ekstraktor`
--

CREATE TABLE `ekstraktor` (
  `id` int(11) NOT NULL,
  `nama` varchar(64) NOT NULL,
  `lokasi` varchar(64) NOT NULL,
  `info` text NOT NULL,
  `situs_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `ekstraktor`
--

INSERT INTO `ekstraktor` (`id`, `nama`, `lokasi`, `info`, `situs_id`) VALUES
(1, 'percobaan.js', 'upload/percobaan.js', 'hanya sedikit percobaan', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `isi_berita`
--

CREATE TABLE `isi_berita` (
  `id` int(11) NOT NULL,
  `judul` text NOT NULL,
  `waktu_publikasi` varchar(64) NOT NULL,
  `situs_id` int(11) NOT NULL,
  `url` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `log`
--

CREATE TABLE `log` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `situs_id` int(11) NOT NULL,
  `waktu` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `situs`
--

CREATE TABLE `situs` (
  `id` int(11) NOT NULL,
  `nama_situs` varchar(15) NOT NULL,
  `url` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(32) NOT NULL,
  `password` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `ekstraktor`
--
ALTER TABLE `ekstraktor`
  ADD PRIMARY KEY (`id`),
  ADD KEY `situs_id` (`situs_id`);

--
-- Indeks untuk tabel `isi_berita`
--
ALTER TABLE `isi_berita`
  ADD PRIMARY KEY (`id`),
  ADD KEY `situs_id` (`situs_id`);

--
-- Indeks untuk tabel `log`
--
ALTER TABLE `log`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `situs`
--
ALTER TABLE `situs`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `ekstraktor`
--
ALTER TABLE `ekstraktor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `isi_berita`
--
ALTER TABLE `isi_berita`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `log`
--
ALTER TABLE `log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `situs`
--
ALTER TABLE `situs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `ekstraktor`
--
ALTER TABLE `ekstraktor`
  ADD CONSTRAINT `ekstraktor_ibfk_1` FOREIGN KEY (`situs_id`) REFERENCES `situs` (`id`);

--
-- Ketidakleluasaan untuk tabel `isi_berita`
--
ALTER TABLE `isi_berita`
  ADD CONSTRAINT `isi_berita_ibfk_1` FOREIGN KEY (`situs_id`) REFERENCES `situs` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
