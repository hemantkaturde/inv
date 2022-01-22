-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 22, 2022 at 06:39 PM
-- Server version: 10.1.36-MariaDB
-- PHP Version: 7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `test`
--

-- --------------------------------------------------------

--
-- Table structure for table `attributes`
--

CREATE TABLE `attributes` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `active` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `attributes`
--

INSERT INTO `attributes` (`id`, `name`, `active`) VALUES
(4, 'color', 1),
(6, 'Size', 1);

-- --------------------------------------------------------

--
-- Table structure for table `attribute_value`
--

CREATE TABLE `attribute_value` (
  `id` int(11) NOT NULL,
  `value` varchar(255) NOT NULL,
  `attribute_parent_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `attribute_value`
--

INSERT INTO `attribute_value` (`id`, `value`, `attribute_parent_id`) VALUES
(5, 'Blue', 2),
(6, 'White', 2),
(7, 'M', 3),
(8, 'L', 3),
(9, 'Green', 2),
(10, 'Black', 2),
(12, 'Grey', 2),
(13, 'S', 3),
(17, 'yellow', 4),
(20, 'small', 6),
(21, 'medium', 6),
(22, 'large', 6);

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE `brands` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `active` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `brands`
--

INSERT INTO `brands` (`id`, `name`, `active`) VALUES
(15, 'Computer', 1),
(16, 'Clothes', 1),
(17, 'Mobile', 1),
(19, 'Sample', 1);

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `active` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `active`) VALUES
(7, 'Electronic', 1),
(8, 'Dress', 1),
(9, 'Sample Category', 1);

-- --------------------------------------------------------

--
-- Table structure for table `company`
--

CREATE TABLE `company` (
  `id` int(11) NOT NULL,
  `company_name` varchar(255) NOT NULL,
  `service_charge_value` varchar(255) NOT NULL,
  `vat_charge_value` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `country` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `currency` varchar(255) NOT NULL,
  `mobile` varchar(10) NOT NULL,
  `logo` varchar(255) NOT NULL,
  `email1` varchar(255) NOT NULL,
  `email2` varchar(255) NOT NULL,
  `pan_no` varchar(255) NOT NULL,
  `gst_no` varchar(255) NOT NULL,
  `factory_address` varchar(255) NOT NULL,
  `notes` varchar(255) NOT NULL,
  `prefix` varchar(101) NOT NULL,
  `count` int(101) NOT NULL,
  `sufix` varchar(101) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `company`
--

INSERT INTO `company` (`id`, `company_name`, `service_charge_value`, `vat_charge_value`, `address`, `phone`, `country`, `message`, `currency`, `mobile`, `logo`, `email1`, `email2`, `pan_no`, `gst_no`, `factory_address`, `notes`, `prefix`, `count`, `sufix`) VALUES
(4, 'Test compay', '', '', 'Thane', '8097404125', '', '', '', '8097404125', 'assets/images/company_image/61ebfa212ae34.jpg', 'hemantkaturde123@gmail.com', 'hemantkaturde123@gmail.com', 'EBGPK5058R', 'EBGPK5058', 'Billing Address Thane', 'Thane', 'MUM', 1, 'BOI');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `contact_person` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `mobile` bigint(12) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_2` varchar(255) NOT NULL,
  `gst_no` varchar(101) NOT NULL,
  `pan_no` varchar(101) NOT NULL,
  `address` varchar(255) NOT NULL,
  `delivery_address` varchar(255) NOT NULL,
  `notes` varchar(255) NOT NULL,
  `cust_attachment` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `company_id`, `name`, `contact_person`, `phone`, `mobile`, `email`, `email_2`, `gst_no`, `pan_no`, `address`, `delivery_address`, `notes`, `cust_attachment`) VALUES
(18, 1, 'Test customer', 'hemant katurde', '8097404125', 8097404125, 'hemantkaturde123@gmail.com', 'hemantkaturde123@gmail.com', 'HEMANT50001', 'EBGPK5050R', 'Thane', 'Thane ', 'Thane', ''),
(19, 3, 'Test customer', 'HEMANT Katurde', '08097404125', 8097404125, 'hkaturde@gmail.com', 'hkaturde@gmail.com', '', '', 'Thane', '', '', ''),
(20, 4, 'Test Customer', 'hemant katyure', '8097404125', 8097404125, 'hemantkaturde123@gmail.com', 'hemantkaturde123@gmail.com', 'EBDKDMKA', 'sdvsdgvds', 'Thane', 'Thane', 'Notes', '');

