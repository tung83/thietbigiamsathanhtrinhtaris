-- phpMyAdmin SQL Dump
-- version 4.0.10.14
-- http://www.phpmyadmin.net
--
-- Host: localhost:3306
-- Generation Time: Nov 05, 2016 at 11:47 PM
-- Server version: 5.6.26-cll-lve
-- PHP Version: 5.4.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `taris_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `aboutus`
--

CREATE TABLE IF NOT EXISTS `aboutus` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sum` text NOT NULL,
  `img` text NOT NULL,
  `content` longtext NOT NULL,
  `active` tinyint(1) NOT NULL,
  `dates` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `aboutus`
--

INSERT INTO `aboutus` (`id`, `sum`, `img`, `content`, `active`, `dates`) VALUES
(7, '​Ô TÔ BÌNH LÂM – "HÀI LÒNG CỦA KHÁCH HÀNG CHÍNH LÀ CHÌA KHÓA CỦA THÀNH CÔNG"', '201606504514203167_315943818797271_7530454030804007654_n.jpg', '<div style="text-align: center;"><span style="font-family:arial,helvetica,sans-serif"><strong><img alt="" src="/images/ckfinder/img/14203167_315943818797271_7530454030804007654_n(2).jpg" style="height:300px; width:813px" /></strong></span><br />\r\n&nbsp;</div>\r\n\r\n<div style="text-align: center;"><span style="font-family:arial,helvetica,sans-serif"><span style="font-size:18px"><strong>Ô TÔ BÌNH LÂM &ndash; &quot;HÀI LÒNG CỦA KHÁCH HÀNG CHÍNH LÀ CHÌA KHÓA CỦA THÀNH CÔNG&quot;</strong></span></span></div>\r\n<br />\r\n<span style="font-family:arial,helvetica,sans-serif"><span style="color:#008000"><strong>CÔNG TY TNHH Ô TÔ BÌNH LÂM</strong>&nbsp;</span>phục vụ khách hàng với phương châm &quot;<strong>Hành động nhỏ - Thành công lớn</strong>&quot; để trở thành nhà cung cấp các dịch vụ hàng đầu.<br />\r\nChúng tôi chuyên về:<br />\r\n-&nbsp;&nbsp; &nbsp;Sửa Chữa và Bảo Dưỡng Ô Tô, Sơn Hấp, Liên kết Bảo Hiểm, Bảo dưỡng xe tận nhà<br />\r\n- &nbsp; &nbsp;Chăm sóc xe toàn diện<br />\r\n-&nbsp;&nbsp; &nbsp;Phụ tùng và phụ kiện xe Ô Tô các loại<br />\r\n<strong>Ô TÔ BÌNH LÂM</strong>&nbsp;Với đội ngũ nhân sự giàu kinh nghiệm và chuyên nghiệp&nbsp;trong lĩnh vực sửa chữa các loại ô tô từ dòng xe phổ thông đến dòng xe cao cấp. &nbsp;<br />\r\n<br />\r\n<span style="font-size:14px"><strong>Phương châm hoạt động:</strong></span></span>\r\n\r\n<ol>\r\n	<li><span style="font-family:arial,helvetica,sans-serif"><strong>Chuyên nghiệp trong từng dịch&nbsp;vụ.</strong></span></li>\r\n	<li><span style="font-family:arial,helvetica,sans-serif"><strong>Chất lượng trong từng sản phẩm</strong></span></li>\r\n	<li><span style="font-family:arial,helvetica,sans-serif"><strong>Chu đáo trong cách phục vụ</strong></span></li>\r\n	<li><span style="font-family:arial,helvetica,sans-serif"><strong>Hài lòng trong từng khách hàng</strong></span></li>\r\n</ol>\r\n<span style="font-family:arial,helvetica,sans-serif"> <span style="font-size:14px"><strong>Định hướng hoạt động:</strong></span></span>\r\n\r\n<ul>\r\n	<li><span style="font-family:arial,helvetica,sans-serif"><strong>Đảm bảo chất lượng.</strong></span></li>\r\n	<li><span style="font-family:arial,helvetica,sans-serif"><strong>Công nghệ tiên tiến.</strong></span></li>\r\n	<li><span style="font-family:arial,helvetica,sans-serif"><strong>Giá cả hợp lý, cạnh tranh.</strong></span></li>\r\n	<li><span style="font-family:arial,helvetica,sans-serif"><strong>Thanh toán, vận chuyển nhanh gọn.</strong></span></li>\r\n	<li><span style="font-family:arial,helvetica,sans-serif"><strong>Phục vụ tận tâm, chuyên nghiệp .</strong></span></li>\r\n</ul>\r\n<span style="font-family:arial,helvetica,sans-serif"> Với tâm huyết&nbsp;<strong>&ldquo;Cùng khách hàng đi đến thành công &ndash; Hài lòng làm nên sự khác biệt&rdquo;,</strong>&nbsp;<strong>Ô TÔ BÌNH LÂM</strong>&nbsp;luôn đặt lợi ích của khách hàng lên hàng đầu.</span>\r\n\r\n<div style="text-align: center;">&nbsp;</div>\r\n', 1, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `id` text NOT NULL,
  `name` text NOT NULL,
  `level` int(11) NOT NULL,
  `pwd` varchar(250) NOT NULL,
  `lastOnl` datetime NOT NULL,
  `dates` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `name`, `level`, `pwd`, `lastOnl`, `dates`) VALUES
('wnadmin', 'Administrator', 1, '7a166e7b3eaaebcc68ab8ce2a524ab5e', '2014-11-14 02:39:33', '2013-03-27 10:55:02'),
('kidside', 'Administrator', 1, '949530644ef43dad3857cf6fbbbe10c1', '2016-11-01 06:53:43', '2013-11-13 13:56:10'),
('aaaaa', 'aaaaaaaaaaaaaaaaaaaaaaaa', 1, '594f803b380a41396ed63dca39503542', '2015-04-21 12:51:01', '2015-04-21 12:50:55');

-- --------------------------------------------------------

--
-- Table structure for table `banner`
--

CREATE TABLE IF NOT EXISTS `banner` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` text NOT NULL,
  `img` text NOT NULL,
  `lnk` text NOT NULL,
  `active` tinyint(1) NOT NULL,
  `ind` int(11) NOT NULL,
  `dates` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=24 ;

--
-- Dumping data for table `banner`
--

INSERT INTO `banner` (`id`, `title`, `img`, `lnk`, `active`, `ind`, `dates`) VALUES
(23, '', '041827052016slide3.jpg', 'otobinhlam.com.vn', 1, 1, '2016-09-05 04:18:27');

-- --------------------------------------------------------

--
-- Table structure for table `brand`
--

CREATE TABLE IF NOT EXISTS `brand` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text CHARACTER SET utf8 NOT NULL,
  `img` text CHARACTER SET utf8 NOT NULL,
  `ind` int(11) NOT NULL,
  `active` tinyint(1) NOT NULL,
  `pId` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=21 ;

--
-- Dumping data for table `brand`
--

INSERT INTO `brand` (`id`, `name`, `img`, `ind`, `active`, `pId`) VALUES
(19, 'ĐỒ CHƠI XE HƠI', '0406240120162.jpg', 1, 1, 0),
(20, 'TRANG TRÍ NỘI THẤT', '0410010120166.jpg', 2, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE IF NOT EXISTS `contact` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text NOT NULL,
  `company` text NOT NULL,
  `adds` text NOT NULL,
  `phone` text NOT NULL,
  `fax` text NOT NULL,
  `email` text NOT NULL,
  `content` text NOT NULL,
  `dates` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE IF NOT EXISTS `groups` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text CHARACTER SET utf8 NOT NULL,
  `ind` int(11) NOT NULL,
  `active` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`id`, `name`, `ind`, `active`) VALUES
(1, 'Xe', 1, 1),
(2, 'Phụ kiện', 2, 1),
(3, 'Nội thất xe', 3, 1);

-- --------------------------------------------------------

--
-- Table structure for table `kind`
--

CREATE TABLE IF NOT EXISTS `kind` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text CHARACTER SET utf8 NOT NULL,
  `ind` int(11) NOT NULL,
  `active` tinyint(1) NOT NULL,
  `pId` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=64 ;

--
-- Dumping data for table `kind`
--

INSERT INTO `kind` (`id`, `name`, `ind`, `active`, `pId`) VALUES
(1, 'Triton', 1, 1, 2),
(2, 'Pajero Sport', 2, 1, 2),
(3, 'HILUX', 1, 1, 3),
(4, 'LAND CRUISER PRADO', 2, 1, 3),
(5, 'LAND CRUISER', 3, 1, 3),
(6, 'INNOVA', 4, 1, 3),
(7, 'FORTUNER', 5, 1, 3),
(8, 'VIOS', 6, 1, 3),
(9, 'COROLLA ALTIS', 7, 1, 3),
(10, 'CAMRY', 8, 1, 3),
(11, 'CIVIC', 1, 1, 4),
(12, 'ACCORD', 2, 1, 4),
(13, 'CRV', 3, 1, 4),
(14, 'RANGER', 1, 1, 5),
(15, 'FESTA', 2, 1, 5),
(16, 'FOCUS', 3, 1, 5),
(17, 'EVEREST', 4, 1, 5),
(18, 'ESCAPE', 5, 1, 5),
(19, 'MONDEO', 6, 1, 5),
(20, 'CARNIVAL', 1, 1, 10),
(21, 'MORNING', 2, 1, 10),
(22, 'FORTE', 3, 1, 10),
(23, 'CAREN S', 4, 1, 10),
(24, 'CERATO', 5, 1, 10),
(25, 'SORENTO', 6, 1, 10),
(26, 'SPORTAGE', 7, 1, 10),
(27, 'D-MAX', 1, 1, 11),
(28, 'BT50', 1, 1, 12),
(29, 'CAPTIVA', 1, 1, 13),
(30, 'CRUZE', 2, 1, 13),
(31, 'NAVARA', 1, 1, 14),
(32, 'NIVINA', 2, 1, 14),
(33, 'FORD RANGER', 1, 1, 1),
(34, 'TOYOTA HILUX - VIGO', 2, 1, 1),
(35, 'MITSUBISHI TRITON', 3, 1, 1),
(36, 'NISSAN NAVARA', 4, 1, 1),
(37, 'ISUZU D-MAX', 5, 1, 1),
(38, 'MAZDA BT50', 6, 1, 1),
(39, 'CHERVOLET COROLONDO', 7, 1, 1),
(40, 'RUNNER', 9, 1, 3),
(41, 'VENZA', 10, 1, 3),
(42, 'CHEVROLET', 1, 1, 7),
(43, 'FORD', 2, 1, 7),
(44, 'TOYOTA', 3, 1, 7),
(45, 'MAZDA', 4, 1, 7),
(46, 'MITSUBISHI', 5, 1, 7),
(47, 'COROLONDO', 0, 1, 13),
(48, 'CX5', 2, 1, 12),
(49, 'CX9', 3, 1, 12),
(50, 'MAZDA 3', 4, 1, 12),
(51, 'MAZDA 6', 5, 1, 12),
(52, 'DVD', 1, 1, 9),
(53, 'TV', 2, 1, 9),
(54, 'ÂM THANH', 3, 1, 9),
(55, 'KIA', 6, 1, 7),
(56, 'LƯỚT GIO CAPO', 1, 1, 18),
(57, 'MẶT GALANG ĐỘ', 2, 1, 18),
(58, 'SÁP THƠM', 1, 1, 19),
(59, 'PHIM CÁCH NHIỆT', 2, 1, 19),
(60, 'MÀN HÌNH DVD', 3, 1, 19),
(61, 'PHỦ NANO CHO XEM LUÔN SÁNG ĐẸP', 1, 1, 20);

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE IF NOT EXISTS `menu` (
  `id` int(11) NOT NULL DEFAULT '0',
  `name` text CHARACTER SET utf8 NOT NULL,
  `ind` int(11) NOT NULL,
  `view` text CHARACTER SET utf8 NOT NULL,
  `active` tinyint(1) NOT NULL,
  `pos` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`id`, `name`, `ind`, `view`, `active`, `pos`) VALUES
(1, 'Trang Chủ', 1, 'trang-chu', 1, 1),
(2, 'Sản Phẩm', 3, 'san-pham', 1, 1),
(3, 'Dịch Vụ', 2, 'dich-vu', 1, 1),
(4, 'Tin Tức', 4, 'tin-tuc', 1, 1),
(5, 'Giới Thiệu', 2, 'gioi-thieu', 1, 2),
(6, 'Liên Hệ', 6, 'lien-he', 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE IF NOT EXISTS `news` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` text NOT NULL,
  `sum` text NOT NULL,
  `img` text NOT NULL,
  `content` longtext NOT NULL,
  `hot` tinyint(1) NOT NULL,
  `active` tinyint(1) NOT NULL,
  `dates` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `news`
