-- phpMyAdmin SQL Dump
-- version 4.4.3
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 04-07-2015 a las 18:58:08
-- Versión del servidor: 5.6.24
-- Versión de PHP: 5.6.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `tienda_online`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `carrito`
--

CREATE TABLE IF NOT EXISTS `carrito` (
  `id` int(11) NOT NULL,
  `cedula` int(11) NOT NULL,
  `codigo` int(6) NOT NULL,
  `cantidad` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `carrito`
--

INSERT INTO `carrito` (`id`, `cedula`, `codigo`, `cantidad`) VALUES
(32, 0, 102, '2'),
(33, 0, 101, '1'),
(34, 0, 100, '1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria_estado`
--

CREATE TABLE IF NOT EXISTS `categoria_estado` (
  `id` int(11) NOT NULL,
  `estado` varchar(100) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `categoria_estado`
--

INSERT INTO `categoria_estado` (`id`, `estado`) VALUES
(1, 'Normal'),
(2, 'Promocion'),
(3, 'Oferta');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria_producto`
--

CREATE TABLE IF NOT EXISTS `categoria_producto` (
  `id` int(11) NOT NULL,
  `categoria` varchar(100) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `categoria_producto`
--

INSERT INTO `categoria_producto` (`id`, `categoria`) VALUES
(1, 'Accesorios'),
(2, 'Impresoras'),
(3, 'Monitores'),
(4, 'PC de Escritorio'),
(5, 'Portátiles'),
(6, 'Tablets'),
(7, 'Smartphone');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria_usuario`
--

CREATE TABLE IF NOT EXISTS `categoria_usuario` (
  `id_usuario` int(11) NOT NULL,
  `tipo` varchar(100) NOT NULL,
  `descripcion` varchar(100) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `categoria_usuario`
--

INSERT INTO `categoria_usuario` (`id_usuario`, `tipo`, `descripcion`) VALUES
(1, 'Administrador', 'tiene todos los permisos para crear, actualizar o borrar y leer datos de las tablas'),
(2, 'Administrador Basico', 'Tiene los permisos de lectura, crea, actualizar y borrar únicamente de la tabla productos'),
(3, 'Cliente', 'Unicamente puede ver los productos y realizar compras');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estado`
--

CREATE TABLE IF NOT EXISTS `estado` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `descrpcion` varchar(100) NOT NULL,
  `descuento` decimal(10,2) NOT NULL,
  `id_categoria_estado` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `estado`
--

INSERT INTO `estado` (`id`, `nombre`, `descrpcion`, `descuento`, `id_categoria_estado`) VALUES
(1, 'Norrmal', 'no incluyen descunetos', '0.00', 1),
(2, 'Oferta Portatil', 'Portátil + mouse + ventilador + mochila', '0.05', 3),
(3, 'Oferta PC', 'Equipo de mesa + teclado + mouse + parlantes + escritorio', '0.10', 3),
(4, 'Promoción del mes', 'aplica a un solo producto portatil', '0.08', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

CREATE TABLE IF NOT EXISTS `producto` (
  `id` int(11) NOT NULL,
  `id_categoria` int(11) NOT NULL,
  `id_estado` int(11) NOT NULL,
  `id_estado_pro` int(11) NOT NULL,
  `codigo` int(6) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `marca` varchar(100) NOT NULL,
  `nota` varchar(255) NOT NULL,
  `valor` varchar(255) NOT NULL,
  `estado` varchar(255) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `imagen` varchar(200) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `producto`
--

INSERT INTO `producto` (`id`, `id_categoria`, `id_estado`, `id_estado_pro`, `codigo`, `nombre`, `marca`, `nota`, `valor`, `estado`, `cantidad`, `imagen`) VALUES
(1, 5, 1, 1, 100, 'COMPUTADOR DELL', 'Dell', 'Computador de Marca DELL, Disco Duro de 300 GB y memoria DRR2 3GB', '1200000', 's', 3, 'http://goo.gl/MLhTiK'),
(2, 5, 1, 1, 101, 'COMPUTADOR SAMSUNG', 'Sansung', 'Computador de Marca SANSUNG de 10.4 Pulgadas de Colores Negro, Gris y Personalizados en la tapa', '900000', 's', 5, 'http://goo.gl/MLhTiK'),
(3, 4, 1, 1, 102, 'COMPUTADOR HP', 'HP', 'Computador de Mesa de marca HP, monitor de 14 Pulgadas, con Teclado, Cursor, Mesa y Silla ', '990000', 's', 0, 'http://goo.gl/MLhTiK'),
(4, 5, 2, 2, 103, 'COMPUTADOR VAIO', 'VAIO', 'Computador de Marca VAIO, de 13 Pulgada', '1000000', 's', 4, 'http://goo.gl/MLhTiK'),
(5, 3, 1, 1, 103, 'monitor', '', 'mamskask', '100', 's', 2, 'sds');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE IF NOT EXISTS `usuario` (
  `id` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `cedula` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `apellido` varchar(100) NOT NULL,
  `direccion` varchar(100) NOT NULL,
  `telefono` varchar(100) NOT NULL,
  `email` varchar(20) NOT NULL,
  `user` varchar(20) NOT NULL,
  `pass` varchar(20) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id`, `id_usuario`, `cedula`, `nombre`, `apellido`, `direccion`, `telefono`, `email`, `user`, `pass`) VALUES
(1, 1, 1101964086, 'Luis Claudio', ' Chalán Romero', 'Amazonas Y Colón', '+593969489137', 'luisdesign59@gmail.c', 'lcchalan', '12345'),
(2, 2, 222222222, 'Jose', 'Romero', 'San José', '1234567', 'jose@', 'jromero', '12345'),
(3, 3, 1133131313, 'Patricio', 'Aguirre', 'Machala y Tulcan ', '2580664', 'pato@', 'paguirre', '12345'),
(4, 3, 31121331, 'Diego', 'Chalán', 'San Cayetano', '09768362', 'diego@', 'dachalan', '12345'),
(5, 3, 1212121212, 'Claudio', 'Romero', 'El Valle', '255255', 'claudio@', 'clromero', '12345');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `carrito`
--
ALTER TABLE `carrito`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cedula` (`cedula`);

--
-- Indices de la tabla `categoria_estado`
--
ALTER TABLE `categoria_estado`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `categoria_producto`
--
ALTER TABLE `categoria_producto`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `categoria_usuario`
--
ALTER TABLE `categoria_usuario`
  ADD PRIMARY KEY (`id_usuario`);

--
-- Indices de la tabla `estado`
--
ALTER TABLE `estado`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_categoria_estado` (`id_categoria_estado`);

--
-- Indices de la tabla `producto`
--
ALTER TABLE `producto`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_categoria` (`id_categoria`),
  ADD KEY `id_estado` (`id_estado`),
  ADD KEY `id_estado_pro` (`id_estado_pro`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_usuario` (`id_usuario`),
  ADD KEY `cedula` (`cedula`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `carrito`
--
ALTER TABLE `carrito`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=35;
--
-- AUTO_INCREMENT de la tabla `categoria_estado`
--
ALTER TABLE `categoria_estado`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `categoria_producto`
--
ALTER TABLE `categoria_producto`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT de la tabla `categoria_usuario`
--
ALTER TABLE `categoria_usuario`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `estado`
--
ALTER TABLE `estado`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `producto`
--
ALTER TABLE `producto`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `estado`
--
ALTER TABLE `estado`
  ADD CONSTRAINT `estado_ibfk_1` FOREIGN KEY (`id_categoria_estado`) REFERENCES `categoria_estado` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
