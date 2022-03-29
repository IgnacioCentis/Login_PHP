-- phpMyAdmin SQL Dump
-- version 4.6.6
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 29-03-2022 a las 20:47:01
-- Versión del servidor: 5.7.15-log
-- Versión de PHP: 5.6.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `login`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user`
--

CREATE TABLE `user` (
  `pkuser` int(10) NOT NULL,
  `dni` int(8) NOT NULL,
  `password` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `user_name` varchar(100) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `user_status` tinyint(1) NOT NULL COMMENT '0 Suspend 1 Active',
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'date of last modification'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `user`
--

INSERT INTO `user` (`pkuser`, `dni`, `password`, `user_name`, `user_status`, `date`) VALUES
(14, 123, '$2y$10$QVdlrJXRx9xvW5Q3gOBVw.bTyKBQLkAc7jZJZm6rIAhm/dex5ZdHS', 'nacho', 1, '2022-03-28 02:56:02'),
(28, 32733122, '$2y$10$Bdisy.lYtgE3Pm1FUecMdOgi2HnApObW70heePOJeqezKBGFM4.zi', 'leo', 2, '2022-03-28 14:20:03'),
(30, 222, '$2y$10$Bdisy.lYtgE3Pm1FUecMdOgi2HnApObW70heePOJeqezKBGFM4.zi', 'patitos', 1, '2022-03-29 12:06:37'),
(33, 32733129, '$2y$10$/JdBTuzVEdehV6dnUJ.OF.ovlUXu9Zjov4rYvWmyJTUbp1hw1Nycm', 'carlos', 1, '2022-03-29 19:14:11');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user_log`
--

CREATE TABLE `user_log` (
  `pkuser_log` int(10) NOT NULL,
  `fkuser` int(10) NOT NULL,
  `ip` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `localhost` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `browser` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `login` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `logout` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `user_log`
--

INSERT INTO `user_log` (`pkuser_log`, `fkuser`, `ip`, `localhost`, `browser`, `login`, `logout`) VALUES
(1, 30, '::1', 'aspire', 'Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/99.0.4844.51 ', '2022-03-29 20:46:36', '2022-03-29 17:46:37'),
(2, 14, '::1', 'aspire', 'Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/99.0.4844.51 ', '2022-03-29 20:46:51', '2022-03-29 17:46:52');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`pkuser`),
  ADD KEY `dni` (`dni`);

--
-- Indices de la tabla `user_log`
--
ALTER TABLE `user_log`
  ADD PRIMARY KEY (`pkuser_log`),
  ADD KEY `fkuser` (`fkuser`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `user`
--
ALTER TABLE `user`
  MODIFY `pkuser` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;
--
-- AUTO_INCREMENT de la tabla `user_log`
--
ALTER TABLE `user_log`
  MODIFY `pkuser_log` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
