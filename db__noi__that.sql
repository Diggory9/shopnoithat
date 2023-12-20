-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Dec 20, 2023 at 12:09 AM
-- Server version: 8.0.31
-- PHP Version: 8.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db__noi__that`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

DROP TABLE IF EXISTS `category`;
CREATE TABLE IF NOT EXISTS `category` (
  `category_id` int NOT NULL AUTO_INCREMENT,
  `category_name` varchar(100) NOT NULL,
  `category_description` varchar(500) DEFAULT NULL,
  PRIMARY KEY (`category_id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`category_id`, `category_name`, `category_description`) VALUES
(1, 'Phòng ngủ', '          Nội thất liên quan đên phòng ngủ'),
(2, 'Phòng Khách', 'Nội thất phòng khách mang thiết kế sang trọng          '),
(9, 'Phòng ăn', 'Nội thất liên quan đến phòng ăn          ');

-- --------------------------------------------------------

--
-- Table structure for table `detail_order`
--

DROP TABLE IF EXISTS `detail_order`;
CREATE TABLE IF NOT EXISTS `detail_order` (
  `order_id` int NOT NULL,
  `product_id` int NOT NULL,
  `quantity` int NOT NULL,
  `price` double NOT NULL,
  PRIMARY KEY (`order_id`,`product_id`),
  KEY `product_id` (`product_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

DROP TABLE IF EXISTS `product`;
CREATE TABLE IF NOT EXISTS `product` (
  `product_id` int NOT NULL AUTO_INCREMENT,
  `product_name` varchar(100) NOT NULL,
  `product_des` varchar(2000) NOT NULL,
  `product_price` double NOT NULL,
  `product_stock_quantity` int NOT NULL,
  `category_id` int NOT NULL,
  `supplier_id` int DEFAULT NULL,
  PRIMARY KEY (`product_id`),
  KEY `category_id` (`category_id`),
  KEY `supplier_id` (`supplier_id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`product_id`, `product_name`, `product_des`, `product_price`, `product_stock_quantity`, `category_id`, `supplier_id`) VALUES
(1, 'Giường 1M8 Dolce Rosa ABR101', 'Giới thiệu sản phẩm:\r\n\r\nNếu như bạn là kiểu người yêu thích sự sang trọng, quý phái cho không gian phòng ngủ của mình, chiếc giường Dolce Rosa có kích thước 1m8 này có lẽ là dành cho bạn chứ không phải ai khác.\r\n<br/>\r\nTiện ích nổi bật:\r\n\r\nKhung giường được làm bằng gỗ sồi chống mối mọt và rất bền chắc, kết cấu của giường khá đơn giản và truyền thống với chân giường cách điệu và khá thấp, đầu giường được làm theo phong cách cổ điển đậm chất quý tộc của những nước Âu châu thế kỷ 19.', 55500000, 10, 1, 1),
(16, 'Bàn ăn', 'Bàn ăn 6 người', 123445, 12, 9, 7),
(17, 'Bàn ăn 8 chỗ', '            Bàn ăn 8 người cho gia đình                                    ', 122112, 11, 9, 1),
(18, 'Giường ngủ', 'Giường ngủ 1m8 màu xanh', 21999999, 2, 1, 1),
(19, 'Giường ngủ gỗ', 'Giường ngủ 1m8 màu vàng                         ', 98999999, 3, 1, 1),
(20, 'Sofa', 'Sofa êm ái ', 6999999, 3, 2, 7),
(21, 'Bàn nước', 'Bàn nước tuyệt đẹp', 12344522, 10, 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `product_image`
--

DROP TABLE IF EXISTS `product_image`;
CREATE TABLE IF NOT EXISTS `product_image` (
  `image_id` int NOT NULL AUTO_INCREMENT,
  `product_id` int NOT NULL,
  `image_path` varchar(100) NOT NULL,
  PRIMARY KEY (`image_id`),
  KEY `product_id` (`product_id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `product_image`
--

INSERT INTO `product_image` (`image_id`, `product_id`, `image_path`) VALUES
(1, 1, 'img-grid-1.jpg'),
(2, 1, 'BR101K.png'),
(15, 16, '164a55e3de8e0c5c191625d6e8a2c878.jpg'),
(16, 17, '5e75800150db441a8bd982c9b1f1b702.jpg'),
(17, 18, 'e892ae0372d3439c870a712ad6dab006.jpg'),
(18, 19, 'ba7280b50c96f873123b84501518527c.jpg'),
(19, 20, '031e9ee0521ca2aa68dc497eae1c65f0.jpg'),
(20, 21, '2c43e9a38168d59bfbcad42435fedd06.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

DROP TABLE IF EXISTS `role`;
CREATE TABLE IF NOT EXISTS `role` (
  `role_id` int NOT NULL AUTO_INCREMENT,
  `role_name` varchar(50) NOT NULL,
  PRIMARY KEY (`role_id`),
  UNIQUE KEY `role_name` (`role_name`)
) ENGINE=InnoDB AUTO_INCREMENT=81 DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`role_id`, `role_name`) VALUES
(1, 'admin'),
(2, 'user');

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

DROP TABLE IF EXISTS `supplier`;
CREATE TABLE IF NOT EXISTS `supplier` (
  `supplier_id` int NOT NULL AUTO_INCREMENT,
  `supplier_name` varchar(100) NOT NULL,
  `contact_email` varchar(100) NOT NULL,
  `supplier_phone` varchar(10) NOT NULL,
  `supplier_address` varchar(100) NOT NULL,
  PRIMARY KEY (`supplier_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`supplier_id`, `supplier_name`, `contact_email`, `supplier_phone`, `supplier_address`) VALUES
(1, 'Dolce Rosa', 'DolceRosa@mail.com', '123456789', '123 Malaysia'),
(7, 'NTNT', 'tkmaxao19910@gmail.com1', '0343432432', '180 Cao Lỗ');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `user_id` int NOT NULL AUTO_INCREMENT,
  `user_email` varchar(50) NOT NULL,
  `user_firstname` varchar(50) NOT NULL,
  `user_lastname` varchar(20) NOT NULL,
  `user_phone` varchar(10) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `user_address` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `user_password` varchar(32) NOT NULL,
  `status` decimal(3,0) NOT NULL DEFAULT '0',
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `user_email` (`user_email`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `user_email`, `user_firstname`, `user_lastname`, `user_phone`, `user_address`, `user_password`, `status`) VALUES
(1, 'ndv@gmail.com', 'nd', 'v', '', '', 'e10adc3949ba59abbe56e057f20f883e', '0'),
(3, '123@gmail.com', 'ndv', '1234', '', '', 'e10adc3949ba59abbe56e057f20f883e', '0'),
(4, '131@gmail.com', 'ndv', '123', '', '', 'e10adc3949ba59abbe56e057f20f883e', '0'),
(5, 'admin@admin.com', 'admin', '123', '0358326432', '180 cao lỗ', 'e10adc3949ba59abbe56e057f20f883e', '0'),
(18, 'tkmaxao19910@gmail.com1', 'The1', 'Nguyen', '0358326432', '180 cao lỗ', 'e10adc3949ba59abbe56e057f20f883e', '0'),
(20, 'nkt19910@gmail.com', 'The', 'Nguyen', '0923789778', '180 Cao LO', '96e79218965eb72c92a549dd5a330112', '0'),
(21, 'tkmaxao19910@gmail.com', 'Khắc Thế', 'Nguyễn', '', '', '4297f44b13955235245b2497399d7a93', '0'),
(22, 'tkmaxao19910@gmail.c', 'Khắc Thế', 'Nguyễn', '0358326431', '180 cao lỗ', '4297f44b13955235245b2497399d7a93', '0');

-- --------------------------------------------------------

--
-- Table structure for table `user_order`
--

DROP TABLE IF EXISTS `user_order`;
CREATE TABLE IF NOT EXISTS `user_order` (
  `order_id` int NOT NULL AUTO_INCREMENT,
  `order_date` date NOT NULL,
  `status` decimal(6,0) NOT NULL DEFAULT '0',
  `total_amount` double NOT NULL,
  `consignee_name` varchar(100) DEFAULT NULL,
  `consignee_phone` varchar(100) DEFAULT NULL,
  `consignee_add` varchar(100) DEFAULT NULL,
  `user_id` int NOT NULL,
  `through_user_id` int DEFAULT NULL,
  PRIMARY KEY (`order_id`),
  KEY `user_id` (`user_id`),
  KEY `through_user_id` (`through_user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `user_role`
--

DROP TABLE IF EXISTS `user_role`;
CREATE TABLE IF NOT EXISTS `user_role` (
  `role_id` int NOT NULL,
  `user_id` int NOT NULL,
  PRIMARY KEY (`role_id`,`user_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `user_role`
--

INSERT INTO `user_role` (`role_id`, `user_id`) VALUES
(1, 5);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `detail_order`
--
ALTER TABLE `detail_order`
  ADD CONSTRAINT `detail_order_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `user_order` (`order_id`),
  ADD CONSTRAINT `detail_order_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `product` (`product_id`);

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `product_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `category` (`category_id`),
  ADD CONSTRAINT `product_ibfk_2` FOREIGN KEY (`supplier_id`) REFERENCES `supplier` (`supplier_id`);

--
-- Constraints for table `product_image`
--
ALTER TABLE `product_image`
  ADD CONSTRAINT `product_image_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `product` (`product_id`);

--
-- Constraints for table `user_order`
--
ALTER TABLE `user_order`
  ADD CONSTRAINT `user_order_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`),
  ADD CONSTRAINT `user_order_ibfk_2` FOREIGN KEY (`through_user_id`) REFERENCES `user` (`user_id`);

--
-- Constraints for table `user_role`
--
ALTER TABLE `user_role`
  ADD CONSTRAINT `user_role_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `role` (`role_id`),
  ADD CONSTRAINT `user_role_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
