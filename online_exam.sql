-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 20, 2021 at 04:39 PM
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
-- Database: `online_exam`
--

-- --------------------------------------------------------

--
-- Table structure for table `advertisements`
--

CREATE TABLE `advertisements` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `photo` varchar(100) DEFAULT NULL,
  `ordering` int(11) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `url_type` varchar(8) DEFAULT NULL,
  `url_target` varchar(6) DEFAULT NULL,
  `status` varchar(7) DEFAULT 'Active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `advertisements`
--

INSERT INTO `advertisements` (`id`, `name`, `photo`, `ordering`, `url`, `url_type`, `url_target`, `status`) VALUES
(1, 'Ads1', '2bfaa6769fd29edb8be4f3f3701f6cbd.jpg', 1, '', 'Internal', '_self', 'Active'),
(2, 'Ads2', '331e26308194e93cdfc545ab1708a0a1.jpg', 2, '', 'Internal', '_self', 'Active'),
(3, 'Ads3', '3778e5b590da1e691b86985d9636518f.jpg', 3, '', 'Internal', '_self', 'Active'),
(4, 'Ads4', '0bdfeb82960f3057c8309c8a739cda84.jpg', 4, '', 'Internal', '_self', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `configurations`
--

CREATE TABLE `configurations` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `organization_name` varchar(255) DEFAULT NULL,
  `domain_name` varchar(255) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `meta_title` text DEFAULT NULL,
  `meta_keyword` text DEFAULT NULL,
  `meta_content` text DEFAULT NULL,
  `timezone` varchar(100) DEFAULT NULL,
  `author` varchar(255) DEFAULT NULL,
  `sms_notification` tinyint(1) DEFAULT NULL,
  `email_notification` tinyint(1) DEFAULT NULL,
  `guest_login` tinyint(1) DEFAULT NULL,
  `front_end` tinyint(1) DEFAULT NULL,
  `slides` tinyint(4) DEFAULT NULL,
  `translate` tinyint(4) DEFAULT 0,
  `paid_exam` tinyint(4) DEFAULT 1,
  `leader_board` tinyint(1) DEFAULT 1,
  `math_editor` tinyint(1) DEFAULT 0,
  `certificate` tinyint(1) DEFAULT 1,
  `contact` text DEFAULT NULL,
  `email_contact` text DEFAULT NULL,
  `currency` int(11) DEFAULT NULL,
  `photo` varchar(100) DEFAULT NULL,
  `signature` varchar(100) DEFAULT NULL,
  `date_format` varchar(25) DEFAULT NULL,
  `exam_expiry` int(11) NOT NULL DEFAULT 1,
  `exam_feedback` tinyint(1) NOT NULL DEFAULT 1,
  `tolrance_count` int(1) DEFAULT NULL,
  `min_limit` int(11) DEFAULT NULL,
  `max_limit` int(11) DEFAULT NULL,
  `captcha_type` tinyint(4) DEFAULT NULL,
  `dir_type` tinyint(4) DEFAULT NULL,
  `language` varchar(6) DEFAULT NULL,
  `panel1` tinyint(1) DEFAULT 1,
  `panel2` tinyint(1) DEFAULT 1,
  `panel3` tinyint(1) DEFAULT 1,
  `ads` tinyint(1) DEFAULT 1,
  `testimonial` tinyint(1) DEFAULT 1,
  `free_package` tinyint(1) DEFAULT 1,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `powerdby` varchar(100) NOT NULL,
  `powerdlink` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `configurations`
--

INSERT INTO `configurations` (`id`, `name`, `organization_name`, `domain_name`, `email`, `meta_title`, `meta_keyword`, `meta_content`, `timezone`, `author`, `sms_notification`, `email_notification`, `guest_login`, `front_end`, `slides`, `translate`, `paid_exam`, `leader_board`, `math_editor`, `certificate`, `contact`, `email_contact`, `currency`, `photo`, `signature`, `date_format`, `exam_expiry`, `exam_feedback`, `tolrance_count`, `min_limit`, `max_limit`, `captcha_type`, `dir_type`, `language`, `panel1`, `panel2`, `panel3`, `ads`, `testimonial`, `free_package`, `created`, `modified`, `powerdby`, `powerdlink`) VALUES
(1, 'Online exam', 'Online exam', 'http://localhost/worksdev-4/online-exam-system/', 'democon3232@gmail.com', 'Online exam', 'Exam Software, Exam Application, Edu Expression Pro', 'Edu Expression Pro is a leading exam application.', 'Asia/Kolkata', 'Exam Solution', 0, 1, 0, 1, 1, 0, 0, 1, 0, 1, '0000-0000~info@eduexpression.com~http://facebook.com', 'Phone : 0000000000 Email : demo@demo.com', 21, 'logo-website.fw.png', '871d157c9c20f5f1a7ae1ae0dfe2c41a.jpg', 'd,m,Y,h,i,s,A,-,:', 0, 1, 3, 30, 500, 0, 1, 'en', 1, 1, 1, 1, 1, 1, '2014-04-08 20:56:04', '2020-06-07 06:34:20', 'Eduexpression.com', 'https://eduexpression.com/');

-- --------------------------------------------------------

--
-- Table structure for table `contents`
--

CREATE TABLE `contents` (
  `id` int(11) NOT NULL,
  `link_name` varchar(255) DEFAULT NULL,
  `page_name` varchar(255) DEFAULT NULL,
  `is_url` varchar(8) DEFAULT 'Internal',
  `url` varchar(255) DEFAULT NULL,
  `url_target` varchar(6) DEFAULT NULL,
  `main_content` longtext DEFAULT NULL,
  `page_url` varchar(255) DEFAULT NULL,
  `icon` varchar(40) DEFAULT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `ordering` int(11) DEFAULT NULL,
  `views` int(11) DEFAULT 1,
  `sel_name` varchar(100) DEFAULT NULL,
  `published` varchar(11) DEFAULT 'Published',
  `meta_title` text DEFAULT NULL,
  `meta_keyword` text DEFAULT NULL,
  `meta_content` text DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `contents`
--

INSERT INTO `contents` (`id`, `link_name`, `page_name`, `is_url`, `url`, `url_target`, `main_content`, `page_url`, `icon`, `parent_id`, `ordering`, `views`, `sel_name`, `published`, `meta_title`, `meta_keyword`, `meta_content`, `created`, `modified`) VALUES
(1, 'Home', 'Home', 'Page', 'Home', '_self', '', 'Home', 'fa fa-home', 0, 1, 16, NULL, 'Published', '', '', '', '2016-12-05 18:11:19', '2018-09-13 12:04:43'),
(2, 'About', 'About', 'Internal', '', '_self', '', 'About', 'fa fa-globe', 0, 2, 9, NULL, 'Published', '', '', '', '2016-12-05 13:59:12', '2018-09-13 12:04:43'),
(3, 'About Us', 'About Us', 'Internal', '', '_self', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla non molestie magna. Phasellus luctus, erat quis efficitur lacinia, magna massa rutrum libero, fermentum cursus enim erat vel lorem. Vestibulum quis faucibus risus. Cras egestas mauris sed nulla maximus cursus. Integer varius leo sed metus egestas fringilla. Praesent mattis, eros non consectetur ultrices, diam felis dictum nisl, non bibendum nibh lorem ut justo. Nulla orci nunc, aliquam ac finibus sit amet, porttitor vitae risus. Maecenas bibendum felis mi, vel euismod eros rutrum vitae. Vivamus suscipit nulla scelerisque libero venenatis placerat. Phasellus vitae egestas odio. Integer non justo nisl. Vivamus tincidunt est eu nisi semper dignissim. Nam rhoncus sapien quis diam ultrices, quis malesuada ex euismod.</p>\r\n<p>Vivamus vel porta lacus. Donec a dui risus. Nunc eget mi in diam faucibus molestie. Duis dictum dolor sit amet semper consequat. Nunc et facilisis orci, sed vestibulum lacus. Morbi metus sapien, lobortis et placerat non, finibus ut mauris. Aenean tristique, ex sagittis tristique congue, enim eros congue nulla, sed placerat erat felis eu urna. Fusce porttitor tortor vitae metus pulvinar, nec bibendum tortor aliquet. Vivamus id nisi malesuada, facilisis sem nec, aliquam massa. Integer et diam ac velit iaculis sollicitudin. Pellentesque placerat viverra nibh, sed congue nibh maximus sit amet.</p>\r\n<p>Duis fringilla pulvinar nulla, eget condimentum arcu accumsan quis. Curabitur at pulvinar libero, at interdum elit. Vivamus sed dui non sapien aliquet tincidunt. Phasellus ut ligula sem. Cras elit ante, varius at elementum nec, vestibulum pharetra mauris. Nulla molestie ultrices lectus, et pellentesque nisl finibus ut. Proin vel massa vitae sem pharetra ultrices vel ut risus. Morbi erat mi, aliquam et venenatis nec, sollicitudin vitae felis. Phasellus lectus purus, venenatis in sapien at, malesuada tincidunt magna. Aliquam eu nunc vel quam consequat fringilla eu non sapien. In est risus, gravida at libero ut, elementum molestie sem. Curabitur cursus nulla nec metus cursus, non convallis purus aliquam. Aliquam erat volutpat. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Maecenas dignissim nibh id blandit facilisis.</p>\r\n<p>Proin iaculis vehicula dolor, id commodo ex ultricies nec. Donec quis est vitae purus auctor rutrum. Nulla convallis velit id tellus finibus faucibus. Cras dignissim justo non libero tempor cursus. Etiam libero tellus, sagittis tempor diam quis, dignissim pretium lacus. Cras ac ipsum ac tortor ornare luctus. Praesent dignissim metus ultricies nisl feugiat, id convallis velit maximus. Curabitur et interdum tellus. Proin quis bibendum sapien. Maecenas sit amet massa at lorem aliquet tincidunt. Maecenas leo felis, dictum non neque et, tempus blandit sem. Mauris sit amet mi purus. Sed non odio sit amet dolor scelerisque facilisis. Cras sollicitudin fermentum ipsum. Fusce dictum, ipsum a auctor suscipit, tortor nisl cursus mi, eget viverra dolor est in diam.</p>\r\n<p>Vestibulum efficitur vel ligula a vestibulum. Donec condimentum porta bibendum. In lobortis odio ut suscipit vulputate. Proin tempor dapibus ornare. Maecenas auctor convallis ullamcorper. In elementum sed dolor vel cursus. Praesent at tempor turpis. Praesent interdum dapibus sapien id vulputate. In maximus finibus lorem in condimentum. Proin nec sapien sit amet libero placerat vestibulum eget in turpis.</p>', 'About-Us', '', 2, 3, 153, NULL, 'Published', '<p>About Us</p>', '', '', '2016-12-05 14:14:13', '2020-11-05 10:48:57'),
(4, 'Profile', 'Profile', 'Internal', '', '_self', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer sit amet ligula metus. Nulla sagittis orci id ultricies elementum. Proin maximus tortor urna, ac egestas quam placerat nec. Praesent ultrices neque tincidunt lectus malesuada, facilisis commodo odio luctus. Pellentesque blandit, sem quis mollis tincidunt, enim lectus scelerisque diam, et egestas sem nunc ac turpis. Aliquam faucibus purus ut velit facilisis condimentum. Nam rhoncus aliquam leo vitae tempor. Nulla magna purus, vestibulum eget cursus scelerisque, eleifend in metus. Phasellus pretium elit sapien, sit amet sagittis metus facilisis ac. Nunc dictum commodo ante ac sagittis. Vestibulum non ligula elementum, aliquam metus id, dapibus magna. Aenean lacinia, urna nec blandit fringilla, lectus lectus lacinia enim, nec iaculis lectus eros vel lacus. Proin tristique metus ac felis dictum pretium. Nulla non sollicitudin mi, a tincidunt arcu.</p>\r\n<p>Phasellus accumsan, tortor non bibendum elementum, mi diam scelerisque mi, imperdiet imperdiet tellus sem ut ligula. Mauris et risus efficitur nunc viverra ornare. Aenean semper lectus in nisl tincidunt, sit amet pharetra nibh efficitur. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Maecenas lobortis elit et felis vehicula malesuada non eu lorem. Suspendisse quis porttitor magna. Mauris erat enim, blandit eu sodales nec, commodo nec lectus. Ut eget ligula in sapien bibendum auctor. Pellentesque ac iaculis diam. Vestibulum quam sapien, rhoncus sit amet dapibus egestas, ultricies elementum est. Quisque congue leo eu purus vehicula rhoncus. Suspendisse ac neque et velit auctor tempor. Cras tempus ligula sit amet sagittis commodo.</p>\r\n<p>Mauris efficitur libero sit amet tortor tincidunt, at faucibus ex semper. Morbi non lorem posuere, ullamcorper ante a, auctor ante. Etiam pretium blandit risus sed fringilla. Proin et dignissim eros. Pellentesque at commodo lectus, quis blandit leo. Aenean rutrum lacus non congue tempus. In rutrum augue a enim auctor, vel sodales purus condimentum. Fusce sit amet est neque. Fusce rutrum maximus turpis.</p>', 'Profile', '', 2, 4, 17, NULL, 'Published', 'Profile', '', '', '2016-12-06 17:43:20', '2020-11-05 10:48:59'),
(5, 'Register/Login', '', 'Page', 'Registers', '_self', '', 'Register-Login', 'fa fa-user', 0, 7, 5, NULL, 'Published', '', '', '', '2016-12-06 11:11:09', '2018-09-13 12:04:43'),
(7, 'Packages', '', 'Page', 'Packages/index', '_self', '', 'Packages', 'fa fa-shopping-cart', 0, 5, 1, NULL, 'Published', '', '', '', '2017-03-20 19:29:33', '2018-09-13 12:04:43'),
(8, 'Schedules', '', 'Page', 'Schedules', '_self', '', 'Schedules', 'fa fa-calendar', 0, 6, 1, NULL, 'Published', '', '', '', '2018-09-13 12:04:21', '2018-09-13 12:04:43');

-- --------------------------------------------------------

--
-- Table structure for table `coupons`
--

CREATE TABLE `coupons` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `amount` decimal(10,2) DEFAULT NULL,
  `discount_type` varchar(10) DEFAULT NULL,
  `min_amount` decimal(10,2) DEFAULT NULL,
  `code` varchar(15) DEFAULT NULL,
  `coupon_no` int(11) DEFAULT NULL,
  `per_customer` int(11) DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `status` varchar(8) DEFAULT 'Active',
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `coupons_students`
--

CREATE TABLE `coupons_students` (
  `id` int(11) NOT NULL,
  `student_id` int(11) DEFAULT NULL,
  `coupon_id` int(11) DEFAULT NULL,
  `redeem_date` datetime DEFAULT NULL,
  `redeem_ip` varchar(50) DEFAULT NULL,
  `session_id` varchar(100) DEFAULT NULL,
  `status` char(1) DEFAULT '0',
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `currencies`
--

CREATE TABLE `currencies` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `short` varchar(3) DEFAULT NULL,
  `photo` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `currencies`
--

INSERT INTO `currencies` (`id`, `name`, `short`, `photo`) VALUES
(1, 'Australia Dollar AUD', 'AUD', '64238c6d767ab034b04c4681295567a0.gif'),
(2, 'Brunei Darussalam Dollar BND', 'BND', '53e34059e7bfe4db945404e901c4f396.gif'),
(3, 'Cambodia Riel KHR', 'KHR', 'aaa57dd0012641cdee2c8d6484db8238.gif'),
(4, 'China Yuan Renminbi CNY ', 'CNY', '5586a267c542d0f49b6c22c5c978bf23.gif'),
(5, 'Hong Kong Dollar HKD', 'HKD', '200ec0145292d85b380d8c4f570f9aa9.gif'),
(6, 'India Rupee INR', 'INR', '537f17a76864d11438d25ff5af7641a5.gif'),
(7, 'Indonesia Rupiah IDR', 'IDR', '6d27b2f196ce9d74b10d12111d9838b0.gif'),
(8, 'Japan Yen JPY', 'JPY', '3a7f86a61af62ddab4737f3df6db4807.gif'),
(9, 'Korea (North) Won KPW', 'KPW', 'cc0ad4a7ba48bedd9cf57bc4125fc2c9.gif'),
(10, 'Korea (South) Won KRW', 'KRW', '28fdcdac33f7429afe6bce2e08dd47c2.gif'),
(11, 'Laos Kip LAK', 'LAK', 'f72da580f617ee32683202aeee564df0.gif'),
(12, 'Malaysia Ringgit MYR', 'MYR', 'e86af0a98bf7398c27a5ad30319d82ad.gif'),
(13, 'Nigeria Naira NGN', 'NGN', '2cdb9ceeae309e948c6bd0a90e30ffec.gif'),
(14, 'Pakistan Rupee PKR', 'PKR', 'bac3525bb97f15f806a74d248f71d6b2.gif'),
(15, 'Philippines Peso PHP', 'PHP', 'c46c38e2701d3c3bd6ee442c93befd04.gif'),
(16, 'Singapore Dollar SGD', 'SGD', '2c1e20836f56700b13a08477216a61fb.gif'),
(17, 'Sri Lanka Rupee LKR', 'LKR', '38bb6c10813d0a1eb9c878bcea2b7570.gif'),
(18, 'Taiwan New Dollar TWD', 'TWD', 'a558976f34bf485cb72f61656595536c.gif'),
(19, 'Thailand Baht THB', 'THB', '3c3bcc74de1fd038ec2d7e0dfe2965bf.gif'),
(20, 'United Kingdom Pound GBP', 'GBP', 'df773c6ce35993089139c888ec5a3210.gif'),
(21, 'United States Dollar USD', 'USD', 'ef1e801ee13715b41e55c16886597878.gif'),
(22, 'Viet Nam Dong VND', 'VND', '5a5b143e1685239abd85f0b367d4669b.gif');

-- --------------------------------------------------------

--
-- Table structure for table `diffs`
--

CREATE TABLE `diffs` (
  `id` int(11) NOT NULL,
  `diff_level` varchar(15) DEFAULT NULL,
  `type` char(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `diffs`
--

INSERT INTO `diffs` (`id`, `diff_level`, `type`) VALUES
(1, 'Easy', 'E'),
(2, 'Medium', 'M'),
(3, 'Hard', 'D');

-- --------------------------------------------------------

--
-- Table structure for table `emailsettings`
--

CREATE TABLE `emailsettings` (
  `id` int(11) NOT NULL,
  `type` varchar(10) CHARACTER SET latin1 DEFAULT NULL,
  `host` varchar(100) CHARACTER SET latin1 DEFAULT NULL,
  `username` varchar(100) CHARACTER SET latin1 DEFAULT NULL,
  `password` varchar(100) CHARACTER SET latin1 DEFAULT NULL,
  `port` varchar(10) CHARACTER SET latin1 DEFAULT NULL,
  `tls` tinyint(4) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `emailsettings`
--

INSERT INTO `emailsettings` (`id`, `type`, `host`, `username`, `password`, `port`, `tls`) VALUES
(1, 'Mail', NULL, NULL, NULL, NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `emailtemplates`
--

CREATE TABLE `emailtemplates` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `status` varchar(11) DEFAULT 'Published',
  `type` varchar(3) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `emailtemplates`
--

INSERT INTO `emailtemplates` (`id`, `name`, `description`, `status`, `type`) VALUES
(1, 'Student Registration', '<p>Hi, $studentName</p><p>Your signup email: $email</p><p>Your password: $password</p><p>Please click the following link to finish up registration:</p><p><a href=\"$url\" target=\"_blank\">$url</a></p><p><strong>Note: If the link does not open directly, please copy and paste the url into your internet browser.</strong></p><p>Verification Code: $code</p><p>Sincerely,</p><p>$siteName</p><p>$siteEmailContact</p>', 'Published', 'SRN'),
(2, 'Re-send Verification', '<p>Hi, $studentName</p><p>Your signup email: $email</p><p>Please click the following link to finish up registration:</p><p><a href=\"$url\" target=\"_blank\">$url</a></p><p><strong>Note: If the link does not open directly, please copy and paste the url into your internet browser.</strong></p><p>Verification Code: $code</p><p>Sincerely,</p><p>$siteName</p><p>$siteEmailContact</p>', 'Published', 'RVN'),
(4, 'Student Forgot Password', '<p>Dear $studentName,</p><p>Please click the following link to finish forgot password:</p><p><a href=\"$url\" target=\"_blank\">$url</a></p><p><strong>Note: If the link does not open directly, please copy and paste the url into your internet browser.</strong></p><p>Verification Code: $code</p><p>Sincerely,</p><p>$siteName</p><p>$siteEmailContact</p>', 'Published', 'SFP'),
(5, 'Admin Forgot Password', '<p>Dear $name,</p><p>Please click the following link to finish forgot password:</p><p><a href=\"$url\" target=\"_blank\">$url</a></p><p><strong>Note: If the link does not open directly, please copy and paste the url into your internet browser.</strong></p><p>Verification Code: $code</p><p>Sincerely,</p><p>$siteName</p><p>$siteEmailContact</p>', 'Published', 'AFP'),
(6, 'Admin Forgot Username', '<p>Dear $name,</p><p>You have forgot User Name. your username is $userName</p><p>Sincerely,</p><p>$siteName</p><p>$siteEmailContact</p>', 'Published', 'AFU'),
(7, 'Student Login Credentials', '<p>Dear $studentName,</p><p>Congratulations! Your $siteName account is now active.</p><p>Email Address : $email</p><p>Password: $password</p><p>If you need, you can reset your password at any time.</p><p>To get started, log on:<a href=\"$url\" target=\"_blank\">$url</a></p><p>If you have any questions or need assistance, please contact us.</p><p> </p><p>Best Regards,</p><p>$siteName</p><p>$siteEmailContact</p>', 'Published', 'SLC'),
(8, 'User Login Credentials', '<p>Dear $name,</p><p>Congratulations! Your $siteName account is now active.</p><p>Email Address : $email</p><p>Username : $userName</p><p>Password: $password</p><p>If you need, you can reset your password at any time.</p><p>To get started, log on:<a href=\"$url\" target=\"_blank\">$url</a></p><p>If you have any questions or need assistance, please contact us.</p><p> </p><p>Best Regards,</p><p>$siteName</p><p>$siteEmailContact</p>', 'Published', 'ULC'),
(9, 'Exam Activation', '<p>Dear $studentName,</p><p>Exam Name $examName Type $type is active and start on $startDate end on $endDate</p><p>Sincerely,</p><p>$siteName</p><p>$siteEmailContact</p>', 'Published', 'EAN'),
(10, 'Exam Finalized', '<p>Dear $studentName,</p><p>Name: $examName</p><p>Result: $result</p><p>Rank: $rank</p><p>Obtained Marks: $obtainedMarks</p><p>Question Attempt: $questionAttempt</p><p>Time Taken: $timeTaken</p><p>Percentage: $percent</p><p> </p><p>Sincerely,</p><p>$siteName</p><p>$siteEmailContact</p>', 'Published', 'EFD'),
(11, 'Exam Result', '<p>Dear $studentName,</p><p>Name: $examName</p><p>Result: $result</p><p>Obtained Marks: $obtainedMarks</p><p>Question Attempt: $questionAttempt</p><p>Time Taken: $timeTaken</p><p>Percentage: $percent %</p><p> </p><p>Sincerely,</p><p>$siteName</p><p>$siteEmailContact</p>', 'Published', 'ERT'),
(12, 'Package Purchased', '<p>Dear $studentName,</p><p>We thank you for choosing $siteName for your career, professional and educational needs.</p><p>Your package details are as follows:-</p><p><strong>Total Amount: $currency $totalAmount</strong></p><p><strong>Coupon Discount: $currency $couponDiscount</strong></p><p><strong>Net Amount : $currency $netAmount</strong></p><p><strong>Transaction ID: $transactionId</strong></p><p>$packageDetail</p><p>Sincerely,</p><p>$siteName</p><p>$siteEmailContact</p>', 'Published', 'PPD');

-- --------------------------------------------------------

--
-- Table structure for table `exams`
--

CREATE TABLE `exams` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `instruction` text DEFAULT NULL,
  `syllabus` text DEFAULT NULL,
  `duration` int(11) DEFAULT NULL,
  `start_date` datetime DEFAULT NULL,
  `end_date` datetime DEFAULT NULL,
  `passing_percent` int(11) DEFAULT NULL,
  `negative_marking` varchar(3) DEFAULT NULL,
  `attempt_count` int(11) DEFAULT NULL,
  `declare_result` varchar(3) DEFAULT 'Yes',
  `finish_result` char(1) DEFAULT '0',
  `ques_random` char(1) DEFAULT '0',
  `paid_exam` char(1) DEFAULT '0',
  `browser_tolrance` char(1) DEFAULT '1',
  `instant_result` char(1) NOT NULL DEFAULT '0',
  `option_shuffle` char(1) DEFAULT '1',
  `amount` decimal(10,2) DEFAULT NULL,
  `status` varchar(10) DEFAULT 'Inactive',
  `type` varchar(12) DEFAULT NULL,
  `multi_language` char(1) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `expiry` int(11) DEFAULT 0,
  `finalized_time` datetime DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `exams`
--

INSERT INTO `exams` (`id`, `name`, `instruction`, `syllabus`, `duration`, `start_date`, `end_date`, `passing_percent`, `negative_marking`, `attempt_count`, `declare_result`, `finish_result`, `ques_random`, `paid_exam`, `browser_tolrance`, `instant_result`, `option_shuffle`, `amount`, `status`, `type`, `multi_language`, `user_id`, `expiry`, `finalized_time`, `created`, `modified`) VALUES
(3, 'Maths Exam for class 1	', 'Maths Exam for class 1	instruction', 'Maths Exam for class 1	 syllabus', 20, '2020-06-25 00:00:00', '2020-06-30 00:00:00', 30, 'No', 0, 'No', '1', '0', '0', '1', '0', '1', NULL, 'Active', 'Exam', '0', 0, 0, NULL, '2020-06-11 10:14:39', '2020-11-08 16:41:12'),
(4, 'Exam testing 1', 'test', 'test', 0, '2020-08-13 10:00:00', '2022-08-13 23:01:00', 26, 'Yes', 56, 'Yes', '1', '0', '0', '1', '0', '1', NULL, 'Active', 'Exam', '1', 0, 0, NULL, '2020-08-13 11:28:04', '2021-01-29 11:33:17'),
(5, 'math all question', '', '', 20, '2021-06-20 18:31:00', '2021-06-30 00:01:00', 20, 'Yes', 5, 'Yes', '1', '0', '0', '1', '0', '1', NULL, 'Active', 'Exam', '1', 0, 0, NULL, '2021-06-20 18:25:45', '2021-06-20 18:30:30'),
(6, 'math Question with number', '', '', 20, '2021-06-20 00:00:00', '2021-07-31 00:00:00', 52, 'Yes', 10, 'Yes', '1', '0', '0', '1', '0', '1', NULL, 'Active', 'Exam', '1', 0, 0, NULL, '2021-06-20 19:22:37', '2021-06-20 19:24:01');

-- --------------------------------------------------------

--
-- Table structure for table `exams_packages`
--

CREATE TABLE `exams_packages` (
  `id` int(11) NOT NULL,
  `package_id` int(11) NOT NULL,
  `exam_id` int(11) NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `exams_packages`
--

INSERT INTO `exams_packages` (`id`, `package_id`, `exam_id`, `created`, `modified`) VALUES
(13, 1, 3, '2020-06-28 12:38:42', '2020-06-28 12:38:42'),
(15, 1, 4, '2021-01-29 11:33:17', '2021-01-29 11:33:17'),
(18, 1, 5, '2021-06-20 18:30:33', '2021-06-20 18:30:33'),
(19, 1, 6, '2021-06-20 19:22:38', '2021-06-20 19:22:38');

-- --------------------------------------------------------

--
-- Table structure for table `exam_feedbacks`
--

CREATE TABLE `exam_feedbacks` (
  `id` int(11) NOT NULL,
  `exam_result_id` int(11) NOT NULL,
  `comment1` varchar(255) DEFAULT NULL,
  `comment2` varchar(255) DEFAULT NULL,
  `comment3` varchar(255) DEFAULT NULL,
  `comments` mediumtext DEFAULT NULL,
  `created` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `exam_groups`
--

CREATE TABLE `exam_groups` (
  `id` int(11) NOT NULL,
  `exam_id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `exam_groups`
--

INSERT INTO `exam_groups` (`id`, `exam_id`, `group_id`) VALUES
(48, 3, 3),
(49, 3, 4),
(52, 4, 3),
(53, 4, 4),
(56, 5, 3),
(57, 5, 4),
(58, 5, 6),
(59, 6, 3),
(60, 6, 4),
(61, 6, 6);

-- --------------------------------------------------------

--
-- Table structure for table `exam_maxquestions`
--

CREATE TABLE `exam_maxquestions` (
  `id` int(11) NOT NULL,
  `exam_id` int(11) NOT NULL,
  `subject_id` int(11) NOT NULL,
  `max_question` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `exam_orders`
--

CREATE TABLE `exam_orders` (
  `id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `exam_id` int(11) NOT NULL,
  `payment_id` int(11) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `expiry_date` date DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `exam_orders`
--

INSERT INTO `exam_orders` (`id`, `student_id`, `exam_id`, `payment_id`, `date`, `expiry_date`, `created`, `modified`) VALUES
(1, 2, 3, 2, '2021-06-16', '2021-08-21', '2021-06-16 21:49:58', '2021-06-16 21:49:58'),
(2, 2, 4, 2, '2021-06-16', '2021-08-21', '2021-06-16 21:49:59', '2021-06-16 21:49:59');

-- --------------------------------------------------------

--
-- Table structure for table `exam_preps`
--

CREATE TABLE `exam_preps` (
  `id` int(11) NOT NULL,
  `exam_id` int(11) NOT NULL,
  `subject_id` int(11) NOT NULL,
  `ques_no` int(11) DEFAULT NULL,
  `type` varchar(10) DEFAULT NULL,
  `level` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `exam_questions`
--

CREATE TABLE `exam_questions` (
  `id` int(11) NOT NULL,
  `exam_id` int(11) NOT NULL,
  `question_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `exam_questions`
--

INSERT INTO `exam_questions` (`id`, `exam_id`, `question_id`) VALUES
(1, 4, 9),
(2, 4, 8),
(3, 4, 7),
(4, 4, 6),
(5, 4, 5),
(6, 4, 4),
(7, 5, 9),
(8, 5, 8),
(9, 5, 7),
(10, 5, 6),
(11, 5, 5),
(12, 5, 3),
(13, 5, 2),
(14, 5, 1),
(15, 5, 4),
(16, 6, 9),
(17, 6, 8),
(18, 6, 7);

-- --------------------------------------------------------

--
-- Table structure for table `exam_results`
--

CREATE TABLE `exam_results` (
  `id` int(11) NOT NULL,
  `exam_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `start_time` datetime DEFAULT NULL,
  `end_time` datetime DEFAULT NULL,
  `resume_time` int(11) DEFAULT NULL,
  `total_question` int(11) DEFAULT NULL,
  `total_attempt` int(11) DEFAULT NULL,
  `total_answered` int(11) DEFAULT NULL,
  `total_marks` decimal(5,2) DEFAULT NULL,
  `obtained_marks` decimal(5,2) DEFAULT NULL,
  `result` varchar(10) DEFAULT NULL,
  `percent` decimal(5,2) DEFAULT NULL,
  `finalized_time` datetime DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `exam_stats`
--

CREATE TABLE `exam_stats` (
  `id` int(11) NOT NULL,
  `exam_result_id` int(11) NOT NULL,
  `exam_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `question_id` int(11) NOT NULL,
  `ques_no` int(11) DEFAULT NULL,
  `options` varchar(30) DEFAULT NULL,
  `attempt_time` datetime DEFAULT NULL,
  `opened` char(1) DEFAULT '0',
  `answered` char(1) DEFAULT '0',
  `review` char(1) DEFAULT '0',
  `option_selected` varchar(15) DEFAULT NULL,
  `answer` text DEFAULT NULL,
  `true_false` varchar(5) DEFAULT NULL,
  `fill_blank` text DEFAULT NULL,
  `correct_answer` text DEFAULT NULL,
  `marks` decimal(5,2) DEFAULT NULL,
  `marks_obtained` decimal(5,2) DEFAULT NULL,
  `ques_status` char(1) DEFAULT NULL,
  `closed` char(1) DEFAULT '0',
  `user_id` int(11) DEFAULT NULL,
  `checking_time` datetime DEFAULT NULL,
  `time_taken` int(11) DEFAULT NULL,
  `bookmark` char(1) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `exam_warns`
--

CREATE TABLE `exam_warns` (
  `id` int(11) NOT NULL,
  `exam_result_id` int(11) NOT NULL,
  `created` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE `groups` (
  `id` int(11) NOT NULL,
  `group_name` varchar(255) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`id`, `group_name`, `created`, `modified`) VALUES
(3, 'Class 1', '2020-06-11 08:42:25', '2021-06-16 19:46:14'),
(4, 'Class 2', '2020-06-11 08:42:29', '2020-06-11 08:42:29'),
(6, 'fdsfsf', '2021-06-16 19:50:15', '2021-06-16 19:50:15');

-- --------------------------------------------------------

--
-- Table structure for table `helpcontents`
--

CREATE TABLE `helpcontents` (
  `id` int(11) NOT NULL,
  `link_title` varchar(255) DEFAULT NULL,
  `link_desc` longtext DEFAULT NULL,
  `status` varchar(8) DEFAULT 'Active',
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `helpcontents`
--

INSERT INTO `helpcontents` (`id`, `link_title`, `link_desc`, `status`, `created`, `modified`) VALUES
(1, 'Help 1', '<p>Suspendisse mattis magna augue, sed pretium lacus pellentesque nec. Nullam tincidunt lacinia urna sit amet tincidunt. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Cras consequat justo ac diam aliquet adipiscing. Ut orci nibh, viverra quis luctus id, lacinia quis purus. Vestibulum pharetra diam non nulla pretium scelerisque. Fusce posuere tellus vel mollis auctor.</p>', 'Active', '2014-12-19 14:45:19', '2015-10-26 11:52:48'),
(2, 'Help2', '<p>Aenean pretium nunc lectus, quis viverra metus accumsan vestibulum. Mauris vulputate urna nec leo viverra, at dictum nulla suscipit. Sed id pretium lectus, vitae egestas turpis. Quisque metus tortor, tristique in diam sit amet, suscipit facilisis augue. Nunc vel leo vitae ligula auctor tristique ut nec tortor. Aliquam nibh ligula, tristique non pharetra in, congue ac sem. Donec odio nulla, lobortis vitae risus in, porttitor pretium mauris. Nullam fringilla tortor eu quam luctus, eget bibendum lectus eleifend. Nam facilisis libero tempor rhoncus consequat.</p>', 'Active', '2014-12-19 14:45:43', '2015-11-09 16:56:24');

-- --------------------------------------------------------

--
-- Table structure for table `homesections`
--

CREATE TABLE `homesections` (
  `id` int(11) NOT NULL,
  `section` varchar(30) CHARACTER SET utf8 DEFAULT NULL,
  `sections_heading` varchar(300) CHARACTER SET utf8 DEFAULT NULL,
  `sections_content` longtext CHARACTER SET utf8 DEFAULT NULL,
  `sections_img` varchar(300) CHARACTER SET utf8 DEFAULT NULL,
  `content` varchar(5) CHARACTER SET utf8 DEFAULT 'Yes',
  `image` varchar(5) CHARACTER SET utf8 DEFAULT 'Yes',
  `published` varchar(15) CHARACTER SET utf8 DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `homesections`
--

INSERT INTO `homesections` (`id`, `section`, `sections_heading`, `sections_content`, `sections_img`, `content`, `image`, `published`) VALUES
(1, 'Header Top image', ' Edu Expression', '<p>The most Powerful Examination Engine on Envato. Try Edu Expression today. Visit EduExpression.com for more information or details.</p><p><a class=\"btn btn-success h-btn mar-b8 mar-h4 js-tb-signup-anchor\" href=\"/Registers\">Get Started For Free</a></p>', 'ee8fc908ad2c41c023a0755b4c6486b3.jpg', '1', '1', 'Published'),
(2, 'Packages', 'The most powerful Online examination System ', 'Edu Expression Enables you to conduct flexible online examination system with ease. Powerful system, dozen of settings, native mobile app and secure frame work make the software stand different in crowd.', '', '1', '1', 'Published'),
(3, 'AppTab1', 'Go mobile with Native App', '<p>Losing traffic due to no Mobile App ? Try Edu Expression with Native Mobile app for Android to enable a smooth Examination experiences on Mobile Devices and small screen. White Label Mobile App comes with your brand name and your organization listing at Google Play Store at just $65 extra. Try now today. </p>\r\n<div class=\"play-store-url\"><img src=\"img/Uploads/google-play.png\" alt=\"\" width=\"186\" height=\"56\" /></div>', '98394e57b2eba1036ed3d80856b2f1c5.PNG', '1', '1', 'Published'),
(4, 'AppTab2', 'Go mobile with Native App', 'Losing traffic due to no Mobile App ? Try Edu Expression with Native Mobile app for Android to enable a smooth Examination experiences on Mobile Devices and small screen. White Label Mobile App comes with your brand name and your organization listing at Google Play Store at just $65 extra. Try now today. \r\n<div class=\"play-store-url\">\r\n                    <a class=\"app-link\" href=\"#\" target=\"_blank\" rel=\"noopener\">\r\n                    <img class=\"img-responsive\" style=\"width: 150px\"  alt=\"App on Google Playstore\" src=\"img/google-play.png\" data-was-processed=\"true\">\r\n                    </a>\r\n                  </div>', 'd75e77890389d3ea8ab24048ae591ee0.png', '1', '1', 'Published'),
(5, 'Footer image', 'Start Your Exam Preparation Now!', '<p>PRACTICE, ANALYZE AND IMPROVE!</p><p><a class=\"btn btn-success h-btn mar-b8 mar-h4 js-tb-signup-anchor\" href=\"/Registers/\">Get Started For Free</a></p>', '05aebf5cfc01f0cac8f9fdc1b65b4452.jpg', '1', '1', 'Published');

-- --------------------------------------------------------

--
-- Table structure for table `languages`
--

CREATE TABLE `languages` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `value1` varchar(100) DEFAULT NULL,
  `value2` varchar(100) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `languages`
--

INSERT INTO `languages` (`id`, `name`, `value1`, `value2`, `created`, `modified`) VALUES
(1, 'English', 'True', 'False', '2017-03-29 16:36:55', '2017-03-29 16:36:55'),
(2, 'Hindi', 'सत्य', 'असत्य', '2017-03-29 12:07:06', '2017-03-29 12:07:06');

-- --------------------------------------------------------

--
-- Table structure for table `mails`
--

CREATE TABLE `mails` (
  `id` int(11) NOT NULL,
  `to_email` varchar(100) DEFAULT NULL,
  `from_email` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `subject` varchar(255) DEFAULT NULL,
  `message` longtext DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  `status` varchar(5) DEFAULT 'Live',
  `type` varchar(10) DEFAULT 'Unread',
  `mail_type` varchar(4) DEFAULT 'To'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `mails`
--

INSERT INTO `mails` (`id`, `to_email`, `from_email`, `email`, `subject`, `message`, `date`, `status`, `type`, `mail_type`) VALUES
(1, 'student@student.com', 'Administrator', 'student@student.com', 'Demo Subject', 'Demo Content', '2015-02-24 18:33:49', 'Live', 'Unread', 'To'),
(2, 'student@student.com', 'Administrator', 'Administrator', 'Demo Subject', 'Demo Content', '2015-02-24 18:33:49', 'Live', 'Read', 'From'),
(3, 'Administrator', 'student@student.com', 'Administrator', 'Demo Subject', 'Demo Content User', '2015-02-24 18:34:49', 'Live', 'Read', 'To'),
(4, 'Administrator', 'student@student.com', 'student@student.com', 'Demo Subject', 'Demo Content User', '2015-02-24 18:34:49', 'Live', 'Read', 'From');

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE `news` (
  `id` int(11) NOT NULL,
  `news_title` varchar(255) DEFAULT NULL,
  `news_desc` longtext DEFAULT NULL,
  `page_url` varchar(255) DEFAULT NULL,
  `meta_title` text DEFAULT NULL,
  `meta_keyword` text DEFAULT NULL,
  `meta_content` text DEFAULT NULL,
  `status` varchar(7) DEFAULT 'Active',
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `packages`
--

CREATE TABLE `packages` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `amount` decimal(10,2) DEFAULT NULL,
  `show_amount` decimal(10,2) DEFAULT NULL,
  `package_type` char(1) DEFAULT NULL,
  `photo` varchar(100) DEFAULT NULL,
  `expiry_days` int(11) DEFAULT NULL,
  `status` varchar(8) DEFAULT 'Active',
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `packages`
--

INSERT INTO `packages` (`id`, `name`, `description`, `amount`, `show_amount`, `package_type`, `photo`, `expiry_days`, `status`, `created`, `modified`) VALUES
(1, 'MBS EXAM', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis laoreet ante ex, sed bibendum velit tincidunt vel. Sed id velit non dolor viverra ornare. Maecenas pretium nibh vel nisi hendrerit, ac pharetra eros feugiat. Aenean sollicitudin lobortis augue a dapibus. Nam tincidunt dapibus eros, hendrerit vehicula ex interdum non. Pellentesque ultrices, ipsum laoreet elementum pretium, mi orci egestas tellus, blandit tincidunt nisi dolor quis ligula. Pellentesque euismod scelerisque porttitor. Sed sed dictum quam. Mauris nec venenatis magna. Praesent a pharetra est, sed accumsan dui. Quisque laoreet congue urna, sit amet commodo sapien convallis sed. Pellentesque luctus dignissim purus, quis consectetur tortor semper eget. Duis tempus sapien elit, ac sagittis ante elementum eget. Duis ac rhoncus odio. Phasellus dictum semper neque sed ornare. Pellentesque eu purus nulla.', '0.00', '0.00', 'F', NULL, 66, 'Active', '2017-03-28 23:40:59', '2020-06-11 09:42:40');

-- --------------------------------------------------------

--
-- Table structure for table `packages_payments`
--

CREATE TABLE `packages_payments` (
  `id` int(11) NOT NULL,
  `payment_id` int(11) DEFAULT NULL,
  `package_id` int(11) DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `amount` decimal(10,2) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `expiry_date` date DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `packages_payments`
--

INSERT INTO `packages_payments` (`id`, `payment_id`, `package_id`, `price`, `quantity`, `amount`, `date`, `expiry_date`, `created`, `modified`) VALUES
(1, 1, 1, '0.00', 1, '0.00', '2029-06-07', '2029-07-07', '2020-06-07 10:08:51', '2020-06-07 10:08:51'),
(2, 2, 1, '0.00', 1, '0.00', '2021-06-16', '2021-08-21', '2021-06-16 21:49:58', '2021-06-16 21:49:58');

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE `pages` (
  `id` int(11) NOT NULL,
  `model_name` varchar(100) DEFAULT NULL,
  `page_name` varchar(100) DEFAULT NULL,
  `controller_name` varchar(100) DEFAULT NULL,
  `action_name` varchar(100) DEFAULT NULL,
  `icon` varchar(30) DEFAULT NULL,
  `parent_id` int(1) DEFAULT NULL,
  `ordering` int(11) DEFAULT NULL,
  `published` varchar(3) DEFAULT 'Yes',
  `sel_name` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`id`, `model_name`, `page_name`, `controller_name`, `action_name`, `icon`, `parent_id`, `ordering`, `published`, `sel_name`) VALUES
(1, 'Dashboard', 'Dashboard', 'Dashboards', 'index', 'fa fa-dashboard fa-fw', 0, 1, 'Yes', NULL),
(2, 'Subject', 'Subjects', 'Subjects', 'index', 'fa fa-book fa-fw', 0, 5, 'Yes', NULL),
(3, 'Student', 'Students', 'Students', 'index', 'fa fa-graduation-cap fa-fw', 0, 9, 'Yes', 'Iestudents'),
(4, 'Exam', 'Exams', 'Exams', 'index', 'fa fa-list-alt fa-fw', 0, 7, 'Yes', 'Attemptedpapers,Addquestions'),
(5, 'Exam', 'Attempted Papers', 'Attemptedpapers', 'index', '', 4, 6, 'No', NULL),
(6, 'Result', 'Results', 'Results', 'index', 'fa fa-trophy fa-fw', 0, 8, 'Yes', NULL),
(7, 'Configuration', 'Configurations', NULL, NULL, 'fa fa-wrench fa-fw', 0, 12, 'Yes', NULL),
(8, 'Help', 'Help', 'Helps', 'index', 'fa fa-support fa-fw', 0, 15, 'No', NULL),
(9, 'User', 'Users', 'Users', 'index', 'fa fa-user fa-fw', 0, 3, 'Yes', NULL),
(10, 'Class', 'Class', 'Groups', 'index', 'fa fa-users fa-fw', 0, 2, 'Yes', NULL),
(11, 'Content', 'Contents', NULL, NULL, 'fa fa-newspaper-o fa-fw', 0, 13, 'Yes', NULL),
(12, 'Content', 'Home Slides', 'Slides', 'index', '', 11, 3, 'Yes', NULL),
(13, 'Configuration', 'Organisation Logo', 'Weblogos', 'index', '', 7, 4, 'Yes', NULL),
(14, 'Content', 'News', 'News', 'index', '', 11, 1, 'Yes', NULL),
(15, 'Exam', 'Add Question', 'Addquestions', 'index', NULL, 4, 99, 'No', NULL),
(16, 'Content', 'Help Content', 'Helpcontents', 'index', '', 11, 5, 'Yes', NULL),
(17, 'Question', 'Questions', 'Questions', 'index', 'fa fa-question fa-fw', 0, 6, 'Yes', 'Iequestions'),
(18, 'Question', 'Question Import/Export', 'Iequestions', 'index', '', 17, 99, 'No', NULL),
(19, 'Configuration', 'Payment Settings', 'PaymentSettings', 'index', '', 7, 2, 'Yes', NULL),
(20, 'Mailbox', 'Mailbox', 'Mails', 'index', 'fa fa-envelope fa-fw', 0, 11, 'Yes', NULL),
(21, 'Student', 'Student Import/Export', 'Iestudents', 'index', '', 3, 99, 'No', NULL),
(22, 'Configuration', 'General', 'Configurations', 'index', NULL, 7, 1, 'Yes', NULL),
(23, 'Configuration', 'Currency', 'Currencies', 'index', '', 7, 3, 'Yes', NULL),
(24, 'Content', 'Testimonial', 'Testimonials', 'index', NULL, 11, 6, 'Yes', NULL),
(25, 'Content', 'Advertisement', 'Advertisements', 'index', NULL, 11, 7, 'Yes', NULL),
(26, 'Content', 'Pages', 'Contents', 'index', NULL, 11, 2, 'Yes', NULL),
(27, 'Configuration', 'Certificate Signature', 'Signatures', 'index', NULL, 7, 5, 'Yes', NULL),
(28, 'Configuration', 'Diffculty Level', 'Diffs', 'index', NULL, 7, 6, 'Yes', NULL),
(29, 'Configuration', 'Question Type', 'qtypes', 'index', '', 7, 7, 'Yes', NULL),
(30, 'Configuration', 'Menu Names', 'Menunames', 'index', '', 7, 8, 'Yes', NULL),
(31, 'Email & SMS', 'Email & SMS', NULL, NULL, 'fa fa-shield', 0, 14, 'Yes', NULL),
(32, 'Email & SMS', 'E-Mail Settings', 'Emailsettings', 'index', '', 31, 1, 'Yes', NULL),
(33, 'Email & SMS', 'Email Templates', 'Emailtemplates', 'index', NULL, 31, 2, 'Yes', NULL),
(34, 'Email & SMS', 'Send Emails', 'Sendemails', 'index', NULL, 31, 3, 'Yes', NULL),
(35, 'Email & SMS', 'SMS Settings', 'Smssettings', 'index', '', 31, 4, 'Yes', NULL),
(36, 'Email & SMS', 'SMS Templates', 'Smstemplates', NULL, 'index', 31, 5, 'Yes', NULL),
(37, 'Email & SMS', 'Send Sms', 'Sendsms', 'index', '', 31, 6, 'Yes', NULL),
(38, 'Content', 'Seo', 'Seos', 'index', NULL, 11, 8, 'Yes', NULL),
(39, 'Exam', 'Download Result', 'Downloadresults', 'index', NULL, 4, 99, 'No', NULL),
(40, 'Package', 'Packages', 'Packages', 'index', 'fa fa-shopping-cart', 0, 4, 'No', NULL),
(41, 'Salesreport', 'Sales Report', 'Salesreports', 'index', 'fa fa-money', 0, 10, 'No', NULL),
(42, 'Configuration', 'Question Language', 'Languages', 'index', NULL, 7, 2, 'Yes', NULL),
(43, 'Configuration', 'Add Question Language', 'QuestionsLangs', 'index', NULL, 7, 99, 'No', NULL),
(44, 'Passage', 'Passage', 'Passages', 'index', 'fa fa-bars', 0, 5, 'Yes', NULL),
(45, 'Coupon', 'Coupons', 'Coupons', 'index', 'fa fa-magic', 0, 9, 'No', NULL),
(46, 'Topic', 'Topic', 'Topics', 'index', 'fa fa-file', 0, 5, 'Yes', NULL),
(47, 'Sub Topic', 'Sub Topic', 'Stopics', 'index', 'fa fa-file', 0, 5, 'Yes', NULL),
(48, 'Payment', 'Transaction Report', 'TransactionReports', 'index', 'fa fa-shopping-cart', 0, 1, 'No', 'transaction_reports'),
(49, 'Content', 'Home Content', 'Homesections', 'index', '', 11, 4, 'Yes', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `page_rights`
--

CREATE TABLE `page_rights` (
  `id` int(11) NOT NULL,
  `page_id` int(11) NOT NULL,
  `ugroup_id` int(11) NOT NULL,
  `save_right` int(1) DEFAULT NULL,
  `update_right` int(1) DEFAULT NULL,
  `view_right` int(1) DEFAULT NULL,
  `search_right` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `page_rights`
--

INSERT INTO `page_rights` (`id`, `page_id`, `ugroup_id`, `save_right`, `update_right`, `view_right`, `search_right`) VALUES
(1, 1, 3, NULL, NULL, 1, NULL),
(2, 31, 3, NULL, NULL, 1, NULL),
(3, 34, 3, NULL, NULL, 1, NULL),
(4, 37, 3, NULL, NULL, 1, NULL),
(5, 4, 3, NULL, NULL, 1, NULL),
(6, 5, 3, NULL, NULL, 1, NULL),
(7, 15, 3, NULL, NULL, 1, NULL),
(8, 8, 3, NULL, NULL, 1, NULL),
(9, 20, 3, NULL, NULL, 1, NULL),
(10, 30, 3, NULL, NULL, 1, NULL),
(11, 19, 3, NULL, NULL, 1, NULL),
(12, 17, 3, NULL, NULL, 1, NULL),
(13, 18, 3, NULL, NULL, 1, NULL),
(14, 29, 3, NULL, NULL, 1, NULL),
(15, 6, 3, NULL, NULL, 1, NULL),
(16, 3, 3, NULL, NULL, 1, NULL),
(17, 21, 3, NULL, NULL, 1, NULL),
(18, 2, 3, NULL, NULL, 1, NULL),
(19, 1, 2, NULL, NULL, 1, NULL),
(20, 4, 2, NULL, NULL, 1, NULL),
(21, 5, 2, NULL, NULL, 1, NULL),
(22, 15, 2, NULL, NULL, 1, NULL),
(23, 8, 2, NULL, NULL, 1, NULL),
(24, 17, 2, NULL, NULL, 1, NULL),
(25, 18, 2, NULL, NULL, 1, NULL),
(26, 6, 2, NULL, NULL, 1, NULL),
(27, 3, 2, NULL, NULL, 1, NULL),
(28, 21, 2, NULL, NULL, 1, NULL),
(29, 2, 2, NULL, NULL, 1, NULL),
(30, 39, 2, NULL, NULL, 1, NULL),
(31, 39, 3, NULL, NULL, 1, NULL),
(32, 43, 2, NULL, NULL, 1, NULL),
(33, 43, 3, NULL, NULL, 1, NULL),
(34, 44, 2, NULL, NULL, 1, NULL),
(35, 44, 3, NULL, NULL, 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `passages`
--

CREATE TABLE `passages` (
  `id` int(11) NOT NULL,
  `passage` text DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `transaction_id` varchar(20) DEFAULT NULL,
  `amount` decimal(18,2) DEFAULT NULL,
  `coupon_id` int(11) DEFAULT NULL,
  `coupon_amount` decimal(10,2) DEFAULT NULL,
  `remarks` varchar(100) DEFAULT NULL,
  `token` varchar(50) DEFAULT NULL,
  `correlation_id` varchar(50) DEFAULT NULL,
  `timestamp` varchar(50) DEFAULT NULL,
  `status` varchar(10) DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  `name` varchar(13) DEFAULT NULL,
  `type` varchar(3) DEFAULT NULL,
  `payments_from` varchar(10) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`id`, `student_id`, `transaction_id`, `amount`, `coupon_id`, `coupon_amount`, `remarks`, `token`, `correlation_id`, `timestamp`, `status`, `date`, `name`, `type`, `payments_from`, `created`, `modified`) VALUES
(1, 1, '1591504731526620717', '0.00', NULL, NULL, 'Free Purchase Package From Administrator', '15915047311681850966', NULL, NULL, 'Approved', '2020-06-07 10:08:51', 'Free', 'FRE', 'web', '2020-06-07 10:08:51', '2020-06-07 10:08:51'),
(2, 2, '16238603981186035655', '0.00', NULL, NULL, 'Free Purchase Package From Administrator', '16238603981101958007', NULL, NULL, 'Approved', '2021-06-16 21:49:58', 'Free', 'FRE', 'web', '2021-06-16 21:49:58', '2021-06-16 21:49:58');

-- --------------------------------------------------------

--
-- Table structure for table `payment_settings`
--

CREATE TABLE `payment_settings` (
  `id` int(11) NOT NULL,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `signature` varchar(255) DEFAULT NULL,
  `sandbox_mode` tinyint(1) DEFAULT 0,
  `name` varchar(255) DEFAULT NULL,
  `type` varchar(3) DEFAULT NULL,
  `gateway_url` varchar(255) DEFAULT NULL,
  `authorization` varchar(255) DEFAULT NULL,
  `published` varchar(3) DEFAULT 'Yes',
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `payment_settings`
--

INSERT INTO `payment_settings` (`id`, `username`, `password`, `signature`, `sandbox_mode`, `name`, `type`, `gateway_url`, `authorization`, `published`, `created`, `modified`) VALUES
(1, '', '', '', 0, 'Pay Pal', 'PPL', NULL, NULL, 'No', NULL, '2017-03-28 22:54:32'),
(2, '', '', '', 0, 'CC AVENUE', 'CAE', 'https://secure.ccavenue.com', NULL, 'No', NULL, '2017-03-28 22:54:42'),
(3, '', '', '', 0, 'PAYU MONEY', 'PME', '', NULL, 'No', NULL, '2017-06-06 12:18:10');

-- --------------------------------------------------------

--
-- Table structure for table `qtypes`
--

CREATE TABLE `qtypes` (
  `id` int(11) NOT NULL,
  `question_type` varchar(20) DEFAULT NULL,
  `type` char(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `qtypes`
--

INSERT INTO `qtypes` (`id`, `question_type`, `type`) VALUES
(1, 'Objective', 'M'),
(2, 'True / False', 'T'),
(3, 'Fill in the blanks', 'F'),
(4, 'Subjective', 'S');

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE `questions` (
  `id` int(11) NOT NULL,
  `qtype_id` int(11) NOT NULL,
  `subject_id` int(11) NOT NULL,
  `topic_id` int(11) DEFAULT NULL,
  `stopic_id` int(11) DEFAULT NULL,
  `diff_id` int(11) NOT NULL,
  `passage_id` int(11) DEFAULT NULL,
  `question` text DEFAULT NULL,
  `option1` text DEFAULT NULL,
  `option2` text DEFAULT NULL,
  `option3` text DEFAULT NULL,
  `option4` text DEFAULT NULL,
  `option5` text DEFAULT NULL,
  `option6` text DEFAULT NULL,
  `marks` decimal(5,2) DEFAULT NULL,
  `negative_marks` decimal(5,2) DEFAULT NULL,
  `hint` text DEFAULT NULL,
  `explanation` text DEFAULT NULL,
  `answer` varchar(15) DEFAULT NULL,
  `true_false` varchar(5) DEFAULT NULL,
  `fill_blank` text DEFAULT NULL,
  `status` varchar(3) DEFAULT 'Yes',
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`id`, `qtype_id`, `subject_id`, `topic_id`, `stopic_id`, `diff_id`, `passage_id`, `question`, `option1`, `option2`, `option3`, `option4`, `option5`, `option6`, `marks`, `negative_marks`, `hint`, `explanation`, `answer`, `true_false`, `fill_blank`, `status`, `created`, `modified`) VALUES
(1, 1, 4, 4, 4, 2, NULL, 'always less than its atomic number', 'the sum of the number of protons and neutrons present in the nucleus', 'always more than the atomic weight', 'a fraction', NULL, NULL, '4', '0.00', '2.00', NULL, NULL, NULL, NULL, NULL, 'Yes', '2020-08-13 11:28:41', '2020-08-13 11:28:41'),
(2, 1, 4, 4, 4, 2, NULL, 'thermoplastic', 'thermoset', 'chemical compound', 'polymer', NULL, NULL, '4', NULL, '2.00', NULL, NULL, NULL, NULL, NULL, 'Yes', '2020-08-13 11:28:41', '2020-08-13 11:28:41'),
(3, 1, 4, 4, 4, 2, NULL, 'Heat', 'Angular momentum', 'Time', 'Work', NULL, NULL, '4', NULL, '2.00', NULL, NULL, NULL, NULL, NULL, 'Yes', '2020-08-13 11:28:41', '2020-08-13 11:28:41'),
(4, 1, 4, 4, 4, 2, NULL, 'Marie Curie', 'Ernest Rutherfor', 'Henri Becquerel', 'Enrico Fermi', NULL, NULL, '4', NULL, '3.00', NULL, NULL, NULL, NULL, NULL, 'Yes', '2020-08-13 11:28:41', '2020-08-13 11:28:41'),
(5, 1, 4, 4, 4, 2, NULL, '40%', '42%', '44%', '46%', NULL, NULL, '4', NULL, '3.00', NULL, NULL, NULL, NULL, NULL, 'Yes', '2020-08-13 11:28:41', '2020-08-13 11:28:41'),
(6, 1, 4, 4, 4, 2, NULL, '10', '45', '54', '75', NULL, NULL, '4', '0.00', '3.00', NULL, NULL, NULL, NULL, NULL, 'Yes', '2020-08-13 11:28:41', '2020-08-13 11:28:41'),
(7, 1, 4, 4, 4, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '4', NULL, NULL, '1', NULL, NULL, NULL, NULL, 'Yes', '2020-08-13 11:28:41', '2020-08-13 11:28:41'),
(8, 1, 4, 4, 4, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Yes', '2020-08-13 11:28:41', '2020-08-13 11:28:41'),
(9, 1, 4, 4, 4, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, NULL, NULL, 'blue', NULL, NULL, NULL, 'Yes', '2020-08-13 11:28:41', '2020-08-13 11:28:41');

-- --------------------------------------------------------

--
-- Table structure for table `questions_langs`
--

CREATE TABLE `questions_langs` (
  `id` int(11) NOT NULL,
  `question_id` int(11) NOT NULL,
  `language_id` int(11) DEFAULT NULL,
  `question` text DEFAULT NULL,
  `option1` text DEFAULT NULL,
  `option2` text DEFAULT NULL,
  `option3` text DEFAULT NULL,
  `option4` text DEFAULT NULL,
  `option5` text DEFAULT NULL,
  `option6` text DEFAULT NULL,
  `hint` text DEFAULT NULL,
  `explanation` text DEFAULT NULL,
  `fill_blank` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `question_groups`
--

CREATE TABLE `question_groups` (
  `id` int(11) NOT NULL,
  `question_id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `question_groups`
--

INSERT INTO `question_groups` (`id`, `question_id`, `group_id`) VALUES
(1, 1, 3),
(2, 1, 4),
(3, 2, 3),
(4, 2, 4),
(5, 3, 3),
(6, 3, 4),
(7, 4, 3),
(8, 4, 4),
(9, 5, 3),
(10, 5, 4),
(11, 6, 3),
(12, 6, 4),
(13, 7, 3),
(14, 7, 4),
(15, 8, 3),
(16, 8, 4),
(17, 9, 3),
(18, 9, 4);

-- --------------------------------------------------------

--
-- Table structure for table `seos`
--

CREATE TABLE `seos` (
  `id` int(11) NOT NULL,
  `controller` varchar(100) DEFAULT NULL,
  `action` varchar(100) DEFAULT NULL,
  `meta_title` text DEFAULT NULL,
  `meta_keyword` text DEFAULT NULL,
  `meta_content` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `seos`
--

INSERT INTO `seos` (`id`, `controller`, `action`, `meta_title`, `meta_keyword`, `meta_content`) VALUES
(1, 'Registers', 'index', 'New Student Register', '', ''),
(2, 'Users', 'login', 'Student Login Panel', '', ''),
(3, 'Forgots', 'password', 'Forgot Password', '', ''),
(4, 'Forgots', 'presetcode', 'Verification Code', '', ''),
(5, 'Forgots', 'reset', 'Reset Password', '', ''),
(6, 'Emailverifications', 'index', 'Email Verification', '', ''),
(7, 'Emailverifications', 'resend', 'Re-Send Email Verification', '', ''),
(8, 'Packages', 'index', 'Packages', '', ''),
(9, 'Checkouts', 'index', 'Checkout', '', ''),
(10, 'Carts', 'view', 'Shopping Cart', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `slides`
--

CREATE TABLE `slides` (
  `id` int(11) NOT NULL,
  `slide_name` varchar(255) DEFAULT NULL,
  `ordering` int(11) DEFAULT NULL,
  `photo` varchar(100) DEFAULT NULL,
  `dir` varchar(255) DEFAULT NULL,
  `status` varchar(7) DEFAULT 'Active',
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `heading` varchar(200) NOT NULL,
  `content` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `slides`
--

INSERT INTO `slides` (`id`, `slide_name`, `ordering`, `photo`, `dir`, `status`, `created`, `modified`, `heading`, `content`) VALUES
(1, 'Slide1', 1, '9a7906ffc41e8beaafb1bf2a2b982d9a.png', '', 'Active', '2014-12-19 14:42:37', '2017-12-14 05:53:45', 'Flawless Exam Experience ', '<p class=\"text\">Clear Exam interface with Categories , Subject and Question Panel. Ability to switch from one Subject to another and one question to another. Color legends to track your progress. Essential features such as Browser switching features, language change option are also available. <br /> <a class=\"btn h-btn mar-v16 btn-success js-tb-signup-anchor\" href=\"/Registers\">Get started</a></p>');

-- --------------------------------------------------------

--
-- Table structure for table `smssettings`
--

CREATE TABLE `smssettings` (
  `id` int(11) NOT NULL,
  `api` varchar(255) DEFAULT NULL,
  `username` varchar(100) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `senderid` varchar(10) DEFAULT NULL,
  `husername` varchar(100) DEFAULT NULL,
  `hpassword` varchar(100) DEFAULT NULL,
  `hsenderid` varchar(100) DEFAULT NULL,
  `hmobile` varchar(100) DEFAULT NULL,
  `hmessage` varchar(100) DEFAULT NULL,
  `others` varchar(255) DEFAULT NULL,
  `post_type` varchar(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `smssettings`
--

INSERT INTO `smssettings` (`id`, `api`, `username`, `password`, `senderid`, `husername`, `hpassword`, `hsenderid`, `hmobile`, `hmessage`, `others`, `post_type`) VALUES
(1, '', '', '', '', '', '', '', '', '', '', 'GET');

-- --------------------------------------------------------

--
-- Table structure for table `smstemplates`
--

CREATE TABLE `smstemplates` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `status` varchar(11) DEFAULT 'Published',
  `type` varchar(3) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `smstemplates`
--

INSERT INTO `smstemplates` (`id`, `name`, `description`, `status`, `type`) VALUES
(1, 'Student Registration', 'Hi, $studentName Email: $email Password: $password Website: $url Verification Code: $code Sincerely, $siteName', 'Published', 'SRN'),
(2, 'Re-send Verification', 'Hi, $studentName Email: $email Website: $url Verification Code: $code Sincerely, $siteName', 'Published', 'RVN'),
(4, 'Student Forgot Password', 'Dear $studentName, Website: $url Verification Code: $code Sincerely, $siteName', 'Published', 'SFP'),
(5, 'Admin Forgot Password', 'Dear $name, Website: $url Verification Code: $code Sincerely, $siteName', 'Published', 'AFP'),
(6, 'Admin Forgot Username', 'Dear $name, You have forgot User Name. Your username is $userName Sincerely, $siteName', 'Published', 'AFU'),
(7, 'Student Login Credentials', 'Dear $studentName, Your $siteName account is now active. Email: $email Password: $password Website:$url Best Regards, $siteName', 'Published', 'SLC'),
(8, 'User Login Credentials', 'Dear $name, Your $siteName account is now active. Email: $email Uername: $userName Password: $password Website:$url Best Regards, $siteName', 'Published', 'ULC'),
(9, 'Exam Activation', 'Dear $studentName, Exam Name $examName Type $type is active and start on $startDate end on $endDate Sincerely, $siteName', 'Published', 'EAN'),
(10, 'Exam Finalized', 'Dear $studentName, Name: $examName Result: $result Rank: $rank Obtained Marks: $obtainedMarks Question Attempt: $questionAttempt Time Taken: $timeTaken Percentage: $percent % Sincerely, $siteName', 'Published', 'EFD'),
(11, 'Exam Result', 'Dear $studentName, Name: $examName Result: $result Obtained Marks: $obtainedMarks Question Attempt: $questionAttempt Time Taken: $timeTaken Percentage: $percent % Sincerely, $siteName', 'Published', 'ERT'),
(12, 'Package Purchased', 'Dear, $studentName Total Amount: $totalAmount Transaction Id: $transactionId $packageDetail,  Sincerely, $siteName', 'Published', 'PPD');

-- --------------------------------------------------------

--
-- Table structure for table `sociallogins`
--

CREATE TABLE `sociallogins` (
  `id` int(11) NOT NULL,
  `app_id` varchar(100) DEFAULT NULL,
  `app_secret` varchar(200) DEFAULT NULL,
  `callback` varchar(200) DEFAULT NULL,
  `published` varchar(3) DEFAULT 'Yes'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `stopics`
--

CREATE TABLE `stopics` (
  `id` int(11) NOT NULL,
  `subject_id` int(11) DEFAULT NULL,
  `topic_id` int(11) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `stopics`
--

INSERT INTO `stopics` (`id`, `subject_id`, `topic_id`, `name`) VALUES
(4, 4, 4, 'Topic sub');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` int(11) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `phone` varchar(15) DEFAULT NULL,
  `guardian_phone` varchar(15) DEFAULT NULL,
  `enroll` varchar(50) DEFAULT NULL,
  `photo` varchar(100) DEFAULT NULL,
  `status` varchar(7) DEFAULT 'Pending',
  `reg_code` varchar(6) DEFAULT NULL,
  `reg_status` varchar(4) DEFAULT 'Live',
  `expiry_days` int(11) DEFAULT NULL,
  `renewal_date` date DEFAULT NULL,
  `presetcode` varchar(10) DEFAULT NULL,
  `public_key` varchar(100) DEFAULT NULL,
  `private_key` varchar(100) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `last_login` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `email`, `password`, `name`, `address`, `phone`, `guardian_phone`, `enroll`, `photo`, `status`, `reg_code`, `reg_status`, `expiry_days`, `renewal_date`, `presetcode`, `public_key`, `private_key`, `created`, `modified`, `last_login`) VALUES
(1, 'student@student.com', 'dfb37faf99ffd691383e054541f1a3fd1966273d359d85aa419562fc26bf4427', 'Demo Student', 'Demo Address', '000000000', '', 'D-123', NULL, 'Active', NULL, 'Done', 0, '2016-12-07', NULL, NULL, NULL, '2016-12-07 23:42:37', '2020-06-11 08:50:13', '2020-06-11 08:50:13'),
(2, 'student@gmail.com', 'c1c050adcce3294f148466aa8f32e6d12f05d6d7865202daf0f1ed48c73bf250', 'studentname', 'address test here..', '9632587410', '9632587410', '9632587410', '3081bd9d8a7d6614774033281b8e5e35.jpg', 'Active', '', 'Done', 0, '2020-08-31', NULL, 'A782713778E0312', '770113f0a4df9d612aa1c1448670f9ff3f884b3e35f284ec9a6b3c07c39828a6', '2020-06-11 08:49:58', '2021-06-20 15:16:41', '2021-06-20 15:16:40');

-- --------------------------------------------------------

--
-- Table structure for table `student_groups`
--

CREATE TABLE `student_groups` (
  `id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `student_groups`
--

INSERT INTO `student_groups` (`id`, `student_id`, `group_id`) VALUES
(6, 2, 3),
(7, 2, 4);

-- --------------------------------------------------------

--
-- Table structure for table `subjects`
--

CREATE TABLE `subjects` (
  `id` int(11) NOT NULL,
  `subject_name` varchar(255) DEFAULT NULL,
  `ordering` bigint(11) DEFAULT 1,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `subjects`
--

INSERT INTO `subjects` (`id`, `subject_name`, `ordering`, `created`, `modified`) VALUES
(4, 'Maths', 2031595540, '2020-06-11 08:43:37', '2020-06-11 08:43:37'),
(5, 'English', 1825913789, '2020-06-11 08:43:49', '2021-06-16 20:50:29');

-- --------------------------------------------------------

--
-- Table structure for table `subject_exams`
--

CREATE TABLE `subject_exams` (
  `id` int(11) NOT NULL,
  `subject_id` int(11) NOT NULL,
  `exam_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `subject_groups`
--

CREATE TABLE `subject_groups` (
  `id` int(11) NOT NULL,
  `subject_id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `subject_groups`
--

INSERT INTO `subject_groups` (`id`, `subject_id`, `group_id`) VALUES
(6, 4, 3),
(7, 4, 4),
(16, 5, 3),
(17, 5, 4);

-- --------------------------------------------------------

--
-- Table structure for table `testimonials`
--

CREATE TABLE `testimonials` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `photo` varchar(100) DEFAULT NULL,
  `ordering` int(11) DEFAULT NULL,
  `rating` varchar(7) DEFAULT NULL,
  `status` varchar(7) DEFAULT 'Active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `testimonials`
--

INSERT INTO `testimonials` (`id`, `name`, `description`, `photo`, `ordering`, `rating`, `status`) VALUES
(1, 'Joseph', 'This website helped me prepare extremely well for my exams. Highly recommended !', '', 1, '5', 'Active'),
(2, 'Manish Paul', 'The question bank of this website is extensive and prepared me completely for my exam.', '', 2, '5', 'Active'),
(3, 'Ajit', 'Site has useful hints and explanation for questions which is not available on other sites. ', '', 3, '5', 'Active'),
(4, 'Rahul', 'The packages of the site offer more for less money. VALUE FOR MONEY AND TIME. ', '', 4, '5', 'Active'),
(5, 'Pritam', 'Thank you. You were like messiah. Saved time and effort. I could prepare on move and with just my mobile. GREAT. ', '', 5, '5', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `timeline`
--

CREATE TABLE `timeline` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `class_id` int(11) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `attachments` text DEFAULT NULL,
  `short_description` text DEFAULT NULL,
  `description` text DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `timeline`
--

INSERT INTO `timeline` (`id`, `user_id`, `class_id`, `title`, `image`, `attachments`, `short_description`, `description`, `created`, `modified`) VALUES
(1, 3, 2, 'fsdfsdfsd', NULL, NULL, 'time_line', 'time line text all dovvk', NULL, NULL),
(2, 2, 2, 'fsdfsdfsd', NULL, NULL, 'time_line', 'time line text all dovvk', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `topics`
--

CREATE TABLE `topics` (
  `id` int(11) NOT NULL,
  `subject_id` int(11) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `topics`
--

INSERT INTO `topics` (`id`, `subject_id`, `name`) VALUES
(4, 4, 'Topic 1');

-- --------------------------------------------------------

--
-- Table structure for table `ugroups`
--

CREATE TABLE `ugroups` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ugroups`
--

INSERT INTO `ugroups` (`id`, `name`, `created`, `modified`) VALUES
(1, 'Administrator', '2012-07-05 17:16:24', '2012-07-05 17:16:24'),
(2, 'Teacher', '2014-12-12 12:03:23', '2014-12-12 12:03:23'),
(3, 'Manager', '2016-12-07 15:17:25', '2016-12-07 15:17:25');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `email` varchar(150) DEFAULT NULL,
  `name` varchar(40) DEFAULT NULL,
  `mobile` varchar(10) DEFAULT NULL,
  `ugroup_id` int(11) NOT NULL DEFAULT 2,
  `status` enum('Active','Suspend') DEFAULT 'Active',
  `deleted` char(1) DEFAULT NULL,
  `presetcode` varchar(10) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`, `name`, `mobile`, `ugroup_id`, `status`, `deleted`, `presetcode`, `created`, `modified`) VALUES
(1, 'admin', 'dfb37faf99ffd691383e054541f1a3fd1966273d359d85aa419562fc26bf4427', 'root@localhost.com', 'Administrator', '0000000002', 1, 'Active', NULL, NULL, '2014-04-01 21:08:06', '2015-11-14 15:48:05'),
(2, 'teacher', 'dfb37faf99ffd691383e054541f1a3fd1966273d359d85aa419562fc26bf4427', 'teacher@gmail.com', 'teacher', '9632587410', 2, 'Active', NULL, NULL, '2020-06-07 10:23:29', '2021-06-10 20:02:03'),
(3, 'manager', 'dfb37faf99ffd691383e054541f1a3fd1966273d359d85aa419562fc26bf4427', 'manager@gmail.com', 'manager', '9632587410', 3, 'Active', NULL, NULL, '2020-06-07 10:23:53', '2020-06-07 11:18:40');

-- --------------------------------------------------------

--
-- Table structure for table `user_groups`
--

CREATE TABLE `user_groups` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user_groups`
--

INSERT INTO `user_groups` (`id`, `user_id`, `group_id`) VALUES
(15, 1, 3),
(16, 1, 4),
(17, 2, 3),
(19, 1, 6);

-- --------------------------------------------------------

--
-- Table structure for table `wallets`
--

CREATE TABLE `wallets` (
  `id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `in_amount` decimal(18,2) DEFAULT NULL,
  `out_amount` decimal(18,2) DEFAULT NULL,
  `balance` decimal(18,2) DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  `type` varchar(2) DEFAULT NULL,
  `remarks` tinytext DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `advertisements`
--
ALTER TABLE `advertisements`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `configurations`
--
ALTER TABLE `configurations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contents`
--
ALTER TABLE `contents`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `coupons`
--
ALTER TABLE `coupons`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `coupons_students`
--
ALTER TABLE `coupons_students`
  ADD PRIMARY KEY (`id`),
  ADD KEY `student_id` (`student_id`),
  ADD KEY `coupon_id` (`coupon_id`);

--
-- Indexes for table `currencies`
--
ALTER TABLE `currencies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `diffs`
--
ALTER TABLE `diffs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `emailsettings`
--
ALTER TABLE `emailsettings`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `emailtemplates`
--
ALTER TABLE `emailtemplates`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `exams`
--
ALTER TABLE `exams`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `exams_packages`
--
ALTER TABLE `exams_packages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `package_id` (`package_id`),
  ADD KEY `exam_id` (`exam_id`);

--
-- Indexes for table `exam_feedbacks`
--
ALTER TABLE `exam_feedbacks`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `exam_result_id` (`exam_result_id`);

--
-- Indexes for table `exam_groups`
--
ALTER TABLE `exam_groups`
  ADD PRIMARY KEY (`id`),
  ADD KEY `exam_id` (`exam_id`),
  ADD KEY `group_id` (`group_id`);

--
-- Indexes for table `exam_maxquestions`
--
ALTER TABLE `exam_maxquestions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `exam_id` (`exam_id`),
  ADD KEY `subject_id` (`subject_id`);

--
-- Indexes for table `exam_orders`
--
ALTER TABLE `exam_orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `exam_id` (`exam_id`),
  ADD KEY `student_id` (`student_id`),
  ADD KEY `payment_id` (`payment_id`);

--
-- Indexes for table `exam_preps`
--
ALTER TABLE `exam_preps`
  ADD PRIMARY KEY (`id`),
  ADD KEY `exam_id` (`exam_id`),
  ADD KEY `subject_id` (`subject_id`);

--
-- Indexes for table `exam_questions`
--
ALTER TABLE `exam_questions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `exam_id` (`exam_id`),
  ADD KEY `question_id` (`question_id`);

--
-- Indexes for table `exam_results`
--
ALTER TABLE `exam_results`
  ADD PRIMARY KEY (`id`),
  ADD KEY `exam_id` (`exam_id`),
  ADD KEY `student_id` (`student_id`);

--
-- Indexes for table `exam_stats`
--
ALTER TABLE `exam_stats`
  ADD PRIMARY KEY (`id`),
  ADD KEY `exam_id` (`exam_id`),
  ADD KEY `student_id` (`student_id`),
  ADD KEY `question_id` (`question_id`),
  ADD KEY `exam_result_id` (`exam_result_id`);

--
-- Indexes for table `exam_warns`
--
ALTER TABLE `exam_warns`
  ADD PRIMARY KEY (`id`),
  ADD KEY `exam_result_id` (`exam_result_id`);

--
-- Indexes for table `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `group_name` (`group_name`);

--
-- Indexes for table `helpcontents`
--
ALTER TABLE `helpcontents`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `homesections`
--
ALTER TABLE `homesections`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `languages`
--
ALTER TABLE `languages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mails`
--
ALTER TABLE `mails`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `packages`
--
ALTER TABLE `packages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `packages_payments`
--
ALTER TABLE `packages_payments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `payment_id` (`payment_id`),
  ADD KEY `package_id` (`package_id`);

--
-- Indexes for table `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `page_rights`
--
ALTER TABLE `page_rights`
  ADD PRIMARY KEY (`id`),
  ADD KEY `page_id` (`page_id`),
  ADD KEY `ugroup_id` (`ugroup_id`);

--
-- Indexes for table `passages`
--
ALTER TABLE `passages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `student_id` (`student_id`),
  ADD KEY `coupon_id` (`coupon_id`);

--
-- Indexes for table `payment_settings`
--
ALTER TABLE `payment_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `qtypes`
--
ALTER TABLE `qtypes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `qtype_id` (`qtype_id`),
  ADD KEY `subject_id` (`subject_id`),
  ADD KEY `diff_id` (`diff_id`),
  ADD KEY `topic_id` (`topic_id`),
  ADD KEY `stopic_id` (`stopic_id`);

--
-- Indexes for table `questions_langs`
--
ALTER TABLE `questions_langs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `question_id` (`question_id`),
  ADD KEY `language_id` (`language_id`);

--
-- Indexes for table `question_groups`
--
ALTER TABLE `question_groups`
  ADD PRIMARY KEY (`id`),
  ADD KEY `question_id` (`question_id`),
  ADD KEY `group_id` (`group_id`);

--
-- Indexes for table `seos`
--
ALTER TABLE `seos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `slides`
--
ALTER TABLE `slides`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `smssettings`
--
ALTER TABLE `smssettings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `smstemplates`
--
ALTER TABLE `smstemplates`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stopics`
--
ALTER TABLE `stopics`
  ADD PRIMARY KEY (`id`),
  ADD KEY `subject_id` (`subject_id`),
  ADD KEY `topic_id` (`topic_id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `presetcode` (`presetcode`);

--
-- Indexes for table `student_groups`
--
ALTER TABLE `student_groups`
  ADD PRIMARY KEY (`id`),
  ADD KEY `student_id` (`student_id`,`group_id`),
  ADD KEY `group_id` (`group_id`);

--
-- Indexes for table `subjects`
--
ALTER TABLE `subjects`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `subject_name` (`subject_name`);

--
-- Indexes for table `subject_exams`
--
ALTER TABLE `subject_exams`
  ADD PRIMARY KEY (`id`),
  ADD KEY `subject_id` (`subject_id`),
  ADD KEY `exam_id` (`exam_id`);

--
-- Indexes for table `subject_groups`
--
ALTER TABLE `subject_groups`
  ADD PRIMARY KEY (`id`),
  ADD KEY `subject_id` (`subject_id`),
  ADD KEY `group_id` (`group_id`);

--
-- Indexes for table `testimonials`
--
ALTER TABLE `testimonials`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `timeline`
--
ALTER TABLE `timeline`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `topics`
--
ALTER TABLE `topics`
  ADD PRIMARY KEY (`id`),
  ADD KEY `subject_id` (`subject_id`);

--
-- Indexes for table `ugroups`
--
ALTER TABLE `ugroups`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `presetcode` (`presetcode`),
  ADD KEY `ugroup_id` (`ugroup_id`);

--
-- Indexes for table `user_groups`
--
ALTER TABLE `user_groups`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `group_id` (`group_id`);

--
-- Indexes for table `wallets`
--
ALTER TABLE `wallets`
  ADD PRIMARY KEY (`id`),
  ADD KEY `student_id` (`student_id`),
  ADD KEY `student_id_2` (`student_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `advertisements`
--
ALTER TABLE `advertisements`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `configurations`
--
ALTER TABLE `configurations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `contents`
--
ALTER TABLE `contents`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `coupons`
--
ALTER TABLE `coupons`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `coupons_students`
--
ALTER TABLE `coupons_students`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `currencies`
--
ALTER TABLE `currencies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `diffs`
--
ALTER TABLE `diffs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `emailtemplates`
--
ALTER TABLE `emailtemplates`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `exams`
--
ALTER TABLE `exams`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `exams_packages`
--
ALTER TABLE `exams_packages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `exam_feedbacks`
--
ALTER TABLE `exam_feedbacks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `exam_groups`
--
ALTER TABLE `exam_groups`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT for table `exam_maxquestions`
--
ALTER TABLE `exam_maxquestions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `exam_orders`
--
ALTER TABLE `exam_orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `exam_preps`
--
ALTER TABLE `exam_preps`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `exam_questions`
--
ALTER TABLE `exam_questions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `exam_results`
--
ALTER TABLE `exam_results`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `exam_stats`
--
ALTER TABLE `exam_stats`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `exam_warns`
--
ALTER TABLE `exam_warns`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `groups`
--
ALTER TABLE `groups`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `helpcontents`
--
ALTER TABLE `helpcontents`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `homesections`
--
ALTER TABLE `homesections`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `languages`
--
ALTER TABLE `languages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `mails`
--
ALTER TABLE `mails`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `news`
--
ALTER TABLE `news`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `packages`
--
ALTER TABLE `packages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `packages_payments`
--
ALTER TABLE `packages_payments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `pages`
--
ALTER TABLE `pages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT for table `page_rights`
--
ALTER TABLE `page_rights`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `passages`
--
ALTER TABLE `passages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `payment_settings`
--
ALTER TABLE `payment_settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `qtypes`
--
ALTER TABLE `qtypes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE `questions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `questions_langs`
--
ALTER TABLE `questions_langs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `question_groups`
--
ALTER TABLE `question_groups`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `seos`
--
ALTER TABLE `seos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `slides`
--
ALTER TABLE `slides`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `smssettings`
--
ALTER TABLE `smssettings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `smstemplates`
--
ALTER TABLE `smstemplates`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `stopics`
--
ALTER TABLE `stopics`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `student_groups`
--
ALTER TABLE `student_groups`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `subjects`
--
ALTER TABLE `subjects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `subject_exams`
--
ALTER TABLE `subject_exams`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `subject_groups`
--
ALTER TABLE `subject_groups`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `testimonials`
--
ALTER TABLE `testimonials`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `timeline`
--
ALTER TABLE `timeline`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `topics`
--
ALTER TABLE `topics`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `ugroups`
--
ALTER TABLE `ugroups`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user_groups`
--
ALTER TABLE `user_groups`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `wallets`
--
ALTER TABLE `wallets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `coupons_students`
--
ALTER TABLE `coupons_students`
  ADD CONSTRAINT `coupons_students_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `coupons_students_ibfk_2` FOREIGN KEY (`coupon_id`) REFERENCES `coupons` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `exams_packages`
--
ALTER TABLE `exams_packages`
  ADD CONSTRAINT `exams_packages_ibfk_1` FOREIGN KEY (`package_id`) REFERENCES `packages` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `exams_packages_ibfk_2` FOREIGN KEY (`exam_id`) REFERENCES `exams` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `exam_feedbacks`
--
ALTER TABLE `exam_feedbacks`
  ADD CONSTRAINT `exam_feedbacks_ibfk_1` FOREIGN KEY (`exam_result_id`) REFERENCES `exam_results` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `exam_groups`
--
ALTER TABLE `exam_groups`
  ADD CONSTRAINT `exam_groups_ibfk_1` FOREIGN KEY (`exam_id`) REFERENCES `exams` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `exam_groups_ibfk_2` FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `exam_maxquestions`
--
ALTER TABLE `exam_maxquestions`
  ADD CONSTRAINT `exam_maxquestions_ibfk_1` FOREIGN KEY (`exam_id`) REFERENCES `exams` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `exam_maxquestions_ibfk_2` FOREIGN KEY (`subject_id`) REFERENCES `subjects` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `exam_orders`
--
ALTER TABLE `exam_orders`
  ADD CONSTRAINT `exam_orders_ibfk_2` FOREIGN KEY (`exam_id`) REFERENCES `exams` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `exam_orders_ibfk_3` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `exam_orders_ibfk_4` FOREIGN KEY (`payment_id`) REFERENCES `payments` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `exam_preps`
--
ALTER TABLE `exam_preps`
  ADD CONSTRAINT `exam_preps_ibfk_1` FOREIGN KEY (`exam_id`) REFERENCES `exams` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `exam_preps_ibfk_2` FOREIGN KEY (`subject_id`) REFERENCES `subjects` (`id`);

--
-- Constraints for table `exam_questions`
--
ALTER TABLE `exam_questions`
  ADD CONSTRAINT `exam_questions_ibfk_1` FOREIGN KEY (`exam_id`) REFERENCES `exams` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `exam_questions_ibfk_2` FOREIGN KEY (`question_id`) REFERENCES `questions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `exam_results`
--
ALTER TABLE `exam_results`
  ADD CONSTRAINT `exam_results_ibfk_1` FOREIGN KEY (`exam_id`) REFERENCES `exams` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `exam_results_ibfk_2` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `exam_stats`
--
ALTER TABLE `exam_stats`
  ADD CONSTRAINT `exam_stats_ibfk_1` FOREIGN KEY (`exam_id`) REFERENCES `exams` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `exam_stats_ibfk_2` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `exam_stats_ibfk_3` FOREIGN KEY (`question_id`) REFERENCES `questions` (`id`),
  ADD CONSTRAINT `exam_stats_ibfk_4` FOREIGN KEY (`exam_result_id`) REFERENCES `exam_results` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `exam_warns`
--
ALTER TABLE `exam_warns`
  ADD CONSTRAINT `exam_warns_ibfk_1` FOREIGN KEY (`exam_result_id`) REFERENCES `exam_results` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `packages_payments`
--
ALTER TABLE `packages_payments`
  ADD CONSTRAINT `packages_payments_ibfk_1` FOREIGN KEY (`payment_id`) REFERENCES `payments` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `packages_payments_ibfk_2` FOREIGN KEY (`package_id`) REFERENCES `packages` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `page_rights`
--
ALTER TABLE `page_rights`
  ADD CONSTRAINT `page_rights_ibfk_1` FOREIGN KEY (`page_id`) REFERENCES `pages` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `page_rights_ibfk_2` FOREIGN KEY (`ugroup_id`) REFERENCES `ugroups` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `payments`
--
ALTER TABLE `payments`
  ADD CONSTRAINT `payments_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `payments_ibfk_2` FOREIGN KEY (`coupon_id`) REFERENCES `coupons` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `questions`
--
ALTER TABLE `questions`
  ADD CONSTRAINT `questions_ibfk_2` FOREIGN KEY (`subject_id`) REFERENCES `subjects` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `questions_ibfk_3` FOREIGN KEY (`qtype_id`) REFERENCES `qtypes` (`id`),
  ADD CONSTRAINT `questions_ibfk_4` FOREIGN KEY (`diff_id`) REFERENCES `diffs` (`id`),
  ADD CONSTRAINT `questions_ibfk_5` FOREIGN KEY (`topic_id`) REFERENCES `topics` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `questions_ibfk_6` FOREIGN KEY (`stopic_id`) REFERENCES `stopics` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `questions_langs`
--
ALTER TABLE `questions_langs`
  ADD CONSTRAINT `questions_langs_ibfk_1` FOREIGN KEY (`question_id`) REFERENCES `questions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `questions_langs_ibfk_2` FOREIGN KEY (`language_id`) REFERENCES `languages` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `question_groups`
--
ALTER TABLE `question_groups`
  ADD CONSTRAINT `question_groups_ibfk_1` FOREIGN KEY (`question_id`) REFERENCES `questions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `question_groups_ibfk_2` FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `stopics`
--
ALTER TABLE `stopics`
  ADD CONSTRAINT `stopics_ibfk_1` FOREIGN KEY (`subject_id`) REFERENCES `subjects` (`id`),
  ADD CONSTRAINT `stopics_ibfk_2` FOREIGN KEY (`topic_id`) REFERENCES `topics` (`id`);

--
-- Constraints for table `student_groups`
--
ALTER TABLE `student_groups`
  ADD CONSTRAINT `student_groups_ibfk_2` FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `student_groups_ibfk_3` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `subject_groups`
--
ALTER TABLE `subject_groups`
  ADD CONSTRAINT `subject_groups_ibfk_1` FOREIGN KEY (`subject_id`) REFERENCES `subjects` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `subject_groups_ibfk_2` FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`);

--
-- Constraints for table `topics`
--
ALTER TABLE `topics`
  ADD CONSTRAINT `topics_ibfk_1` FOREIGN KEY (`subject_id`) REFERENCES `subjects` (`id`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`ugroup_id`) REFERENCES `ugroups` (`id`);

--
-- Constraints for table `user_groups`
--
ALTER TABLE `user_groups`
  ADD CONSTRAINT `user_groups_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user_groups_ibfk_2` FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `wallets`
--
ALTER TABLE `wallets`
  ADD CONSTRAINT `wallets_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