--

INSERT INTO `news` (`id`, `title`, `sum`, `img`, `content`, `hot`, `active`, `dates`) VALUES
(3, 'Hyundai Accent ra bản tiết kiệm xăng, giá từ 551,2 triệu đồng', 'Hyundai Accent Blue 2015 vừa mới ra mắt sẽ cải tiến thêm một số nét về thiết kế và động cơ để tiết kiệm nhiên liệu hơn.', '2014161525accentblue.jpg', '<div class="sapo-news-detail">\r\n<h2><span style="font-size:14px">Hyundai Accent Blue 2015 vừa mới ra mắt sẽ cải tiến thêm một số nét về thiết kế và động cơ để tiết kiệm nhiên liệu hơn.</span></h2>\r\n</div>\r\n\r\n<p><span style="font-size:14px">Là cái tên được biết đến nhiều trong phân khúc xe hạng B, Hyundai Accent là mẫu xe được nhóm đối tượng khách hàng lần đầu mu axe khá có thiện cảm. Hyundai Thành Công chính thức cho ra mắt phiên bản mới Accent Blue 2015 được nhà sản xuất công bố là tiết kiệm nhiên liệu hơn.</span></p>\r\n\r\n<p><span style="font-size:14px">Về thiết kế, Hyundai Accent Blue 2015 không có nhiều đổi khác, với cụm đèn trước dạng projecter, cùng hệ thống LED định vị, hệ thống đèn auto (tự động bật tắt tùy theo điều kiện ánh sáng. Xe trang bị la-zăng 16 inch, bên cạnh đó cốp sau có thể mở bằng điều khiển từ xa rất tiện dụng.</span></p>\r\n\r\n<p><span style="font-size:14px">Trang bị tiện nghi trên Accent Blue 2015 có thể kể đến như: nội thất ghế da; vô lăng trợ lực điện tích hợp các phím điều khiển chức năng; cửa sổ trời; hệ thống giải trí MP3, USB, CD với 6 loa; gương chiếu hậu chỉnh điện và sấy...</span></p>\r\n\r\n<p><span style="font-size:14px">Accent Blue 2015 được trang bị động cơ Kappa 1.4L mới nhất với công suất cực đại 100ps tại 6.000 vòng/phút, mô-men xoắn cực đại đạt 13,6 kg.m tại vòng tua 4.000 vòng/phút. Xe có 2 lựa chọn hộp số là số sàn 6 cấp hoặc số tự động vô cấp CVT, bản hatchback chỉ trang bị hộp số tự động CVT.</span></p>\r\n\r\n<p><span style="font-size:14px">Với việc sử dụng công nghệ Dual-CVVT, Hyundai cho biết động cơ Kappa mới có khả năng tiết kiệm nhiên liệu tới 4% so với thế hệ trước đó. Ngoài ra trên tất cả các phiên bản Accent Blue 2015, Hyundai đều trang bị gói tiết kiệm nhiên liệu và thân thiện môi trường Blue bao gồm: hệ thống quản lý quá trình nạp ắc quy, tấm chắn trước bánh xe hạn chế gió xoáy... Đây là điểm khác biệt lớn nhất ở mẫu xe này.</span></p>\r\n\r\n<p><span style="font-size:14px">Accent Blue 2015 được trang bị đầy đủ các hệ thống an toàn: cảnh báo lùi; hệ thống chống bó cứng phanh ABS, phanh đĩa cả trước và sau; 2 túi khí phía trước cho phiên bản số tự động AT.</span></p>\r\n\r\n<p><span style="font-size:14px">Hyundai Accent Blue 2015 hiện đã có mặt tại tất cả các đại lý ủy quyền của Hyundai Thành Công trên toàn quốc với 5 màu sắc lựa chọn: Trắng, Bạc, Đỏ, Xanh và Đen với giá bán lẻ đề nghị như sau (đã bao gồm thuế nhập khẩu, thuế tiêu thụ đặc biệt, thuế GTGT):</span></p>\r\n\r\n<p><span style="font-size:14px">Accent Blue sedan 1.4 MT: 551,200,000 VNĐ</span></p>\r\n\r\n<p><span style="font-size:14px">Accent Blue sedan 1.4 CVT: 599,000,000 VNĐ</span></p>\r\n\r\n<p><span style="font-size:14px">Accent Blue hatchback 1.4 CVT: 569,000,000 VNĐ</span></p>\r\n\r\n<div class="VCSortableInPreviewMode" style="display: inline-block; width: 100%; text-align: center; box-sizing: border-box; position: relative;">\r\n<div><span style="font-size:14px"><img alt="" id="img_13597" src="http://autopro5.vcmedia.vn/thumb_w/640/2014/accent-blue-2015-3-1418636711651.jpg" style="cursor:none; max-width:100%" title="" /></span></div>\r\n\r\n<div class="PhotoCMS_Caption">&nbsp;</div>\r\n</div>\r\n\r\n<div class="VCSortableInPreviewMode" style="display:inline-block;width:100%; text-align:center;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;">\r\n<div><span style="font-size:14px"><img alt="" id="img_13592" src="http://autopro5.vcmedia.vn/thumb_w/640/2014/accent-blue-2015-10-1418636711674.jpg" style="cursor:none; max-width:100%" title="" /></span></div>\r\n\r\n<div class="PhotoCMS_Caption">&nbsp;</div>\r\n</div>\r\n\r\n<div class="VCSortableInPreviewMode" style="display:inline-block;width:100%; text-align:center;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;">\r\n<div><span style="font-size:14px"><img alt="" id="img_13593" src="http://autopro5.vcmedia.vn/thumb_w/640/2014/accent-blue-2015-14-1418636711687.jpg" style="cursor:none; max-width:100%" title="" /></span></div>\r\n\r\n<div class="PhotoCMS_Caption">&nbsp;</div>\r\n</div>\r\n\r\n<div class="VCSortableInPreviewMode" style="display:inline-block;width:100%; text-align:center;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;">\r\n<div><span style="font-size:14px"><img alt="" id="img_13594" src="http://autopro5.vcmedia.vn/thumb_w/640/2014/accent-blue-2015-11-1418636711677.jpg" style="cursor:none; max-width:100%" title="" /></span></div>\r\n\r\n<div class="PhotoCMS_Caption">&nbsp;</div>\r\n</div>\r\n\r\n<div class="VCSortableInPreviewMode" style="display:inline-block;width:100%; text-align:center;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;">\r\n<div><span style="font-size:14px"><img alt="" id="img_13595" src="http://autopro5.vcmedia.vn/thumb_w/640/2014/accent-blue-2015-9-1418636711671.jpg" style="cursor:none; max-width:100%" title="" /></span></div>\r\n\r\n<div class="PhotoCMS_Caption">&nbsp;</div>\r\n</div>\r\n\r\n<div class="VCSortableInPreviewMode" style="display:inline-block;width:100%; text-align:center;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;">\r\n<div><span style="font-size:14px"><img alt="" id="img_13596" src="http://autopro5.vcmedia.vn/thumb_w/640/2014/accent-blue-2015-5-1418636711658.jpg" style="max-width:100%" title="" /></span></div>\r\n\r\n<div class="PhotoCMS_Caption">&nbsp;</div>\r\n</div>\r\n\r\n<div class="VCSortableInPreviewMode" style="display:inline-block;width:100%; text-align:center;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;">\r\n<div><span style="font-size:14px"><img alt="" id="img_13598" src="http://autopro5.vcmedia.vn/thumb_w/640/2014/accent-blue-2015-16-1418636711690.jpg" style="max-width:100%" title="" /></span></div>\r\n\r\n<div class="PhotoCMS_Caption">&nbsp;</div>\r\n</div>\r\n\r\n<div class="VCSortableInPreviewMode" style="display:inline-block;width:100%; text-align:center;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;">\r\n<div><span style="font-size:14px"><img alt="" id="img_13599" src="http://autopro5.vcmedia.vn/thumb_w/640/2014/accent-blue-2015-23-1418636711693.jpg" style="max-width:100%" title="" /></span></div>\r\n\r\n<div class="PhotoCMS_Caption">&nbsp;</div>\r\n</div>\r\n\r\n<div class="VCSortableInPreviewMode" style="display:inline-block;width:100%; text-align:center;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;">\r\n<div><span style="font-size:14px"><img alt="" id="img_13600" src="http://autopro5.vcmedia.vn/thumb_w/640/2014/accent-blue-2015-13-1418636711683.jpg" style="max-width:100%" title="" /></span></div>\r\n\r\n<div class="PhotoCMS_Caption">&nbsp;</div>\r\n</div>\r\n\r\n<div class="VCSortableInPreviewMode" style="display:inline-block;width:100%; text-align:center;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;">\r\n<div><span style="font-size:14px"><img alt="" id="img_13601" src="http://autopro5.vcmedia.vn/thumb_w/640/2014/accent-blue-2015-7-1418636711664.jpg" style="max-width:100%" title="" /></span></div>\r\n\r\n<div class="PhotoCMS_Caption">&nbsp;</div>\r\n</div>\r\n\r\n<div class="VCSortableInPreviewMode" style="display:inline-block;width:100%; text-align:center;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;">\r\n<div><span style="font-size:14px"><img alt="" id="img_13602" src="http://autopro5.vcmedia.vn/thumb_w/640/2014/accent-blue-2015-6-1418636711661.jpg" style="max-width:100%" title="" /></span></div>\r\n\r\n<div class="PhotoCMS_Caption" style="-webkit-user-select: none;">&nbsp;</div>\r\n</div>\r\n\r\n<div class="VCSortableInPreviewMode" style="display:inline-block;width:100%; text-align:center;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;">\r\n<div><span style="font-size:14px"><img alt="" id="img_13603" src="http://autopro5.vcmedia.vn/thumb_w/640/2014/accent-blue-2015-12-1418636711680.jpg" style="cursor:none; max-width:100%" title="" /></span></div>\r\n\r\n<div class="PhotoCMS_Caption">&nbsp;</div>\r\n</div>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<div><span style="font-size:14px"><img alt="" id="img_13604" src="http://autopro5.vcmedia.vn/thumb_w/640/2014/accent-blue-2015-8-1418636711667.jpg" style="cursor:zoom-in; max-width:100%" title="" /></span></div>\r\n', 1, 1, '2014-11-30 15:33:11'),
(4, 'Chevrolet Impala Midnight Edition - Xe sedan đậm chất cơ bắp', 'Chevrolet hiện đang tiến hành phát triển phiên bản thương mại cho mẫu Impala Blackout Concept mà hãng giới thiệu cách đây không lâu tại triển lãm SEMA', '2014161148chevroletimpala.jpg', '<div class="sapo-news-detail">\r\n<h2 style="text-align:justify">Hiện tại giá Chevrolet Impala Midnight Edition vẫn chưa được công bố, tuy nhiên xe có công suất 305 mã lực khá mạnh mẽ, cùng với đó là thiết kế đậm chất hầm hố.</h2>\r\n</div>\r\n\r\n<p style="text-align:justify"><span style="font-size:14px">Chevrolet hiện đang tiến hành phát triển phiên bản thương mại cho mẫu Impala Blackout Concept mà hãng giới thiệu cách đây không lâu tại triển lãm SEMA.</span></p>\r\n\r\n<p style="text-align:justify"><span style="font-size:14px">Bản thương mại của mẫu concept nói trên sẽ có tên là Chevrolet Impala Midnight Edition, xe sẽ vẫn mang các đặc trưng phong cách và diện mạo hầm hố và cơ bắp&nbsp;của bản conccpet. Dự kiến xe sẽ có mặt tại các showroom của Chevrolet trong 4 đến 5 tháng tới.</span></p>\r\n\r\n<div class="VCSortableInPreviewMode" style="display:inline-block;width:100%; text-align:center;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;">\r\n<div style="text-align: justify;"><span style="font-size:14px"><img alt="" id="img_13645" src="http://autopro5.vcmedia.vn/thumb_w/640/2014/chevrolet-impala-blackout-2-1418714922089.jpg" style="cursor:none; max-width:100%" title="" /></span></div>\r\n</div>\r\n\r\n<p style="text-align:justify"><span style="font-size:14px">Ông Steve Majoros, giám đốc marketing của Chevrolet cho biết hãng sẽ có gắng ra mắt mẫu xe này trong đầu năm sau. Nếu mọi thứ đi đúng hướng, bản thương mại Chevrolet Impala Midnight Edition sẽ được bán ra trên thị trường vào mùa xuân năm sau. Hiện tại hãng vẫn chưa công bố thông tin về giá thành của mẫu xe này.</span></p>\r\n\r\n<p style="text-align:justify"><span style="font-size:14px">Ông Majoros cho biết Impala Midnight Edition sẽ có lưới tản nhiệt tối màu, logo Chevrolet cũng có màu đen, viền bóng, không còn màu vàng truyền thống, vô lăng của xe cũng được hãng thiết kế lại. &quot;Màu đen mờ hiện đang là xu hướng. Ta có thể thấy rất nhiều xe trang bị lazăng màu khói xám hoặc đen.&quot;</span></p>\r\n\r\n<p style="text-align:justify"><span style="font-size:14px">Ngoại hình của Chevrolet Impala Midnight Edition 2015 sẽ rất giống với mẫu concept, đặc biệt là do nhiều trang bị ở bản concept đều được lấy từ phụ kiện&nbsp;tùy chọn của Chevrolet.</span></p>\r\n\r\n<p style="text-align:justify"><span style="font-size:14px">Phiên bản thương mại sẽ có lưới tàn nhiệt màu đen như bản concept, bên cạnh đó là ốp viền gương chiếu hậu, cánh gió đuôi và lazăng nhôm 19 inch. Nội thất của xe được bọc da màu đen, pedal thể thao và các tấm ốp có hoa văn lưới.</span></p>\r\n\r\n<p style="text-align:justify"><span style="font-size:14px">Về sức mạnh, Chevrolet Impala Midnight Edition sẽ được trang bị động cơ V6 3.6L, sản sinh công suất 305 mã lực và mômen xoắn cực đại 358 Nm.</span></p>\r\n', 1, 1, '2014-11-30 15:37:18'),
(5, 'Xem đại lý 2 triệu USD của Chevrolet Việt Nam', 'Đại lý mới khai trương của Chevrolet tại Hà Đông được đầu tư gần 2 triệu Đôla Mỹ, xây dựng theo tiêu chuẩn Chevrolet toàn cầu, tổng diện tích 4.400m2.', '2014161908chevrolet.jpg', '<span style="font-size:14px"><img alt="Xem đại lý 2 triệu USD của Chevrolet Việt Nam" src="http://autopro5.vcmedia.vn/zoom/650_365/2014/chevrolet-1418619461957-crop1418619478917p.jpg" style="cursor:none; width:650px" title="Xem đại lý 2 triệu USD của Chevrolet Việt Nam" /></span>\r\n<div class="sapo-news-detail">\r\n<h2><strong><span style="font-size:14px">Đại lý mới khai trương của Chevrolet tại Hà Đông được đầu tư gần 2 triệu Đôla Mỹ, xây dựng theo tiêu chuẩn Chevrolet toàn cầu, tổng diện tích 4.400m2.</span></strong></h2>\r\n</div>\r\n\r\n<p><span style="font-size:14px">Chevrolet Hà Nội mới khai trương tại Hà Đông, Hà Nội là đại lý hiện đại nhất của GM tại Việt Nam. Việc khai trương đại lý này sẽ giúp mở rộng phạm vi hoạt động của Chevrolet tại Hà Nội nhằm phục vụ tốt hơn các khách hàng về cả bán hàng và dịch vụ.</span></p>\r\n\r\n<p><span style="font-size:14px">Với vốn đầu tư gần 2 triệu đô la Mỹ, Chevrolet Hà Nội được xây dựng theo tiêu chuẩn Chevrolet toàn cầu. Đây là một trong những đại lý Chevrolet quy mô nhất tại Việt Nam với tổng diện tích xây dựng 4.400m2 bao gồm phòng trưng bày với diện tích 500m2 và khu vực dịch vụ 2.000m2. Đại lý có cơ sở vật chất và trang thiết bị hiện đại, tiện nghi nhất trong số những đại lý Chevrolet được xây dựng tại Việt Nam.<br />\r\n<br />\r\nNguồn: VnExpress.net</span></p>\r\n', 1, 1, '2014-12-16 15:19:08'),
(6, 'Ford Explorer Limited 2016 đầu tiên tại Việt Nam', 'Mẫu xe SUV cỡ lớn Ford Explorer Limited 2016 thế hệ mới đầu tiên vừa có mặt tại Việt Nam thông qua một salon tư nhân ở TPHCM. Xe sử dụng động cơ mới 2.3 Ecoboost cùng hộp số tự động 6 cấp - dẫn động 4 bánh AWD.', '2016111744Capture.PNG', '<div style="margin: 0px; padding: 0px; color: rgb(20, 20, 20); font-family: Arial, Helvetica, Times New Roman, Times, serif; font-size: 15px; line-height: 24px; text-align: justify; background-color: rgb(252, 252, 255);">&nbsp;​</div>\r\n\r\n<div style="text-align: justify;"><br />\r\n<span style="background-color:rgb(252, 252, 255); color:rgb(20, 20, 20); font-family:arial,helvetica,times new roman,times,serif; font-size:15px">Mẫu xe SUV cỡ lớn&nbsp;</span><a class="Tinhte_XenTag_TagLink" href="https://www.otosaigon.com/tags/ford+explorer/" style="color: rgb(179, 77, 0); text-decoration: none; border-radius: 5px; padding: 0px 3px; margin: 0px -3px; font-family: Arial, Helvetica, Times New Roman, Times, serif; font-size: 15px; line-height: 24px; background-color: rgb(252, 252, 255);">Ford Explorer</a><span style="background-color:rgb(252, 252, 255); color:rgb(20, 20, 20); font-family:arial,helvetica,times new roman,times,serif; font-size:15px">&nbsp;</span><a class="Tinhte_XenTag_TagLink" href="https://www.otosaigon.com/tags/limited/" style="color: rgb(179, 77, 0); text-decoration: none; border-radius: 5px; padding: 0px 3px; margin: 0px -3px; font-family: Arial, Helvetica, Times New Roman, Times, serif; font-size: 15px; line-height: 24px; background-color: rgb(252, 252, 255);">Limited</a><span style="background-color:rgb(252, 252, 255); color:rgb(20, 20, 20); font-family:arial,helvetica,times new roman,times,serif; font-size:15px">&nbsp;2016 thế hệ mới đầu tiên vừa có mặt tại Việt Nam thông qua một salon tư nhân ở TPHCM. Xe sử dụng động cơ mới 2.3&nbsp;</span><a class="Tinhte_XenTag_TagLink" href="https://www.otosaigon.com/tags/ecoboost/" style="color: rgb(179, 77, 0); text-decoration: none; border-radius: 5px; padding: 0px 3px; margin: 0px -3px; font-family: Arial, Helvetica, Times New Roman, Times, serif; font-size: 15px; line-height: 24px; background-color: rgb(252, 252, 255);">Ecoboost</a><span style="background-color:rgb(252, 252, 255); color:rgb(20, 20, 20); font-family:arial,helvetica,times new roman,times,serif; font-size:15px">&nbsp;cùng hộp số tự động 6 cấp - dẫn động 4 bánh AWD.</span><br />\r\n<br />\r\n<span style="background-color:rgb(252, 252, 255); color:rgb(20, 20, 20); font-family:arial,helvetica,times new roman,times,serif; font-size:15px">Chiếc Explorer Limited mới có mặt tại Việt Nam được trang bị động cơ EcoBoost 4 xi-lanh, dung tích 2.3L, công suất 280 mã lực và mô-men xoắn cực đại 406 Nm. Đi kèm hộp số tự động 6 cấp và dẫn động cầu trước là tiêu chuẩn, và hệ dẫn động 4 bánh toàn thời gian là tùy chọn. Mức tiêu thụ nhiên liệu của khối động cơ này rơi vào khoảng 9,3L / 100km với dẫn động cầu trước và 8,9L / 100km với dẫn động bốn bánh AWD.</span><br />\r\n<br />\r\n<span style="background-color:rgb(252, 252, 255); color:rgb(20, 20, 20); font-family:arial,helvetica,times new roman,times,serif; font-size:15px">Về diện mạo,&nbsp;</span><a class="Tinhte_XenTag_TagLink" href="https://www.otosaigon.com/tags/ford/" style="color: rgb(179, 77, 0); text-decoration: none; border-radius: 5px; padding: 0px 3px; margin: 0px -3px; font-family: Arial, Helvetica, Times New Roman, Times, serif; font-size: 15px; line-height: 24px; background-color: rgb(252, 252, 255);">Ford</a><span style="background-color:rgb(252, 252, 255); color:rgb(20, 20, 20); font-family:arial,helvetica,times new roman,times,serif; font-size:15px">&nbsp;Explorer 2016 có khá nhiều thay đổi. Trong đó, dễ nhận thấy nhất là cản trước được thiết kế mới, lưới tản nhiệt được tinh chỉnh lại và cụm đèn pha được thiết kế ấn tượng. Phần đuôi xe cũng được Ford can thiệp với nhiều thay đổi như đèn hậu mới, cánh gió sau được tối ưu hóa giúp giảm lực cản không khí.</span><br />\r\n&nbsp;</div>\r\n\r\n<div style="margin: 0px; padding: 0px; color: rgb(20, 20, 20); font-family: Arial, Helvetica, Times New Roman, Times, serif; font-size: 15px; line-height: 24px; text-align: justify; background-color: rgb(252, 252, 255);"><img alt="Ford Explorer 2016 7.JPG" class="LbImage bbCodeImage" src="https://www.otosaigon.com/attachments/ford-explorer-2016-7-jpg.467771/" style="border:0px; color:rgb(20, 20, 20); font-family:arial,helvetica,times new roman,times,serif; font-size:15px; line-height:24px; max-width:100%; text-align:center" />​</div>\r\n\r\n<div style="text-align: justify;"><br />\r\n<span style="background-color:rgb(252, 252, 255); color:rgb(20, 20, 20); font-family:arial,helvetica,times new roman,times,serif; font-size:15px">Không gian nội thất của Explorer 2016 cũng được đầu tư vật liệu chất lượng cao hơn phiên bản trước, bảng điều khiển trung tâm được thiết kế với những nút bấm rõ ràng. Mặc dù thay đổi này có phần hơi thô nhưng nó lại khiến khách hàng rất hài lòng.</span><br />\r\n<br />\r\n<span style="background-color:rgb(252, 252, 255); color:rgb(20, 20, 20); font-family:arial,helvetica,times new roman,times,serif; font-size:15px">Những trang bị tiêu chuẩn bao gồm đèn pha tự động dạng LED, đèn hậu LED, cửa kính đen chống nắng, giá để đồ trên nóc xe, camera chiếu hậu, kiểm soát hành trình, điều hoà tự động, hàng ghế 2 chia tỷ lệ 60/40 và hàng ghế thứ 3 được phân chia tỷ lệ 50/50, ghế lái điều chỉnh điện 6 hướng (ngả thủ công), vô lăng gật gù, màn hình hiển thị 4,2 inch, hệ thống Sync &ndash; giao diện giải trí bằng giọng nói của Ford, kết nối Bluetooth, hệ thống âm thanh 6 loa với một đầu CD, jack âm thanh phụ trợ và một cổng USB.</span><br />\r\n&nbsp;</div>\r\n\r\n<div style="margin: 0px; padding: 0px; color: rgb(20, 20, 20); font-family: Arial, Helvetica, Times New Roman, Times, serif; font-size: 15px; line-height: 24px; text-align: justify; background-color: rgb(252, 252, 255);"><img alt="Ford Explorer 2016 6.JPG" class="LbImage bbCodeImage" src="https://www.otosaigon.com/attachments/ford-explorer-2016-6-jpg.467770/" style="border:0px; max-width:100%" />​</div>\r\n\r\n<div style="text-align: justify;"><br />\r\n<span style="background-color:rgb(252, 252, 255); color:rgb(20, 20, 20); font-family:arial,helvetica,times new roman,times,serif; font-size:15px">Trong khi đó, ở Limited, Ford Explorer 2016 sở hữu bánh xe 20 inch, ngoại thất mạ crôm, gương chiếu hậu ngoài gấp tự động, camera phía trước, mở cốp xe rảnh tay, chân ga điện có thể điều chỉnh, ghế trước làm mát, hàng ghế 2 sưởi điện, hàng ghế 3 gập điện dễ dàng, ghế hành khách có thể điều chỉnh 8 hướng, vô lăng gật gù sưởi điện, một ổ cắm điện 110V, hệ thống dẫn đường và hệ thống âm thanh Sony 12 loa và radio HD.</span><br />\r\n<br />\r\n<img alt="Ford Explorer 2016 8." class="LbImage bbCodeImage" src="https://www.otosaigon.com/attachments/ford-explorer-2016-8-jpg.467772/" style="background-color:rgb(252, 252, 255); border:0px; color:rgb(20, 20, 20); font-family:arial,helvetica,times new roman,times,serif; font-size:15px; line-height:24px; max-width:100%" /><br />\r\n<br />\r\n<span style="background-color:rgb(252, 252, 255); color:rgb(20, 20, 20); font-family:arial,helvetica,times new roman,times,serif; font-size:15px">Về tính năng an toàn, Ford trag bị cho Explorer Platinum 2016 hệ thống đèn pha tự động, hệ thống điều khiển hành trình, phát hiện điểm mù, hỗ trợ đỗ xe, hỗ trợ duy trì làn đường và dây đai an toàn hàng ghế sau tự điều chỉnh.</span><br />\r\n<br />\r\n<span style="background-color:rgb(252, 252, 255); color:rgb(20, 20, 20); font-family:arial,helvetica,times new roman,times,serif; font-size:15px">Hình ảnh nội thất xe Ford Explorer tại nước ngoài:&nbsp;</span><br />\r\n<br />\r\n<img alt="ford-explorer-2016-250416-4." class="LbImage bbCodeImage" src="https://www.otosaigon.com/attachments/ford-explorer-2016-250416-4-jpg.467773/" style="background-color:rgb(252, 252, 255); border:0px; color:rgb(20, 20, 20); font-family:arial,helvetica,times new roman,times,serif; font-size:15px; line-height:24px; max-width:100%" /><img alt="ford-explorer-2016-250416-9." class="LbImage bbCodeImage" src="https://www.otosaigon.com/attachments/ford-explorer-2016-250416-9-jpg.467774/" style="background-color:rgb(252, 252, 255); border:0px; color:rgb(20, 20, 20); font-family:arial,helvetica,times new roman,times,serif; font-size:15px; line-height:24px; max-width:100%" /><br />\r\n<br />\r\nNguồn: otosaigon.com</div>\r\n', 0, 1, '2016-05-11 02:17:44'),
(7, 'Xếp hạng bán tải tháng 04/2016 tại Việt Nam', 'Ranger vẫn là một thế lực quá mạnh trong phân khúc bán tải với doanh số gấp 4 lần mẫu xe đứng thứ 2 và gấp tới 62 lần mẫu xe đứng cuối bảng. Doanh số các mẫu bán tải trong tháng qua có sự biến động nhẹ khi Mitsubishi Triton có sự “hụt hơi” còn Colorado và D-Max tăng doanh số.', '2016164248xephangpickup.jpg', '<div style="text-align: justify;"><strong>Ranger vẫn là một thế lực quá mạnh trong phân khúc&nbsp;<a class="Tinhte_XenTag_TagLink" href="https://www.otosaigon.com/tags/b%C3%A1n+t%E1%BA%A3i/" style="color: rgb(179, 77, 0); text-decoration: none; border-radius: 5px; padding: 0px 3px; margin: 0px -3px;">bán tải</a>&nbsp;với doanh số gấp 4 lần mẫu xe đứng thứ 2 và gấp tới 62 lần mẫu xe đứng cuối bảng. Doanh số các mẫu bán tải trong tháng qua có sự biến động nhẹ khi Mitsubishi Triton có sự &ldquo;hụt hơi&rdquo; còn Colorado và D-Max tăng doanh số.</strong><br />\r\n<br />\r\n<strong>1.&nbsp;<a class="internalLink" href="https://www.otosaigon.com/tags/ford+ranger/" style="color: rgb(179, 77, 0); text-decoration: none; border-radius: 5px; padding: 0px 3px; margin: 0px -3px;">Ford Ranger</a>: 1.204 xe</strong><br />\r\n<br />\r\n<span style="background-color:rgb(252, 252, 255); color:rgb(20, 20, 20); font-family:arial,helvetica,times new roman,times,serif; font-size:15px">Doanh số chỉ tăng 6 chiếc nhưng lại giúp Ranger leo lên vị trí chiếc xe bán chạy nhất Việt Nam tháng 4 và dĩ nhiên là bán chạy nhất phân khúc bán tải.</span><br />\r\n<br />\r\n<span style="background-color:rgb(252, 252, 255); color:rgb(20, 20, 20); font-family:arial,helvetica,times new roman,times,serif; font-size:15px">Trong 1.204 xe Ranger bán ra tháng qua có 704 xe bản 1 cầu và 500 xe bản 2 cầu. Nếu chia theo miền, miền Bắc bán 541 xe, miền Trung bán 156 xe và miền Nam là 507 xe.</span><br />\r\n<img alt="[​IMG]" class="LbImage bbCodeImage" src="https://www.otosaigon.com/attachments/23-jpg.326932/" style="background-color:rgb(252, 252, 255); border:0px; color:rgb(20, 20, 20); font-family:arial,helvetica,times new roman,times,serif; font-size:15px; line-height:24px; max-width:100%" /><br />\r\n<span style="background-color:rgb(252, 252, 255); color:rgb(20, 20, 20); font-family:arial,helvetica,times new roman,times,serif; font-size:15px">Ranger hiện đang được bán ra với các phiên bản như: XL 4x4 MT, XLS 4x2 MT, XLS 4x2 AT, XLT 4x4 MT, Wildtrak 4x2 AT, Wildtrak 4x4 AT và 1 phiên bản động cơ 3.2 lít là Wildtrak 3.2 4x4 AT. Giá bán của xe dao động từ 616-879 triệu đồng.</span><br />\r\n<br />\r\n<strong>2.&nbsp;<a class="internalLink" href="https://www.otosaigon.com/tags/mazda+bt-50/" style="color: rgb(179, 77, 0); text-decoration: none; border-radius: 5px; padding: 0px 3px; margin: 0px -3px;">Mazda BT-50</a>: 294 xe</strong><br />\r\n<br />\r\n<span style="background-color:rgb(252, 252, 255); color:rgb(20, 20, 20); font-family:arial,helvetica,times new roman,times,serif; font-size:15px">Giảm 74 chiếc so với tháng trước, BT-50 chỉ bán 294 xe trong tháng 4. Mức gần 300 xe trong tháng qua là khá thấp so với trung bình gần 400 chiếc của mẫu xe này.</span><br />\r\n<img alt="[​IMG]" class="LbImage bbCodeImage" src="https://www.otosaigon.com/attachments/img_4414-jpg.391981/" style="background-color:rgb(252, 252, 255); border:0px; color:rgb(20, 20, 20); font-family:arial,helvetica,times new roman,times,serif; font-size:15px; line-height:24px; max-width:100%" /><br />\r\n<span style="background-color:rgb(252, 252, 255); color:rgb(20, 20, 20); font-family:arial,helvetica,times new roman,times,serif; font-size:15px">BT-50 hiện đang được VinaMazda bán ra với 3 phiên bản 2.2 MT, 2.2 AT và 3.2 AT có giá bán từ 673 và 810 triệu đồng.</span><br />\r\n<br />\r\n<strong>3.&nbsp;<a class="internalLink" href="https://www.otosaigon.com/tags/toyota+hilux/" style="color: rgb(179, 77, 0); text-decoration: none; border-radius: 5px; padding: 0px 3px; margin: 0px -3px;">Toyota Hilux</a>: 181 xe</strong><br />\r\n<img alt="8." class="LbImage bbCodeImage" src="https://www.otosaigon.com/attachments/8-jpg.469985/" style="background-color:rgb(252, 252, 255); border:0px; color:rgb(20, 20, 20); font-family:arial,helvetica,times new roman,times,serif; font-size:15px; line-height:24px; max-width:100%" /><br />\r\n<span style="background-color:rgb(252, 252, 255); color:rgb(20, 20, 20); font-family:arial,helvetica,times new roman,times,serif; font-size:15px">Giảm 28 xe nhưng Hilux vẫn giữ ngôi vị thứ 3 trong bảng xếp hạng. Tại Việt Nam, Hilux đang được bán ra với 3 phiên bản là G AT, G MT và E với giá lần lượt là 693, 809 và 877 triệu đồng.</span><br />\r\n<br />\r\n<strong>4. Chevrolet Colorado: 80 xe</strong><br />\r\n<br />\r\n<span style="background-color:rgb(252, 252, 255); color:rgb(20, 20, 20); font-family:arial,helvetica,times new roman,times,serif; font-size:15px">Doanh số Colorado tháng 4 đột ngột tăng hơn tháng 3 27 xe lên 80 xe. Đây được xem al2 doanh số cao nhất của Colorado trong 1 năm trở lại đây. Điều này cũng giúp Colorado leo lên vị trí thứ 4.</span><br />\r\n<img alt="[​IMG]" class="LbImage bbCodeImage" src="https://www.otosaigon.com/attachments/1-jpg.337771/" style="background-color:rgb(252, 252, 255); border:0px; color:rgb(20, 20, 20); font-family:arial,helvetica,times new roman,times,serif; font-size:15px; line-height:24px; max-width:100%" /><br />\r\n<span style="background-color:rgb(252, 252, 255); color:rgb(20, 20, 20); font-family:arial,helvetica,times new roman,times,serif; font-size:15px">Colorado hiện bán ra với 5 phiên bản là LT AT, LT MT, LTZ AT, LTZ MT và High Counry có giá từ 605-799 triệu đồng.</span><br />\r\n<br />\r\n<strong>5.&nbsp;<a class="internalLink" href="https://www.otosaigon.com/tags/isuzu+d-max/" style="color: rgb(179, 77, 0); text-decoration: none; border-radius: 5px; padding: 0px 3px; margin: 0px -3px;">Isuzu D-Max</a>: 60 xe</strong><br />\r\n<br />\r\n<span style="background-color:rgb(252, 252, 255); color:rgb(20, 20, 20); font-family:arial,helvetica,times new roman,times,serif; font-size:15px">Sau khi ra mắt bản mới, doanh số tháng 3 của D-Max là 40 xe. Sang tháng 4 đã tăng lên 60 xe.</span><br />\r\n<img alt="[​IMG]" class="LbImage bbCodeImage" src="https://www.otosaigon.com/attachments/unnamed-jpg.391978/" style="background-color:rgb(252, 252, 255); border:0px; color:rgb(20, 20, 20); font-family:arial,helvetica,times new roman,times,serif; font-size:15px; line-height:24px; max-width:100%" /><br />\r\n<span style="background-color:rgb(252, 252, 255); color:rgb(20, 20, 20); font-family:arial,helvetica,times new roman,times,serif; font-size:15px">D-Max hiện có 4 phiên bản gồm 4x2 MT, 4x2 AT, 4x4 MT, 4x4 AT với giá bán từ 590-666 triệu đồng.</span><br />\r\n<br />\r\n<strong>6.&nbsp;<a class="internalLink" href="https://www.otosaigon.com/tags/mitsubishi+triton/" style="color: rgb(179, 77, 0); text-decoration: none; border-radius: 5px; padding: 0px 3px; margin: 0px -3px;">Mitsubishi Triton</a>: 56 xe</strong><br />\r\n<br />\r\n<span style="background-color:rgb(252, 252, 255); color:rgb(20, 20, 20); font-family:arial,helvetica,times new roman,times,serif; font-size:15px">Giảm 31 xe so với tháng trước, tháng này Triton chỉ bán ra 56 xe. Chỉ bằng 3/4 so với các tháng trước. Vì vậy Triton đã bị Colorado và D-Max vượt mặt và ngậm ngùi xếp áp chót bảng xếp hạng.</span><br />\r\n<img alt="[​IMG]" class="LbImage bbCodeImage" src="https://www.otosaigon.com/attachments/45-jpg.391974/" style="background-color:rgb(252, 252, 255); border:0px; color:rgb(20, 20, 20); font-family:arial,helvetica,times new roman,times,serif; font-size:15px; line-height:24px; max-width:100%" /><br />\r\n<span style="background-color:rgb(252, 252, 255); color:rgb(20, 20, 20); font-family:arial,helvetica,times new roman,times,serif; font-size:15px">Triton thế hệ mới hiện đang được bán ra với 4 phiên bản GLS AT, GLS MT, GLX AT, GLX MT. Giá bán của Triton dao động từ 580-775 triệu đồng.</span><br />\r\n<br />\r\n<strong>7. Mekong Premio: 18 xe</strong></div>\r\n\r\n<div style="margin: 0px; padding: 0px; color: rgb(20, 20, 20); font-family: Arial, Helvetica, Times New Roman, Times, serif; font-size: 15px; line-height: 24px; text-align: justify; background-color: rgb(252, 252, 255);"><img alt="[​IMG]" class="LbImage bbCodeImage" src="https://www.otosaigon.com/attachments/jip1275884254-png.391997/" style="border:0px; max-width:100%" />​</div>\r\n\r\n<div style="text-align: justify;"><span style="background-color:rgb(252, 252, 255); color:rgb(20, 20, 20); font-family:arial,helvetica,times new roman,times,serif; font-size:15px">Premio có 2 phiên bản 2.8 MT và AT có giá 316 và 419 triệu đồng. Doanh số của mẫu xe này thường đều đều ở mức dưới 10 xe nhưng chẳng mấy khi thấy Premio trên đường. Riêng tháng 4 vừa qua có tới...18 chiếc Premio bán ra. Gấp đôi tháng trước. Riêng miền Nam bán tới 14 chiếc.</span></div>\r\n\r\n<div style="margin: 0px; padding: 0px; color: rgb(20, 20, 20); font-family: Arial, Helvetica, Times New Roman, Times, serif; font-size: 15px; line-height: 24px; text-align: justify; background-color: rgb(252, 252, 255);"><br />\r\n<em>*Thông kê dựa trên số liệu của&nbsp;<a class="internalLink" href="https://www.otosaigon.com/tags/vama/" style="color: rgb(179, 77, 0); text-decoration: none; border-radius: 5px; padding: 0px 3px; margin: 0px -3px;">VAMA</a></em>​</div>\r\n', 0, 1, '2016-05-16 04:42:48');

