-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 20-12-2022 a las 00:16:24
-- Versión del servidor: 10.1.37-MariaDB
-- Versión de PHP: 7.3.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `writer_space`
--
CREATE DATABASE IF NOT EXISTS `writer_space` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `writer_space`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `articulos`
--

CREATE TABLE `articulos` (
  `id_articulo` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `articulo_titulo` varchar(200) NOT NULL,
  `articulo_introduccion` text,
  `articulo_cuerpo` mediumtext,
  `articulo_fuente` text,
  `articulo_estado` int(1) DEFAULT NULL COMMENT '0=borrador, 1=publcado, 2=papelera',
  `articulo_tags` varchar(200) DEFAULT NULL,
  `fecha_de_creacion` datetime NOT NULL,
  `fecha_de_publicacion` datetime DEFAULT NULL,
  `fecha_ultima_actualizacion` datetime DEFAULT NULL,
  `articulo_publicado_status` int(1) NOT NULL COMMENT '0=no a sido publicado, 1=ya fue publicado'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id_usuario` int(11) NOT NULL,
  `username` varchar(30) NOT NULL,
  `contrasena` varchar(100) NOT NULL,
  `nombres` varchar(100) DEFAULT NULL,
  `apellidos` varchar(100) DEFAULT NULL,
  `usuario_presentacion` text,
  `tema_oscuro_active` int(11) NOT NULL DEFAULT '0' COMMENT '0: no. 1: si'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios_guardar_articulos`
--

CREATE TABLE `usuarios_guardar_articulos` (
  `id_usuario_guardar_articulo` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `id_articulo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `articulos`
--
ALTER TABLE `articulos`
  ADD PRIMARY KEY (`id_articulo`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usuario`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indices de la tabla `usuarios_guardar_articulos`
--
ALTER TABLE `usuarios_guardar_articulos`
  ADD PRIMARY KEY (`id_usuario_guardar_articulo`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `articulos`
--
ALTER TABLE `articulos`
  MODIFY `id_articulo` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `usuarios_guardar_articulos`
--
ALTER TABLE `usuarios_guardar_articulos`
  MODIFY `id_usuario_guardar_articulo` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
