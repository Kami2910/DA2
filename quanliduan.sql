-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Apr 18, 2021 at 03:13 AM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 7.3.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `quanliduan`
--

-- --------------------------------------------------------

--
-- Table structure for table `binhluan`
--

CREATE TABLE `binhluan` (
  `BL_MaBinhLuan` int(11) NOT NULL,
  `BL_NoiDung` text NOT NULL,
  `BL_MaCongViec` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `congviec`
--

CREATE TABLE `congviec` (
  `CV_MaCongViec` varchar(50) NOT NULL,
  `CV_TenCongViec` text NOT NULL,
  `CV_HanChot` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `duan`
--

CREATE TABLE `duan` (
  `DA_MaDuAn` varchar(50) NOT NULL,
  `DA_TenDuAn` text NOT NULL,
  `DA_HanChotDA` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `phancong`
--

CREATE TABLE `phancong` (
  `PC_MaDuAn` varchar(50) NOT NULL,
  `PC_MaThanhVien` varchar(50) NOT NULL,
  `PC_MaCongViec` varchar(50) NOT NULL,
  `PC_TrangThai` text NOT NULL DEFAULT '\'Chuahoantat\'',
  `PC_MaVaiTro` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `taikhoan`
--

CREATE TABLE `taikhoan` (
  `TK_TenDN` varchar(50) NOT NULL,
  `TK_MatKhau` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `taikhoan`
--

INSERT INTO `taikhoan` (`TK_TenDN`, `TK_MatKhau`) VALUES
('Ngocyen', '1213');

-- --------------------------------------------------------

--
-- Table structure for table `thanhvien`
--

CREATE TABLE `thanhvien` (
  `TV_MaThanhVien` varchar(50) NOT NULL,
  `TV_TenThanhVien` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `thongtincanhan`
--

CREATE TABLE `thongtincanhan` (
  `TTCN_MaTTCN` varchar(50) NOT NULL,
  `TTCN__TenDN` varchar(50) NOT NULL,
  `TTCN__Email` varchar(150) NOT NULL,
  `TTCN__Sdt` int(15) NOT NULL,
  `TTCN__GioiTinh` bit(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `vaitro`
--

CREATE TABLE `vaitro` (
  `VT_MaVaiTro` varchar(50) NOT NULL,
  `VT_TenVaiTro` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `binhluan`
--
ALTER TABLE `binhluan`
  ADD PRIMARY KEY (`BL_MaBinhLuan`),
  ADD KEY `MaCongViec` (`BL_MaCongViec`);

--
-- Indexes for table `congviec`
--
ALTER TABLE `congviec`
  ADD PRIMARY KEY (`CV_MaCongViec`);

--
-- Indexes for table `duan`
--
ALTER TABLE `duan`
  ADD PRIMARY KEY (`DA_MaDuAn`);

--
-- Indexes for table `phancong`
--
ALTER TABLE `phancong`
  ADD PRIMARY KEY (`PC_MaDuAn`,`PC_MaThanhVien`,`PC_MaCongViec`),
  ADD KEY `MaVaiTro` (`PC_MaVaiTro`),
  ADD KEY `MaThanhVien` (`PC_MaThanhVien`),
  ADD KEY `MaCongViec` (`PC_MaCongViec`);

--
-- Indexes for table `taikhoan`
--
ALTER TABLE `taikhoan`
  ADD PRIMARY KEY (`TK_TenDN`);

--
-- Indexes for table `thanhvien`
--
ALTER TABLE `thanhvien`
  ADD PRIMARY KEY (`TV_MaThanhVien`);

--
-- Indexes for table `thongtincanhan`
--
ALTER TABLE `thongtincanhan`
  ADD PRIMARY KEY (`TTCN_MaTTCN`),
  ADD KEY `TTCN__TenDN` (`TTCN__TenDN`);

--
-- Indexes for table `vaitro`
--
ALTER TABLE `vaitro`
  ADD PRIMARY KEY (`VT_MaVaiTro`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `binhluan`
--
ALTER TABLE `binhluan`
  ADD CONSTRAINT `binhluan_ibfk_1` FOREIGN KEY (`BL_MaCongViec`) REFERENCES `congviec` (`CV_MaCongViec`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `phancong`
--
ALTER TABLE `phancong`
  ADD CONSTRAINT `phancong_ibfk_1` FOREIGN KEY (`PC_MaVaiTro`) REFERENCES `vaitro` (`VT_MaVaiTro`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `phancong_ibfk_2` FOREIGN KEY (`PC_MaThanhVien`) REFERENCES `thanhvien` (`TV_MaThanhVien`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `phancong_ibfk_3` FOREIGN KEY (`PC_MaCongViec`) REFERENCES `congviec` (`CV_MaCongViec`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `phancong_ibfk_4` FOREIGN KEY (`PC_MaDuAn`) REFERENCES `duan` (`DA_MaDuAn`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `thongtincanhan`
--
ALTER TABLE `thongtincanhan`
  ADD CONSTRAINT `thongtincanhan_ibfk_1` FOREIGN KEY (`TTCN__TenDN`) REFERENCES `taikhoan` (`TK_TenDN`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