-- --------------------------------------------------------

--
-- Table structure for table `partner`
--

CREATE TABLE IF NOT EXISTS `partner` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` text NOT NULL,
  `img` text NOT NULL,
  `lnk` text NOT NULL,
  `active` tinyint(1) NOT NULL,
  `ind` int(11) NOT NULL,
  `dates` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=30 ;

--
-- Dumping data for table `partner`
--

INSERT INTO `partner` (`id`, `title`, `img`, `lnk`, `active`, `ind`, `dates`) VALUES
(23, '', '045138052016Chevy.png', '', 1, 1, '2016-09-05 04:51:38'),
(24, '', '045235052016Ford.jpg', '', 1, 2, '2016-09-05 04:52:35'),
(25, '', '045242052016honda.jpg', '', 1, 3, '2016-09-05 04:52:42'),
(26, '', '045252052016Hyundai.jpg', '', 1, 1, '2016-09-05 04:52:52'),
(27, '', '045304052016isuzu.png', '', 1, 4, '2016-09-05 04:53:04'),
(28, '', '045314052016kia.jpg', '', 1, 5, '2016-09-05 04:53:14'),
(29, '', '045326052016mazda.png', '', 1, 6, '2016-09-05 04:53:26');

-- --------------------------------------------------------

--
-- Table structure for table `pimage`
--

CREATE TABLE IF NOT EXISTS `pimage` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `img` text CHARACTER SET utf8 NOT NULL,
  `active` int(11) NOT NULL,
  `pId` int(11) NOT NULL,
  `ind` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=91 ;

--
-- Dumping data for table `pimage`
--

INSERT INTO `pimage` (`id`, `img`, `active`, `pId`, `ind`) VALUES
(1, '20141339535750new(2).jpg', 1, 119, 0),
(2, '2014161725new(35).jpg', 1, 97, 0),
(3, '2014161805new(36).jpg', 1, 97, 0),
(4, '2014162001new(37).jpg', 1, 97, 0),
(5, '2014162035new(38).jpg', 1, 97, 0),
(6, '2014164024new(34).jpg', 1, 98, 0),
(7, '2014164628new(17).jpg', 1, 100, 0),
(8, '2014165121new(33).jpg', 1, 176, 0),
(9, '2014165504FordEscape2.jpg', 1, 94, 0),
(10, '2014160512new(21).jpg', 1, 96, 0),
(11, '2014160538new(22).jpg', 1, 96, 0),
(12, '2014160606new(23).jpg', 1, 96, 0),
(13, '2014160633new(24).jpg', 1, 96, 0),
(14, '2014161241new(8).jpg', 1, 178, 0),
(15, '2014161356new(9).jpg', 1, 95, 0),
(16, '2014162857new(1).jpg', 1, 102, 0),
(33, '2014265658new(3).jpg', 1, 307, 0),
(18, '2014164648new(18).jpg', 1, 129, 0),
(19, '2014181043new(5).jpg', 1, 117, 0),
(20, '2014181026new(6).jpg', 1, 117, 0),
(21, '2014181118new(2).jpg', 1, 118, 0),
(22, '2014165905bodykit.jpg', 1, 146, 0),
(23, '2014185500new.jpg', 1, 154, 0),
(24, '2014185511new(5).jpg', 1, 154, 0),
(25, '2014185604new.jpg', 1, 105, 0),
(26, '2014185612new(5).jpg', 1, 105, 0),
(27, '2014182000new(3).jpg', 1, 140, 0),
(28, '2014183019new(19).jpg', 1, 80, 0),
(29, '2014183403new(7).jpg', 1, 68, 0),
(30, '2014185429new(1).jpg', 1, 82, 0),
(31, '2014185635new(7).jpg', 1, 85, 0),
(32, '2014185942new(15).jpg', 1, 91, 0),
(34, '2014265705new(6).jpg', 1, 307, 0),
(35, '2014260154new(11).jpg', 1, 308, 0),
(36, '2014260204new(12).JPG', 1, 308, 0),
(37, '2014260808new(13).jpg', 1, 309, 0),
(38, '2014261258new(2).jpg', 0, 310, 0),
(39, '2014263228new(5).jpg', 1, 312, 0),
(40, '2014263236new(6).jpg', 1, 312, 0),
(41, '2014263243new(7).jpg', 1, 312, 0),
(42, '2014263253new(8).jpg', 1, 312, 0),
(43, '2014263415new(1).jpg', 1, 313, 0),
(44, '2014263425new(2).jpg', 1, 313, 0),
(45, '2014263544new(10).jpg', 1, 314, 0),
(46, '2014264202new.jpg', 1, 315, 0),
(47, '2014302033new(1).jpg', 1, 317, 0),
(48, '2014302047new(2).jpg', 1, 317, 0),
(49, '2014302345new(4).jpg', 1, 319, 0),
(50, '2014302427new(5).jpg', 1, 320, 0),
(51, '', 0, 93, 0),
(52, '2015214900webadmin.jpg', 0, 93, 0),
(53, '', 0, 93, 0),
(54, '2015023518napmorieng1.jpg', 1, 321, 0),
(55, '2015023527napmoriengford2n.jpg', 1, 321, 0),
(56, '2015024033napthungcao1n.jpg', 1, 323, 0),
(57, '2015024039napthungcao2n.jpg', 1, 323, 0),
(58, '2015025016thungcaon.jpg', 1, 325, 0),
(59, '2015025026thungcao2n.jpg', 1, 325, 0),
(60, '2015025202thungthapmangca1n.jpg', 1, 326, 0),
(61, '2015025430thungthapnew1n.jpg', 1, 327, 0),
(62, '2015025435thungthapnew2n.jpg', 1, 327, 0),
(63, '2015025444thungthapnew3n.jpg', 1, 327, 0),
(64, '2015025821thungthap2n.jpg', 1, 328, 0),
(65, '2015033854thungthap12n.jpg', 1, 329, 0),
(66, '2015030113bt50s1n.jpg', 1, 331, 0),
(67, '2015034633thungcao1n.jpg', 1, 332, 0),
(68, '2015034733thungcao1n.jpg', 1, 333, 0),
(69, '2015034839khungthethao.JPG', 1, 334, 0),
(70, '2015034845khungthethao2n.jpg', 1, 334, 0),
(71, '2015120711napthungthapdanhchoxewilatrak3.220161.jpg', 1, 335, 0),
(72, '2015120847matgalangxefordranger20161.jpg', 1, 336, 0),
(73, '2015121059napthungcaotriton20161njpg.jpg', 1, 337, 0),
(74, '2015121104napthungcaotriton20162njpg.jpg', 1, 337, 0),
(75, '2015121140napthungthaptriton20162.jpg', 1, 338, 0),
(76, '2015163727hilux2016.jpg', 1, 339, 0),
(77, '2015175539luotgiocabo.jpg', 1, 340, 0),
(78, '2015170247matgalang1.jpg', 1, 341, 0),
(79, '2015170233matgalang2.jpg', 1, 341, 0),
(80, '2015170321luotgiocabo.jpg', 1, 340, 0),
(81, '2016054034nuoc_hoa_2_ngsg.jpg', 1, 346, 0),
(83, '2016054401phim-cach-nhiet-o-to.jpg', 1, 347, 0),
(84, '2016054517banner-man-hinh-dvd-cho-xe-oto.jpg', 1, 348, 0),
(85, '201605471010151832_466797960114433_121996726_n.jpg', 1, 349, 0),
(86, '20160601271-guong-chieu-hau-1-cjgg-1435658784177.jpg', 1, 350, 0),
(87, '2016060139lop-cach-nhiet-cho-ac-quy_5911.jpg', 1, 351, 0),
(88, '2016060239Den_oto.jpg', 1, 352, 0),
(89, '2016060400dny1371649550.jpg', 1, 353, 0),
(90, '201606050529.jpg', 1, 354, 0);

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE IF NOT EXISTS `product` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text CHARACTER SET utf8 NOT NULL,
  `content` longtext CHARACTER SET utf8 NOT NULL,
  `img` text CHARACTER SET utf8 NOT NULL,
  `pId` int(11) NOT NULL,
  `active` tinyint(1) NOT NULL,
  `hot` tinyint(1) NOT NULL,
  `pd_new` tinyint(1) NOT NULL,
  `dates` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=355 ;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `name`, `content`, `img`, `pId`, `active`, `hot`, `pd_new`, `dates`) VALUES
(346, 'SÁP THƠM', '', '3951nuoc_hoa_2_ngsg.jpg', 58, 1, 1, 1, '2016-09-05 06:39:51'),
(347, 'PHIM CÁCH NHIỆT', '', '4342phim-cach-nhiet-o-to.jpg', 59, 1, 0, 0, '2016-09-05 06:43:42'),
(348, 'MÀN HÌNH DVD', '', '4510banner-man-hinh-dvd-cho-xe-oto.jpg', 60, 1, 0, 0, '2016-09-05 06:45:10'),
(349, 'PHỦ NANO CHO XEM LUÔN SÁNG ĐẸP', '', '470210151832_466797960114433_121996726_n.jpg', 61, 1, 0, 0, '2016-09-05 06:47:02'),
(350, 'GƯƠNG Ô TÔ', '', '00071-guong-chieu-hau-1-cjgg-1435658784177.jpg', 61, 1, 1, 1, '2016-09-06 08:00:07'),
(351, 'ẮC QUY', '', '0100lop-cach-nhiet-cho-ac-quy_5911.jpg', 61, 1, 0, 0, '2016-09-06 08:01:00'),
(352, 'ĐÈN ÔTÔ', '', '0227Den_oto.jpg', 61, 1, 1, 1, '2016-09-06 08:02:27'),
(353, 'KÍNH Ô TÔ', '', '0349dny1371649550.jpg', 61, 1, 0, 0, '2016-09-06 08:03:49'),
(354, 'LAZANG Ô TÔ', '', '045829.jpg', 61, 1, 1, 1, '2016-09-06 08:04:58');

-- --------------------------------------------------------

--
-- Table structure for table `qtext`
--

CREATE TABLE IF NOT EXISTS `qtext` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `content` longtext NOT NULL,
  `eContent` longtext NOT NULL,
  `cContent` longtext NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `qtext`
--

INSERT INTO `qtext` (`id`, `name`, `content`, `eContent`, `cContent`) VALUES
(1, 'Giới Thiệu', '<div class="title" style="margin: 0px; padding: 0px; border: 0px; font-weight: bold; font-size: 11px; font-family: Tahoma, Verdana, sans-serif; vertical-align: baseline; list-style: none; color: rgb(138, 109, 109); line-height: 18px;">(ÔTÔ TUẤN) Được thành lập vào năm 2006, Công ty TNHH MTV TM DV Ô Tô Tuấn với hơn 10 năm kinh nghiệm trong ngành ghế da và phân phối phụ tùng ô tô chính hãng và nội thất ô tô cao cấp.<br />\r\nTừ ngày thành lập đến nay, với trên 10 năm hoạt động kinh doanh: Chuyên cung cấp phụ tùng ô tô chính hãng và nội thất ô tô cao cấp. Ô Tô Tuấn đã được Khách hàng tin cậy và đánh giá cao về chất lượng dịch vụ cũng như phong cách phục vụ.<br />\r\nCùng với kinh nghiệm lâu năm trong ngành, Ô Tô Tuấn với đội ngũ tư vấn và kỹ thuật viên giàu kinh nghiệm, chuyên nghiệp và nhiệt tình, hiện chúng tôi đang cung cấp các sản phẩm chính hãng của các dòng xe mang thương hiệu nổi tiếng của &nbsp;Ford, Toyota, Honda, Mitsubishi, Nissan, Hyunhdai, Kia&hellip;. Chúng tôi tự hào đã và đang cung cấp đến cho Khách hàng các loại ghế da, phụ tùng ô tô chính hãng và nội thất ô tô cao cấp, giải pháp và dịch vụ kỹ thuật tốt nhất với tiêu chí &ldquo;Chất lượng là hàng đầu và chi phí cạnh tranh nhất&rdquo;. Chúng tôi rất tự tin để hòa nhập và trở thành một người bạn đáng tin cậy và hợp tác hiệu quả với Khách hàng.<br />\r\nVới sứ mệnh trở thành một Công ty hàng đầu trong lĩnh vực cung cấp ghế da, phụ tùng ô tô chính hãng và nội thất ôtô cao cấp. Chúng tôi đang hướng tới một giải pháp đột phá để mang tới cho khách hàng nhiều lợi ích hơn nữa. Đến với Ô Tô Tuấn, Quý Khách sẽ hoàn toàn yên tâm với chất lượng dịch vụ và sản phẩm của chúng tôi.<br />\r\n<br />\r\nNếu Quý Khách có nhu cầu tư vấn kỹ thuật cũng như giải pháp, xin vui lòng liên hệ với chúng tôi</div>\r\n', '<div class="title" style="margin: 0px; padding: 0px; border: 0px; font-weight: bold; font-size: 11px; font-family: Tahoma, Verdana, sans-serif; vertical-align: baseline; list-style: none; color: rgb(138, 109, 109); line-height: 18px;">Quý khách thân mến,</div>\r\n&nbsp;\r\n\r\n<p style="text-align:justify">Ai trong các bạn đã đang và sẽ một lần đặt chân đến thăm thành phố Hồ Chí Minh. Thành phố nguy nga tráng lệ vào bậc nhất của đất nước Việt nam. Xin hãy dừng chân ghé lại với chúng tôi - Khách sạn THIÊN VŨ hân hoan chào đón và phục vụ quí khách.</p>\r\n\r\n<p style="text-align:justify">Khách sạn Thiên Vũ tọa lạc tại số 333/12/4 đường Lê Văn Sỹ - phường 1 - quận Tân Bình - Thành phố Hồ Chí Minh. Khách sạn nằm ngay cửa ngõ ra vào sân bay Tân Sơn Nhất, gần trung tâm hành chính quận Tân Bình. Từ đây quý khách sẽ cảm thấy dễ dàng và thuận tiện cho việc đi lại, thăm quan và mua sắm của quí khách.</p>\r\n\r\n<p style="text-align:justify">Là một khách sạn lưu trú với 25 phòng, nằm trong hẻm và xen giữa khu dân cư, Khách sạn Thiên Vũ được xếp hạng một sao do Sở du lịch Thành phố Hồ Chí Minh công nhận nhưng phong cách phục vụ của khách sạn tương đương &ldquo;Khách sạn 3 sao&rdquo; với câu khẩu hiệu: &ldquo;VUI VẺ - THÂN THIỆN - PHỤC VỤ BẰNG CẢ TRÁI TIM&rdquo;.</p>\r\n\r\n<p style="text-align:justify">Thật vậy, xin quý khách hãy một lần hãy ghé thăm chúng tôi, quý khách sẽ được đón tiếp và được phục vụ bởi một đội ngũ cán bộ công nhân viên được đào tạo chính qui, năng nổ, nhiệt tình, ân cần, chu đáo, yêu ngành, yêu nghề. Quí khách sẽ hài lòng với phòng ngủ rộng rãi thoáng mát, trang bị đầy đủ tiện nghi, phương cách bài trí hài hòa, trang nhã, đẹp mắt. Đặc biệt, khâu vệ sinh được quan tâm đúng mựcc, tuyệt đối an toàn sạch sẽ.</p>\r\n\r\n<p style="text-align:justify">Đến với chúng tôi sau một ngày ngao du sơn thủy, hay sau một ngày làm việc căng thẳng mệt mỏi quý khách sẽ hài lòng với không gian nơi đây - là một bầu không khí yên tĩnh, trong lành đến dịu ngọt. Tất cả và tất cả hòa quyện vào nhau tạo thành một bản nhạc du dương, trầm bổng và đưa quý khách vào với giấc ngủ êm đềm sâu lắng.</p>\r\n\r\n<p style="text-align:justify">Đến với chúng tôi quý khách sẽ cảm nhận được khách sạn Thiên Vũ chính là ngôi nhà ấm cúng và thân thương của mình, bởi chính cung cách phục vụ củachúng tôi. Bạn chỉ có thể tìm thấy cung cách phục vụ đặc biệt ấy tại Khách sạn Thiên Vũ.</p>\r\n\r\n<p style="text-align:justify">Một lần nữa xin trân trọng được đón chào quý khách. Và xin gửi lời chúc tốt đẹp nhất đến toàn thể quý khách.</p>\r\n\r\n<p>GIÁM ĐỐC KHÁCH SẠN THIÊN VŨ</p>\r\n\r\n<p>TRẦN VĂN CHỨC</p>\r\n', '<div class="title" style="margin: 0px; padding: 0px; border: 0px; font-weight: bold; font-size: 11px; font-family: Tahoma, Verdana, sans-serif; vertical-align: baseline; list-style: none; color: rgb(138, 109, 109); line-height: 18px;">Quý khách thân mến,</div>\r\n&nbsp;\r\n\r\n<p style="text-align:justify">Ai trong các bạn đã đang và sẽ một lần đặt chân đến thăm thành phố Hồ Chí Minh. Thành phố nguy nga tráng lệ vào bậc nhất của đất nước Việt nam. Xin hãy dừng chân ghé lại với chúng tôi - Khách sạn THIÊN VŨ hân hoan chào đón và phục vụ quí khách.</p>\r\n\r\n<p style="text-align:justify">Khách sạn Thiên Vũ tọa lạc tại số 333/12/4 đường Lê Văn Sỹ - phường 1 - quận Tân Bình - Thành phố Hồ Chí Minh. Khách sạn nằm ngay cửa ngõ ra vào sân bay Tân Sơn Nhất, gần trung tâm hành chính quận Tân Bình. Từ đây quý khách sẽ cảm thấy dễ dàng và thuận tiện cho việc đi lại, thăm quan và mua sắm của quí khách.</p>\r\n\r\n<p style="text-align:justify">Là một khách sạn lưu trú với 25 phòng, nằm trong hẻm và xen giữa khu dân cư, Khách sạn Thiên Vũ được xếp hạng một sao do Sở du lịch Thành phố Hồ Chí Minh công nhận nhưng phong cách phục vụ của khách sạn tương đương &ldquo;Khách sạn 3 sao&rdquo; với câu khẩu hiệu: &ldquo;VUI VẺ - THÂN THIỆN - PHỤC VỤ BẰNG CẢ TRÁI TIM&rdquo;.</p>\r\n\r\n<p style="text-align:justify">Thật vậy, xin quý khách hãy một lần hãy ghé thăm chúng tôi, quý khách sẽ được đón tiếp và được phục vụ bởi một đội ngũ cán bộ công nhân viên được đào tạo chính qui, năng nổ, nhiệt tình, ân cần, chu đáo, yêu ngành, yêu nghề. Quí khách sẽ hài lòng với phòng ngủ rộng rãi thoáng mát, trang bị đầy đủ tiện nghi, phương cách bài trí hài hòa, trang nhã, đẹp mắt. Đặc biệt, khâu vệ sinh được quan tâm đúng mựcc, tuyệt đối an toàn sạch sẽ.</p>\r\n\r\n<p style="text-align:justify">Đến với chúng tôi sau một ngày ngao du sơn thủy, hay sau một ngày làm việc căng thẳng mệt mỏi quý khách sẽ hài lòng với không gian nơi đây - là một bầu không khí yên tĩnh, trong lành đến dịu ngọt. Tất cả và tất cả hòa quyện vào nhau tạo thành một bản nhạc du dương, trầm bổng và đưa quý khách vào với giấc ngủ êm đềm sâu lắng.</p>\r\n\r\n<p style="text-align:justify">Đến với chúng tôi quý khách sẽ cảm nhận được khách sạn Thiên Vũ chính là ngôi nhà ấm cúng và thân thương của mình, bởi chính cung cách phục vụ củachúng tôi. Bạn chỉ có thể tìm thấy cung cách phục vụ đặc biệt ấy tại Khách sạn Thiên Vũ.</p>\r\n\r\n<p style="text-align:justify">Một lần nữa xin trân trọng được đón chào quý khách. Và xin gửi lời chúc tốt đẹp nhất đến toàn thể quý khách.</p>\r\n\r\n<p>GIÁM ĐỐC KHÁCH SẠN THIÊN VŨ</p>\r\n\r\n<p>TRẦN VĂN CHỨC</p>\r\n'),
(2, 'Text Liên hệ', '<strong>Cảm ơn quý khách ghé thăm website của chúng tôi.&nbsp;<br />\r\nMọi thông tin chi tiết xin vui lòng liên hệ:</strong><br />\r\n<br />\r\n<span style="color:#FF0000"><strong>CÔNG TY TNHH Ô TÔ BÌNH LÂM</strong></span>\r\n<ul>\r\n	<li><strong>Địa chỉ </strong>&nbsp; &nbsp; &nbsp; &nbsp;&nbsp;&nbsp; : <strong>Thửa đất số 1779, Tờ bản đồ số 3AB.9, Khu Phố Bình Minh 1, Phường Dĩ An, Thị Xã Dị An, Tỉnh Bình Dương.</strong></li>\r\n	<li><strong>Điện thoại</strong> &nbsp;&nbsp; &nbsp;:<strong>&nbsp;0982 056 888</strong></li>\r\n	<li><strong>Email &nbsp; &nbsp; </strong>&nbsp; &nbsp; &nbsp; &nbsp;: <u>info@otobinhlam.com.vn</u></li>\r\n	<li><strong>Website</strong> &nbsp; &nbsp; &nbsp; &nbsp; : <strong>http://otobinhlam.com.vn</strong></li>\r\n</ul>\r\n', '<span style="font-size:16px"><span style="color:rgb(241, 173, 30)"><strong>Công Ty TNHH Đặng Hân Thịnh</strong></span></span>\r\n<ul>\r\n	<li>127 Nguyễn Trọng Tuyển, P.15, Q.PN, TP.HCM</li>\r\n	<li>08. 862.928.174</li>\r\n	<li>08. 862.928.174</li>\r\n	<li>name@domain.com</li>\r\n	<li>www.domain.com</li>\r\n</ul>\r\n<br />\r\n<span style="color:rgb(241, 173, 30)"><span style="font-size:16px"><strong>Thời gian làm việc từ thứ 2 đến thứ 6</strong></span></span>\r\n\r\n<ul>\r\n	<li>Sáng từ 08g00 đến 12g00</li>\r\n	<li>Chiều từ 13g30 đến 17g30</li>\r\n</ul>\r\n', '<span style="font-size:16px"><span style="color:rgb(241, 173, 30)"><strong>Công Ty TNHH Đặng Hân Thịnh</strong></span></span>\r\n<ul>\r\n	<li>127 Nguyễn Trọng Tuyển, P.15, Q.PN, TP.HCM</li>\r\n	<li>08. 862.928.174</li>\r\n	<li>08. 862.928.174</li>\r\n	<li>name@domain.com</li>\r\n	<li>www.domain.com</li>\r\n</ul>\r\n<br />\r\n<span style="color:rgb(241, 173, 30)"><span style="font-size:16px"><strong>Thời gian làm việc từ thứ 2 đến thứ 6</strong></span></span>\r\n\r\n<ul>\r\n	<li>Sáng từ 08g00 đến 12g00</li>\r\n	<li>Chiều từ 13g30 đến 17g30</li>\r\n</ul>\r\n'),
(3, 'Text footer', '<span style="font-size:12px"><span style="font-family:arial,helvetica,sans-serif"><span style="font-size:14px"><span style="color:#FFF0F5"><strong>CÔNG TY TNHH Ô TÔ BÌNH LÂM</strong></span></span></span></span><br />\r\n<span style="font-family:arial,helvetica,sans-serif">ĐC: Đường Trần Quốc Toản, KP. Bình Minh 1, P. Dĩ An, Thị Xã Dị An, Bình Dương.</span><br />\r\n<strong>Liên hệ : Mr. Dũng: 0982 056 888</strong><br />\r\n<span style="font-family:arial,helvetica,sans-serif">Email: info@otobinhlam.com.vn</span><br />\r\nWebsite: www.otobinhlam.com.vn', '', ''),
(4, 'Đký lớp học(Khung width:700px)', '<span style="font-size:16px;"><strong>Đăng ký lớp học</strong></span>', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `serv`
--

CREATE TABLE IF NOT EXISTS `serv` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` text NOT NULL,
  `sum` text NOT NULL,
  `img` text NOT NULL,
  `content` longtext NOT NULL,
  `hot` tinyint(1) NOT NULL,
  `active` tinyint(1) NOT NULL,
  `dates` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=16 ;

