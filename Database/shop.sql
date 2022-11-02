-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th10 15, 2022 lúc 03:41 PM
-- Phiên bản máy phục vụ: 10.4.22-MariaDB
-- Phiên bản PHP: 7.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `shop`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `cart`
--

CREATE TABLE `cart` (
  `p_id` int(11) NOT NULL,
  `p_name` text NOT NULL,
  `unit` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `details`
--

CREATE TABLE `details` (
  `p_id` int(11) NOT NULL,
  `o_id` int(11) NOT NULL,
  `amount` int(11) NOT NULL,
  `price` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `factory`
--

CREATE TABLE `factory` (
  `f_id` int(11) NOT NULL,
  `f_name` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `factory`
--

INSERT INTO `factory` (`f_id`, `f_name`) VALUES
(1, 'cong ty kitt'),
(2, 'cong ty switchh');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `order`
--

CREATE TABLE `order` (
  `o_id` int(11) NOT NULL,
  `fee` int(11) NOT NULL,
  `u_id` int(11) NOT NULL,
  `o_phone` text NOT NULL,
  `o_name` text NOT NULL,
  `adress` text NOT NULL,
  `s_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `product`
--

CREATE TABLE `product` (
  `p_id` int(11) NOT NULL,
  `p_name` text NOT NULL,
  `type` int(11) NOT NULL,
  `pics` text NOT NULL,
  `spec` text NOT NULL,
  `price` text NOT NULL,
  `remain` text NOT NULL,
  `f_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `product`
--

INSERT INTO `product` (`p_id`, `p_name`, `type`, `pics`, `spec`, `price`, `remain`, `f_id`) VALUES
(1, 'San pham 1', 1, '', 'Day la san pham 1', '100000', '50', 1),
(2, 'San pham 2', 2, '', 'Day la san pham 2', '490000', '3', 2),
(3, 'San pham 3', 1, '', 'Day la san pham 3', '50000', '80', 2),
(4, 'San Pham 4', 1, '', '', '300000', '1', 1),
(5, 'San Pham 5', 1, '', 'San Pham 4', '40000', '2', 1),
(6, 'San Pham 6', 1, '', 'San Pham 6', '', '5', 1),
(7, 'San Pham 7', 1, '', 'San Pham 7', '50876', '5', 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `sale`
--

CREATE TABLE `sale` (
  `s_id` int(11) NOT NULL,
  `voucher` text NOT NULL,
  `discount` int(11) NOT NULL,
  `max` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `user`
--

CREATE TABLE `user` (
  `u_id` int(11) NOT NULL,
  `phone` text NOT NULL,
  `pass` text NOT NULL,
  `f_name` text NOT NULL,
  `l_name` text NOT NULL,
  `city` text NOT NULL,
  `district` text NOT NULL,
  `ward` text NOT NULL,
  `street` text NOT NULL,
  `no` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `user`
--

INSERT INTO `user` (`u_id`, `phone`, `pass`, `f_name`, `l_name`, `city`, `district`, `ward`, `street`, `no`) VALUES
(1, '123456', '123', '', '', '', '', '', '', ''),
(2, '123', '123', '', '', '', '', '', '', ''),
(3, '5123', '123', 'Hello', 'Everyone', 'city', 'district', 'ward', 'street', 'no'),
(4, '0384242610', '123', 'vu', 'van chuc', 'NAM DINH', 'asd', 'asd', 'gaws', 'as123');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`p_id`);

--
-- Chỉ mục cho bảng `factory`
--
ALTER TABLE `factory`
  ADD PRIMARY KEY (`f_id`);

--
-- Chỉ mục cho bảng `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`o_id`);

--
-- Chỉ mục cho bảng `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`p_id`);

--
-- Chỉ mục cho bảng `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`u_id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `cart`
--
ALTER TABLE `cart`
  MODIFY `p_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `factory`
--
ALTER TABLE `factory`
  MODIFY `f_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `order`
--
ALTER TABLE `order`
  MODIFY `o_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `product`
--
ALTER TABLE `product`
  MODIFY `p_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT cho bảng `user`
--
ALTER TABLE `user`
  MODIFY `u_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
