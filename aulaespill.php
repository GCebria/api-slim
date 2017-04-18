-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 11-04-2017 a las 15:55:54
-- Versión del servidor: 5.7.14
-- Versión de PHP: 5.6.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `aulaespill`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alumnos`
--

CREATE TABLE `alumnos` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `apellidos` varchar(50) NOT NULL,
  `telefono` varchar(12) NOT NULL,
  `email` varchar(50) DEFAULT NULL,
  `contrasena` varchar(50) DEFAULT NULL,
  `direccion` varchar(50) NOT NULL,
  `ciudad` varchar(15) NOT NULL,
  `cp` int(6) NOT NULL,
  `pais` varchar(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `alumnos`
--

INSERT INTO `alumnos` (`id`, `nombre`, `apellidos`, `telefono`, `email`, `contrasena`, `direccion`, `ciudad`, `cp`, `pais`) VALUES
(1, 'gerard', 'cebria leon', '691570787', 'gerardcebria', 'gerard', 'callefalsa', 'valencia', 46009, 'espana'),
(3, 'gerard', 'cebria leon', '691570787', 'email', 'contrasena', 'callefalsa', 'valencia', 46009, 'espana');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cursos`
--

CREATE TABLE `cursos` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `descripcion` varchar(500) NOT NULL,
  `foto` varchar(150) NOT NULL,
  `precio` int(11) NOT NULL,
  `tutor` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `cursos`
--

INSERT INTO `cursos` (`id`, `nombre`, `descripcion`, `foto`, `precio`, `tutor`) VALUES
(1, 'Amor RomÃ¡ntico', 'Vuelve a enamorarte', 'assets/img/portfolio/thumbnails/1.jpg', 150, 1),
(2, 'Amor Loco', 'Vuelve a enamorarte locament', 'assets/img/portfolio/thumbnails/2.jpg', 250, 2),
(3, 'Tipologias sexuales', 'Aprende nuevas tipologias sexuales', 'assets/img/portfolio/thumbnails/3.jpg', 200, 3),
(4, 'Curso transexualidad infantil', 'Aprende todo sobre transexualidad infantil', 'assets/img/portfolio/thumbnails/4.jpg', 180, 3),
(5, 'Tratamiento eyaculaciÃ³n precoz', 'Tratamiento sobre la eyaculaciÃ³n precoz', 'assets/img/portfolio/thumbnails/5.jpg', 320, 1),
(6, 'Tratamiento anorgÃ¡smia', 'Tratamiento sobre la anorgÃ¡smia', 'assets/img/portfolio/thumbnails/6.jpg', 280, 4);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `alumnos`
--
ALTER TABLE `alumnos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `cursos`
--
ALTER TABLE `cursos`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `alumnos`
--
ALTER TABLE `alumnos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `cursos`
--
ALTER TABLE `cursos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
