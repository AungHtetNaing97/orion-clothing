-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 28, 2023 at 05:01 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `orion_clothing`
--

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE `brands` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `description` longtext DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0 COMMENT '1=hidden, 0=visible',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `brands`
--

INSERT INTO `brands` (`id`, `name`, `slug`, `image`, `description`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Nike', 'nike', 'public/admin/backend/brands/XRuHq0HsDThWk04czkHOb7RCqyQ8o0R1Au1AXmIv.jpg', 'Nike is renowned for its innovative designs, iconic sportswear, and commitment to inspiring and empowering athletes worldwide.', 0, '2023-05-10 07:15:49', '2023-05-27 12:10:43'),
(2, 'H & M', 'h-&-m', 'public/admin/backend/brands/bmP2U7MKZdqBDBnYz75Tl1wXBFPrKIDF7bUFXEX6.jpg', 'H&M is renowned for its fashion-forward designs, affordable prices, and commitment to sustainability.', 0, '2023-05-10 07:16:15', '2023-05-13 21:59:27'),
(3, 'Adidas', 'adidas', 'public/admin/backend/brands/Tzx3APRQwpWR1palfy02d8W9O9O4tBUMinU7fsJD.jpg', 'Adidas is renowned for its performance-driven designs, cutting-edge athletic technology, and commitment to empowering athletes of all levels.', 0, '2023-05-10 07:16:48', '2023-05-13 22:00:29'),
(4, 'Zara', 'zara', 'public/admin/backend/brands/8OQ2za0pviFiOvgbeQPHw02ZmOkEmzTvgn086AXu.jpg', 'Zara is renowned for its fashion-forward designs, effortless elegance, and commitment to staying ahead of the fashion curve.', 0, '2023-05-10 07:17:17', '2023-05-13 21:59:58'),
(9, 'Puma', 'puma', 'public/admin/backend/brands/b5CNwqtAncy6oJQDCrmo9Krao69qXJxUrbwtRR3Y.jpg', 'Puma is renowned for its stylish designs, athletic performance gear, and commitment to empowering individuals to embrace an active lifestyle.', 0, '2023-05-13 22:01:35', '2023-05-13 22:01:35'),
(11, 'Prada', 'prada', 'public/admin/backend/brands/xHG97q97Iv87oFZejCpqJONyEw5CabDyHDhR4ddf.jpg', 'Prada is a renowned Italian luxury fashion brand known for its sophisticated and minimalist designs.', 0, '2023-05-14 12:50:41', '2023-05-14 12:52:27'),
(12, 'Under Armor', 'under-armor', 'public/admin/backend/brands/h99fMxt9UJ5O6rk03KoFjsLBcZaXE6eGZ2f3emBW.jpg', 'Under Armour is a popular American sportswear brand recognized for its innovative athletic apparel and performance-enhancing technologies.', 0, '2023-05-14 12:53:01', '2023-05-28 06:02:25');

-- --------------------------------------------------------

--
-- Table structure for table `carts`
--

CREATE TABLE `carts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `variant_id` bigint(20) UNSIGNED NOT NULL,
  `quantity` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `carts`
--

INSERT INTO `carts` (`id`, `user_id`, `variant_id`, `quantity`, `created_at`, `updated_at`) VALUES
(17, 8, 9, 3, '2023-05-20 11:30:34', '2023-05-20 11:30:34'),
(18, 8, 11, 3, '2023-05-20 11:30:48', '2023-05-20 11:30:48');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `description` longtext DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0=visible, 1=hidden',
  `is_popular` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0=no, 1=yes',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `slug`, `description`, `image`, `status`, `is_popular`, `created_at`, `updated_at`) VALUES
(7, 'Men\'s Clothing', 'men\'s-clothing', '\"Discover stylish and comfortable men\'s clothing for every occasion.\"', 'public/admin/backend/categories/ZdGMsKHvpd3QsYvUZpw9IcQEcQZRpBxbjY0nBtzU.jpg', 0, 0, '2023-05-13 22:10:30', '2023-05-14 06:25:43'),
(8, 'Women\'s Clothing', 'women\'s-clothing', '\"Elevate your style with our chic and fashionable Women\'s Clothing collection.\"', 'public/admin/backend/categories/WjbrQYH7AhPnWc5NUW1JQkLWPLWrXBF31PiynjZ1.jpg', 0, 0, '2023-05-13 22:14:18', '2023-05-28 06:04:40'),
(9, 'Kids\' Clothing', 'kids\'-clothing', '\"Dress your little ones in style with our adorable and comfortable Kids\' Clothing.\"', 'public/admin/backend/categories/fzOTdlndC7OpaR7VOaKyFytRCZkPCkGHuTLoXXVf.jpg', 0, 0, '2023-05-13 22:21:43', '2023-05-14 10:31:56');

-- --------------------------------------------------------

--
-- Table structure for table `colors`
--

CREATE TABLE `colors` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `code` varchar(255) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0 COMMENT '1=hidden, 0=visible',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `colors`
--

INSERT INTO `colors` (`id`, `name`, `code`, `status`, `created_at`, `updated_at`) VALUES
(1, 'White', 'white', 0, '2023-05-10 07:13:53', '2023-05-28 04:23:37'),
(2, 'Black', 'black', 0, '2023-05-10 07:14:01', '2023-05-11 00:55:21'),
(3, 'Red', 'red', 0, '2023-05-10 07:14:08', '2023-05-11 00:55:13'),
(4, 'Yellow', 'yellow', 0, '2023-05-10 07:14:16', '2023-05-11 00:55:06'),
(5, 'Aqua', 'aqua', 0, '2023-05-10 07:14:32', '2023-05-10 14:39:59');

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

CREATE TABLE `contacts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `subject` varchar(255) NOT NULL,
  `message` longtext NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `contacts`
--

INSERT INTO `contacts` (`id`, `user_id`, `subject`, `message`, `created_at`, `updated_at`) VALUES
(7, 31, 'testing', 'testing', '2023-05-28 00:49:14', '2023-05-28 00:49:14');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2023_05_05_074844_create_colors_table', 2),
(7, '2023_05_06_025244_create_brands_table', 3),
(8, '2023_05_07_081052_create_categories_table', 4),
(9, '2023_05_07_181842_create_products_table', 5),
(10, '2023_05_08_041142_create_product_images_table', 6),
(11, '2023_05_09_140703_create_sizes_table', 7),
(12, '2023_05_10_024709_create_variants_table', 8),
(13, '2023_05_10_122524_create_brands_table', 9),
(14, '2023_05_10_122618_create_categories_table', 9),
(15, '2023_05_10_123433_create_colors_table', 10),
(16, '2023_05_10_123515_create_sizes_table', 11),
(17, '2023_05_10_123548_create_brands_table', 12),
(18, '2023_05_10_123616_create_categories_table', 13),
(19, '2023_05_10_123652_create_products_table', 13),
(20, '2023_05_10_123733_create_product_images_table', 14),
(21, '2023_05_10_123814_create_variants_table', 15),
(23, '2023_05_10_180742_create_variants_table', 16),
(24, '2023_05_11_112644_create_products_table', 17),
(25, '2023_05_11_112737_create_variants_table', 17),
(26, '2023_05_12_030450_create_sliders_table', 18),
(27, '2023_05_12_172741_create_user_details_table', 19),
(29, '2023_05_12_173401_create_contacts_table', 20),
(30, '2023_05_14_040922_create_subcategories_table', 21),
(31, '2023_05_14_122919_create_products_table', 22),
(35, '2023_05_15_162029_create_contacts_table', 23),
(36, '2023_05_17_170101_create_wishlists_table', 24),
(37, '2023_05_19_132053_create_carts_table', 25),
(38, '2023_05_21_122356_create_orders_table', 26),
(39, '2023_05_21_125630_create_order_items_table', 26),
(40, '2023_05_24_021606_create_settings_table', 27),
(41, '2023_05_24_175738_create_user_details_table', 28);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `tracking_no` varchar(255) NOT NULL,
  `fullname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `postal_code` varchar(255) NOT NULL,
  `address` varchar(500) NOT NULL,
  `status_message` varchar(255) NOT NULL,
  `payment_mode` varchar(255) NOT NULL,
  `payment_id` varchar(255) DEFAULT NULL,
  `note` longtext DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `tracking_no`, `fullname`, `email`, `phone`, `postal_code`, `address`, `status_message`, `payment_mode`, `payment_id`, `note`, `created_at`, `updated_at`) VALUES
(35, 12, 'Orion-VWkhAd53qn', 'user', 'user@gmail.com', '+9595171053', '111111', 'heaven', 'in progress', 'Cash on Delivery', NULL, 'abc', '2023-05-26 12:45:15', '2023-05-26 12:45:15'),
(36, 12, 'Orion-2qYvlazvf9', 'user', 'user@gmail.com', '+9595171053', '111111', 'heaven', 'in progress', 'Cash on Delivery', NULL, NULL, '2023-05-26 12:46:47', '2023-05-26 12:46:47'),
(37, 12, 'Orion-MCkyjxjtM0', 'user', 'user@gmail.com', '+9595171053', '111111', 'heaven', 'in progress', 'Paid by Paypal', '1WD55896H4511082W', NULL, '2023-05-26 12:49:39', '2023-05-26 12:49:39'),
(38, 12, 'Orion-cBj4xXV2dr', 'user', 'user@gmail.com', '+9595171053', '111111', 'heaven', 'in progress', 'Paid by Paypal', '5NE582550K443582F', '4', '2023-05-26 12:51:49', '2023-05-26 12:51:49'),
(39, 12, 'Orion-FBxrQHzeUs', 'user', 'user@gmail.com', '+9595171053', '111111', 'heaven', 'in progress', 'Cash on Delivery', NULL, NULL, '2023-05-26 13:17:32', '2023-05-26 13:17:32'),
(51, 31, 'Orion-Tjli30iGa2', 'Aung Htet Naing', 'aunghtetnaing.naing@gmail.com', '+12345678912', '123456', 'somewhere on earth blah blah', 'completed', 'Cash on Delivery', NULL, NULL, '2023-05-28 07:55:44', '2023-05-28 07:56:10'),
(52, 31, 'Orion-C2JY8JCw8x', 'Aung Htet Naing', 'aunghtetnaing.naing@gmail.com', '+12345678912', '123456', 'somewhere on earth blah blah', 'completed', 'Paid by Paypal', '1US75920J2846511T', 'paypal', '2023-05-28 07:58:35', '2023-05-28 07:59:00');

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `variant_id` bigint(20) UNSIGNED NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` decimal(8,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `variant_id`, `quantity`, `price`, `created_at`, `updated_at`) VALUES
(36, 35, 13, 1, '25.40', '2023-05-26 12:45:15', '2023-05-26 12:45:15'),
(37, 36, 13, 2, '25.40', '2023-05-26 12:46:47', '2023-05-26 12:46:47'),
(38, 37, 13, 3, '25.40', '2023-05-26 12:49:39', '2023-05-26 12:49:39'),
(39, 38, 13, 4, '25.40', '2023-05-26 12:51:49', '2023-05-26 12:51:49'),
(40, 39, 13, 1, '25.40', '2023-05-26 13:17:32', '2023-05-26 13:17:32'),
(61, 51, 33, 1, '12.00', '2023-05-28 07:55:44', '2023-05-28 07:55:44'),
(62, 52, 18, 1, '12.00', '2023-05-28 07:58:35', '2023-05-28 07:58:35'),
(63, 52, 7, 2, '12.00', '2023-05-28 07:58:35', '2023-05-28 07:58:35'),
(64, 52, 4, 4, '12.00', '2023-05-28 07:58:35', '2023-05-28 07:58:35');

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `short_description` mediumtext DEFAULT NULL,
  `description` longtext DEFAULT NULL,
  `regular_price` decimal(8,2) NOT NULL,
  `sale_price` decimal(8,2) DEFAULT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `subcategory_id` bigint(20) UNSIGNED NOT NULL,
  `brand_id` bigint(20) UNSIGNED NOT NULL,
  `code` varchar(255) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0=visible, 1=hidden',
  `trending` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0=no, 1=yes',
  `featured` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0=no, 1=yes',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `slug`, `short_description`, `description`, `regular_price`, `sale_price`, `category_id`, `subcategory_id`, `brand_id`, `code`, `status`, `trending`, `featured`, `created_at`, `updated_at`) VALUES
(1, 'Colorful Pattern Shirts', 'colorful-pattern-shirts', 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Aliquam rem officia, corrupti reiciendis minima nisi modi, quasi, odio minus dolore impedit fuga eum eligendi? Officia doloremque facere quia. Voluptatum, accusantium!', 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Aliquam rem officia, corrupti reiciendis minima nisi modi, quasi, odio minus dolore impedit fuga eum eligendi? Officia doloremque facere quia. Voluptatum, accusantium!Lorem ipsum dolor, sit amet consectetur adipisicing elit. Aliquam rem officia, corrupti reiciendis minima nisi modi, quasi, odio minus dolore impedit fuga eum eligendi? Officia doloremque facere quia. Voluptatum, accusantium!', '20.33', '19.00', 7, 12, 4, 'CPS-BN6', 0, 0, 1, '2023-05-14 06:00:55', '2023-05-27 08:00:01'),
(2, 'Vintage Floral Oil Shirts', 'vintage-floral-oil-shirts', 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Aliquam rem officia, corrupti reiciendis minima nisi modi, quasi, odio minus dolore impedit fuga eum eligendi? Officia doloremque facere quia. Voluptatum, accusantium!', 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Aliquam rem officia, corrupti reiciendis minima nisi modi, quasi, odio minus dolore impedit fuga eum eligendi? Officia doloremque facere quia. Voluptatum, accusantium!Lorem ipsum dolor, sit amet consectetur adipisicing elit. Aliquam rem officia, corrupti reiciendis minima nisi modi, quasi, odio minus dolore impedit fuga eum eligendi? Officia doloremque facere quia. Voluptatum, accusantium!', '20.00', '18.00', 7, 12, 9, 'VFOS-2CD', 0, 1, 0, '2023-05-14 06:01:57', '2023-05-27 07:59:17'),
(3, 'Mens Porcelain Shirt', 'mens-porcelain-shirt', 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Aliquam rem officia, corrupti reiciendis minima nisi modi, quasi, odio minus dolore impedit fuga eum eligendi? Officia doloremque facere quia. Voluptatum, accusantium!', 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Aliquam rem officia, corrupti reiciendis minima nisi modi, quasi, odio minus dolore impedit fuga eum eligendi? Officia doloremque facere quia. Voluptatum, accusantium!Lorem ipsum dolor, sit amet consectetur adipisicing elit. Aliquam rem officia, corrupti reiciendis minima nisi modi, quasi, odio minus dolore impedit fuga eum eligendi? Officia doloremque facere quia. Voluptatum, accusantium!', '36.00', NULL, 7, 12, 2, 'MPS-QGE', 0, 1, 0, '2023-05-14 06:04:33', '2023-05-28 06:15:28'),
(4, 'Landscape Painting Shirt', 'landscape-painting-shirt', 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Aliquam rem officia, corrupti reiciendis minima nisi modi, quasi, odio minus dolore impedit fuga eum eligendi? Officia doloremque facere quia. Voluptatum, accusantium!', 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Aliquam rem officia, corrupti reiciendis minima nisi modi, quasi, odio minus dolore impedit fuga eum eligendi? Officia doloremque facere quia. Voluptatum, accusantium!Lorem ipsum dolor, sit amet consectetur adipisicing elit. Aliquam rem officia, corrupti reiciendis minima nisi modi, quasi, odio minus dolore impedit fuga eum eligendi? Officia doloremque facere quia. Voluptatum, accusantium!', '15.00', '14.00', 7, 12, 4, 'LPS-LIX', 0, 1, 0, '2023-05-14 06:08:14', '2023-05-27 07:54:52'),
(5, 'Element Pattern Print Shirts', 'element-pattern-print-shirts', 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Aliquam rem officia, corrupti reiciendis minima nisi modi, quasi, odio minus dolore impedit fuga eum eligendi? Officia doloremque facere quia. Voluptatum, accusantium!', 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Aliquam rem officia, corrupti reiciendis minima nisi modi, quasi, odio minus dolore impedit fuga eum eligendi? Officia doloremque facere quia. Voluptatum, accusantium!Lorem ipsum dolor, sit amet consectetur adipisicing elit. Aliquam rem officia, corrupti reiciendis minima nisi modi, quasi, odio minus dolore impedit fuga eum eligendi? Officia doloremque facere quia. Voluptatum, accusantium!', '35.00', '30.40', 8, 8, 9, 'EPPS-39G', 0, 1, 0, '2023-05-14 06:09:55', '2023-05-27 08:09:23'),
(6, 'Cartoon Astronaut T-Shirts', 'cartoon-astronaut-t-shirts', 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Aliquam rem officia, corrupti reiciendis minima nisi modi, quasi, odio minus dolore impedit fuga eum eligendi? Officia doloremque facere quia. Voluptatum, accusantium!', 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Aliquam rem officia, corrupti reiciendis minima nisi modi, quasi, odio minus dolore impedit fuga eum eligendi? Officia doloremque facere quia. Voluptatum, accusantium!Lorem ipsum dolor, sit amet consectetur adipisicing elit. Aliquam rem officia, corrupti reiciendis minima nisi modi, quasi, odio minus dolore impedit fuga eum eligendi? Officia doloremque facere quia. Voluptatum, accusantium!', '30.00', '25.40', 7, 5, 2, 'CAT-9JG', 0, 0, 1, '2023-05-14 06:13:35', '2023-05-27 08:00:15'),
(7, 'Ethnic Floral Casual Shirts', 'ethnic-floral-casual-shirts', 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Aliquam rem officia, corrupti reiciendis minima nisi modi, quasi, odio minus dolore impedit fuga eum eligendi? Officia doloremque facere quia. Voluptatum, accusantium!', 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Aliquam rem officia, corrupti reiciendis minima nisi modi, quasi, odio minus dolore impedit fuga eum eligendi? Officia doloremque facere quia. Voluptatum, accusantium!Lorem ipsum dolor, sit amet consectetur adipisicing elit. Aliquam rem officia, corrupti reiciendis minima nisi modi, quasi, odio minus dolore impedit fuga eum eligendi? Officia doloremque facere quia. Voluptatum, accusantium!', '40.00', NULL, 7, 12, 1, 'EFCS-1UT', 0, 1, 0, '2023-05-14 06:15:14', '2023-05-27 08:07:27'),
(9, 'Cotton Leaf Printed', 'cotton-leaf-printed', 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Aliquam rem officia, corrupti reiciendis minima nisi modi, quasi, odio minus dolore impedit fuga eum eligendi? Officia doloremque facere quia. Voluptatum, accusantium!', 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Aliquam rem officia, corrupti reiciendis minima nisi modi, quasi, odio minus dolore impedit fuga eum eligendi? Officia doloremque facere quia. Voluptatum, accusantium!Lorem ipsum dolor, sit amet consectetur adipisicing elit. Aliquam rem officia, corrupti reiciendis minima nisi modi, quasi, odio minus dolore impedit fuga eum eligendi? Officia doloremque facere quia. Voluptatum, accusantium!', '15.00', '14.00', 8, 7, 3, 'CLP-PYI', 0, 0, 1, '2023-05-14 06:20:33', '2023-05-27 08:07:07'),
(11, 'Cotton Leaf Blouse', 'cotton-leaf-blouse', 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Aliquam rem officia, corrupti reiciendis minima nisi modi, quasi, odio minus dolore impedit fuga eum eligendi? Officia doloremque facere quia. Voluptatum, accusantium!', 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Aliquam rem officia, corrupti reiciendis minima nisi modi, quasi, odio minus dolore impedit fuga eum eligendi? Officia doloremque facere quia. Voluptatum, accusantium!Lorem ipsum dolor, sit amet consectetur adipisicing elit. Aliquam rem officia, corrupti reiciendis minima nisi modi, quasi, odio minus dolore impedit fuga eum eligendi? Officia doloremque facere quia. Voluptatum, accusantium!', '15.00', '12.00', 8, 7, 9, 'CLB-G8L', 0, 0, 1, '2023-05-14 06:34:26', '2023-05-27 07:59:43'),
(13, 'Flowers Sleeve Lapel Shirt', 'flowers-sleeve-lapel-shirt', 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Aliquam rem officia, corrupti reiciendis minima nisi modi, quasi, odio minus dolore impedit fuga eum eligendi? Officia doloremque facere quia. Voluptatum, accusantium!', 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Aliquam rem officia, corrupti reiciendis minima nisi modi, quasi, odio minus dolore impedit fuga eum eligendi? Officia doloremque facere quia. Voluptatum, accusantium!\r\n                                                            Lorem ipsum dolor, sit amet consectetur adipisicing elit. Aliquam rem officia, corrupti reiciendis minima nisi modi, quasi, odio minus dolore impedit fuga eum eligendi? Officia doloremque facere quia. Voluptatum, accusantium!', '25.00', '20.00', 8, 8, 11, 'FSLS-H7U', 0, 0, 1, '2023-05-18 00:34:05', '2023-05-27 08:09:42'),
(20, 'Plain Striola Shirts', 'plain-striola-shirts', 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Aliquam rem officia, corrupti reiciendis minima nisi modi, quasi, odio minus dolore impedit fuga eum eligendi? Officia doloremque facere quia. Voluptatum, accusantium!', 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Aliquam rem officia, corrupti reiciendis minima nisi modi, quasi, odio minus dolore impedit fuga eum eligendi? Officia doloremque facere quia. Voluptatum, accusantium!Lorem ipsum dolor, sit amet consectetur adipisicing elit. Aliquam rem officia, corrupti reiciendis minima nisi modi, quasi, odio minus dolore impedit fuga eum eligendi? Officia doloremque facere quia. Voluptatum, accusantium!', '10.00', '9.99', 9, 10, 12, 'PSS-WHD', 0, 0, 0, '2023-05-27 03:11:41', '2023-05-27 03:11:41'),
(21, 'Letter Print Dress', 'letter-print-dress', 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Aliquam rem officia, corrupti reiciendis minima nisi modi, quasi, odio minus dolore impedit fuga eum eligendi? Officia doloremque facere quia. Voluptatum, accusantium!', 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Aliquam rem officia, corrupti reiciendis minima nisi modi, quasi, odio minus dolore impedit fuga eum eligendi? Officia doloremque facere quia. Voluptatum, accusantium!Lorem ipsum dolor, sit amet consectetur adipisicing elit. Aliquam rem officia, corrupti reiciendis minima nisi modi, quasi, odio minus dolore impedit fuga eum eligendi? Officia doloremque facere quia. Voluptatum, accusantium!', '30.00', '28.00', 9, 11, 12, 'LPD-RR4', 0, 1, 0, '2023-05-27 03:22:28', '2023-05-27 07:56:06'),
(22, 'Vintage Henley Tshirt', 'vintage-henley-tshirt', 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Aliquam rem officia, corrupti reiciendis minima nisi modi, quasi, odio minus dolore impedit fuga eum eligendi? Officia doloremque facere quia. Voluptatum, accusantium!', 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Aliquam rem officia, corrupti reiciendis minima nisi modi, quasi, odio minus dolore impedit fuga eum eligendi? Officia doloremque facere quia. Voluptatum, accusantium!Lorem ipsum dolor, sit amet consectetur adipisicing elit. Aliquam rem officia, corrupti reiciendis minima nisi modi, quasi, odio minus dolore impedit fuga eum eligendi? Officia doloremque facere quia. Voluptatum, accusantium!', '24.50', NULL, 7, 5, 12, 'VHT-PPZ', 0, 0, 0, '2023-05-27 07:20:50', '2023-05-27 07:20:50'),
(23, 'Plain Color Pocket Shirts', 'plain-color-pocket-shirts', 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Aliquam rem officia, corrupti reiciendis minima nisi modi, quasi, odio minus dolore impedit fuga eum eligendi? Officia doloremque facere quia. Voluptatum, accusantium!', 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Aliquam rem officia, corrupti reiciendis minima nisi modi, quasi, odio minus dolore impedit fuga eum eligendi? Officia doloremque facere quia. Voluptatum, accusantium!Lorem ipsum dolor, sit amet consectetur adipisicing elit. Aliquam rem officia, corrupti reiciendis minima nisi modi, quasi, odio minus dolore impedit fuga eum eligendi? Officia doloremque facere quia. Voluptatum, accusantium!', '15.00', '12.75', 7, 5, 12, 'PCPS-QEQ', 0, 0, 1, '2023-05-27 07:38:56', '2023-05-27 07:56:23'),
(24, 'Colorful Hawaiian Top', 'colorful-hawaiian-top', NULL, NULL, '20.99', '20.00', 8, 8, 12, 'CHT-EBZ', 0, 1, 0, '2023-05-27 07:42:28', '2023-05-27 07:52:23');

-- --------------------------------------------------------

--
-- Table structure for table `product_images`
--

CREATE TABLE `product_images` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `image` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_images`
--

INSERT INTO `product_images` (`id`, `product_id`, `image`, `created_at`, `updated_at`) VALUES
(24, 1, 'public/admin/backend/products/8y1lB5AWhAuI41wXje9dwRT5CCLNgATbgBDejH4R.jpg', '2023-05-14 06:00:56', '2023-05-14 06:00:56'),
(25, 1, 'public/admin/backend/products/NOwedjAbrJneJnTbZjWdE3apFpsZfow8OFnFcH6o.jpg', '2023-05-14 06:00:56', '2023-05-14 06:00:56'),
(26, 2, 'public/admin/backend/products/CROr1lNJESoxZe4sEN1kyY5MssriCtceCwcWmAEi.jpg', '2023-05-14 06:01:57', '2023-05-14 06:01:57'),
(27, 2, 'public/admin/backend/products/ZNvyp6efbcsspqKTlnDRmgHbSAvavNNnCVZx8goV.jpg', '2023-05-14 06:01:57', '2023-05-14 06:01:57'),
(28, 3, 'public/admin/backend/products/aNgtV0WdiWiHbiYKgqje67DetAAtuF7gkDQVw9Rs.jpg', '2023-05-14 06:04:33', '2023-05-14 06:04:33'),
(29, 3, 'public/admin/backend/products/4cJFPR2zV6GmFbrPw4sxWPFhpgBsQnrjvremC2m5.jpg', '2023-05-14 06:04:33', '2023-05-14 06:04:33'),
(30, 4, 'public/admin/backend/products/HZObSaeGTjpL4UZfpQAABumnDdZyB35Xbh3YywQB.jpg', '2023-05-14 06:08:14', '2023-05-14 06:08:14'),
(31, 4, 'public/admin/backend/products/d4y4a9ZfVLCwwACV2O1C37a6CDLn8y0f6p1Btsvr.jpg', '2023-05-14 06:08:14', '2023-05-14 06:08:14'),
(32, 5, 'public/admin/backend/products/TUNnQMsu2iPBB7fFBszkj7SaQ5sJhUU5axOeQaJy.jpg', '2023-05-14 06:09:55', '2023-05-14 06:09:55'),
(33, 5, 'public/admin/backend/products/kvWS3TIyZLZ7JNQC20Ho9PJQteOapFx66KXJfsds.jpg', '2023-05-14 06:09:55', '2023-05-14 06:09:55'),
(34, 6, 'public/admin/backend/products/87Lny1IXEJBim1s0un1KdIbU7BSCiaenW2Gio4WK.jpg', '2023-05-14 06:13:35', '2023-05-14 06:13:35'),
(35, 6, 'public/admin/backend/products/gidoFafuHKZS4fn3wJQDGexBY8e6cuxko9tmuvly.jpg', '2023-05-14 06:13:35', '2023-05-14 06:13:35'),
(36, 7, 'public/admin/backend/products/gh1Bq31fur2bvIdaxgtsVGeMqtVVlVr4iLBmDSUB.jpg', '2023-05-14 06:15:14', '2023-05-14 06:15:14'),
(37, 7, 'public/admin/backend/products/st3dScKqYwt80fmZFXLEo6iWeHhFu3kLj88kTECM.jpg', '2023-05-14 06:15:14', '2023-05-14 06:15:14'),
(42, 9, 'public/admin/backend/products/FKbb5HI91Dzzmc3Sz2zh2cvWk4XAjkdvfLKzD7rq.jpg', '2023-05-14 06:20:33', '2023-05-14 06:20:33'),
(43, 9, 'public/admin/backend/products/GcuLP2vvCUrlwQpIckUbUU8bfXFuJZVNcLrh6AA2.jpg', '2023-05-14 06:20:33', '2023-05-14 06:20:33'),
(45, 11, 'public/admin/backend/products/Fhm27805jtbzTmiETMsKqnWa0kDEeWoprWtgRKPv.jpg', '2023-05-14 06:34:26', '2023-05-14 06:34:26'),
(49, 13, 'public/admin/backend/products/FSVDPXcBCetF6ffB4YmSwrBqFbtmWvI1xZZ25nV3.jpg', '2023-05-18 00:34:05', '2023-05-18 00:34:05'),
(50, 13, 'public/admin/backend/products/3GJ5BvIdbJZPtI50rQs1tcC6yI4eXTEgt0yfX5fv.jpg', '2023-05-18 00:34:05', '2023-05-18 00:34:05'),
(59, 20, 'public/admin/backend/products/YcI2f5acBQVgGJ7BQ1phqwyMzrqlD1P4ackzm9qY.jpg', '2023-05-27 03:11:41', '2023-05-27 03:11:41'),
(60, 20, 'public/admin/backend/products/089UwODmteqApJr29Uja4kuMZK68HBhhkbEPnotZ.jpg', '2023-05-27 03:11:41', '2023-05-27 03:11:41'),
(61, 21, 'public/admin/backend/products/Bt3Hm0isOxzFLVlfxG0J7zhNXTpyoBuXDEm9sQgB.jpg', '2023-05-27 03:22:28', '2023-05-27 03:22:28'),
(62, 21, 'public/admin/backend/products/LuE5OFPcOZIw50BISaPRKrpeVRtrlxUc0tGzVPNB.jpg', '2023-05-27 03:22:28', '2023-05-27 03:22:28'),
(63, 22, 'public/admin/backend/products/bmw4TrjvAEEDZ4JCOLMzxsLsej0QVvRM9mQgEAbI.jpg', '2023-05-27 07:20:50', '2023-05-27 07:20:50'),
(64, 22, 'public/admin/backend/products/196cVEPVyKfjJchX5KBV1QwD8cyp8QSUenpUHBMv.jpg', '2023-05-27 07:20:50', '2023-05-27 07:20:50'),
(65, 23, 'public/admin/backend/products/G1HKUgHK5lwt6fzTDmrSzMNhU17fOQOoOgpiNT1x.jpg', '2023-05-27 07:38:56', '2023-05-27 07:38:56'),
(66, 24, 'public/admin/backend/products/lZ3kSbYfhzZnUXCJvEiovUvrC0TA2RLLoi4jT79j.jpg', '2023-05-27 07:42:28', '2023-05-27 07:42:28'),
(67, 24, 'public/admin/backend/products/2AOCw1WKnoySzozBbJ45y0Tuzyi39AdDBRblQA24.jpg', '2023-05-27 07:42:28', '2023-05-27 07:42:28');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `url` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `address` varchar(500) NOT NULL,
  `address_href` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `phone_href` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_href` varchar(255) NOT NULL,
  `facebook` varchar(255) DEFAULT NULL,
  `twitter` varchar(255) DEFAULT NULL,
  `instagram` varchar(255) DEFAULT NULL,
  `youtube` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `name`, `url`, `image`, `address`, `address_href`, `phone`, `phone_href`, `email`, `email_href`, `facebook`, `twitter`, `instagram`, `youtube`, `created_at`, `updated_at`) VALUES
