-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 24-10-2024 a las 03:44:39
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
-- Base de datos: `cosmetologiabd`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente`
--

CREATE TABLE `cliente` (
  `docu_clie` bigint(12) NOT NULL,
  `nombre` varchar(30) NOT NULL,
  `apellido` varchar(255) NOT NULL,
  `email` varchar(40) NOT NULL,
  `celular` varchar(50) NOT NULL,
  `contraseña` varchar(90) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `cliente`
--

INSERT INTO `cliente` (`docu_clie`, `nombre`, `apellido`, `email`, `celular`, `contraseña`) VALUES
(20209121, 'sipi', '$2y$10$xPjc.Hw0zORxC2Ah6M5xoupEFIobVh5SMORXhmjurBBn46vtD3Pbq', 'sa@gmail.com', '1', 'santiagops2019@gmail.com'),
(1234567890, 'cristian', 'pena', 'penasantiago2030@gmail.com', '318699', '$2y$10$x0d9AWAHyghEvjS8fncMmOk6wAgBetPqSvaJJQnUzQ7eXGSvJXfnW'),
(12342323232, 'Santiago ', 'Peña', 'penasantiago2030@gmail.com', '3205679', '$2y$10$CNAq/w1O41gZVFyQY7NPL.DgnLmTX6ifFjv1rD1nIqjYGDl4rV1RW'),
(20209244513, 'sjHVBSH', 'Pérez', 'penasantiago2030@gmail.com', '3205677966', '$2y$10$CLB/rzFtkXiPzd16t.4tXe0qjiSLlF6XqF62YHatQnowjuEuR18ay'),
(232323232323, 'Andrea', 'Peña', 'andrea@gmail.com', '3122233445546575', '$2y$10$4t9CFs.7GU5nxV9BLqQrWewyQgftsqwDy7zoRhuJU8knu0JeBJTW.'),
(1234232323211, 'ZZZZ', 'Peña', 'penasantiago2030@gmail.com', '3205679', '$2y$10$Npzxp8WLNN7qWgLcvk3h/eqIy2c0SWCSpNY6E..JCk4KX2xf8hD02');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `factura`
--

CREATE TABLE `factura` (
  `id_factura` bigint(45) NOT NULL,
  `Total` int(15) NOT NULL,
  `Fecha` date NOT NULL,
  `docu_clie` bigint(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `f_producto`
--

CREATE TABLE `f_producto` (
  `id_f_producto` bigint(45) NOT NULL,
  `cantidad` int(15) NOT NULL,
  `id_factura` bigint(45) NOT NULL,
  `id_producto` bigint(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `f_servicio`
--

CREATE TABLE `f_servicio` (
  `id_f_servicio` bigint(45) NOT NULL,
  `cantidad` int(15) NOT NULL,
  `id_factura` bigint(45) NOT NULL,
  `id_servicio` bigint(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

CREATE TABLE `producto` (
  `id_producto` bigint(45) NOT NULL,
  `nombre` varchar(30) NOT NULL,
  `descripcion` varchar(250) NOT NULL,
  `precio` int(45) NOT NULL,
  `imagen` blob NOT NULL,
  `docu_prov` bigint(45) NOT NULL,
  `stock` int(11) NOT NULL,
  `categoria` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `producto`
--

INSERT INTO `producto` (`id_producto`, `nombre`, `descripcion`, `precio`, `imagen`, `docu_prov`, `stock`, `categoria`) VALUES
(35, 'Productos', 'Buenos', 2000, 0x2e2e2f494d414745532f3239323630382d5038424247462d31302e6a7067, 1, 3, 'Belleza');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedor`
--