--
-- Dumping data for table `serv`
--

INSERT INTO `serv` (`id`, `title`, `sum`, `img`, `content`, `hot`, `active`, `dates`) VALUES
(7, 'BẢO DƯỠNG XE TẬN NHÀ', 'DỊCH VỤ BẢO DƯỠNG - SỬA CHỮA TẬN NƠI', '2016053814xehay-kiemtramienphi-1608201603.jpg', '<div style="text-align: center;"><img alt="" src="/images/ckfinder/img/maxresdefault.jpg" style="height:184px; width:400px" /></div>\r\nKhông cần tự mang xe đi sửa. Không cần phải ngồi đợi tại cửa hàng trong thời gian sửa chữa.<br />\r\nChỉ cần gọi 0982 056 888, nhân viên của chúng tôi sẽ đến tận nhà, cơ quan của bạn để nhận xe mang về sửa. Khi hoàn thành, chúng tôi sẽ giao xe đến tận nơi.<br />\r\nKhi nhân viên của Ô TÔ BÌNH LÂM tới nhận và giao xe, quý khách sẽ nhận được cuộc gọi xác nhận từ công ty.<br />\r\nChúng tôi tôn trọng Khách Hàng và luôn làm hết sức mình với sự tận tâm để chăm sóc cho chiếc xe của bạn', 0, 1, '2016-09-01 03:33:04'),
(8, 'SƠN XE', 'SƠN XE', '2016053618sx2.jpg', '<div style="text-align: center;"><span style="font-family:arial,helvetica,sans-serif; font-size:12px"><img alt="" src="/images/ckfinder/img/quy_trinh_son_xe_o_to_trong_phong_son.jpg" style="height:300px; width:300px" /></span></div>\r\n<span style="font-family:arial,helvetica,sans-serif; font-size:12px">Màu sắc và chất lượng sơn của chiếc xe nói lên nhiều điều. Các vết xước không chỉ làm cho chiếc xe của bạn mất đi vẻ đẹp mà còn tạo có nguy cơ gây oxy hóa dẫn đến tình trạng có thể làm cho vỏ xe bị ăn mòn, rỉ hoặc sẽ làm cho chỗ bị chầy xước lan rộng ra.</span><br />\r\n<span style="font-family:arial,helvetica,sans-serif; font-size:12px">Chiếc xe của bạn được sẽ phục hồi nước sơn đã bị trầy xước như mới mà không phải mất nhiều thời gian thời gian. Cho dù bạn quyết định sơn lại toàn bộ xe, giữ nguyên màu sơn cũ hay sơn màu mới hoàn toàn, hay đơn giản là chỉ phục hồi lại một số điểm bị trầy xước sâu thì quy trình tiến hành tương tự như nhau.</span>', 0, 1, '2016-09-01 03:42:35'),
(9, 'BẢO HIỂM ÔTÔ', '\r\nBẢO HIỂM ÔTÔ', '201606121312.jpg', '<strong>BẢO HIỂM ÔTÔ BÌNH LÂM</strong><br />\r\nCùng với sự phát triển của kinh tế đất nước,số lượng xe ô tô ngày càng tăng.Trong khi cơ sở hạ tầng chưa phát triển theo kịp dẫn đến rủi ro,tai nạn của người tham gia giao thông ngày càng tăng.Để giảm thiểu các thiệt hại tài chính do tai nạn giao thông cũng như các rủi ro bất thường có thể đến với chiếc xe của bạn,hãy đến với các gói bảo hiểm xe cơ giới tại Garage Bình Lâm.\r\n<div style="text-align: center;"><img alt="" src="/images/ckfinder/img/cac-hinh-thuc-tai-bao-hiem.jpg" style="height:225px; width:300px" /></div>\r\n\r\n<div style="text-align: center;">Hãy để chúng tôi nâng niu chiếc xe của bạn</div>\r\n<br />\r\nKhi tham gia bảo hiểm tại Bình Lâm, khách hàng sẽ được:&nbsp;<br />\r\n<br />\r\n-Tư vấn,giải đáp mọi thắc mắc liên quan đến bảo hiểm.<br />\r\n<br />\r\n-Mua bảo hiểm nhanh chóng.<br />\r\n<br />\r\n-Tiếp nhận và tư vấn bồi thường.<br />\r\n<br />\r\n-Sửa chữa,thay thế thiệt hại tại Garage BÌNH LÂM.<br />\r\n<br />\r\n-Dịch vụ cứu hộ khẩn cấp 24/24.<br />\r\n&nbsp;<br />\r\nQui trình tiếp nhận và sửa chữa xe bảo hiểm<br />\r\n<br />\r\nVới đội ngũ kỹ thuật viên giàu kinh nghiệm,nhiệt tình ,năng động và tận tâm.Quý khách hoàn toàn có thể yên tâm khi lựa chọn mua bảo hiểm tại Garage BÌNH LÂM.<br />\r\n<br />\r\nTrong trường hợp phát sinh sự cố có thể dẫn đến yêu cầu bồi thường,quý khách vui lòng thực hiện các bước sau:<br />\r\n<br />\r\n-Thực hiện các biện pháp giảm thiểu thiệt hại,thu lại những tài sản bị thiệt hại.<br />\r\n<br />\r\n-Liên hệ ngay với chúng tôi thông qua hotline để được tư vấn các bước thực hiện yêu cầu bồi thường.<br />\r\n<br />\r\n-Cung cấp cho chúng tôi đầy đủ các giấy tờ bản gốc: Bằng lái xe, Đăng ký, Đăng kiểm, Giấy bảo hiểm, Chứng minh nhân dân chủ xe.<br />\r\nChúng tôi sẽ tiến hành nhanh chóng việc giải quyết bồi thường cho quý khách.', 0, 1, '2016-09-01 03:50:31'),
(10, 'BẢO DƯỠNG MÁY - GẦM', 'BẢO DƯỠNG MÁY - GẦM', '2016053514phugamxeoto-cafeautovn-1-1463041998.jpg', '<div style="text-align: center;"><img alt="" src="/images/ckfinder/img/g.jpg" style="height:224px; width:400px" /></div>\r\nHệ thống gầm máy là bộ phận quan trọng nhất của ôtô, Động cơ được ví như trái tim của xe, mỗi km vận hành tất cả các tác động trên cung đường đó đều ảnh hưởng trực tiếp lên hệ thống gầm máy của xe, để duy trì cỗ máy khỏe mạnh và khung gầm vận hành êm ái các bạn phải thường xuyên kiểm tra, sửa chữa những hỏng hóc bằng các thiết bị chuyên dùng, hiện đại và được những bàn tay và khối óc của những kỹ sư lành nghề, giàu kinh nghiệm và tinh thần trách nhiệm cao, chúng tôi sẽ đáp ứng tất cả những điều đó.', 0, 1, '2016-09-01 03:51:10'),
(11, 'ĐIỆN - ĐIỆN LẠNH', 'ĐIỆN - ĐIỆN LẠNH', '201605345611_a.jpg', '<div style="text-align: center;"><img alt="" src="/images/ckfinder/img/4444.jpg" style="height:253px; width:500px" /></div>\r\nBên trong chiếc xe hơi, hệ thống điện, điều hòa là một hệ thống rất phức tạp, tinh vi nhất, với khí hậu nhiệt đới có độ ẩm cao ở Việt Nam luôn làm hệ thống điện của bạn gặp các sự cố, bạn sẽ mệt mỏi và khó chịu nếu hệ thống điều hòa không làm việc, bạn sẽ không khởi động được nếu hệ thống CPU không làm việc và rất nhiều phiền toái khác.<br />\r\n<br />\r\nChúng tôi có các hệ thống thiết bị chuẩn đoán và sửa chữa hiện đại sẽ khắc phục ngay những lỗi kỹ thuật mà xe bạn đang gặp phải.', 0, 1, '2016-09-01 04:07:42'),
(12, 'VỆ SINH NỘI THẤT XE HƠI', 'VỆ SINH NỘI THẤT XE HƠI', '2016053306dich-vu-ve-sinh-noi-that-o-to.jpg', 'Một chiếc xe hơi sang trọng,ngoài vẻ đẹp bóng nhoáng bên ngoài thì tính tiện nghi bên trong là điều mà mọi người không thể không quan tâm.Nội thất bên trong sạch sẽ,gọn gàng góp phần không nhỏ đem lại cảm giác thoải mái cho khách hàng.\r\n<div style="text-align: center;"><img alt="" src="/images/ckfinder/img/pfdmnahve-sinh-oto.jpg" style="height:220px; width:400px" /></div>\r\nXe hơi được sử dụng trong thời gian dài,nội thất thường bị hoen ố,bám bụi và có mùi khó chịu.Thêm vào đó,việc nội thất xe trong khoảng thời gian dài không được vệ sinh có thể ẩn chứa nhiều vi khuẩn,vi-rút là tác nhân gây ra các bệnh truyền nhiễm nguy hiểm.Vì vậy việc vệ sinh nội thất định kỳ và đúng cách mang ý nghĩa rất quan trọng.<br />\r\nKhói thuốc gây ám mùi khó chịu&nbsp;<br />\r\nVệ sinh nội thất gồm 10 bước thuộc ba công đoạn:Dọn_Dưỡng_Khử mùi sinh học.<br />\r\n1.Dọn đồ,hút bụi,vệ sinh lọc gió điều hòa,sấy giàn lạnh.<br />\r\n2.Làm sạch trần nỉ.<br />\r\nLàm sạch trần nỉ<br />\r\n3.Vệ sinh ghế nỉ,ghế da và các chi tiết da.<br />\r\nVệ sinh ghế da<br />\r\n4. Giặt thảm,vệ sinh sàn xe,cốp sau xe.<br />\r\n5.Làm sạch cửa đi,khe cửa,bản lề,chốt cửa.<br />\r\n6.Vệ sinh kính xe.<br />\r\n7.Bảo dưỡng các chi tiết cao su,gioăng cửa chống oxi hóa.<br />\r\n8.Bảo dưỡng nhựa trong xe_bảo dưỡng ghế da.<br />\r\nGiữ các chi tiết da,nhựa luôn bóng đẹp<br />\r\n9.Phủ bóng táp lô (làm bóng,bảo vệ và chống bám bụi).<br />\r\n10.Xịt khử mùi nội thất.', 0, 1, '2016-09-01 04:14:31'),
(13, 'PHỦ GẦM CHỐNG VA ĐẬP', '​Gầm xe là phần tiếp xúc trực tiếp với các chướng ngại vật trên đường. Đây là nơi khó bảo dưỡng nhất của xe, nên dễ bị hư hỏng do nước mưa gây rỉ sét, axit ăn mòn, nước mặn, đá văng, bám bụi…', '2016053140UnderCarBW.jpg', '<div style="text-align: center;"><img alt="" src="/images/ckfinder/img/1.jpg" style="height:278px; width:400px" /></div>\r\n\r\n<div>Trên ô tô, hiện tượng rỉ sét thường xảy ra tại những điểm thường xuyên tiếp xúc với nước và môi trường như gầm xe hoặc các hốc bánh xe. Một vấn đề khác thường xảy ra trên ô tô là khi vận hành, âm thanh cộng hưởng từ gầm xe hoặc những tiếng động do đá văng vào gầm xe thường tạo nên những tiếng động gây khó chịu cho những người ngồi trong xe.</div>\r\nGầm xe là phần tiếp xúc trực tiếp với các chướng ngại vật trên đường. Đây là nơi khó bảo dưỡng nhất của xe, nên dễ bị hư hỏng do nước mưa gây rỉ sét, axit ăn mòn, nước mặn, đá văng, bám bụi&hellip;<br />\r\nNếu gầm xe hỏng hóc hoặc xuống cấp sẽ gây ảnh hưởng tới hoạt động cũng như tuổi thọ của xe. Việc bảo dưỡng định kỳ gầm xe là việc cần thiết mà các bác tài cần lưu tâm trong suốt quá trình vận hành xe.\r\n<div style="text-align: center;"><img alt="" src="/images/ckfinder/img/phugamxeoto-cafeautovn-1-1463041998.jpg" style="height:266px; width:400px" /></div>\r\n\r\n<div style="text-align: center;">&nbsp;</div>\r\nĐể vệ sinh, dùng máy cao áp xịt rửa sạch đất, cát bám vào gầm xe, có thể rửa làm sạch cùng với hóa chất chuyên dụng.<br />\r\nĐồng thời, nên phủ gầm xe bằng lớp phủ chống gỉ sét, xịt đều lên bốn hốc bánh và các chi tiết kim loại.<br />\r\nLớp phủ này nhằm bảo vệ, chống lại sự va đập của cát, đá văng lên đập vào các chi tiết hoạt động dưới gầm xe và mặt dưới sàn xe. Nếu không, lớp sơn bảo vệ bị huỷ hoại dần gây gỉ sét cho các chi tiết dưới gầm xe.', 0, 1, '2016-09-01 04:17:10');

