-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 10, 2020 at 12:10 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ecommerce`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `email` varchar(45) DEFAULT NULL,
  `password` text DEFAULT NULL,
  `isActive` tinyint(4) DEFAULT 1,
  `role` enum('admin','suberAdmin') NOT NULL DEFAULT 'admin',
  `createdBy` bigint(20) UNSIGNED DEFAULT NULL,
  `modifiedBy` bigint(20) UNSIGNED DEFAULT NULL,
  `created` timestamp NULL DEFAULT current_timestamp(),
  `modified` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `email`, `password`, `isActive`, `role`, `createdBy`, `modifiedBy`, `created`, `modified`) VALUES
(1, 'admin@app.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 1, 'suberAdmin', 1, NULL, '2020-04-27 11:05:34', '2020-04-28 09:16:41');

-- --------------------------------------------------------

--
-- Table structure for table `ads`
--

CREATE TABLE `ads` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `mediaUrl` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mediaType` enum('image','video') COLLATE utf8mb4_unicode_ci NOT NULL,
  `startDate` date NOT NULL,
  `endDate` date NOT NULL,
  `itemId` bigint(20) UNSIGNED NOT NULL,
  `itemType` enum('supplier','product') COLLATE utf8mb4_unicode_ci NOT NULL,
  `viewOrder` int(11) NOT NULL,
  `isActive` tinyint(4) DEFAULT 1,
  `created` timestamp GENERATED ALWAYS AS (current_timestamp()) VIRTUAL,
  `modified` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `createdBy` bigint(20) UNSIGNED DEFAULT NULL,
  `modifiedBy` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ads`
--

INSERT INTO `ads` (`id`, `mediaUrl`, `mediaType`, `startDate`, `endDate`, `itemId`, `itemType`, `viewOrder`, `isActive`, `modified`, `createdBy`, `modifiedBy`) VALUES
(1, 'uploads/ads/first.mp4', 'video', '2020-05-03', '2020-05-24', 1, 'product', 1, 1, '2020-05-10 08:19:36', 1, 1),
(2, 'uploads/ads/tt1.jpg', 'image', '2020-05-03', '2020-05-24', 3, 'product', 3, 1, '2020-05-10 08:36:39', 1, 1),
(3, 'uploads/ads/tt1.jpg', 'image', '2020-05-03', '2020-05-24', 8, 'product', 2, 1, '2020-05-10 08:36:43', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `complaints`
--

CREATE TABLE `complaints` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `content` longtext DEFAULT NULL,
  `created` timestamp NULL DEFAULT current_timestamp(),
  `updated` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `configurations`
--

CREATE TABLE `configurations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `keyword` varchar(20) NOT NULL,
  `value` varchar(45) NOT NULL,
  `created` timestamp GENERATED ALWAYS AS (current_timestamp()) VIRTUAL,
  `modified` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `createdBy` bigint(20) UNSIGNED DEFAULT NULL,
  `modifiedBy` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `main_categories`
--

CREATE TABLE `main_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nameAr` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `displayOrder` int(11) DEFAULT NULL,
  `isActive` tinyint(4) DEFAULT 1,
  `created` timestamp GENERATED ALWAYS AS (current_timestamp()) VIRTUAL,
  `modified` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `createdBy` bigint(20) UNSIGNED NOT NULL,
  `modifiedBy` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `main_categories`
--

