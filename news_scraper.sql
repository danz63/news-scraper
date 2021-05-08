-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: May 09, 2021 at 03:21 AM
-- Server version: 10.3.27-MariaDB-0+deb10u1
-- PHP Version: 7.4.15

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
-- Table structure for table `ekstraktor`
--

CREATE TABLE `ekstraktor` (
  `id` int(11) NOT NULL,
  `nama` varchar(64) NOT NULL,
  `lokasi` varchar(64) NOT NULL,
  `info` text NOT NULL,
  `situs_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ekstraktor`
--

INSERT INTO `ekstraktor` (`id`, `nama`, `lokasi`, `info`, `situs_id`) VALUES
(7, 'Kompas_list.js', 'upload/Kompas_list.js', 'ekstrak link dari situs kompas', 5),
(8, 'Kompas_konten.js', 'upload/Kompas_konten.js', 'ekstrak konten berita dari situs kompas', 5),
(9, 'Bisnis_link.js', 'upload/Bisnis_link.js', 'ekstrak link dari situs bisnis', 6),
(10, 'Bisnis_konten.js', 'upload/Bisnis_konten.js', 'ekstrak konten dari situs bisnis', 6),
(11, 'Okezone_link.js', 'upload/Okezone_link.js', 'ekstrak link dari situs okezone', 7),
(12, 'Okezone_konten.js', 'upload/Okezone_konten.js', 'ekstrak konten dari situs okezone', 7),
(13, 'Pikiran_rakyat_link.js', 'upload/Pikiran_rakyat_link.js', 'ekstrak link dari situs pikiran rakyat', 8),
(14, 'Pikiran_rakyat_konten.js', 'upload/Pikiran_rakyat_konten.js', 'ekstrak konten dari situs pikiran rakyat\r\n', 8);

-- --------------------------------------------------------

--
-- Table structure for table `isi_berita`
--

CREATE TABLE `isi_berita` (
  `id` int(11) NOT NULL,
  `judul` text NOT NULL,
  `waktu_publikasi` varchar(64) NOT NULL,
  `img` varchar(256) NOT NULL,
  `isi` text NOT NULL,
  `situs_id` int(11) NOT NULL,
  `url` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `log`
--

CREATE TABLE `log` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `situs_id` int(11) NOT NULL,
  `waktu` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `situs`
--

CREATE TABLE `situs` (
  `id` int(11) NOT NULL,
  `nama_situs` varchar(15) NOT NULL,
  `url` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `situs`
--

INSERT INTO `situs` (`id`, `nama_situs`, `url`) VALUES
(5, 'Kompas', 'https://money.kompas.com/'),
(6, 'Bisnis', 'https://ekonomi.bisnis.com/'),
(7, 'Okezone', 'https://economy.okezone.com/'),
(8, 'Pikiran Rakyat', 'https://www.pikiran-rakyat.com/ekonomi/');

-- --------------------------------------------------------

--
-- Table structure for table `user`
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
-- Indexes for table `ekstraktor`
--
ALTER TABLE `ekstraktor`
  ADD PRIMARY KEY (`id`),
  ADD KEY `situs_id` (`situs_id`);

--
-- Indexes for table `isi_berita`
--
ALTER TABLE `isi_berita`
  ADD PRIMARY KEY (`id`),
  ADD KEY `situs_id` (`situs_id`);

--
-- Indexes for table `log`
--
ALTER TABLE `log`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `situs`
--
ALTER TABLE `situs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ekstraktor`
--
ALTER TABLE `ekstraktor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `isi_berita`
--
ALTER TABLE `isi_berita`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `log`
--
ALTER TABLE `log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `situs`
--
ALTER TABLE `situs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `ekstraktor`
--
ALTER TABLE `ekstraktor`
  ADD CONSTRAINT `ekstraktor_ibfk_1` FOREIGN KEY (`situs_id`) REFERENCES `situs` (`id`);

--
-- Constraints for table `isi_berita`
--
ALTER TABLE `isi_berita`
  ADD CONSTRAINT `isi_berita_ibfk_1` FOREIGN KEY (`situs_id`) REFERENCES `situs` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