-- --------------------------------------------------------

--
-- Table structure for table `slider`
--

CREATE TABLE IF NOT EXISTS `slider` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` text NOT NULL,
  `e_title` text NOT NULL,
  `sum` text NOT NULL,
  `e_sum` text NOT NULL,
  `img` varchar(255) NOT NULL,
  `lnk` text NOT NULL,
  `e_lnk` text NOT NULL,
  `ind` int(11) NOT NULL,
  `active` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `slider`
--

INSERT INTO `slider` (`id`, `title`, `e_title`, `sum`, `e_sum`, `img`, `lnk`, `e_lnk`, `ind`, `active`) VALUES
(1, 'Ô TÔ BÌNH LÂM - 0982 056 888', '', 'CHĂM SÓC TRỌN VẸN', '', '060548052016slide1.jpg', 'otobinhlam.com.vn', '', 1, 0),
(2, 'Ô TÔ BÌNH LÂM - 0982 056 888', '', 'CHĂM SÓC TRỌN VẸN', '', '060801052016slide2.jpg', 'otobinhlam.com.vn', '', 2, 0),
(3, 'Ô TÔ BÌNH LÂM - 0982 056 888', '', 'CHĂM SÓC TRỌN VẸN', '', '060822052016slide3.jpg', 'otobinhlam.com.vn', '', 3, 0),
(4, '', '', '', '', '0149160920166.jpg', '', '', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `songuoi`
--

CREATE TABLE IF NOT EXISTS `songuoi` (
  `ID` bigint(20) NOT NULL AUTO_INCREMENT,
  `NUMBER` bigint(20) DEFAULT NULL,
  `DATE` bigint(20) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `songuoi`
--

INSERT INTO `songuoi` (`ID`, `NUMBER`, `DATE`) VALUES
(1, 12, 2);

-- --------------------------------------------------------

--
-- Table structure for table `stats`
--

CREATE TABLE IF NOT EXISTS `stats` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `s_time` int(10) DEFAULT '0',
  `s_id` varchar(40) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=522609 ;

--
-- Dumping data for table `stats`
--

INSERT INTO `stats` (`id`, `s_time`, `s_id`) VALUES
(522608, 1471400241, 'okldr151a2h187jukabc4ed2s0'),
(522607, 1471399927, 'c2ukj2smgmi8trol4ko8ba1fv2'),
(522606, 1471399834, '7if76nj7nhaj5u55emi81q7iu4');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_counter`
--