INSERT INTO `main_categories` (`id`, `name`, `nameAr`, `image`, `displayOrder`, `isActive`, `modified`, `createdBy`, `modifiedBy`) VALUES
(1, 'Clothing', 'ملابس', 'uploads/category/Clothing.png', 1, 1, '2020-04-27 11:07:42', 1, 1),
(2, 'Electronic', 'اجهزه اليكترونيه', 'uploads/category/Electronic.jpg', 2, 1, '2020-05-10 08:11:59', 1, 1),
(3, 'furnitures', 'اثاث', 'uploads/category/furniture.jpg', 3, 1, '2020-04-27 11:11:00', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `offers`
--

CREATE TABLE `offers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `productId` bigint(20) UNSIGNED NOT NULL,
  `type` enum('amount','percentage') NOT NULL,
  `priceBefore` double NOT NULL,
  `priceAfter` double DEFAULT NULL,
  `isActive` tinyint(4) DEFAULT 1,
  `viewOrder` int(11) DEFAULT NULL,
  `created` timestamp GENERATED ALWAYS AS (current_timestamp()) VIRTUAL,
  `modified` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `createdBy` bigint(20) UNSIGNED NOT NULL,
  `modifiedBy` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `offers`
--

INSERT INTO `offers` (`id`, `productId`, `type`, `priceBefore`, `priceAfter`, `isActive`, `viewOrder`, `modified`, `createdBy`, `modifiedBy`) VALUES
(1, 7, 'amount', 1200, 1100, 1, 1, '2020-05-10 08:53:54', 1, 1),
(2, 2, 'percentage', 250, 230, 1, 3, '2020-05-10 08:24:06', 1, 1),
(3, 8, 'amount', 300, 250, 1, 2, '2020-05-10 08:24:10', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `userId` bigint(20) UNSIGNED DEFAULT NULL,
  `total` double(8,2) NOT NULL,
  `status` enum('new','preparing','delivering','delivered','completed','prepared','canceled') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'new',
  `paymentMethod` enum('online','cash') COLLATE utf8mb4_unicode_ci NOT NULL,
  `notes` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created` timestamp GENERATED ALWAYS AS (current_timestamp()) VIRTUAL,
  `modified` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `order_details`
--

CREATE TABLE `order_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `productId` bigint(20) UNSIGNED NOT NULL,
  `orderId` bigint(20) UNSIGNED NOT NULL,
  `price` double(8,2) NOT NULL,
  `quantity` int(11) NOT NULL,
  `created` timestamp GENERATED ALWAYS AS (current_timestamp()) VIRTUAL,
  `modified` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `nameAr` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `descriptionAr` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `subCategoryId` bigint(20) UNSIGNED DEFAULT NULL,
  `price` double(8,2) NOT NULL,
  `supplierId` bigint(20) UNSIGNED DEFAULT NULL,
  `stock` int(11) NOT NULL,
  `soldCount` int(11) NOT NULL DEFAULT 0,
  `isNew` tinyint(4) DEFAULT 1,
  `isActive` tinyint(1) NOT NULL DEFAULT 1,
  `created` timestamp GENERATED ALWAYS AS (current_timestamp()) VIRTUAL,
  `isDeleted` tinyint(1) NOT NULL DEFAULT 0,
  `modified` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `createdBy` bigint(20) UNSIGNED NOT NULL,
  `modifiedBy` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `description`, `nameAr`, `descriptionAr`, `subCategoryId`, `price`, `supplierId`, `stock`, `soldCount`, `isNew`, `isActive`, `isDeleted`, `modified`, `createdBy`, `modifiedBy`) VALUES
(1, 'shoes', 'A shoe is an item of footwear intended to protect and comfort the human foot. Shoes are also used as an item of decoration and fashion', 'حذاء جلد', 'يستغرق الاعتياد على حذاء جديد وقتًا طويلًا حيث يحتاج الجلد إلى فترة طويلة ليصبح بالطراوة المرغوبة. عادةً ما تصبح الجلود الرقيقة', 3, 150.00, 2, 30, 0, 1, 1, 0, '2020-05-10 08:58:16', 1, 1),
(2, 'Nick Shoes', 'Nike shoes provide excellent support – Nike shoes comes with a herringbone pattern and a solid rubber,', 'حذاء نايك', 'توفر أحذية Nike دعمًا ممتازًا - تأتي أحذية Nike بنمط متعرج ومطاط صلب ،\r\n', 3, 250.00, 2, 10, 0, 1, 1, 0, '2020-05-10 08:57:42', 1, 1),
(3, 'T-shirt', 'Trusted China Suppliers Verified by SGS. Safe Trading T-shirt on Leading B2B Platform.', 'تيشرت', 'موثوق الصين الموردين التحقق من قبل SGS. تي شيرت للتجارة الآمنة على منصة B2B الرائدة.', 1, 30.00, 2, 20, 0, 1, 1, 0, '2020-04-27 11:42:11', 1, 1),
(7, 'Lenovo IdeaPad 500', 'Lenovo IdeaPad 500 is a Windows 10 Home laptop with a 15.60-inch display that has a resolution of 1920x1080 pixels. It is powered by a Core i5 processor and it comes with 6GB of RAM. The Lenovo IdeaPad 500 packs 500GB of HDD storage. Graphics are powered by Intel HD Graphics 52', 'لاب توب لينوفو', 'هو جهاز كمبيوتر محمول يعمل بنظام 10 مع شاشة مقاس 15.60 بوصة بدقة 1920 × 1080 بكسل. يعمل بمعالج Core i5 ويأتي مع 6 غيغابايت من ذاكرة الوصول العشوائي.', 4, 12000.00, 1, 5, 0, 1, 1, 0, '2020-05-10 08:59:19', 1, 1),
(8, 'wooden Table', 'A piece of furniture usually supported by one or more legs and having a flat top surface on which objects can be placed: a dinner table', 'ترابيزه خشبيشه', '. قطعة أثاث عادة مدعومة بساق واحدة أو أكثر ولها سطح علوي مسطح يمكن وضع الأشياء عليه: طاولة عشاء', 7, 300.00, 1, 20, 0, 1, 1, 0, '2020-04-27 11:48:55', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `product_images`
--

CREATE TABLE `product_images` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `productId` bigint(20) UNSIGNED NOT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `displayOrder` int(5) DEFAULT NULL,
  `created` timestamp GENERATED ALWAYS AS (current_timestamp()) VIRTUAL,
  `modified` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `createdBy` bigint(20) UNSIGNED NOT NULL,
  `modifiedBy` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_images`
--

INSERT INTO `product_images` (`id`, `productId`, `image`, `displayOrder`, `modified`, `createdBy`, `modifiedBy`) VALUES
(1, 7, 'uploads/product/l1.jpg', 1, '2020-04-27 11:56:32', 1, 1),
(2, 7, 'uploads/product/l2.jpg', 2, '2020-04-27 11:56:51', 1, 1),
(3, 1, 'uploads/product/s1.jpg', 1, '2020-04-27 11:57:48', 1, 1),
(4, 2, 'uploads/product/s2.jpg', 2, '2020-04-27 11:58:29', 1, 1),
(5, 1, 'uploads/product/s3.jpg', 3, '2020-04-27 11:57:48', 1, 1),
(6, 3, 'uploads/product/tt1.jpg', 1, '2020-04-27 11:59:37', 1, 1),
(7, 3, 'uploads/product/tt2.jpg', 2, '2020-04-27 11:59:37', 1, 1),
(8, 3, 'uploads/product/tt3.jpg', 3, '2020-04-27 11:59:37', 1, 1),
(9, 8, 'uploads/product/w1.jpg', 2, '2020-04-27 12:01:34', 1, 1),
(10, 8, 'uploads/product/w2.jpg', 1, '2020-04-27 12:01:34', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `product_keywords`
--

CREATE TABLE `product_keywords` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `productId` bigint(20) UNSIGNED NOT NULL,
  `keyword` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `keywordAr` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created` timestamp GENERATED ALWAYS AS (current_timestamp()) VIRTUAL,
  `modified` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `createdBy` bigint(20) UNSIGNED NOT NULL,
  `modifiedBy` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_keywords`
--

INSERT INTO `product_keywords` (`id`, `productId`, `keyword`, `keywordAr`, `modified`, `createdBy`, `modifiedBy`) VALUES
(1, 7, 'laptop', 'لاب توب', '2020-04-27 12:12:19', 1, 1),
(2, 7, 'lenovo', 'لاب توب', '2020-04-27 12:12:39', 1, 1),
(3, 1, 'shoes', 'حذاء', '2020-04-27 12:13:40', 1, 1),
(4, 3, 'tshirt', 'تيشيرت', '2020-04-27 12:14:52', 1, 1),
(5, 7, 'table', 'ترابيزا', '2020-04-27 12:15:40', 1, 1),
(6, 8, 'table', 'ترابيزا', '2020-04-27 12:15:40', 1, 1),
(7, 2, 'shoes', 'حذاء', '2020-04-27 12:13:40', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `product_type`
--

CREATE TABLE `product_type` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nameAr` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created` timestamp GENERATED ALWAYS AS (current_timestamp()) VIRTUAL,
  `modified` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `createdBy` bigint(20) UNSIGNED NOT NULL,
  `modifiedBy` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_type`
--

INSERT INTO `product_type` (`id`, `name`, `nameAr`, `modified`, `createdBy`, `modifiedBy`) VALUES
(1, 'clothing', 'ملابس', '2020-04-27 11:31:19', 1, 1),
(2, 'Other', 'اخرى ', '2020-04-27 11:45:20', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `product_type_units`
--

CREATE TABLE `product_type_units` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `productId` bigint(20) UNSIGNED NOT NULL,
  `unitName` varchar(45) DEFAULT NULL,
  `unitNameAr` varchar(45) DEFAULT NULL,
  `value` text NOT NULL,
  `valueAr` text NOT NULL,
  `isActive` tinyint(4) DEFAULT 1,
  `typeId` bigint(20) UNSIGNED DEFAULT NULL,
  `created` timestamp GENERATED ALWAYS AS (current_timestamp()) VIRTUAL,
  `modified` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `createdBy` bigint(20) UNSIGNED NOT NULL,
  `modifiedBy` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `product_type_units`
--

INSERT INTO `product_type_units` (`id`, `productId`, `unitName`, `unitNameAr`, `value`, `valueAr`, `isActive`, `typeId`, `modified`, `createdBy`, `modifiedBy`) VALUES
(1, 2, 'size', 'مقاس', '40,41,42,43', '40,41,42,43', 1, 1, '2020-05-10 08:00:16', 1, 1),
(2, 1, 'size', 'مقاس', '39,40', '39,40', 1, 1, '2020-05-10 08:01:04', 1, 1),
(3, 3, 'size', 'مقاس', 'X,XL,XXL', 'كبير,متوسط', 1, 1, '2020-05-10 08:05:56', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `rate`
--

CREATE TABLE `rate` (
  `id` bigint(20) NOT NULL,
  `rate` smallint(1) NOT NULL,
  `comment` text DEFAULT NULL,
  `userId` bigint(20) UNSIGNED DEFAULT NULL,
  `productId` bigint(20) UNSIGNED DEFAULT NULL,
  `created` timestamp GENERATED ALWAYS AS (current_timestamp()) VIRTUAL,
  `modified` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `sub_categories`
--

CREATE TABLE `sub_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nameAr` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mainCategoryId` bigint(20) UNSIGNED NOT NULL,
  `isActive` tinyint(4) DEFAULT 1,
  `displayOrder` int(11) DEFAULT NULL,
  `created` timestamp GENERATED ALWAYS AS (current_timestamp()) VIRTUAL,
  `modified` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `createdBy` bigint(20) UNSIGNED NOT NULL,
  `modifiedBy` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sub_categories`
--

INSERT INTO `sub_categories` (`id`, `name`, `nameAr`, `image`, `mainCategoryId`, `isActive`, `displayOrder`, `modified`, `createdBy`, `modifiedBy`) VALUES
(1, 'T-shirt', 'تيشرت', 'uploads/category/t-shirt.png', 1, 1, 1, '2020-04-27 11:12:45', 1, 1),
(2, 'trousers', 'بناطيل', 'uploads/category/trousers.png', 1, 1, 2, '2020-04-27 11:19:17', 1, 1),
(3, 'Shoes', 'احذية', 'uploads/category/Shoes.png', 1, 1, 3, '2020-04-27 11:19:21', 1, 1),
(4, 'Computers', 'كمبيوترات', 'uploads/category/pc.png', 2, 1, 1, '2020-04-27 11:18:44', 1, 1),
(5, 'printers', 'طبعات', 'uploads/category/printers.png', 2, 1, 1, '2020-04-27 11:20:23', 1, 1),
(6, 'Phones', 'تلفونات', 'uploads/category/phones.png', 2, 1, 1, '2020-04-27 11:21:06', 1, 1),
(7, 'Tables', 'ترابيزات', 'uploads/category/tables.png', 3, 1, 1, '2020-04-27 11:22:33', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `supplies`
--

CREATE TABLE `supplies` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nameAr` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `titleAr` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created` timestamp GENERATED ALWAYS AS (current_timestamp()) VIRTUAL,
  `modified` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `createdBy` bigint(20) UNSIGNED NOT NULL,
  `modifiedBy` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `supplies`
--

INSERT INTO `supplies` (`id`, `name`, `title`, `nameAr`, `titleAr`, `image`, `phone`, `modified`, `createdBy`, `modifiedBy`) VALUES
(1, 'B-tech', 'Electronic store', 'بى -تك', 'متجر الكترونات', 'uploads/product/b-tech.jpq', '012364894518', '2020-04-27 11:26:44', 1, 1),
(2, 'Active', 'Clothing store', 'اكتف', 'متجر ملابس', 'uploads/product/Active.jpq', '0123894518', '2020-04-27 11:29:03', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('new','banned','active') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `phone1` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone2` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `reset_password_code` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created` timestamp GENERATED ALWAYS AS (current_timestamp()) VIRTUAL,
  `modified` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `createdBy` bigint(20) DEFAULT NULL,
  `modifiedBy` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `email`, `password`, `image`, `status`, `phone1`, `phone2`, `reset_password_code`, `modified`, `createdBy`, `modifiedBy`) VALUES
(1, 'dola', 'dolaamr', 'dola@app.com', '$2y$10$hU5lkmXQg2uTu7Dy0xKJ5.cLYiItB0PIosSI1QZcX0RTq7csAAAky', NULL, 'active', '01234567891', NULL, NULL, '2020-04-27 10:49:51', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users_address`
--

CREATE TABLE `users_address` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `address` varchar(191) NOT NULL,
  `userId` bigint(20) UNSIGNED NOT NULL,
  `created` timestamp GENERATED ALWAYS AS (current_timestamp()) VIRTUAL,
  `modified` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `wish_list`
--

CREATE TABLE `wish_list` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `productId` bigint(20) UNSIGNED NOT NULL,
  `userId` bigint(20) UNSIGNED DEFAULT NULL,
  `created` timestamp GENERATED ALWAYS AS (current_timestamp()) VIRTUAL,
  `modified` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `wish_list`
--

INSERT INTO `wish_list` (`id`, `productId`, `userId`, `modified`) VALUES
(5, 8, 1, '2020-05-10 09:51:36'),
(6, 3, 1, '2020-05-10 09:52:07');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_UNIQUE` (`id`),
  ADD KEY `adminsModifiedBy_idx` (`modifiedBy`),
  ADD KEY `adminCreatedBy` (`createdBy`);

--
-- Indexes for table `ads`
--
ALTER TABLE `ads`
  ADD PRIMARY KEY (`id`,`itemId`),
  ADD UNIQUE KEY `id_UNIQUE` (`id`),
  ADD KEY `adsModifiedBy_idx` (`modifiedBy`),
  ADD KEY `createdBy` (`createdBy`);

--
-- Indexes for table `complaints`
--
ALTER TABLE `complaints`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_UNIQUE` (`id`),
  ADD KEY `user_id_idx` (`user_id`);

--
-- Indexes for table `configurations`
--
ALTER TABLE `configurations`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_UNIQUE` (`id`),
  ADD KEY `configurationsModifiedBy_idx` (`modifiedBy`),
  ADD KEY `createdBy` (`createdBy`);

--
-- Indexes for table `main_categories`
--
ALTER TABLE `main_categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_UNIQUE` (`id`),
  ADD KEY `mainCategoriesModifiedBy_idx` (`modifiedBy`),
  ADD KEY `createdBy` (`createdBy`);

--
-- Indexes for table `offers`
--
ALTER TABLE `offers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_UNIQUE` (`id`),
  ADD KEY `product_id_idx` (`productId`),
  ADD KEY `offersModifiedBy_idx` (`modifiedBy`),
  ADD KEY `createdBy` (`createdBy`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_UNIQUE` (`id`),
  ADD KEY `orders_user_id_foreign` (`userId`);

--
-- Indexes for table `order_details`
--
ALTER TABLE `order_details`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_UNIQUE` (`id`),
  ADD KEY `order_details_product_id_foreign` (`productId`),
  ADD KEY `order_details_order_id_foreign` (`orderId`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_UNIQUE` (`id`),
  ADD KEY `products_category_id_foreign` (`subCategoryId`),
  ADD KEY `products_vendor_id_foreign` (`supplierId`),
  ADD KEY `productsModifiedBy_idx` (`modifiedBy`),
  ADD KEY `createdBy` (`createdBy`);

--
-- Indexes for table `product_images`
--
ALTER TABLE `product_images`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_UNIQUE` (`id`),
  ADD KEY `product_images_product_id_foreign` (`productId`),
  ADD KEY `productImagesModifiedBy_idx` (`modifiedBy`);

--
-- Indexes for table `product_keywords`
--
ALTER TABLE `product_keywords`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_UNIQUE` (`id`),
  ADD KEY `product_images_product_id_foreign` (`productId`),
  ADD KEY `productKeywordsModifiedBy_idx` (`modifiedBy`),
  ADD KEY `createdBy` (`createdBy`);

--
-- Indexes for table `product_type`
--
ALTER TABLE `product_type`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_UNIQUE` (`id`),
  ADD KEY `productTypeModifiedBy_idx` (`modifiedBy`),
  ADD KEY `createdBy` (`createdBy`);

--
-- Indexes for table `product_type_units`
--
ALTER TABLE `product_type_units`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_UNIQUE` (`id`),
  ADD KEY `products_type_units_idx` (`productId`),
  ADD KEY `type_unit_idx` (`typeId`),
  ADD KEY `productTypeUnitsModifiedBy_idx` (`modifiedBy`),
  ADD KEY `createdBy` (`createdBy`);

--
-- Indexes for table `rate`
--
ALTER TABLE `rate`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_UNIQUE` (`id`),
  ADD KEY `product_id_idx` (`productId`),
  ADD KEY `user_id_idx` (`userId`);

--
-- Indexes for table `sub_categories`
--
ALTER TABLE `sub_categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_UNIQUE` (`id`),
  ADD KEY `main_category_id_idx` (`mainCategoryId`),
  ADD KEY `subCategoriesModifiedBy_idx` (`modifiedBy`),
  ADD KEY `createdBy` (`createdBy`);

--
-- Indexes for table `supplies`
--
ALTER TABLE `supplies`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_UNIQUE` (`id`),
  ADD KEY `suppliesModifiedBy_idx` (`modifiedBy`),
  ADD KEY `createdBy` (`createdBy`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_username_unique` (`username`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `id_UNIQUE` (`id`),
  ADD KEY `usersModifiedBy_idx` (`modifiedBy`);

--
-- Indexes for table `users_address`
--
ALTER TABLE `users_address`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_UNIQUE` (`id`),
  ADD KEY `user_id_idx` (`userId`);

--
-- Indexes for table `wish_list`
--
ALTER TABLE `wish_list`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_UNIQUE` (`id`),
  ADD KEY `wish_user_id` (`userId`),
  ADD KEY `product_id_idx` (`productId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `ads`
--
ALTER TABLE `ads`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `complaints`
--
ALTER TABLE `complaints`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `configurations`
--
ALTER TABLE `configurations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `main_categories`
--
ALTER TABLE `main_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `offers`
--
ALTER TABLE `offers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `order_details`
--
ALTER TABLE `order_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `product_images`
--
ALTER TABLE `product_images`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `product_keywords`
--
ALTER TABLE `product_keywords`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `product_type`
--
ALTER TABLE `product_type`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `product_type_units`
--
ALTER TABLE `product_type_units`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `rate`
--
ALTER TABLE `rate`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sub_categories`
--
ALTER TABLE `sub_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `supplies`
--
ALTER TABLE `supplies`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users_address`
--
ALTER TABLE `users_address`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `wish_list`
--
ALTER TABLE `wish_list`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `admins`
--
ALTER TABLE `admins`
  ADD CONSTRAINT `adminCreatedBy` FOREIGN KEY (`createdBy`) REFERENCES `admins` (`id`) ON DELETE SET NULL ON UPDATE SET NULL,
  ADD CONSTRAINT `adminsModifiedBy` FOREIGN KEY (`modifiedBy`) REFERENCES `admins` (`id`) ON DELETE SET NULL ON UPDATE SET NULL;

--
-- Constraints for table `ads`
--
ALTER TABLE `ads`
  ADD CONSTRAINT `adsModifiedBy` FOREIGN KEY (`modifiedBy`) REFERENCES `admins` (`id`) ON DELETE SET NULL ON UPDATE SET NULL,
  ADD CONSTRAINT `ads_ibfk_1` FOREIGN KEY (`createdBy`) REFERENCES `admins` (`id`) ON DELETE SET NULL ON UPDATE SET NULL;

--
-- Constraints for table `complaints`
--
ALTER TABLE `complaints`
  ADD CONSTRAINT `complaint_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE SET NULL;

--
-- Constraints for table `configurations`
--
ALTER TABLE `configurations`
  ADD CONSTRAINT `configurationsModifiedBy` FOREIGN KEY (`modifiedBy`) REFERENCES `admins` (`id`) ON DELETE SET NULL ON UPDATE SET NULL,
  ADD CONSTRAINT `configurations_ibfk_1` FOREIGN KEY (`createdBy`) REFERENCES `admins` (`id`) ON DELETE SET NULL ON UPDATE SET NULL;

--
-- Constraints for table `main_categories`
--
ALTER TABLE `main_categories`
  ADD CONSTRAINT `mainCategoriesModifiedBy` FOREIGN KEY (`modifiedBy`) REFERENCES `admins` (`id`) ON DELETE SET NULL ON UPDATE SET NULL,
  ADD CONSTRAINT `main_categories_ibfk_1` FOREIGN KEY (`createdBy`) REFERENCES `admins` (`id`);

--
-- Constraints for table `offers`
--
ALTER TABLE `offers`
  ADD CONSTRAINT `OfferProduct` FOREIGN KEY (`productId`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `offersModifiedBy` FOREIGN KEY (`modifiedBy`) REFERENCES `admins` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `offers_ibfk_1` FOREIGN KEY (`createdBy`) REFERENCES `admins` (`id`);

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `order_user_id` FOREIGN KEY (`userId`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE SET NULL;

--
-- Constraints for table `order_details`
--
ALTER TABLE `order_details`
  ADD CONSTRAINT `order_detail_product` FOREIGN KEY (`productId`) REFERENCES `products` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `order_id` FOREIGN KEY (`orderId`) REFERENCES `orders` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `productsModifiedBy` FOREIGN KEY (`modifiedBy`) REFERENCES `admins` (`id`) ON DELETE SET NULL ON UPDATE SET NULL,
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`createdBy`) REFERENCES `admins` (`id`),
  ADD CONSTRAINT `sub_category_id` FOREIGN KEY (`subCategoryId`) REFERENCES `sub_categories` (`id`) ON DELETE SET NULL ON UPDATE SET NULL,
  ADD CONSTRAINT `supplier_id` FOREIGN KEY (`supplierId`) REFERENCES `supplies` (`id`) ON DELETE SET NULL ON UPDATE SET NULL;

--
-- Constraints for table `product_images`
--
ALTER TABLE `product_images`
  ADD CONSTRAINT `image_product_id` FOREIGN KEY (`productId`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `productImagesModifiedBy` FOREIGN KEY (`modifiedBy`) REFERENCES `admins` (`id`) ON DELETE SET NULL ON UPDATE SET NULL;

--
-- Constraints for table `product_keywords`
--
ALTER TABLE `product_keywords`
  ADD CONSTRAINT `keyword_product_id` FOREIGN KEY (`productId`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `productKeywordsModifiedBy` FOREIGN KEY (`modifiedBy`) REFERENCES `admins` (`id`) ON DELETE SET NULL ON UPDATE SET NULL,
  ADD CONSTRAINT `product_keywords_ibfk_1` FOREIGN KEY (`createdBy`) REFERENCES `admins` (`id`);

--
-- Constraints for table `product_type`
--
ALTER TABLE `product_type`
  ADD CONSTRAINT `productTypeModifiedBy` FOREIGN KEY (`modifiedBy`) REFERENCES `admins` (`id`) ON DELETE SET NULL ON UPDATE SET NULL,
  ADD CONSTRAINT `product_type_ibfk_1` FOREIGN KEY (`createdBy`) REFERENCES `admins` (`id`);

--
-- Constraints for table `product_type_units`
--
ALTER TABLE `product_type_units`
  ADD CONSTRAINT `productTypeUnitsModifiedBy` FOREIGN KEY (`modifiedBy`) REFERENCES `admins` (`id`) ON DELETE SET NULL ON UPDATE SET NULL,
  ADD CONSTRAINT `product_type_units_ibfk_1` FOREIGN KEY (`createdBy`) REFERENCES `admins` (`id`),
  ADD CONSTRAINT `products_type_units` FOREIGN KEY (`productId`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `type_unit` FOREIGN KEY (`typeId`) REFERENCES `product_type` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `rate`
--
ALTER TABLE `rate`
  ADD CONSTRAINT `rate_product_id` FOREIGN KEY (`productId`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `rate_user_id` FOREIGN KEY (`userId`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `sub_categories`
--
ALTER TABLE `sub_categories`
  ADD CONSTRAINT `main_category_id` FOREIGN KEY (`mainCategoryId`) REFERENCES `main_categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `subCategoriesModifiedBy` FOREIGN KEY (`modifiedBy`) REFERENCES `admins` (`id`) ON DELETE SET NULL ON UPDATE SET NULL,
  ADD CONSTRAINT `sub_categories_ibfk_1` FOREIGN KEY (`createdBy`) REFERENCES `admins` (`id`);

--
-- Constraints for table `supplies`
--
ALTER TABLE `supplies`
  ADD CONSTRAINT `suppliesModifiedBy` FOREIGN KEY (`modifiedBy`) REFERENCES `admins` (`id`) ON DELETE SET NULL ON UPDATE SET NULL,
  ADD CONSTRAINT `supplies_ibfk_1` FOREIGN KEY (`createdBy`) REFERENCES `admins` (`id`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `usersModifiedBy` FOREIGN KEY (`modifiedBy`) REFERENCES `admins` (`id`) ON DELETE SET NULL ON UPDATE SET NULL;

--
-- Constraints for table `users_address`
--
ALTER TABLE `users_address`
  ADD CONSTRAINT `address_user_id` FOREIGN KEY (`userId`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `wish_list`
--
ALTER TABLE `wish_list`
  ADD CONSTRAINT `wish_product_id` FOREIGN KEY (`productId`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `wish_user_id` FOREIGN KEY (`userId`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
