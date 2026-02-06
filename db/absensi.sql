-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 06, 2026 at 05:26 PM
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
-- Database: `absensi`
--

-- --------------------------------------------------------

--
-- Table structure for table `absen`
--

CREATE TABLE `absen` (
  `id_absen` int(11) NOT NULL,
  `nim` int(11) DEFAULT NULL,
  `id_semester` int(1) NOT NULL,
  `tanggal` date NOT NULL,
  `absen` varchar(1) NOT NULL,
  `kd_matkul` varchar(5) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `absen`
--

INSERT INTO `absen` (`id_absen`, `nim`, `id_semester`, `tanggal`, `absen`, `kd_matkul`) VALUES
(1, 2024010001, 1, '2026-01-05', 'H', 'INF01'),
(2, 2024010002, 1, '2026-01-05', 'H', 'INF01'),
(3, 2024010003, 1, '2026-01-05', 'S', 'INF01'),
(4, 2024010004, 1, '2026-01-05', 'H', 'INF01'),
(5, 2024010005, 1, '2026-01-05', 'I', 'INF01'),
(6, 2024010006, 1, '2026-01-05', 'H', 'INF02'),
(7, 2024010007, 1, '2026-01-05', 'A', 'INF02'),
(8, 2024010008, 1, '2026-01-05', 'H', 'INF02'),
(9, 2024020009, 1, '2026-01-05', 'H', 'INF02'),
(10, 2024020010, 1, '2026-01-05', 'S', 'INF02'),
(11, 2024020011, 1, '2026-01-06', 'H', 'INF03'),
(12, 2024020012, 1, '2026-01-06', 'H', 'INF03'),
(13, 2024020013, 1, '2026-01-06', 'I', 'INF03'),
(14, 2024020014, 1, '2026-01-06', 'H', 'INF03'),
(15, 2024020015, 1, '2026-01-06', 'H', 'INF03'),
(16, 2024020016, 1, '2026-01-06', 'A', 'TKO01'),
(17, 2024030017, 1, '2026-01-06', 'H', 'TKO01'),
(18, 2024030018, 1, '2026-01-06', 'H', 'TKO01'),
(19, 2024030019, 1, '2026-01-06', 'S', 'TKO01'),
(20, 2024030020, 1, '2026-01-06', 'I', 'TKO01'),
(21, 2024030021, 1, '2026-01-07', 'H', 'TKO02'),
(22, 2024030022, 1, '2026-01-07', 'I', 'TKO02'),
(23, 2024040023, 1, '2026-01-07', 'H', 'TKO02'),
(24, 2024040024, 1, '2026-01-07', 'H', 'TKO02'),
(25, 2024040025, 1, '2026-01-07', 'H', 'TKO02'),
(27, 2024040025, 1, '2026-01-30', 'H', 'INF01'),
(28, 2024010001, 1, '2026-02-02', 'H', 'INF02'),
(29, 2024010001, 1, '2026-02-03', 'S', 'TKO02');

-- --------------------------------------------------------

--
-- Table structure for table `dosen`
--

CREATE TABLE `dosen` (
  `id_dosen` int(11) NOT NULL,
  `nidn` varchar(20) NOT NULL,
  `nama_dosen` varchar(100) NOT NULL,
  `email` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `dosen`
--

INSERT INTO `dosen` (`id_dosen`, `nidn`, `nama_dosen`, `email`) VALUES
(1, '00112201', 'Prof. Dr. Ir. H. Ahmad Dahlan, M.T.', 'ahmad.dahlan@kampus.ac.id'),
(2, '00112202', 'Dr. Siti Aminah, S.Kom., M.Cs.', 'siti.aminah@kampus.ac.id'),
(3, '00112203', 'Budi Santoso, S.T., M.Kom.', 'budi.santoso@kampus.ac.id'),
(4, '00112204', 'Dian Pertiwi, S.E., M.M.', 'dian.pertiwi@kampus.ac.id'),
(5, '00112205', 'Ir. Heru Prasetyo, M.Eng.', 'heru.prasetyo@kampus.ac.id'),
(6, '00112206', 'Rina Wijaya, S.Si., M.Sc.', 'rina.wijaya@kampus.ac.id'),
(7, '00112207', 'Dr. Faisal Bahri, M.Ak.', 'faisal.bahri@kampus.ac.id'),
(8, '00112208', 'Maya Indah Sari, S.Pd., M.Hum.', 'maya.indah@kampus.ac.id'),
(9, '00112209', 'Eko Sulistyo, S.H., M.H.', 'eko.sulistyo@kampus.ac.id'),
(10, '00112210', 'Dr. Andi Pratama, M.T.I.', 'andi.pratama@kampus.ac.id'),
(11, '00112211', 'Lilis Karlina, S.Kom., M.T.', 'lilis.karlina@kampus.ac.id'),
(12, '00112212', 'Yusuf Mansur, S.T., M.B.A.', 'yusuf.mansur@kampus.ac.id'),
(13, '00112213', 'Hendra Kurniawan, M.Sc.D.', 'hendra.k@kampus.ac.id'),
(14, '00112214', 'Dr. Putri Rahayu, M.Psi.', 'putri.rahayu@kampus.ac.id'),
(15, '00112215', 'Rahmat Hidayat, S.T., M.Cs.', 'rahmat.h@kampus.ac.id'),
(16, '00112216', 'Siska Amelia, S.E., M.Si.', 'siska.amelia@kampus.ac.id'),
(17, '00112217', 'Denny Sumargo, M.Kom.', 'denny.s@kampus.ac.id'),
(18, '00112218', 'Dr. Ratna Sari, M.Pd.', 'ratna.sari@kampus.ac.id'),
(19, '00112219', 'Fajar Nugraha, S.T., M.T.', 'fajar.n@kampus.ac.id'),
(20, '00112220', 'Sri Wahyuni, S.Kom., M.M.S.I.', 'sri.wahyuni@kampus.ac.id');

-- --------------------------------------------------------

--
-- Table structure for table `kelas`
--

CREATE TABLE `kelas` (
  `id_kelas` varchar(5) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `kelas` varchar(32) NOT NULL,
  `jm_mhs` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `kelas`
--

INSERT INTO `kelas` (`id_kelas`, `kelas`, `jm_mhs`) VALUES
('A1', 'Teknik Informatika - 01', '35'),
('A2', 'Teknik Informatika - 02', '32'),
('B1', 'Sistem Informasi - 01', '30'),
('B2', 'Sistem Informasi - 02', '28'),
('C1', 'Teknik Komputer - 01', '25'),
('D1', 'Manajemen Informatika - 01', '30'),
('E1', 'Akuntansi Digital - 01', '25'),
('F1', 'Desain Komunikasi Visual - 01', '20');

-- --------------------------------------------------------

--
-- Table structure for table `mahasiswa`
--

CREATE TABLE `mahasiswa` (
  `nim` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `id_kelas` varchar(5) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `mahasiswa`
--

INSERT INTO `mahasiswa` (`nim`, `nama`, `email`, `id_kelas`) VALUES
(2024010001, 'Aditya Pratama', 'aditya.p@student.ac.id', 'A1'),
(2024010002, 'Bunga Citra Lestari', 'bunga.c@student.ac.id', 'A1'),
(2024010003, 'Candra Wijaya', 'candra.w@student.ac.id', 'A1'),
(2024010004, 'Dwi Sasono', 'dwi.s@student.ac.id', 'A1'),
(2024010005, 'Eko Putro', 'eko.p@student.ac.id', 'A1'),
(2024010006, 'Fitri Handayani', 'fitri.h@student.ac.id', 'A1'),
(2024010007, 'Gading Marten', 'gading.m@student.ac.id', 'A1'),
(2024010008, 'Hesti Purwadinata', 'hesti.p@student.ac.id', 'A1'),
(2024020009, 'Indra Bruggman', 'indra.b@student.ac.id', 'A1'),
(2024020010, 'Jessica Mila', 'jessica.m@student.ac.id', 'A1'),
(2024020011, 'Kevin Julio', 'kevin.j@student.ac.id', 'A2'),
(2024020012, 'Luna Maya', 'luna.m@student.ac.id', 'A2'),
(2024020013, 'Morgan Oey', 'morgan.o@student.ac.id', 'A2'),
(2024020014, 'Nadine Chandrawinata', 'nadine.c@student.ac.id', 'A2'),
(2024020015, 'Olla Ramlan', 'olla.r@student.ac.id', 'A2'),
(2024020016, 'Pevita Pearce', 'pevita.p@student.ac.id', 'C1'),
(2024030017, 'Raditya Dika', 'raditya.d@student.ac.id', 'C1'),
(2024030018, 'Sule Prikitiw', 'sule.p@student.ac.id', 'C1'),
(2024030019, 'Tora Sudiro', 'tora.s@student.ac.id', 'C1'),
(2024030020, 'Uus Rizky', 'uus.r@student.ac.id', 'C1'),
(2024030021, 'Vino G Bastian', 'vino.g@student.ac.id', 'B2'),
(2024030022, 'Wulan Guritno', 'wulan.g@student.ac.id', 'B2'),
(2024040023, 'Xavier Marks', 'xavier.m@student.ac.id', 'B2'),
(2024040024, 'Yuni Shara', 'yuni.s@student.ac.id', 'B2'),
(2024040025, 'Zaskia Adya Mecca', 'zaskia.a@student.ac.id', 'B2'),
(2024040026, 'Ari Lasso', 'ari.l@student.ac.id', 'B1'),
(2024040027, 'Baim Wong', 'baim.w@student.ac.id', 'B1'),
(2024040028, 'Chandra Liow', 'chandra.l@student.ac.id', 'B1'),
(2024050029, 'Deddy Corbuzier', 'deddy.c@student.ac.id', 'B1'),
(2024050030, 'Ernest Prakasa', 'ernest.p@student.ac.id', 'B1'),
(2024050031, 'Fiersa Besari', 'fiersa.b@student.ac.id', 'D1'),
(2024050032, 'Gisella Anastasia', 'gisella.a@student.ac.id', 'D1'),
(2024050033, 'Hamish Daud', 'hamish.d@student.ac.id', 'D1'),
(2024050034, 'Isyana Sarasvati', 'isyana.s@student.ac.id', 'D1'),
(2024060035, 'Jefri Nichol', 'jefri.n@student.ac.id', 'D1'),
(2024060036, 'Kunto Aji', 'kunto.a@student.ac.id', 'E1'),
(2024060037, 'Lesti Kejora', 'lesti.k@student.ac.id', 'E1'),
(2024060038, 'Maudy Ayunda', 'maudy.a@student.ac.id', 'E1'),
(2024060039, 'Najwa Shihab', 'najwa.s@student.ac.id', 'E1'),
(2024060040, 'Onadio Leonardo', 'onadio.l@student.ac.id', 'E1'),
(2024070041, 'Prilly Latuconsina', 'prilly.l@student.ac.id', 'F1'),
(2024070042, 'Raffi Ahmad', 'raffi.a@student.ac.id', 'F1'),
(2024070043, 'Sandiaga Uno', 'sandi.u@student.ac.id', 'F1'),
(2024070044, 'Tulus Rusydi', 'tulus.r@student.ac.id', 'F1'),
(2024070045, 'Ungu Pasha', 'ungu.p@student.ac.id', 'F1');

-- --------------------------------------------------------

--
-- Table structure for table `matkul`
--

CREATE TABLE `matkul` (
  `kd_matkul` varchar(5) NOT NULL,
  `matkul` varchar(32) NOT NULL,
  `tanggal` date DEFAULT NULL,
  `id_kelas` varchar(5) DEFAULT NULL,
  `jm_sks` varchar(20) NOT NULL,
  `jam` varchar(20) DEFAULT NULL,
  `ruangan` varchar(20) DEFAULT NULL,
  `id_dosen` int(11) DEFAULT NULL,
  `id_absen` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `matkul`
--

INSERT INTO `matkul` (`kd_matkul`, `matkul`, `tanggal`, `id_kelas`, `jm_sks`, `jam`, `ruangan`, `id_dosen`, `id_absen`) VALUES
('AKT01', 'Akuntansi Dasar', '2026-01-09', 'E1', '3 SKS', '08:00 - 10:30', 'R.101 (Gedung C)', 13, 9),
('INF01', 'Pemrograman Web', '2026-01-05', 'A1', '3 SKS', '08:00 - 10:30', 'LAB-KOM-01', 1, 1),
('INF02', 'Basis Data', '2026-01-05', 'A1', '3 SKS', '10:30 - 13:00', 'LAB-KOM-02', 2, 2),
('INF03', 'Struktur Data', '2026-01-06', 'A2', '4 SKS', '08:00 - 11:20', 'LAB-KOM-01', 3, 3),
('MAN01', 'Manajemen Bisnis', '2026-01-09', 'D1', '2 SKS', '10:30 - 12:10', 'R.102 (Gedung C)', 15, 10),
('RPL01', 'Rekayasa Perangkat Lunak', '2026-01-08', 'A2', '3 SKS', '10:00 - 12:30', 'R.305 (Gedung A)', 6, 6),
('SIS01', 'Analisis Sistem', '2026-01-07', 'B1', '3 SKS', '13:00 - 15:30', 'R.301 (Gedung A)', 4, 4),
('SIS02', 'E-Commerce', '2026-01-08', 'B1', '2 SKS', '13:00 - 14:40', 'R.302 (Gedung A)', 7, 7),
('TKO01', 'Arsitektur Komputer', '2026-01-06', 'C1', '3 SKS', '07:30 - 10:00', 'R.202 (Gedung B)', 5, 5),
('TKO02', 'Jaringan Komputer', '2026-01-07', 'A1', '4 SKS', '08:00 - 11:20', 'LAB-JARINGAN', 8, 8);

-- --------------------------------------------------------

--
-- Table structure for table `semester`
--

CREATE TABLE `semester` (
  `id_semester` int(1) NOT NULL,
  `status` enum('Y','N') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `semester`
--

INSERT INTO `semester` (`id_semester`, `status`) VALUES
(1, 'Y'),
(2, 'N');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id_user` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nama_lengkap` varchar(100) NOT NULL,
  `role` enum('admin','dosen','mahasiswa') NOT NULL,
  `id_penerima` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id_user`, `username`, `email`, `password`, `nama_lengkap`, `role`, `id_penerima`) VALUES
(1, 'admin1', '', '0192023a7bbd73250516f069df18b500', 'Administrator Utama', 'admin', 0),
(2, 'dosen1', 'budi.santoso@kampus.ac.id', 'd5bbfb47ac3160c31fa8c247827115aa', 'Dr. Budi Santoso', 'dosen', 3),
(3, 'mhs1', 'aditya.p@student.ac.id', '39f55dd65ead9c938fa93a765983bff0', 'Aditya Pratama', 'mahasiswa', 2024010001);

-- --------------------------------------------------------

--
-- Table structure for table `user_token`
--

CREATE TABLE `user_token` (
  `id` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `token` varchar(128) NOT NULL,
  `date_created` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_token`
--

INSERT INTO `user_token` (`id`, `email`, `token`, `date_created`) VALUES
(1, 'zaskia.a@student.ac.id', '6a7bd880904aaa071bcab1043ced2312a82f389ee018e40c16e3050aea30225a', 1770016911),
(2, 'aditya.p@student.ac.id', 'f8045672f309554e4e13fee0d76c0d71c019de8a0a78a2426f8f4e0d1bf687f1', 1770091422);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `absen`
--
ALTER TABLE `absen`
  ADD PRIMARY KEY (`id_absen`),
  ADD KEY `id_semester` (`id_semester`) USING BTREE,
  ADD KEY `kd_matkul` (`kd_matkul`),
  ADD KEY `nim` (`nim`);

--
-- Indexes for table `dosen`
--
ALTER TABLE `dosen`
  ADD PRIMARY KEY (`id_dosen`),
  ADD UNIQUE KEY `nidn` (`nidn`);

--
-- Indexes for table `kelas`
--
ALTER TABLE `kelas`
  ADD PRIMARY KEY (`id_kelas`);

--
-- Indexes for table `mahasiswa`
--
ALTER TABLE `mahasiswa`
  ADD PRIMARY KEY (`nim`),
  ADD KEY `id_kelas` (`id_kelas`);

--
-- Indexes for table `matkul`
--
ALTER TABLE `matkul`
  ADD PRIMARY KEY (`kd_matkul`),
  ADD UNIQUE KEY `id_dosen` (`id_dosen`),
  ADD KEY `id_absen` (`id_absen`);

--
-- Indexes for table `semester`
--
ALTER TABLE `semester`
  ADD PRIMARY KEY (`id_semester`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `user_token`
--
ALTER TABLE `user_token`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `absen`
--
ALTER TABLE `absen`
  MODIFY `id_absen` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `dosen`
--
ALTER TABLE `dosen`
  MODIFY `id_dosen` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `mahasiswa`
--
ALTER TABLE `mahasiswa`
  MODIFY `nim` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2024080051;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user_token`
--
ALTER TABLE `user_token`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `absen`
--
ALTER TABLE `absen`
  ADD CONSTRAINT `absen_ibfk_1` FOREIGN KEY (`kd_matkul`) REFERENCES `matkul` (`kd_matkul`),
  ADD CONSTRAINT `fk_absen_semester` FOREIGN KEY (`id_semester`) REFERENCES `semester` (`id_semester`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_absen_siswa` FOREIGN KEY (`nim`) REFERENCES `mahasiswa` (`nim`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `mahasiswa`
--
ALTER TABLE `mahasiswa`
  ADD CONSTRAINT `mahasiswa_ibfk_1` FOREIGN KEY (`id_kelas`) REFERENCES `kelas` (`id_kelas`);

--
-- Constraints for table `matkul`
--
ALTER TABLE `matkul`
  ADD CONSTRAINT `matkul_ibfk_1` FOREIGN KEY (`id_dosen`) REFERENCES `dosen` (`id_dosen`),
  ADD CONSTRAINT `matkul_ibfk_2` FOREIGN KEY (`id_absen`) REFERENCES `absen` (`id_absen`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
