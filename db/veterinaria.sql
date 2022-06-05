-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 05-06-2022 a las 01:02:50
-- Versión del servidor: 5.7.38-cll-lve
-- Versión de PHP: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `changcus_veterinaria`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `consultas`
--

CREATE TABLE `consultas` (
  `id` int(11) NOT NULL,
  `paciente` int(11) NOT NULL,
  `edadmeses` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `motivos` text NOT NULL,
  `padecimientos` text NOT NULL,
  `observ` text NOT NULL,
  `medicamento` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `net`
--

CREATE TABLE `net` (
  `username` varchar(255) NOT NULL,
  `nombre` varchar(200) CHARACTER SET utf8 NOT NULL,
  `tipo` int(11) DEFAULT NULL,
  `hsh` varchar(255) NOT NULL,
  `elim` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `net`
--

INSERT INTO `net` (`username`, `nombre`, `tipo`, `hsh`, `elim`) VALUES
('Admin', 'Admin', 3, '$2y$10$MBFP40PUj2NfQZ5i.LYQzuExjZ5Cosu8bAtzMcTmpuusccu71eNFW', 0),
('Fernando', 'Fernando Trujillo', 3, '$2y$10$Ei72YvZ7VlkDDcYTkYgdq.GjNoUWWiXypW../BX2HXFKo5Nxs1lSm', 0),
('Invitado', 'Invitado', 1, '$2y$10$s1o15B./XZr2Lx.TwQGMjuR2AYAhz18LGkqhcfdI3y6QnDJLOCSk6', 0),
('Prueba', 'Prueba', 1, '$2y$10$HYa/CtgC33VWLHyrTlIoYedmkTpOu4ocKqv3sTM9kzW7uRD04UohW', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `net_tipo`
--

CREATE TABLE `net_tipo` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `net_tipo`
--

INSERT INTO `net_tipo` (`id`, `nombre`) VALUES
(1, 'Invitado'),
(3, 'Administrador');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pacientes`
--

CREATE TABLE `pacientes` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `numcontacto` varchar(50) NOT NULL,
  `tipo` varchar(255) NOT NULL,
  `fechanac` date NOT NULL,
  `elim` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipos`
--

CREATE TABLE `tipos` (
  `id` int(11) NOT NULL,
  `tipo` varchar(255) NOT NULL,
  `elim` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `consultas`
--
ALTER TABLE `consultas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `net`
--
ALTER TABLE `net`
  ADD PRIMARY KEY (`username`),
  ADD KEY `tipo` (`tipo`);

--
-- Indices de la tabla `net_tipo`
--
ALTER TABLE `net_tipo`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `pacientes`
--
ALTER TABLE `pacientes`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tipos`
--
ALTER TABLE `tipos`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `consultas`
--
ALTER TABLE `consultas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `net_tipo`
--
ALTER TABLE `net_tipo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `pacientes`
--
ALTER TABLE `pacientes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `tipos`
--
ALTER TABLE `tipos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `net`
--
ALTER TABLE `net`
  ADD CONSTRAINT `tipo` FOREIGN KEY (`tipo`) REFERENCES `net_tipo` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
