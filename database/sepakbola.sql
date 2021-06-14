-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jun 14, 2021 at 02:44 AM
-- Server version: 10.1.19-MariaDB
-- PHP Version: 5.6.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sepakbola`
--

-- --------------------------------------------------------

--
-- Table structure for table `player`
--

CREATE TABLE `player` (
  `id` int(11) NOT NULL,
  `team_id` int(11) NOT NULL,
  `nama_pemain` varchar(100) NOT NULL,
  `tinggi_badan` int(11) NOT NULL,
  `berat_badan` int(11) NOT NULL,
  `posisi_pemain` enum('penyerang','gelandang','bertahan','penjaga_gawang') NOT NULL,
  `nomor_punggung` int(11) NOT NULL,
  `is_deleted` int(11) NOT NULL,
  `date_created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `player`
--

INSERT INTO `player` (`id`, `team_id`, `nama_pemain`, `tinggi_badan`, `berat_badan`, `posisi_pemain`, `nomor_punggung`, `is_deleted`, `date_created`) VALUES
(1, 1, 'Rizki Ramadhan', 180, 82, 'penyerang', 8, 0, '2021-06-13 00:00:00'),
(2, 1, 'Deshan Fathin', 160, 52, 'bertahan', 2, 0, '2021-06-13 00:00:00'),
(3, 1, 'Danesh Fathin', 110, 12, 'penjaga_gawang', 1, 0, '2021-06-13 20:14:25'),
(4, 1, 'Ramadhan', 176, 70, 'penyerang', 9, 0, '2021-06-13 20:15:32');

-- --------------------------------------------------------

--
-- Table structure for table `report`
--

CREATE TABLE `report` (
  `id` int(11) NOT NULL,
  `schedule_id` int(11) NOT NULL,
  `total_score` int(11) NOT NULL,
  `player_score` int(11) NOT NULL,
  `time_score` time NOT NULL,
  `is_deleted` int(11) NOT NULL,
  `date_created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `report`
--

INSERT INTO `report` (`id`, `schedule_id`, `total_score`, `player_score`, `time_score`, `is_deleted`, `date_created`) VALUES
(1, 1, 1, 1, '00:17:00', 0, '2021-06-13 00:00:00'),
(2, 1, 1, 1, '00:27:00', 0, '2021-06-13 00:00:00'),
(3, 1, 1, 3, '00:42:18', 0, '2021-06-14 06:42:32');

-- --------------------------------------------------------

--
-- Table structure for table `schedule`
--

CREATE TABLE `schedule` (
  `id` int(11) NOT NULL,
  `tanggal_pertandingan` date NOT NULL,
  `waktu_pertandingan` time NOT NULL,
  `tim_tuan_rumah` int(11) NOT NULL,
  `tim_tamu` int(11) NOT NULL,
  `is_deleted` int(11) NOT NULL,
  `date_created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `schedule`
--

INSERT INTO `schedule` (`id`, `tanggal_pertandingan`, `waktu_pertandingan`, `tim_tuan_rumah`, `tim_tamu`, `is_deleted`, `date_created`) VALUES
(1, '2021-06-13', '09:00:00', 1, 3, 0, '2021-06-13 00:00:00'),
(2, '2021-06-14', '09:00:00', 1, 3, 0, '2021-06-13 00:00:00'),
(4, '2021-06-13', '11:00:00', 1, 3, 1, '2021-06-13 23:28:56');

-- --------------------------------------------------------

--
-- Table structure for table `team`
--

CREATE TABLE `team` (
  `id` int(11) NOT NULL,
  `nama_tim` varchar(50) NOT NULL,
  `logo_tim` text NOT NULL,
  `tahun_berdiri` int(11) NOT NULL,
  `alamat_markas_tim` text NOT NULL,
  `kota_markas_tim` varchar(50) NOT NULL,
  `is_deleted` int(11) NOT NULL,
  `date_created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `team`
--

INSERT INTO `team` (`id`, `nama_tim`, `logo_tim`, `tahun_berdiri`, `alamat_markas_tim`, `kota_markas_tim`, `is_deleted`, `date_created`) VALUES
(1, 'Team A', 'https://localhost/admin-sepakbola/assets/img/logo/team-a.png', 2021, 'Tanjung Duren', 'Jakarta Barat', 0, '2021-06-13 00:00:00'),
(3, 'Team B', 'https://localhost/admin-sepakbola/assets/img/logo/team-b.png', 2021, 'Cililitan', 'Jakarta Timur', 0, '2021-06-13 19:32:55');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `player`
--
ALTER TABLE `player`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `report`
--
ALTER TABLE `report`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `schedule`
--
ALTER TABLE `schedule`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `team`
--
ALTER TABLE `team`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `player`
--
ALTER TABLE `player`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `report`
--
ALTER TABLE `report`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `schedule`
--
ALTER TABLE `schedule`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `team`
--
ALTER TABLE `team`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
