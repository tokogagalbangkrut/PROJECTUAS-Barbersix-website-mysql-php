-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 25 Jul 2026 pada 06.42
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `barbershop`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `appointments`
--

CREATE TABLE `appointments` (
  `appointment_id` int(5) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `client_id` int(5) NOT NULL,
  `employee_id` int(2) NOT NULL,
  `start_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `end_time_expected` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `canceled` tinyint(1) NOT NULL DEFAULT 0,
  `cancellation_reason` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data untuk tabel `appointments`
--

INSERT INTO `appointments` (`appointment_id`, `date_created`, `client_id`, `employee_id`, `start_time`, `end_time_expected`, `canceled`, `cancellation_reason`) VALUES
(12, '2024-02-04 00:04:00', 13, 3, '2024-02-12 09:30:00', '2024-02-12 10:00:00', 0, NULL),
(13, '2026-07-17 05:18:00', 14, 1, '2026-07-18 04:00:00', '2026-07-18 04:20:00', 0, NULL),
(14, '2026-07-17 06:44:00', 15, 2, '2026-07-18 13:45:00', '2026-07-18 14:00:00', 0, NULL),
(15, '2026-07-17 06:46:00', 16, 1, '2026-07-18 04:30:00', '2026-07-18 04:45:00', 0, NULL),
(16, '2026-07-17 06:46:00', 17, 1, '2026-07-18 05:00:00', '2026-07-18 05:10:00', 0, NULL),
(17, '2026-07-22 22:19:00', 14, 1, '2026-07-24 04:00:00', '2026-07-24 04:20:00', 1, 'tutup'),
(18, '2026-07-22 22:25:00', 14, 1, '2026-08-02 13:45:00', '2026-08-02 14:00:00', 0, NULL),
(19, '2026-07-23 21:47:00', 14, 3, '2026-08-03 04:15:00', '2026-08-03 04:30:00', 0, NULL),
(20, '2026-07-23 22:02:00', 14, 1, '2026-07-25 04:00:00', '2026-07-25 04:35:00', 0, NULL),
(21, '2026-07-24 04:49:00', 14, 2, '2026-08-03 13:30:00', '2026-08-03 13:50:00', 0, NULL),
(22, '2026-07-24 23:00:00', 14, 1, '2026-08-04 13:45:00', '2026-08-04 14:00:00', 0, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `barber_admin`
--

CREATE TABLE `barber_admin` (
  `admin_id` int(5) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `full_name` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data untuk tabel `barber_admin`
--

INSERT INTO `barber_admin` (`admin_id`, `username`, `email`, `full_name`, `password`) VALUES
(1, 'admin', 'admin.admin@gmail.com', 'Admin Admin', 'f7c3bc1d808e04732adf679965ccc34ca7ae3441');

-- --------------------------------------------------------

--
-- Struktur dari tabel `clients`
--

CREATE TABLE `clients` (
  `client_id` int(5) NOT NULL,
  `first_name` varchar(30) NOT NULL,
  `last_name` varchar(30) NOT NULL,
  `phone_number` varchar(30) NOT NULL,
  `client_email` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data untuk tabel `clients`
--

INSERT INTO `clients` (`client_id`, `first_name`, `last_name`, `phone_number`, `client_email`) VALUES
(1, 'Dennis', 'S Embry', '651-779-6791', 'dennis_embry@gmail.com'),
(2, 'Bonnie', 'A Rivera', '714-327-5825', 'bonnie_rivera@yahoo.fr'),
(13, 'Driss', 'Jabiri', '0789342481', 'driss.jabiri@gmail.com'),
(14, 'Bima', 'Putra', '0858591332', 'mrbimax77@gmail.com'),
(15, 'sempak', 'Putra', '0858591339', 'unkn@gmail.com'),
(16, 'ganteng', 'Putra', '0858591399', 'mrmax77@gmail.com'),
(17, 'jelek', 'Putra', '0858591377', 'mrbix77@gmail.com');

-- --------------------------------------------------------

--
-- Struktur dari tabel `employees`
--

CREATE TABLE `employees` (
  `employee_id` int(2) NOT NULL,
  `first_name` varchar(20) NOT NULL,
  `last_name` varchar(20) NOT NULL,
  `phone_number` varchar(30) NOT NULL,
  `email` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data untuk tabel `employees`
--

INSERT INTO `employees` (`employee_id`, `first_name`, `last_name`, `phone_number`, `email`) VALUES
(1, 'Mas', 'Amba', '000555111', 'masambangawi@gmail.com'),
(2, 'Rusdi', 'Ngawi', '01920001', 'RusdiNgawi@gmail.com'),
(3, 'Pak', 'Hambali', '049504952', 'pudingcoklatpakhambali@gmail.com');

-- --------------------------------------------------------

--
-- Struktur dari tabel `employees_schedule`
--

CREATE TABLE `employees_schedule` (
  `id` int(5) NOT NULL,
  `employee_id` int(2) NOT NULL,
  `day_id` tinyint(1) NOT NULL,
  `from_hour` time NOT NULL,
  `to_hour` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data untuk tabel `employees_schedule`
--

INSERT INTO `employees_schedule` (`id`, `employee_id`, `day_id`, `from_hour`, `to_hour`) VALUES
(67, 2, 0, '11:00:00', '21:00:00'),
(68, 2, 1, '11:00:00', '21:00:00'),
(69, 2, 2, '11:00:00', '21:00:00'),
(70, 2, 3, '11:00:00', '21:00:00'),
(71, 2, 4, '11:00:00', '21:00:00'),
(72, 2, 5, '11:00:00', '21:00:00'),
(73, 2, 6, '11:00:00', '21:00:00'),
(74, 3, 0, '11:00:00', '21:00:00'),
(75, 3, 1, '11:00:00', '21:00:00'),
(76, 3, 2, '11:00:00', '21:00:00'),
(77, 3, 3, '11:00:00', '21:00:00'),
(78, 3, 4, '11:00:00', '21:00:00'),
(79, 3, 5, '11:00:00', '21:00:00'),
(80, 3, 6, '11:00:00', '21:00:00'),
(81, 1, 1, '11:00:00', '21:00:00'),
(82, 1, 2, '11:00:00', '21:00:00'),
(83, 1, 3, '11:00:00', '21:00:00'),
(84, 1, 4, '11:00:00', '21:00:00'),
(85, 1, 5, '11:00:00', '21:00:00'),
(86, 1, 6, '11:00:00', '21:00:00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `services`
--

CREATE TABLE `services` (
  `service_id` int(5) NOT NULL,
  `service_name` varchar(50) NOT NULL,
  `service_description` varchar(255) NOT NULL,
  `service_price` decimal(12,2) NOT NULL,
  `service_duration` int(5) NOT NULL,
  `category_id` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data untuk tabel `services`
--

INSERT INTO `services` (`service_id`, `service_name`, `service_description`, `service_price`, `service_duration`, `category_id`) VALUES
(1, 'Potong Rambut', 'Layanan potong rambut profesional dengan hasil rapi, bersih, dan sesuai gaya yang Anda inginkan.', 200000.00, 20, 4),
(3, 'Rapikan Rambut', 'Merapikan bagian samping, belakang, atau poni agar rambut tetap terlihat rapi.', 100000.00, 10, 4),
(4, 'Cukur Bersih', 'Layanan mencukur janggut dan kumis hingga bersih menggunakan teknik yang aman dan nyaman.', 120000.00, 20, 2),
(5, 'Rapikan Janggut', 'Merapikan bentuk janggut dan kumis agar terlihat lebih rapi dan stylish.', 80000.00, 15, 2),
(8, 'Pembersihan Wajah', 'Membersihkan wajah dari kotoran, minyak, dan sel kulit mati agar kulit tetap sehat.', 180000.00, 20, 3),
(9, 'Perawatan Wajah Cerah', 'Perawatan wajah untuk membantu mencerahkan kulit dan menjaga kesehatan wajah.', 220000.00, 20, 3),
(14, 'Cukur Janggut', 'Rapikan janggut untuk tampilan lebih maskulin.', 30000.00, 15, 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `services_booked`
--

CREATE TABLE `services_booked` (
  `appointment_id` int(5) NOT NULL,
  `service_id` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data untuk tabel `services_booked`
--

INSERT INTO `services_booked` (`appointment_id`, `service_id`) VALUES
(13, 1),
(16, 3),
(17, 1),
(20, 1),
(21, 9),
(22, 14);

-- --------------------------------------------------------

--
-- Struktur dari tabel `service_categories`
--

CREATE TABLE `service_categories` (
  `category_id` int(2) NOT NULL,
  `category_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data untuk tabel `service_categories`
--

INSERT INTO `service_categories` (`category_id`, `category_name`) VALUES
(2, 'Shaving'),
(3, 'Face Masking'),
(4, 'Uncategorized');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `appointments`
--
ALTER TABLE `appointments`
  ADD PRIMARY KEY (`appointment_id`),
  ADD KEY `FK_client_appointment` (`client_id`),
  ADD KEY `FK_employee_appointment` (`employee_id`);

--
-- Indeks untuk tabel `barber_admin`
--
ALTER TABLE `barber_admin`
  ADD PRIMARY KEY (`admin_id`),
  ADD UNIQUE KEY `username` (`username`,`email`);

--
-- Indeks untuk tabel `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`client_id`),
  ADD UNIQUE KEY `client_email` (`client_email`);

--
-- Indeks untuk tabel `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`employee_id`);

