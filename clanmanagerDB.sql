-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 06-10-2025 a las 12:33:32
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `clanmanager`
--
CREATE DATABASE IF NOT EXISTS `clanmanager` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `clanmanager`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clanmembers`
--

CREATE TABLE IF NOT EXISTS `clanmembers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idClan` int(11) NOT NULL,
  `idUser` int(11) NOT NULL,
  `role` varchar(50) DEFAULT 'miembro',
  `gameRole` enum('tank','heal','dps') DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idClan` (`idClan`),
  KEY `idUser` (`idUser`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `clanmembers`
--

INSERT INTO `clanmembers` (`id`, `idClan`, `idUser`, `role`, `gameRole`) VALUES
(4, 7, 14, 'lider', 'tank'),
(5, 7, 15, 'oficial', 'heal'),
(6, 7, 16, 'miembro', 'dps'),
(8, 8, 17, 'lider', 'heal'),
(12, 8, 18, 'miembro', NULL),
(13, 7, 19, 'miembro', 'heal');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clans`
--

CREATE TABLE IF NOT EXISTS `clans` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `description` text DEFAULT NULL,
  `logo` varchar(255) DEFAULT NULL,
  `idLeader` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `idLeader` (`idLeader`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `clans`
--

INSERT INTO `clans` (`id`, `name`, `description`, `logo`, `idLeader`) VALUES
(7, 'clan1', 'este es el clan 1', '', 14),
(8, 'clan2', 'este es el clan 2', '', 17);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dkps`
--

CREATE TABLE IF NOT EXISTS `dkps` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idClan` int(11) NOT NULL,
  `idUser` int(11) NOT NULL,
  `points` int(11) DEFAULT 0,
  `reason` varchar(255) NOT NULL,
  `createdAt` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `idClan` (`idClan`),
  KEY `idUser` (`idUser`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `dkps`
--

INSERT INTO `dkps` (`id`, `idClan`, `idUser`, `points`, `reason`, `createdAt`) VALUES
(1, 7, 14, 5, 'por que si', '2025-10-05 12:37:28'),
(2, 7, 15, 4, 'por que puedo', '2025-10-05 12:37:28'),
(3, 7, 16, 3, 'por que quiero', '2025-10-05 12:37:28'),
(4, 7, 15, 2, 'para adelantar', '2025-10-05 12:40:03');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `email` varchar(70) NOT NULL,
  `password` varchar(255) NOT NULL,
  `registro` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `registro`) VALUES
(14, 'lider1', 'lider1@mail.com', '$argon2id$v=19$m=65536,t=2,p=1$L3RIZFZLOTM1anRHU0NEdg$YyPtiZ8ScKsp4mY8CgHWdoZQcqGNbag9k6ZE1L6pO58', '2025-10-05 09:22:14'),
(15, 'miembro1', 'miembro1@mail.com', '$argon2id$v=19$m=65536,t=2,p=1$V0ViZVJ3bEd1allHbTJkSA$BqzsAs0K3W3IJc5jsz1Ohsgh00H/IMAfHciLAvqLtzs', '2025-10-05 09:33:42'),
(16, 'miembro2', 'miembro2@mail.com', '$argon2id$v=19$m=65536,t=2,p=1$eG5jSE5zMUYvdmwxdWIzRA$NQyk/nGCRco7sdfo740wpmSuUAb1b3be7rNPIq6IOUU', '2025-10-05 10:34:23'),
(17, 'lider2', 'lider2@mail.com', '$argon2id$v=19$m=65536,t=2,p=1$QWhpdXRPcms4dDB3U0FQOQ$+/akBaS8bLZASUtnsR89IQnyhdvmOK6GBPQ5EsNEIrk', '2025-10-05 10:47:22'),
(18, 'lider3', 'lider3@mail.com', '$argon2id$v=19$m=65536,t=2,p=1$MUtqaHM2a3RiYm9GcnNzaQ$QLXuU5L3YDrOKETZU5op+zi65kjX6Hf984LBMdtuxAU', '2025-10-05 11:43:34'),
(19, 'jugador1', 'jugador1@mail.com', '$argon2id$v=19$m=65536,t=2,p=1$WXhGZ1FnS3plZEpkeXgvQw$V7KzN4oENZdycj9+iLMQODGDYgBt/ovFqRN6czAHs5Q', '2025-10-05 13:09:55'),
(20, 'unsuario6', 'usuario6@mail.com', '$argon2id$v=19$m=65536,t=2,p=1$c1lvZEJETmtpQXNxN0FnSA$28oxmtCLiZIYE59zCQdhQgpeYjOJbi8yNQNUXLZawHs', '2025-10-06 06:58:47');

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `clanmembers`
--
ALTER TABLE `clanmembers`
  ADD CONSTRAINT `clanmembers_ibfk_1` FOREIGN KEY (`idClan`) REFERENCES `clans` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `clanmembers_ibfk_2` FOREIGN KEY (`idUser`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `clans`
--
ALTER TABLE `clans`
  ADD CONSTRAINT `clans_ibfk_1` FOREIGN KEY (`idLeader`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `dkps`
--
ALTER TABLE `dkps`
  ADD CONSTRAINT `dkps_ibfk_1` FOREIGN KEY (`idClan`) REFERENCES `clans` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `dkps_ibfk_2` FOREIGN KEY (`idUser`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
