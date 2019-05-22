-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: May 22, 2019 at 07:45 AM
-- Server version: 5.6.43
-- PHP Version: 5.6.40

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `camagru`
--

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `login` text,
  `password` text,
  `mail` text,
  `VALIDE` tinyint(4) DEFAULT NULL,
  `root` tinyint(1) DEFAULT '0',
  `token` tinytext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `login`, `password`, `mail`, `VALIDE`, `root`, `token`) VALUES
(1, 'root', 'root', NULL, 1, 0, ''),
(2, 'root', '06948d93cd1e0855ea37e75ad516a250d2d0772890b073808d831c438509190162c0d890b17001361820cffc30d50f010c387e9df943065aa8f4e92e63ff060c', NULL, 1, 0, ''),
(4, 'caca', 'caca', 'caca@lol.fr', NULL, 0, ''),
(5, 'lol', 'lol', 'lol@ook.com', 1, 0, ''),
(6, 'TESTEUU', 'd1b85af908404fc620f5d4956d1db2cefea9929e0bb03005f7e01cc7c75a11d342c89e125d50ec0aca26ed9cfb399934c65e2733cacf95d890f0fd8c0039ddad', 'new@new.fr', 0, 0, ''),
(7, 'TESTEUU', 'd1b85af908404fc620f5d4956d1db2cefea9929e0bb03005f7e01cc7c75a11d342c89e125d50ec0aca26ed9cfb399934c65e2733cacf95d890f0fd8c0039ddad', 'new@new.fr', 0, 0, ''),
(8, 'tamer', 'fd9d94340dbd72c11b37ebb0d2a19b4d05e00fd78e4e2ce8923b9ea3a54e900df181cfb112a8a73228d1f3551680e2ad9701a4fcfb248fa7fa77b95180628bb2', 'simphilippe42@yahoo.fr', 0, 0, ''),
(9, 'tonpere', 'fd9d94340dbd72c11b37ebb0d2a19b4d05e00fd78e4e2ce8923b9ea3a54e900df181cfb112a8a73228d1f3551680e2ad9701a4fcfb248fa7fa77b95180628bb2', 'simphilippe40@yahoo.fr', 0, 0, ''),
(10, 'TASOEUR', 'fd9d94340dbd72c11b37ebb0d2a19b4d05e00fd78e4e2ce8923b9ea3a54e900df181cfb112a8a73228d1f3551680e2ad9701a4fcfb248fa7fa77b95180628bb2', 'simphilippe43@yahoo.fr', 0, 0, ''),
(11, 'okokok', 'd1b85af908404fc620f5d4956d1db2cefea9929e0bb03005f7e01cc7c75a11d342c89e125d50ec0aca26ed9cfb399934c65e2733cacf95d890f0fd8c0039ddad', 'nimp@a.fr', 0, 0, ''),
(12, 'lolilol', '614cad4f3f8535d4c8c9a952f9808778c2eeb9014755371d98d82446915b055e5cb2451c996edb51ba94c890f3bc5c28a7f4513874e8e51248bd36ece7342014', 'escatrag@spam.com', 0, 0, '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
