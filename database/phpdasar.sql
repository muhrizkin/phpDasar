-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 12, 2020 at 02:24 PM
-- Server version: 10.4.10-MariaDB
-- PHP Version: 7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `phpdasar`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `gambar` varchar(255) NOT NULL,
  `barang` varchar(255) NOT NULL,
  `harga` int(11) NOT NULL,
  `stok` int(11) NOT NULL,
  `username` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id`, `gambar`, `barang`, `harga`, `stok`, `username`) VALUES
(9, '5e8dcd1ee2d13.png', 'Me', 1000, 10, '1'),
(10, '5e8dcd1ee2d13.png', 'Me', 1000, 10, 'user'),
(11, '5e8dcd1ee2d13.png', 'Me', 1000, 10, '1'),
(12, '5e8dcd1ee2d13.png', 'Me', 1000, 10, '1');

-- --------------------------------------------------------

--
-- Table structure for table `datasiswa`
--

CREATE TABLE `datasiswa` (
  `id` int(11) NOT NULL,
  `nis` char(9) NOT NULL,
  `nama` varchar(250) NOT NULL,
  `email` varchar(250) NOT NULL,
  `jurusan` varchar(64) NOT NULL,
  `gambar` varchar(64) NOT NULL,
  `username` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `datasiswa`
--

INSERT INTO `datasiswa` (`id`, `nis`, `nama`, `email`, `jurusan`, `gambar`, `username`) VALUES
(26, '17006912', 'Muh Rizki Nurlahid', 'greenrizky354@gmail.com', 'RPL', '5e8b17800f011.png', 'user'),
(32, '1', 'namaa', '1', '1', '5e8dc3d7c9dbd.png', '1');

-- --------------------------------------------------------

--
-- Table structure for table `pesan`
--

CREATE TABLE `pesan` (
  `id` int(11) NOT NULL,
  `dari` varchar(255) NOT NULL,
  `kepada` varchar(255) NOT NULL,
  `pesan` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pesan`
--

INSERT INTO `pesan` (`id`, `dari`, `kepada`, `pesan`) VALUES
(5, 'user', 'user2', 'asdas'),
(6, 'user2', 'user', 'hai rizkii'),
(7, 'user2', 'user', 'asdasdsaasdas asd as'),
(10, 'admin', 'user', 'asdsa'),
(11, 'admin', 'user', 'asdas'),
(12, 'admin', 'user2', 'bc'),
(13, 'admin', 'user', 'asdads'),
(14, 'admin', 'toall', 'asda'),
(15, 'admin', 'toall', 'ini dari admin, broadcasts message'),
(16, 'admin2', 'toall', 'dari admin2, fufu'),
(17, 'user', 'user3', 'asddas'),
(18, 'user', 'user3', 'haii'),
(19, 'user', 'user3', '111'),
(20, 'user', 'user3', 'asdasd'),
(21, 'user', 'user3', 'asdasdasdsa'),
(22, 'user3', 'user', 'asdsadas'),
(23, 'user', 'user3', '213vsad'),
(24, 'user', 'user3', '23123'),
(25, 'user', 'user3', 'eee'),
(26, 'user', 'user3', 'hehehehe'),
(27, 'admin', '1', 'haii'),
(28, '1', 'user', 'qq');

-- --------------------------------------------------------

--
-- Table structure for table `produk`
--

CREATE TABLE `produk` (
  `id` int(11) NOT NULL,
  `gambar` varchar(255) NOT NULL,
  `barang` varchar(255) NOT NULL,
  `harga` int(11) NOT NULL,
  `stok` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `produk`
--

INSERT INTO `produk` (`id`, `gambar`, `barang`, `harga`, `stok`) VALUES
(3, '5e8dcd1ee2d13.png', 'Me', 1000, 10);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `level` char(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `level`) VALUES
(14, 'admin', '$2y$10$Ka6dmvezhgESWDtisQKFDe3KJwemfxBx8y2vQOkqvzulKThn4J8FG', '1'),
(25, 'user', '$2y$10$mJEnxVmY1AVNa86kT7FJc.Frb5XMjUWupsu9IzSdo..fhBm77sih.', '0'),
(28, 'admin2', '$2y$10$xtJh5IZuAIZGLiHRYf9tIOSM2XJW7K1CMmxHMW7X/2XxFK3bZykKm', '1'),
(32, '1', '$2y$10$BNIzoyy6Y1sB0tPtZMSxV.BHYnZ8VnXa8YQlSiH5tu97TUMI6gwFC', '0');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `datasiswa`
--
ALTER TABLE `datasiswa`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pesan`
--
ALTER TABLE `pesan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `produk`
--
ALTER TABLE `produk`
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
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `datasiswa`
--
ALTER TABLE `datasiswa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `pesan`
--
ALTER TABLE `pesan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `produk`
--
ALTER TABLE `produk`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