--
-- Indeks untuk tabel `employees_schedule`
--
ALTER TABLE `employees_schedule`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_emp` (`employee_id`);

--
-- Indeks untuk tabel `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`service_id`),
  ADD KEY `FK_service_category` (`category_id`);

--
-- Indeks untuk tabel `services_booked`
--
ALTER TABLE `services_booked`
  ADD PRIMARY KEY (`appointment_id`,`service_id`),
  ADD KEY `FK_SB_service` (`service_id`);

--
-- Indeks untuk tabel `service_categories`
--
ALTER TABLE `service_categories`
  ADD PRIMARY KEY (`category_id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `appointments`
--
ALTER TABLE `appointments`
  MODIFY `appointment_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT untuk tabel `barber_admin`
--
ALTER TABLE `barber_admin`
  MODIFY `admin_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `clients`
--
ALTER TABLE `clients`
  MODIFY `client_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT untuk tabel `employees`
--
ALTER TABLE `employees`
  MODIFY `employee_id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `employees_schedule`
--
ALTER TABLE `employees_schedule`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=87;

--
-- AUTO_INCREMENT untuk tabel `services`
--
ALTER TABLE `services`
  MODIFY `service_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT untuk tabel `service_categories`
--
ALTER TABLE `service_categories`
  MODIFY `category_id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `appointments`
--
ALTER TABLE `appointments`
  ADD CONSTRAINT `FK_client_appointment` FOREIGN KEY (`client_id`) REFERENCES `clients` (`client_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_employee_appointment` FOREIGN KEY (`employee_id`) REFERENCES `employees` (`employee_id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `employees_schedule`
--
ALTER TABLE `employees_schedule`
  ADD CONSTRAINT `FK_emp` FOREIGN KEY (`employee_id`) REFERENCES `employees` (`employee_id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `services`
--
ALTER TABLE `services`
  ADD CONSTRAINT `FK_service_category` FOREIGN KEY (`category_id`) REFERENCES `service_categories` (`category_id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `services_booked`
--
ALTER TABLE `services_booked`
  ADD CONSTRAINT `FK_SB_appointment` FOREIGN KEY (`appointment_id`) REFERENCES `appointments` (`appointment_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_SB_service` FOREIGN KEY (`service_id`) REFERENCES `services` (`service_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_appointment` FOREIGN KEY (`appointment_id`) REFERENCES `appointments` (`appointment_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
