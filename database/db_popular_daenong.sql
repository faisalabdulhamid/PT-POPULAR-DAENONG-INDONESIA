-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Dec 13, 2017 at 10:31 PM
-- Server version: 10.1.13-MariaDB
-- PHP Version: 7.0.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_popular_daenong`
--

-- --------------------------------------------------------

--
-- Table structure for table `bahan_baku`
--

CREATE TABLE `bahan_baku` (
  `id` int(10) UNSIGNED NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `satuan` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gramasi` enum('20 s','25 s','30 s','35 s','40 s') COLLATE utf8mb4_unicode_ci NOT NULL,
  `pegawai_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `bahan_baku`
--

INSERT INTO `bahan_baku` (`id`, `nama`, `satuan`, `gramasi`, `pegawai_id`, `created_at`, `updated_at`) VALUES
(4, 'Benang Polyester', 'gram', '25 s', 2, NULL, NULL),
(5, 'Benang Cotton', 'gram', '30 s', 2, '2017-11-30 08:31:04', '2017-11-30 08:31:17'),
(8, 'Benang Spandex', 'gram', '25 s', 2, NULL, NULL),
(9, 'Benang Wol', 'gram', '40 s', 14, '2017-12-12 12:50:33', '2017-12-12 12:50:46');

-- --------------------------------------------------------

--
-- Table structure for table `detail_bahan_baku`
--

CREATE TABLE `detail_bahan_baku` (
  `supplier_id` int(10) UNSIGNED NOT NULL,
  `bahan_baku_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `detail_bahan_baku`
--

INSERT INTO `detail_bahan_baku` (`supplier_id`, `bahan_baku_id`) VALUES
(2, 4),
(2, 5);

-- --------------------------------------------------------

--
-- Table structure for table `detail_pembelian`
--

