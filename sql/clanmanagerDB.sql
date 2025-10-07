-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 07-10-2025 a las 22:06:23
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
) ENGINE=InnoDB AUTO_INCREMENT=75 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `clanmembers`
--

INSERT INTO `clanmembers` (`id`, `idClan`, `idUser`, `role`, `gameRole`) VALUES
(15, 1, 101, 'lider', 'tank'),
(16, 1, 201, 'oficial', 'heal'),
(17, 1, 202, 'oficial', 'dps'),
(18, 1, 203, 'miembro', 'dps'),
(19, 1, 204, 'miembro', 'dps'),
(20, 1, 205, 'miembro', 'tank'),
(21, 1, 206, 'miembro', 'dps'),
(22, 2, 102, 'lider', 'dps'),
(23, 2, 207, 'oficial', 'tank'),
(24, 2, 208, 'oficial', 'dps'),
(25, 2, 209, 'miembro', 'dps'),
(26, 2, 210, 'miembro', 'heal'),
(27, 2, 211, 'miembro', 'dps'),
(28, 3, 103, 'lider', 'dps'),
(29, 3, 212, 'oficial', 'heal'),
(30, 3, 213, 'miembro', 'dps'),
(31, 3, 214, 'miembro', 'dps'),
(32, 3, 215, 'miembro', 'tank'),
(33, 3, 216, 'miembro', 'dps'),
(34, 4, 104, 'lider', 'tank'),
(35, 4, 217, 'oficial', 'dps'),
(36, 4, 218, 'miembro', 'dps'),
(37, 4, 219, 'miembro', 'heal'),
(38, 4, 220, 'miembro', 'dps'),
(39, 5, 105, 'lider', 'dps'),
(40, 5, 221, 'oficial', 'tank'),
(41, 5, 222, 'oficial', 'dps'),
(42, 5, 223, 'miembro', 'dps'),
(43, 5, 224, 'miembro', 'heal'),
(44, 5, 225, 'miembro', 'dps'),
(45, 6, 106, 'lider', 'heal'),
(46, 6, 226, 'oficial', 'tank'),
(47, 6, 227, 'miembro', 'dps'),
(48, 6, 228, 'miembro', 'dps'),
(49, 6, 229, 'miembro', 'heal'),
(50, 7, 107, 'lider', 'dps'),
(51, 7, 230, 'oficial', 'tank'),
(52, 7, 231, 'miembro', 'dps'),
(53, 7, 232, 'miembro', 'dps'),
(54, 7, 233, 'miembro', 'heal'),
(55, 8, 108, 'lider', 'dps'),
(56, 8, 234, 'oficial', 'dps'),
(57, 8, 235, 'miembro', 'dps'),
(58, 8, 236, 'miembro', 'dps'),
(59, 8, 237, 'miembro', 'tank'),
(60, 9, 109, 'lider', 'tank'),
(61, 9, 238, 'oficial', 'heal'),
(62, 9, 239, 'miembro', 'dps'),
(63, 9, 240, 'miembro', 'dps'),
(64, 9, 241, 'miembro', 'dps'),
(65, 10, 110, 'líder', 'tank'),
(66, 10, 242, 'oficial', 'dps'),
(67, 10, 243, 'miembro', 'dps'),
(68, 10, 244, 'miembro', 'heal'),
(69, 10, 245, 'miembro', 'dps'),
(70, 11, 111, 'líder', 'dps'),
(71, 11, 246, 'oficial', 'tank'),
(72, 11, 247, 'miembro', 'dps'),
(73, 11, 248, 'miembro', 'dps'),
(74, 11, 249, 'miembro', 'heal');

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
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `clans`
--

