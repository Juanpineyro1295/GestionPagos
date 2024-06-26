-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 21, 2023 at 05:59 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gestiondepagos`
--

-- --------------------------------------------------------

--
-- Table structure for table `cliente`
--

CREATE TABLE `cliente` (
  `dni_cliente` int(11) NOT NULL,
  `cliente_nombre` varchar(50) NOT NULL,
  `cliente_apellido` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cliente`
--

INSERT INTO `cliente` (`dni_cliente`, `cliente_nombre`, `cliente_apellido`) VALUES
(11111111, 'Martin Alejandro', 'Pirez');

-- --------------------------------------------------------

--
-- Table structure for table `cuota`
--

CREATE TABLE `cuota` (
  `id_cuota` int(11) NOT NULL,
  `id_usuario_alumno` int(11) NOT NULL,
  `cuota_fecha` date NOT NULL DEFAULT current_timestamp(),
  `cuota_monto` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cuota`
--

INSERT INTO `cuota` (`id_cuota`, `id_usuario_alumno`, `cuota_fecha`, `cuota_monto`) VALUES
(1, 3, '2023-05-03', 1500),
(2, 3, '2023-06-04', 3500),
(3, 3, '2023-06-21', 3500);

-- --------------------------------------------------------

--
-- Table structure for table `cuota_detalle`
--

CREATE TABLE `cuota_detalle` (
  `id_cuota_detalle` int(11) NOT NULL,
  `id_cuota` int(11) NOT NULL,
  `id_curso` int(11) NOT NULL,
  `cuota_detalle_monto` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cuota_detalle`
--

INSERT INTO `cuota_detalle` (`id_cuota_detalle`, `id_cuota`, `id_curso`, `cuota_detalle_monto`) VALUES
(1, 1, 1, 1500),
(2, 2, 1, 1500),
(3, 2, 3, 2000),
(4, 3, 1, 1500),
(5, 3, 3, 2000);

-- --------------------------------------------------------

--
-- Table structure for table `curso`
--

CREATE TABLE `curso` (
  `id_curso` int(11) NOT NULL,
  `id_idioma` int(11) NOT NULL,
  `curso_descripcion` varchar(50) NOT NULL,
  `curso_precio` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `curso`
--

INSERT INTO `curso` (`id_curso`, `id_idioma`, `curso_descripcion`, `curso_precio`) VALUES
(1, 1, '1ero Basico', '1500'),
(2, 1, '2do Basico', '2000'),
(3, 1, '3ro Basico', '2000'),
(4, 3, '1ro Basico', '2000');

-- --------------------------------------------------------

--
-- Table structure for table `idioma`
--

CREATE TABLE `idioma` (
  `id_idioma` int(11) NOT NULL,
  `idioma_descripcion` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `idioma`
--

INSERT INTO `idioma` (`id_idioma`, `idioma_descripcion`) VALUES
(1, 'Inglés'),
(2, 'Frances'),
(3, 'Portugues');

-- --------------------------------------------------------

--
-- Table structure for table `pago`
--

CREATE TABLE `pago` (
  `id_pago` int(11) NOT NULL,
  `id_cuota` int(11) NOT NULL,
  `dni_cliente` int(11) NOT NULL,
  `id_tipo_pago` int(11) NOT NULL,
  `pago_fecha` date NOT NULL DEFAULT current_timestamp(),
  `pago_hora` time(6) NOT NULL DEFAULT current_timestamp(),
  `pago_monto` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pago`
--

INSERT INTO `pago` (`id_pago`, `id_cuota`, `dni_cliente`, `id_tipo_pago`, `pago_fecha`, `pago_hora`, `pago_monto`) VALUES
(1, 1, 11111111, 1, '2023-06-20', '00:00:00.000000', 1500),
(2, 2, 11111111, 2, '2023-06-21', '08:42:03.000000', 3500),
(3, 2, 11111111, 2, '2023-06-21', '08:42:53.000000', 3500);

-- --------------------------------------------------------

--
-- Table structure for table `tipo_pago`
--

CREATE TABLE `tipo_pago` (
  `id_tipo_pago` int(11) NOT NULL,
  `tipo_pago_descripcion` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tipo_pago`
--

INSERT INTO `tipo_pago` (`id_tipo_pago`, `tipo_pago_descripcion`) VALUES
(1, 'Tarjeta'),
(2, 'Efectivo');

-- --------------------------------------------------------

--
-- Table structure for table `tipo_usuario`
--

CREATE TABLE `tipo_usuario` (
  `id_tipo_usuario` int(11) NOT NULL,
  `tipo_usuario_descripcion` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tipo_usuario`
--

INSERT INTO `tipo_usuario` (`id_tipo_usuario`, `tipo_usuario_descripcion`) VALUES
(1, 'Administrador'),
(2, 'Empleado'),
(3, 'Alumno');

-- --------------------------------------------------------

--
-- Table structure for table `usuario`
--

CREATE TABLE `usuario` (
  `id_usuario` int(11) NOT NULL,
  `id_tipo_usuario` int(11) NOT NULL,
  `usuario_dni` varchar(50) NOT NULL,
  `usuario_nombre` varchar(50) NOT NULL,
  `usuario_apellido` varchar(50) NOT NULL,
  `usuario_telefono` varchar(15) NOT NULL DEFAULT 'NO',
  `usuario_sexo` char(2) NOT NULL,
  `usuario_email` varchar(100) NOT NULL,
  `usuario_contraseña` varchar(300) NOT NULL,
  `usuario_habilitado` char(2) NOT NULL DEFAULT 'S'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `usuario`
--

INSERT INTO `usuario` (`id_usuario`, `id_tipo_usuario`, `usuario_dni`, `usuario_nombre`, `usuario_apellido`, `usuario_telefono`, `usuario_sexo`, `usuario_email`, `usuario_contraseña`, `usuario_habilitado`) VALUES
(1, 1, '43110416', 'Sebastian', 'Alegre', '3624145527', 'H', 'admin@gmail.com', '$2y$10$iOQ7I7m3YceIPQgMKKgIeObBm2pN12y6d4DqjPVWmEWTjvcLH0WI6', 'S'),
(2, 2, '42547882', 'Aylen', 'Martinez', 'NO', 'M', 'empleado@gmail.com', '$2y$10$FWx58wG86zCDqdApuMk7..ebzK31yathAlnvNgGvKXNF5tn6ut2Ti', 'S'),
(3, 3, '21322142', 'Lautaro', 'Taborda', '', 'H', 'alumno@gmail.com', '$2y$10$cTi9jXDy0QEYXbjQkCltMea823NeuSnKR/WqNwcxcxRqTgEFub63q', 'S');

-- --------------------------------------------------------

--
-- Table structure for table `usuario_curso`
--

CREATE TABLE `usuario_curso` (
  `id_usuario` int(11) NOT NULL,
  `id_curso` int(11) NOT NULL,
  `fecha_inscripcion` date NOT NULL DEFAULT current_timestamp(),
  `baja_de_curso` char(2) NOT NULL DEFAULT 'N'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`dni_cliente`);

--
-- Indexes for table `cuota`
--
ALTER TABLE `cuota`
  ADD PRIMARY KEY (`id_cuota`),
  ADD KEY `cuota_usuario` (`id_usuario_alumno`);

--
-- Indexes for table `cuota_detalle`
--
ALTER TABLE `cuota_detalle`
  ADD PRIMARY KEY (`id_cuota_detalle`),
  ADD KEY `cuota_detalle_cuota` (`id_cuota`),
  ADD KEY `cuota_detalle_curso` (`id_curso`);

--
-- Indexes for table `curso`
--
ALTER TABLE `curso`
  ADD PRIMARY KEY (`id_curso`),
  ADD KEY `curso_idioma` (`id_idioma`);

--
-- Indexes for table `idioma`
--
ALTER TABLE `idioma`
  ADD PRIMARY KEY (`id_idioma`);

--
-- Indexes for table `pago`
--
ALTER TABLE `pago`
  ADD PRIMARY KEY (`id_pago`),
  ADD KEY `pago_tipo_pago` (`id_tipo_pago`),
  ADD KEY `pago_cuota` (`id_cuota`),
  ADD KEY `pago_cliente` (`dni_cliente`);

--
-- Indexes for table `tipo_pago`
--
ALTER TABLE `tipo_pago`
  ADD PRIMARY KEY (`id_tipo_pago`);

--
-- Indexes for table `tipo_usuario`
--
ALTER TABLE `tipo_usuario`
  ADD PRIMARY KEY (`id_tipo_usuario`);

--
-- Indexes for table `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id_usuario`),
  ADD KEY `usuario_tipo_usuario` (`id_tipo_usuario`);

--
-- Indexes for table `usuario_curso`
--
ALTER TABLE `usuario_curso`
  ADD KEY `usuario_curso_curso` (`id_curso`),
  ADD KEY `usuario_curso_usuario` (`id_usuario`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cuota`
--
ALTER TABLE `cuota`
  MODIFY `id_cuota` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `cuota_detalle`
--
ALTER TABLE `cuota_detalle`
  MODIFY `id_cuota_detalle` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `curso`
--
ALTER TABLE `curso`
  MODIFY `id_curso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `idioma`
--
ALTER TABLE `idioma`
  MODIFY `id_idioma` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `pago`
--
ALTER TABLE `pago`
  MODIFY `id_pago` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tipo_pago`
--
ALTER TABLE `tipo_pago`
  MODIFY `id_tipo_pago` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tipo_usuario`
--
ALTER TABLE `tipo_usuario`
  MODIFY `id_tipo_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cuota`
--
ALTER TABLE `cuota`
  ADD CONSTRAINT `cuota_usuario` FOREIGN KEY (`id_usuario_alumno`) REFERENCES `usuario` (`id_usuario`);

--
-- Constraints for table `cuota_detalle`
--
ALTER TABLE `cuota_detalle`
  ADD CONSTRAINT `cuota_detalle_cuota` FOREIGN KEY (`id_cuota`) REFERENCES `cuota` (`id_cuota`),
  ADD CONSTRAINT `cuota_detalle_curso` FOREIGN KEY (`id_curso`) REFERENCES `curso` (`id_curso`);

--
-- Constraints for table `curso`
--
ALTER TABLE `curso`
  ADD CONSTRAINT `curso_idioma` FOREIGN KEY (`id_idioma`) REFERENCES `idioma` (`id_idioma`);

--
-- Constraints for table `pago`
--
ALTER TABLE `pago`
  ADD CONSTRAINT `pago_cliente` FOREIGN KEY (`dni_cliente`) REFERENCES `cliente` (`dni_cliente`),
  ADD CONSTRAINT `pago_cuota` FOREIGN KEY (`id_cuota`) REFERENCES `cuota` (`id_cuota`),
  ADD CONSTRAINT `pago_tipo_pago` FOREIGN KEY (`id_tipo_pago`) REFERENCES `tipo_pago` (`id_tipo_pago`);

--
-- Constraints for table `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `usuario_tipo_usuario` FOREIGN KEY (`id_tipo_usuario`) REFERENCES `tipo_usuario` (`id_tipo_usuario`);

--
-- Constraints for table `usuario_curso`
--
ALTER TABLE `usuario_curso`
  ADD CONSTRAINT `usuario_curso_curso` FOREIGN KEY (`id_curso`) REFERENCES `curso` (`id_curso`),
  ADD CONSTRAINT `usuario_curso_usuario` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
