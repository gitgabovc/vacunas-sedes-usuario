-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 15-08-2022 a las 18:20:56
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
  `nro_brigada` smallint(6) DEFAULT NULL,
  `lugar` varchar(40) DEFAULT NULL,
  `nro_dosis` mediumint(9) DEFAULT NULL,
  `add_at` datetime DEFAULT NULL,
  `mod_at` datetime DEFAULT NULL,
  `del_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `fechas`
--

INSERT INTO `fechas` (`id`, `campana_id`, `fecha`, `establecimiento_id`, `responsable_id`, `nro_brigada`, `lugar`, `nro_dosis`, `add_at`, `mod_at`, `del_at`) VALUES
(1, NULL, '2022-07-22', NULL, NULL, NULL, NULL, NULL, '2022-07-22 09:14:59', NULL, NULL),
(2, NULL, '2022-07-21', NULL, NULL, NULL, NULL, NULL, '2022-07-22 10:11:33', NULL, NULL);

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
  `edad_meses` tinyint(2) DEFAULT NULL,
  `edad_anios` tinyint(2) DEFAULT NULL,
  `foto` varchar(45) DEFAULT NULL,
  `color` varchar(45) DEFAULT NULL,
  `tipo` char(1) DEFAULT NULL,
  `estado` char(1) DEFAULT '1',
  `add_at` datetime DEFAULT NULL,
  `mod_at` datetime DEFAULT NULL,
  `del_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `mascota`
--

INSERT INTO `mascota` (`id`, `propietario_id`, `raza_id`, `nombre`, `sexo`, `edad_meses`, `edad_anios`, `foto`, `color`, `tipo`, `estado`, `add_at`, `mod_at`, `del_at`) VALUES
(1, 1, 1, 'ARA', 'M', NULL, NULL, NULL, 'CAFE', 'P', '1', NULL, NULL, NULL),
(3, 2, 2, 'ADA', 'H', 5, 5, 'P00000002M00000003F20220815100014.jpg', 'NEGRO', 'G', '1', NULL, '2022-08-15 10:00:12', NULL),
(4, 2, 2, 'ASDF', 'M', 1, NULL, NULL, 'CAFE', 'P', '0', NULL, NULL, '2022-07-20 12:02:35'),
(5, 2, 1, 'AFER', 'H', 1, 1, NULL, 'CAFE', 'G', '1', NULL, '2022-08-15 12:09:09', NULL),
(6, 2, 1, 'DOLI', 'H', 1, NULL, NULL, 'VERDE', 'G', '1', NULL, NULL, NULL),
(7, 2, 2, 'ERA', 'M', 1, NULL, NULL, 'CAFE', 'P', '1', NULL, NULL, NULL),
(8, 2, 1, 'AVEC', 'M', 3, 0, NULL, 'ROJO', 'G', '1', NULL, NULL, NULL),
(9, 4, 1, 'asdf', 'M', 5, 5, NULL, 'cafe', 'P', '1', NULL, NULL, NULL),
(10, 4, 1, 'ada', 'M', 3, 4, NULL, 'cafe', 'P', '1', NULL, NULL, NULL),
(11, 2, 1, 'FERA', 'H', 0, 0, NULL, 'CAFE', 'G', '1', NULL, NULL, NULL),
(12, 2, 1, 'EFRA', 'M', 3, 4, NULL, 'AZUL', 'P', '1', NULL, NULL, NULL);

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
(3, '7654321', 'Prueba Dos', 'Av. Humbolt', '7654321', '$2y$10$E7iOBSdv979IPSvS55tWJ.fs7ZOCly/mqwbdHsjF2O6EoaiupSmFO', NULL, NULL, NULL),
(4, '147852369', 'Prueba Tres', 'Avenica Humbolt', '7654321', '$2y$10$ZvilYlsNk/ZuDl52YXm0puI4f9kbu3m0v9ZXlrVH5iCrGNZSlhPa2', NULL, NULL, NULL);

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
(1, 'Raza común', NULL, NULL, NULL),
(2, 'Cocker', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `responsable`
--

CREATE TABLE `responsable` (
  `id` int(11) NOT NULL,
  `nombre` varchar(60) DEFAULT NULL,
  `ci` varchar(10) DEFAULT NULL,
  `establecimiento_id` int(11) DEFAULT NULL,
  `add_at` datetime DEFAULT NULL,
  `mod_at` datetime DEFAULT NULL,
  `del_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
  `fecha_vacuna` datetime DEFAULT NULL,
  `add_at` datetime DEFAULT NULL,
  `mod_at` datetime DEFAULT NULL,
  `del_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `vacunas`
--

INSERT INTO `vacunas` (`id`, `fechas_id`, `mascota_id`, `fecha_vacuna`, `add_at`, `mod_at`, `del_at`) VALUES
(1, 1, 3, NULL, '2022-07-22 09:16:13', NULL, NULL),
(2, 2, 3, NULL, '2022-07-22 10:12:33', NULL, NULL);

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
-- Indices de la tabla `responsable`
--
ALTER TABLE `responsable`
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `mascota`
--
ALTER TABLE `mascota`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `municipio`
--
ALTER TABLE `municipio`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `propietario`
--
ALTER TABLE `propietario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `raza`
--
ALTER TABLE `raza`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `responsable`
--
ALTER TABLE `responsable`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