INSERT INTO `clans` (`id`, `name`, `description`, `logo`, `idLeader`) VALUES
(1, 'Lobos del alba', 'Clan táctico que ataca al amanecer con precisión y sigilo.', '', 101),
(2, 'Lobos del ocaso', 'Veteranos que dominan las batallas nocturnas con agresividad controlada.', '', 102),
(3, 'Nvicia2', 'Grupo competitivo centrado en raids semanales y progresión constante.', '', 103),
(4, 'Wolflolos', 'Clan informal con buen humor pero gran eficacia en combate.', '', 104),
(5, 'Hijos de baal', 'Seguidores del caos que buscan gloria en cada enfrentamiento.', '', 105),
(6, 'Dragones de demeter', 'Defensores de la armonía, especializados en apoyo y estrategia.', '', 106),
(7, 'Centinelas del Vacío', 'Exploradores de zonas oscuras, expertos en emboscadas.', '', 107),
(8, 'Furia Carmesí', 'DPS extremos que priorizan daño por encima de todo.', '', 108),
(9, 'Alas de Éter', 'Clan aéreo que domina mapas verticales y movilidad avanzada.', '', 109),
(10, 'Martillo de Gaia', 'Tanques duros con enfoque en defensa y control de territorio.', '', 110),
(11, 'Sombras de Tyr', 'Clan sigiloso que opera en silencio y elimina sin dejar rastro.', '', 111);

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
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `dkps`
--