CREATE TABLE `detail_pembelian` (
  `bahan_baku_id` int(10) UNSIGNED NOT NULL,
  `pembelian_id` int(10) UNSIGNED NOT NULL,
  `jumlah` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `detail_pembelian`
--

INSERT INTO `detail_pembelian` (`bahan_baku_id`, `pembelian_id`, `jumlah`) VALUES
(4, 5, 122),
(5, 5, 12);

-- --------------------------------------------------------

--
-- Table structure for table `detail_pesanan`
--

CREATE TABLE `detail_pesanan` (
  `jumlah` int(10) UNSIGNED NOT NULL,
  `sub_total` int(10) UNSIGNED NOT NULL,
  `pesanan_id` int(10) UNSIGNED NOT NULL,
  `produk_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `detail_pesanan`
--

INSERT INTO `detail_pesanan` (`jumlah`, `sub_total`, `pesanan_id`, `produk_id`) VALUES
(10, 198000, 5, 2),
(3, 600000, 6, 6),
(4, 79200, 6, 2);

-- --------------------------------------------------------

--
-- Table structure for table `detail_produk`
--

CREATE TABLE `detail_produk` (
  `jumlah` int(10) UNSIGNED NOT NULL,
  `bahan_baku_id` int(10) UNSIGNED NOT NULL,
  `produk_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `detail_produk`
--

INSERT INTO `detail_produk` (`jumlah`, `bahan_baku_id`, `produk_id`) VALUES
(600, 4, 6),
(300, 5, 6),
(100, 8, 6),
(100, 5, 2),
(250, 4, 2);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(81, '2014_10_12_100000_create_password_resets_table', 1),
(82, '2016_06_01_000001_create_oauth_auth_codes_table', 1),
(83, '2016_06_01_000002_create_oauth_access_tokens_table', 1),
(84, '2016_06_01_000003_create_oauth_refresh_tokens_table', 1),
(85, '2016_06_01_000004_create_oauth_clients_table', 1),
(86, '2016_06_01_000005_create_oauth_personal_access_clients_table', 1),
(87, '2017_11_22_072356_create_pegawais_table', 1),
(88, '2017_11_22_072924_create_pelanggans_table', 1),
(89, '2017_11_22_073203_create_suppliers_table', 1),
(90, '2017_11_22_073426_create_bahan_bakus_table', 1),
(91, '2017_11_22_073906_create_produks_table', 1),
(92, '2017_11_22_073908_buat_table_pesanan', 1),
(93, '2017_11_22_085320_buat_table_detail_bahan_baku', 1),
(94, '2017_11_22_085623_buat_table_detail_produk', 1),
(95, '2017_11_22_090002_buat_table_detail_pesanan', 1),
(98, '2017_12_06_205913_create_pembelians_table', 2),
(99, '2017_12_07_035149_create_produksis_table', 3),
(100, '2017_12_12_222540_createTableDetailPembelian', 4),
(104, '2017_12_13_181323_create_pengirimen_table', 5);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pegawai`
--

CREATE TABLE `pegawai` (
  `id` int(10) UNSIGNED NOT NULL,
  `nama` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_telepon` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `divisi` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pegawai`
--

INSERT INTO `pegawai` (`id`, `nama`, `email`, `password`, `no_telepon`, `alamat`, `divisi`, `remember_token`, `created_at`, `updated_at`) VALUES
(2, 'Marketing', 'marketing@popular.com', '$2y$10$Q3UX1RQhQN0TR75nSOc7qeJegfBRvWXP1E5wlNt1VZ71rEigjz8E2', '038101321232', '37442 Jaskolski Roads Apt. 948\nJammieburgh, GA 68576-8472', 'marketing', 'cdZzdeASlAJkyDigup0HUuVlwMYIfwX9Wkkl5ATMji51Fi7Rtk60z1XdCxNQ', '2017-11-30 03:45:19', '2017-12-12 11:13:12'),
(14, 'Admin', 'admin@popular.com', '$2y$10$26GYy3nfyACrNPsoTj8Y0eebWSe/UvWP63G5cAIy4qxZeNYq/Iqdm', '375016311233265', 'ALamat', 'admin', 'Ic99Wu4XK98U63eE4d7qd999UNf9ne6FhIYJ7vEt5i9MK3B66WRXndNuWu5T', '2017-11-30 06:47:37', '2017-12-12 11:13:57'),
(18, 'Purchesing', 'purchesing@popular.com', '$2y$10$iiXTajCFBHFiUU1urRz78eMqmDYVhHEcU/e5MFbVhoFERLqzcQBfq', '3750163112323265', 'Alamat', 'purchasing', '08X67SS677svkQDiSrctwZSLN5IvDpSnW0keupeVvhXkOFWVhUbml40MV3IT', '2017-11-30 08:40:24', '2017-12-12 11:14:36'),
(19, 'Produksi', 'produksi@popular.com', '$2y$10$HMdIHC4aGLgbcE.QWnHeTeHdPYTNo79J3dSIoIFC5wPWFz6ubiMx.', '098765432123', 'Alamat', 'produksi', '1VBSRi1ie12ePyyi45morpcHmBKv4l69jHi1DjYj3MLoiBvtwaqEC2e4EP9B', '2017-12-12 11:16:27', '2017-12-12 11:16:27'),
(20, 'Exim', 'exim@popular.com', '$2y$10$gmPOSHk/ux7xdUmad1UpOuTAPOuRR7BYpkBmf8gQ1ChkLfYOVgSTG', '0987654321123456', 'Alamat', 'exim', '9fr6m6uOt69Ka6HyN3LiF3ZqdCfYeBFDrRFHMEqzQyI2ryrU5S73HG9ylt57', '2017-12-12 11:17:17', '2017-12-12 11:17:17'),
(21, 'Yansi', 'yansi@yamail.com', '$2y$10$w.d/37lz2S52MfYD2kKu4OqnahAEvcksL10H/BCNyjyiWL6HVZwO6', '021356854512', 'Alamat', 'admin', NULL, '2017-12-12 12:52:51', '2017-12-12 12:52:51');

-- --------------------------------------------------------

--
-- Table structure for table `pelanggan`
--

CREATE TABLE `pelanggan` (
  `id` int(10) UNSIGNED NOT NULL,
  `nama_perusahaan` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_telepon` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pelanggan`
--

INSERT INTO `pelanggan` (`id`, `nama_perusahaan`, `no_telepon`, `email`, `alamat`, `created_at`, `updated_at`) VALUES
(2, 'Kohler PLC', '957056375322', 'june.rosenbaum@example.org', '95026 Lockman Court\nNoemyfort, CT 84768', '2017-11-30 03:45:20', '2017-11-30 09:50:43'),
(3, 'Johnston Group', '28276586', 'waino04@example.com', '97391 Marina Points\nSouth Leannamouth, ID 29890-6744', '2017-11-30 03:45:20', '2017-11-30 03:45:20'),
(4, 'Lowe Group', '17542333', 'albert59@example.net', '8339 Louvenia Isle\nPort Axel, SD 09704-1704', '2017-11-30 03:45:20', '2017-11-30 03:45:20'),
(5, 'Toy Ltd', '20778668', 'gertrude21@example.com', '5276 Rashad Avenue\nEast Terencefort, WA 87597', '2017-11-30 03:45:20', '2017-11-30 03:45:20'),
(6, 'Crooks, Christiansen and Wuckert', '93645935', 'qwitting@example.com', '861 Bergstrom Rest Suite 364\nTaureanview, VT 69160', '2017-11-30 03:45:20', '2017-11-30 03:45:20'),
(7, 'Doyle Inc', '97850991', 'gjones@example.net', '8304 Halvorson Corners Suite 968\nKundefurt, NM 00790', '2017-11-30 03:45:20', '2017-11-30 03:45:20'),
(8, 'Hackett, Cronin and Cummings', '26567846', 'shanel.boyle@example.org', '3121 Sienna Row\nEast Bradly, TX 52253-7854', '2017-11-30 03:45:20', '2017-11-30 03:45:20'),
(9, 'Hilll LLC', '23263840', 'zadams@example.com', '3677 Jess Crossing Suite 471\nMraztown, AK 25479', '2017-11-30 03:45:20', '2017-11-30 03:45:20'),
(12, 'Skiles, Sauer and Mraz', '43423200', 'beier.isadore@example.org', '73009 Cristina Lake\nHenryfort, CO 76335', '2017-11-30 03:45:20', '2017-11-30 03:45:20'),
(14, 'Krajcik, Glover and Conroy', '87467055', 'theo.vandervort@example.net', '1999 Buford Cliffs Apt. 814\nFerminborough, MD 51017', '2017-11-30 03:45:21', '2017-11-30 03:45:21'),
(15, 'Bergnaum, Kassulke and Reichert', '30251229', 'newell.runolfsson@example.com', '2095 Jett Walk\nWest Mitchelborough, AL 09660', '2017-11-30 03:45:21', '2017-11-30 03:45:21'),
(16, 'Haley-Haley', '44205812', 'thora.cartwright@example.org', '20201 Shakira Port\nMarquisefort, WI 62071', '2017-11-30 03:45:21', '2017-11-30 03:45:21'),
(17, 'Luettgen, Ortiz and Greenfelder', '65215296', 'carroll48@example.org', '1751 Peter Branch\nSchinnerville, WA 00498-9359', '2017-11-30 03:45:21', '2017-11-30 03:45:21'),
(18, 'Jenkins Group', '97831396', 'rstanton@example.net', '99546 Doyle Course\nRonport, KY 30767', '2017-11-30 03:45:21', '2017-11-30 03:45:21'),
(19, 'Zemlak-Willms', '59963745', 'oconner.jalyn@example.org', '6773 Kiehn Route Suite 714\nVonRuedenton, NC 76344', '2017-11-30 03:45:21', '2017-11-30 03:45:21'),
(20, 'Gutkowski, Crist and Runolfsdottir', '01324990', 'mary75@example.net', '9218 Gay Squares\nSouth Darrell, OR 68845-7117', '2017-11-30 03:45:21', '2017-11-30 03:45:21'),
(21, 'Simonis, Davis and McKenzie', '62878746', 'eliza95@example.com', '16299 Schulist Drive\nDevenburgh, IL 50366-2174', '2017-11-30 03:45:21', '2017-11-30 03:45:21'),
(22, 'Prosacco, Bechtelar and Stoltenberg', '45604638', 'jarrell.abernathy@example.com', '4786 Eichmann Road\nO''Connellmouth, NJ 97972-5227', '2017-11-30 03:45:21', '2017-11-30 03:45:21'),
(23, 'Stroman-Gislason', '51014858', 'mariah05@example.org', '240 Schroeder Lock Suite 675\nO''Connellfort, MN 60988-7524', '2017-11-30 03:45:21', '2017-11-30 03:45:21'),
(24, 'Anderson, Terry and Bergstrom', '80243083', 'emory.bradtke@example.com', '1445 Angie Avenue Suite 718\nAdrienneton, MI 76585', '2017-11-30 03:45:21', '2017-11-30 03:45:21'),
(25, 'Schmidt-Pouros', '65590201', 'jordane65@example.com', '24836 Morissette Spur Apt. 921\nKristyberg, NC 45981-8372', '2017-11-30 03:45:21', '2017-11-30 03:45:21'),
(26, 'Ryan Ltd', '42945093', 'reichel.shaylee@example.org', '157 Eladio Wells\nPort Aishabury, NY 89813-2345', '2017-11-30 03:45:21', '2017-11-30 03:45:21'),
(27, 'Ebert, Langosh and Leffler', '43021222', 'hoeger.cesar@example.org', '47817 Davis Highway Apt. 576\nWest Kris, AK 87284-2380', '2017-11-30 03:45:21', '2017-11-30 03:45:21'),
(28, 'Mohr-Sporer', '54551060', 'toy.deangelo@example.com', '415 Leffler Junctions Apt. 068\nLake Ernieview, AR 53746', '2017-11-30 03:45:21', '2017-11-30 03:45:21'),
(29, 'Heathcote Inc', '60820280', 'oreilly.leone@example.org', '1807 Hoppe Club Apt. 203\nUllrichchester, CT 10045-7416', '2017-11-30 03:45:21', '2017-11-30 03:45:21'),
(30, 'Anderson, Rath and Schaden', '05163311', 'jerde.michelle@example.com', '9331 Roy Plains Apt. 875\nLake Armandport, MI 11241-5274', '2017-11-30 03:45:21', '2017-11-30 03:45:21'),
(31, 'Gibson Group', '42370086', 'eliza.schulist@example.com', '848 Hansen Pines Apt. 137\nToystad, HI 61358-3441', '2017-11-30 03:45:21', '2017-11-30 03:45:21'),
(32, 'Raynor Inc', '49426724', 'mose.stamm@example.net', '10095 Bradtke Burg\nEmmetberg, IN 63933-0102', '2017-11-30 03:45:21', '2017-11-30 03:45:21'),
(33, 'Herman, Lowe and Pfannerstill', '13438371', 'erin.mcclure@example.org', '6282 Domenick Roads Suite 159\nReichertborough, DC 01840', '2017-11-30 03:45:21', '2017-11-30 03:45:21'),
(34, 'Nitzsche, Effertz and Renner', '13328535', 'leffler.esmeralda@example.org', '71514 Brekke Rapids\nEast Milton, VT 49879-6727', '2017-11-30 03:45:22', '2017-11-30 03:45:22'),
(35, 'Boyle, Rodriguez and Rosenbaum', '72129739', 'zstroman@example.org', '79575 Kuhlman Road\nSouth Nannie, ND 11404-3090', '2017-11-30 03:45:22', '2017-11-30 03:45:22'),
(36, 'Schoen Group', '96988985', 'wyman.anibal@example.com', '10649 Virginia Brooks Suite 365\nHoppemouth, NC 41455', '2017-11-30 03:45:22', '2017-11-30 03:45:22'),
(37, 'Barton, Ratke and Farrell', '82942922', 'bennie.koepp@example.org', '975 Filomena Meadows Apt. 679\nWest Baylee, KY 21854', '2017-11-30 03:45:22', '2017-11-30 03:45:22'),
(38, 'Considine and Sons', '12412372', 'kovacek.brandyn@example.com', '9347 Hodkiewicz Neck\nFabianbury, WA 86416-5285', '2017-11-30 03:45:22', '2017-11-30 03:45:22'),
(39, 'Hudson-Dickinson', '89180112', 'lorenzo72@example.net', '789 Jast Rue\nSouth Mallory, HI 32043', '2017-11-30 03:45:22', '2017-11-30 03:45:22'),
(40, 'Jerde, Brakus and Raynor', '18887983', 'shanahan.kianna@example.net', '321 Crona Flats\nNew Blake, NV 65939', '2017-11-30 03:45:22', '2017-11-30 03:45:22'),
(41, 'Gleason Group', '26736891', 'luna39@example.net', '8152 Hegmann Lodge\nWilkinsonmouth, TX 41729', '2017-11-30 03:45:22', '2017-11-30 03:45:22'),
(42, 'Wolf and Sons', '97303435', 'wschmitt@example.com', '12285 Schiller Square\nNew Arjun, CT 33892', '2017-11-30 03:45:22', '2017-11-30 03:45:22'),
(43, 'Greenholt, Schimmel and Hills', '87441581', 'laurence92@example.org', '482 Frederick Well Apt. 130\nPort Garthbury, CT 92151', '2017-11-30 03:45:22', '2017-11-30 03:45:22'),
(44, 'Orn LLC', '85172517', 'scollins@example.org', '2350 Jackson Parks\nSouth Laurelberg, AZ 27991', '2017-11-30 03:45:22', '2017-11-30 03:45:22'),
(45, 'Powlowski-Howe', '07571831', 'qdubuque@example.org', '766 Hirthe Port Apt. 483\nSouth Rachael, CA 93046-4762', '2017-11-30 03:45:22', '2017-11-30 03:45:22'),
(46, 'Kshlerin, Harris and Cole', '93071963', 'cronin.torrey@example.com', '877 Powlowski Club\nPort Luna, DC 30782', '2017-11-30 03:45:22', '2017-11-30 03:45:22'),
(47, 'Tillman PLC', '53182722', 'queenie14@example.org', '82926 Jamil Islands Apt. 624\nEast Dawsonfort, KS 34153-3366', '2017-11-30 03:45:22', '2017-11-30 03:45:22'),
(48, 'Leannon Ltd', '80996026', 'udenesik@example.org', '30897 Moen Summit Suite 698\nLake Savion, MN 48477-6688', '2017-11-30 03:45:22', '2017-11-30 03:45:22'),
(49, 'Smitham Ltd', '24766197', 'gorczany.rhiannon@example.net', '436 Crist Fields Suite 852\nNew Eileenport, MD 84302', '2017-11-30 03:45:22', '2017-11-30 03:45:22'),
(50, 'Funk-Bode', '72378878', 'vonrueden.dell@example.com', '374 Javon Rapids Suite 514\nLake Madysonbury, WY 41891-0523', '2017-11-30 03:45:22', '2017-11-30 03:45:22'),
(51, 'Batz, Moore and Hills', '25789461', 'yundt.marcia@example.com', '13583 D''Amore Highway\nDarrelmouth, VA 10997', '2017-11-30 03:45:22', '2017-11-30 03:45:22'),
(52, 'Berge, Bernhard and Rath', '16536043', 'tebert@example.org', '87831 Heidi Gateway Apt. 589\nNevaport, ND 70325-5950', '2017-11-30 03:45:22', '2017-11-30 03:45:22'),
(53, 'Cartwright PLC', '66016090', 'skye.cormier@example.com', '33985 Abernathy Pass\nLake Rockychester, NH 04816', '2017-11-30 03:45:22', '2017-11-30 03:45:22'),
(54, 'Deckow-Rempel', '38368868', 'ferry.bethany@example.com', '83228 Beau Forges Suite 262\nRosenbaumton, UT 79449-3467', '2017-11-30 03:45:22', '2017-11-30 03:45:22'),
(55, 'Deckow-Howe', '24424653', 'madelyn13@example.org', '92220 Towne Walks Suite 081\nAllanberg, SC 79740-7729', '2017-11-30 03:45:22', '2017-11-30 03:45:22'),
(56, 'Botsford, Schaden and Ratke', '23924963', 'arlo02@example.com', '4363 D''Amore Underpass\nStehrmouth, PA 24397', '2017-11-30 03:45:22', '2017-11-30 03:45:22'),
(57, 'Von-Pouros', '70080872', 'aurelie43@example.com', '8770 Lemke Extension\nSouth Delmerberg, ND 94246', '2017-11-30 03:45:23', '2017-11-30 03:45:23'),
(58, 'Stamm Ltd', '32267242', 'cjacobi@example.org', '6965 Clifford Trail\nDejaburgh, DC 82347', '2017-11-30 03:45:23', '2017-11-30 03:45:23'),
(59, 'Rogahn Ltd', '47663282', 'jboyle@example.com', '850 Maiya Cove\nPort Zoeville, AL 93681-5876', '2017-11-30 03:45:23', '2017-11-30 03:45:23'),
(60, 'Shields PLC', '61156791', 'dayana.ruecker@example.net', '5343 Torp Parkways\nPort Hortense, NV 72854-8830', '2017-11-30 03:45:23', '2017-11-30 03:45:23'),
(61, 'Schiller PLC', '44058784', 'demond17@example.net', '51351 Johnson Fields Apt. 711\nHomenickfort, RI 74134-9265', '2017-11-30 03:45:23', '2017-11-30 03:45:23'),
(62, 'Schinner, Kunze and Funk', '44464660', 'igoodwin@example.org', '50660 Witting Mission\nAglaeborough, WI 67296-3717', '2017-11-30 03:45:23', '2017-11-30 03:45:23'),
(63, 'Little and Sons', '58139837', 'kerluke.larissa@example.com', '166 Marques Crossing Suite 121\nLake Khalil, CA 93523', '2017-11-30 03:45:23', '2017-11-30 03:45:23'),
(64, 'Green PLC', '60655998', 'keeley.rodriguez@example.net', '3055 Pinkie Harbor\nWest Abnerbury, MA 82236', '2017-11-30 03:45:23', '2017-11-30 03:45:23'),
(65, 'Zulauf-Batz', '27568293', 'mireya67@example.net', '29426 Spencer Fork\nHintzview, NH 94278-4391', '2017-11-30 03:45:23', '2017-11-30 03:45:23'),
(66, 'Treutel-Stehr', '86936293', 'alexis30@example.net', '1208 Yvette Island Apt. 949\nNew Bethelshire, KS 58836', '2017-11-30 03:45:23', '2017-11-30 03:45:23'),
(67, 'Adams PLC', '52537066', 'berge.keaton@example.com', '27178 Stiedemann Ramp\nNew Claud, OK 46778', '2017-11-30 03:45:23', '2017-11-30 03:45:23'),
(68, 'Jerde Group', '53316080', 'nconnelly@example.com', '6304 Christophe Burg Apt. 829\nEast Adele, RI 19698', '2017-11-30 03:45:23', '2017-11-30 03:45:23'),
(69, 'Robel LLC', '79100809', 'jordy99@example.com', '57715 Selina Club\nNorth Henriettefurt, NM 53082-7105', '2017-11-30 03:45:23', '2017-11-30 03:45:23'),
(70, 'Hermann-Koelpin', '58440551', 'nyah.gottlieb@example.com', '3019 Marvin Pine Suite 723\nWest Julienfurt, NV 61598', '2017-11-30 03:45:23', '2017-11-30 03:45:23'),
(71, 'Hoeger, Hintz and D''Amore', '32917734', 'lkoss@example.com', '4565 Geo Lodge\nWest Wymanville, IA 86986-1240', '2017-11-30 03:45:23', '2017-11-30 03:45:23'),
(72, 'Nolan LLC', '84167774', 'odessa.lueilwitz@example.net', '762 Alberto Well\nLake Imeldaland, KS 97251', '2017-11-30 03:45:23', '2017-11-30 03:45:23'),
(73, 'Moen-Moore', '57196718', 'spencer.maryam@example.com', '91945 Tillman Views Suite 800\nCarterfort, CO 77402-1443', '2017-11-30 03:45:23', '2017-11-30 03:45:23'),
(74, 'Hermann and Sons', '73659624', 'kelsi.schmidt@example.com', '8358 Mylene Valleys Suite 821\nEast Constantin, CT 38846-1895', '2017-11-30 03:45:23', '2017-11-30 03:45:23'),
(75, 'Weber, Legros and Ward', '09603110', 'qharber@example.com', '2977 Howe Cliff Suite 164\nNorth Efrenton, MS 37485-8414', '2017-11-30 03:45:23', '2017-11-30 03:45:23'),
(76, 'Lebsack-Bailey', '46770059', 'bogan.nickolas@example.net', '787 Dario Lodge Suite 961\nNew Elwynton, WI 87586', '2017-11-30 03:45:23', '2017-11-30 03:45:23'),
(77, 'Auer-Reichert', '39211965', 'camren09@example.com', '449 Casper Road\nLittleton, NE 26883-3968', '2017-11-30 03:45:23', '2017-11-30 03:45:23'),
(78, 'Stroman and Sons', '62927024', 'desmond05@example.org', '5875 Kenyon Village Suite 629\nQuitzonton, CT 82901-8470', '2017-11-30 03:45:23', '2017-11-30 03:45:23'),
(79, 'Runte Ltd', '70505238', 'markus62@example.org', '29816 Granville Summit Suite 067\nSimeonstad, DE 56572', '2017-11-30 03:45:24', '2017-11-30 03:45:24'),
(80, 'Ebert-Gulgowski', '90234163', 'ansel.hickle@example.org', '32176 Nicolette Branch Suite 976\nNorth Arvelview, WV 84523-0404', '2017-11-30 03:45:24', '2017-11-30 03:45:24'),
(81, 'Volkman-Bartell', '43552948', 'lambert99@example.org', '312 Marks Field\nEast Cary, MD 98503-9358', '2017-11-30 03:45:24', '2017-11-30 03:45:24'),
(82, 'Osinski and Sons', '53641885', 'penelope.bode@example.com', '800 Blanda Unions\nEast Melyssa, MT 31981-5358', '2017-11-30 03:45:24', '2017-11-30 03:45:24'),
(83, 'Hirthe-Zemlak', '48259767', 'kole.hickle@example.org', '120 Walker Tunnel Suite 904\nPort Yadiraberg, ND 43718-1608', '2017-11-30 03:45:24', '2017-11-30 03:45:24'),
(84, 'Hahn and Sons', '24915014', 'geraldine.wuckert@example.com', '571 Fahey Drive Apt. 583\nEast Eldon, MA 85631', '2017-11-30 03:45:24', '2017-11-30 03:45:24'),
(85, 'Metz-Thompson', '98778591', 'prohaska.shawn@example.org', '40607 Myrtice Stream Apt. 912\nNorth Jaronton, NV 17507-6745', '2017-11-30 03:45:24', '2017-11-30 03:45:24'),
(86, 'Hermann, Bergstrom and Harber', '14591891', 'anderson.kertzmann@example.org', '2048 Oscar Crossroad Suite 378\nPort Aminaview, RI 91422', '2017-11-30 03:45:24', '2017-11-30 03:45:24'),
(87, 'Konopelski Ltd', '78323063', 'jillian63@example.org', '6291 Kaylie Rue\nNorth Kraigmouth, ME 02470', '2017-11-30 03:45:24', '2017-11-30 03:45:24'),
(88, 'Mann-McKenzie', '78954007', 'kenyon.homenick@example.net', '325 Waelchi Cliffs Suite 781\nHeatherburgh, OH 26481-4584', '2017-11-30 03:45:24', '2017-11-30 03:45:24'),
(89, 'Schuppe-Kirlin', '33337081', 'lschoen@example.com', '276 Shanahan Path\nJuanitaberg, MN 39682-7990', '2017-11-30 03:45:24', '2017-11-30 03:45:24'),
(90, 'Hansen PLC', '74743414', 'rdurgan@example.net', '6201 Kasey Extension\nJewelfurt, MI 48113-1869', '2017-11-30 03:45:24', '2017-11-30 03:45:24'),
(91, 'Boyer, McLaughlin and Abbott', '37992507', 'keyshawn.hessel@example.com', '2335 Willms Manors\nLeonieland, VT 64841', '2017-11-30 03:45:24', '2017-11-30 03:45:24'),
(92, 'Toy-Kirlin', '78891159', 'erice@example.org', '6009 Lysanne Rue\nSouth Lester, MS 59593', '2017-11-30 03:45:24', '2017-11-30 03:45:24'),
(93, 'King-Kovacek', '05443642', 'henderson41@example.com', '1773 Hodkiewicz Tunnel Apt. 123\nEmeliamouth, IL 33181', '2017-11-30 03:45:24', '2017-11-30 03:45:24'),
(94, 'Torphy-Rolfson', '00816830', 'oconner.urban@example.org', '697 Chester Street Suite 438\nLake Archibaldstad, ND 99843-8531', '2017-11-30 03:45:24', '2017-11-30 03:45:24'),
(95, 'Sauer, Tremblay and Berge', '26242187', 'eschuppe@example.com', '2903 Hermiston Harbor\nGradyview, AK 37228', '2017-11-30 03:45:24', '2017-11-30 03:45:24'),
(96, 'Kessler-Keebler', '13205355', 'cbrown@example.org', '76651 Cartwright Garden Apt. 846\nWest Ada, KS 56635', '2017-11-30 03:45:24', '2017-11-30 03:45:24'),
(97, 'Buckridge-Thiel', '94515039', 'hanna41@example.org', '7629 Zora Centers\nStromanside, KS 09148', '2017-11-30 03:45:24', '2017-11-30 03:45:24'),
(98, 'Vandervort LLC', '27146552', 'rico15@example.com', '5813 Langworth Orchard\nLake Zachery, UT 09875', '2017-11-30 03:45:24', '2017-11-30 03:45:24'),
(99, 'Kassulke, Howell and Christiansen', '14735417', 'schulist.ansel@example.com', '5095 Tony Skyway Suite 449\nLake Rethaborough, IN 67953-7668', '2017-11-30 03:45:24', '2017-11-30 03:45:24'),
(100, 'Ratke, Orn and Donnelly', '02028170', 'wilton67@example.com', '9109 Eriberto Harbors Suite 698\nWest Lamar, SD 76370-7813', '2017-11-30 03:45:24', '2017-11-30 03:45:24'),
(102, 'Kohler PLC', '038101321212', 'kris.john@example.com', 'Alamat', '2017-12-06 07:57:29', '2017-12-06 07:57:29'),
(103, 'PT Kumaha AInk', '021356854512', 'samin@gmail.com', 'Alamat', '2017-12-12 13:04:36', '2017-12-12 13:04:36');

-- --------------------------------------------------------

--
-- Table structure for table `pembelian`
--

CREATE TABLE `pembelian` (
  `id` int(10) UNSIGNED NOT NULL,
  `tanggal` date NOT NULL,
  `pegawai_id` int(10) UNSIGNED NOT NULL,
  `supplier_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pembelian`
--

INSERT INTO `pembelian` (`id`, `tanggal`, `pegawai_id`, `supplier_id`, `created_at`, `updated_at`) VALUES
(5, '2017-12-13', 18, 2, '2017-12-13 00:52:19', '2017-12-13 00:52:19');

-- --------------------------------------------------------

--
-- Table structure for table `pengiriman`
--

CREATE TABLE `pengiriman` (
  `id` int(10) UNSIGNED NOT NULL,
  `produksi_id` int(10) UNSIGNED NOT NULL,
  `pegawai_id` int(10) UNSIGNED DEFAULT NULL,
  `tanggal_selesai` date NOT NULL,
  `tanggal_kirim` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pengiriman`
--

INSERT INTO `pengiriman` (`id`, `produksi_id`, `pegawai_id`, `tanggal_selesai`, `tanggal_kirim`, `created_at`, `updated_at`) VALUES
(1, 7, 20, '2017-12-13', '2017-12-13', '2017-12-13 11:51:06', '2017-12-13 12:57:00'),
(2, 5, 20, '2017-12-13', '2017-12-13', '2017-12-13 12:31:19', '2017-12-13 12:44:45');

-- --------------------------------------------------------

--
-- Table structure for table `pesanan`
--

CREATE TABLE `pesanan` (
  `id` int(10) UNSIGNED NOT NULL,
  `pelanggan_id` int(10) UNSIGNED NOT NULL,
  `pegawai_id` int(10) UNSIGNED NOT NULL,
  `tanggal` date NOT NULL,
  `batas_waktu` date NOT NULL,
  `total_bayar` int(10) UNSIGNED NOT NULL,
  `status` enum('lunas','belum lunas') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pesanan`
--

INSERT INTO `pesanan` (`id`, `pelanggan_id`, `pegawai_id`, `tanggal`, `batas_waktu`, `total_bayar`, `status`, `created_at`, `updated_at`) VALUES
(5, 4, 2, '2017-12-12', '2017-12-15', 391440, 'lunas', '2017-12-12 12:45:06', '2017-12-12 12:45:06'),
(6, 103, 2, '2017-12-12', '2017-12-14', 679200, 'lunas', '2017-12-12 13:07:42', '2017-12-12 13:07:42'),
(7, 67, 2, '2017-12-13', '2017-12-16', 50000, 'lunas', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `produk`
--

CREATE TABLE `produk` (
  `id` int(10) UNSIGNED NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `warna` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gramasi` enum('20 s','25 s','30 s','35 s','40 s') COLLATE utf8mb4_unicode_ci NOT NULL,
  `harga` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `produk`
--

INSERT INTO `produk` (`id`, `nama`, `warna`, `gramasi`, `harga`, `created_at`, `updated_at`) VALUES
(2, 'Poly Cotton', 'Biru', '25 s', 19800, '2017-11-30 03:45:25', '2017-11-30 03:45:25'),
(6, 'Poly Cotton Frenchterry', 'Hijau', '30 s', 200000, '2017-12-12 13:00:16', '2017-12-12 13:00:16');

-- --------------------------------------------------------

--
-- Table structure for table `produksi`
--

CREATE TABLE `produksi` (
  `id` int(10) UNSIGNED NOT NULL,
  `tanggal` date NOT NULL,
  `pesanan_id` int(10) UNSIGNED NOT NULL,
  `pegawai_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `produksi`
--

INSERT INTO `produksi` (`id`, `tanggal`, `pesanan_id`, `pegawai_id`, `created_at`, `updated_at`) VALUES
(5, '2017-12-13', 5, 18, '2017-12-13 01:51:08', '2017-12-13 01:51:08'),
(6, '2017-12-13', 6, 18, '2017-12-13 01:53:08', '2017-12-13 01:53:08'),
(7, '2017-12-13', 7, 18, '2017-12-13 11:05:57', '2017-12-13 11:05:57');

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE `supplier` (
  `id` int(10) UNSIGNED NOT NULL,
  `nama` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_telepon` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`id`, `nama`, `no_telepon`, `email`, `alamat`, `created_at`, `updated_at`) VALUES
(2, 'Block PLC', '69347511', 'fhoeger@example.org', '75494 Weber Burgs\nNorth Aylinborough, TX 57581-1899', '2017-11-30 03:45:24', '2017-11-30 03:45:24'),
(3, 'Abernathy, Anderson and Kutch', '55874533', 'schaden.joel@example.com', '2220 Kshlerin Islands Apt. 687\nRoweshire, FL 91280-6627', '2017-11-30 03:45:24', '2017-11-30 03:45:24'),
(4, 'Lindgren LLC', '69357978', 'donnelly.bryana@example.net', '717 Schamberger Shore\nRosellaland, CT 73133-8762', '2017-11-30 03:45:24', '2017-11-30 03:45:24'),
(6, 'Hermann Ltd', '80723196', 'taryn.crooks@example.com', '798 Eda Valleys Suite 328\nNorth Rey, MN 58615-0059', '2017-11-30 03:45:24', '2017-11-30 03:45:24'),
(7, 'Dietrich, Morissette and Hauck', '19697024', 'rowe.stan@example.net', '5090 Schuster Mission\nNew Dennis, GA 87892-0655', '2017-11-30 03:45:24', '2017-11-30 03:45:24'),
(8, 'Breitenberg-Cummings', '50829156', 'khermann@example.org', '3305 Kayley Fort Suite 412\nLake Carlochester, CA 26590', '2017-11-30 03:45:24', '2017-11-30 03:45:24'),
(9, 'Effertz Group', '03611012', 'hand.jimmy@example.com', '863 Roberts Centers\nEast Maximillianstad, AL 48180-3223', '2017-11-30 03:45:25', '2017-11-30 03:45:25');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bahan_baku`
--
ALTER TABLE `bahan_baku`
  ADD PRIMARY KEY (`id`),
  ADD KEY `bahan_baku_pegawai_id_foreign` (`pegawai_id`);

--
-- Indexes for table `detail_bahan_baku`
--
ALTER TABLE `detail_bahan_baku`
  ADD KEY `detail_bahan_baku_supplier_id_foreign` (`supplier_id`),
  ADD KEY `detail_bahan_baku_bahan_baku_id_foreign` (`bahan_baku_id`);

--
-- Indexes for table `detail_pembelian`
--
ALTER TABLE `detail_pembelian`
  ADD KEY `detail_pembelian_pembelian_id_foreign` (`pembelian_id`),
  ADD KEY `detail_pembelian_bahan_baku_id_foreign` (`bahan_baku_id`);

--
-- Indexes for table `detail_pesanan`
--
ALTER TABLE `detail_pesanan`
  ADD KEY `detail_pesanan_pesanan_id_foreign` (`pesanan_id`),
  ADD KEY `detail_pesanan_produk_id_foreign` (`produk_id`);

--
-- Indexes for table `detail_produk`
--
ALTER TABLE `detail_produk`
  ADD KEY `detail_produk_bahan_baku_id_foreign` (`bahan_baku_id`),
  ADD KEY `detail_produk_produk_id_foreign` (`produk_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `pegawai`
--
ALTER TABLE `pegawai`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `pegawai_email_unique` (`email`);

--
-- Indexes for table `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `pelanggan_no_telepon_unique` (`no_telepon`),
  ADD UNIQUE KEY `pelanggan_email_unique` (`email`);

--
-- Indexes for table `pembelian`
--
ALTER TABLE `pembelian`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pembelian_pegawai_id_foreign` (`pegawai_id`),
  ADD KEY `pembelian_supplier_id_foreign` (`supplier_id`);

--
-- Indexes for table `pengiriman`
--
ALTER TABLE `pengiriman`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pengiriman_produksi_id_foreign` (`produksi_id`),
  ADD KEY `pengiriman_pegawai_id_foreign` (`pegawai_id`);

--
-- Indexes for table `pesanan`
--
ALTER TABLE `pesanan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pesanan_pelanggan_id_foreign` (`pelanggan_id`),
  ADD KEY `pesanan_pegawai_id_foreign` (`pegawai_id`);

--
-- Indexes for table `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `produksi`
--
ALTER TABLE `produksi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `produksi_pesanan_id_foreign` (`pesanan_id`),
  ADD KEY `produksi_pegawai_id_foreign` (`pegawai_id`);

--
-- Indexes for table `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `supplier_no_telepon_unique` (`no_telepon`),
  ADD UNIQUE KEY `supplier_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bahan_baku`
--
ALTER TABLE `bahan_baku`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=105;
--
-- AUTO_INCREMENT for table `pegawai`
--
ALTER TABLE `pegawai`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT for table `pelanggan`
--
ALTER TABLE `pelanggan`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=104;
--
-- AUTO_INCREMENT for table `pembelian`
--
ALTER TABLE `pembelian`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `pengiriman`
--
ALTER TABLE `pengiriman`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `pesanan`
--
ALTER TABLE `pesanan`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `produk`
--
ALTER TABLE `produk`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `produksi`
--
ALTER TABLE `produksi`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `supplier`
--
ALTER TABLE `supplier`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `bahan_baku`
--
ALTER TABLE `bahan_baku`
  ADD CONSTRAINT `bahan_baku_pegawai_id_foreign` FOREIGN KEY (`pegawai_id`) REFERENCES `pegawai` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `detail_bahan_baku`
--
ALTER TABLE `detail_bahan_baku`
  ADD CONSTRAINT `detail_bahan_baku_bahan_baku_id_foreign` FOREIGN KEY (`bahan_baku_id`) REFERENCES `bahan_baku` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `detail_bahan_baku_supplier_id_foreign` FOREIGN KEY (`supplier_id`) REFERENCES `supplier` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `detail_pembelian`
--
ALTER TABLE `detail_pembelian`
  ADD CONSTRAINT `detail_pembelian_bahan_baku_id_foreign` FOREIGN KEY (`bahan_baku_id`) REFERENCES `bahan_baku` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `detail_pembelian_pembelian_id_foreign` FOREIGN KEY (`pembelian_id`) REFERENCES `pembelian` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `detail_pesanan`
--
ALTER TABLE `detail_pesanan`
  ADD CONSTRAINT `detail_pesanan_pesanan_id_foreign` FOREIGN KEY (`pesanan_id`) REFERENCES `pesanan` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `detail_pesanan_produk_id_foreign` FOREIGN KEY (`produk_id`) REFERENCES `produk` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `detail_produk`
--
ALTER TABLE `detail_produk`
  ADD CONSTRAINT `detail_produk_bahan_baku_id_foreign` FOREIGN KEY (`bahan_baku_id`) REFERENCES `bahan_baku` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `detail_produk_produk_id_foreign` FOREIGN KEY (`produk_id`) REFERENCES `produk` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `pembelian`
--
ALTER TABLE `pembelian`
  ADD CONSTRAINT `pembelian_pegawai_id_foreign` FOREIGN KEY (`pegawai_id`) REFERENCES `pegawai` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `pembelian_supplier_id_foreign` FOREIGN KEY (`supplier_id`) REFERENCES `supplier` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `pengiriman`
--
ALTER TABLE `pengiriman`
  ADD CONSTRAINT `pengiriman_pegawai_id_foreign` FOREIGN KEY (`pegawai_id`) REFERENCES `pegawai` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `pengiriman_produksi_id_foreign` FOREIGN KEY (`produksi_id`) REFERENCES `produksi` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `pesanan`
--
ALTER TABLE `pesanan`
  ADD CONSTRAINT `pesanan_pegawai_id_foreign` FOREIGN KEY (`pegawai_id`) REFERENCES `pegawai` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `pesanan_pelanggan_id_foreign` FOREIGN KEY (`pelanggan_id`) REFERENCES `pelanggan` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `produksi`
--
ALTER TABLE `produksi`
  ADD CONSTRAINT `produksi_pegawai_id_foreign` FOREIGN KEY (`pegawai_id`) REFERENCES `pegawai` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `produksi_pesanan_id_foreign` FOREIGN KEY (`pesanan_id`) REFERENCES `pesanan` (`id`) ON DELETE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
