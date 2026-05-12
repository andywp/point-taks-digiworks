-- phpMyAdmin SQL Dump
-- version 6.0.0-dev+20260506.e691cde550
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 07, 2026 at 06:59 AM
-- Server version: 8.4.3
-- PHP Version: 8.3.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

--
-- Database: `kerja`
--

--
-- Dumping data for table `master_tasks`
--

INSERT INTO `master_tasks` (`id`, `pekerjaan`, `point_type`, `per_hari`, `per_bulan`, `menit_per_output`, `point_per_10`, `created_at`, `updated_at`) VALUES
(1, '(JANGAN DIPAKAI) Motion/Video Materi Iklan', 0, 6, 0, 70, 7.0, '2026-05-07 06:57:11', '2026-05-07 06:57:11'),
(2, '(JANGAN DIPAKAI) Image Materi Iklan', 0, 7, 0, 60, 6.0, '2026-05-07 06:57:11', '2026-05-07 06:57:11'),
(3, '(JANGAN DIPAKAI) Content Plan + Caption (Mingguan) - AI Develop', 0, 7, 0, 60, 6.0, '2026-05-07 06:57:11', '2026-05-07 06:57:11'),
(4, '(JANGAN DIPAKAI) Materi Feed Per Slide - AI Develop', 0, 39, 0, 11, 1.1, '2026-05-07 06:57:11', '2026-05-07 06:57:11'),
(5, '(JANGAN DIPAKAI) Reels - AI Develop', 0, 3, 0, 140, 14.0, '2026-05-07 06:57:11', '2026-05-07 06:57:11'),
(6, '(JANGAN DIPAKAI) IGS (Image) - AI Develop', 0, 16, 0, 26, 2.6, '2026-05-07 06:57:11', '2026-05-07 06:57:11'),
(7, '(JANGAN DIPAKAI) Schedulling', 0, 42, 0, 10, 1.0, '2026-05-07 06:57:11', '2026-05-07 06:57:11'),
(8, '(JANGAN DIPAKAI) Banner MP/Diglink', 0, 14, 0, 30, 3.0, '2026-05-07 06:57:11', '2026-05-07 06:57:11'),
(9, '(JANGAN DIPAKAI) Cover Katalog - AI Develop', 0, 14, 0, 30, 3.0, '2026-05-07 06:57:11', '2026-05-07 06:57:11'),
(10, '(JANGAN DIPAKAI) Foto Katalog + Edit (Include Slide)', 0, 7, 0, 60, 6.0, '2026-05-07 06:57:11', '2026-05-07 06:57:11'),
(11, '(JANGAN DIPAKAI) Video Review + Edit', 0, 4, 0, 105, 10.5, '2026-05-07 06:57:11', '2026-05-07 06:57:11'),
(12, '(JANGAN DIPAKAI) Website Design', 1, 0, 5, 2088, 208.8, '2026-05-07 06:57:11', '2026-05-07 06:57:11'),
(13, '(JANGAN DIPAKAI) Proposal Design', 1, 0, 5, 2088, 208.8, '2026-05-07 06:57:11', '2026-05-07 06:57:11'),
(14, '(JANGAN DIPAKAI) Visual Identity (Logo,Woven, Hangtag, Plastik Pengiriman)', 0, 1, 0, 420, 42.0, '2026-05-07 06:57:11', '2026-05-07 06:57:11'),
(15, '(JANGAN DIPAKAI) Grafis Kaos', 0, 1, 0, 420, 42.0, '2026-05-07 06:57:11', '2026-05-07 06:57:11'),
(16, '(JANGAN DIPAKAI) Editing Foto Ghost Manekin - AI Develop', 0, 10, 0, 42, 4.2, '2026-05-07 06:57:11', '2026-05-07 06:57:11'),
(17, '(JANGAN DIPAKAI) Editing Warna - AI Develop', 0, 15, 0, 28, 2.8, '2026-05-07 06:57:11', '2026-05-07 06:57:11'),
(18, '(JANGAN DIPAKAI) Mirroring Konten', 0, 84, 0, 5, 0.5, '2026-05-07 06:57:11', '2026-05-07 06:57:11'),
(19, '(JANGAN DIPAKAI) Tracing Logo', 0, 15, 0, 28, 2.8, '2026-05-07 06:57:11', '2026-05-07 06:57:11'),
(20, 'Materi Iklan Motion/Video (1:1) - Reg/CPAS', 0, 5, 0, 84, 8.4, '2026-05-07 06:57:11', '2026-05-07 06:57:11'),
(21, 'Materi Iklan Motion/Video (9:16) - Reg', 0, 6, 0, 70, 7.0, '2026-05-07 06:57:11', '2026-05-07 06:57:11'),
(22, 'Materi Iklan Image (1:1) - Reg/CPAS', 0, 8, 0, 53, 5.3, '2026-05-07 06:57:11', '2026-05-07 06:57:11'),
(23, 'Materi Iklan Image (9:16) - Reg', 0, 7, 0, 60, 6.0, '2026-05-07 06:57:11', '2026-05-07 06:57:11'),
(24, 'Content Plan & Caption per-week (AI/AppDigoworks)', 0, 21, 0, 20, 2.0, '2026-05-07 06:57:11', '2026-05-07 06:57:11'),
(25, 'Feed IG Image perSlide', 0, 40, 0, 11, 1.1, '2026-05-07 06:57:11', '2026-05-07 06:57:11'),
(26, 'Reels IG Motion/Video (17-60 detik)', 0, 4, 0, 105, 10.5, '2026-05-07 06:57:11', '2026-05-07 06:57:11'),
(27, 'Story IG Image', 0, 16, 0, 26, 2.6, '2026-05-07 06:57:11', '2026-05-07 06:57:11'),
(28, 'Story IG Motion/Video (10-20 detik)', 0, 8, 0, 53, 5.3, '2026-05-07 06:57:11', '2026-05-07 06:57:11'),
(29, 'Schedulling Post IG (Feed - Story - Reels)', 0, 42, 0, 10, 1.0, '2026-05-07 06:57:11', '2026-05-07 06:57:11'),
(30, 'Banner Image Marketplace', 0, 14, 0, 30, 3.0, '2026-05-07 06:57:11', '2026-05-07 06:57:11'),
(31, 'Banner Motion/Video Marketplace', 0, 4, 0, 105, 10.5, '2026-05-07 06:57:11', '2026-05-07 06:57:11'),
(32, 'Banner Image Diglink', 0, 14, 0, 30, 3.0, '2026-05-07 06:57:11', '2026-05-07 06:57:11'),
(33, 'Banner Motion/Video Diglink', 0, 4, 0, 105, 10.5, '2026-05-07 06:57:11', '2026-05-07 06:57:11'),
(34, 'Desain Cover Katalog Marketplace (1:1)', 0, 14, 0, 30, 3.0, '2026-05-07 06:57:11', '2026-05-07 06:57:11'),
(35, 'Motion/Video Slide katalog Marketplace (1:1) 10-20 detik', 0, 8, 0, 53, 5.3, '2026-05-07 06:57:11', '2026-05-07 06:57:11'),
(36, 'Desain Cover Live Image (1:1)', 0, 14, 0, 30, 3.0, '2026-05-07 06:57:11', '2026-05-07 06:57:11'),
(37, 'Desain Cover Live Image (9:16)', 0, 14, 0, 30, 3.0, '2026-05-07 06:57:11', '2026-05-07 06:57:11'),
(38, 'Desain Announcement Live Image (9:16)', 0, 14, 0, 30, 3.0, '2026-05-07 06:57:11', '2026-05-07 06:57:11'),
(39, 'Photo Produk Flatlay (Katalog Marketplace)', 0, 25, 0, 17, 1.7, '2026-05-07 06:57:11', '2026-05-07 06:57:11'),
(40, 'Photo Produk untuk Dataset AI', 0, 60, 0, 7, 0.7, '2026-05-07 06:57:11', '2026-05-07 06:57:11'),
(41, 'Photo Editing', 0, 21, 0, 20, 2.0, '2026-05-07 06:57:11', '2026-05-07 06:57:11'),
(42, 'Photo Generated Aset AI', 0, 504, 0, 1, 0.1, '2026-05-07 06:57:11', '2026-05-07 06:57:11'),
(43, 'Video Review Produk', 0, 4, 0, 105, 10.5, '2026-05-07 06:57:11', '2026-05-07 06:57:11'),
(44, 'Desain Website', 0, 1, 0, 420, 42.0, '2026-05-07 06:57:11', '2026-05-07 06:57:11'),
(45, 'Desain Landing Page', 0, 2, 0, 210, 21.0, '2026-05-07 06:57:11', '2026-05-07 06:57:11'),
(46, 'Desain Proposal', 0, 1, 0, 420, 42.0, '2026-05-07 06:57:11', '2026-05-07 06:57:11'),
(47, 'Desain Logo', 0, 7, 0, 60, 6.0, '2026-05-07 06:57:11', '2026-05-07 06:57:11'),
(48, 'Desain Label Woven', 0, 21, 0, 20, 2.0, '2026-05-07 06:57:11', '2026-05-07 06:57:11'),
(49, 'Desain Label Hangtag', 0, 21, 0, 20, 2.0, '2026-05-07 06:57:11', '2026-05-07 06:57:11'),
(50, 'Desain Label Stiker', 0, 7, 0, 60, 6.0, '2026-05-07 06:57:11', '2026-05-07 06:57:11'),
(51, 'Desain Packaging Box', 0, 4, 0, 105, 10.5, '2026-05-07 06:57:11', '2026-05-07 06:57:11'),
(52, 'Desain Mockup Produk', 0, 14, 0, 30, 3.0, '2026-05-07 06:57:11', '2026-05-07 06:57:11'),
(53, 'Desain Grafis Kaos', 0, 5, 0, 84, 8.4, '2026-05-07 06:57:11', '2026-05-07 06:57:11'),
(54, 'Mirroring Konten', 0, 84, 0, 5, 0.5, '2026-05-07 06:57:11', '2026-05-07 06:57:11'),
(55, 'Tracing Logo', 0, 15, 0, 28, 2.8, '2026-05-07 06:57:11', '2026-05-07 06:57:11');
COMMIT;