INSERT INTO `dkps` (`id`, `idClan`, `idUser`, `points`, `reason`, `createdAt`) VALUES
(7, 1, 203, 6, 'Por DPS constante en evento de amanecer', '2025-10-06 16:00:00'),
(8, 1, 204, -2, 'Por llegar tarde a la raid', '2025-10-06 16:30:00'),
(9, 1, 206, 4, 'Por asistencia completa en evento', '2025-10-06 17:00:00'),
(10, 2, 209, 7, 'Por daño crítico en jefe nocturno', '2025-10-06 20:00:00'),
(11, 2, 211, -5, 'Por desconexión sin aviso', '2025-10-06 20:15:00'),
(12, 3, 213, 5, 'Por DPS en fase final', '2025-10-06 18:00:00'),
(13, 3, 215, 3, 'Por tanqueo estable en boss', '2025-10-06 18:30:00'),
(14, 4, 218, 6, 'Por participación en evento sorpresa', '2025-10-06 19:00:00'),
(15, 4, 219, 4, 'Por curación en combate prolongado', '2025-10-06 19:30:00'),
(16, 5, 223, 8, 'Por daño explosivo en jefe de caos', '2025-10-06 21:00:00'),
(17, 5, 224, -3, 'Por no asistir a reunión de estrategia', '2025-10-06 21:30:00'),
(18, 6, 227, 5, 'Por DPS en defensa de territorio', '2025-10-06 17:00:00'),
(19, 6, 229, 6, 'Por curación en evento de armonía', '2025-10-06 17:30:00'),
(20, 7, 231, 7, 'Por eliminación silenciosa en zona oscura', '2025-10-06 18:00:00'),
(21, 7, 233, 4, 'Por apoyo en emboscada', '2025-10-06 18:30:00'),
(22, 8, 235, 9, 'Por daño máximo en boss final', '2025-10-06 19:00:00'),
(23, 8, 237, -2, 'Por no seguir mecánicas', '2025-10-06 19:30:00'),
(24, 9, 239, 6, 'Por movilidad avanzada en combate aéreo', '2025-10-06 20:00:00'),
(25, 9, 241, 5, 'Por asistencia completa en evento vertical', '2025-10-06 20:30:00'),
(26, 10, 243, 7, 'Por daño sostenido en defensa de zona', '2025-10-06 21:00:00'),
(27, 10, 245, 4, 'Por participación en evento de resistencia', '2025-10-06 21:30:00'),
(28, 11, 247, 8, 'Por eliminación precisa en sigilo', '2025-10-06 18:00:00'),
(29, 11, 249, 5, 'Por curación en misión encubierta', '2025-10-06 18:30:00');

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
) ENGINE=InnoDB AUTO_INCREMENT=251 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `registro`) VALUES
(101, 'albaLider', 'alba@demo.com', '$argon2id$v=19$m=65536,t=2,p=1$TzVRdG9nUURad0ZrVGNvNg$CDlOMQjWURxs/oSMR+DUCVu5MSEnnLtfONEN6fwdEOA', '2025-10-07 19:00:00'),
(102, 'ocasoLider', 'ocaso@demo.com', '$argon2id$v=19$m=65536,t=2,p=1$TzVRdG9nUURad0ZrVGNvNg$CDlOMQjWURxs/oSMR+DUCVu5MSEnnLtfONEN6fwdEOA', '2025-10-07 19:01:00'),
(103, 'nviciaLider', 'nvicia@demo.com', '$argon2id$v=19$m=65536,t=2,p=1$TzVRdG9nUURad0ZrVGNvNg$CDlOMQjWURxs/oSMR+DUCVu5MSEnnLtfONEN6fwdEOA', '2025-10-07 19:02:00'),
(104, 'wolflolosLider', 'wolf@demo.com', '$argon2id$v=19$m=65536,t=2,p=1$TzVRdG9nUURad0ZrVGNvNg$CDlOMQjWURxs/oSMR+DUCVu5MSEnnLtfONEN6fwdEOA', '2025-10-07 19:03:00'),
(105, 'baalLider', 'baal@demo.com', '$argon2id$v=19$m=65536,t=2,p=1$TzVRdG9nUURad0ZrVGNvNg$CDlOMQjWURxs/oSMR+DUCVu5MSEnnLtfONEN6fwdEOA', '2025-10-07 19:04:00'),
(106, 'demeterLider', 'demeter@demo.com', '$argon2id$v=19$m=65536,t=2,p=1$TzVRdG9nUURad0ZrVGNvNg$CDlOMQjWURxs/oSMR+DUCVu5MSEnnLtfONEN6fwdEOA', '2025-10-07 19:05:00'),
(107, 'vacioLider', 'vacio@demo.com', '$argon2id$v=19$m=65536,t=2,p=1$TzVRdG9nUURad0ZrVGNvNg$CDlOMQjWURxs/oSMR+DUCVu5MSEnnLtfONEN6fwdEOA', '2025-10-07 19:06:00'),
(108, 'furiaLider', 'furia@demo.com', '$argon2id$v=19$m=65536,t=2,p=1$TzVRdG9nUURad0ZrVGNvNg$CDlOMQjWURxs/oSMR+DUCVu5MSEnnLtfONEN6fwdEOA', '2025-10-07 19:07:00'),
(109, 'alasLider', 'alas@demo.com', '$argon2id$v=19$m=65536,t=2,p=1$TzVRdG9nUURad0ZrVGNvNg$CDlOMQjWURxs/oSMR+DUCVu5MSEnnLtfONEN6fwdEOA', '2025-10-07 19:08:00'),
(110, 'gaiaLider', 'gaia@demo.com', '$argon2id$v=19$m=65536,t=2,p=1$TzVRdG9nUURad0ZrVGNvNg$CDlOMQjWURxs/oSMR+DUCVu5MSEnnLtfONEN6fwdEOA', '2025-10-07 19:09:00'),
(111, 'tyrLider', 'tyr@demo.com', '$argon2id$v=19$m=65536,t=2,p=1$TzVRdG9nUURad0ZrVGNvNg$CDlOMQjWURxs/oSMR+DUCVu5MSEnnLtfONEN6fwdEOA', '2025-10-07 19:10:00'),
(201, 'albaOficial1', 'alba1@demo.com', '$argon2id$v=19$m=65536,t=2,p=1$TzVRdG9nUURad0ZrVGNvNg$CDlOMQjWURxs/oSMR+DUCVu5MSEnnLtfONEN6fwdEOA', '2025-10-07 19:11:00'),
(202, 'albaOficial2', 'alba2@demo.com', '$argon2id$v=19$m=65536,t=2,p=1$TzVRdG9nUURad0ZrVGNvNg$CDlOMQjWURxs/oSMR+DUCVu5MSEnnLtfONEN6fwdEOA', '2025-10-07 19:12:00'),
(203, 'albaMiembro1', 'alba3@demo.com', '$argon2id$v=19$m=65536,t=2,p=1$TzVRdG9nUURad0ZrVGNvNg$CDlOMQjWURxs/oSMR+DUCVu5MSEnnLtfONEN6fwdEOA', '2025-10-07 19:13:00'),
(204, 'albaMiembro2', 'alba4@demo.com', '$argon2id$v=19$m=65536,t=2,p=1$TzVRdG9nUURad0ZrVGNvNg$CDlOMQjWURxs/oSMR+DUCVu5MSEnnLtfONEN6fwdEOA', '2025-10-07 19:14:00'),
(205, 'albaMiembro3', 'alba5@demo.com', '$argon2id$v=19$m=65536,t=2,p=1$TzVRdG9nUURad0ZrVGNvNg$CDlOMQjWURxs/oSMR+DUCVu5MSEnnLtfONEN6fwdEOA', '2025-10-07 19:15:00'),
(206, 'albaMiembro4', 'alba6@demo.com', '$argon2id$v=19$m=65536,t=2,p=1$TzVRdG9nUURad0ZrVGNvNg$CDlOMQjWURxs/oSMR+DUCVu5MSEnnLtfONEN6fwdEOA', '2025-10-07 19:16:00'),
(207, 'ocasoOficial1', 'ocaso1@demo.com', '$argon2id$v=19$m=65536,t=2,p=1$TzVRdG9nUURad0ZrVGNvNg$CDlOMQjWURxs/oSMR+DUCVu5MSEnnLtfONEN6fwdEOA', '2025-10-07 19:17:00'),
(208, 'ocasoOficial2', 'ocaso2@demo.com', '$argon2id$v=19$m=65536,t=2,p=1$TzVRdG9nUURad0ZrVGNvNg$CDlOMQjWURxs/oSMR+DUCVu5MSEnnLtfONEN6fwdEOA', '2025-10-07 19:18:00'),
(209, 'ocasoMiembro1', 'ocaso3@demo.com', '$argon2id$v=19$m=65536,t=2,p=1$TzVRdG9nUURad0ZrVGNvNg$CDlOMQjWURxs/oSMR+DUCVu5MSEnnLtfONEN6fwdEOA', '2025-10-07 19:19:00'),
(210, 'ocasoMiembro2', 'ocaso4@demo.com', '$argon2id$v=19$m=65536,t=2,p=1$TzVRdG9nUURad0ZrVGNvNg$CDlOMQjWURxs/oSMR+DUCVu5MSEnnLtfONEN6fwdEOA', '2025-10-07 19:20:00'),
(211, 'ocasoMiembro3', 'ocaso5@demo.com', '$argon2id$v=19$m=65536,t=2,p=1$TzVRdG9nUURad0ZrVGNvNg$CDlOMQjWURxs/oSMR+DUCVu5MSEnnLtfONEN6fwdEOA', '2025-10-07 19:21:00'),
(212, 'nviciaOficial1', 'nvicia1@demo.com', '$argon2id$v=19$m=65536,t=2,p=1$TzVRdG9nUURad0ZrVGNvNg$CDlOMQjWURxs/oSMR+DUCVu5MSEnnLtfONEN6fwdEOA', '2025-10-07 19:22:00'),
(213, 'nviciaMiembro1', 'nvicia2@demo.com', '$argon2id$v=19$m=65536,t=2,p=1$TzVRdG9nUURad0ZrVGNvNg$CDlOMQjWURxs/oSMR+DUCVu5MSEnnLtfONEN6fwdEOA', '2025-10-07 19:23:00'),
(214, 'nviciaMiembro2', 'nvicia3@demo.com', '$argon2id$v=19$m=65536,t=2,p=1$TzVRdG9nUURad0ZrVGNvNg$CDlOMQjWURxs/oSMR+DUCVu5MSEnnLtfONEN6fwdEOA', '2025-10-07 19:24:00'),
(215, 'nviciaMiembro3', 'nvicia4@demo.com', '$argon2id$v=19$m=65536,t=2,p=1$TzVRdG9nUURad0ZrVGNvNg$CDlOMQjWURxs/oSMR+DUCVu5MSEnnLtfONEN6fwdEOA', '2025-10-07 19:25:00'),
(216, 'nviciaMiembro4', 'nvicia5@demo.com', '$argon2id$v=19$m=65536,t=2,p=1$TzVRdG9nUURad0ZrVGNvNg$CDlOMQjWURxs/oSMR+DUCVu5MSEnnLtfONEN6fwdEOA', '2025-10-07 19:26:00'),
(217, 'wolfOficial1', 'wolf1@demo.com', '$argon2id$v=19$m=65536,t=2,p=1$TzVRdG9nUURad0ZrVGNvNg$CDlOMQjWURxs/oSMR+DUCVu5MSEnnLtfONEN6fwdEOA', '2025-10-07 19:27:00'),
(218, 'wolfMiembro1', 'wolf2@demo.com', '$argon2id$v=19$m=65536,t=2,p=1$TzVRdG9nUURad0ZrVGNvNg$CDlOMQjWURxs/oSMR+DUCVu5MSEnnLtfONEN6fwdEOA', '2025-10-07 19:28:00'),
(219, 'wolfMiembro2', 'wolf3@demo.com', '$argon2id$v=19$m=65536,t=2,p=1$TzVRdG9nUURad0ZrVGNvNg$CDlOMQjWURxs/oSMR+DUCVu5MSEnnLtfONEN6fwdEOA', '2025-10-07 19:29:00'),
(220, 'wolfMiembro3', 'wolf4@demo.com', '$argon2id$v=19$m=65536,t=2,p=1$TzVRdG9nUURad0ZrVGNvNg$CDlOMQjWURxs/oSMR+DUCVu5MSEnnLtfONEN6fwdEOA', '2025-10-07 19:30:00'),
(221, 'baalOficial1', 'baal1@demo.com', '$argon2id$v=19$m=65536,t=2,p=1$TzVRdG9nUURad0ZrVGNvNg$CDlOMQjWURxs/oSMR+DUCVu5MSEnnLtfONEN6fwdEOA', '2025-10-07 19:31:00'),
(222, 'baalOficial2', 'baal2@demo.com', '$argon2id$v=19$m=65536,t=2,p=1$TzVRdG9nUURad0ZrVGNvNg$CDlOMQjWURxs/oSMR+DUCVu5MSEnnLtfONEN6fwdEOA', '2025-10-07 19:32:00'),
(223, 'baalMiembro1', 'baal3@demo.com', '$argon2id$v=19$m=65536,t=2,p=1$TzVRdG9nUURad0ZrVGNvNg$CDlOMQjWURxs/oSMR+DUCVu5MSEnnLtfONEN6fwdEOA', '2025-10-07 19:33:00'),
(224, 'baalMiembro2', 'baal4@demo.com', '$argon2id$v=19$m=65536,t=2,p=1$TzVRdG9nUURad0ZrVGNvNg$CDlOMQjWURxs/oSMR+DUCVu5MSEnnLtfONEN6fwdEOA', '2025-10-07 19:34:00'),
(225, 'baalMiembro3', 'baal5@demo.com', '$argon2id$v=19$m=65536,t=2,p=1$TzVRdG9nUURad0ZrVGNvNg$CDlOMQjWURxs/oSMR+DUCVu5MSEnnLtfONEN6fwdEOA', '2025-10-07 19:35:00'),
(226, 'demeterOficial1', 'demeter1@demo.com', '$argon2id$v=19$m=65536,t=2,p=1$TzVRdG9nUURad0ZrVGNvNg$CDlOMQjWURxs/oSMR+DUCVu5MSEnnLtfONEN6fwdEOA', '2025-10-07 19:36:00'),
(227, 'demeterMiembro1', 'demeter2@demo.com', '$argon2id$v=19$m=65536,t=2,p=1$TzVRdG9nUURad0ZrVGNvNg$CDlOMQjWURxs/oSMR+DUCVu5MSEnnLtfONEN6fwdEOA', '2025-10-07 19:37:00'),
(228, 'demeterMiembro2', 'demeter3@demo.com', '$argon2id$v=19$m=65536,t=2,p=1$TzVRdG9nUURad0ZrVGNvNg$CDlOMQjWURxs/oSMR+DUCVu5MSEnnLtfONEN6fwdEOA', '2025-10-07 19:38:00'),
(229, 'demeterMiembro3', 'demeter4@demo.com', '$argon2id$v=19$m=65536,t=2,p=1$TzVRdG9nUURad0ZrVGNvNg$CDlOMQjWURxs/oSMR+DUCVu5MSEnnLtfONEN6fwdEOA', '2025-10-07 19:39:00'),
(230, 'vacioOficial1', 'vacio1@demo.com', '$argon2id$v=19$m=65536,t=2,p=1$TzVRdG9nUURad0ZrVGNvNg$CDlOMQjWURxs/oSMR+DUCVu5MSEnnLtfONEN6fwdEOA', '2025-10-07 19:40:00'),
(231, 'vacioMiembro1', 'vacio2@demo.com', '$argon2id$v=19$m=65536,t=2,p=1$TzVRdG9nUURad0ZrVGNvNg$CDlOMQjWURxs/oSMR+DUCVu5MSEnnLtfONEN6fwdEOA', '2025-10-07 19:41:00'),
(232, 'vacioMiembro2', 'vacio3@demo.com', '$argon2id$v=19$m=65536,t=2,p=1$TzVRdG9nUURad0ZrVGNvNg$CDlOMQjWURxs/oSMR+DUCVu5MSEnnLtfONEN6fwdEOA', '2025-10-07 19:42:00'),
(233, 'vacioMiembro3', 'vacio4@demo.com', '$argon2id$v=19$m=65536,t=2,p=1$TzVRdG9nUURad0ZrVGNvNg$CDlOMQjWURxs/oSMR+DUCVu5MSEnnLtfONEN6fwdEOA', '2025-10-07 19:43:00'),
(234, 'furiaOficial1', 'furia1@demo.com', '$argon2id$v=19$m=65536,t=2,p=1$TzVRdG9nUURad0ZrVGNvNg$CDlOMQjWURxs/oSMR+DUCVu5MSEnnLtfONEN6fwdEOA', '2025-10-07 19:44:00'),
(235, 'furiaMiembro1', 'furia2@demo.com', '$argon2id$v=19$m=65536,t=2,p=1$TzVRdG9nUURad0ZrVGNvNg$CDlOMQjWURxs/oSMR+DUCVu5MSEnnLtfONEN6fwdEOA', '2025-10-07 19:45:00'),
(236, 'furiaMiembro2', 'furia3@demo.com', '$argon2id$v=19$m=65536,t=2,p=1$TzVRdG9nUURad0ZrVGNvNg$CDlOMQjWURxs/oSMR+DUCVu5MSEnnLtfONEN6fwdEOA', '2025-10-07 19:46:00'),
(237, 'furiaMiembro3', 'furia4@demo.com', '$argon2id$v=19$m=65536,t=2,p=1$TzVRdG9nUURad0ZrVGNvNg$CDlOMQjWURxs/oSMR+DUCVu5MSEnnLtfONEN6fwdEOA', '2025-10-07 19:47:00'),
(238, 'alasOficial1', 'alas1@demo.com', '$argon2id$v=19$m=65536,t=2,p=1$TzVRdG9nUURad0ZrVGNvNg$CDlOMQjWURxs/oSMR+DUCVu5MSEnnLtfONEN6fwdEOA', '2025-10-07 19:48:00'),
(239, 'alasMiembro1', 'alas2@demo.com', '$argon2id$v=19$m=65536,t=2,p=1$TzVRdG9nUURad0ZrVGNvNg$CDlOMQjWURxs/oSMR+DUCVu5MSEnnLtfONEN6fwdEOA', '2025-10-07 19:49:00'),
(240, 'alasMiembro2', 'alas3@demo.com', '$argon2id$v=19$m=65536,t=2,p=1$TzVRdG9nUURad0ZrVGNvNg$CDlOMQjWURxs/oSMR+DUCVu5MSEnnLtfONEN6fwdEOA', '2025-10-07 19:50:00'),
(241, 'alasMiembro3', 'alas4@demo.com', '$argon2id$v=19$m=65536,t=2,p=1$TzVRdG9nUURad0ZrVGNvNg$CDlOMQjWURxs/oSMR+DUCVu5MSEnnLtfONEN6fwdEOA', '2025-10-07 19:51:00'),
(242, 'gaiaOficial1', 'gaia1@demo.com', '$argon2id$v=19$m=65536,t=2,p=1$TzVRdG9nUURad0ZrVGNvNg$CDlOMQjWURxs/oSMR+DUCVu5MSEnnLtfONEN6fwdEOA', '2025-10-07 19:52:00'),
(243, 'gaiaMiembro1', 'gaia2@demo.com', '$argon2id$v=19$m=65536,t=2,p=1$TzVRdG9nUURad0ZrVGNvNg$CDlOMQjWURxs/oSMR+DUCVu5MSEnnLtfONEN6fwdEOA', '2025-10-07 19:53:00'),
(244, 'gaiaMiembro2', 'gaia3@demo.com', '$argon2id$v=19$m=65536,t=2,p=1$TzVRdG9nUURad0ZrVGNvNg$CDlOMQjWURxs/oSMR+DUCVu5MSEnnLtfONEN6fwdEOA', '2025-10-07 19:54:00'),
(245, 'gaiaMiembro3', 'gaia4@demo.com', '$argon2id$v=19$m=65536,t=2,p=1$TzVRdG9nUURad0ZrVGNvNg$CDlOMQjWURxs/oSMR+DUCVu5MSEnnLtfONEN6fwdEOA', '2025-10-07 19:55:00'),
(246, 'tyrOficial1', 'tyr1@demo.com', '$argon2id$v=19$m=65536,t=2,p=1$TzVRdG9nUURad0ZrVGNvNg$CDlOMQjWURxs/oSMR+DUCVu5MSEnnLtfONEN6fwdEOA', '2025-10-07 19:56:00'),
(247, 'tyrMiembro1', 'tyr2@demo.com', '$argon2id$v=19$m=65536,t=2,p=1$TzVRdG9nUURad0ZrVGNvNg$CDlOMQjWURxs/oSMR+DUCVu5MSEnnLtfONEN6fwdEOA', '2025-10-07 19:57:00'),
(248, 'tyrMiembro2', 'tyr3@demo.com', '$argon2id$v=19$m=65536,t=2,p=1$TzVRdG9nUURad0ZrVGNvNg$CDlOMQjWURxs/oSMR+DUCVu5MSEnnLtfONEN6fwdEOA', '2025-10-07 19:58:00'),
(249, 'tyrMiembro3', 'tyr4@demo.com', '$argon2id$v=19$m=65536,t=2,p=1$TzVRdG9nUURad0ZrVGNvNg$CDlOMQjWURxs/oSMR+DUCVu5MSEnnLtfONEN6fwdEOA', '2025-10-07 19:59:00'),
(250, 'tyrMiembro4', 'tyr5@demo.com', '$argon2id$v=19$m=65536,t=2,p=1$TzVRdG9nUURad0ZrVGNvNg$CDlOMQjWURxs/oSMR+DUCVu5MSEnnLtfONEN6fwdEOA', '2025-10-07 20:00:00');

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