CREATE TABLE `proveedor` (
  `docu_prov` bigint(45) NOT NULL,
  `nombre` varchar(30) NOT NULL,
  `apellido` varchar(30) NOT NULL,
  `celular` varchar(15) NOT NULL,
  `email` varchar(40) NOT NULL,
  `contraseña` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `proveedor`
--

INSERT INTO `proveedor` (`docu_prov`, `nombre`, `apellido`, `celular`, `email`, `contraseña`) VALUES
(1, 'Juan', 'Pérez', '123456789', 'juan.perez@example.com', '123');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `servicio`
--

CREATE TABLE `servicio` (
  `id_servicio` bigint(45) NOT NULL,
  `nombre` varchar(30) NOT NULL,
  `descripcion` varchar(250) NOT NULL,
  `precio` int(45) NOT NULL,
  `imagen` varchar(400) NOT NULL,
  `docu_prov` bigint(45) NOT NULL,
  `categoria` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `servicio`
--

INSERT INTO `servicio` (`id_servicio`, `nombre`, `descripcion`, `precio`, `imagen`, `docu_prov`, `categoria`) VALUES
(3, 'ROPA', 'bhsankl', 12345, '0', 1, 'opq'),
(4, 'ROPA', 'bhsankl', 12345, '0', 1, 'opq'),
(5, 'ROPA', 'bhsankl', 12345, '../IMAGES/Captura desde 2024-09-19 18-41-43.png', 1, 'opq');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`docu_clie`);

--
-- Indices de la tabla `factura`
--
ALTER TABLE `factura`
  ADD PRIMARY KEY (`id_factura`),
  ADD KEY `docu_clie` (`docu_clie`);

--
-- Indices de la tabla `f_producto`
--
ALTER TABLE `f_producto`
  ADD PRIMARY KEY (`id_f_producto`),
  ADD KEY `id_factura` (`id_factura`),
  ADD KEY `id_producto` (`id_producto`);

--
-- Indices de la tabla `f_servicio`
--
ALTER TABLE `f_servicio`
  ADD PRIMARY KEY (`id_f_servicio`),
  ADD KEY `id_factura` (`id_factura`),
  ADD KEY `id_servicio` (`id_servicio`);

--
-- Indices de la tabla `producto`
--
ALTER TABLE `producto`
  ADD PRIMARY KEY (`id_producto`),
  ADD KEY `docu_prov` (`docu_prov`);

--
-- Indices de la tabla `proveedor`
--
ALTER TABLE `proveedor`
  ADD PRIMARY KEY (`docu_prov`);

--
-- Indices de la tabla `servicio`
--
ALTER TABLE `servicio`
  ADD PRIMARY KEY (`id_servicio`),
  ADD KEY `docu_prov` (`docu_prov`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `factura`
--
ALTER TABLE `factura`
  MODIFY `id_factura` bigint(45) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `f_producto`
--
ALTER TABLE `f_producto`
  MODIFY `id_f_producto` bigint(45) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `f_servicio`
--
ALTER TABLE `f_servicio`
  MODIFY `id_f_servicio` bigint(45) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `producto`
--
ALTER TABLE `producto`
  MODIFY `id_producto` bigint(45) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT de la tabla `servicio`
--
ALTER TABLE `servicio`
  MODIFY `id_servicio` bigint(45) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `factura`
--
ALTER TABLE `factura`
  ADD CONSTRAINT `factura_ibfk_1` FOREIGN KEY (`docu_clie`) REFERENCES `cliente` (`docu_clie`);

--
-- Filtros para la tabla `f_producto`
--
ALTER TABLE `f_producto`
  ADD CONSTRAINT `f_producto_ibfk_1` FOREIGN KEY (`id_producto`) REFERENCES `producto` (`id_producto`),
  ADD CONSTRAINT `f_producto_ibfk_2` FOREIGN KEY (`id_factura`) REFERENCES `factura` (`id_factura`);

--
-- Filtros para la tabla `f_servicio`
--
ALTER TABLE `f_servicio`
  ADD CONSTRAINT `f_servicio_ibfk_1` FOREIGN KEY (`id_servicio`) REFERENCES `servicio` (`id_servicio`),
  ADD CONSTRAINT `f_servicio_ibfk_2` FOREIGN KEY (`id_factura`) REFERENCES `factura` (`id_factura`);

--
-- Filtros para la tabla `producto`
--
ALTER TABLE `producto`
  ADD CONSTRAINT `producto_ibfk_1` FOREIGN KEY (`docu_prov`) REFERENCES `proveedor` (`docu_prov`);

--
-- Filtros para la tabla `servicio`
--
ALTER TABLE `servicio`
  ADD CONSTRAINT `servicio_ibfk_1` FOREIGN KEY (`docu_prov`) REFERENCES `proveedor` (`docu_prov`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
