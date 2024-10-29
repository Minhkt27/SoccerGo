-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th6 22, 2024 lúc 05:13 AM
-- Phiên bản máy phục vụ: 10.4.32-MariaDB
-- Phiên bản PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `quan_ly_san_bong`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `bank_information`
--

CREATE TABLE `bank_information` (
  `id` bigint(20) NOT NULL,
  `name` varchar(255) NOT NULL,
  `bank_number` varchar(255) NOT NULL,
  `note` varchar(255) DEFAULT NULL,
  `image` varchar(255) NOT NULL,
  `isShow` tinyint(4) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `bank_information`
--

INSERT INTO `bank_information` (`id`, `name`, `bank_number`, `note`, `image`, `isShow`, `created_at`, `updated_at`) VALUES
(1, 'Vietcombank', '123456789', NULL, 'https://www.inlogo.vn/vnt_upload/File/Image/logo_VCB_828891.jpg', NULL, '2024-06-13 13:41:38', NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `discounts`
--

CREATE TABLE `discounts` (
  `code` varchar(100) NOT NULL,
  `amount` decimal(2,0) NOT NULL,
  `usage_limit` int(11) NOT NULL,
  `create_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `update_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ;

--
-- Đang đổ dữ liệu cho bảng `discounts`
--

INSERT INTO `discounts` (`code`, `amount`, `usage_limit`, `create_at`, `update_at`) VALUES
('Nhom5_Php', 20, 100000, '2024-06-13 13:32:45', NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `football_pitches`
--

CREATE TABLE `football_pitches` (
  `id` bigint(20) NOT NULL,
  `name` varchar(255) NOT NULL,
  `time_start` time NOT NULL,
  `time_end` time NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `price_per_hour` int(11) NOT NULL,
  `price_per_peak_hour` int(11) NOT NULL,
  `is_maintenance` tinyint(1) NOT NULL DEFAULT 0,
  `pitch_type_id` bigint(20) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ;

--
-- Đang đổ dữ liệu cho bảng `football_pitches`
--

INSERT INTO `football_pitches` (`id`, `name`, `time_start`, `time_end`, `description`, `price_per_hour`, `price_per_peak_hour`, `is_maintenance`, `pitch_type_id`, `created_at`, `updated_at`) VALUES
(1, 'Sân bóng Lai Xá', '06:00:00', '23:59:59', 'Sân đông to đạt tiêu chuẩn, vui tấp nập đủ mọi tiện nghi cho một trận đấu lý thú!\r\nNằm ở Thôn Lai Xá, Hoài Đức, Hà Nội, Việt Nam\r\nSố điện thoại sân: 0913811987\r\n', 500000, 1000000, 0, 3, '2024-06-13 13:52:26', NULL),
(2, 'Sân bóng Thành Đô', '07:00:00', '22:30:00', 'View đẹp.\r\nĐức Giang, Hoài Đức, Hà Nội, Việt Nam', 500000, 700000, 0, 2, '2024-06-13 14:04:47', NULL),
(3, 'Sân Bóng Minh Khai', '06:00:00', '22:00:00', 'Ngõ 136 đường Cầu Diễn Minh Khai Quận, Bắc Từ Liêm, Hà Nội, Việt Nam', 400000, 700000, 0, 3, '2024-06-13 14:13:27', '2024-06-19 15:41:05'),
(4, 'Sân bóng Nguyên Xá', '07:00:00', '20:00:00', 'Sân bóng mới xây dựng, có cỏ nhân tạo thích hợp để đá bóng chuyên nghiệp\r\n', 300000, 600000, 2, 3, '2024-06-19 16:00:36', NULL),
(5, 'Sân bóng Mai Dịch', '07:00:00', '20:00:00', 'Sân được lựa chọn cho nhiều cầu thủ nổi tiếng luyện tập.\r\n', 500000, 800000, 2, 4, '2024-06-20 16:00:56', NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `football_pitch_details`
--

CREATE TABLE `football_pitch_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `football_pitch_id` bigint(20) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `football_pitch_details`
--

INSERT INTO `football_pitch_details` (`id`, `image`, `football_pitch_id`, `created_at`, `updated_at`) VALUES
(1, 'https://lh5.googleusercontent.com/p/AF1QipMglJoaQ6K2f8O6wQtI2_2WR5jTkB7ebtG-BUdt=s644-k-no', 1, '2024-06-13 13:54:19', '2024-06-13 13:58:57'),
(2, 'https://lh5.googleusercontent.com/p/AF1QipOMAoghgMkSnPXHtuFmqvJT1y4mBwZQLtMBlGjq=s563-k-no', 1, '2024-06-13 13:59:52', NULL),
(3, 'https://lh5.googleusercontent.com/p/AF1QipMR1SJyHoFv4Nb5-Drz-S6HI6QtHuoy9sV1zN32=s563-k-no', 1, '2024-06-13 14:00:50', NULL),
(4, 'https://lh5.googleusercontent.com/p/AF1QipNnVBIoYVDMo7e_CwJeKM8gtcVkw7YCEUlmP_tf=s846-k-no', 1, '2024-06-13 14:01:43', NULL),
(5, 'https://lh5.googleusercontent.com/p/AF1QipMNkQIJV2Plps_uVHiN8prUypPYEcahVEfPH3eD=s483-k-no', 2, '2024-06-13 14:09:40', NULL),
(6, 'https://lh5.googleusercontent.com/p/AF1QipMN9w4UZqtVUtPWioyHGnW8dk71WfEdjZxHpKrE=w375-h281-p-k-no', 2, '2024-06-13 14:10:08', NULL),
(7, 'https://lh5.googleusercontent.com/p/AF1QipNHn8-iYXDpJTFUKgNVqJ_v2kEtnOlGfo5OJUnN=w529-h298-k-no', 2, '2024-06-13 14:10:37', NULL),
(8, 'https://lh5.googleusercontent.com/p/AF1QipOTsm3OaOSLM08ZMiJQbGOcTw4l3KMrTMaqdQ3m=s483-k-no', 2, '2024-06-13 14:10:55', NULL),
(9, 'https://lh5.googleusercontent.com/p/AF1QipP0521G3NGNPqqwR260LK8_RyeyfgHK6BCrBtYw=w375-h281-p-k-no', 2, '2024-06-13 14:11:11', NULL),
(10, 'https://lh5.googleusercontent.com/p/AF1QipPLeMjOybX7B2ParzKIhDmWDm0aSZeD8SDzHQCa=s644-k-no', 3, '2024-06-13 14:14:45', NULL),
(11, 'https://lh5.googleusercontent.com/p/AF1QipPc4nIOnhVb5YmPyoBg_O5ShWVSdctg1YuBzVc=s563-k-no', 3, '2024-06-13 14:15:33', NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `identity_papers`
--

CREATE TABLE `identity_papers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `image` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `phone` varchar(12) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `deposit` double UNSIGNED NOT NULL,
  `code` varchar(20) NOT NULL,
  `start_at` datetime NOT NULL,
  `end_at` datetime NOT NULL,
  `total` double UNSIGNED NOT NULL,
  `status` tinyint(1) UNSIGNED NOT NULL DEFAULT 1,
  `note` text DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `football_pitch_id` bigint(20) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `orders`
--

INSERT INTO `orders` (`id`, `name`, `phone`, `email`, `deposit`, `code`, `start_at`, `end_at`, `total`, `status`, `note`, `user_id`, `football_pitch_id`, `created_at`, `updated_at`) VALUES
(1, 'Hà Xuân Phúc\r\n', '0965423986', 'haxuanphuc56@gmail.com', 300000, 'Nhom5_Php', '2024-06-19 08:00:00', '2024-06-19 11:00:00', 500000, 1, 'Đặt thêm thùng nước ngọt\r\n', 2, 2, '2024-06-19 16:09:33', NULL),
(2, 'Nguyễn Văn Quyết\r\n', '0965469875', 'NguyenVanQuyet56@gmail.com', 400000, 'Nhom5_Php', '2024-06-19 08:00:00', '2024-06-19 11:00:00', 500000, 1, 'Đặt thêm thùng nước ngọt\r\n', 1, 4, '2024-06-19 16:09:37', NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `peak_hours`
--

CREATE TABLE `peak_hours` (
  `id` bigint(20) NOT NULL,
  `start_at` time NOT NULL,
  `end_at` time NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `peak_hours`
--

INSERT INTO `peak_hours` (`id`, `start_at`, `end_at`, `created_at`, `updated_at`) VALUES
(1, '17:00:00', '20:00:00', '2024-06-13 12:18:33', NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `pitch_types`
--

CREATE TABLE `pitch_types` (
  `id` bigint(20) NOT NULL,
  `quantity` tinyint(4) NOT NULL,
  `description` varchar(250) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ;

--
-- Đang đổ dữ liệu cho bảng `pitch_types`
--

INSERT INTO `pitch_types` (`id`, `quantity`, `description`, `created_at`, `updated_at`) VALUES
(1, 11, 'Sân 11\r\nKích thước sân: Chiều dài từ 100-110 mét, chiều rộng từ 64-75 mét.\r\nSố lượng người chơi: 11 người mỗi đội.\r\nMục đích sử dụng: Dành cho các trận đấu chính thức và các giải đấu lớn.', '2024-06-13 12:12:06', NULL),
(2, 7, 'Sân 7\r\nKích thước sân: Chiều dài từ 50-70m, chiều rộng từ 30-50m.\r\nSố lượng người chơi: 7 người mỗi đội.\r\nMục đích sử dụng: Thường được sử dụng cho các giải trẻ, các trận đấu không chuyên hoặc giải đấu nhỏ.', '2024-06-13 12:13:12', NULL),
(3, 5, 'Sân 5\r\nKích thước sân: Chiều dài từ 25-42m, chiều rộng từ 16-25m.\r\nSố lượng người chơi: 5 người mỗi đội.\r\nMục đích sử dụng: Chủ yếu được sử dụng cho futsal, một biến thể của bóng đá chơi trong nhà hoặc trên sân nhỏ.', '2024-06-13 12:14:32', NULL),
(4, 9, 'Kích thước sân: Chiều dài từ 70-80m, chiều rộng từ 45-55m.\r\nSố lượng người chơi: 9 người mỗi đội.\r\nMục đích sử dụng: Phù hợp với các giải đấu trẻ hoặc không chính thức.', '2024-06-13 12:15:22', NULL),
(5, 8, 'Kích thước sân: Chiều dài từ 50-70m, chiều rộng từ 30-50m.\r\nSố lượng người chơi: 8 người mỗi đội.\r\nMục đích sử dụng: Thường dành cho các giải đấu không chính thức, tập luyện', '2024-06-13 12:16:49', NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `phone` varchar(10) DEFAULT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(264) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `type` bigint(20) NOT NULL DEFAULT 2,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`id`, `name`, `phone`, `email`, `password`, `address`, `type`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Đức Minh Hoàng', '0964203955', 'dmh@gmail.com', '8ddcff3a80f4189ca1c9d4d902c3c909', 'Hải Phòng', 1, NULL, '2024-06-13 14:19:09', '2024-06-21 15:40:09'),
(2, 'Hà Xuân Phúc', '0964203698', 'sinhvien2k3@gmail.com', '8ddcff3a80f4189ca1c9d4d902c3c909', 'Ngõ 1, đường Hoàng Hoa thám, Hà Nội', 2, NULL, '2024-06-13 14:20:19', '2024-06-21 15:17:18'),
(3, 'Lam Tiểu Bố', '0965469875', 'lamca@gmail.com', '8ddcff3a80f4189ca1c9d4d902c3c909', 'Quảng Ninh', 1, NULL, '2024-06-21 16:40:32', NULL),
(5, 'Lăng Lạc Thần', '0986523687', 'thantientyty@gmail.com', '8ddcff3a80f4189ca1c9d4d902c3c909', 'Tuyên Quang', 1, NULL, '2024-06-21 16:49:16', NULL),
(6, 'Chú Thỏ Con', '0896523678', 'thocon@gmail.com', '8ddcff3a80f4189ca1c9d4d902c3c909', 'TP HCM', 1, NULL, '2024-06-21 16:49:16', '2024-06-21 17:55:12'),
(7, 'Hỏa Linh Nhi', '0964528975', 'linhnhi@gmail.com', NULL, 'Yên Bái', 2, NULL, '2024-06-21 19:34:41', NULL),
(9, 'Icegozi', '0965236978', 'icegozi@gmail.com', NULL, 'Nghệ An', 1, NULL, '2024-06-21 19:37:53', NULL),
(10, 'Mã Hồng Tuấn', '0968756932', 'tuaandeptrai@gmail.com', NULL, 'Quảng Ninh', 2, NULL, '2024-06-21 20:05:34', NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `user_types`
--

CREATE TABLE `user_types` (
  `id` bigint(20) NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `user_types`
--

INSERT INTO `user_types` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Admin', '2024-06-13 03:58:05', NULL),
(2, 'Customer', '2024-06-13 03:58:32', NULL),
(3, 'Guest', '2024-06-13 04:03:19', NULL);

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `bank_information`
--
ALTER TABLE `bank_information`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `discounts`
--
ALTER TABLE `discounts`
  ADD PRIMARY KEY (`code`);

--
-- Chỉ mục cho bảng `football_pitches`
--
ALTER TABLE `football_pitches`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pitch_type_id` (`pitch_type_id`);

--
-- Chỉ mục cho bảng `football_pitch_details`
--
ALTER TABLE `football_pitch_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `football_pitch_id` (`football_pitch_id`);

--
-- Chỉ mục cho bảng `identity_papers`
--
ALTER TABLE `identity_papers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Chỉ mục cho bảng `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `football_pitch_id` (`football_pitch_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `code` (`code`);

--
-- Chỉ mục cho bảng `peak_hours`
--
ALTER TABLE `peak_hours`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `pitch_types`
--
ALTER TABLE `pitch_types`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `provider_id` (`type`);

--
-- Chỉ mục cho bảng `user_types`
--
ALTER TABLE `user_types`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `bank_information`
--
ALTER TABLE `bank_information`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `football_pitches`
--
ALTER TABLE `football_pitches`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `football_pitch_details`
--
ALTER TABLE `football_pitch_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT cho bảng `identity_papers`
--
ALTER TABLE `identity_papers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `peak_hours`
--
ALTER TABLE `peak_hours`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `pitch_types`
--
ALTER TABLE `pitch_types`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT cho bảng `user_types`
--
ALTER TABLE `user_types`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `football_pitches`
--
ALTER TABLE `football_pitches`
  ADD CONSTRAINT `football_pitches_ibfk_2` FOREIGN KEY (`pitch_type_id`) REFERENCES `pitch_types` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `football_pitch_details`
--
ALTER TABLE `football_pitch_details`
  ADD CONSTRAINT `football_pitch_details_ibfk_1` FOREIGN KEY (`football_pitch_id`) REFERENCES `football_pitches` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `identity_papers`
--
ALTER TABLE `identity_papers`
  ADD CONSTRAINT `identity_papers_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`football_pitch_id`) REFERENCES `football_pitches` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `orders_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `orders_ibfk_3` FOREIGN KEY (`code`) REFERENCES `discounts` (`code`);

--
-- Các ràng buộc cho bảng `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`type`) REFERENCES `user_types` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
