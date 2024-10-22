-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Oct 17, 2024 at 02:08 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cosmetologiabd`
--

-- --------------------------------------------------------

--
-- Table structure for table `cliente`
--

CREATE TABLE `cliente` (
  `docu_clie` bigint(12) NOT NULL,
  `nombre` varchar(30) NOT NULL,
  `apellido` varchar(30) NOT NULL,
  `email` varchar(40) NOT NULL,
  `celular` varchar(15) NOT NULL,
  `contraseña` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cliente`
--

INSERT INTO `cliente` (`docu_clie`, `nombre`, `apellido`, `email`, `celular`, `contraseña`) VALUES
(2020, 'Santiago', 'Peña Sanchez', 'penagmail@gmail.com', '13452', '2020');

-- --------------------------------------------------------

--
-- Table structure for table `factura`
--

CREATE TABLE `factura` (
  `id_factura` bigint(45) NOT NULL,
  `Total` int(15) NOT NULL,
  `Fecha` date NOT NULL,
  `docu_clie` bigint(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `f_producto`
--

CREATE TABLE `f_producto` (
  `id_f_producto` bigint(45) NOT NULL,
  `cantidad` int(15) NOT NULL,
  `id_factura` bigint(45) NOT NULL,
  `id_producto` bigint(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `f_servicio`
--

CREATE TABLE `f_servicio` (
  `id_f_servicio` bigint(45) NOT NULL,
  `cantidad` int(15) NOT NULL,
  `id_factura` bigint(45) NOT NULL,
  `id_servicio` bigint(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `producto`
--

CREATE TABLE `producto` (
  `id_producto` bigint(45) NOT NULL,
  `nombre` varchar(30) NOT NULL,
  `descripcion` varchar(250) NOT NULL,
  `precio` int(45) NOT NULL,
  `imagen` blob NOT NULL,
  `docu_prov` bigint(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `proveedor`
--

CREATE TABLE `proveedor` (
  `docu_prov` bigint(45) NOT NULL,
  `nombre` varchar(30) NOT NULL,
  `apellido` varchar(30) NOT NULL,
  `celular` varchar(15) NOT NULL,
  `email` varchar(40) NOT NULL,
  `contraseña` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `proveedor`
--

INSERT INTO `proveedor` (`docu_prov`, `nombre`, `apellido`, `celular`, `email`, `contraseña`) VALUES
(2211, 'Santiago', 'Peña Sanchez', '13452', 'cxcxfvvd@gamil.com', '2020'),
(2214, 'Santiago', 'Peña Sanchez', '13452', 'cxcxfvvd@gamil.com', '2020'),
(1098306, 'Santiago', 'Peña Sanchez', '321321', 'penasantiago2030@gmail.com', 'sa'),
(12321321, 'Santiago', 'Peña Sanchez', '13452', 'cxcxfvvd@gamil.com', '2020'),
(475752224, 'Santiago', 'Peña Sanchez', '3174324', '212321', 'sasas');

-- --------------------------------------------------------

--
-- Table structure for table `servicio`
--

CREATE TABLE `servicio` (
  `id_servicio` bigint(45) NOT NULL,
  `nombre` varchar(30) NOT NULL,
  `descripcion` varchar(250) NOT NULL,
  `precio` int(45) NOT NULL,
  `imagen` blob NOT NULL,
  `docu_prov` bigint(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`docu_clie`);

--
-- Indexes for table `factura`
--
ALTER TABLE `factura`
  ADD PRIMARY KEY (`id_factura`),
  ADD KEY `docu_clie` (`docu_clie`);

--
-- Indexes for table `f_producto`
--
ALTER TABLE `f_producto`
  ADD PRIMARY KEY (`id_f_producto`),
  ADD KEY `id_factura` (`id_factura`),
  ADD KEY `id_producto` (`id_producto`);

--
-- Indexes for table `f_servicio`
--
ALTER TABLE `f_servicio`
  ADD PRIMARY KEY (`id_f_servicio`),
  ADD KEY `id_factura` (`id_factura`),
  ADD KEY `id_servicio` (`id_servicio`);

--
-- Indexes for table `producto`
--
ALTER TABLE `producto`
  ADD PRIMARY KEY (`id_producto`),
  ADD KEY `docu_prov` (`docu_prov`);

--
-- Indexes for table `proveedor`
--
ALTER TABLE `proveedor`
  ADD PRIMARY KEY (`docu_prov`);

--
-- Indexes for table `servicio`
--
ALTER TABLE `servicio`
  ADD PRIMARY KEY (`id_servicio`),
  ADD KEY `docu_prov` (`docu_prov`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cliente`
--
ALTER TABLE `cliente`
  MODIFY `docu_clie` bigint(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1098306758;

--
-- AUTO_INCREMENT for table `factura`
--
ALTER TABLE `factura`
  MODIFY `id_factura` bigint(45) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `f_producto`
--
ALTER TABLE `f_producto`
  MODIFY `id_f_producto` bigint(45) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `f_servicio`
--
ALTER TABLE `f_servicio`
  MODIFY `id_f_servicio` bigint(45) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `producto`
--
ALTER TABLE `producto`
  MODIFY `id_producto` bigint(45) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `proveedor`
--
ALTER TABLE `proveedor`
  MODIFY `docu_prov` bigint(45) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=475752225;

--
-- AUTO_INCREMENT for table `servicio`
--
ALTER TABLE `servicio`
  MODIFY `id_servicio` bigint(45) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `factura`
--
ALTER TABLE `factura`
  ADD CONSTRAINT `factura_ibfk_1` FOREIGN KEY (`docu_clie`) REFERENCES `cliente` (`docu_clie`);

--
-- Constraints for table `f_producto`
--
ALTER TABLE `f_producto`
  ADD CONSTRAINT `f_producto_ibfk_1` FOREIGN KEY (`id_producto`) REFERENCES `producto` (`id_producto`),
  ADD CONSTRAINT `f_producto_ibfk_2` FOREIGN KEY (`id_factura`) REFERENCES `factura` (`id_factura`);

--
-- Constraints for table `f_servicio`
--
ALTER TABLE `f_servicio`
  ADD CONSTRAINT `f_servicio_ibfk_1` FOREIGN KEY (`id_servicio`) REFERENCES `servicio` (`id_servicio`),
  ADD CONSTRAINT `f_servicio_ibfk_2` FOREIGN KEY (`id_factura`) REFERENCES `factura` (`id_factura`);

--
-- Constraints for table `producto`
--
ALTER TABLE `producto`
  ADD CONSTRAINT `producto_ibfk_1` FOREIGN KEY (`docu_prov`) REFERENCES `proveedor` (`docu_prov`);

--
-- Constraints for table `servicio`
--
ALTER TABLE `servicio`
  ADD CONSTRAINT `servicio_ibfk_1` FOREIGN KEY (`docu_prov`) REFERENCES `proveedor` (`docu_prov`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
