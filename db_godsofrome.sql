-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jul 24, 2025 at 09:48 AM
-- Server version: 8.0.30
-- PHP Version: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_godsofrome`
--

-- --------------------------------------------------------

--
-- Table structure for table `active_battle`
--

CREATE TABLE `active_battle` (
  `battle_id` int NOT NULL,
  `user_id` int NOT NULL,
  `enemy_id` int NOT NULL,
  `battle_cost` int NOT NULL,
  `date_create` date NOT NULL,
  `time_start` int NOT NULL DEFAULT '0',
  `status` int NOT NULL,
  `god_power` int NOT NULL,
  `god_type` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `active_battle`
--

INSERT INTO `active_battle` (`battle_id`, `user_id`, `enemy_id`, `battle_cost`, `date_create`, `time_start`, `status`, `god_power`, `god_type`) VALUES
(96, 14, 0, 1000, '2024-05-14', 0, 0, 1058, 4),
(97, 4, 0, 1111, '2025-01-09', 0, 0, 1099, 3);

-- --------------------------------------------------------

--
-- Table structure for table `adminKaa179`
--

CREATE TABLE `adminKaa179` (
  `id` int NOT NULL,
  `admin_user971` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `admin_pass971` varchar(100) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `adminKaa179`
--

INSERT INTO `adminKaa179` (`id`, `admin_user971`, `admin_pass971`) VALUES
(1, '$2y$10$Y5acHksEvvOZRDB9Tpb.2OToPDAmFK6NEtF6LFJGnHNB2iHZX5MC6', '$2y$10$o0n/KR2LChE80..HNyuiUejFi2Pg5d2LtWpDbZyEejNZNs5KoPwYW');

-- --------------------------------------------------------

--
-- Table structure for table `history_battle`
--

CREATE TABLE `history_battle` (
  `id` int NOT NULL,
  `battle_id` int NOT NULL,
  `user_id` int NOT NULL,
  `enemy_id` int NOT NULL,
  `date_battle` date NOT NULL,
  `battle_cost` int NOT NULL,
  `user_power` int NOT NULL,
  `enemy_power` int NOT NULL,
  `type_user` int NOT NULL,
  `type_enemy` int NOT NULL,
  `winner_id` int NOT NULL,
  `check_user` int NOT NULL DEFAULT '0',
  `check_enemy` int NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `history_battle`
--

INSERT INTO `history_battle` (`id`, `battle_id`, `user_id`, `enemy_id`, `date_battle`, `battle_cost`, `user_power`, `enemy_power`, `type_user`, `type_enemy`, `winner_id`, `check_user`, `check_enemy`) VALUES
(12, 57, 4, 1, '2023-10-25', 250, 1096, 920, 4, 1, 4, 1, 1),
(13, 58, 4, 1, '2023-10-25', 300, 1096, 1032, 1, 4, 4, 1, 1),
(14, 59, 1, 4, '2023-10-25', 1111, 925, 1195, 1, 4, 4, 1, 1),
(15, 60, 4, 1, '2023-10-25', 1234, 1011, 1184, 1, 4, 1, 1, 1),
(16, 50, 4, 1, '2023-10-25', 100, 1014, 1183, 1, 4, 1, 1, 1),
(17, 56, 4, 1, '2023-10-25', 1250, 990, 908, 4, 1, 4, 1, 1),
(18, 51, 4, 1, '2023-10-25', 500, 1035, 1049, 4, 4, 1, 1, 1),
(19, 61, 1, 4, '2023-10-25', 50000, 1199, 1019, 3, 4, 1, 1, 1),
(20, 48, 1, 4, '2023-10-26', 10, 1114, 1092, 1, 2, 1, 1, 1),
(21, 46, 1, 4, '2023-10-26', 5000, 968, 1205, 2, 1, 4, 1, 1),
(22, 49, 1, 4, '2023-10-26', 20, 998, 1008, 1, 1, 4, 1, 1),
(23, 47, 1, 4, '2023-11-04', 50, 1047, 1106, 4, 3, 4, 1, 1),
(24, 64, 4, 1, '2023-11-07', 900, 1029, 1092, 1, 1, 1, 1, 1),
(25, 53, 4, 1, '2023-11-07', 1050, 1011, 1068, 2, 2, 1, 1, 1),
(26, 65, 4, 1, '2023-11-07', 15000, 1066, 1089, 4, 2, 1, 1, 1),
(27, 55, 4, 1, '2023-11-07', 400, 1087, 0, 4, 1, 4, 1, 1),
(28, 52, 4, 1, '2023-11-07', 20, 954, 1034, 3, 3, 1, 1, 1),
(29, 54, 4, 1, '2023-11-07', 100, 1038, 1173, 2, 1, 1, 1, 1),
(30, 63, 4, 1, '2023-11-07', 100, 985, 0, 4, 0, 4, 1, 1),
(31, 68, 4, 1, '2023-11-07', 1000, 1078, 0, 4, 0, 4, 1, 1),
(32, 62, 4, 1, '2023-11-07', 615, 1056, 1090, 3, 2, 1, 1, 1),
(33, 72, 4, 1, '2023-11-07', 100, 1071, 1129, 3, 2, 1, 1, 1),
(34, 70, 4, 1, '2023-11-07', 10, 905, 1159, 2, 1, 1, 1, 1),
(35, 74, 4, 1, '2023-11-26', 1000, 1098, 1145, 1, 4, 1, 1, 1),
(36, 66, 4, 1, '2023-12-26', 5386, 1194, 1066, 4, 1, 4, 1, 1),
(37, 67, 4, 1, '2023-12-26', 60051, 1070, 0, 2, 0, 4, 1, 1),
(38, 73, 4, 1, '2023-12-31', 10000, 1073, 1051, 4, 2, 4, 1, 1),
(39, 69, 1, 4, '2024-01-03', 500, 1099, 1199, 3, 2, 4, 1, 1),
(40, 81, 1, 4, '2024-01-24', 50000, 1186, 1072, 3, 4, 1, 1, 1),
(41, 82, 1, 4, '2024-01-24', 100, 1075, 1099, 3, 1, 4, 1, 1),
(42, 84, 1, 4, '2024-01-26', 1500, 1064, 1087, 2, 4, 4, 1, 1),
(43, 88, 1, 4, '2024-01-31', 5000, 1092, 1057, 3, 3, 1, 1, 1),
(44, 90, 1, 4, '2024-01-31', 10000, 1088, 1057, 1, 3, 1, 1, 1),
(45, 89, 1, 4, '2024-01-31', 3500, 1083, 1151, 2, 1, 4, 1, 1),
(46, 91, 1, 4, '2024-01-31', 20000, 1084, 1022, 3, 1, 1, 1, 1),
(47, 92, 1, 4, '2024-01-31', 60000, 1055, 1083, 1, 1, 4, 1, 1),
(48, 86, 4, 1, '2024-01-31', 100, 1069, 1070, 2, 4, 1, 1, 1),
(49, 80, 4, 1, '2024-01-31', 1000, 1166, 1052, 3, 4, 4, 1, 1),
(50, 87, 4, 1, '2024-02-02', 100, 1186, 1000, 2, 3, 4, 1, 1),
(51, 77, 4, 1, '2024-02-02', 100, 1090, 1043, 4, 4, 4, 1, 1),
(52, 75, 4, 1, '2024-02-02', 10000, 1200, 980, 2, 3, 4, 1, 1),
(53, 78, 4, 1, '2024-02-02', 10000, 1054, 1075, 3, 3, 1, 1, 0),
(54, 93, 4, 14, '2024-05-14', 50468, 1080, 938, 2, 2, 4, 1, 1),
(55, 83, 1, 14, '2024-05-14', 500000, 1099, 1131, 4, 3, 14, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `log_battles`
--

CREATE TABLE `log_battles` (
  `action` int NOT NULL,
  `user_id` int NOT NULL,
  `battle_id` int NOT NULL,
  `sum` int NOT NULL,
  `date_battle` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `log_battles`
--

INSERT INTO `log_battles` (`action`, `user_id`, `battle_id`, `sum`, `date_battle`) VALUES
(1, 1, 79, 3063, 1704013899),
(2, 1, 73, 10000, 1704013923),
(2, 4, 69, 500, 1704301647),
(1, 4, 78, 10000, 1704301659),
(1, 1, 81, 50000, 1705763570),
(1, 1, 82, 100, 1705763574),
(1, 1, 83, 60400, 1705763580),
(1, 1, 84, 1500, 1705763587),
(2, 4, 81, 50000, 1706120569),
(2, 4, 82, 100, 1706120584),
(1, 4, 80, 1000, 1706285742),
(2, 4, 84, 1500, 1706285746),
(1, 4, 86, 100, 1706545574),
(1, 4, 87, 100, 1706545649),
(1, 1, 88, 5000, 1706548377),
(1, 1, 89, 3500, 1706548383),
(1, 1, 90, 10000, 1706548389),
(1, 1, 91, 20000, 1706548395),
(1, 1, 92, 60000, 1706548402),
(2, 4, 88, 5000, 1706714976),
(2, 4, 90, 10000, 1706715064),
(1, 4, 93, 50468, 1706716426),
(2, 4, 89, 3500, 1706717553),
(2, 4, 91, 20000, 1706718680),
(2, 4, 92, 60000, 1706718733),
(2, 1, 86, 100, 1706719042),
(2, 1, 80, 1000, 1706719663),
(2, 1, 87, 100, 1706873225),
(2, 1, 77, 100, 1706873233),
(2, 1, 75, 10000, 1706873238),
(2, 1, 78, 10000, 1706873245),
(2, 14, 93, 50468, 1715714750),
(1, 14, 96, 1000, 1715714762),
(2, 14, 83, 500000, 1715714766),
(1, 4, 97, 1111, 1736440399);

-- --------------------------------------------------------

--
-- Table structure for table `log_storage`
--

CREATE TABLE `log_storage` (
  `action` int NOT NULL,
  `user_id` int NOT NULL,
  `date_storage` int NOT NULL,
  `sum` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `log_storage`
--

INSERT INTO `log_storage` (`action`, `user_id`, `date_storage`, `sum`) VALUES
(1, 1, 1704014848, 3),
(1, 1, 1704014892, 48),
(1, 1, 1704014893, 240),
(1, 1, 1704014895, 240),
(1, 1, 1704014948, 960),
(1, 4, 1704014966, 3),
(1, 4, 1704014967, 12),
(1, 4, 1704014969, 240),
(1, 4, 1704014970, 48),
(1, 4, 1704014971, 12),
(2, 4, 1704014972, 315),
(1, 4, 1704794620, 12),
(1, 4, 1704794621, 48),
(1, 4, 1704794623, 12),
(1, 4, 1704818081, 12),
(1, 4, 1704818083, 240),
(1, 4, 1704818084, 12),
(1, 4, 1706098539, 48),
(1, 4, 1706098541, 12),
(1, 4, 1706098542, 12),
(1, 4, 1706120753, 12),
(1, 4, 1706120755, 12),
(1, 4, 1706120756, 240),
(1, 4, 1706184953, 48),
(1, 4, 1706184955, 12),
(1, 4, 1706184958, 12),
(1, 4, 1706193987, 960),
(1, 4, 1706279457, 12),
(1, 4, 1706279483, 240),
(1, 4, 1706279485, 48),
(1, 4, 1706279486, 12),
(1, 4, 1706781936, 48),
(1, 4, 1706781937, 48),
(1, 4, 1706781938, 12),
(1, 4, 1706781939, 48),
(1, 4, 1706781941, 48),
(1, 4, 1706864735, 48),
(1, 4, 1706864736, 48),
(1, 4, 1706864737, 12),
(1, 4, 1706864738, 48),
(1, 4, 1706864739, 48);

-- --------------------------------------------------------

--
-- Table structure for table `log_trees`
--

CREATE TABLE `log_trees` (
  `action` int NOT NULL,
  `user_id` int NOT NULL,
  `type` int NOT NULL,
  `sum` int NOT NULL,
  `date_trees` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `log_trees`
--

INSERT INTO `log_trees` (`action`, `user_id`, `type`, `sum`, `date_trees`) VALUES
(1, 1, 1, 5000, 1704014743),
(2, 1, 1, 500, 1704014753),
(1, 1, 1, 5000, 1704014760),
(2, 4, 1, 500, 1704301754),
(1, 4, 5, 100000, 1704301759),
(2, 4, 2, 1000, 1706279512),
(1, 4, 1, 5000, 1706279701),
(2, 4, 1, 500, 1706285679),
(1, 4, 1, 5000, 1706285689),
(2, 4, 1, 500, 1706285972),
(2, 4, 4, 5000, 1706624006),
(2, 4, 3, 2000, 1706624008),
(2, 4, 5, 10000, 1706624010),
(2, 4, 2, 1000, 1706624013),
(1, 4, 3, 20000, 1706716294),
(1, 4, 3, 20000, 1706716298),
(1, 4, 3, 20000, 1706716301),
(1, 4, 3, 20000, 1706716304),
(1, 4, 2, 10000, 1706716306),
(1, 14, 1, 5000, 1715714005),
(2, 4, 3, 2000, 1736440282),
(1, 10, 1, 5000, 1737794616),
(1, 10, 2, 10000, 1737794620),
(1, 10, 3, 20000, 1737794624),
(1, 10, 4, 50000, 1737794627),
(1, 10, 5, 100000, 1737794631);

-- --------------------------------------------------------

--
-- Table structure for table `referrals`
--

CREATE TABLE `referrals` (
  `ref_id` int NOT NULL,
  `user_id` int NOT NULL,
  `deposit` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `referrals`
--

INSERT INTO `referrals` (`ref_id`, `user_id`, `deposit`) VALUES
(4, 1, 100),
(4, 1, 10),
(4, 1, 0),
(4, 11, 0),
(1, 12, 0);

-- --------------------------------------------------------

--
-- Table structure for table `storage_fruits`
--

CREATE TABLE `storage_fruits` (
  `user_id` int NOT NULL,
  `fruit1` int NOT NULL,
  `fruit2` int NOT NULL,
  `fruit3` int NOT NULL,
  `fruit4` int NOT NULL,
  `fruit5` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `storage_fruits`
--

INSERT INTO `storage_fruits` (`user_id`, `fruit1`, `fruit2`, `fruit3`, `fruit4`, `fruit5`) VALUES
(4, 0, 168, 576, 720, 960),
(1, 3, 0, 48, 480, 960),
(9, 0, 0, 0, 0, 0),
(10, 0, 0, 0, 0, 0),
(11, 0, 0, 0, 0, 0),
(12, 0, 0, 0, 0, 0),
(13, 0, 0, 0, 0, 0),
(14, 0, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `swap_gold`
--

CREATE TABLE `swap_gold` (
  `user_id` int NOT NULL,
  `date_swap` int NOT NULL,
  `gold` int NOT NULL,
  `silver` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `swap_gold`
--

INSERT INTO `swap_gold` (`user_id`, `date_swap`, `gold`, `silver`) VALUES
(4, 1705765349, 199, 199),
(4, 1705765544, 70000, 70000),
(4, 1706098452, 5, 5),
(4, 1706098456, 56, 56),
(4, 1706098458, 12, 12),
(4, 1706098468, 3, 3),
(4, 1706098475, 3, 3),
(4, 1706098480, 21, 21),
(4, 1706098483, 100, 100),
(4, 1706098485, 100, 100),
(4, 1706098497, 100, 100),
(4, 1706098503, 100, 100),
(4, 1706098505, 100, 100),
(4, 1706098508, 100, 100),
(4, 1706098510, 100, 100),
(4, 1706098512, 100, 100),
(4, 1706098516, 100, 100),
(4, 1706098518, 100, 100),
(4, 1706098520, 100, 100),
(4, 1706098522, 100, 100),
(4, 1706098526, 100, 100),
(4, 1706098530, 100, 100),
(4, 1706120560, 8500, 8500),
(4, 1706545912, 1000, 1000),
(4, 1706545926, 1000, 1000),
(4, 1706714992, 1000, 1000),
(4, 1706715049, 1000, 1000),
(4, 1706715049, 1000, 1000),
(4, 1706715049, 1000, 1000),
(4, 1706715049, 1000, 1000),
(4, 1706715049, 1000, 1000),
(4, 1706715049, 1000, 1000),
(4, 1706715049, 1000, 1000),
(4, 1706715049, 1000, 1000),
(4, 1706715049, 1000, 1000),
(4, 1706715049, 1000, 1000),
(4, 1706715049, 1000, 1000),
(4, 1706715049, 1000, 1000),
(4, 1706715049, 1000, 1000),
(4, 1706715049, 1000, 1000),
(4, 1706715049, 1000, 1000),
(4, 1706715053, 1000, 1000),
(4, 1706715053, 1000, 1000),
(4, 1706715053, 1000, 1000),
(4, 1706715053, 1000, 1000),
(4, 1706715053, 1000, 1000),
(4, 1706715053, 1000, 1000),
(4, 1706715053, 1000, 1000),
(4, 1706715053, 1000, 1000),
(4, 1706715053, 1000, 1000),
(4, 1706715053, 1000, 1000),
(4, 1706715056, 1000, 1000),
(4, 1706715056, 1000, 1000),
(4, 1706715056, 1000, 1000),
(4, 1706715056, 1000, 1000),
(4, 1706715056, 1000, 1000),
(4, 1706715056, 1000, 1000),
(4, 1706715057, 1000, 1000),
(4, 1706715057, 1000, 1000),
(4, 1706715057, 1000, 1000),
(4, 1706715057, 1000, 1000),
(4, 1706715057, 1000, 1000),
(4, 1706715057, 1000, 1000),
(4, 1706715057, 1000, 1000),
(4, 1706715057, 1000, 1000),
(4, 1706715057, 1000, 1000),
(4, 1706715057, 5, 5),
(4, 1706715057, 1000, 1000),
(4, 1706715057, 1000, 1000),
(4, 1706715057, 1000, 1000),
(4, 1706715057, 1000, 1000),
(4, 1706715057, 1000, 1000),
(4, 1706715057, 1000, 1000),
(4, 1706715057, 1000, 1000),
(4, 1706715057, 1000, 1000),
(4, 1706715058, 1000, 1000),
(4, 1706715058, 1000, 1000),
(4, 1706715058, 1000, 1000),
(4, 1706715058, 5, 5),
(4, 1706715395, 7, 7);

-- --------------------------------------------------------

--
-- Table structure for table `temp_battle`
--

CREATE TABLE `temp_battle` (
  `battle_id` int NOT NULL,
  `user_id` int NOT NULL,
  `p_god1` int NOT NULL,
  `p_god2` int NOT NULL,
  `p_god3` int NOT NULL,
  `p_god4` int NOT NULL,
  `battle_cost` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `temp_battle`
--

INSERT INTO `temp_battle` (`battle_id`, `user_id`, `p_god1`, `p_god2`, `p_god3`, `p_god4`, `battle_cost`) VALUES
(85, 9, 994, 1036, 964, 1033, 0),
(94, 0, 909, 1009, 1025, 940, 0),
(95, 10, 926, 948, 1089, 1019, 0);

-- --------------------------------------------------------

--
-- Table structure for table `temp_fight`
--

CREATE TABLE `temp_fight` (
  `battle_id` int NOT NULL,
  `enemy_id` int NOT NULL,
  `p_god1` int NOT NULL,
  `p_god2` int NOT NULL,
  `p_god3` int NOT NULL,
  `p_god4` int NOT NULL,
  `date_end` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `temp_fight`
--

INSERT INTO `temp_fight` (`battle_id`, `enemy_id`, `p_god1`, `p_god2`, `p_god3`, `p_god4`, `date_end`) VALUES
(44, 4, 912, 976, 994, 1029, 1698307765),
(0, 4, 1079, 1063, 1068, 977, 1706715647),
(88, 4, 1039, 914, 905, 1046, 1706715648),
(5, 4, 939, 975, 1059, 976, 1706715657),
(880, 4, 911, 1095, 932, 975, 1706715660),
(176, 4, 952, 1091, 1024, 1100, 1706715664),
(90, 4, 933, 937, 1004, 1005, 1706715694),
(90, 1, 912, 1048, 1081, 1082, 1706720119);

-- --------------------------------------------------------

--
-- Table structure for table `trees`
--

CREATE TABLE `trees` (
  `user_id` int NOT NULL,
  `tree1` int NOT NULL,
  `tree2` int NOT NULL,
  `tree3` int NOT NULL,
  `tree4` int NOT NULL,
  `tree5` int NOT NULL,
  `tree1_time` int NOT NULL,
  `tree2_time` int NOT NULL,
  `tree3_time` int NOT NULL,
  `tree4_time` int NOT NULL,
  `tree5_time` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `trees`
--

INSERT INTO `trees` (`user_id`, `tree1`, `tree2`, `tree3`, `tree4`, `tree5`, `tree1_time`, `tree2_time`, `tree3_time`, `tree4_time`, `tree5_time`) VALUES
(4, 3, 3, 0, 2, 3, 1706907935, 1736483423, 0, 1736461820, 1736483422),
(1, 1, 4, 4, 5, 3, 1704025648, 1704101293, 1704101295, 1704187748, 1704058092),
(9, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(10, 1, 2, 3, 4, 5, 1738750943, 1737816220, 1737837824, 1737881027, 1737967431),
(11, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(12, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(13, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(14, 1, 0, 0, 0, 0, 1715724805, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tutor`
--

