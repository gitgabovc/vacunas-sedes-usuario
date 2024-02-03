-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 24-06-2022 a las 16:19:03
-- Versión del servidor: 10.4.24-MariaDB
-- Versión de PHP: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `bdpetcam`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `campana`
--

CREATE TABLE `campana` (
  `id` int(11) NOT NULL,
  `tipo_campana_id` int(11) DEFAULT NULL,
  `descripcion` text DEFAULT NULL,
  `gestion` int(11) DEFAULT NULL,
  `add_at` datetime DEFAULT NULL,
  `mod_at` datetime DEFAULT NULL,
  `del_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `establecimiento`
--

CREATE TABLE `establecimiento` (
  `id` int(11) NOT NULL,
  `municipio_id` int(11) DEFAULT NULL,
  `nombre` varchar(65) DEFAULT NULL,
  `add_at` datetime DEFAULT NULL,
  `mod_at` datetime DEFAULT NULL,
  `del_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `fechas`
--

CREATE TABLE `fechas` (
  `id` int(11) NOT NULL,
  `campana_id` int(11) DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  `establecimiento_id` int(11) DEFAULT NULL,
  `responsable_id` int(11) DEFAULT NULL,
  `poblacion` int(11) DEFAULT NULL,
  `brigadas` int(11) DEFAULT NULL,
  `add_at` datetime DEFAULT NULL,
  `mod_at` datetime DEFAULT NULL,
  `del_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mascota`
--

CREATE TABLE `mascota` (
  `id` int(11) NOT NULL,
  `propietario_id` int(11) DEFAULT NULL,
  `raza_id` int(11) DEFAULT NULL,
  `nombre` varchar(45) DEFAULT NULL,
  `sexo` char(1) DEFAULT NULL,
  `edad` char(1) DEFAULT NULL,
  `foto` varchar(45) DEFAULT NULL,
  `color` varchar(45) DEFAULT NULL,
  `tipo` char(1) DEFAULT NULL,
  `estado` char(1) DEFAULT NULL,
  `add_at` datetime DEFAULT NULL,
  `mod_at` datetime DEFAULT NULL,
  `del_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `municipio`
--

CREATE TABLE `municipio` (
  `id` int(11) NOT NULL,
  `nombre` varchar(45) DEFAULT NULL,
  `add_at` datetime DEFAULT NULL,
  `mod_at` datetime DEFAULT NULL,
  `del_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `propietario`
--

CREATE TABLE `propietario` (
  `id` int(11) NOT NULL,
  `ci` varchar(45) DEFAULT NULL,
  `nombre` varchar(65) DEFAULT NULL,
  `direccion` varchar(85) DEFAULT NULL,
  `telefono` varchar(45) DEFAULT NULL,
  `password` text NOT NULL,
  `add_at` datetime DEFAULT NULL,
  `mod_at` datetime DEFAULT NULL,
  `del_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `propietario`
--

INSERT INTO `propietario` (`id`, `ci`, `nombre`, `direccion`, `telefono`, `password`, `add_at`, `mod_at`, `del_at`) VALUES
(2, '1234567', 'Prueba Uno', 'Av. América', '1234567', '$2y$10$wiJXqyzy5CrYZ3R3gUNDqe3o2OvFspDYKW7JVaOmLEszVP5vH9jxK', NULL, NULL, NULL),
(3, '7654321', 'Prueba Dos', 'Av. Humbolt', '7654321', '$2y$10$E7iOBSdv979IPSvS55tWJ.fs7ZOCly/mqwbdHsjF2O6EoaiupSmFO', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `raza`
--

CREATE TABLE `raza` (
  `id` int(11) NOT NULL,
  `descripcion` varchar(45) DEFAULT NULL,
  `add_at` datetime DEFAULT NULL,
  `mod_at` datetime DEFAULT NULL,
  `del_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `raza`
--

INSERT INTO `raza` (`id`, `descripcion`, `add_at`, `mod_at`, `del_at`) VALUES
(1, 'Raza común', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_campana`
--

CREATE TABLE `tipo_campana` (
  `id` int(11) NOT NULL,
  `descripcion` varchar(45) DEFAULT NULL,
  `add_at` datetime DEFAULT NULL,
  `mod_at` datetime DEFAULT NULL,
  `del_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `id` int(11) NOT NULL,
  `usuario` varchar(45) DEFAULT NULL,
  `password` text DEFAULT NULL,
  `nombre` varchar(45) DEFAULT NULL,
  `establecimiento_id` int(11) DEFAULT NULL,
  `estado` char(1) DEFAULT NULL,
  `add_at` datetime DEFAULT NULL,
  `mod_at` datetime DEFAULT NULL,
  `del_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id`, `usuario`, `password`, `nombre`, `establecimiento_id`, `estado`, `add_at`, `mod_at`, `del_at`) VALUES
(1, 'Prueba1', '$2y$10$0I4KagW..ObXLipK/tEHC.2tnJSnLF9mvvsm//', 'Prueba Probando', NULL, NULL, NULL, NULL, NULL),
(2, 'Prueba2', '$2y$10$Uz4n59ikQhRWS8HDN3WvyuZLq2SHk9PCNbmJf8', 'Prueba Probando', NULL, NULL, NULL, NULL, NULL),
(3, 'prueba3', '$2y$10$0ofm3YK0QAvBM8MtPe43j.XjtKLeqJ5FfOS.9L.cDdiWTdPPh1NtW', 'Prueba Tres', NULL, NULL, NULL, NULL, NULL),
(4, 'prueba4', '$2y$10$veji8H3Svo7V/7L5xxpqfeyKFdc6RwD4qGD.9gwL7Qhs7xRK3Ydum', 'Prueba Cuatro', NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vacunas`
--

CREATE TABLE `vacunas` (
  `id` int(11) NOT NULL,
  `fechas_id` int(11) DEFAULT NULL,
  `mascota_id` int(11) DEFAULT NULL,
  `add_at` datetime DEFAULT NULL,
  `mod_at` datetime DEFAULT NULL,
  `del_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `campana`
--
ALTER TABLE `campana`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `establecimiento`
--
ALTER TABLE `establecimiento`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `fechas`
--
ALTER TABLE `fechas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `mascota`
--
ALTER TABLE `mascota`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `municipio`
--
ALTER TABLE `municipio`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `propietario`
--
ALTER TABLE `propietario`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `raza`
--
ALTER TABLE `raza`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tipo_campana`
--
ALTER TABLE `tipo_campana`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `vacunas`
--
ALTER TABLE `vacunas`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `campana`
--
ALTER TABLE `campana`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `establecimiento`
--
ALTER TABLE `establecimiento`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `fechas`
--
ALTER TABLE `fechas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `mascota`
--
ALTER TABLE `mascota`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `municipio`
--
ALTER TABLE `municipio`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `propietario`
--
ALTER TABLE `propietario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `raza`
--
ALTER TABLE `raza`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `tipo_campana`
--
ALTER TABLE `tipo_campana`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `vacunas`
--
ALTER TABLE `vacunas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