CREATE TABLE IF NOT EXISTS `tbl_counter` (
  `hits` bigint(20) NOT NULL DEFAULT '0',
  `realhits` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_counter`
--

INSERT INTO `tbl_counter` (`hits`, `realhits`) VALUES
(80632, 80628);

-- --------------------------------------------------------

--
-- Table structure for table `vs_counter`
--

CREATE TABLE IF NOT EXISTS `vs_counter` (
  `hit_counter` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `vs_counter`
--

INSERT INTO `vs_counter` (`hit_counter`) VALUES
(1151);

-- --------------------------------------------------------

--
-- Table structure for table `vs_detail`
--

CREATE TABLE IF NOT EXISTS `vs_detail` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `vs_ip` varchar(255) NOT NULL,
  `vs_city` varchar(255) NOT NULL,
  `vs_browser` varchar(255) NOT NULL,
  `vs_os` varchar(255) NOT NULL,
  `vs_id` varchar(255) NOT NULL,
  `vs_flag` tinyint(1) NOT NULL,
  `dates` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1099 ;

--
-- Dumping data for table `vs_detail`
--

INSERT INTO `vs_detail` (`id`, `vs_ip`, `vs_city`, `vs_browser`, `vs_os`, `vs_id`, `vs_flag`, `dates`) VALUES
(1095, '112.213.89.126', 'Thanh Nguyen', 'Chrome', 'Windows 7', '168esvh2qn32v0r2hd3u63hsr5', 0, '2016-11-05 16:39:30'),
(1097, '112.213.89.126', 'Thanh Nguyen', 'Chrome', 'Windows 10', 'hsmr6940u2i982g5pgq3rnpmm4', 0, '2016-11-05 16:47:04'),
(1098, '112.213.89.126', 'Thanh Nguyen', 'Chrome', 'Windows 7', 'n82gs2dbf1i51ropevmk6ofbe2', 1, '2016-11-05 16:47:04');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
