-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Mar 20, 2020 at 11:19 AM
-- Server version: 10.1.36-MariaDB
-- PHP Version: 5.6.38

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `test`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`` PROCEDURE `AddGeometryColumn` (`catalog` VARCHAR(64), `t_schema` VARCHAR(64), `t_name` VARCHAR(64), `geometry_column` VARCHAR(64), `t_srid` INT)  begin
  set @qwe= concat('ALTER TABLE ', t_schema, '.', t_name, ' ADD ', geometry_column,' GEOMETRY REF_SYSTEM_ID=', t_srid); PREPARE ls from @qwe; execute ls; deallocate prepare ls; end$$

CREATE DEFINER=`` PROCEDURE `DropGeometryColumn` (`catalog` VARCHAR(64), `t_schema` VARCHAR(64), `t_name` VARCHAR(64), `geometry_column` VARCHAR(64))  begin
  set @qwe= concat('ALTER TABLE ', t_schema, '.', t_name, ' DROP ', geometry_column); PREPARE ls from @qwe; execute ls; deallocate prepare ls; end$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `barang`
--

CREATE TABLE `barang` (
  `id` int(11) NOT NULL,
  `kode` varchar(50) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `harga` int(11) NOT NULL,
  `stok` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `barang`
--

INSERT INTO `barang` (`id`, `kode`, `nama`, `harga`, `stok`) VALUES
(1, 'MBA132017', 'Macbook Air 13\" (2017)', 12149000, 44),
(2, 'MBA132019', 'Macbook Air 13\" (2019)', 17199000, 46),
(3, 'MBP132019', 'Macbook Pro 13\" (2019)', 27999000, 20),
(4, 'MBP162020', 'Macbook Pro 16\" (2020)', 42299000, 10),
(5, 'IMC212019', 'iMac 21\" (2019)', 20799000, 25),
(6, 'IMC272019', 'iMac 27\" (2019)', 31199000, 10);

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE `groups` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `description` text NOT NULL,
  `special_privilege` tinyint(4) NOT NULL DEFAULT '0',
  `dashboard_access` tinyint(1) NOT NULL DEFAULT '0',
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`id`, `name`, `description`, `special_privilege`, `dashboard_access`, `created_date`, `updated_date`) VALUES
(1, 'Super Administrator', 'Group for Super Administrator', 1, 0, '2018-12-05 07:18:47', '0000-00-00 00:00:00'),
(2, 'Administrator', 'Group for Administrator', 0, 0, '2018-12-05 07:18:47', '2018-12-12 18:05:00'),
(5, 'Regular User', 'Group for Regular User', 0, 0, '2018-12-05 07:20:37', '0000-00-00 00:00:00'),
(7, 'Geng Kapak', 'Jangan coba-coba', 1, 1, '2018-12-12 17:51:13', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `groups_acl`
--

CREATE TABLE `groups_acl` (
  `id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `create_` tinyint(1) NOT NULL,
  `read_` tinyint(1) NOT NULL,
  `update_` tinyint(1) NOT NULL,
  `delete_` tinyint(1) NOT NULL,
  `report_` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `groups_acl`
--

INSERT INTO `groups_acl` (`id`, `group_id`, `menu_id`, `created_date`, `create_`, `read_`, `update_`, `delete_`, `report_`) VALUES
(3, 1, 2, '2018-12-09 17:31:06', 0, 1, 0, 0, 0),
(4, 3, 1, '2018-12-20 07:10:53', 0, 0, 1, 0, 0),
(5, 4, 1, '2018-12-20 07:10:53', 0, 0, 0, 1, 0),
(6, 1, 5, '2018-12-20 07:12:41', 0, 0, 0, 0, 0),
(7, 1, 1, '2018-12-21 08:37:40', 1, 1, 1, 0, 0),
(8, 4, 3, '2018-12-21 09:03:41', 0, 0, 0, 0, 0),
(9, 1, 7, '2018-12-21 09:40:22', 1, 1, 1, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `keys`
--

CREATE TABLE `keys` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `app_key` varchar(64) NOT NULL,
  `level` int(2) NOT NULL,
  `ignore_limits` tinyint(1) NOT NULL DEFAULT '0',
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `keys`
--

INSERT INTO `keys` (`id`, `username`, `app_key`, `level`, `ignore_limits`, `date_created`) VALUES
(0, 'johndoe', 'hL8pPuoGugJGONQhkjsjyXwmQ4il9msS4n/qY1kLIeE=', 0, 0, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE `menu` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` text,
  `class_name` varchar(20) NOT NULL,
  `method_name` varchar(20) DEFAULT NULL,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`id`, `name`, `description`, `class_name`, `method_name`, `created_date`, `updated_date`) VALUES
(1, 'Master Menu', 'Menu to manage Master Menu', 'menu', '', '2018-12-09 17:26:40', '2018-12-11 03:53:19'),
(3, 'Master User', 'Menu Master User (using fake class name)', 'master_user', '', '2018-12-11 09:32:38', '0000-00-00 00:00:00'),
(4, 'Master Group', 'Managing Group of Users', 'group', '', '2018-12-14 07:20:43', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `perusahaan`
--

CREATE TABLE `perusahaan` (
  `id` int(11) NOT NULL,
  `kode` varchar(50) NOT NULL,
  `nama` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `perusahaan`
--

INSERT INTO `perusahaan` (`id`, `kode`, `nama`) VALUES
(1, 'PT001MMB', 'PT. Maju Makmur Bersama'),
(2, 'PT002AR', 'PT. Angin Ribut'),
(3, 'PT003US', 'PT. Untung Sejahtera'),
(4, 'PT004KC', 'PT. Kreasi Cipta'),
(5, 'PT005AMM', 'PT. Abdi Masyarakat Mandiri');

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `id` int(11) NOT NULL,
  `kode_transaksi` varchar(50) NOT NULL,
  `tx_date` datetime NOT NULL,
  `id_perusahaan` varchar(50) NOT NULL,
  `id_barang` varchar(50) NOT NULL,
  `qty` int(5) NOT NULL,
  `grand_total` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`id`, `kode_transaksi`, `tx_date`, `id_perusahaan`, `id_barang`, `qty`, `grand_total`) VALUES
(2, 'TX20032020170627', '2020-03-20 17:06:27', '2', '2', 4, 68796000),
(3, 'TX20032020170814', '2020-03-20 17:08:14', '1', '1', 6, 72894000);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `name`, `email`) VALUES
(37, 'Bambang', 'bambang@gmail.com'),
(38, 'Dito Khoirul Huda', 'ditokh@gmail.com'),
(43, 'Hani', 'hani@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(6) NOT NULL,
  `username` varchar(30) DEFAULT NULL,
  `name` varchar(40) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `password` varchar(60) DEFAULT NULL,
  `phone` varchar(30) DEFAULT NULL,
  `address` varchar(100) DEFAULT NULL,
  `status` tinyint(4) NOT NULL,
  `birth` date DEFAULT NULL,
  `profile_picture` varchar(100) DEFAULT NULL,
  `utype` int(5) DEFAULT NULL,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `name`, `email`, `password`, `phone`, `address`, `status`, `birth`, `profile_picture`, `utype`, `created_date`, `updated_date`) VALUES
(37, 'superadmin', 'Super Admin', 'admin@mail.com', 'a/F/w9VLWK2TjR2secXh6dpeHazmjlqkjd6UpkLTPD8=', NULL, NULL, 0, NULL, NULL, NULL, '2018-12-12 18:16:23', '2019-02-03 16:47:53'),
(50, 'johndoe', 'John Doe', 'johndoe@mail.com', 'a/F/w9VLWK2TjR2secXh6dpeHazmjlqkjd6UpkLTPD8=', '081234567890', NULL, 1, NULL, NULL, 90, '2020-03-10 16:17:39', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `users_group`
--

CREATE TABLE `users_group` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL,
  `created_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users_group`
--

INSERT INTO `users_group` (`id`, `user_id`, `group_id`, `created_date`) VALUES
(27, 37, 1, '2018-12-23 14:30:00');

-- --------------------------------------------------------

--
-- Table structure for table `users_type`
--

CREATE TABLE `users_type` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `code` int(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users_type`
--

INSERT INTO `users_type` (`id`, `name`, `code`) VALUES
(1, 'Super Administrator', 1),
(2, 'Administrator', 2),
(3, 'Director', 3),
(4, 'Regular User', 90);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `groups_acl`
--
ALTER TABLE `groups_acl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `keys`
--
ALTER TABLE `keys`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `perusahaan`
--
ALTER TABLE `perusahaan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `users_group`
--
ALTER TABLE `users_group`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users_type`
--
ALTER TABLE `users_type`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `barang`
--
ALTER TABLE `barang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `groups`
--
ALTER TABLE `groups`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `groups_acl`
--
ALTER TABLE `groups_acl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `perusahaan`
--
ALTER TABLE `perusahaan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `users_group`
--
ALTER TABLE `users_group`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `users_type`
--
ALTER TABLE `users_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
