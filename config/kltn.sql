-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 07, 2020 at 09:04 AM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.11

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
-- Table structure for table `aboutus`
--

CREATE TABLE `aboutus` (
  `content_id` int(11) NOT NULL,
  `content_title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `content_status` tinyint(1) NOT NULL,
  `create_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `aboutus`
--

INSERT INTO `aboutus` (`content_id`, `content_title`, `content`, `content_status`, `create_date`) VALUES
(1, 'Về chúng tôi', '', 1, '2020-10-19 22:45:25'),
(2, 'Liên hệ', '', 1, '2020-10-19 22:45:25');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `category_id` int(11) NOT NULL,
  `parent_id` tinyint(4) NOT NULL,
  `category_name` varchar(255) NOT NULL,
  `category_priority` tinyint(1) NOT NULL,
  `category_status` tinyint(1) NOT NULL,
  `create_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`category_id`, `parent_id`, `category_name`, `category_priority`, `category_status`, `create_date`) VALUES
(1, 0, 'Điện thoại', 0, 1, '2020-10-17 12:19:38'),
(2, 0, 'Laptop', 1, 1, '2020-10-17 12:20:37'),
(3, 0, 'Máy tính bảng', 2, 1, '2020-10-17 12:23:38'),
(4, 0, 'Smartwatch', 3, 1, '2020-10-17 12:23:38'),
(5, 1, 'phụ kiện', 1, 0, '2020-12-04 20:07:40'),
(6, 1, 'Iphone', 0, 1, '2020-10-17 12:37:11'),
(7, 1, 'Samsung', 1, 1, '2020-10-17 12:37:11'),
(8, 2, 'Macbook', 0, 1, '2020-10-17 12:37:11'),
(9, 3, 'Ipad', 0, 1, '2020-10-17 12:37:11'),
(10, 4, 'Samsung watch', 1, 1, '2020-10-17 12:44:06'),
(11, 4, 'Apple watch', 0, 1, '2020-10-17 12:44:06');

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE `news` (
  `news_id` int(11) NOT NULL,
  `news_ctgr_id` int(11) NOT NULL,
  `news_title` varchar(255) NOT NULL,
  `news_image` blob NOT NULL,
  `news_content` text NOT NULL,
  `news_description` varchar(255) NOT NULL,
  `news_author` varchar(255) NOT NULL,
  `news_isHot` tinyint(1) NOT NULL,
  `news_status` tinyint(1) NOT NULL,
  `create_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `news`
--

INSERT INTO `news` (`news_id`, `news_ctgr_id`, `news_title`, `news_image`, `news_content`, `news_description`, `news_author`, `news_isHot`, `news_status`, `create_date`) VALUES
(10, 1, 'Sau bao ngày chờ đợi, cuối cùng Liên minh: Tốc Chiến cũng đã có bản chính thức cho người dùng Việt tải về và trải nghiệm', 0x313630373332363839316c69656e6d696e68746f63636869656e315f383030783435302e6a7067, 'Liên Minh: Tốc chiến là một ứng dụng đang rất được mong đợi tại Việt Nam. Sau nhiều thông tin về thời gian ra mắt chính thức, hôm nay VNG Game Studios đã cho phép các game thủ tải xuống tựa game này.', ' Liên Minh: Tốc chiến là một ứng dụng đang rất được mong đợi tại Việt Nam. Sau nhiều thông tin về thời gian ra mắt chính thức, hôm nay VNG Game Studios đã cho phép các game thủ tải xuống tựa game này.', 'yeahoo1234', 1, 1, '2020-12-07 14:46:48'),
(17, 1, 'Trên tay Samsung Galaxy Watch 3 Titanium: Phiên bản đồng hồ thông minh cao cấp với màu đen lịch lãm dành cho các quý ông', 0x3136303733313832333767616c617879776174636833746974616e69756d2d342d5f3230343878313135302d3830302d726573697a652e6a7067, 'Ngoài những chiếc đồng hồ thông minh truyền thống, Samsung đã cho ra mắt thêm một phiên bản đặc biệt có tên là Galaxy Watch 3 Titanium. Hãy cùng mình đập hộp và trên tay Galaxy Watch 3 Titanium qua bài viết này thôi nào.', ' Ngoài những chiếc đồng hồ thông minh truyền thống, Samsung đã cho ra mắt thêm một phiên bản đặc biệt có tên là Galaxy Watch 3 Titanium. Hãy cùng mình đập hộp và trên tay Galaxy Watch 3 Titanium qua bài viết này thôi nào.', 'yeahoo123', 1, 1, '2020-12-07 12:17:17'),
(18, 1, 'Một smartphone Nokia giá rẻ vừa lộ diện trên TENAA với thiết kế cổ điển, bộ nhớ trong lớn và có cả đèn flash LED mặt trước', 0x313630373331383238386e6f6b69612d302d5f3137383878313030342d3830302d726573697a652e6a7067, 'Hôm qua (5/12), có 2 model smartphone Nokia đạt chứng nhận tại FCC, còn bây giờ, chúng ta có thêm một thiết bị khác và lần này là ở cơ quan TENAA Trung Quốc.', ' Hôm qua (5/12), có 2 model smartphone Nokia đạt chứng nhận tại FCC, còn bây giờ, chúng ta có thêm một thiết bị khác và lần này là ở cơ quan TENAA Trung Quốc.', 'yeahoo123', 1, 1, '2020-12-07 12:18:08'),
(19, 1, 'Cách tải Liên Minh Huyền Thoại Tốc Chiến sever Việt của VNG, có Tiếng Việt', 0x31363037333138333331636163682d7461692d6c69656e2d6d696e682d687579656e2d74686f61692d746f632d636869656e2d766965742d6e616d5f383030783435302e6a7067, 'Như vậy là sau bao ngày chờ đợi, tựa game Liên Minh Huyền Thoại: Tốc Chiến đã có mặt chính thức tại Việt Nam, được phát hành bởi VNG Game. Thỏa lòng tất cả game thủ yêu mến Liên Minh Tốc Chiến của Riot Games và VNG Games. Sau đây là cách tải Liên Minh Tốc Chiến Việt Nam trên điện thoại.', ' Như vậy là sau bao ngày chờ đợi, tựa game Liên Minh Huyền Thoại: Tốc Chiến đã có mặt chính thức tại Việt Nam, được phát hành bởi VNG Game. Thỏa lòng tất cả game thủ yêu mến Liên Minh Tốc Chiến của Riot Games và VNG Games. Sau đây là cách tải Liên Minh Tố', 'yeahoo123', 1, 1, '2020-12-07 12:18:51'),
(20, 1, '[Đang cập nhật] Đánh giá chi tiết iPhone 11 sau 1 năm ra mắt: Vẫn còn rất đáng để các bạn sở hữu đấy', 0x313630373331383335396970686f6e6531312d32315f31323830783732302d3830302d726573697a652e6a7067, 'iPhone 12 chính thức ra mắt đã mang đến cuộc cách mạng trong thiết kế lên những chiếc iPhone của Apple. Câu hỏi đặt ra hôm nay là iPhone 11 có còn đáng mua không? Câu trả lời là có. Bài viết hôm nay mình sẽ đánh giá chi tiết iPhone 11 sau 1 năm ra mắt để giải thích lí do vì sao.', ' iPhone 12 chính thức ra mắt đã mang đến cuộc cách mạng trong thiết kế lên những chiếc iPhone của Apple. Câu hỏi đặt ra hôm nay là iPhone 11 có còn đáng mua không? Câu trả lời là có. Bài viết hôm nay mình sẽ đánh giá chi tiết iPhone 11 sau 1 năm ra mắt để', 'yeahoo123', 1, 1, '2020-12-07 12:19:19'),
(21, 1, '6 tuyệt chiêu bí mật sử dụng Messenger theo phong cách độc lạ mà 90% người dùng không biết', 0x313630373331383432377468756d2d5f3139323078313038302d3830302d726573697a652e6a7067, 'Messenger là một trong những ứng dụng nhắn tin và gọi điện miễn phí được sử dụng trên smartphone phổ biến nhất hiện nay. Không chỉ đơn thuần là một ứng dụng nhắn tin và gọi điện miễn phí Messenger còn mang đến rất nhiều điều bí ẩn mà không phải ai cũng khám phá hết nó. Sau đây mình sẽ chỉ ra 6 bí mật thú vị của Messenger các bạn cùng sử dụng nó. Hãy theo dõi bài viết nhé.', ' Messenger là một trong những ứng dụng nhắn tin và gọi điện miễn phí được sử dụng trên smartphone phổ biến nhất hiện nay. Không chỉ đơn thuần là một ứng dụng nhắn tin và gọi điện miễn phí Messenger còn mang đến rất nhiều điều bí ẩn mà không phải ai cũng k', 'yeahoo123', 1, 1, '2020-12-07 12:20:27');

-- --------------------------------------------------------

--
-- Table structure for table `newscategory`
--

CREATE TABLE `newscategory` (
  `news_ctgr_id` int(11) NOT NULL,
  `news_ctgr_name` varchar(255) NOT NULL,
  `news_ctgr_priority` tinyint(1) NOT NULL,
  `news_ctgr_status` tinyint(1) NOT NULL,
  `create_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `newscategory`
--

INSERT INTO `newscategory` (`news_ctgr_id`, `news_ctgr_name`, `news_ctgr_priority`, `news_ctgr_status`, `create_date`) VALUES
(1, 'Mới nhất', 1, 1, '2020-10-17 12:50:00'),
(2, 'Sự kiện', 1, 1, '2020-10-17 12:50:00');

-- --------------------------------------------------------

--
-- Table structure for table `news_comments`
--

CREATE TABLE `news_comments` (
  `comment_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `news_id` int(11) NOT NULL,
  `content` text NOT NULL,
  `comments_status` int(11) NOT NULL,
  `create_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `news_comments`
--

INSERT INTO `news_comments` (`comment_id`, `user_id`, `news_id`, `content`, `comments_status`, `create_date`) VALUES
(1, 1, 1, '', 1, '2020-10-22 21:56:44');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `product_id` int(11) NOT NULL,
  `category_id` varchar(255) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `product_image` varchar(255) NOT NULL,
  `product_qty` varchar(255) NOT NULL,
  `product_price` varchar(255) NOT NULL,
  `product_description` text NOT NULL,
  `product_priority` tinyint(1) NOT NULL,
  `product_isHot` tinyint(1) NOT NULL,
  `product_status` tinyint(1) NOT NULL,
  `create_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`product_id`, `category_id`, `product_name`, `product_image`, `product_qty`, `product_price`, `product_description`, `product_priority`, `product_isHot`, `product_status`, `create_date`) VALUES
(1, '7', 'Samsung Galaxy Note 20 Ultra', '1607010439black_final.jpg', '100', '22000000', 'Samsung Note 20 Ultra: Thiết kế sang trọng và nhiều công nghệ cực tốt', 1, 1, 1, '2020-12-07 14:48:10'),
(15, '7', 'Samsung Galaxy Note 10+ (Plus)', '1606494673note_10_plus_xanh.jpg', '20', '16300000', 'Samsung Note 10 Plus – Màn hình lớn cho trải nghiệm tuyệt đỉnh, S-Pen tiện dụn', 1, 1, 1, '2020-11-27 23:31:13'),
(16, '7', 'Samsung Galaxy A71', '1606494795a71_bac_3.jpg', '30', '8400000', 'Samsung A71 – Smartphone tầm trung của Samsung', 1, 1, 1, '2020-11-27 23:33:15'),
(17, '7', 'Samsung A51', '1606495445a51_bac.jpg', '40', '6650000', 'Samsung A51 – Chụp ảnh đỉnh cao, trải nghiệm tuyệt vời', 1, 1, 1, '2020-11-27 23:44:05'),
(26, '6', 'Iphone 12', '1607000984iphone-12-400png-400x460.png', '12', '21490000', 'Iphone 12 chính hãng 2 sim', 1, 1, 1, '2020-12-03 20:01:33');

-- --------------------------------------------------------

--
-- Table structure for table `product_comments`
--

CREATE TABLE `product_comments` (
  `comment_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `content` text NOT NULL,
  `comments_status` tinyint(1) NOT NULL,
  `create_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `product_comments`
--

INSERT INTO `product_comments` (`comment_id`, `user_id`, `product_id`, `content`, `comments_status`, `create_date`) VALUES
(1, 1, 1, '', 1, '2020-10-22 21:51:04');

-- --------------------------------------------------------

--
-- Table structure for table `product_images`
--

CREATE TABLE `product_images` (
  `pi_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `pi_images` varchar(255) NOT NULL,
  `pi_status` tinyint(1) NOT NULL,
  `create_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `product_images`
--

INSERT INTO `product_images` (`pi_id`, `product_id`, `pi_images`, `pi_status`, `create_date`) VALUES
(1, 1, '', 1, '2020-10-17 13:08:27'),
(2, 2, '', 1, '2020-10-17 13:08:27'),
(3, 3, '', 1, '2020-10-17 13:08:27'),
(4, 4, '', 1, '2020-10-17 13:08:27'),
(5, 5, '', 1, '2020-10-17 13:08:27');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(30) NOT NULL,
  `email` varchar(30) NOT NULL,
  `phone` varchar(30) NOT NULL,
  `user_status` tinyint(1) NOT NULL,
  `create_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `username`, `password`, `email`, `phone`, `user_status`, `create_date`) VALUES
(1, 'yeahoo123', '123456', 'lamkimson1998@gmail.com', '0335678089', 1, '2020-10-17 13:26:08'),
(2, 'test', 'test', 'test@test.com', '123456789', 1, '2020-10-21 22:56:21');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `aboutus`
--
ALTER TABLE `aboutus`
  ADD PRIMARY KEY (`content_id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`category_id`);

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
-- Indexes for table `news_comments`
--
ALTER TABLE `news_comments`
  ADD PRIMARY KEY (`comment_id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `product_comments`
--
ALTER TABLE `product_comments`
  ADD PRIMARY KEY (`comment_id`);

--
-- Indexes for table `product_images`
--
ALTER TABLE `product_images`
  ADD PRIMARY KEY (`pi_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `aboutus`
--
ALTER TABLE `aboutus`
  MODIFY `content_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `news`
--
ALTER TABLE `news`
  MODIFY `news_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `newscategory`
--
ALTER TABLE `newscategory`
  MODIFY `news_ctgr_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `news_comments`
--
ALTER TABLE `news_comments`
  MODIFY `comment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `product_comments`
--
ALTER TABLE `product_comments`
  MODIFY `comment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `product_images`
--
ALTER TABLE `product_images`
  MODIFY `pi_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
