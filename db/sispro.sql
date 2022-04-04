-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 04-04-2022 a las 17:10:09
-- Versión del servidor: 10.4.21-MariaDB
-- Versión de PHP: 8.0.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `sispro`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cargos`
--

CREATE TABLE `cargos` (
  `CAR_id` int(10) NOT NULL,
  `CAR_nombre` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `CAR_descripcion` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `CAR_estado` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `cargos`
--

INSERT INTO `cargos` (`CAR_id`, `CAR_nombre`, `CAR_descripcion`, `CAR_estado`) VALUES
(1, 'Web Developer', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin ac ipsum ante.', 1),
(2, 'Producción', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin ac ipsum ante.', 1),
(3, 'Administración', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin ac ipsum ante.', 1),
(4, 'Diseñador Gráfico', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.', 1),
(5, 'Community Manager', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.', 1),
(6, 'Vendedor(a)', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.', 1),
(7, 'Courier', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `CAT_id` int(10) NOT NULL,
  `CAT_imagen` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `CAT_nombre` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `CAT_descripcion` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `CAT_estado` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`CAT_id`, `CAT_imagen`, `CAT_nombre`, `CAT_descripcion`, `CAT_estado`) VALUES
(1, 'img/default/category.png', 'Ropa', '', 1),
(2, 'img/default/category.png', 'Calzado', '', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE `clientes` (
  `CLI_id` int(10) NOT NULL,
  `CLI_genero` char(1) COLLATE utf8_spanish_ci NOT NULL,
  `CLI_dni` int(8) UNSIGNED ZEROFILL NOT NULL,
  `CLI_nombres` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `CLI_apellidos` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `CLI_direccion` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `CLI_usuario` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `CLI_contraseña` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `CLI_correo` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `CLI_movil` varchar(11) COLLATE utf8_spanish_ci NOT NULL,
  `CLI_observacion` varchar(300) COLLATE utf8_spanish_ci NOT NULL,
  `CLI_tipo` int(1) NOT NULL,
  `CLI_estado` int(1) NOT NULL,
  `CLI_fechaCreacion` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`CLI_id`, `CLI_genero`, `CLI_dni`, `CLI_nombres`, `CLI_apellidos`, `CLI_direccion`, `CLI_usuario`, `CLI_contraseña`, `CLI_correo`, `CLI_movil`, `CLI_observacion`, `CLI_tipo`, `CLI_estado`, `CLI_fechaCreacion`) VALUES
(1, 'M', 43823459, 'Juan', 'Pérez Díaz', 'Av. Marginal 145, ATE', '', '', 'example@gmail.com', '999-999-999', '', 1, 1, '2022-04-04');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empleados`
--