(2, 'Orion Clothing', 'https://localhost:8000/', '1685269949.png', 'No. 100, Pyay Road, Yangon', 'https://www.google.com/maps/place/Government+of+Yangon+Region/@16.7952118,96.1376292,18.56z/data=!4m6!3m5!1s0x30c1eb6990de8795:0xaec1dd06c856eb17!8m2!3d16.7952619!4d96.1377153!16s%2Fg%2F11bz_zxpn7', '(+95) 9977-9300-21', '+959977930021', 'orionclothing1991@gmail.com', 'orionclothing1991@gmail.com', 'https://www.facebook.com/', 'https://www.twitter.com/', 'https://www.instagram.com/', 'https://www.youtube.com/', '2023-05-24 02:16:27', '2023-05-28 04:02:29');

-- --------------------------------------------------------

--
-- Table structure for table `sizes`
--

CREATE TABLE `sizes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `code` varchar(255) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0 COMMENT '1=hidden, 0=visible',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sizes`
--

INSERT INTO `sizes` (`id`, `name`, `code`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Small', 'S', 0, '2023-05-10 06:11:45', '2023-05-28 04:21:38'),
(2, 'Large', 'L', 0, '2023-05-10 06:12:01', '2023-05-11 00:54:26'),
(3, 'Extra Large', 'XL', 0, '2023-05-10 07:12:57', '2023-05-11 00:54:19'),
(4, 'Extra Extra Large', 'XXL', 0, '2023-05-10 07:13:17', '2023-05-10 14:40:18'),
(5, 'Extra Small', 'XS', 0, '2023-05-10 08:42:30', '2023-05-11 00:54:13');

-- --------------------------------------------------------

--
-- Table structure for table `sliders`
--

CREATE TABLE `sliders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `top_title` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `sub_title` varchar(255) DEFAULT NULL,
  `offer` varchar(255) DEFAULT NULL,
  `link` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0 COMMENT '1=hidden, 0=visible',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sliders`
--

INSERT INTO `sliders` (`id`, `top_title`, `title`, `sub_title`, `offer`, `link`, `image`, `status`, `created_at`, `updated_at`) VALUES
(3, 'Hot Promotions', 'Fashion Trending', 'Great Collection', 'Save more with coupons & up to 70% off', 'http://localhost:8000/shop', 'public/admin/backend/sliders/nHBLIGXhCWrxxiKmR98AQMN6ZwXaYyzU0JQNfTDa.png', 0, '2023-05-12 03:22:49', '2023-05-28 04:04:00'),
(4, 'Trade-in offer', 'Super value deals', 'On all items', 'Save more with coupons & up to 20% off', 'http://localhost:8000/shop', 'public/admin/backend/sliders/Ji4LtOiSdyv8Eslg0f8okW60lichaSFuL54nqmUd.png', 0, '2023-05-12 03:24:42', '2023-05-27 10:20:08');

-- --------------------------------------------------------

--
-- Table structure for table `subcategories`
--

CREATE TABLE `subcategories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `description` longtext DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0=visible, 1=hidden',
  `is_popular` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0=no, 1=yes',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `subcategories`
--

INSERT INTO `subcategories` (`id`, `name`, `slug`, `description`, `image`, `category_id`, `status`, `is_popular`, `created_at`, `updated_at`) VALUES
(5, 'Tshirts', 'tshirts', 'Classic, versatile, and effortlessly stylish, T-shirts are a wardrobe essential that blend comfort and fashion, perfect for everyday wear or dressing up for any casual occasion.', 'public/admin/backend/subcategories/AHGZqXNwfdok31vHv2b3eJjO9y3fPNwpdUvHaS7V.jpg', 7, 0, 0, '2023-05-14 02:39:19', '2023-05-14 12:21:52'),
(6, 'Pants', 'pants', 'Pants, combining style and comfort for a polished and versatile look.', 'public/admin/backend/subcategories/bvZdTBQIttHUtmOdMkAKw75eabFvcREy9Mhnh1Qd.png', 7, 0, 0, '2023-05-14 02:45:16', '2023-05-14 12:19:39'),
(7, 'Dresses', 'dresses', 'Dresses, the ultimate symbol of femininity and elegance, effortlessly elevate any occasion with their timeless charm and flattering silhouettes.', 'public/admin/backend/subcategories/rhymsQ4zYpJDbX3ABXKO2MSSeuhD4GkNOHS1g0dq.jpg', 8, 0, 0, '2023-05-14 02:48:25', '2023-05-14 12:08:14'),
(8, 'Tops', 'tops', 'Elevate your style with fashionable tops for every occasion.', 'public/admin/backend/subcategories/x3w0gBedp2j4k73Jszfa2xCCEKfgY3kVteI7L4yN.png', 8, 0, 0, '2023-05-14 02:52:05', '2023-05-28 06:06:50'),
(9, 'Skirts', 'skirts', 'Skirts, the epitome of feminine charm and grace, add a touch of elegance to any outfit with their versatile styles and flattering silhouettes.', 'public/admin/backend/subcategories/vIkRIr4rQXdYXHI7Vef8Ixy00WxzvqtHGL0HegXu.jpg', 8, 0, 0, '2023-05-14 02:54:32', '2023-05-14 12:29:00'),
(10, 'Boys\' Clothing', 'boys\'-clothing', 'Boys\' clothing, stylish and comfortable options for every occasion.', 'public/admin/backend/subcategories/6B2gQnis908W7GZGBhFvHhWHYjbYNpz9pRXFBHpL.jpg', 9, 0, 0, '2023-05-14 02:57:28', '2023-05-14 02:57:28'),
(11, 'Girls\' Clothing', 'girls\'-clothing', 'Express style and individuality with fashionable girl\'s clothing.', 'public/admin/backend/subcategories/rLgFJg3OyiFPLX4Ptwyrc2KAD0BNIxD2h3KooN6k.jpg', 9, 0, 0, '2023-05-14 03:01:02', '2023-05-14 03:01:02'),
(12, 'Shirts', 'shirts', 'Shirts, timeless and versatile essentials that effortlessly elevate any outfit, offering endless possibilities for formal or casual occasions.', 'public/admin/backend/subcategories/F2VXqzxBFwhEYbTAdfmZyb1pKhOVA2kLzdqymdDj.jpg', 7, 0, 0, '2023-05-14 05:52:08', '2023-05-16 11:19:46');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `role_as` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0=user, 1=admin',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `role_as`, `created_at`, `updated_at`) VALUES
(8, 'Admin', 'admin@gmail.com', NULL, '$2y$10$LgGjMvSHDKPmg7XYGJ0rWe4TL9JRam2GUzL22OQ9cH/JxEXyVLuVq', NULL, 1, '2023-05-04 07:50:46', '2023-05-04 07:50:46'),
(12, 'user', 'user@gmail.com', NULL, '$2y$10$N6cd4KjFtn0GayfhuRUUjudt7s0grxH7LmSBfEeWhWsCqqX0d987u', NULL, 0, '2023-05-12 07:33:31', '2023-05-26 13:16:08'),
(31, 'Aung Htet Naing', 'aunghtetnaing.naing@gmail.com', NULL, '$2y$10$qAKzKKahBemBvptGtDWUZOZlsn8L3xMilCZRf5B/yYkgUOB/atChW', NULL, 0, '2023-05-28 00:46:44', '2023-05-28 00:51:03'),
(37, 'adminahn', 'adminahn@gmail.com', NULL, '$2y$10$iF/utooYiwGEAreYR3xWYOG151oa4o2f.6Udu1mdxeNF8dSQ.7kKW', NULL, 1, '2023-05-28 03:57:51', '2023-05-28 03:57:51');

-- --------------------------------------------------------

--
-- Table structure for table `user_details`
--

CREATE TABLE `user_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `postal_code` int(11) DEFAULT NULL,
  `address` varchar(500) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_details`
--

INSERT INTO `user_details` (`id`, `user_id`, `phone`, `postal_code`, `address`, `created_at`, `updated_at`) VALUES
(11, 31, '+12345678912', 123456, 'somewhere on earth blah blah', '2023-05-28 00:49:14', '2023-05-28 01:24:07');

-- --------------------------------------------------------

--
-- Table structure for table `variants`
--

CREATE TABLE `variants` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `color_id` bigint(20) UNSIGNED DEFAULT NULL,
  `size_id` bigint(20) UNSIGNED DEFAULT NULL,
  `quantity` int(11) DEFAULT 0,
  `SKU` varchar(255) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0=visible, 1=hidden',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `variants`
--

INSERT INTO `variants` (`id`, `product_id`, `color_id`, `size_id`, `quantity`, `SKU`, `status`, `created_at`, `updated_at`) VALUES
(4, 11, 5, 5, 6, 'CLB-G8L-AQUA-XS', 0, '2023-05-14 08:08:47', '2023-05-28 07:58:35'),
(5, 9, NULL, 4, 11, 'CLP-PYI-mixed-color-XXL', 0, '2023-05-14 08:09:14', '2023-05-27 11:05:35'),
(7, 11, 4, 4, 6, 'CLB-G8L-YELLOW-XXL', 0, '2023-05-14 08:10:17', '2023-05-28 07:58:35'),
(8, 2, 1, 1, 10, 'VFOS-2CD-WHITE-S', 0, '2023-05-14 08:10:34', '2023-05-27 08:50:00'),
(9, 5, 4, 3, 0, 'EPPS-39G-YELLOW-XL', 0, '2023-05-14 08:11:29', '2023-05-28 01:31:39'),
(11, 3, 3, 3, 12, 'MPS-QGE-RED-XL', 0, '2023-05-14 08:15:49', '2023-05-27 12:50:48'),
(12, 11, 1, 1, 3, 'CLB-G8L-WHITE-S', 0, '2023-05-14 08:17:28', '2023-05-28 07:42:32'),
(13, 6, 2, 5, 11, 'CAT-9JG-BLACK-XS', 0, '2023-05-14 08:17:44', '2023-05-28 06:19:35'),
(14, 2, 5, 5, 13, 'VFOS-2CD-AQUA-XS', 0, '2023-05-14 08:18:37', '2023-05-27 08:47:55'),
(18, 11, 1, 4, 5, 'CLB-G8L-WHITE-XXL', 0, '2023-05-19 03:03:27', '2023-05-28 07:58:35'),
(19, 13, NULL, NULL, 8, 'FSLS-H7U-mixed-color-free-size', 0, '2023-05-19 07:40:21', '2023-05-27 11:00:07'),
(20, 13, 5, 3, 10, 'FSLS-H7U-AQUA-XL', 0, '2023-05-19 08:04:27', '2023-05-27 08:48:42'),
(23, 24, 5, 2, 9, 'CHT-EBZ-AQUA-L', 0, '2023-05-27 09:44:18', '2023-05-28 01:26:01'),
(24, 24, NULL, 1, 12, 'CHT-EBZ-mixed-color-S', 0, '2023-05-27 09:44:46', '2023-05-28 01:26:01'),
(25, 23, 4, 4, 4, 'PCPS-QEQ-YELLOW-XXL', 0, '2023-05-27 09:45:03', '2023-05-27 12:55:45'),
(26, 7, 2, 2, 3, 'EFCS-1UT-BLACK-L', 0, '2023-05-27 09:51:17', '2023-05-28 01:28:30'),
(29, 7, 4, 4, 9, 'EFCS-1UT-YELLOW-XXL', 0, '2023-05-27 12:41:03', '2023-05-28 01:28:30'),
(30, 1, 3, 1, 0, 'CPS-BN6-RED-S', 0, '2023-05-27 12:42:15', '2023-05-28 01:31:04'),
(31, 1, 1, 4, 9, 'CPS-BN6-WHITE-XXL', 0, '2023-05-27 12:42:40', '2023-05-28 01:33:14'),
(33, 11, 3, 5, 2, 'CLB-G8L-RED-XS', 0, '2023-05-28 07:40:59', '2023-05-28 07:55:44');

-- --------------------------------------------------------

--
-- Table structure for table `wishlists`
--

CREATE TABLE `wishlists` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `wishlists`
--

INSERT INTO `wishlists` (`id`, `user_id`, `product_id`, `created_at`, `updated_at`) VALUES
(30, 8, 13, '2023-05-20 08:51:42', '2023-05-20 08:51:42'),
(31, 8, 11, '2023-05-20 08:53:17', '2023-05-20 08:53:17'),
(32, 8, 9, '2023-05-20 09:16:37', '2023-05-20 09:16:37'),
(35, 8, 6, '2023-05-23 09:41:57', '2023-05-23 09:41:57'),
(37, 12, 6, '2023-05-24 21:48:51', '2023-05-24 21:48:51'),
(57, 31, 9, '2023-05-28 01:30:19', '2023-05-28 01:30:19'),
(58, 31, 5, '2023-05-28 01:31:57', '2023-05-28 01:31:57'),
(59, 31, 11, '2023-05-28 07:50:56', '2023-05-28 07:50:56');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `brands_name_unique` (`name`),
  ADD UNIQUE KEY `brands_slug_unique` (`slug`);

--
-- Indexes for table `carts`
--
ALTER TABLE `carts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `carts_user_id_foreign` (`user_id`),
  ADD KEY `carts_variant_id_foreign` (`variant_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `categories_name_unique` (`name`),
  ADD UNIQUE KEY `categories_slug_unique` (`slug`);

--
-- Indexes for table `colors`
--
ALTER TABLE `colors`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `colors_name_unique` (`name`),
  ADD UNIQUE KEY `colors_code_unique` (`code`);

--
-- Indexes for table `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `contacts_user_id_foreign` (`user_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `orders_user_id_foreign` (`user_id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_items_order_id_foreign` (`order_id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `products_code_unique` (`code`),
  ADD KEY `products_category_id_foreign` (`category_id`),
  ADD KEY `products_subcategory_id_foreign` (`subcategory_id`),
  ADD KEY `products_brand_id_foreign` (`brand_id`);

--
-- Indexes for table `product_images`
--
ALTER TABLE `product_images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_images_product_id_foreign` (`product_id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sizes`
--
ALTER TABLE `sizes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `sizes_name_unique` (`name`),
  ADD UNIQUE KEY `sizes_code_unique` (`code`);

--
-- Indexes for table `sliders`
--
ALTER TABLE `sliders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subcategories`
--
ALTER TABLE `subcategories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `subcategories_name_unique` (`name`),
  ADD UNIQUE KEY `subcategories_slug_unique` (`slug`),
  ADD KEY `subcategories_category_id_foreign` (`category_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `user_details`
--
ALTER TABLE `user_details`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_details_user_id_unique` (`user_id`);

--
-- Indexes for table `variants`
--
ALTER TABLE `variants`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `variants_sku_unique` (`SKU`),
  ADD KEY `variants_product_id_foreign` (`product_id`),
  ADD KEY `variants_color_id_foreign` (`color_id`),
  ADD KEY `variants_size_id_foreign` (`size_id`);

--
-- Indexes for table `wishlists`
--
ALTER TABLE `wishlists`
  ADD PRIMARY KEY (`id`),
  ADD KEY `wishlists_product_id_foreign` (`product_id`),
  ADD KEY `wishlists_user_id_foreign` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `carts`
--
ALTER TABLE `carts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=103;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `colors`
--
ALTER TABLE `colors`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `product_images`
--
ALTER TABLE `product_images`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=75;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `sizes`
--
ALTER TABLE `sizes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `sliders`
--
ALTER TABLE `sliders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `subcategories`
--
ALTER TABLE `subcategories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `user_details`
--
ALTER TABLE `user_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `variants`
--
ALTER TABLE `variants`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `wishlists`
--
ALTER TABLE `wishlists`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `carts`
--
ALTER TABLE `carts`
  ADD CONSTRAINT `carts_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `carts_variant_id_foreign` FOREIGN KEY (`variant_id`) REFERENCES `variants` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `contacts`
--
ALTER TABLE `contacts`
  ADD CONSTRAINT `contacts_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_brand_id_foreign` FOREIGN KEY (`brand_id`) REFERENCES `brands` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `products_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `products_subcategory_id_foreign` FOREIGN KEY (`subcategory_id`) REFERENCES `subcategories` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `product_images`
--
ALTER TABLE `product_images`
  ADD CONSTRAINT `product_images_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `subcategories`
--
ALTER TABLE `subcategories`
  ADD CONSTRAINT `subcategories_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `user_details`
--
ALTER TABLE `user_details`
  ADD CONSTRAINT `user_details_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `variants`
--
ALTER TABLE `variants`
  ADD CONSTRAINT `variants_color_id_foreign` FOREIGN KEY (`color_id`) REFERENCES `colors` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `variants_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `variants_size_id_foreign` FOREIGN KEY (`size_id`) REFERENCES `sizes` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `wishlists`
--
ALTER TABLE `wishlists`
  ADD CONSTRAINT `wishlists_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `wishlists_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
