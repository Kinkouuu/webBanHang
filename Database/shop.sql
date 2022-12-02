-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th10 30, 2022 lúc 06:23 PM
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
-- Cấu trúc bảng cho bảng `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` text NOT NULL,
  `name` text NOT NULL,
  `password` text NOT NULL,
  `role` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `admin`
--

INSERT INTO `admin` (`id`, `username`, `name`, `password`, `role`) VALUES
(3, 'Ezsupply', '', '13e363b88ac7a1b34cf8363defca3ab4', '');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `cart`
--

CREATE TABLE `cart` (
  `p_id` int(11) NOT NULL,
  `u_id` int(11) NOT NULL,
  `unit` int(11) DEFAULT 0,
  `book` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `details`
--

CREATE TABLE `details` (
  `p_id` int(11) NOT NULL,
  `o_id` int(11) NOT NULL,
  `amount` int(11) NOT NULL,
  `d_price` int(11) NOT NULL,
  `g_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `details`
--

INSERT INTO `details` (`p_id`, `o_id`, `amount`, `d_price`, `g_id`) VALUES
(5, 58, 80, 5800, 0),
(5, 59, 200, 5800, 0),
(5, 60, 30, 5800, 0),
(5, 61, 35, 5800, 0),
(5, 62, 567, 5800, 0),
(6, 63, 1000, 2200, 0),
(7, 63, 1000, 2650, 0),
(4, 64, 120, 6200, 0),
(4, 65, 70, 6200, 0),
(3, 66, 50, 17000, 0),
(8, 67, 1000, 2850, 0),
(8, 68, 2000, 2850, 0),
(4, 69, 40, 6200, 0),
(3, 70, 4, 17000, 0),
(4, 72, 70, 6200, 0),
(4, 73, 50, 6200, 0),
(4, 74, 50, 6200, 0),
(3, 75, 30, 17000, 0),
(3, 76, 20, 17000, 0),
(3, 77, 70, 17000, 0),
(3, 78, 200, 17000, 0),
(3, 79, 10, 17000, 0),
(3, 80, 34, 17000, 0),
(4, 81, 84, 6200, 0),
(3, 82, 23, 17000, 0),
(3, 83, 35, 17000, 0),
(3, 84, 90, 17000, 0),
(3, 85, 26, 17000, 0),
(4, 86, 80, 6200, 0),
(3, 87, 80, 17000, 0),
(4, 88, 100, 6200, 0),
(4, 89, 90, 6200, 0),
(3, 90, 90, 17000, 0),
(3, 91, 5, 17000, 0),
(4, 91, 10, 6200, 0),
(3, 92, 30, 17000, 0),
(4, 92, 300, 6200, 0),
(3, 93, 70, 17000, 0);

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
(1, 'KTT'),
(2, 'Gateron'),
(3, 'Invyr'),
(4, 'Sa Tế Lão Đại');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `gb`
--

CREATE TABLE `gb` (
  `g_id` int(11) NOT NULL,
  `g_name` text NOT NULL,
  `s_date` text NOT NULL,
  `e_date` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `gb_list`
--

CREATE TABLE `gb_list` (
  `g_id` int(11) NOT NULL,
  `p_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `money`
--

CREATE TABLE `money` (
  `m_id` int(11) NOT NULL,
  `cur` text NOT NULL,
  `sign` text NOT NULL,
  `ex` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `money`
--

INSERT INTO `money` (`m_id`, `cur`, `sign`, `ex`) VALUES
(1, 'Việt Nam Đồng', 'VND', 1),
(2, 'Dollar', '$', 25000);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `order`
--

CREATE TABLE `order` (
  `o_id` int(11) NOT NULL,
  `u_id` int(11) NOT NULL,
  `o_phone` text NOT NULL,
  `o_name` text NOT NULL,
  `adress` text NOT NULL,
  `s_id` int(11) DEFAULT NULL,
  `note` text NOT NULL,
  `suggest` text NOT NULL,
  `statuspay` text NOT NULL,
  `status` text NOT NULL,
  `deposit` int(11) NOT NULL DEFAULT 0,
  `o_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `order`
--

INSERT INTO `order` (`o_id`, `u_id`, `o_phone`, `o_name`, `adress`, `s_id`, `note`, `suggest`, `statuspay`, `status`, `deposit`, `o_date`) VALUES
(58, 5, '0964233808', 'Vũ Đức Phùng', 'PVI-no 1st Phạm Văn Bách,Yên Hòa, Cầu Giấy, Hà Nội', 0, '', '', 'COD', 'Đã giao hàng', 0, '2022-10-17 17:13:30'),
(59, 6, '0971259205', 'Phạm Hiệp', 'C10.10 KingDom 101 334,Tô Hiến Thành, Quận, Hồ Chí Minh', 0, '', '', 'COD', 'Đã giao hàng', 0, '2022-10-18 17:13:55'),
(60, 7, '0899498358', 'Nguyễn Minh', '62 Hoàng Hữu Nam,Long Thạch Mỹ, Quận 9, TP.HCM', 0, '', '', 'COD', 'Đã giao hàng', 0, '2022-10-27 17:14:03'),
(61, 8, '0826870876', 'Lê Name', '346 30/4,khu vực 5, Lái Hiếu, TP.Ngã 7', 0, '', '', 'COD', 'Đã giao hàng', 0, '2022-10-24 17:14:14'),
(62, 9, '0971119486', 'Hoàng Vương', 'hẻm 54 ngách 207/103 Xuân Đỉnh,Xuân Đỉnh, Bắc Từ Liêm, Hà Nội', 0, '', '', 'COD', 'Đã giao hàng', 0, '2022-10-29 17:14:23'),
(63, 10, '0982398912', 'Hà Hoàng', '391 Tran Hung Dao,Cau Kho, Quan 1, TP.HCM', 1, '', '', 'COD', 'Đã giao hàng', 0, '2022-10-31 17:14:33'),
(64, 11, '0392363717', 'Nguyen Doan Quang', '197/36 Thoại Ngọc Hầu,Phú Thạnh, Tân Phú, Ho Chi Minh', 0, '', '', 'COD', 'Đã giao hàng', 407000, '2022-11-30 17:16:15'),
(65, 12, '0583473012', 'Nguyễn Anh', 'Số 9 ngõ 177 Lai Xá,Kim Chung, Hoài Đức, Quận Bắc Từ Liêm', 0, '', '', 'COD', 'Đã giao hàng', 252000, '2022-11-30 17:16:30'),
(66, 13, '0328275396', 'Nguyen Nhat', 'FPTShop 282 Pham Van Thuan,Thong Nhat, Bien Hoa, Dong Nai', 0, '', '', 'COD', 'Đã giao hàng', 460000, '2022-11-30 17:16:51'),
(67, 14, '0967836352', 'Van Pham Cuong', 'Số 10 Ngách 38/17 Phương Mai,Kim Liên, Đống Đa, Hà Nội', 0, 'hi', '', 'Banking', 'Hàng ra khỏi nhà máy', 2850000, '2022-11-30 13:33:17'),
(68, 15, '0983155295', 'Hà Quyền', 'số nhà 23 ngách 136/51 Cầu Diễn,Minh Khai, Bắc Từ Liêm, Hà Nội', 0, '', '', 'Banking', 'Hàng ra khỏi nhà máy', 5700000, '2022-11-30 13:33:17'),
(69, 26, '0359178393', 'Hoàng Nguyễn Bùi Minh', '80/91/10/8 12,Bình Hưng Hòa, Bình Tân, Hồ Chí Minh', 0, '', '', 'COD', 'Hàng ra khỏi nhà máy', 102000, '2022-11-30 13:33:17'),
(70, 27, '0971325969', 'anh nguyễn', 'trung hoà nguyễn ngọc vũ,số 27 ngõ 125, cầu giầy, hà nội', 0, '', '', 'Banking', 'Hàng ra khỏi nhà máy', 70000, '2022-11-30 13:33:17'),
(72, 30, '0988660490', 'quan nguyen', '158/6 Huynh Man Dat,3, 5, HCMC', 0, '', '', 'Banking', 'Hàng ra khỏi nhà máy', 469000, '2022-11-30 13:33:17'),
(73, 31, '0353641708', 'Lê thành Công thương', 'Thới tam thôn Hóc môn,Thới tam thon, 13/8a trung đông, Tphcm', 0, '', '', 'Banking', 'Hàng ra khỏi nhà máy', 345000, '2022-11-30 13:33:17'),
(74, 32, '0384756509', 'hải đỗ', '60/74 ngõ thịnh hào 1 tôn đức thắng,tôn đức thắng, đống đa, hà nội', 0, '', '', 'COD', 'Hàng ra khỏi nhà máy', 200000, '2022-11-30 13:33:17'),
(75, 34, '0962647964', 'hải nguyễn', 'khu tập thể thủy điện huội quảng bản nhạp,xã chiềng lao, mường la, sơn la', 0, '', '', 'COD', 'Hàng ra khỏi nhà máy', 290000, '2022-11-30 13:33:17'),
(76, 24, '0352188885', 'Tran Quy Dat', 'so 12 ngo 14 phao dai lang,Lang Thuong, Dong Da, Ha Noi', 0, '', '', 'COD', 'Hàng ra khỏi nhà máy', 170000, '2022-11-30 13:33:17'),
(77, 35, '+84982095396', 'Nguyen Dat', '6/23/1197 Giai Phong Road Giai Phong Road,Thinh Liet, Hoang Mai, Hanoi', 0, '', '', 'COD', 'Hàng ra khỏi nhà máy', 595000, '2022-11-30 13:33:17'),
(78, 5, '0964233808', 'Vũ Đức Phùng', 'Số 110 ngõ 44 (Phòng 801) Trần Thái Tông,Dịch Vọng Hậu, Cầu Giấy, Hà Nội', 1, 'order rieng 200 con.', '', 'COD', 'Hàng ra khỏi nhà máy', 1500000, '2022-11-30 13:33:17'),
(79, 37, '0387244434', 'huỳnh quốc', '179 Huỳnh Tấn Phát,none, Hải Châu, Đà Nẵng', 0, '', '', 'Banking', 'Hàng ra khỏi nhà máy', 205000, '2022-11-30 13:33:17'),
(80, 29, '0969427259', 'Đào Duy Thái', 'Hh1A Hoàng mai,None, None, Hà Nội', 0, '', '', 'COD', 'Hàng ra khỏi nhà máy', 300000, '2022-11-30 13:33:17'),
(81, 42, '0816386999', 'Trần Tiến Thịnh', '85/68 Triều Khúc,Thanh Xuân Nam, Thanh Xuân, Hà Nội', 0, '', '', 'COD', 'Hàng ra khỏi nhà máy', 260000, '2022-11-30 13:33:17'),
(82, 38, '0967098422', 'Quang Huy', '33 ngách 75, ngõ 281, đường Trương Định,Phường Tương Mai, Quận Hoàng Mai, Hà Nội', 0, '', '', 'Banking', 'Hàng ra khỏi nhà máy', 426000, '2022-11-30 13:33:17'),
(83, 48, '0938442011', 'Nguyễn Hoàng Hiệp', 'Tòa nhà VSIP 8 Hữu Nghị, VSIP,Bình Hòa, Thuận An, Bình Dương', 0, '', '', 'COD', 'Hàng ra khỏi nhà máy', 332500, '2022-11-30 13:33:17'),
(84, 52, '0935477998', 'Khanh Nguyen', '11 Phan Ke Binh,Thuan Phuoc, Hai Chau, Da Nang', 0, '', '', 'COD', 'Đang chờ xác nhận', 0, '2022-11-30 13:33:17'),
(85, 54, '0812364949', 'Phúc Nguyễn', 'Lê hồng phong lê hồng phong , Q10,Hcm, Q10, Hcm', 0, '', '', 'Banking', 'Hàng ra khỏi nhà máy', 477000, '2022-11-30 13:33:17'),
(86, 6, '0941530177', 'Vũ Minh Quân', '58/21 Thành Chung,Cửa Bắc, Cửa Bắc, Nam Định', 0, '', '', 'Banking', 'Hàng ra khỏi nhà máy', 0, '2022-11-30 13:33:17'),
(87, 57, '0327577795', 'Nguyễn anh', 'Sô 1A Lê bình,Phường 4, Quận Tân Bình, Hồ Chí Minh', 0, '', '', 'Banking', 'Hàng ra khỏi nhà máy', 1395000, '2022-11-30 13:33:17'),
(88, 59, '0369121704', 'Nguyễn Tấn Huyền', 'Ấp thạnh hưng xã đồng thạnh huyện gò công tây tỉnh tiền giang thạnh hưng,đồng thạnh, gò công tây, tiền giang', 0, '', '', 'COD', 'Hàng ra khỏi nhà máy', 345000, '2022-11-30 13:33:17'),
(89, 60, '0888408488', 'Ngô Quốc Tuấn', '836/800 Ngô Gia Tự,Thành Tô, Hải An, Hải Phòng', 0, '', '', 'COD', 'Hàng ra khỏi nhà máy', 279000, '2022-11-30 13:33:17'),
(90, 60, '0888408488', 'Ngô Quốc Tuấn', '836/800 Ngô Gia Tự,Thành Tô, Hải An, Hải Phòng', 0, '', '', 'COD', 'Hàng ra khỏi nhà máy', 300000, '2022-11-30 13:33:17'),
(91, 61, '0326545748', 'Lam Le', '27/3A 36,Hiep Binh Chanh, Thu Duc, Ho Chi Minh', 0, '', '', 'Banking', 'Thông quan', 182000, '2022-11-30 13:33:17'),
(92, 4, '0901356539', 'Minh Hong', '40 Pham Ngoc Thach,Vo Thi Sau, 3, Ho Chi Minh', 0, '', '', 'Banking', 'Thông quan', 2008200, '2022-11-30 13:33:17'),
(93, 64, '0964308820', 'Trương Thị Kiều Oanh', 'none Đạo sử,Thị TRấn Thứa, Lương Tài, Bắc Ninh', 0, '', '', 'Banking', 'Thông quan', 1225000, '2022-11-30 13:33:17');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `product`
--

CREATE TABLE `product` (
  `p_id` int(11) NOT NULL,
  `p_name` text NOT NULL,
  `t_id` text NOT NULL,
  `product_code` text NOT NULL,
  `pics` text NOT NULL,
  `spec` text NOT NULL,
  `video` text NOT NULL,
  `m_id` int(11) NOT NULL,
  `price` float NOT NULL,
  `remain` text NOT NULL,
  `f_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `product`
--

INSERT INTO `product` (`p_id`, `p_name`, `t_id`, `product_code`, `pics`, `spec`, `video`, `m_id`, `price`, `remain`, `f_id`) VALUES
(2, 'Gateron Pro Milky Yellow', '4', 'gpmy', 'https://i.imgur.com/n7REMj5.jpg', '-Đây là biến thể housing màu sữa của dòng switch G-Pro của Gateron. \r\n- Khuôn thân mới để giảm sự lung lay của thân và mang lại trải nghiệm gõ phím mượt mà hơn.\r\n- Tương tự như G-Pro màu vàng thông thường, sự khác biệt duy nhất là vỏ trên cùng màu trắng sữa sẽ làm thay đổi âm thanh gõ.\r\n-  Khuôn housing mới.\r\n- Top housing màu sữa.\r\n-  Lò xo 50g.\r\n- Đã lube nhẹ từ nhà máy.\r\n-  Công tắc tuyến tính (linear), thiết kế 5 chân\r\n- Bấm mượt', 'https://youtu.be/uMKRId9BbZg', 1, 3500, '9999', 2),
(3, 'Holy Panda', '4', 'pandas', 'https://i.imgur.com/phfXdPU.jpg', '- Halo switch stems- Ivory white switch housing made from POM, a self-lubricating plastic material- 67g spring- Plate mount- Style: Tactile- Stem color: Salmon- Per-switch LED compatibility: SMD and through-hole- MX-compatible-  Phân phối bởi ezsupply.app', 'https://youtu.be/pn9C68rPD1k', 1, 17000, '0', 3),
(4, 'KTT Strawberry (Dâu)', '4', 'kttdau', 'https://i.imgur.com/2prcUHJ.jpg', '- Kiểu công tắc: Linear- Vỏ công tắc được làm từ chất liệu nhựa PC- Con trượt (stem) được làm từ nhựa POM- Lò xo đi kèm có lực nhấn 62g - là loại lò xo vàng- Công tắc có 5 Pin- Công tắc được lube sẵn- - Phân phối bởi ezsupply.app', 'https://youtu.be/nn5WWmTmBVA', 1, 6200, '0', 1),
(5, 'KTT Strawberry 5 PIN', '4', 'dau01', 'https://i.imgur.com/SC19ETP.jpg', '- Sản xuất bởi KTT- Kiểu công tắc: Linear- Vỏ công tắc được làm từ chất liệu nhựa PC- Con trượt (stem) được làm từ nhựa POM- Lò xo đi kèm có lực nhấn 62g - là loại lò xo vàng- Công tắc có 5 Pin- Công tắc được lube sẵn', 'https://youtu.be/nn5WWmTmBVA', 1, 5800, '0', 1),
(6, 'Hộp bã mía 1 ngăn liền nắp', '4', 'hbm01', 'https://i.imgur.com/MBsbpyf.jpg', '- Sản phẩm được làm từ bã mía. Gồm 1 ngăn\r\n- Đảm bao vệ sinh ATTP\r\n- Thân thiện với môi trường', 'https://joyfood.com.vn/hop-ba-mia-giai-phap-xanh-cho-nguoi-tieu-dung.html', 1, 2200, '0', 1),
(7, 'Tô bã mía 850ml', '4', 'tbm01', 'https://i.imgur.com/hS4o0yO.jpg', '- Sản phẩm 100% từ bã mía\r\n- Đảm bảo ATTP\r\n- Dung tích 80ml', 'https://www.bachhoaxanh.com/to-chen-dia-dung-mot-lan/12-chen-ba-mia-tron-green-eco-135cm', 1, 2650, '0', 1),
(8, 'KTT KangWhite V3', '4', 'sw03', 'https://i.imgur.com/OMHHd1C.png', '- 40g Lực tác chiến- 50g Lực lượng Dưới cùng- Tổng hành trình 4.0mm- Lò xo 15,5mm- Đặc điểm chuyển mạch tuyến tính- Hơn 50 triệu lần nhấn phím kéo dài- 3 pin- Vỏ Polycarbonate trong suốt hàng đầu- Vỏ Nylon dưới cùng- Thân Pom- Prelube- Hỗ trợ ổ cắm Outemu và bàn phím Kailh Socket- Được phân phối bởi : Ezsupply.app', 'https://www.youtube.com/watch?v=MBeDtXAyDYw', 1, 2850, '0', 1),
(9, 'Sa tế tôm khô sò điệp Lão Đại', '6', 'Sa tế tôm khô sò điệp', 'https://i.imgur.com/fHmuZta.jpg', 'Trích dẫn anh Nguyễn Thành Vinh\r\nTrên tay sa tế tôm khô sò điệp Nhật Lão Đại. Các ace mê món sa tế này thì nên thử. Đảm bảo mê luôn.\r\nMón sa tế ngon không thể bỏ qua. Ngon quá phải tìm hiểu giới thiệu mọi người thử luôn.\r\nMón sa tế tôm khô sò điệp Nhật được làm từ tôm khô, sò điệp Nhật và 4 loại ớt khác nhau như hình.\r\nMón sa tế này mà dùng để làm đồ chấm ăn phở, làm lẩu chua cay thì thôi rồi. Ướp nướng từ thịt bò cho tới hải sản thì bao phê nha cả nhà. Nói chung thủ sẳn 1 lọ đi ăn mang theo thì y bài.\r\nGợi ý các ace mấy món hay chế biến cùng sa tế: Lẩu Thái và tất cả các thứ có nước lèo đều có thể dùng sa tế, bò nướng sa tế, lẩu bò, sườn heo nướng sa tế, chân gà nướng sa tế\r\nCác loại hải sản xào như ốc móng tay xào sa tế, mực xào sa tế, càng ghẹ xào sa tế...\r\nCác món hải sản nướng: mực nướng sa tế, tôm nướng sa tế, các loại cá nướng sa tế, ốc giác, tỏi...nướng sa tế\r\nGiá rẻ so với chất lượng chỉ 60 xu/ 1 hũ như hình.\r\nNgoài ra Lão Đại còn có món sốt XO đẳng cấp được làm từ các nguyên liệu như: tôm khô, cá khô, sò điệp khô, jambon xông khói, rượu trắng và tất nhiên tỏi ớt và rất nhiều thứ gia vị ngon tạo nên món sốt XO huyền thoại trứ danh.\r\nĐã mê ẩm thực Trung Hoa và Hong Kong thì không thể không nhắc đến món sốt XO này rồi.\r\nSa tế tôm sò điệp đã ok thì chắc chắn sốt XO cũng ngon đều tay.\r\nGiá chỉ 80 xu/ 1 hũ như hình.\r\nGiới thiệu cả nhà vài món ngon với sốt XO:\r\nCác loại thịt nướng sốt XO\r\nHải sản sốt XO\r\nCác loại mì sốt XO\r\nNói chung để các ace tự trải nghiệm vậy.\r\nMua hàng thì liên hệ số đt trên hình hoặc alo trực tiếp cho Mr Khôi: 0989112112. Ngon quá nên quảng cáo dùm anh Khôi luôn.\r\nCác ace nên đặt về quất nha. Không ngon lên đây đưa mặt cho chửi thoải mái luôn.\r\nMãi yêu.\r\n#sate #satế #satetomsodiep #satếtômsòđiệp #satetomkhosodiep #satếtômkhôsòđiệp #satay #shrimpsatay #scallopsatay #xosauce #sốtxo #xosauces #sotxo #sàigònngon #saigonngon #satelaodai #satếlãođại #sotxolaodai #sốtxolãođại #satetomkhosodieplaodai #satếtômkhôsòđiệplãođại #satetomsodieplaodai #satếtômsòđiệplãođại', 'https://m.facebook.com/groups/saigonngon/permalink/2395053130629114/?mibextid=Nif5oz', 1, 60000, '1000', 4);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `sale`
--

CREATE TABLE `sale` (
  `s_id` int(11) NOT NULL,
  `code` text NOT NULL,
  `discount` int(11) NOT NULL,
  `max` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `sale`
--

INSERT INTO `sale` (`s_id`, `code`, `discount`, `max`) VALUES
(1, 'ship35k', 35000, 0);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `statist`
--

CREATE TABLE `statist` (
  `id` int(11) NOT NULL,
  `o_date` date NOT NULL,
  `sl_o` int(11) NOT NULL,
  `stt` bigint(100) NOT NULL,
  `sl_p` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `statist`
--

INSERT INTO `statist` (`id`, `o_date`, `sl_o`, `stt`, `sl_p`) VALUES
(1, '2022-11-15', 9, 12928600, 10),
(2, '2022-12-01', 3, 2133000, 3);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `type`
--

CREATE TABLE `type` (
  `t_id` int(11) NOT NULL,
  `type` text NOT NULL,
  `cate` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `type`
--

INSERT INTO `type` (`t_id`, `type`, `cate`) VALUES
(1, '', 'Gaming'),
(4, 'switch', 'Gaming'),
(5, '', 'Food'),
(6, 'Spices', 'Food');

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
  `no` text NOT NULL,
  `email` text NOT NULL,
  `comment` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `user`
--

INSERT INTO `user` (`u_id`, `phone`, `pass`, `f_name`, `l_name`, `city`, `district`, `ward`, `street`, `no`, `email`, `comment`) VALUES
(1, '0384242610', '202cb962ac59075b964b07152d234b70', 'Chuc', 'Kinkouuu', 'NAM DINH', 'DD', 'KT', 'TT', '144/354', 'chuckinkou2k1@gmail.com', ''),
(2, '0939272096', '125d0d502244655321fd3c3daf0dc440', 'Anh', 'Lê', 'Ho Chi Minh City', '1', 'Cầu Kho', 'Nguyễn Cảnh Chân', 'Tk39/40', '', ''),
(3, '0963698492', '592298ef4fba842d6e04491461f2cb53', 'Quang', 'Tran', 'Ho Chi Minh City', 'District 1', 'Cầu Kho', 'Nguyễn Cảnh Chân', 'TK39/40', '', ''),
(4, '0901356539', 'b53a9c8bbb8dd4ff90eac7608b2f187e', 'Minh', 'Hong', 'Ho Chi Minh', '3', 'Vo Thi Sau', 'Pham Ngoc Thach', '40', '', ''),
(5, '0964233808', '2f802d2aa4bbfa7021450fe0822839c9', 'Vũ', 'Đức Phùng', 'Hà Nội', 'Cầu Giấy', 'Yên Hòa', 'Phạm Văn Bách', 'PVI-no 1st', '', ''),
(6, '0971259205', 'd3fbc929654d55036bc06cc86940846f', 'Phạm', 'Hiệp', 'Hồ Chí Minh', 'Quận', 'Tô Hiến Thành', 'KingDom 101 334', 'C10.10', '', ''),
(7, '0899498358', '07418c8318ef2cf210cf0ccbfd389bff', 'Nguyễn', 'Minh', 'TP.HCM', 'Quận 9', 'Long Thạch Mỹ', 'Hoàng Hữu Nam', '62', '', ''),
(8, '0826870876', 'a8e070c676e76cd30bdd0a3dca1d4575', 'Lê', 'Name', 'TP.Ngã 7', 'Lái Hiếu', 'khu vực 5', '30/4', '346', '', ''),
(9, '0971119486', '9a4acc0afa7365df1aab8a54b0ac2ead', 'Hoàng', 'Vương', 'Hà Nội', 'Bắc Từ Liêm', 'Xuân Đỉnh', 'Xuân Đỉnh', 'hẻm 54 ngách 207/103', '', ''),
(10, '0982398912', 'ecab9fc77112951a657d95bca35bee57', 'Hà', 'Hoàng', 'TP.HCM', 'Quan 1', 'Cau Kho', 'Tran Hung Dao', '391', '', ''),
(11, '0392363717', '78db7d7749dc8f57d46d42a59adf9bbd', 'Nguyen', 'Doan Quang', 'Ho Chi Minh', 'Tân Phú', 'Phú Thạnh', 'Thoại Ngọc Hầu', '197/36', '', ''),
(12, '0583473012', 'fb09e8c8a12c7c78da154ad6e3829c5e', 'Nguyễn', 'Anh', 'Quận Bắc Từ Liêm', 'Hoài Đức', 'Kim Chung', 'Lai Xá', 'Số 9 ngõ 177', '', ''),
(13, '0328275396', '668b47cfd5d6f694a767874745a9f660', 'Nguyen', 'Nhat', 'Dong Nai', 'Bien Hoa', 'Thong Nhat', 'Pham Van Thuan', 'FPTShop 282', '', ''),
(14, '0967836352', 'c5eeff821773f7207e772b379f5ef3b7', 'Van', 'Pham Cuong', 'Hà Nội', 'Đống Đa', 'Kim Liên', 'Phương Mai', 'Số 10 Ngách 38/17', '', ''),
(15, '0983155295', '8a180dd890cf32a1a28f558155f82956', 'Hà', 'Quyền', 'Hà Nội', 'Bắc Từ Liêm', 'Minh Khai', 'Cầu Diễn', 'số nhà 23 ngách 136/51', '', ''),
(16, '0888007077', 'f467e333088878471e949f9213d18283', 'Đồng', 'Trung Tín', 'Vĩnh Long', 'Bình Minh', 'Cái Vồn', 'Phan Văn Năm', '12345', '', ''),
(17, '0973453712', 'b0c902013e449e32ec92d0b4ec37859d', 'Thi', 'Nguyen', 'Nghe An', 'Quynh Luu', 'Quynh Minh', 'Thon 3', 'Cty TNHH Viet Uc Nghe An', '', ''),
(18, '0708297578', 'e7810fb45ff637625e0c0a7598505872', 'Trần', 'Trung', 'TP. Hồ Chí Minh', '9', 'tp thủ đức', '3/25/15b đường', '182', '', ''),
(19, '0967265150', '96230139e72dfc21cca43b95e006b445', 'Phuc', 'Vo', 'Hồ Chí Minh', 'Gò Vấp', 'Phường 5', 'Đường 20', '193/10/2', '', ''),
(20, '0779792386', '2563962eaf46b7cbe33a6a930f1da1c0', 'Long', 'Phạm', 'Ho Chi Minh', '10', '13', 'Cach Mang Thang Tam', '463B/40', '', ''),
(21, '0886288362', 'e1c2b58517330c49c2818dbfc044562f', 'Đỗ', 'Thông', 'Hà Nội', 'Thanh Xuân', 'Thanh Xuân Nam', 'Nguyễn Trãi', 'H10, ngõ 475', '', ''),
(22, '0377696040', '2d595d337bc76bb4e98ac6cbc7a1f61f', 'Lâm', 'Trần', 'Tỉnh Bà rịa - vũng tàu', 'Thị xã phú mỹ', 'Tân hoà', 'Phước long', '53A', '', ''),
(23, '0799224675', '66dbd90cc25bd554d58ee8ead6a17c43', 'Trần', 'Anh Tú', 'TP. Hồ Chí Minh', '1', 'Bến Nghé', 'Tôn Thất Đạm', '76/4', '', ''),
(24, '0352188885', '9ee695fec50ddfb6ddbdc3038fbbc776', 'Tran Quy', 'Dat', 'Ha Noi', 'Dong Da', 'Lang Thuong', 'ngo 14 phao dai lang', 'so 12', '', ''),
(25, '0942728185', 'ad02e96f92bfd6ba030a18f757595ae1', 'Viet', 'Hoang', 'Nam dinh', 'Nam dinh', 'Nam Định', 'Máy Tơ', '24', '', ''),
(26, '0359178393', 'bfa2e74f21343fcf4c3e02bd29cf35fe', 'Hoàng', 'Nguyễn Bùi Minh', 'Hồ Chí Minh', 'Bình Tân', 'Bình Hưng Hòa', '12', '80/91/10/8', '', ''),
(27, '0971325969', '5f8bae89fb9f9fe1e8ea06e12981829e', 'anh', 'nguyễn', 'hà nội', 'cầu giầy', 'số 27 ngõ 125', 'nguyễn ngọc vũ', 'trung hoà', '', ''),
(28, 'hai', '202cb962ac59075b964b07152d234b70', 'Phạm', 'Hải', 'Hà Nội', '123', '123', '123', '123', '', ''),
(29, '0969427259', 'f52e82f9bd4781537be1b3ffc81b9f02', 'Đào Duy', 'Thái', 'Hà Nội', 'None', 'None', 'Hoàng mai', 'Hh1A', '', ''),
(30, '0988660490', '415981b72483f8cf1a02f678c74f145e', 'quan', 'ly nguyen', 'HCMC', '5', '3', 'Huynh Man Dat', '158/6', '', ''),
(31, '0353641708', 'c60388dec22f7647455db924e691552b', 'Lê thành', 'Công thương', 'Tphcm', '13/8a trung đông', 'Thới tam thon', 'Hóc môn', 'Thới tam thôn', '', ''),
(32, '0384756509', '3607d4978c2d69ad925a4218347b0c24', 'hải', 'đỗ', 'hà nội', 'đống đa', 'tôn đức thắng', 'tôn đức thắng', '60/74 ngõ thịnh hào 1', '', ''),
(33, '0345490407', '40d08d91d407f189b3410e50b66b65b0', 'Hoàng', 'Khánh', 'Đà Nẵng', 'no', 'no', 'no', 'no', '', ''),
(34, '0962647964', 'f875beaf77306e8a3570e785b55eaea4', 'hải', 'nguyễn', 'sơn la', 'mường la', 'xã chiềng lao', 'bản nhạp', 'khu tập thể thủy điện huội quảng', '', ''),
(35, '+84982095396', '2cef564959f8f68389c80804fc387a42', 'Nguyen', 'Dat', 'Hanoi', 'Hoang Mai', 'Thinh Liet', 'Giai Phong Road', '6/23/1197 Giai Phong Road', '', ''),
(36, '0966644598', 'a7333c5405f00142354c32f10b90a979', 'Da', 'Hoang', 'Hà nội', 'đống đa', 'láng hạ', '14 pháo đài láng', '10000', '', ''),
(37, '0387244434', 'b20c49a662ac39d32430c59ac18998ca', 'huỳnh', 'quốc', 'Đà Nẵng', 'Hải Châu', 'none', 'Huỳnh Tấn Phát', '179', '', ''),
(38, '0967098422', 'bbb955f6e65393b0397a629771d2509c', 'Quang', 'Huy', 'Hà Nội', 'Quận Hoàng Mai', 'Phường Tương Mai', 'ngách 75, ngõ 281, đường Trương Định', '33', 'quanghuy41202@gmail.com', ''),
(39, '0386584151', '75670462fcb95a913fb50afaa9876b74', 'Đạt', 'Nguyễn Tấn', 'Da Nang', 'Ngu Hanh Son', 'My An', 'Luu Quang Thuan', '7/12', '', ''),
(40, '0945712758', '95560fd583bc52f1fe2298b5941bbabc', 'Pham', 'Dung', 'Ha Noi', 'Thanh Tri', 'Yen Xa', 'Ngo 123', '20', '', ''),
(41, '0702873108', '63447977d884745e55c643edf48e23fc', 'Mai', 'Phuoc', 'Ho Chi Minh', '8', '3', 'Âu Dương Lân', '314/10', '', ''),
(42, '0816386999', '577dc23b4ab81acddb1d8cd549a2686b', 'Trần Tiến', 'Thịnh', 'Hà Nội', 'Thanh Xuân', 'Thanh Xuân Nam', 'Triều Khúc', '85/68', '', ''),
(43, '0384693524', '8b2f0ce9f3f0711815ca24bd134c4c91', 'Nguyễn Hoàng', 'Trung', 'Hà Nội', 'Cầu Giấy', 'Dịch Vọng', 'Đường Trần Thái Tông', 'Số 35, ngõ 45', '', ''),
(44, '0926268205', '50b87ce7776e4a0ebd7f09596b911ece', 'Minh', 'Ly', 'TPHCM', 'Bình Thạnh', '13', 'Đặng Thuỳ Trâm', '233/37', '', ''),
(45, '0776400875', '2bc6ff4f091039557b0e68542e93b8c9', 'Nguyen', 'Nghia', 'Ho Chi Minh City', 'quan 8', 'phuong 6', 'duong so 2', '17', '', ''),
(46, '0935003742', 'e804a83a8398b63378076d35ceed4664', 'anh', 'le', 'Tp. HCM', 'Tân Bình', '1', '301/12 Nguyễn Văn Trỗi', 'Tòa nhà s3', '', ''),
(47, '0967701230', '1a89a91770be00ba837641c59d83d6f5', 'Bách', 'Huy', 'Hà Nội', 'Hoài Đức', 'Cát Quế', 'Đội 9', '9', '', ''),
(48, '0938442011', '1d937c2eb6929db1b41c3c8366b7b8f7', 'Nguyễn', 'Hoàng Hiệp', 'Bình Dương', 'Thuận An', 'Bình Hòa', '8 Hữu Nghị, VSIP', 'Tòa nhà VSIP', '', ''),
(49, '0333195116', 'f61ea5d15668ce1de4ae4fa2d55649cc', 'Tu Anh', 'Nguyen', 'Ha Noi', 'Nam Từ Liêm', 'Phường Trung Văn', 'Phùng Khoang', 'số 6 nhà n3 ngõ 32 Phùng Khoang', '', ''),
(50, '0902217213', 'e10adc3949ba59abbe56e057f20f883e', 'Đỗ Anh', 'Tuấn', 'Hồ Chí Minh', 'Quận 1', 'Nguyễn Cư Trinh', 'Nguyễn Văn Cừ', 'Royal tower tháp B 235', '', ''),
(51, '0397184208', '0564c5b5ed760a63be17b117e1fc0137', 'Đức', 'Tân', 'Ho Chi Minh', 'Thủ Đức', 'Long Trường', '124/14/37 Võ Văn Hát', '124/14/37 Võ Văn Hát', '', ''),
(52, '0935477998', '8f8555f2a342f17f74b48a8c31ed9980', 'Khanh', 'Nguyen', 'Da Nang', 'Hai Chau', 'Thuan Phuoc', 'Phan Ke Binh', '11', '', 'Huỷ đơn , chuyển đơn qua Ngô Quốc Tuấn'),
(53, '0789307329', '421ef73e32bb464d1e2bfb01f6236b98', 'Phúc', 'Phạm', 'Hà Nội', 'Hà Đông', 'Văn Quán', '19/5 street', '146/26/33', '', ''),
(54, '0812364949', '9cfb9e4f57c320fbad6d31e51f64c236', 'Phúc', 'Nguyễn', 'Hcm', 'Q10', 'Hcm', 'lê hồng phong , Q10', 'Lê hồng phong', '', ''),
(55, '0868401861', 'fe13cb9f3a6d2689314574318edd3a38', 'Minh Tu', 'Luc', 'Hanoi', 'Bac Tu Liem', 'Tdp Hoang 8', 'Tran Cung', '117/63/5', '', ''),
(56, '0823085513', 'd97144d66e246ae0ec6e66ece01bd13a', 'Nguyễn', 'Trọng Nguyên', 'Hồ Chí Minh', '3', 'Võ Thị Sáu', 'Nguyễn Đình Chiểu', '218', '', ''),
(57, '0327577795', 'e00044e96410bfef78823c09511bcdfe', 'Nguyễn', 'anh', 'Hồ Chí Minh', 'Quận Tân Bình', 'Phường 4', 'Lê bình', 'Sô 1A', '', ''),
(58, '0908126858', '8f1759e205adeda70a2f81e697a7a178', 'Tuấn', 'Trần', 'Hồ chí minh', 'tân bình', '13', '4C Đồng Xoài', 'nhà', '', ''),
(59, '0369121704', '59c04c37b56cf7d33423cdecc22b13f8', 'Nguyễn Tấn', 'Huyền', 'tiền giang', 'gò công tây', 'đồng thạnh', 'thạnh hưng', 'Ấp thạnh hưng xã đồng thạnh huyện gò công tây tỉnh tiền giang', '', ''),
(60, '0888408488', 'cbf8166996832907079adfe62d8ca1e7', 'Ngô Quốc', 'Tuấn', 'Hải Phòng', 'Hải An', 'Thành Tô', 'Ngô Gia Tự', '836/800', '', ''),
(61, '0326545748', '9c82ae3579b75624fd307613e1637933', 'Lam', 'Le', 'Ho Chi Minh', 'Thu Duc', 'Hiep Binh Chanh', '36', '27', '', ''),
(62, '0961710878', '153de1a1ec763837f876503f43293389', 'Tran', 'Dat', 'Hcm', 'Quận 9', 'Tăng nhon phu a', 'Đường 102', '59/112/21', '', ''),
(63, '0855234878', '257ed28ae84d29d1aea0c48c7e440f7d', 'Tùng', 'Trần', 'Ho Chi Minh City', 'TP Thủ Đức', 'Phường Linh Trung', 'Tô Vĩnh Diện', 'KTX Khu B ĐHQG TPHCM', '', ''),
(64, '0964308820', '201958bf241f40fabcbd42589feb51e9', 'Trương Thị Kiều', 'Oanh', 'Bắc Ninh', 'Lương Tài', 'Thị TRấn Thứa', 'Đạo sử', 'none', '', ''),
(65, '0372064929', '085ffb1ab443ed86ab092d0bb7ef3cd7', 'Nguyễn', 'Minh', 'TP.HCM', 'Quận 9', 'Long Thạch Mỹ', '62 Hoàng Hữu Nam', '.', '', ''),
(66, '0949950598', '0ad75bbe69a5376b64638ac064219ac8', 'Cao', 'Sơn', 'Hà Nội', 'Đống đa', 'Láng Thượng', 'Láng hạ', '22 Láng Hạ', '', '');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `details`
--
ALTER TABLE `details`
  ADD KEY `fk_ctdh` (`o_id`);

--
-- Chỉ mục cho bảng `factory`
--
ALTER TABLE `factory`
  ADD PRIMARY KEY (`f_id`);

--
-- Chỉ mục cho bảng `gb`
--
ALTER TABLE `gb`
  ADD PRIMARY KEY (`g_id`);

--
-- Chỉ mục cho bảng `gb_list`
--
ALTER TABLE `gb_list`
  ADD KEY `fk_gb` (`g_id`);

--
-- Chỉ mục cho bảng `money`
--
ALTER TABLE `money`
  ADD PRIMARY KEY (`m_id`);

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
-- Chỉ mục cho bảng `sale`
--
ALTER TABLE `sale`
  ADD PRIMARY KEY (`s_id`);

--
-- Chỉ mục cho bảng `statist`
--
ALTER TABLE `statist`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `type`
--
ALTER TABLE `type`
  ADD PRIMARY KEY (`t_id`);

--
-- Chỉ mục cho bảng `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`u_id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `factory`
--
ALTER TABLE `factory`
  MODIFY `f_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `gb`
--
ALTER TABLE `gb`
  MODIFY `g_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `money`
--
ALTER TABLE `money`
  MODIFY `m_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `order`
--
ALTER TABLE `order`
  MODIFY `o_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=94;

--
-- AUTO_INCREMENT cho bảng `product`
--
ALTER TABLE `product`
  MODIFY `p_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT cho bảng `sale`
--
ALTER TABLE `sale`
  MODIFY `s_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `statist`
--
ALTER TABLE `statist`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `type`
--
ALTER TABLE `type`
  MODIFY `t_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT cho bảng `user`
--
ALTER TABLE `user`
  MODIFY `u_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `details`
--
ALTER TABLE `details`
  ADD CONSTRAINT `fk_ctdh` FOREIGN KEY (`o_id`) REFERENCES `order` (`o_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `gb_list`
--
ALTER TABLE `gb_list`
  ADD CONSTRAINT `fk_gb` FOREIGN KEY (`g_id`) REFERENCES `gb` (`g_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