-- --------------------------------------------------------

--
-- Table structure for table `customer_trans`
--

CREATE TABLE `customer_trans` (
  `id` int(11) NOT NULL,
  `cust_id` int(11) NOT NULL,
  `attach_name` varchar(255) NOT NULL,
  `attach_img` varchar(255) NOT NULL,
  `status` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customer_trans`
--

INSERT INTO `customer_trans` (`id`, `cust_id`, `attach_name`, `attach_img`, `status`) VALUES
(5, 17, 'File', '', 0),
(6, 16, 'This', 'assets/images/customer_image/61e84f6e57de2.jpg', 0),
(7, 16, 'This', 'assets/images/customer_image/61e84f6e6dfd3.jpg', 0),
(8, 16, 'This', 'assets/images/customer_image/61e84f7ac69c0.jpg', 0),
(9, 14, 'This', 'assets/images/customer_image/61e84f7adef1f.jpg', 0),
(10, 16, 'This', 'assets/images/customer_image/61e84f7b05510.jpg', 0);

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE `department` (
  `deprt_id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL,
  `department` varchar(50) NOT NULL,
  `status` bit(2) NOT NULL DEFAULT b'1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`deprt_id`, `company_id`, `department`, `status`) VALUES
(1, 3, 'Test Depart', b'01');

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE `groups` (
  `id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL,
  `group_name` varchar(255) NOT NULL,
  `permission` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`id`, `company_id`, `group_name`, `permission`) VALUES
(1, 0, 'Superadmin Permission', 'a:42:{i:0;s:15:\"moduleDashboard\";i:1;s:14:\"moduleCustomer\";i:2;s:12:\"viewCustomer\";i:3;s:14:\"createCustomer\";i:4;s:14:\"updateCustomer\";i:5;s:14:\"deleteCustomer\";i:6;s:13:\"moduleProduct\";i:7;s:11:\"viewProduct\";i:8;s:13:\"createProduct\";i:9;s:13:\"updateProduct\";i:10;s:13:\"deleteProduct\";i:11;s:17:\"moduleProductType\";i:12;s:15:\"viewProductType\";i:13;s:17:\"createProductType\";i:14;s:17:\"updateProductType\";i:15;s:17:\"deleteProductType\";i:16;s:16:\"moduleDepartment\";i:17;s:15:\"vieweDepartment\";i:18;s:17:\"createeDepartment\";i:19;s:17:\"updateeDepartment\";i:20;s:17:\"deleteeDepartment\";i:21;s:13:\"moduleCompany\";i:22;s:11:\"viewCompany\";i:23;s:13:\"createCompany\";i:24;s:13:\"updateCompany\";i:25;s:13:\"deleteCompany\";i:26;s:13:\"moduleInquiry\";i:27;s:11:\"viewInquiry\";i:28;s:13:\"createInquiry\";i:29;s:13:\"updateInquiry\";i:30;s:13:\"deleteInquiry\";i:31;s:15:\"assigntoInquiry\";i:32;s:10:\"moduleUser\";i:33;s:8:\"viewUser\";i:34;s:10:\"createUser\";i:35;s:10:\"updateUser\";i:36;s:10:\"deleteUser\";i:37;s:11:\"moduleGroup\";i:38;s:9:\"viewGroup\";i:39;s:11:\"createGroup\";i:40;s:11:\"updateGroup\";i:41;s:11:\"deleteGroup\";}'),
(2, 3, 'Administrator', 'a:20:{i:0;s:15:\"moduleDashboard\";i:1;s:13:\"moduleProduct\";i:2;s:11:\"viewProduct\";i:3;s:13:\"createProduct\";i:4;s:13:\"updateProduct\";i:5;s:13:\"deleteProduct\";i:6;s:17:\"moduleProductType\";i:7;s:15:\"viewProductType\";i:8;s:17:\"createProductType\";i:9;s:17:\"updateProductType\";i:10;s:17:\"deleteProductType\";i:11;s:13:\"updateCompany\";i:12;s:8:\"viewUser\";i:13;s:10:\"createUser\";i:14;s:10:\"updateUser\";i:15;s:10:\"deleteUser\";i:16;s:9:\"viewGroup\";i:17;s:11:\"createGroup\";i:18;s:11:\"updateGroup\";i:19;s:11:\"deleteGroup\";}'),
(7, 3, 'Test permission --', 'a:4:{i:0;s:15:\"moduleDashboard\";i:1;s:14:\"moduleCustomer\";i:2;s:13:\"moduleProduct\";i:3;s:17:\"moduleProductType\";}'),
(8, 1, 'GTest35654', 'a:27:{i:0;s:15:\"moduleDashboard\";i:1;s:14:\"moduleCustomer\";i:2;s:12:\"viewCustomer\";i:3;s:14:\"createCustomer\";i:4;s:14:\"updateCustomer\";i:5;s:13:\"moduleProduct\";i:6;s:11:\"viewProduct\";i:7;s:13:\"createProduct\";i:8;s:13:\"updateProduct\";i:9;s:17:\"moduleProductType\";i:10;s:15:\"viewProductType\";i:11;s:17:\"createProductType\";i:12;s:16:\"moduleDepartment\";i:13;s:15:\"vieweDepartment\";i:14;s:17:\"createeDepartment\";i:15;s:13:\"moduleCompany\";i:16;s:11:\"viewCompany\";i:17;s:13:\"createCompany\";i:18;s:13:\"moduleInquiry\";i:19;s:11:\"viewInquiry\";i:20;s:13:\"createInquiry\";i:21;s:10:\"moduleUser\";i:22;s:8:\"viewUser\";i:23;s:10:\"createUser\";i:24;s:11:\"moduleGroup\";i:25;s:9:\"viewGroup\";i:26;s:11:\"createGroup\";}'),
(9, 4, 'Superadmin', 'a:42:{i:0;s:15:\"moduleDashboard\";i:1;s:14:\"moduleCustomer\";i:2;s:12:\"viewCustomer\";i:3;s:14:\"createCustomer\";i:4;s:14:\"updateCustomer\";i:5;s:14:\"deleteCustomer\";i:6;s:13:\"moduleProduct\";i:7;s:11:\"viewProduct\";i:8;s:13:\"createProduct\";i:9;s:13:\"updateProduct\";i:10;s:13:\"deleteProduct\";i:11;s:17:\"moduleProductType\";i:12;s:15:\"viewProductType\";i:13;s:17:\"createProductType\";i:14;s:17:\"updateProductType\";i:15;s:17:\"deleteProductType\";i:16;s:16:\"moduleDepartment\";i:17;s:15:\"vieweDepartment\";i:18;s:17:\"createeDepartment\";i:19;s:17:\"updateeDepartment\";i:20;s:17:\"deleteeDepartment\";i:21;s:13:\"moduleCompany\";i:22;s:11:\"viewCompany\";i:23;s:13:\"createCompany\";i:24;s:13:\"updateCompany\";i:25;s:13:\"deleteCompany\";i:26;s:13:\"moduleInquiry\";i:27;s:11:\"viewInquiry\";i:28;s:13:\"createInquiry\";i:29;s:13:\"updateInquiry\";i:30;s:13:\"deleteInquiry\";i:31;s:15:\"assigntoInquiry\";i:32;s:10:\"moduleUser\";i:33;s:8:\"viewUser\";i:34;s:10:\"createUser\";i:35;s:10:\"updateUser\";i:36;s:10:\"deleteUser\";i:37;s:11:\"moduleGroup\";i:38;s:9:\"viewGroup\";i:39;s:11:\"createGroup\";i:40;s:11:\"updateGroup\";i:41;s:11:\"deleteGroup\";}'),
(10, 4, 'Test New Permission', 'a:42:{i:0;s:15:\"moduleDashboard\";i:1;s:14:\"moduleCustomer\";i:2;s:12:\"viewCustomer\";i:3;s:14:\"createCustomer\";i:4;s:14:\"updateCustomer\";i:5;s:14:\"deleteCustomer\";i:6;s:13:\"moduleProduct\";i:7;s:11:\"viewProduct\";i:8;s:13:\"createProduct\";i:9;s:13:\"updateProduct\";i:10;s:13:\"deleteProduct\";i:11;s:17:\"moduleProductType\";i:12;s:15:\"viewProductType\";i:13;s:17:\"createProductType\";i:14;s:17:\"updateProductType\";i:15;s:17:\"deleteProductType\";i:16;s:16:\"moduleDepartment\";i:17;s:15:\"vieweDepartment\";i:18;s:17:\"createeDepartment\";i:19;s:17:\"updateeDepartment\";i:20;s:17:\"deleteeDepartment\";i:21;s:13:\"moduleCompany\";i:22;s:11:\"viewCompany\";i:23;s:13:\"createCompany\";i:24;s:13:\"updateCompany\";i:25;s:13:\"deleteCompany\";i:26;s:13:\"moduleInquiry\";i:27;s:11:\"viewInquiry\";i:28;s:13:\"createInquiry\";i:29;s:13:\"updateInquiry\";i:30;s:13:\"deleteInquiry\";i:31;s:15:\"assigntoInquiry\";i:32;s:10:\"moduleUser\";i:33;s:8:\"viewUser\";i:34;s:10:\"createUser\";i:35;s:10:\"updateUser\";i:36;s:10:\"deleteUser\";i:37;s:11:\"moduleGroup\";i:38;s:9:\"viewGroup\";i:39;s:11:\"createGroup\";i:40;s:11:\"updateGroup\";i:41;s:11:\"deleteGroup\";}'),
(11, 4, 'ABC', 'a:42:{i:0;s:15:\"moduleDashboard\";i:1;s:14:\"moduleCustomer\";i:2;s:12:\"viewCustomer\";i:3;s:14:\"createCustomer\";i:4;s:14:\"updateCustomer\";i:5;s:14:\"deleteCustomer\";i:6;s:13:\"moduleProduct\";i:7;s:11:\"viewProduct\";i:8;s:13:\"createProduct\";i:9;s:13:\"updateProduct\";i:10;s:13:\"deleteProduct\";i:11;s:17:\"moduleProductType\";i:12;s:15:\"viewProductType\";i:13;s:17:\"createProductType\";i:14;s:17:\"updateProductType\";i:15;s:17:\"deleteProductType\";i:16;s:16:\"moduleDepartment\";i:17;s:15:\"vieweDepartment\";i:18;s:17:\"createeDepartment\";i:19;s:17:\"updateeDepartment\";i:20;s:17:\"deleteeDepartment\";i:21;s:13:\"moduleCompany\";i:22;s:11:\"viewCompany\";i:23;s:13:\"createCompany\";i:24;s:13:\"updateCompany\";i:25;s:13:\"deleteCompany\";i:26;s:13:\"moduleInquiry\";i:27;s:11:\"viewInquiry\";i:28;s:13:\"createInquiry\";i:29;s:13:\"updateInquiry\";i:30;s:13:\"deleteInquiry\";i:31;s:15:\"assigntoInquiry\";i:32;s:10:\"moduleUser\";i:33;s:8:\"viewUser\";i:34;s:10:\"createUser\";i:35;s:10:\"updateUser\";i:36;s:10:\"deleteUser\";i:37;s:11:\"moduleGroup\";i:38;s:9:\"viewGroup\";i:39;s:11:\"createGroup\";i:40;s:11:\"updateGroup\";i:41;s:11:\"deleteGroup\";}');

-- --------------------------------------------------------

--
-- Table structure for table `inquiry`
--

CREATE TABLE `inquiry` (
  `inquiry_id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL,
  `inquiry_number` varchar(255) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `inquiry_from` text NOT NULL,
  `inquiry_date` date NOT NULL,
  `inquiry_product` varchar(255) NOT NULL,
  `inquiry_status` varchar(101) NOT NULL,
  `inquiry_emp_assigned` varchar(255) NOT NULL,
  `inquiry_notes` varchar(255) NOT NULL,
  `inquiry_remark` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `inquiry`
--

INSERT INTO `inquiry` (`inquiry_id`, `company_id`, `inquiry_number`, `customer_id`, `inquiry_from`, `inquiry_date`, `inquiry_product`, `inquiry_status`, `inquiry_emp_assigned`, `inquiry_notes`, `inquiry_remark`) VALUES
(9, 1, 'We100C', 0, '', '1970-01-01', '11', '1', '', '', ''),
(10, 3, 'WE1B', 17, '1', '1994-06-12', '12,11', '2', 'Abc', 'Test', '');

-- --------------------------------------------------------

--
-- Table structure for table `invoice`
--

CREATE TABLE `invoice` (
  `invoice_id` int(11) NOT NULL,
  `inquiry_id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `invoice_no` varchar(255) NOT NULL,
  `invoice_date` date NOT NULL,
  `vehicle_no` varchar(255) NOT NULL,
  `lr_no` varchar(255) NOT NULL,
  `remark` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `invoice`
--

INSERT INTO `invoice` (`invoice_id`, `inquiry_id`, `company_id`, `user_id`, `invoice_no`, `invoice_date`, `vehicle_no`, `lr_no`, `remark`) VALUES
(1, 1, 1, 0, '12345', '0000-00-00', '', '', ''),
(5, 3, 1, 0, '123456', '1970-01-01', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `bill_no` varchar(255) NOT NULL,
  `customer_name` varchar(255) NOT NULL,
  `customer_address` varchar(255) NOT NULL,
  `customer_phone` varchar(255) NOT NULL,
  `date_time` varchar(255) NOT NULL,
  `gross_amount` varchar(255) NOT NULL,
  `service_charge_rate` varchar(255) NOT NULL,
  `service_charge` varchar(255) NOT NULL,
  `vat_charge_rate` varchar(255) NOT NULL,
  `vat_charge` varchar(255) NOT NULL,
  `net_amount` varchar(255) NOT NULL,
  `discount` varchar(255) NOT NULL,
  `paid_status` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `bill_no`, `customer_name`, `customer_address`, `customer_phone`, `date_time`, `gross_amount`, `service_charge_rate`, `service_charge`, `vat_charge_rate`, `vat_charge`, `net_amount`, `discount`, `paid_status`, `user_id`) VALUES
(4, 'BILPR-239D', 'Shafraz', 'kolombo', '0778650336', '1526279725', '450000.00', '13', '58500.00', '10', '45000.00', '553500.00', '', 2, 1),
(5, 'BILPR-0266', 'Chris', 'California', '05552242', '1526358119', '761700.00', '13', '99021.00', '10', '76170.00', '936891.00', '', 2, 1),
(6, 'BILPR-4A66', 'John Smith', 'Saple Address', '2345678', '1606799361', '3400.00', '13', '442.00', '10', '340.00', '4182.00', '', 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `orders_item`
--

CREATE TABLE `orders_item` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `qty` varchar(255) NOT NULL,
  `rate` varchar(255) NOT NULL,
  `amount` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `orders_item`
--

INSERT INTO `orders_item` (`id`, `order_id`, `product_id`, `qty`, `rate`, `amount`) VALUES
(6, 4, 8, '3', '150000', '450000.00'),
(7, 5, 11, '13', '900', '11700.00'),
(8, 5, 10, '5', '150000', '750000.00'),
(9, 6, 12, '1', '2500', '2500.00'),
(10, 6, 11, '1', '900', '900.00');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `sku` varchar(255) NOT NULL,
  `price` varchar(255) NOT NULL,
  `qty` varchar(255) NOT NULL,
  `image` text NOT NULL,
  `description` text NOT NULL,
  `attribute_value_id` text,
  `brand_id` text NOT NULL,
  `category_id` text NOT NULL,
  `store_id` int(11) NOT NULL,
  `availability` int(11) NOT NULL,
  `product_code` varchar(101) NOT NULL,
  `notes` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `company_id`, `name`, `sku`, `price`, `qty`, `image`, `description`, `attribute_value_id`, `brand_id`, `category_id`, `store_id`, `availability`, `product_code`, `notes`) VALUES
(10, 1, 'Mac', '', '', '39', 'assets/images/product_image/5afa5fe395f9d.jpg', '<p>sample1<br></p>', '[\"17\",\"20\"]', '[\"15\"]', '[\"7\"]', 5, 1, 'S2', ''),
(11, 1, 'Rubuke', '', '', '36', 'assets/images/product_image/5afa6026d808e.jpg', '<p>sample<br></p>', '[\"17\",\"21\"]', '[\"15\"]', '[\"7\"]', 5, 1, 'S1', ''),
(12, 1, 'Sample Product', '', '', '49', 'assets/images/product_image/5fc5cf759483c.png', '<p>\r\n\r\nLorem ipsum dolor sit amet, consectetur adipiscing elit. Proin rutrum nisi sed est tempor dapibus. Sed auctor porttitor ligula a hendrerit. Praesent lacus eros, pulvinar vitae ante vel, gravida ullamcorper nunc. Sed ac dolor lorem. Quisque felis magna, varius eu malesuada non, sollicitudin nec eros. Praesent pellentesque quam tellus, non dignissim erat sollicitudin sit amet. Sed suscipit tellus sit amet sem vehicula mattis. Quisque bibendum ac quam eget auctor. Pellentesque facilisis nisl mauris, vel venenatis leo varius id. Cras semper convallis tincidunt. Nam ut pulvinar justo, sed vestibulum lectus. Praesent iaculis sem at molestie mattis. Mauris sodales, ipsum a cursus pellentesque, turpis tellus ultricies velit, nec vestibulum turpis risus ac lorem.\r\n\r\n<br></p>', '[\"17\",\"21\"]', '[\"16\",\"19\"]', '[\"9\"]', 7, 1, '1', '');

-- --------------------------------------------------------

--
-- Table structure for table `product_type`
--

CREATE TABLE `product_type` (
  `type_id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL,
  `product_type` varchar(255) NOT NULL,
  `status` int(2) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product_type`
--

INSERT INTO `product_type` (`type_id`, `company_id`, `product_type`, `status`) VALUES
(3, 3, 'Test Product 1', 1),
(4, 1, 'Test Product', 1);

-- --------------------------------------------------------

--
-- Table structure for table `stores`
--

CREATE TABLE `stores` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `active` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `stores`
--

INSERT INTO `stores` (`id`, `name`, `active`) VALUES
(5, 'colombo', 1),
(6, 'kandy', 1),
(7, 'Sample Warehouse', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `mobile` bigint(11) NOT NULL,
  `designation` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `gender` int(11) NOT NULL,
  `emp_code` varchar(101) NOT NULL,
  `address` varchar(255) NOT NULL,
  `notes` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `company_id`, `username`, `password`, `email`, `firstname`, `lastname`, `mobile`, `designation`, `phone`, `gender`, `emp_code`, `address`, `notes`) VALUES
(1, 0, 'Superadmin', 'admin', 'admin@admin.com', 'john', 'doe', 0, '', '65646546', 1, '', '', ''),
(15, 1, 'hemant', 'hemant', 'hemantkaturde123@gmail.com', 'hemant', 'katurde', 8097404125, 'HR', '8097404125', 0, '501', 'Thane', 'Thane');

-- --------------------------------------------------------

--
-- Table structure for table `user_group`
--

CREATE TABLE `user_group` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user_group`
--

INSERT INTO `user_group` (`id`, `user_id`, `group_id`) VALUES
(1, 1, 1),
(2, 14, 6),
(11, 15, 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `attributes`
--
ALTER TABLE `attributes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `attribute_value`
--
ALTER TABLE `attribute_value`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `company`
--
ALTER TABLE `company`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customer_trans`
--
ALTER TABLE `customer_trans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `department`
--
ALTER TABLE `department`
  ADD PRIMARY KEY (`deprt_id`);

--
-- Indexes for table `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `inquiry`
--
ALTER TABLE `inquiry`
  ADD PRIMARY KEY (`inquiry_id`);

--
-- Indexes for table `invoice`
--
ALTER TABLE `invoice`
  ADD PRIMARY KEY (`invoice_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders_item`
--
ALTER TABLE `orders_item`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_type`
--
ALTER TABLE `product_type`
  ADD PRIMARY KEY (`type_id`);

--
-- Indexes for table `stores`
--
ALTER TABLE `stores`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_group`
--
ALTER TABLE `user_group`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `attributes`
--
ALTER TABLE `attributes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `attribute_value`
--
ALTER TABLE `attribute_value`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `company`
--
ALTER TABLE `company`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `customer_trans`
--
ALTER TABLE `customer_trans`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `department`
--
ALTER TABLE `department`
  MODIFY `deprt_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `groups`
--
ALTER TABLE `groups`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `inquiry`
--
ALTER TABLE `inquiry`
  MODIFY `inquiry_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `invoice`
--
ALTER TABLE `invoice`
  MODIFY `invoice_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `orders_item`
--
ALTER TABLE `orders_item`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `product_type`
--
ALTER TABLE `product_type`
  MODIFY `type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `stores`
--
ALTER TABLE `stores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `user_group`
--
ALTER TABLE `user_group`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
