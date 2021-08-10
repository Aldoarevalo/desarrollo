-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 22-05-2020 a las 15:58:25
-- Versión del servidor: 10.1.30-MariaDB
-- Versión de PHP: 7.2.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `appventas`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente`
--

CREATE TABLE `cliente` (
  `cli_codigo` int(11) NOT NULL,
  `cli_ci` int(11) DEFAULT NULL,
  `cli_nombre` varchar(30) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `cli_apellido` varchar(30) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `cli_ruc` varchar(30) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `cli_telefono` varchar(30) COLLATE utf8_spanish2_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `cliente`
--

INSERT INTO `cliente` (`cli_codigo`, `cli_ci`, `cli_nombre`, `cli_apellido`, `cli_ruc`, `cli_telefono`) VALUES
(1, 111, 'Carlos', 'Gimenez', '111-6', '0984521789'),
(2, 5221409, 'Abner', 'CÃ¡ceres', '1234556', '098645754');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empleado`
--

CREATE TABLE `empleado` (
  `emp_codigo` int(11) NOT NULL,
  `emp_ci` int(11) DEFAULT NULL,
  `emp_nombre` varchar(30) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `emp_apellido` varchar(30) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `emp_salario` int(11) DEFAULT NULL,
  `emp_telefono` varchar(30) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `emp_usuario` varchar(30) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `emp_clave` varchar(30) COLLATE utf8_spanish2_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `empleado`
--

INSERT INTO `empleado` (`emp_codigo`, `emp_ci`, `emp_nombre`, `emp_apellido`, `emp_salario`, `emp_telefono`, `emp_usuario`, `emp_clave`) VALUES
(1, 12345, 'Juan', 'Perez', 1000000, '0984123456', 'admin', '123'),
(2, 4981582, 'Lucas', 'Riquelme', 8000000, '984123456', 'lucas', '123');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `marca`
--

CREATE TABLE `marca` (
  `mar_codigo` int(11) NOT NULL,
  `mar_descripcion` varchar(30) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `marca`
--

INSERT INTO `marca` (`mar_codigo`, `mar_descripcion`) VALUES
(3, 'nVidia'),
(4, 'Nike'),
(5, 'Polo'),
(10, 'Intel'),
(9, 'AMD'),
(35, '1'),
(34, '1'),
(33, '3'),
(32, '1'),
(31, '2'),
(30, '1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `presupuesto`
--

CREATE TABLE `presupuesto` (
  `pre_codigo` int(11) NOT NULL,
  `pre_fecha` date DEFAULT NULL,
  `emp_usuario` varchar(30) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `cli_codigo` int(11) DEFAULT NULL,
  `pre_activo` int(1) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `presupuesto`
--

INSERT INTO `presupuesto` (`pre_codigo`, `pre_fecha`, `emp_usuario`, `cli_codigo`, `pre_activo`) VALUES
(1, '2019-08-11', '1', 1, 1),
(2, '2019-08-11', '1', 1, 0),
(3, '2019-08-16', '2', 2, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `presupuesto_detalle`
--

CREATE TABLE `presupuesto_detalle` (
  `pdet_codigo` int(11) NOT NULL,
  `pre_codigo` int(11) DEFAULT NULL,
  `pro_codigo` int(11) DEFAULT NULL,
  `pdet_cantidad` int(11) DEFAULT NULL,
  `pdet_precio` int(11) DEFAULT NULL,
  `pdet_subtotal` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `presupuesto_detalle`
--

INSERT INTO `presupuesto_detalle` (`pdet_codigo`, `pre_codigo`, `pro_codigo`, `pdet_cantidad`, `pdet_precio`, `pdet_subtotal`) VALUES
(1, 1, 1, 2, 5000, 10000),
(2, 1, 2, 5, 7000, 35000),
(3, 1, 3, 3, 6000, 18000),
(4, 2, 1, 2, 5000, 10000),
(5, 2, 2, 3, 7000, 21000),
(7, 3, 1, 2, 5000, 10000),
(8, 3, 2, 5, 7000, 35000);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

CREATE TABLE `producto` (
  `pro_codigo` int(11) NOT NULL,
  `pro_descripcion` varchar(30) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `mar_codigo` int(11) DEFAULT NULL,
  `pro_costo` int(11) DEFAULT NULL,
  `pro_precio` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `producto`
--

INSERT INTO `producto` (`pro_codigo`, `pro_descripcion`, `mar_codigo`, `pro_costo`, `pro_precio`) VALUES
(1, 'Disco Duro 1TB Sata2', 1, 3000, 5000),
(2, 'Memoria 32Gb', 2, 5000, 7000),
(3, 'SSD 480GB', 3, 4000, 6000),
(4, 'CoolerMaster', 4, 3000, 4000),
(5, 'CajaKit', 5, 2000, 2500),
(6, 'notebook', 1, 130000, 1500000);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`cli_codigo`);

--
-- Indices de la tabla `empleado`
--
ALTER TABLE `empleado`
  ADD PRIMARY KEY (`emp_codigo`);

--
-- Indices de la tabla `marca`
--
ALTER TABLE `marca`
  ADD PRIMARY KEY (`mar_codigo`);

--
-- Indices de la tabla `presupuesto`
--
ALTER TABLE `presupuesto`
  ADD PRIMARY KEY (`pre_codigo`);

--
-- Indices de la tabla `presupuesto_detalle`
--
ALTER TABLE `presupuesto_detalle`
  ADD PRIMARY KEY (`pdet_codigo`),
  ADD UNIQUE KEY `pre_codigo` (`pre_codigo`,`pro_codigo`);

--
-- Indices de la tabla `producto`
--
ALTER TABLE `producto`
  ADD PRIMARY KEY (`pro_codigo`),
  ADD KEY `marca` (`mar_codigo`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `cliente`
--
ALTER TABLE `cliente`
  MODIFY `cli_codigo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `empleado`
--
ALTER TABLE `empleado`
  MODIFY `emp_codigo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `marca`
--
ALTER TABLE `marca`
  MODIFY `mar_codigo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT de la tabla `presupuesto`
--
ALTER TABLE `presupuesto`
  MODIFY `pre_codigo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `presupuesto_detalle`
--
ALTER TABLE `presupuesto_detalle`
  MODIFY `pdet_codigo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `producto`
--
ALTER TABLE `producto`
  MODIFY `pro_codigo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
