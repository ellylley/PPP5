-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 21, 2024 at 04:36 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `projek2`
--

-- --------------------------------------------------------

--
-- Table structure for table `activity_log`
--

CREATE TABLE `activity_log` (
  `id` int(11) NOT NULL,
  `id_user` int(11) DEFAULT NULL,
  `activity` text DEFAULT NULL,
  `timestamp` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `activity_log`
--

INSERT INTO `activity_log` (`id`, `id_user`, `activity`, `timestamp`) VALUES
(901, 1, 'Mengakses halaman dashboard', '2024-09-21 00:46:16'),
(902, 1, 'Mengakses halaman profile', '2024-09-21 00:46:35'),
(903, 1, 'mengubah password profile', '2024-09-21 00:47:12'),
(904, 1, 'Mengakses halaman profile', '2024-09-21 00:47:12'),
(905, 1, 'mengubah password profile', '2024-09-21 00:47:21'),
(906, 1, 'Mengakses halaman profile', '2024-09-21 00:47:22'),
(907, 1, 'mengubah password profile', '2024-09-21 00:47:31'),
(908, 1, 'Mengakses halaman profile', '2024-09-21 00:47:31'),
(909, 1, 'Mengakses halaman manajemen user', '2024-09-21 00:47:34'),
(910, 1, 'Menambah user', '2024-09-21 00:48:11'),
(911, 1, 'Mengakses halaman manajemen user', '2024-09-21 00:48:11'),
(912, 1, 'Menambah user', '2024-09-21 00:48:33'),
(913, 1, 'Mengakses halaman manajemen user', '2024-09-21 00:48:33'),
(914, 1, 'Menambah user', '2024-09-21 00:48:51'),
(915, 1, 'Mengakses halaman manajemen user', '2024-09-21 00:48:52'),
(916, 1, 'Mengakses halaman manajemen kelas', '2024-09-21 00:49:11'),
(917, 1, 'Menambah data kelas', '2024-09-21 00:49:30'),
(918, 1, 'Mengakses halaman manajemen kelas', '2024-09-21 00:49:31'),
(919, 1, 'Mengakses halaman manajemen user', '2024-09-21 00:49:32'),
(920, 1, 'Menambah user', '2024-09-21 00:49:55'),
(921, 1, 'Mengakses halaman manajemen user', '2024-09-21 00:49:56'),
(922, 1, 'Mengubah data user', '2024-09-21 00:50:16'),
(923, 1, 'Mengakses halaman manajemen user', '2024-09-21 00:50:17'),
(924, 1, 'Merestore user yang diedit', '2024-09-21 00:50:52'),
(925, 1, 'Mengakses halaman manajemen user', '2024-09-21 00:50:53'),
(926, 1, 'Mengakses halaman manajemen kelas', '2024-09-21 00:50:59'),
(927, 1, 'Mengubah data kelas', '2024-09-21 00:51:12'),
(928, 1, 'Mengakses halaman manajemen kelas', '2024-09-21 00:51:12'),
(929, 1, 'Merestore kelas yang diedit', '2024-09-21 00:51:17'),
(930, 1, 'Mengakses halaman manajemen kelas', '2024-09-21 00:51:18'),
(931, 1, 'Mengakses halaman manajemen tugas', '2024-09-21 00:51:23'),
(932, 1, 'Menambah data tugas', '2024-09-21 00:51:45'),
(933, 1, 'Mengakses halaman manajemen tugas', '2024-09-21 00:51:45'),
(934, 1, 'Mengubah data tugas', '2024-09-21 00:51:54'),
(935, 1, 'Mengakses halaman manajemen tugas', '2024-09-21 00:51:54'),
(936, 1, 'Merestore tugas yang diedit', '2024-09-21 00:51:59'),
(937, 1, 'Mengakses halaman manajemen tugas', '2024-09-21 00:52:00'),
(938, 1, 'Mengakses halaman penilaian', '2024-09-21 00:52:05'),
(939, 1, 'Mengakses halaman laporan penilaian', '2024-09-21 00:52:34'),
(940, 1, 'Mencetak nilai siswa', '2024-09-21 00:53:06'),
(941, 1, 'Mengakses halaman laporan penilaian', '2024-09-21 00:53:10'),
(942, 1, 'Mencetak nilai siswa', '2024-09-21 00:53:14'),
(943, 1, 'Mengakses halaman laporan penilaian', '2024-09-21 00:53:22'),
(944, 1, 'Mencetak nilai siswa', '2024-09-21 00:53:26'),
(945, 1, 'Mengakses halaman setting', '2024-09-21 00:53:38'),
(946, 1, 'Mengubah data setting', '2024-09-21 00:53:57'),
(947, 1, 'Mengakses halaman setting', '2024-09-21 00:53:58'),
(948, 1, 'Mengubah data setting', '2024-09-21 00:54:08'),
(949, 1, 'Mengakses halaman setting', '2024-09-21 00:54:09'),
(950, 1, 'Mengakses halaman log aktivitas', '2024-09-21 00:54:13'),
(951, 1, 'Mengakses halaman restore user', '2024-09-21 00:54:25'),
(952, 1, 'Mengakses halaman manajemen user', '2024-09-21 00:54:30'),
(953, 1, 'Mengakses halaman manajemen tugas', '2024-09-21 00:54:33'),
(954, 1, 'Menghapus data tugas', '2024-09-21 00:54:35'),
(955, 1, 'Mengakses halaman manajemen tugas', '2024-09-21 00:54:35'),
(956, 1, 'Mengakses halaman manajemen tugas', '2024-09-21 00:54:38'),
(957, 1, 'Merestore tugas', '2024-09-21 00:54:40'),
(958, 1, 'Mengakses halaman manajemen tugas', '2024-09-21 00:54:41'),
(959, 1, 'Mengakses halaman manajemen tugas', '2024-09-21 00:54:43'),
(960, 1, 'Mengakses halaman restore user', '2024-09-21 00:54:47'),
(961, 1, 'Mengakses halaman restore kelas', '2024-09-21 00:54:49'),
(962, 21, 'Mengakses halaman dashboard', '2024-09-21 00:55:11'),
(963, 21, 'Mengakses halaman profile', '2024-09-21 00:55:16'),
(964, 21, 'Mengakses halaman dashboard', '2024-09-21 00:55:21'),
(965, 21, 'Mengakses halaman laporan penilaian', '2024-09-21 00:55:26'),
(966, 22, 'Mengakses halaman dashboard', '2024-09-21 00:55:53'),
(967, 22, 'Mengakses halaman laporan penilaian', '2024-09-21 00:55:57'),
(968, 23, 'Mengakses halaman dashboard', '2024-09-21 00:56:19'),
(969, 23, 'Mengakses halaman manajemen tugas', '2024-09-21 00:56:26'),
(970, 23, 'Mengakses halaman penilaian', '2024-09-21 00:56:38'),
(971, 23, 'Mengakses halaman manajemen tugas', '2024-09-21 00:56:41'),
(972, 23, 'Mengakses halaman laporan penilaian', '2024-09-21 00:56:44'),
(973, 23, 'Mengakses halaman penilaian', '2024-09-21 00:56:46'),
(974, 23, 'Mengakses halaman laporan penilaian', '2024-09-21 01:03:56'),
(975, 23, 'Mengakses halaman penilaian', '2024-09-21 01:03:58'),
(976, 23, 'Mengakses halaman laporan penilaian', '2024-09-21 01:04:00'),
(977, 23, 'Mengakses halaman manajemen tugas', '2024-09-21 01:04:01'),
(978, 23, 'Menambah data tugas', '2024-09-21 01:04:12'),
(979, 23, 'Mengakses halaman manajemen tugas', '2024-09-21 01:04:12'),
(980, 23, 'Mengakses halaman penilaian', '2024-09-21 01:04:14'),
(981, 23, 'Mengakses halaman manajemen tugas', '2024-09-21 01:04:17'),
(982, 23, 'Mengakses halaman penilaian', '2024-09-21 01:04:20'),
(983, 23, 'Mengakses halaman manajemen tugas', '2024-09-21 01:04:28'),
(984, 23, 'Mengakses halaman manajemen tugas', '2024-09-21 01:04:28'),
(985, 1, 'Mengakses halaman dashboard', '2024-09-21 01:04:58'),
(986, 1, 'Mengakses halaman manajemen tugas', '2024-09-21 01:05:00'),
(987, 1, 'Mengakses halaman manajemen tugas', '2024-09-21 01:05:22'),
(988, 1, 'Mengakses halaman penilaian', '2024-09-21 01:05:23'),
(989, 23, 'Mengakses halaman dashboard', '2024-09-21 01:05:50'),
(990, 23, 'Mengakses halaman manajemen tugas', '2024-09-21 01:05:52'),
(991, 23, 'Mengakses halaman penilaian', '2024-09-21 01:05:53'),
(992, 23, 'Mengakses halaman manajemen tugas', '2024-09-21 01:05:55'),
(993, 23, 'Mengakses halaman penilaian', '2024-09-21 01:08:24'),
(994, 23, 'Mengakses halaman penilaian', '2024-09-21 01:08:25'),
(995, 23, 'Mengakses halaman penilaian', '2024-09-21 01:08:26'),
(996, 23, 'Mengakses halaman penilaian', '2024-09-21 01:08:26'),
(997, 23, 'Mengakses halaman manajemen tugas', '2024-09-21 01:09:19'),
(998, 23, 'Menambah data tugas', '2024-09-21 01:09:27'),
(999, 23, 'Mengakses halaman manajemen tugas', '2024-09-21 01:09:28'),
(1000, 23, 'Mengakses halaman penilaian', '2024-09-21 01:09:29'),
(1001, 23, 'Mengakses halaman laporan penilaian', '2024-09-21 01:09:52'),
(1002, 1, 'Mengakses halaman dashboard', '2024-09-21 01:14:15'),
(1003, 1, 'Mengakses halaman profile', '2024-09-21 01:14:31'),
(1004, 1, 'mengubah password profile', '2024-09-21 01:15:00'),
(1005, 1, 'Mengakses halaman profile', '2024-09-21 01:15:01'),
(1006, 1, 'mengubah password profile', '2024-09-21 01:15:09'),
(1007, 1, 'Mengakses halaman profile', '2024-09-21 01:15:09'),
(1008, 1, 'mengubah password profile', '2024-09-21 01:15:17'),
(1009, 1, 'Mengakses halaman profile', '2024-09-21 01:15:18'),
(1010, 1, 'Mengakses halaman manajemen user', '2024-09-21 01:15:24'),
(1011, 1, 'Menambah user', '2024-09-21 01:15:48'),
(1012, 1, 'Mengakses halaman manajemen user', '2024-09-21 01:15:48'),
(1013, 1, 'Mengubah data user', '2024-09-21 01:16:04'),
(1014, 1, 'Mengakses halaman manajemen user', '2024-09-21 01:16:05'),
(1015, 1, 'Merestore user yang diedit', '2024-09-21 01:16:50'),
(1016, 1, 'Mengakses halaman manajemen user', '2024-09-21 01:16:51'),
(1017, 1, 'Mengakses halaman manajemen kelas', '2024-09-21 01:16:56'),
(1018, 1, 'Menambah data kelas', '2024-09-21 01:17:07'),
(1019, 1, 'Mengakses halaman manajemen kelas', '2024-09-21 01:17:08'),
(1020, 1, 'Mengakses halaman manajemen tugas', '2024-09-21 01:17:20'),
(1021, 1, 'Menambah data tugas', '2024-09-21 01:17:38'),
(1022, 1, 'Mengakses halaman manajemen tugas', '2024-09-21 01:17:39'),
(1023, 1, 'Mengakses halaman penilaian', '2024-09-21 01:17:51'),
(1024, 1, 'Mengakses halaman laporan penilaian', '2024-09-21 01:18:20'),
(1025, 1, 'Mencetak nilai siswa', '2024-09-21 01:18:42'),
(1026, 1, 'Mengakses halaman laporan penilaian', '2024-09-21 01:18:53'),
(1027, 1, 'Mencetak nilai siswa', '2024-09-21 01:18:59'),
(1028, 1, 'Mengakses halaman laporan penilaian', '2024-09-21 01:19:07'),
(1029, 1, 'Mencetak nilai siswa', '2024-09-21 01:19:14'),
(1030, 1, 'Mengakses halaman setting', '2024-09-21 01:19:30'),
(1031, 1, 'Mengubah data setting', '2024-09-21 01:19:45'),
(1032, 1, 'Mengakses halaman setting', '2024-09-21 01:19:46'),
(1033, 1, 'Mengubah data setting', '2024-09-21 01:19:54'),
(1034, 1, 'Mengakses halaman setting', '2024-09-21 01:19:55'),
(1035, 1, 'Mengakses halaman log aktivitas', '2024-09-21 01:19:57'),
(1036, 1, 'Mengakses halaman manajemen tugas', '2024-09-21 01:20:11'),
(1037, 1, 'Menghapus data tugas', '2024-09-21 01:20:14'),
(1038, 1, 'Mengakses halaman manajemen tugas', '2024-09-21 01:20:15'),
(1039, 1, 'Mengakses halaman manajemen tugas', '2024-09-21 01:20:19'),
(1040, 1, 'Merestore tugas', '2024-09-21 01:20:23'),
(1041, 1, 'Mengakses halaman manajemen tugas', '2024-09-21 01:20:23'),
(1042, 1, 'Mengakses halaman manajemen tugas', '2024-09-21 01:20:25'),
(1043, 1, 'Mengakses halaman restore user', '2024-09-21 01:20:28'),
(1044, 1, 'Mengakses halaman restore kelas', '2024-09-21 01:20:30'),
(1045, 21, 'Mengakses halaman dashboard', '2024-09-21 01:20:54'),
(1046, 21, 'Mengakses halaman laporan penilaian', '2024-09-21 01:21:02'),
(1047, 21, 'Mengakses halaman laporan penilaian', '2024-09-21 01:21:03'),
(1048, 21, 'Mengakses halaman profile', '2024-09-21 01:21:13'),
(1049, 21, 'Mengakses halaman laporan penilaian', '2024-09-21 01:21:15'),
(1050, 22, 'Mengakses halaman dashboard', '2024-09-21 01:21:35'),
(1051, 22, 'Mengakses halaman laporan penilaian', '2024-09-21 01:21:37'),
(1052, 23, 'Mengakses halaman dashboard', '2024-09-21 01:22:01'),
(1053, 23, 'Mengakses halaman manajemen tugas', '2024-09-21 01:22:07'),
(1054, 23, 'Mengakses halaman penilaian', '2024-09-21 01:22:14'),
(1055, 23, 'Mengakses halaman laporan penilaian', '2024-09-21 01:22:20'),
(1056, 23, 'Mengakses halaman manajemen tugas', '2024-09-21 01:22:27'),
(1057, 25, 'Mengakses halaman dashboard', '2024-09-21 01:22:57'),
(1058, 25, 'Mengakses halaman manajemen tugas', '2024-09-21 01:23:01'),
(1059, 25, 'Mengakses halaman laporan penilaian', '2024-09-21 01:23:07'),
(1060, 1, 'Mengakses halaman dashboard', '2024-09-21 01:26:11'),
(1061, 1, 'Mengakses halaman laporan penilaian', '2024-09-21 01:26:14'),
(1062, 1, 'Mengakses halaman penilaian', '2024-09-21 01:26:16'),
(1063, 1, 'Mengakses halaman penilaian', '2024-09-21 01:28:00'),
(1064, 1, 'Mengakses halaman penilaian', '2024-09-21 01:28:46');

-- --------------------------------------------------------

--
-- Table structure for table `backup_kelas`
--

CREATE TABLE `backup_kelas` (
  `id_kelas` int(11) NOT NULL,
  `nama_kelas` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `isdelete` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `backup_tugas`
--

CREATE TABLE `backup_tugas` (
  `id_tugas` int(11) NOT NULL,
  `id_kelas` int(11) DEFAULT NULL,
  `nama_tugas` varchar(255) DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  `id_user` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `isdelete` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `backup_user`
--

CREATE TABLE `backup_user` (
  `id_user` int(11) NOT NULL,
  `nama_user` varchar(50) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL,
  `level` int(11) DEFAULT NULL,
  `id_kelas` int(11) DEFAULT NULL,
  `foto` text DEFAULT NULL,
  `nis` varchar(10) DEFAULT NULL,
  `nisn` varchar(11) DEFAULT NULL,
  `jk` varchar(20) DEFAULT NULL,
  `tgl_lhr` date DEFAULT NULL,
  `isdelete` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `kelas`
--

CREATE TABLE `kelas` (
  `id_kelas` int(11) NOT NULL,
  `nama_kelas` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `isdelete` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kelas`
--

INSERT INTO `kelas` (`id_kelas`, `nama_kelas`, `created_at`, `updated_at`, `deleted_at`, `created_by`, `updated_by`, `deleted_by`, `isdelete`) VALUES
(7, 'RPL XII A', '2024-09-21 07:49:30', NULL, NULL, 1, NULL, NULL, 0),
(8, 'RPL XII B', '2024-09-21 08:17:07', NULL, NULL, 1, NULL, NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `nilai`
--

CREATE TABLE `nilai` (
  `id_nilai` int(11) NOT NULL,
  `id_tugas` int(11) DEFAULT NULL,
  `nilai` int(11) NOT NULL,
  `id_user` int(11) DEFAULT NULL,
  `id_kelas` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `created_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `nilai`
--

INSERT INTO `nilai` (`id_nilai`, `id_tugas`, `nilai`, `id_user`, `id_kelas`, `updated_at`, `updated_by`, `created_at`, `created_by`) VALUES
(32, 12, 80, 25, 7, '2024-09-21 08:18:13', 1, '2024-09-21 08:18:13', 1);

-- --------------------------------------------------------

--
-- Table structure for table `setting`
--

CREATE TABLE `setting` (
  `id_setting` int(11) NOT NULL,
  `nama_setting` varchar(50) DEFAULT NULL,
  `logo` text DEFAULT NULL,
  `alamat` varchar(255) DEFAULT NULL,
  `nama_sekolah` text NOT NULL,
  `nohp` varchar(20) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `setting`
--

INSERT INTO `setting` (`id_setting`, `nama_setting`, `logo`, `alamat`, `nama_sekolah`, `nohp`, `updated_by`, `updated_at`) VALUES
(1, 'PENUGASAN DAN PENILAIAN MODUL ', 'logo_sph.png', 'Komp.Batu Batam Mas, Jl. Gajah Mada Blok D & E No.1,2,3, Baloi Indah, Kec. Lubuk Baja, Kota Batam, K', 'SEKOLAH PERMATA HARAPAN', '(0778) 431318', 1, '2024-09-21 08:19:54');

-- --------------------------------------------------------

--
-- Table structure for table `tugas`
--

CREATE TABLE `tugas` (
  `id_tugas` int(11) NOT NULL,
  `id_kelas` int(11) DEFAULT NULL,
  `nama_tugas` varchar(255) DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  `id_user` int(11) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `isdelete` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tugas`
--

INSERT INTO `tugas` (`id_tugas`, `id_kelas`, `nama_tugas`, `tanggal`, `id_user`, `created_at`, `updated_at`, `deleted_at`, `created_by`, `updated_by`, `deleted_by`, `isdelete`) VALUES
(12, 7, 'mengerjakan kuis di elearning', '2024-09-21', 1, '2024-09-21 08:17:38', NULL, NULL, 1, NULL, NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `nama_user` varchar(50) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL,
  `level` int(11) DEFAULT NULL,
  `id_kelas` int(11) NOT NULL,
  `foto` text DEFAULT NULL,
  `nis` varchar(10) DEFAULT NULL,
  `nisn` varchar(10) DEFAULT NULL,
  `tgl_lhr` date DEFAULT NULL,
  `jk` varchar(20) DEFAULT NULL,
  `isdelete` int(11) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `nama_user`, `password`, `level`, `id_kelas`, `foto`, `nis`, `nisn`, `tgl_lhr`, `jk`, `isdelete`, `created_at`, `updated_at`, `deleted_at`, `created_by`, `updated_by`, `deleted_by`) VALUES
(1, 'admin', 'c4ca4238a0b923820dcc509a6f75849b', 1, 0, '1726837837_6bc630761d891aea23f5.jpg', NULL, NULL, NULL, NULL, 0, NULL, '2024-09-21 08:15:17', NULL, NULL, 1, NULL),
(21, 'kepsek', 'c4ca4238a0b923820dcc509a6f75849b', 2, 0, 'default.jpg', '123', '123', '2024-09-21', 'Laki-laki', 0, '2024-09-21 07:48:11', NULL, NULL, 1, NULL, NULL),
(22, 'wakepsek', 'c4ca4238a0b923820dcc509a6f75849b', 3, 0, 'default.jpg', '234', '234', '2024-09-21', 'Perempuan', 0, '2024-09-21 07:48:33', NULL, NULL, 1, NULL, NULL),
(23, 'guru', 'c4ca4238a0b923820dcc509a6f75849b', 4, 0, 'default.jpg', '345', '345', '2024-09-21', 'Perempuan', 0, '2024-09-21 07:48:52', NULL, NULL, 1, NULL, NULL),
(25, 'siswa', 'c4ca4238a0b923820dcc509a6f75849b', 5, 7, 'default.jpg', '678', '678', '2024-09-21', 'Laki-laki', 0, '2024-09-21 08:15:48', NULL, NULL, 1, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activity_log`
--
ALTER TABLE `activity_log`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `backup_kelas`
--
ALTER TABLE `backup_kelas`
  ADD PRIMARY KEY (`id_kelas`);

--
-- Indexes for table `backup_tugas`
--
ALTER TABLE `backup_tugas`
  ADD PRIMARY KEY (`id_tugas`);

--
-- Indexes for table `backup_user`
--
ALTER TABLE `backup_user`
  ADD PRIMARY KEY (`id_user`);

--
-- Indexes for table `kelas`
--
ALTER TABLE `kelas`
  ADD PRIMARY KEY (`id_kelas`);

--
-- Indexes for table `nilai`
--
ALTER TABLE `nilai`
  ADD PRIMARY KEY (`id_nilai`);

--
-- Indexes for table `setting`
--
ALTER TABLE `setting`
  ADD PRIMARY KEY (`id_setting`);

--
-- Indexes for table `tugas`
--
ALTER TABLE `tugas`
  ADD PRIMARY KEY (`id_tugas`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `activity_log`
--
ALTER TABLE `activity_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1065;

--
-- AUTO_INCREMENT for table `backup_kelas`
--
ALTER TABLE `backup_kelas`
  MODIFY `id_kelas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `backup_tugas`
--
ALTER TABLE `backup_tugas`
  MODIFY `id_tugas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `backup_user`
--
ALTER TABLE `backup_user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `kelas`
--
ALTER TABLE `kelas`
  MODIFY `id_kelas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `nilai`
--
ALTER TABLE `nilai`
  MODIFY `id_nilai` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `setting`
--
ALTER TABLE `setting`
  MODIFY `id_setting` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tugas`
--
ALTER TABLE `tugas`
  MODIFY `id_tugas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