CREATE TABLE `empleados` (
  `EMP_id` int(10) NOT NULL,
  `EMP_imagen` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `EMP_dni` int(8) UNSIGNED ZEROFILL NOT NULL,
  `EMP_nombres` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `EMP_apellidos` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `EMP_movil` varchar(11) COLLATE utf8_spanish_ci NOT NULL,
  `EMP_correo` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `EMP_genero` char(1) COLLATE utf8_spanish_ci NOT NULL,
  `EMP_informacion` varchar(300) COLLATE utf8_spanish_ci NOT NULL,
  `EMP_fechaIngreso` date NOT NULL,
  `EMP_estado` int(1) NOT NULL,
  `CAR_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `empleados`
--

INSERT INTO `empleados` (`EMP_id`, `EMP_imagen`, `EMP_dni`, `EMP_nombres`, `EMP_apellidos`, `EMP_movil`, `EMP_correo`, `EMP_genero`, `EMP_informacion`, `EMP_fechaIngreso`, `EMP_estado`, `CAR_id`) VALUES
(1, 'img/default/user.png', 54647467, 'Rosalí', 'Nazario', '996-786-786', 'example@gmail.com', 'F', '', '2022-03-12', 1, 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `historial_procesos`
--

CREATE TABLE `historial_procesos` (
  `HPC_id` int(10) NOT NULL,
  `HPC_precio` decimal(10,2) NOT NULL,
  `HPC_ptotal` decimal(10,2) NOT NULL,
  `HPC_fecha` date NOT NULL,
  `EMP_id` int(10) NOT NULL,
  `ORD_id` int(10) NOT NULL,
  `PC_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `historial_procesos`
--

INSERT INTO `historial_procesos` (`HPC_id`, `HPC_precio`, `HPC_ptotal`, `HPC_fecha`, `EMP_id`, `ORD_id`, `PC_id`) VALUES
(0, '5.00', '35.00', '2022-04-04', 1, 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ordenes`
--

CREATE TABLE `ordenes` (
  `ORD_id` int(10) NOT NULL,
  `USU_id` int(10) NOT NULL,
  `CLI_id` int(10) NOT NULL,
  `ORD_estado` int(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `ordenes`
--

INSERT INTO `ordenes` (`ORD_id`, `USU_id`, `CLI_id`, `ORD_estado`) VALUES
(1, 3, 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ordenes_detalles`
--

CREATE TABLE `ordenes_detalles` (
  `ORD_id` int(10) NOT NULL,
  `ODET_referencia` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `ODET_material` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `ODET_suela` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `ODET_color` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `ODET_observacion` varchar(300) COLLATE utf8_spanish_ci NOT NULL,
  `ODET_pago` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `ODET_fecha` datetime NOT NULL,
  `ODET_fechaEntrega` date NOT NULL,
  `PRO_id` int(10) NOT NULL,
  `SER_id` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `ordenes_detalles`
--

INSERT INTO `ordenes_detalles` (`ORD_id`, `ODET_referencia`, `ODET_material`, `ODET_suela`, `ODET_color`, `ODET_observacion`, `ODET_pago`, `ODET_fecha`, `ODET_fechaEntrega`, `PRO_id`, `SER_id`) VALUES
(1, 'Facebook', 'Cuero', 'PVC Expanso', 'Print', '', 'Contra entrega', '2022-04-04 09:24:05', '2022-05-23', 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pagos`
--

CREATE TABLE `pagos` (
  `PAG_id` int(10) NOT NULL,
  `PAG_destajo` decimal(10,2) NOT NULL,
  `PAG_dia` decimal(10,2) NOT NULL,
  `PAG_semanal` decimal(10,2) NOT NULL,
  `PAG_adelantos` decimal(10,2) NOT NULL,
  `PAG_saldos` decimal(10,2) NOT NULL,
  `PAG_mensual` decimal(10,2) NOT NULL,
  `PAG_fecha` date NOT NULL,
  `EMP_id` int(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `procesos`
--

CREATE TABLE `procesos` (
  `PC_id` int(10) NOT NULL,
  `PC_nombre` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `PC_descripcion` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `PC_estado` int(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `procesos`
--

INSERT INTO `procesos` (`PC_id`, `PC_nombre`, `PC_descripcion`, `PC_estado`) VALUES
(1, 'Corte', '', 1),
(2, 'Aparado', '', 1),
(3, 'Armado', '', 1),
(4, 'Acabado', '', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `PRO_id` int(10) NOT NULL,
  `PRO_imagen` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `PRO_nombre` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `PRO_modelo` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `PRO_material` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `PRO_suela` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `PRO_color` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `PRO_marca` varchar(20) COLLATE utf8_spanish_ci NOT NULL DEFAULT 'Maribú',
  `PRO_descripcion` varchar(200) COLLATE utf8_spanish_ci NOT NULL,
  `PRO_precio` decimal(10,2) NOT NULL,
  `PRO_estado` int(1) NOT NULL DEFAULT 1,
  `CAT_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`PRO_id`, `PRO_imagen`, `PRO_nombre`, `PRO_modelo`, `PRO_material`, `PRO_suela`, `PRO_color`, `PRO_marca`, `PRO_descripcion`, `PRO_precio`, `PRO_estado`, `CAT_id`) VALUES
(1, 'img/default/product.png', 'Botín de Cuero', '345', 'Cuero', 'PVC Expanso', 'Negro', 'Maribú', '', '129.00', 1, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `series`
--

CREATE TABLE `series` (
  `SER_id` int(100) NOT NULL,
  `SER_talla34` int(2) NOT NULL DEFAULT 0,
  `SER_talla35` int(2) NOT NULL DEFAULT 0,
  `SER_talla36` int(2) NOT NULL DEFAULT 0,
  `SER_talla37` int(2) NOT NULL DEFAULT 0,
  `SER_talla38` int(2) NOT NULL DEFAULT 0,
  `SER_talla39` int(2) NOT NULL DEFAULT 0,
  `SER_talla40` int(2) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `series`
--

INSERT INTO `series` (`SER_id`, `SER_talla34`, `SER_talla35`, `SER_talla36`, `SER_talla37`, `SER_talla38`, `SER_talla39`, `SER_talla40`) VALUES
(1, 1, 1, 1, 1, 1, 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `USU_id` int(10) NOT NULL,
  `USU_imagen` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `USU_nombres` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `USU_apellidos` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `USU_movil` varchar(11) COLLATE utf8_spanish_ci DEFAULT NULL,
  `USU_correo` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `USU_usuario` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `USU_contraseña` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `USU_tipo` int(1) NOT NULL,
  `USU_estado` int(1) NOT NULL,
  `USU_fechaCreacion` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`USU_id`, `USU_imagen`, `USU_nombres`, `USU_apellidos`, `USU_movil`, `USU_correo`, `USU_usuario`, `USU_contraseña`, `USU_tipo`, `USU_estado`, `USU_fechaCreacion`) VALUES
(1, 'img/users/img-18052019-171119.jpg', 'Martín', 'Rojas Soplín', '933-136-181', 'mrojas@alkacorp.com', 'mrojas', '151b70bd59346a06b225bcb64054a1cd', 1, 1, '2019-05-18'),
(2, 'img/users/img-07012020-123706.jpg', 'Frank', 'Tapia', '923-456-789', 'ftapia@alkacorp.com', 'ftapia', '202cb962ac59075b964b07152d234b70', 1, 1, '2019-05-18'),
(3, 'img/users/img-07012020-123854.jpg', 'Roxanna', 'Vera', '999-999-999', 'rvera@alkacorp.com', 'rvera', 'e807f1fcf82d132f9bb018ca6738a19f', 2, 1, '2020-01-07');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `cargos`
--
ALTER TABLE `cargos`
  ADD PRIMARY KEY (`CAR_id`);

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`CAT_id`);

--
-- Indices de la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`CLI_id`);

--
-- Indices de la tabla `empleados`
--
ALTER TABLE `empleados`
  ADD PRIMARY KEY (`EMP_id`),
  ADD KEY `CAR_id` (`CAR_id`);

--
-- Indices de la tabla `ordenes`
--
ALTER TABLE `ordenes`
  ADD PRIMARY KEY (`ORD_id`),
  ADD KEY `USU_id` (`USU_id`),
  ADD KEY `CLI_id` (`CLI_id`);

--
-- Indices de la tabla `ordenes_detalles`
--
ALTER TABLE `ordenes_detalles`
  ADD KEY `PRO_id` (`PRO_id`),
  ADD KEY `ORD_id` (`ORD_id`),
  ADD KEY `SER_id` (`SER_id`);

--
-- Indices de la tabla `pagos`
--
ALTER TABLE `pagos`
  ADD PRIMARY KEY (`PAG_id`),
  ADD KEY `EMP_id` (`EMP_id`) USING BTREE;

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`PRO_id`),
  ADD KEY `CAT_id` (`CAT_id`);

--
-- Indices de la tabla `series`
--
ALTER TABLE `series`
  ADD PRIMARY KEY (`SER_id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`USU_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `cargos`
--
ALTER TABLE `cargos`
  MODIFY `CAR_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `CAT_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `clientes`
--
ALTER TABLE `clientes`
  MODIFY `CLI_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `empleados`
--
ALTER TABLE `empleados`
  MODIFY `EMP_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `ordenes`
--
ALTER TABLE `ordenes`
  MODIFY `ORD_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `ordenes_detalles`
--
ALTER TABLE `ordenes_detalles`
  MODIFY `ORD_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `pagos`
--
ALTER TABLE `pagos`
  MODIFY `PAG_id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `PRO_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `series`
--
ALTER TABLE `series`
  MODIFY `SER_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `USU_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
