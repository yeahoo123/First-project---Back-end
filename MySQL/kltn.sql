-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 12, 2021 at 05:26 PM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 8.0.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kltn`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `category_id` int(30) NOT NULL,
  `parent_id` tinyint(1) NOT NULL,
  `category_name` varchar(255) NOT NULL,
  `category_status` tinyint(1) NOT NULL,
  `create_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`category_id`, `parent_id`, `category_name`, `category_status`, `create_date`) VALUES
(1, 0, 'Điện thoại', 1, '2020-10-17 12:19:38'),
(2, 0, 'Laptop', 1, '2020-10-17 12:20:37'),
(3, 0, 'Tablet', 1, '2020-12-20 12:06:08'),
(4, 0, 'Smartwatch', 1, '2020-10-17 12:23:38'),
(5, 0, 'Phụ kiện', 1, '2020-12-19 20:31:22'),
(6, 1, 'Iphone', 1, '2020-10-17 12:37:11'),
(7, 1, 'Samsung', 1, '2020-10-17 12:37:11'),
(8, 2, 'Macbook', 1, '2020-10-17 12:37:11'),
(9, 4, 'Samsung watch', 1, '2020-12-19 15:44:24'),
(10, 4, 'Apple watch', 1, '2020-10-17 12:44:06'),
(26, 2, 'Dell', 1, '2020-12-19 20:32:57'),
(27, 3, 'Ipad', 1, '2020-12-20 12:05:39'),
(33, 3, 'Galaxy Tab', 1, '2020-12-20 12:19:22');

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE `news` (
  `news_id` int(30) NOT NULL,
  `news_ctgr_id` int(30) NOT NULL,
  `news_title` varchar(255) NOT NULL,
  `news_image` blob NOT NULL,
  `news_content` text NOT NULL,
  `news_description` varchar(255) NOT NULL,
  `news_author` varchar(255) NOT NULL,
  `news_isHome` tinyint(1) NOT NULL,
  `news_isHot` tinyint(1) NOT NULL,
  `news_status` tinyint(1) NOT NULL,
  `create_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `news`
--

INSERT INTO `news` (`news_id`, `news_ctgr_id`, `news_title`, `news_image`, `news_content`, `news_description`, `news_author`, `news_isHome`, `news_isHot`, `news_status`, `create_date`) VALUES
(10, 1, 'Sau bao ngày chờ đợi, cuối cùng Liên minh: Tốc Chiến cũng đã có bản chính thức cho người dùng Việt tải về và trải nghiệm', 0x313630373332363839316c69656e6d696e68746f63636869656e315f383030783435302e6a7067, 'Liên Minh: Tốc chiến là một ứng dụng đang rất được mong đợi tại Việt Nam. Sau nhiều thông tin về thời gian ra mắt chính thức, hôm nay VNG Game Studios đã cho phép các game thủ tải xuống tựa game này.', ' Liên Minh: Tốc chiến là một ứng dụng đang rất được mong đợi tại Việt Nam. Sau nhiều thông tin về thời gian ra mắt chính thức, hôm nay VNG Game Studios đã cho phép các game thủ tải xuống tựa game này.', 'yeahoo123', 1, 1, 1, '2020-12-19 15:51:54'),
(17, 1, 'Trên tay Samsung Galaxy Watch 3 Titanium: Phiên bản đồng hồ thông minh cao cấp với màu đen lịch lãm dành cho các quý ông', 0x3136303733313832333767616c617879776174636833746974616e69756d2d342d5f3230343878313135302d3830302d726573697a652e6a7067, 'Ngoài những chiếc đồng hồ thông minh truyền thống, Samsung đã cho ra mắt thêm một phiên bản đặc biệt có tên là Galaxy Watch 3 Titanium. Hãy cùng mình đập hộp và trên tay Galaxy Watch 3 Titanium qua bài viết này thôi nào.', ' Ngoài những chiếc đồng hồ thông minh truyền thống, Samsung đã cho ra mắt thêm một phiên bản đặc biệt có tên là Galaxy Watch 3 Titanium. Hãy cùng mình đập hộp và trên tay Galaxy Watch 3 Titanium qua bài viết này thôi nào.', 'yeahoo123', 0, 1, 1, '2020-12-07 12:17:17'),
(18, 1, 'Một smartphone Nokia giá rẻ vừa lộ diện trên TENAA với thiết kế cổ điển, bộ nhớ trong lớn và có cả đèn flash LED mặt trước', 0x313630373331383238386e6f6b69612d302d5f3137383878313030342d3830302d726573697a652e6a7067, 'Hôm qua (5/12), có 2 model smartphone Nokia đạt chứng nhận tại FCC, còn bây giờ, chúng ta có thêm một thiết bị khác và lần này là ở cơ quan TENAA Trung Quốc.', ' Hôm qua (5/12), có 2 model smartphone Nokia đạt chứng nhận tại FCC, còn bây giờ, chúng ta có thêm một thiết bị khác và lần này là ở cơ quan TENAA Trung Quốc.', 'yeahoo123', 0, 1, 1, '2020-12-07 12:18:08'),
(19, 1, 'Cách tải Liên Minh Huyền Thoại Tốc Chiến sever Việt của VNG, có Tiếng Việt', 0x31363037333138333331636163682d7461692d6c69656e2d6d696e682d687579656e2d74686f61692d746f632d636869656e2d766965742d6e616d5f383030783435302e6a7067, 'Như vậy là sau bao ngày chờ đợi, tựa game Liên Minh Huyền Thoại: Tốc Chiến đã có mặt chính thức tại Việt Nam, được phát hành bởi VNG Game. Thỏa lòng tất cả game thủ yêu mến Liên Minh Tốc Chiến của Riot Games và VNG Games. Sau đây là cách tải Liên Minh Tốc Chiến Việt Nam trên điện thoại.', ' Như vậy là sau bao ngày chờ đợi, tựa game Liên Minh Huyền Thoại: Tốc Chiến đã có mặt chính thức tại Việt Nam, được phát hành bởi VNG Game. Thỏa lòng tất cả game thủ yêu mến Liên Minh Tốc Chiến của Riot Games và VNG Games. Sau đây là cách tải Liên Minh Tố', 'yeahoo123', 1, 1, 1, '2020-12-19 15:52:52'),
(20, 1, 'Đánh giá chi tiết iPhone 11 sau 1 năm ra mắt: ', 0x313630373331383335396970686f6e6531312d32315f31323830783732302d3830302d726573697a652e6a7067, 'iPhone 12 chính thức ra mắt đã mang đến cuộc cách mạng trong thiết kế lên những chiếc iPhone của Apple. Câu hỏi đặt ra hôm nay là iPhone 11 có còn đáng mua không? Câu trả lời là có. Bài viết hôm nay mình sẽ đánh giá chi tiết iPhone 11 sau 1 năm ra mắt để giải thích lí do vì sao.', ' iPhone 12 chính thức ra mắt đã mang đến cuộc cách mạng trong thiết kế lên những chiếc iPhone của Apple. Câu hỏi đặt ra hôm nay là iPhone 11 có còn đáng mua không? Câu trả lời là có. Bài viết hôm nay mình sẽ đánh giá chi tiết iPhone 11 sau 1 năm ra mắt để', 'yeahoo123', 1, 1, 1, '2020-12-20 14:28:10'),
(21, 1, '6 tuyệt chiêu bí mật sử dụng Messenger theo phong cách độc lạ.', 0x313630373331383432377468756d2d5f3139323078313038302d3830302d726573697a652e6a7067, 'Messenger là một trong những ứng dụng nhắn tin và gọi điện miễn phí được sử dụng trên smartphone phổ biến nhất hiện nay. Không chỉ đơn thuần là một ứng dụng nhắn tin và gọi điện miễn phí Messenger còn mang đến rất nhiều điều bí ẩn mà không phải ai cũng khám phá hết nó. Sau đây mình sẽ chỉ ra 6 bí mật thú vị của Messenger các bạn cùng sử dụng nó. Hãy theo dõi bài viết nhé.', ' Messenger là một trong những ứng dụng nhắn tin và gọi điện miễn phí được sử dụng trên smartphone phổ biến nhất hiện nay. Không chỉ đơn thuần là một ứng dụng nhắn tin và gọi điện miễn phí Messenger còn mang đến rất nhiều điều bí ẩn mà không phải ai cũng k', 'yeahoo123', 1, 1, 1, '2020-12-20 14:28:29'),
(26, 2, 'iPhone 11 Pro Max và loạt smartphone giảm giá, sắp ngừng bán ở VN', 0x313630383533333438306d617872657364656661756c745f315f2e6a7067, 'Galaxy S20 Ultra, iPhone 11 Pro hay iPhone 11 Pro Max là những mẫu smartphone đang được giảm giá và sắp ngừng bán chính hãng ở Việt Nam.', ' Galaxy S20 Ultra, iPhone 11 Pro hay iPhone 11 Pro Max là những mẫu smartphone đang được giảm giá và sắp ngừng bán chính hãng ở Việt Nam.', 'yeahoo123', 0, 1, 1, '2020-12-21 13:51:20');

-- --------------------------------------------------------

--
-- Table structure for table `newscategory`
--

CREATE TABLE `newscategory` (
  `news_ctgr_id` int(30) NOT NULL,
  `news_ctgr_name` varchar(255) NOT NULL,
  `news_ctgr_status` tinyint(1) NOT NULL,
  `create_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `newscategory`
--

INSERT INTO `newscategory` (`news_ctgr_id`, `news_ctgr_name`, `news_ctgr_status`, `create_date`) VALUES
(1, 'New', 1, '2020-12-21 13:02:31'),
(2, 'Hot', 1, '2020-12-21 13:02:40');

-- --------------------------------------------------------

--
-- Table structure for table `order1`
--

CREATE TABLE `order1` (
  `id` int(30) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `total` int(30) NOT NULL,
  `total2` int(30) NOT NULL,
  `cart` varchar(5000) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `order_check` tinyint(1) NOT NULL,
  `deliverydate` varchar(255) NOT NULL,
  `canceldate` varchar(255) NOT NULL,
  `shipper` varchar(255) NOT NULL,
  `create_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `order1`
--

INSERT INTO `order1` (`id`, `name`, `email`, `phone`, `address`, `total`, `total2`, `cart`, `order_check`, `deliverydate`, `canceldate`, `shipper`, `create_date`) VALUES
(28, 'Lâm Kim Sơn', 'lamkimson1998@gmail.com', '0335678089', '299/30', 122570000, 110490000, '[{\"product_id\":63,\"category_id\":26,\"parent_id\":2,\"product_name\":\"Laptop Dell XPS 13 9310 i5\",\"product_image\":\"1610432649dell-xps-13-9310-i5-70234076-062021-092010-600x600.jpg\",\"product_qty\":10,\"count1\":1,\"product_price\":\"38490000\",\"import_price\":\"35000000\",\"product_description\":\"Laptop Dell XPS 13 9310 i5 (70234076) u0111u01b0u1ee3c trang bu1ecb bu1ed9 vi xu1eed lu00ed thu1ebf hu1ec7 thu1ee9 11 mu1edbi u0111u1ebfn tu1eeb Intel cu00f9ng vu1edbi thiu1ebft ku1ebf mu1ecfng nhu1eb9 nhu01b0ng nu00f3 vu1eabn mang u0111u1ebfn tru1ea3i nghiu1ec7m chu01a1i game tuyu1ec7t vu1eddi cho giu1edbi tru1ebb.\",\"product_isHome\":1,\"product_isHot\":0,\"product_status\":1,\"create_date\":\"2020-12-19 20:32:57\",\"category_name\":\"Dell\",\"category_status\":1},{\"product_id\":64,\"category_id\":26,\"parent_id\":2,\"product_name\":\"Laptop Dell XPS 13 9310 i7\",\"product_image\":\"1610432696dell-xps-13-9310-i7-jgnh61-063521-083524-600x600.jpg\",\"product_qty\":10,\"count1\":1,\"product_price\":\"58990000\",\"import_price\":\"55000000\",\"product_description\":\"Dell XPS 13 9310 i7 (JGNH61) lu00e0 mu1ed9t chiu1ebfc laptop 2 trong 1 mu1ecfng nhu1eb9 vu00e0 sang tru1ecdng, phu00f9 hu1ee3p cho giu1edbi doanh nhu00e2n thu00e0nh u0111u1ea1t. Vu1edbi hiu1ec7u nu0103ng vu00f4 cu00f9ng mu1ea1nh mu1ebd u0111u1ebfn tu1eeb con chip i7 gen 11, con laptop nu00e0y su1ebd khiu1ebfn bu1ea1n khu00f4ng khu1ecfi ngu1ea1c nhiu00ean bu1edfi khu1ea3 nu0103ng vu01b0u1ee3t tru1ed9i cu1ee7a nu00f3.\",\"product_isHome\":1,\"product_isHot\":1,\"product_status\":1,\"create_date\":\"2020-12-19 20:32:57\",\"category_name\":\"Dell\",\"category_status\":1},{\"product_id\":65,\"category_id\":26,\"parent_id\":2,\"product_name\":\"Laptop Dell Vostro 5402 i7 \",\"product_image\":\"1610432746dell-vostro-5402-i7-70231338-064321-114334-600x600.jpg\",\"product_qty\":10,\"count1\":1,\"product_price\":\"25090000\",\"import_price\":\"20490000\",\"product_description\":\"Dell Vostro 5402 i7 (70231338) lu00e0 mu1ed9t lu1ef1a chu1ecdn u0111u00e1ng tin cu1eady cho ngu01b0u1eddi du00f9ng khi mang tru00ean mu00ecnh cu1ea5u hu00ecnh tuyu1ec7t vu1eddi u0111u1ebfn tu1eeb bu1ed9 vi xu1eed lu00fd Intel thu1ebf hu1ec7 thu1ee9 11, thiu1ebft ku1ebf tinh tu1ebf, bu1ec1n bu1ec9 cu1ed9ng vu1edbi thu1eddi lu01b0u1ee3ng pin u1ea5n tu01b0u1ee3ng u0111u1ebfn bu1ea5t ngu1edd.\",\"product_isHome\":1,\"product_isHot\":0,\"product_status\":1,\"create_date\":\"2020-12-19 20:32:57\",\"category_name\":\"Dell\",\"category_status\":1}]', 2, '2021-01-12 22:18:49', '', 'test4 ', '2021-01-12 22:09:43'),
(31, 'Lâm Kim Sơn', 'lamkimson1998@gmail.com', '0335678089', '299/30', 139960000, 122000000, '[{\"product_id\":51,\"category_id\":8,\"parent_id\":2,\"product_name\":\"Laptop Apple MacBook Pro M1 2020\",\"product_image\":\"1610431625apple-macbook-pro-2020-myd92saa-600x600.jpg\",\"product_qty\":10,\"count1\":1,\"product_price\":\"39990000\",\"import_price\":\"35000000\",\"product_description\":\"Apple Macbook Pro M1 2020 (MYD92SA/A) vu1edbi hiu1ec7u nu0103ng cu1ef1c ku1ef3 mu1ea1nh mu1ebd tu00edch hu1ee3p chip Apple M1 lu1ea7n u0111u1ea7u xuu1ea5t hiu1ec7n tru00ean MAC u0111u00e3 xuu1ea5t hiu1ec7n tru00ean thu1ecb tru01b0u1eddng laptop, con laptop nu00e0y hu1ee9a hu1eb9n su1ebd mang u0111u1ebfn cho bu1ea1n mu1ed9t su1ea3n phu1ea9m u201cProu201d chu01b0a tu1eebng thu1ea5y.\",\"product_isHome\":1,\"product_isHot\":1,\"product_status\":1,\"create_date\":\"2020-10-17 12:37:11\",\"category_name\":\"Macbook\",\"category_status\":1},{\"product_id\":52,\"category_id\":8,\"parent_id\":2,\"product_name\":\"Laptop Apple MacBook Air M1 2020\",\"product_image\":\"1610431863apple-macbook-air-2020-mgnd3saa-600x600.jpg\",\"product_qty\":10,\"count1\":2,\"product_price\":\"28990000\",\"import_price\":\"25000000\",\"product_description\":\"Apple vu1eeba cho ra mu1eaft phiu00ean bu1ea3n MacBook Air M1 2020 (MGND3SA/A) mu1edbi cu1ef1c ku00ec u1ea5n tu01b0u1ee3ng vu1edbi con chip M1 mu1edbi u0111u01b0u1ee3c thiu1ebft ku1ebf du00e0nh riu00eang cho MacBook tu0103ng hiu1ec7u suu1ea5t CPU nhanh hu01a1n tu1edbi 3.5 lu1ea7n, tuu1ed5i thu1ecd pin du00e0i nhu1ea5t tu1eeb u200bu200btru01b0u1edbc u0111u1ebfn nay tru00ean MacBook Air.\",\"product_isHome\":1,\"product_isHot\":1,\"product_status\":1,\"create_date\":\"2020-10-17 12:37:11\",\"category_name\":\"Macbook\",\"category_status\":1},{\"product_id\":53,\"category_id\":6,\"parent_id\":1,\"product_name\":\"u0110iu1ec7n thou1ea1i iPhone 12 Pro Max 512GB\",\"product_image\":\"1610431804iphone-12-pro-max-xanh-duong-new-600x600-600x600.jpg\",\"product_qty\":10,\"count1\":1,\"product_price\":\"41990000\",\"import_price\":\"37000000\",\"product_description\":\"iPhone 12 Pro Max 512GB - u0111u1eb3ng cu1ea5p tu1eeb tu00ean gu1ecdi u0111u1ebfn tu1eebng chi tiu1ebft. Ngay tu1eeb khi chu1ec9 lu00e0 tin u0111u1ed3n thu00ec chiu1ebfc smartphone nu00e0y u0111u00e3 lu00e0m u0111u1ee9ng ngu1ed3i khu00f4ng yu00ean bao u201cfan cu1ee9ngu201d nhu00e0 Apple, vu1edbi nhu1eefng nu00e2ng cu1ea5p vu00f4 cu00f9ng nu1ed5i bu1eadt hu1ee9a hu1eb9n su1ebd mang u0111u1ebfn nhu1eefng tru1ea3i nghiu1ec7m tu1ed1t nhu1ea5t vu1ec1 mu1ecdi mu1eb7t mu00e0 chu01b0a mu1ed9t chiu1ebfc iPhone tiu1ec1n nhiu1ec7m nu00e0o cu00f3 u0111u01b0u1ee3c.\",\"product_isHome\":1,\"product_isHot\":1,\"product_status\":1,\"create_date\":\"2020-10-17 12:37:11\",\"category_name\":\"Iphone\",\"category_status\":1}]', 2, '2021-01-12 23:12:08', '', 'test5', '2021-01-12 23:12:00');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `product_id` int(30) NOT NULL,
  `category_id` varchar(255) NOT NULL,
  `parent_id` int(30) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `product_image` varchar(255) NOT NULL,
  `product_qty` int(30) NOT NULL,
  `count1` tinyint(1) NOT NULL,
  `product_price` varchar(255) NOT NULL,
  `import_price` varchar(255) NOT NULL,
  `product_description` text NOT NULL,
  `product_isHome` tinyint(1) NOT NULL,
  `product_isHot` tinyint(1) NOT NULL,
  `product_status` tinyint(1) NOT NULL,
  `create_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`product_id`, `category_id`, `parent_id`, `product_name`, `product_image`, `product_qty`, `count1`, `product_price`, `import_price`, `product_description`, `product_isHome`, `product_isHot`, `product_status`, `create_date`) VALUES
(51, '8', 2, 'Laptop Apple MacBook Pro M1 2020', '1610431625apple-macbook-pro-2020-myd92saa-600x600.jpg', 9, 1, '39990000', '35000000', 'Apple Macbook Pro M1 2020 (MYD92SA/A) với hiệu năng cực kỳ mạnh mẽ tích hợp chip Apple M1 lần đầu xuất hiện trên MAC đã xuất hiện trên thị trường laptop, con laptop này hứa hẹn sẽ mang đến cho bạn một sản phẩm “Pro” chưa từng thấy.', 1, 1, 1, '2021-01-12 13:07:05'),
(52, '8', 2, 'Laptop Apple MacBook Air M1 2020', '1610431863apple-macbook-air-2020-mgnd3saa-600x600.jpg', 8, 1, '28990000', '25000000', 'Apple vừa cho ra mắt phiên bản MacBook Air M1 2020 (MGND3SA/A) mới cực kì ấn tượng với con chip M1 mới được thiết kế dành riêng cho MacBook tăng hiệu suất CPU nhanh hơn tới 3.5 lần, tuổi thọ pin dài nhất từ ​​trước đến nay trên MacBook Air.', 1, 1, 1, '2021-01-12 13:11:03'),
(53, '6', 1, 'Điện thoại iPhone 12 Pro Max 512GB', '1610431804iphone-12-pro-max-xanh-duong-new-600x600-600x600.jpg', 8, 1, '41990000', '37000000', 'iPhone 12 Pro Max 512GB - đẳng cấp từ tên gọi đến từng chi tiết. Ngay từ khi chỉ là tin đồn thì chiếc smartphone này đã làm đứng ngồi không yên bao “fan cứng” nhà Apple, với những nâng cấp vô cùng nổi bật hứa hẹn sẽ mang đến những trải nghiệm tốt nhất về mọi mặt mà chưa một chiếc iPhone tiền nhiệm nào có được.', 1, 1, 1, '2021-01-12 13:10:04'),
(54, '8', 2, 'Laptop Apple MacBook Air 2017 i5', '1610431937apple-macbook-air-mqd32sa-a-i5-5350u-600x600.jpg', 10, 1, '18990000', '14000000', 'MacBook Air 2017 i5 128GB là mẫu laptop văn phòng, có thiết kế siêu mỏng và nhẹ, vỏ nhôm nguyên khối sang trọng. Máy có hiệu năng ổn định, thời lượng pin cực lâu 12 giờ, phù hợp cho hầu hết các nhu cầu làm việc và giải trí. ', 1, 1, 1, '2021-01-12 13:12:17'),
(55, '6', 1, 'Điện thoại iPhone 12 mini 64GB', '1610432001iphone-mini-do-new-600x600-600x600.jpg', 10, 1, '18990000', '14000000', 'iPhone 12 Mini 64 GB tuy là phiên bản thấp nhất trong bộ 4 iPhone 12 vừa mới được ra mắt cách đây không lâu, nhưng vẫn sở hữu những ưu điểm vượt trội về kích thước nhỏ gọn, tiện lợi, hiệu năng đỉnh cao, tính năng sạc nhanh cùng bộ camera chất lượng cao.', 1, 1, 1, '2021-01-12 13:13:21'),
(56, '6', 1, 'Điện thoại iPhone 11 Pro Max 512GB', '1610432040iphone-11-pro-max-512gb-gold-600x600.jpg', 10, 1, '27000000', '24000000', 'Để tìm kiếm một chiếc smartphone có hiệu năng mạnh mẽ và có thể sử dụng mượt mà trong 2-3 năm tới thì không có chiếc máy nào xứng đáng hơn chiếc iPhone 11 Pro Max 512GB mới ra mắt trong năm 2019 của Apple', 1, 1, 1, '2021-01-12 13:14:00'),
(57, '6', 1, 'Điện thoại iPhone 12 Pro 512GB', '1610432094iphone-12-pro-xanh-duong-new-600x600-600x600.jpg', 10, 1, '38990000', '35000000', 'Lại một siêu phẩm nữa của series iPhone 12 được Apple cho ra mắt trong sự kiện “Hi Speed” vừa qua, mang trên mình các yếu tố của một siêu phẩm với nhiều tính năng đặc biệt, hấp dẫn và không ai khác đó chính là iPhone 12 Pro 512 GB.', 1, 1, 1, '2021-01-12 13:14:54'),
(58, '7', 1, 'Điện thoại Samsung Galaxy Z Fold2 5G ', '1610432209samsung-galaxy-z-fold-2-vang-600x600-600x600.jpg', 9, 1, '50000000', '45000000', 'Thuộc dòng smartphone cao cấp, Samsung Galaxy Z Fold2 5G được Samsung trau chuốt không chỉ vẻ ngoài sang trọng, tinh tế mà lẫn cả “nội thất” bên trong đầy mạnh mẽ khiến chiếc smartphone này hoàn toàn xứng đáng để được sở hữu.', 1, 1, 1, '2021-01-12 13:16:49'),
(59, '7', 1, 'Điện thoại Samsung Galaxy Z Fold2 5G', '1610432242samsung-galaxy-z-fold-2-den-600x600.jpg', 10, 1, '50000000', '45000000', 'Samsung Galaxy Z Fold 2 là tên gọi chính thức của điện thoại màn hình gập cao cấp nhất của Samsung. Với nhiều nâng cấp tiên phong về thiết kế, hiệu năng và camera, hứa hẹn đây sẽ là một siêu phẩm thành công tiếp theo đến từ “ông trùm” sản xuất điện thoại lớn nhất thế giới. ', 1, 1, 1, '2021-01-12 13:17:22'),
(60, '7', 1, 'Điện thoại Samsung Galaxy Note 20 Ultra 5G', '1610432277sam-sung-note-20-ultra-vang-dong-600x600.jpg', 10, 1, '29990000', '25000000', 'Samsung Galaxy Note 20 Ultra 5G, mẫu điện thoại flagship cao cấp thuộc dòng Note của Samsung, ra mắt tháng 8/2020 với diện mạo thay đổi cùng những nâng cấp đột phá, đây chắc chắn sẽ là sản phẩm được săn lùng từ những người dùng yêu thích công nghệ cũng như yêu thích smartphone Samsung.', 1, 1, 1, '2021-01-12 13:17:57'),
(61, '7', 1, 'Điện thoại Samsung Galaxy S20+', '1610432315samsung-galaxy-s20-plus-xam-600x600-600x600.jpg', 10, 1, '19890000', '14000000', 'Chiếc điện thoại Samsung Galaxy S20 Plus - Siêu phẩm với thiết kế màn hình tràn viền, hiệu năng đỉnh cao kết hợp cùng nhiều đột phá về công nghệ dẫn đầu thế giới smartphone.', 1, 1, 1, '2021-01-12 13:18:35'),
(62, '26', 2, 'Laptop Dell G5 15 5500 i7', '1610432522dell-g5-15-5500-i7-70228123-094621-024632-600x600.jpg', 10, 1, '34490000', '30000000', 'Laptop Dell G5 15 5500 i7 (70228123) với cấu hình mạnh mẽ, thiết kế đẹp mắt, chiếc laptop Dell này sẽ đem lại trải nghiệm chơi game cực đã, làm việc mượt mà', 1, 1, 1, '2021-01-12 13:22:02'),
(63, '26', 2, 'Laptop Dell XPS 13 9310 i5', '1610432649dell-xps-13-9310-i5-70234076-062021-092010-600x600.jpg', 0, 1, '38490000', '35000000', 'Laptop Dell XPS 13 9310 i5 (70234076) được trang bị bộ vi xử lí thế hệ thứ 11 mới đến từ Intel cùng với thiết kế mỏng nhẹ nhưng nó vẫn mang đến trải nghiệm chơi game tuyệt vời cho giới trẻ.', 1, 0, 1, '2021-01-12 13:24:09'),
(64, '26', 2, 'Laptop Dell XPS 13 9310 i7', '1610432696dell-xps-13-9310-i7-jgnh61-063521-083524-600x600.jpg', 1, 1, '58990000', '55000000', 'Dell XPS 13 9310 i7 (JGNH61) là một chiếc laptop 2 trong 1 mỏng nhẹ và sang trọng, phù hợp cho giới doanh nhân thành đạt. Với hiệu năng vô cùng mạnh mẽ đến từ con chip i7 gen 11, con laptop này sẽ khiến bạn không khỏi ngạc nhiên bởi khả năng vượt trội của nó.', 1, 1, 1, '2021-01-12 13:24:56'),
(65, '26', 2, 'Laptop Dell Vostro 5402 i7 ', '1610432746dell-vostro-5402-i7-70231338-064321-114334-600x600.jpg', 1, 1, '25090000', '20490000', 'Dell Vostro 5402 i7 (70231338) là một lựa chọn đáng tin cậy cho người dùng khi mang trên mình cấu hình tuyệt vời đến từ bộ vi xử lý Intel thế hệ thứ 11, thiết kế tinh tế, bền bỉ cộng với thời lượng pin ấn tượng đến bất ngờ.', 1, 0, 1, '2021-01-12 13:25:46');

-- --------------------------------------------------------

--
-- Table structure for table `shipper`
--

CREATE TABLE `shipper` (
  `shipper_id` int(30) NOT NULL,
  `shippername` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `shipper_status` tinyint(1) NOT NULL,
  `create_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `shipper`
--

INSERT INTO `shipper` (`shipper_id`, `shippername`, `email`, `phone`, `address`, `shipper_status`, `create_date`) VALUES
(3, 'test1', 'test@gmail.com                ', '123456                        ', 'test                                          ', 0, '2020-12-21 23:03:09'),
(4, 'test2', 'test@gmail.com ', '123456 ', 'test ', 0, '2020-12-21 23:03:15'),
(5, 'test3', 'test@gmail.com ', '123456 ', 'test ', 0, '2020-12-21 23:03:19'),
(6, 'test4', 'test@gmail.com ', '123456 ', 'test ', 0, '2020-12-21 23:03:24'),
(7, 'test5', 'test@gmail.com   ', '123456   ', 'test   ', 1, '2020-12-21 23:03:03');

-- --------------------------------------------------------

--
-- Table structure for table `statical`
--

CREATE TABLE `statical` (
  `id` int(30) NOT NULL,
  `invesment` int(30) NOT NULL,
  `collected` int(30) NOT NULL,
  `create_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `statical`
--

INSERT INTO `statical` (`id`, `invesment`, `collected`, `create_date`) VALUES
(1, 110490000, 122570000, '2021-01-12 00:00:00'),
(4, 122000000, 139960000, '2021-01-12 23:12:00');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(30) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `create_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `username`, `password`, `create_date`) VALUES
(1, 'yeahoo123', '123456', '2020-12-22 12:58:21');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`category_id`),
  ADD UNIQUE KEY `category_name` (`category_name`);

--
-- Indexes for table `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`news_id`);

--
-- Indexes for table `newscategory`
--
ALTER TABLE `newscategory`
  ADD PRIMARY KEY (`news_ctgr_id`);

--
-- Indexes for table `order1`
--
ALTER TABLE `order1`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `shipper`
--
ALTER TABLE `shipper`
  ADD PRIMARY KEY (`shipper_id`),
  ADD UNIQUE KEY `username` (`shippername`);

--
-- Indexes for table `statical`
--
ALTER TABLE `statical`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `category_id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `news`
--
ALTER TABLE `news`
  MODIFY `news_id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `newscategory`
--
ALTER TABLE `newscategory`
  MODIFY `news_ctgr_id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `order1`
--
ALTER TABLE `order1`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `product_id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;

--
-- AUTO_INCREMENT for table `shipper`
--
ALTER TABLE `shipper`
  MODIFY `shipper_id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `statical`
--
ALTER TABLE `statical`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