CREATE TABLE `tutor` (
  `user_id` int NOT NULL,
  `tutor_id` int NOT NULL,
  `status` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tutor`
--

INSERT INTO `tutor` (`user_id`, `tutor_id`, `status`) VALUES
(4, 1, 1),
(4, 2, 1),
(9, 1, 0),
(9, 2, 0),
(10, 1, 1),
(10, 2, 1),
(11, 1, 0),
(11, 2, 0),
(12, 1, 0),
(12, 2, 0),
(13, 1, 1),
(13, 2, 0),
(14, 1, 1),
(14, 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int NOT NULL,
  `username` text COLLATE utf8mb4_general_ci NOT NULL,
  `email` text COLLATE utf8mb4_general_ci NOT NULL,
  `password` text COLLATE utf8mb4_general_ci NOT NULL,
  `payeer_wallet` varchar(20) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `ref_id` int NOT NULL,
  `ban` int NOT NULL DEFAULT '0',
  `key_forgot` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `email`, `password`, `payeer_wallet`, `ref_id`, `ban`, `key_forgot`) VALUES
(1, 'Admin', 'admin@admin.com', '$2y$10$OtfOJgsvUvHqvLhiTAJAuOzRA1yhX0dVXaG9aUSgQ1fBqhERAtykG', NULL, 0, 0, ''),
(4, 'test', 'test@gmail.com', '$2y$10$Xi6EqedhsT8xY6AtETKAzu8UI6XuvtMwNns6DwxEYg7cL6nyetdyq', 'P1111223545', 1, 0, ''),
(5, 'test2', 'test2@gmail.com', '$2y$10$OtfOJgsvUvHqvLhiTAJAuOzRA1yhX0dVXaG9aUSgQ1fBqhERAtykG', NULL, 116, 0, ''),
(6, 'test3', 'test3@gmail.com', '$2y$10$OtfOJgsvUvHqvLhiTAJAuOzRA1yhX0dVXaG9aUSgQ1fBqhERAtykG', NULL, 1, 1, ''),
(7, 'test4', 'test4@gmail.com', '$2y$10$OtfOJgsvUvHqvLhiTAJAuOzRA1yhX0dVXaG9aUSgQ1fBqhERAtykG', NULL, 1, 0, ''),
(8, 'test5', 'test5@gmail.com', '$2y$10$OtfOJgsvUvHqvLhiTAJAuOzRA1yhX0dVXaG9aUSgQ1fBqhERAtykG', NULL, 0, 0, ''),
(9, 'test6', 'test6@gmail.com', '$2y$10$jAmx0pQljVccRwq8VOj2/.zLNuO9DlagBsLpt4MY/eC3gC8glMW8.', NULL, 0, 0, NULL),
(10, 'asdqwe', 'asdqwe@gmail.com', '$2y$10$Xi6EqedhsT8xY6AtETKAzu8UI6XuvtMwNns6DwxEYg7cL6nyetdyq', 'P1112312312', 0, 0, NULL),
(11, 'asdqwe123', 'asdqwe123@gmail.com', '$2y$10$xpCGgG/spAcqSzPBCp1S2O9BjcVVALr6oL8iGBsuTyrvV4KljVvya', NULL, 4, 0, NULL),
(12, 'dwUQQUrL', 'sample@email.tst', '$2y$10$EhHDKUVmRXoyJzoh3q0wnuDmfvAajNibCvxkA.b0hUZhKwgQXwzIu', NULL, 1, 0, '04d11f21969fe06bcccfb1684c1615f3'),
(13, 'testpear', 'testpear@gmail.com', '$2y$10$BBR9pNLAtiFGKAni3Dqh1Or5Yd4LQwKtgEXdErypcmY9ax93ddZp6', NULL, 0, 0, NULL),
(14, 'test123', 'test123@gmail.com', '$2y$10$cXIFZcarJUC3b/YBMlNam.C8XKEFaKhH5UVXwtL2U5UjjOwvS3oyW', NULL, 0, 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users_b`
--

CREATE TABLE `users_b` (
  `user_id` int NOT NULL,
  `username` text COLLATE utf8mb4_general_ci NOT NULL,
  `silver` int NOT NULL,
  `gold` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users_b`
--

INSERT INTO `users_b` (`user_id`, `username`, `silver`, `gold`) VALUES
(4, 'test', 1000000, 213668),
(1, 'Admin', 1000000, 276670),
(8, 'test5', 1000000, 0),
(9, 'test6', 1000000, 0),
(10, 'asdqwe', 815000, 0),
(11, 'asdqwe123', 1000000, 0),
(12, 'dwUQQUrL', 1000000, 0),
(13, 'testpear', 1000000, 0),
(14, 'test123', 1000000, 850000);

-- --------------------------------------------------------

--
-- Table structure for table `users_deposit`
--

CREATE TABLE `users_deposit` (
  `deposit_id` int NOT NULL,
  `user_id` int NOT NULL,
  `date_deposit` int NOT NULL,
  `gold` int NOT NULL,
  `status` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users_deposit`
--

INSERT INTO `users_deposit` (`deposit_id`, `user_id`, `date_deposit`, `gold`, `status`) VALUES
(8, 10, 1714671900, 1000, 0),
(9, 14, 1715712515, 10000, 1),
(10, 10, 1717182460, 1000, 0),
(11, 10, 1724840475, 1000, 0),
(12, 10, 1724840671, 1000, 0),
(13, 10, 1724840688, 1000, 0),
(14, 10, 1724844149, 1000, 0),
(15, 10, 1724844155, 1000, 0),
(16, 10, 1724844171, 1000, 0),
(17, 10, 1724871511, 1000, 0),
(18, 4, 1736440356, 5000, 0),
(19, 4, 1736440362, 5000, 1),
(20, 10, 1739690840, 1000, 0),
(21, 10, 1739690858, 1000, 0),
(22, 10, 1739690871, 1000, 0);

-- --------------------------------------------------------

--
-- Table structure for table `users_withdraw`
--

CREATE TABLE `users_withdraw` (
  `withdraw_id` int NOT NULL,
  `user_id` int NOT NULL,
  `date_withdraw` int NOT NULL,
  `gold` int NOT NULL,
  `payeer_wallet` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `status` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users_withdraw`
--

INSERT INTO `users_withdraw` (`withdraw_id`, `user_id`, `date_withdraw`, `gold`, `payeer_wallet`, `status`) VALUES
(1, 4, 1706546040, 10720, 'P123456', 1),
(2, 4, 1706548326, 10000, 'P123456', 0),
(3, 4, 1706548331, 20000, 'P123456', 1),
(4, 4, 1706548334, 50000, 'P123456', 0),
(5, 1, 1706548419, 1615, 'P123456', 1),
(6, 1, 1706548426, 10000, 'P123456', 0),
(7, 1, 1706548429, 10000, 'P123456', 1),
(8, 4, 1706548821, 10000, 'P123456', 1),
(9, 4, 1706605992, 1000, 'P123456', 0),
(10, 4, 1706606207, 1000, 'P123456', 0),
(11, 4, 1706606305, 1050, 'P12312414', 0),
(12, 4, 1706606472, 1050, 'P1111223545', 0),
(13, 4, 1706714998, 1000, 'P1111223545', 0),
(14, 4, 1706715049, 1000, 'P1111223545', 0),
(15, 4, 1706715049, 1000, 'P1111223545', 0),
(16, 4, 1706715049, 1000, 'P1111223545', 0),
(17, 4, 1706715049, 1000, 'P1111223545', 0),
(18, 4, 1706715049, 1000, 'P1111223545', 0),
(19, 4, 1706715049, 1000, 'P1111223545', 0),
(20, 4, 1706715049, 1000, 'P1111223545', 0),
(21, 4, 1706715049, 1000, 'P1111223545', 0),
(22, 4, 1706715049, 1000, 'P1111223545', 0),
(23, 4, 1706715049, 1000, 'P1111223545', 0),
(24, 4, 1706715049, 1000, 'P1111223545', 0),
(25, 4, 1706715049, 1000, 'P1111223545', 0),
(26, 4, 1706715049, 1000, 'P1111223545', 0),
(27, 4, 1706715050, 1000, 'P1111223545', 0),
(28, 4, 1706715050, 1000, 'P1111223545', 0),
(29, 4, 1706715053, 1000, 'P1111223545', 0),
(30, 4, 1706715053, 1000, 'P1111223545', 0),
(31, 4, 1706715053, 1000, 'P1111223545', 0),
(32, 4, 1706715053, 1000, 'P1111223545', 0),
(33, 4, 1706715053, 1000, 'P1111223545', 0),
(34, 4, 1706715053, 1000, 'P1111223545', 0),
(35, 4, 1706715053, 1000, 'P1111223545', 0),
(36, 4, 1706715053, 1000, 'P1111223545', 0),
(37, 4, 1706715053, 1000, 'P1111223545', 0),
(38, 4, 1706715053, 1000, 'P1111223545', 0),
(39, 4, 1706715057, 1000, 'P1111223545', 0),
(40, 4, 1706715057, 1000, 'P1111223545', 0),
(41, 4, 1706715057, 1000, 'P1111223545', 0),
(42, 4, 1706715057, 1000, 'P1111223545', 0),
(43, 4, 1706715057, 1000, 'P1111223545', 0),
(44, 4, 1706715057, 1000, 'P1111223545', 0),
(45, 4, 1706715058, 1000, 'P1111223545', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `adminKaa179`
--
ALTER TABLE `adminKaa179`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `history_battle`
--
ALTER TABLE `history_battle`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `temp_battle`
--
ALTER TABLE `temp_battle`
  ADD PRIMARY KEY (`battle_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `users_deposit`
--
ALTER TABLE `users_deposit`
  ADD PRIMARY KEY (`deposit_id`);

--
-- Indexes for table `users_withdraw`
--
ALTER TABLE `users_withdraw`
  ADD PRIMARY KEY (`withdraw_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `history_battle`
--
ALTER TABLE `history_battle`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT for table `temp_battle`
--
ALTER TABLE `temp_battle`
  MODIFY `battle_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=98;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `users_deposit`
--
ALTER TABLE `users_deposit`
  MODIFY `deposit_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `users_withdraw`
--
ALTER TABLE `users_withdraw`
  MODIFY `withdraw_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
