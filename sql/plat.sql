-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 19-05-2025 a las 22:27:26
-- Versión del servidor: 8.0.30
-- Versión de PHP: 8.4.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `plat`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `lecturas`
--

CREATE TABLE `lecturas` (
  `id_lectura` int NOT NULL,
  `nivel_luz` varchar(199) DEFAULT NULL,
  `humedad_aire` varchar(199) DEFAULT NULL,
  `temperatura` varchar(199) DEFAULT NULL,
  `humedad_suelo` varchar(199) DEFAULT NULL,
  `hora_registro` time NOT NULL DEFAULT '00:00:00',
  `fecha_registro` date DEFAULT NULL,
  `id_usuario` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `lecturas`
--

INSERT INTO `lecturas` (`id_lectura`, `nivel_luz`, `humedad_aire`, `temperatura`, `humedad_suelo`, `hora_registro`, `fecha_registro`, `id_usuario`) VALUES
(1, '20', '200', '499', '200', '03:48:49', '2025-05-19', 1),
(2, '20', '200', '499', '200', '03:49:10', '2025-05-19', 1),
(3, '20', '200', '499', '200', '21:50:59', '2025-05-18', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `id_usuario` int NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `apellidos` varchar(50) NOT NULL,
  `correo` varchar(100) NOT NULL,
  `contrasena` varchar(255) NOT NULL,
  `fecha_creacion` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `token` varchar(300) DEFAULT NULL,
  `fecha_sesion` timestamp NULL DEFAULT NULL,
  `acepto_terminos` enum('rechazo','aceptado') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id_usuario`, `nombre`, `apellidos`, `correo`, `contrasena`, `fecha_creacion`, `token`, `fecha_sesion`, `acepto_terminos`) VALUES
(1, 'Gilberto', 'Urbina', 'gilurbina09@gmail.com', '$2y$12$4xZBw6XdKXO725oxAQj5QuaoTruD/bS1Po.rt3v1tfyugx2WaIIP6', '2025-05-15 23:57:03', '45bcd12174acb3d592324fb9c9eb3d97', '2025-05-19 09:08:42', 'aceptado');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `lecturas`
--
ALTER TABLE `lecturas`
  ADD PRIMARY KEY (`id_lectura`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id_usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `lecturas`
--
ALTER TABLE `lecturas`
  MODIFY `id_lectura` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id_usuario` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `lecturas`
--
ALTER TABLE `lecturas`
  ADD CONSTRAINT `lecturas_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
