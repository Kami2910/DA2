-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th6 17, 2021 lúc 08:27 PM
-- Phiên bản máy phục vụ: 10.4.17-MariaDB
-- Phiên bản PHP: 7.4.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `quanliduan`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `binhluan`
--

CREATE TABLE `binhluan` (
  `BL_MaBinhLuan` int(11) NOT NULL,
  `BL_NoiDung` text NOT NULL,
  `BL_MaCongViec` varchar(50) NOT NULL,
  `BL_MaThanhVien` varchar(50) NOT NULL,
  `BL_MaDuAn` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `congviec`
--

CREATE TABLE `congviec` (
  `CV_MaCongViec` varchar(50) NOT NULL,
  `CV_TenCongViec` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `congviec`
--

INSERT INTO `congviec` (`CV_MaCongViec`, `CV_TenCongViec`) VALUES
('a1', 'Đặc tả '),
('a2', 'vẽ sơ đồ '),
('tk', 'Phân tích thiết kế');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `duan`
--

CREATE TABLE `duan` (
  `DA_MaDuAn` varchar(50) NOT NULL,
  `DA_TenDuAn` text NOT NULL,
  `DA_HanChotDA` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `duan`
--

INSERT INTO `duan` (`DA_MaDuAn`, `DA_TenDuAn`, `DA_HanChotDA`) VALUES
('DA1', 'Thiết kế trang web', '2021-06-30');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `phancong`
--

CREATE TABLE `phancong` (
  `STT` int(11) NOT NULL,
  `PC_MaDuAn` varchar(50) NOT NULL,
  `PC_MaTTCN` varchar(50) DEFAULT NULL,
  `PC_MaCongViec` varchar(50) DEFAULT NULL,
  `PC_TrangThai` varchar(50) NOT NULL,
  `PC_MaVaiTro` varchar(50) DEFAULT NULL,
  `PC_HanChot` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `phancong`
--

INSERT INTO `phancong` (`STT`, `PC_MaDuAn`, `PC_MaTTCN`, `PC_MaCongViec`, `PC_TrangThai`, `PC_MaVaiTro`, `PC_HanChot`) VALUES
(193, 'DA1', '1800777', NULL, 'Chua hoan tat', 'TN', '2021-06-30'),
(194, 'DA1', '1800555', 'tk', 'Chua hoan tat', 'TV', '2021-06-21'),
(195, 'DA1', '1800555', 'a1', '', 'TV', '2021-06-20'),
(196, 'DA1', '1800333', 'a2', '', 'PTN', '2021-06-20');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `taikhoan`
--

CREATE TABLE `taikhoan` (
  `TK_TenDN` varchar(50) NOT NULL,
  `TK_MatKhau` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `taikhoan`
--

INSERT INTO `taikhoan` (`TK_TenDN`, `TK_MatKhau`) VALUES
('cuong', '1111'),
('Gam', '111'),
('giang', '1111'),
('Ngocyen', '1213'),
('thanh', '112'),
('TRÚC', '888'),
('Vybeo', '12345');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `thanhvien`
--

CREATE TABLE `thanhvien` (
  `TV_MaThanhVien` varchar(50) NOT NULL,
  `TV_MaDuAn` varchar(50) NOT NULL,
  `TV_MaTTCN` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `thongtincanhan`
--

CREATE TABLE `thongtincanhan` (
  `TTCN_MaTTCN` varchar(50) CHARACTER SET utf8 NOT NULL,
  `TTCN__TenDN` varchar(50) CHARACTER SET utf8 NOT NULL,
  `TTCN__Email` varchar(50) CHARACTER SET utf8 NOT NULL,
  `TTCN__Sdt` int(10) NOT NULL,
  `TTCN__GioiTinh` bit(10) NOT NULL,
  `TTCN__MK` varchar(10) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `thongtincanhan`
--

INSERT INTO `thongtincanhan` (`TTCN_MaTTCN`, `TTCN__TenDN`, `TTCN__Email`, `TTCN__Sdt`, `TTCN__GioiTinh`, `TTCN__MK`) VALUES
('1800333', 'cuong', 'cuong123@gmail.com', 121213, b'1111111111', '1111'),
('1800555', 'Gam', 'gam@123gmail.com', 121212, b'0000000000', '111'),
('1800777', 'Ngocyen', 'nlyen18077@gmail.com.vn', 768854527, b'0000000000', '1213'),
('1800996', 'thanh', 'maithanh@gmail.com', 55545556, b'0000000000', '112'),
('1800999', 'giang', 'giang123@gmail.com', 1236555, b'1111111111', '1111');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `vaitro`
--

CREATE TABLE `vaitro` (
  `VT_MaVaiTro` varchar(50) NOT NULL,
  `VT_TenVaiTro` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `vaitro`
--

INSERT INTO `vaitro` (`VT_MaVaiTro`, `VT_TenVaiTro`) VALUES
('PTN', 'Pho Truong Nhom'),
('TN', 'Truong nhom'),
('TV', 'Thanh Vien');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `binhluan`
--
ALTER TABLE `binhluan`
  ADD PRIMARY KEY (`BL_MaBinhLuan`),
  ADD KEY `MaCongViec` (`BL_MaCongViec`),
  ADD KEY `binhluan_ibfk_3` (`BL_MaDuAn`),
  ADD KEY `binhluan_ibfk_2` (`BL_MaThanhVien`);

--
-- Chỉ mục cho bảng `congviec`
--
ALTER TABLE `congviec`
  ADD PRIMARY KEY (`CV_MaCongViec`);

--
-- Chỉ mục cho bảng `duan`
--
ALTER TABLE `duan`
  ADD PRIMARY KEY (`DA_MaDuAn`);

--
-- Chỉ mục cho bảng `phancong`
--
ALTER TABLE `phancong`
  ADD PRIMARY KEY (`STT`),
  ADD KEY `phancong_ibfk_2` (`PC_MaDuAn`),
  ADD KEY `phancong_ibfk_4` (`PC_MaVaiTro`),
  ADD KEY `phancong_ibfk_3` (`PC_MaCongViec`),
  ADD KEY `phancong_ibfk_1` (`PC_MaTTCN`);

--
-- Chỉ mục cho bảng `taikhoan`
--
ALTER TABLE `taikhoan`
  ADD PRIMARY KEY (`TK_TenDN`);

--
-- Chỉ mục cho bảng `thanhvien`
--
ALTER TABLE `thanhvien`
  ADD PRIMARY KEY (`TV_MaThanhVien`),
  ADD KEY `TV_MaDuAn` (`TV_MaDuAn`),
  ADD KEY `TV_MaTTCN` (`TV_MaTTCN`);

--
-- Chỉ mục cho bảng `thongtincanhan`
--
ALTER TABLE `thongtincanhan`
  ADD PRIMARY KEY (`TTCN_MaTTCN`),
  ADD KEY `TTCN__TenDN` (`TTCN__TenDN`);

--
-- Chỉ mục cho bảng `vaitro`
--
ALTER TABLE `vaitro`
  ADD PRIMARY KEY (`VT_MaVaiTro`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `binhluan`
--
ALTER TABLE `binhluan`
  MODIFY `BL_MaBinhLuan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT cho bảng `phancong`
--
ALTER TABLE `phancong`
  MODIFY `STT` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=197;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `binhluan`
--
ALTER TABLE `binhluan`
  ADD CONSTRAINT `binhluan_ibfk_1` FOREIGN KEY (`BL_MaCongViec`) REFERENCES `congviec` (`CV_MaCongViec`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `binhluan_ibfk_2` FOREIGN KEY (`BL_MaThanhVien`) REFERENCES `thongtincanhan` (`TTCN_MaTTCN`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `binhluan_ibfk_3` FOREIGN KEY (`BL_MaDuAn`) REFERENCES `duan` (`DA_MaDuAn`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Các ràng buộc cho bảng `phancong`
--
ALTER TABLE `phancong`
  ADD CONSTRAINT `phancong_ibfk_1` FOREIGN KEY (`PC_MaTTCN`) REFERENCES `thongtincanhan` (`TTCN_MaTTCN`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `phancong_ibfk_2` FOREIGN KEY (`PC_MaDuAn`) REFERENCES `duan` (`DA_MaDuAn`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `phancong_ibfk_3` FOREIGN KEY (`PC_MaCongViec`) REFERENCES `congviec` (`CV_MaCongViec`) ON DELETE SET NULL ON UPDATE SET NULL,
  ADD CONSTRAINT `phancong_ibfk_4` FOREIGN KEY (`PC_MaVaiTro`) REFERENCES `vaitro` (`VT_MaVaiTro`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Các ràng buộc cho bảng `thanhvien`
--
ALTER TABLE `thanhvien`
  ADD CONSTRAINT `thanhvien_ibfk_1` FOREIGN KEY (`TV_MaTTCN`) REFERENCES `thongtincanhan` (`TTCN_MaTTCN`);

--
-- Các ràng buộc cho bảng `thongtincanhan`
--
ALTER TABLE `thongtincanhan`
  ADD CONSTRAINT `thongtincanhan_ibfk_1` FOREIGN KEY (`TTCN__TenDN`) REFERENCES `taikhoan` (`TK_TenDN`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
