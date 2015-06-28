-- phpMyAdmin SQL Dump
-- version 4.3.11.1
-- http://www.phpmyadmin.net
--
-- Client :  localhost:3306
-- Généré le :  Dim 19 Avril 2015 à 14:16
-- Version du serveur :  5.5.40
-- Version de PHP :  5.4.39

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données :  `rush01`
--

-- --------------------------------------------------------

--
-- Structure de la table `elements`
--

CREATE TABLE IF NOT EXISTS `elements` (
  `id` int(11) unsigned NOT NULL,
  `type` varchar(128) DEFAULT NULL,
  `x` int(12) DEFAULT NULL,
  `y` int(12) DEFAULT NULL,
  `width` int(12) DEFAULT NULL,
  `height` int(12) DEFAULT NULL,
  `mapId` int(11) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=163 DEFAULT CHARSET=utf8;

--
-- Contenu de la table `elements`
--

INSERT INTO `elements` (`id`, `type`, `x`, `y`, `width`, `height`, `mapId`) VALUES
(1, '3', 9, 99, 20, 40, 2),
(2, '3', 12, 73, 20, 20, 2),
(3, '3', 17, 95, 20, 40, 2),
(4, '3', 34, 58, 40, 10, 2),
(5, '3', 40, 98, 10, 30, 2),
(6, '3', 43, 93, 40, 30, 2),
(7, '3', 44, 64, 20, 30, 2),
(8, '3', 53, 55, 10, 30, 2),
(9, '3', 56, 99, 40, 10, 2),
(10, '3', 61, 87, 30, 20, 2),
(11, '3', 69, 15, 30, 40, 2),
(12, '3', 77, 36, 40, 40, 2),
(13, '3', 87, 64, 30, 20, 2),
(14, '3', 89, 2, 30, 10, 2),
(15, '3', 98, 82, 20, 10, 2),
(16, '3', 99, 63, 40, 20, 2),
(17, '3', 105, 44, 20, 20, 2),
(18, '3', 122, 37, 20, 30, 2),
(19, '3', 123, 11, 40, 30, 2),
(20, '3', 130, 3, 10, 10, 2),
(21, '3', 146, 25, 30, 10, 2),
(22, '3', 146, 51, 30, 40, 2),
(23, '3', 14, 56, 40, 10, NULL),
(24, '3', 27, 45, 10, 30, NULL),
(25, '3', 33, 26, 30, 30, NULL),
(26, '3', 38, 44, 20, 20, NULL),
(27, '3', 45, 95, 30, 40, NULL),
(28, '3', 53, 74, 40, 30, NULL),
(29, '3', 55, 93, 10, 20, NULL),
(30, '3', 56, 82, 20, 20, NULL),
(31, '3', 57, 59, 40, 20, NULL),
(32, '3', 57, 65, 30, 30, NULL),
(33, '3', 73, 69, 40, 10, NULL),
(34, '3', 84, 79, 30, 30, NULL),
(35, '3', 90, 65, 40, 40, NULL),
(36, '3', 92, 80, 20, 40, NULL),
(37, '3', 98, 13, 10, 20, NULL),
(38, '3', 102, 34, 10, 10, NULL),
(39, '3', 106, 82, 20, 10, NULL),
(40, '3', 106, 87, 30, 10, NULL),
(41, '3', 107, 22, 30, 20, NULL),
(42, '3', 107, 25, 40, 10, NULL),
(43, '3', 107, 68, 20, 40, NULL),
(44, '3', 111, 86, 20, 30, NULL),
(45, '3', 117, 69, 20, 40, NULL),
(46, '3', 120, 21, 10, 40, NULL),
(47, '3', 120, 52, 40, 20, NULL),
(48, '3', 121, 34, 30, 10, NULL),
(49, '3', 124, 49, 40, 30, NULL),
(50, '3', 141, 44, 30, 10, NULL),
(51, '3', 145, 59, 10, 40, NULL),
(52, '3', 1, 78, 10, 20, 34),
(53, '3', 1, 86, 10, 30, 34),
(54, '3', 9, 99, 20, 20, 34),
(55, '3', 19, 83, 30, 20, 34),
(56, '3', 19, 92, 40, 30, 34),
(57, '3', 25, 79, 40, 20, 34),
(58, '3', 25, 96, 10, 30, 34),
(59, '3', 26, 33, 20, 10, 34),
(60, '3', 26, 75, 20, 30, 34),
(61, '3', 28, 50, 10, 10, 34),
(62, '3', 41, 25, 20, 40, 34),
(63, '3', 66, 67, 40, 40, 34),
(64, '3', 73, 64, 40, 40, 34),
(65, '3', 73, 78, 30, 40, 34),
(66, '3', 75, 69, 10, 10, 34),
(67, '3', 78, 19, 30, 10, 34),
(68, '3', 85, 68, 10, 30, 34),
(69, '3', 87, 86, 40, 20, 34),
(70, '3', 90, 49, 30, 20, 34),
(71, '3', 91, 42, 40, 10, 34),
(72, '3', 95, 51, 20, 40, 34),
(73, '3', 103, 89, 10, 20, 34),
(74, '3', 112, 86, 20, 20, 34),
(75, '3', 115, 97, 30, 20, 34),
(76, '3', 136, 64, 20, 30, 34),
(77, '3', 8, 91, 20, 30, 35),
(78, '3', 9, 76, 40, 20, 35),
(79, '3', 11, 94, 10, 30, 35),
(80, '3', 14, 84, 40, 30, 35),
(81, '3', 18, 32, 30, 40, 35),
(82, '3', 30, 41, 30, 40, 35),
(83, '3', 32, 49, 10, 10, 35),
(84, '3', 36, 87, 20, 40, 35),
(85, '3', 38, 87, 40, 20, 35),
(86, '3', 48, 43, 40, 40, 35),
(87, '3', 52, 18, 40, 40, 35),
(88, '3', 56, 15, 40, 20, 35),
(89, '3', 70, 28, 10, 40, 35),
(90, '3', 83, 6, 20, 10, 35),
(91, '3', 83, 95, 30, 30, 35),
(92, '3', 90, 5, 30, 10, 35),
(93, '3', 106, 58, 20, 20, 35),
(94, '3', 129, 42, 20, 40, 35),
(95, '3', 131, 5, 20, 20, 35),
(96, '3', 140, 54, 10, 40, 35),
(97, '3', 143, 50, 10, 30, 35),
(98, '3', 1, 76, 10, 30, 36),
(99, '3', 5, 37, 30, 30, 36),
(100, '3', 16, 57, 20, 30, 36),
(101, '3', 17, 80, 30, 10, 36),
(102, '3', 17, 94, 20, 20, 36),
(103, '3', 18, 62, 20, 30, 36),
(104, '3', 32, 51, 20, 10, 36),
(105, '3', 40, 45, 10, 30, 36),
(106, '3', 43, 88, 20, 40, 36),
(107, '3', 46, 43, 20, 40, 36),
(108, '3', 50, 93, 40, 40, 36),
(109, '3', 52, 38, 30, 30, 36),
(110, '3', 64, 39, 30, 30, 36),
(111, '3', 71, 66, 10, 20, 36),
(112, '3', 73, 91, 30, 10, 36),
(113, '3', 78, 89, 10, 10, 36),
(114, '3', 82, 30, 10, 10, 36),
(115, '3', 86, 13, 20, 10, 36),
(116, '3', 91, 61, 30, 40, 36),
(117, '3', 92, 8, 30, 40, 36),
(118, '3', 93, 47, 30, 20, 36),
(119, '3', 110, 19, 20, 20, 36),
(120, '3', 110, 67, 30, 40, 36),
(121, '3', 111, 11, 10, 20, 36),
(122, '3', 113, 71, 30, 30, 36),
(123, '3', 119, 51, 30, 40, 36),
(124, '3', 120, 56, 30, 30, 36),
(125, '3', 123, 33, 10, 40, 36),
(126, '3', 125, 55, 30, 20, 36),
(127, '3', 131, 67, 30, 10, 36),
(128, '3', 138, 11, 30, 30, 36),
(129, '3', 139, 49, 10, 30, 36),
(130, '3', 140, 37, 40, 30, 36),
(131, '3', 146, 47, 10, 30, 36),
(132, '3', 148, 60, 40, 40, 36),
(133, '3', 14, 44, 40, 40, 37),
(134, '3', 18, 72, 30, 20, 37),
(135, '3', 33, 40, 20, 40, 37),
(136, '3', 34, 2, 10, 30, 37),
(137, '3', 39, 11, 30, 10, 37),
(138, '3', 43, 81, 40, 40, 37),
(139, '3', 59, 32, 20, 40, 37),
(140, '3', 60, 11, 20, 20, 37),
(141, '3', 66, 76, 20, 10, 37),
(142, '3', 80, 51, 30, 40, 37),
(143, '3', 90, 93, 40, 40, 37),
(144, '3', 95, 85, 40, 40, 37),
(145, '3', 108, 13, 20, 30, 37),
(146, '3', 109, 84, 20, 20, 37),
(147, '3', 117, 60, 10, 30, 37),
(148, '3', 124, 65, 10, 30, 37),
(149, '3', 138, 61, 20, 40, 37),
(150, '3', 147, 34, 30, 40, 37),
(151, '3', 10, 68, 20, 20, 38),
(152, '3', 23, 32, 30, 20, 38),
(153, '3', 45, 83, 20, 20, 38),
(154, '3', 52, 69, 20, 20, 38),
(155, '3', 77, 13, 30, 20, 38),
(156, '3', 80, 74, 10, 40, 38),
(157, '3', 89, 4, 20, 30, 38),
(158, '3', 96, 20, 10, 40, 38),
(159, '3', 96, 47, 40, 30, 38),
(160, '3', 100, 78, 40, 20, 38),
(161, '3', 106, 48, 30, 20, 38),
(162, '3', 116, 74, 10, 20, 38);

-- --------------------------------------------------------

--
-- Structure de la table `events`
--

CREATE TABLE IF NOT EXISTS `events` (
  `id` int(11) unsigned NOT NULL,
  `gameId` int(11) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `data` int(11) DEFAULT NULL,
  `timestamp` int(11) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=utf8;

--
-- Contenu de la table `events`
--

INSERT INTO `events` (`id`, `gameId`, `name`, `data`, `timestamp`) VALUES
(3, 4, 'test', 0, 1429449993),
(4, 4, 'test2', 0, 1429450110),
(5, 0, NULL, NULL, 1429474040),
(6, 8, 'ship_moved', 5, 1429474040),
(7, 8, 'ship_moved', 5, 1429474334),
(8, 8, 'ship_moved', 5, 1429474462),
(9, 8, 'ship_moved', 5, 1429474509),
(10, 8, 'ship_moved', 5, 1429474541),
(11, 8, 'ship_moved', 5, 1429474691),
(12, 8, 'ship_moved', 5, 1429474719),
(13, 8, 'ship_moved', 5, 1429474904),
(14, 8, 'ship_moved', 5, 1429475230),
(15, 8, 'ship_moved', 5, 1429475271),
(16, 8, 'ship_moved', 5, 1429475303),
(17, 8, 'ship_moved', 5, 1429475368),
(18, 8, 'ship_moved', 5, 1429475426),
(19, 8, 'ship_moved', 5, 1429475456),
(20, 8, 'ship_moved', 5, 1429475475),
(21, 8, 'ship_moved', 5, 1429475669),
(22, 8, 'ship_moved', 5, 1429475725),
(23, 8, 'ship_moved', 5, 1429475895),
(24, 8, 'ship_moved', 5, 1429476271),
(25, 8, 'ship_moved', 5, 1429476271),
(26, 8, 'ship_moved', 5, 1429476344),
(27, 8, 'ship_moved', 5, 1429476357),
(28, 8, 'ship_moved', 5, 1429476378),
(29, 8, 'ship_moved', 5, 1429476449),
(30, 8, 'ship_moved', 5, 1429476505),
(31, 8, 'ship_moved', 5, 1429476556),
(32, 8, 'ship_moved', 5, 1429476611),
(33, 8, 'ship_moved', 5, 1429476706),
(34, 8, 'ship_moved', 5, 1429476734),
(35, 8, 'ship_moved', 5, 1429476751),
(36, 8, 'ship_moved', 5, 1429476783),
(37, 8, 'ship_moved', 5, 1429476800);

-- --------------------------------------------------------

--
-- Structure de la table `games`
--

CREATE TABLE IF NOT EXISTS `games` (
  `id` int(11) unsigned NOT NULL,
  `timestamp` int(12) DEFAULT NULL,
  `winnerId` int(12) DEFAULT NULL,
  `state` int(12) NOT NULL DEFAULT '0',
  `playerTurn` int(12) DEFAULT NULL,
  `mapId` int(11) DEFAULT NULL,
  `bigTurn` int(11) DEFAULT NULL,
  `smallTurn` int(11) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

--
-- Contenu de la table `games`
--

INSERT INTO `games` (`id`, `timestamp`, `winnerId`, `state`, `playerTurn`, `mapId`, `bigTurn`, `smallTurn`) VALUES
(1, NULL, 0, 0, 0, 31, 0, 0),
(2, NULL, 0, 0, 0, 32, 0, 0),
(3, NULL, 0, 0, 0, 33, 0, 0),
(4, NULL, 0, 0, 0, 34, 0, 0),
(5, NULL, 0, 0, 0, 35, 0, 0),
(6, NULL, 0, 0, 0, 36, 0, 0),
(7, NULL, 0, 0, 0, 37, 0, 0),
(8, NULL, 0, 0, 0, 38, 0, 0);

-- --------------------------------------------------------

--
-- Structure de la table `maps`
--

CREATE TABLE IF NOT EXISTS `maps` (
  `id` int(11) unsigned NOT NULL,
  `width` int(12) DEFAULT NULL,
  `height` int(12) DEFAULT NULL,
  `state` int(12) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=utf8;

--
-- Contenu de la table `maps`
--

INSERT INTO `maps` (`id`, `width`, `height`, `state`) VALUES
(1, 150, 100, 0),
(2, 150, 100, 0),
(3, 150, 100, 0),
(4, 150, 100, 0),
(5, 150, 100, 0),
(6, 150, 100, 0),
(7, 150, 100, 0),
(8, 150, 100, 0),
(9, 150, 100, 0),
(10, 150, 100, 0),
(11, 150, 100, 0),
(12, 150, 100, 0),
(13, 150, 100, 0),
(14, 150, 100, 0),
(15, 150, 100, 0),
(16, 150, 100, 0),
(17, 150, 100, 0),
(18, 150, 100, 0),
(19, 150, 100, 0),
(20, 150, 100, 0),
(21, 150, 100, 0),
(22, 150, 100, 0),
(23, 150, 100, 0),
(24, 150, 100, 0),
(25, 150, 100, 0),
(26, 150, 100, 0),
(27, 150, 100, 0),
(28, 150, 100, 0),
(29, 150, 100, 0),
(30, 150, 100, 0),
(31, 150, 100, 0),
(32, 150, 100, 0),
(33, 150, 100, 0),
(34, 150, 100, 0),
(35, 150, 100, 0),
(36, 150, 100, 0),
(37, 150, 100, 0),
(38, 150, 100, 0);

-- --------------------------------------------------------

--
-- Structure de la table `players`
--

CREATE TABLE IF NOT EXISTS `players` (
  `id` int(11) unsigned NOT NULL,
  `userId` int(12) DEFAULT NULL,
  `gameId` int(12) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Contenu de la table `players`
--

INSERT INTO `players` (`id`, `userId`, `gameId`) VALUES
(1, 1, 5),
(2, 1, 6),
(3, 1, 7),
(4, 1, 8);

-- --------------------------------------------------------

--
-- Structure de la table `savings`
--

CREATE TABLE IF NOT EXISTS `savings` (
  `id` int(11) unsigned NOT NULL,
  `timestamp` int(12) DEFAULT NULL,
  `userId` int(12) DEFAULT NULL,
  `gameId` int(12) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `ships`
--

CREATE TABLE IF NOT EXISTS `ships` (
  `id` int(11) unsigned NOT NULL,
  `idShipsModel` int(11) DEFAULT NULL,
  `playerID` int(11) DEFAULT NULL,
  `posX` int(11) DEFAULT NULL,
  `posY` int(11) DEFAULT NULL,
  `orientation` int(11) DEFAULT NULL,
  `moving` int(11) DEFAULT NULL,
  `pp` int(11) DEFAULT '0',
  `hull` int(11) DEFAULT '0',
  `shield` int(11) DEFAULT '0',
  `state` int(11) DEFAULT '1',
  `speed` int(11) DEFAULT NULL,
  `bigTurn` int(11) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8;

--
-- Contenu de la table `ships`
--

INSERT INTO `ships` (`id`, `idShipsModel`, `playerID`, `posX`, `posY`, `orientation`, `moving`, `pp`, `hull`, `shield`, `state`, `speed`, `bigTurn`) VALUES
(1, 1, 1, 10, 10, 0, 0, 0, 0, 0, 1, 0, 0),
(2, 1, 1, 20, 10, 0, 0, 0, 0, 0, 1, 0, 0),
(3, 1, 1, 30, 10, 0, 0, 0, 0, 0, 1, 0, 0),
(4, 1, 1, 10, 20, 0, 0, 0, 0, 0, 1, 0, 0),
(5, 1, 1, 26, 30, 0, 0, 0, 0, 0, 1, 0, 0),
(6, 1, 1, 30, 30, 0, 0, 0, 0, 0, 1, 0, 0),
(7, 1, 2, 10, 10, 0, 0, 0, 0, 0, 1, 0, 0),
(8, 1, 2, 20, 10, 0, 0, 0, 0, 0, 1, 0, 0),
(9, 1, 2, 30, 10, 0, 0, 0, 0, 0, 1, 0, 0),
(10, 1, 2, 10, 20, 0, 0, 0, 0, 0, 1, 0, 0),
(11, 1, 2, 10, 30, 0, 0, 0, 0, 0, 1, 0, 0),
(12, 1, 2, 30, 30, 0, 0, 0, 0, 0, 1, 0, 0),
(13, 1, 3, 10, 10, 0, 0, 0, 0, 0, 1, 0, 0),
(14, 1, 3, 20, 10, 0, 0, 0, 0, 0, 1, 0, 0),
(15, 1, 3, 30, 10, 0, 0, 0, 0, 0, 1, 0, 0),
(16, 1, 3, 10, 20, 0, 0, 0, 0, 0, 1, 0, 0),
(17, 1, 3, 10, 30, 0, 0, 0, 0, 0, 1, 0, 0),
(18, 1, 3, 30, 30, 0, 0, 0, 0, 0, 1, 0, 0),
(19, 1, 4, 10, 10, 0, 0, 0, 0, 0, 1, 0, 0),
(20, 1, 4, 20, 10, 0, 0, 0, 0, 0, 1, 0, 0),
(21, 1, 4, 30, 10, 0, 0, 0, 0, 0, 1, 0, 0),
(22, 1, 4, 10, 20, 0, 0, 0, 0, 0, 1, 0, 0),
(23, 1, 4, 10, 30, 0, 0, 0, 0, 0, 1, 0, 0),
(24, 1, 4, 30, 30, 0, 0, 0, 0, 0, 1, 0, 0);

-- --------------------------------------------------------

--
-- Structure de la table `shipsmodel`
--

CREATE TABLE IF NOT EXISTS `shipsmodel` (
  `id` int(11) unsigned NOT NULL,
  `name` varchar(512) DEFAULT NULL,
  `width` int(12) DEFAULT NULL,
  `height` int(12) DEFAULT NULL,
  `sprite` varchar(512) DEFAULT NULL,
  `defaultPp` int(12) DEFAULT '0',
  `defaultHull` int(12) DEFAULT '0',
  `defaultShield` int(12) DEFAULT '0',
  `inertia` int(12) DEFAULT '0',
  `speed` int(12) DEFAULT '0',
  `category` varchar(512) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- Contenu de la table `shipsmodel`
--

INSERT INTO `shipsmodel` (`id`, `name`, `width`, `height`, `sprite`, `defaultPp`, `defaultHull`, `defaultShield`, `inertia`, `speed`, `category`) VALUES
(1, 'Honorable Duty', 1, 4, 'a', 10, 5, 0, 4, 15, 'Fregate Imperiale'),
(2, 'Sword of Absolution', 1, 3, 'b', 10, 4, 0, 3, 18, 'Destroyer Imperial'),
(3, 'Hand Of The Emperor', 1, 4, 'c', 10, 5, 0, 4, 15, 'Fregate Imperial'),
(4, 'Imperator Deus', 2, 7, 'd', 12, 8, 2, 5, 10, 'Cuirasse Imperial'),
(5, 'Orktobre Roug', 1, 2, 'e', 10, 4, 0, 3, 19, 'Vesso d''attak Ravajeur Ork'),
(6, 'Ork''N''Roll', 1, 5, 'f', 10, 6, 0, 4, 12, 'Vesso d''attak Explozeur Ork');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) unsigned NOT NULL,
  `login` varchar(128) DEFAULT NULL,
  `password` varchar(512) DEFAULT NULL,
  `timestamp` int(12) DEFAULT NULL,
  `gameWon` int(12) DEFAULT NULL,
  `gameLost` int(12) DEFAULT NULL,
  `email` varchar(128) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

--
-- Contenu de la table `users`
--

INSERT INTO `users` (`id`, `login`, `password`, `timestamp`, `gameWon`, `gameLost`, `email`) VALUES
(1, 'nicos', '68dfcebb4f25e64ac343ff1a93fb9bcf', NULL, NULL, NULL, NULL),
(2, 'nicos2', '68dfcebb4f25e64ac343ff1a93fb9bcf', NULL, NULL, NULL, NULL),
(3, 'test', '68dfcebb4f25e64ac343ff1a93fb9bcf', NULL, NULL, NULL, NULL),
(4, 'tefd', '68dfcebb4f25e64ac343ff1a93fb9bcf', NULL, NULL, NULL, NULL),
(5, 'egfd', '808c586d366c556a762218388bc52e87', NULL, NULL, NULL, NULL),
(6, 'tetsfv', '808c586d366c556a762218388bc52e87', NULL, NULL, NULL, NULL),
(7, 'testfc', '808c586d366c556a762218388bc52e87', NULL, NULL, NULL, NULL),
(8, 'tets', '0df28b09707ec749c400b40fc33a20a3', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `weapons`
--

CREATE TABLE IF NOT EXISTS `weapons` (
  `id` int(11) unsigned NOT NULL,
  `idWeaponsModel` int(11) DEFAULT NULL,
  `charge` int(12) DEFAULT '0',
  `shipId` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `weaponsmodel`
--

CREATE TABLE IF NOT EXISTS `weaponsmodel` (
  `id` int(11) unsigned NOT NULL,
  `name` varchar(528) DEFAULT NULL,
  `shortRange` int(12) DEFAULT '0',
  `mediumRange` int(12) DEFAULT '0',
  `longRange` int(12) DEFAULT '0',
  `defaultCharge` int(12) DEFAULT '0',
  `dispersion` int(12) DEFAULT '0',
  `width` int(12) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Contenu de la table `weaponsmodel`
--

INSERT INTO `weaponsmodel` (`id`, `name`, `shortRange`, `mediumRange`, `longRange`, `defaultCharge`, `dispersion`, `width`) VALUES
(1, 'Batterie laser de flancs', 10, 20, 30, 0, 1, 2),
(2, 'Lance navale', 30, 60, 90, 0, 0, 1),
(3, 'Lance navale lourde', 30, 60, 90, 3, 0, 3),
(4, 'Mitrailleuses super lourdes de proximite', 3, 7, 10, 5, 5, 1),
(5, 'Macro canon', 10, 20, 30, 0, 3, 2);

-- --------------------------------------------------------

--
-- Structure de la table `weaponsshipsrelations`
--

CREATE TABLE IF NOT EXISTS `weaponsshipsrelations` (
  `id` int(11) unsigned NOT NULL,
  `weaponId` int(11) DEFAULT NULL,
  `shipId` int(11) DEFAULT NULL,
  `posX` int(11) DEFAULT NULL,
  `posY` int(11) DEFAULT NULL,
  `orientation` int(11) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

--
-- Contenu de la table `weaponsshipsrelations`
--

INSERT INTO `weaponsshipsrelations` (`id`, `weaponId`, `shipId`, `posX`, `posY`, `orientation`) VALUES
(1, 1, 1, NULL, NULL, NULL),
(2, 1, 2, NULL, NULL, NULL),
(3, 2, 3, NULL, NULL, NULL),
(4, 2, 4, NULL, NULL, NULL),
(5, 2, 4, NULL, NULL, NULL),
(6, 1, 5, NULL, NULL, NULL),
(7, 4, 6, NULL, NULL, NULL),
(8, 5, 6, NULL, NULL, NULL);

--
-- Index pour les tables exportées
--

--
-- Index pour la table `elements`
--
ALTER TABLE `elements`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `games`
--
ALTER TABLE `games`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `maps`
--
ALTER TABLE `maps`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `players`
--
ALTER TABLE `players`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `savings`
--
ALTER TABLE `savings`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `ships`
--
ALTER TABLE `ships`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `shipsmodel`
--
ALTER TABLE `shipsmodel`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `weapons`
--
ALTER TABLE `weapons`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `weaponsmodel`
--
ALTER TABLE `weaponsmodel`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `weaponsshipsrelations`
--
ALTER TABLE `weaponsshipsrelations`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `elements`
--
ALTER TABLE `elements`
  MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=163;
--
-- AUTO_INCREMENT pour la table `events`
--
ALTER TABLE `events`
  MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=38;
--
-- AUTO_INCREMENT pour la table `games`
--
ALTER TABLE `games`
  MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT pour la table `maps`
--
ALTER TABLE `maps`
  MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=39;
--
-- AUTO_INCREMENT pour la table `players`
--
ALTER TABLE `players`
  MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT pour la table `savings`
--
ALTER TABLE `savings`
  MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `ships`
--
ALTER TABLE `ships`
  MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=25;
--
-- AUTO_INCREMENT pour la table `shipsmodel`
--
ALTER TABLE `shipsmodel`
  MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT pour la table `weapons`
--
ALTER TABLE `weapons`
  MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `weaponsmodel`
--
ALTER TABLE `weaponsmodel`
  MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT pour la table `weaponsshipsrelations`
--
ALTER TABLE `weaponsshipsrelations`
  MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
