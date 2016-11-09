-- phpMyAdmin SQL Dump
-- version 4.3.11
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 31-10-2016 a las 00:07:06
-- Versión del servidor: 5.6.24
-- Versión de PHP: 5.6.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `geco`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `asesor`
--

CREATE TABLE IF NOT EXISTS `asesor` (
  `id` int(11) NOT NULL,
  `tipo_documento_id` int(11) DEFAULT NULL,
  `nro_documento` varchar(50) DEFAULT NULL,
  `apellidos` varchar(50) NOT NULL,
  `nombres` varchar(50) NOT NULL,
  `direccion` varchar(50) DEFAULT NULL,
  `localidad` varchar(50) DEFAULT NULL,
  `activo` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT '1970-01-01 03:00:01',
  `updated_at` timestamp NOT NULL DEFAULT '1970-01-01 03:00:01'
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `asesor`
--

INSERT INTO `asesor` (`id`, `tipo_documento_id`, `nro_documento`, `apellidos`, `nombres`, `direccion`, `localidad`, `activo`, `created_at`, `updated_at`) VALUES
(1, 1, '5423454', 'Perez', 'Roberto', 'Guateico 4323', 'Catan', 1, '1970-01-01 03:00:01', '1970-01-01 03:00:01');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `asesor_filial`
--

CREATE TABLE IF NOT EXISTS `asesor_filial` (
  `asesor_id` int(11) NOT NULL,
  `filial_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `asesor_mail`
--

CREATE TABLE IF NOT EXISTS `asesor_mail` (
  `asesor_id` int(11) NOT NULL,
  `mail` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '1970-01-01 03:00:01',
  `updated_at` timestamp NOT NULL DEFAULT '1970-01-01 03:00:01'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `asesor_telefono`
--

CREATE TABLE IF NOT EXISTS `asesor_telefono` (
  `asesor_id` int(11) NOT NULL,
  `telefono` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '1970-01-01 03:00:01',
  `updated_at` timestamp NOT NULL DEFAULT '1970-01-01 03:00:01'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `carrera`
--

CREATE TABLE IF NOT EXISTS `carrera` (
  `id` varchar(50) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `duracion` varchar(50) DEFAULT NULL,
  `descripcion` varchar(300) DEFAULT 'Sin Descripción.',
  `created_at` timestamp NOT NULL DEFAULT '1970-01-01 03:00:01',
  `updated_at` timestamp NOT NULL DEFAULT '1970-01-01 03:00:01'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `carrera`
--

INSERT INTO `carrera` (`id`, `nombre`, `duracion`, `descripcion`, `created_at`, `updated_at`) VALUES
('1', 'Carrera 1', '4', 'Sin Descripción.', '1970-01-01 03:00:01', '1970-01-01 03:00:01');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clase`
--

CREATE TABLE IF NOT EXISTS `clase` (
  `id` int(11) NOT NULL,
  `grupo_id` varchar(50) NOT NULL,
  `fecha` datetime NOT NULL,
  `descripcion` varchar(300) DEFAULT NULL,
  `docente_id` int(11) NOT NULL,
  `color` varchar(45) NOT NULL,
  `horario_desde` time NOT NULL,
  `horario_hasta` time NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '1970-01-01 03:00:01',
  `updated_at` timestamp NOT NULL DEFAULT '1970-01-01 03:00:01'
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `clase`
--

INSERT INTO `clase` (`id`, `grupo_id`, `fecha`, `descripcion`, `docente_id`, `color`, `horario_desde`, `horario_hasta`, `created_at`, `updated_at`) VALUES
(5, '1', '2016-10-25 00:00:00', 'Clase 1', 1, '#40E0D0', '01:00:00', '00:00:00', '2016-10-26 02:02:26', '2016-10-26 02:02:26'),
(6, '1', '2016-10-26 00:00:00', 'Panaderia 4', 1, '#0071c5', '06:04:00', '00:00:00', '2016-10-26 04:01:59', '2016-10-26 04:01:59'),
(7, '1', '2016-10-19 00:00:00', 'fda', 1, '#FFD700', '00:00:00', '00:00:00', '2016-10-26 04:02:28', '2016-10-26 04:02:28'),
(8, '1', '2016-10-20 00:00:00', 'wq', 1, '#000', '04:08:00', '00:00:00', '2016-10-26 04:04:41', '2016-10-26 04:04:41'),
(10, '1', '2016-10-11 00:00:00', 'descripcion de la clase', 1, '', '00:00:00', '00:00:00', '2016-10-30 15:53:10', '2016-10-30 19:02:12');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clase_matricula`
--

CREATE TABLE IF NOT EXISTS `clase_matricula` (
  `id` int(11) NOT NULL,
  `asistio` tinyint(1) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '1970-01-01 03:00:01',
  `updated_at` timestamp NOT NULL DEFAULT '1970-01-01 03:00:01',
  `matricula_id` int(11) NOT NULL,
  `clase_id` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `clase_matricula`
--

INSERT INTO `clase_matricula` (`id`, `asistio`, `created_at`, `updated_at`, `matricula_id`, `clase_id`) VALUES
(8, 1, '2016-10-28 04:41:18', '2016-10-28 04:41:18', 1000, 5),
(9, 1, '2016-10-28 04:41:18', '2016-10-28 04:41:18', 1001, 5),
(11, 0, '2016-10-29 00:28:42', '2016-10-29 00:28:42', 1000, 6),
(12, 0, '2016-10-29 00:28:42', '2016-10-29 00:28:42', 1001, 6);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `curso`
--

CREATE TABLE IF NOT EXISTS `curso` (
  `id` varchar(50) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `duracion` varchar(50) DEFAULT NULL,
  `descripcion` varchar(300) DEFAULT 'Sin Descripción.',
  `taller` tinyint(1) DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT '1970-01-01 03:00:01',
  `updated_at` timestamp NOT NULL DEFAULT '1970-01-01 03:00:01'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `curso`
--

INSERT INTO `curso` (`id`, `nombre`, `duracion`, `descripcion`, `taller`, `created_at`, `updated_at`) VALUES
('1', 'curso 1', '3', 'Sin Descripción.', 0, '1970-01-01 03:00:01', '1970-01-01 03:00:01');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `director`
--

CREATE TABLE IF NOT EXISTS `director` (
  `id` int(11) NOT NULL,
  `tipo_documento_id` int(11) DEFAULT NULL,
  `nro_documento` varchar(50) DEFAULT NULL,
  `apellidos` varchar(50) NOT NULL,
  `nombres` varchar(50) NOT NULL,
  `activo` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT '1970-01-01 03:00:01',
  `updated_at` timestamp NOT NULL DEFAULT '1970-01-01 03:00:01'
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `director`
--

INSERT INTO `director` (`id`, `tipo_documento_id`, `nro_documento`, `apellidos`, `nombres`, `activo`, `created_at`, `updated_at`) VALUES
(1, 1, '43543546', 'Rodriguez', 'Marcos', 1, '1970-01-01 03:00:01', '1970-01-01 03:00:01');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `director_mail`
--

CREATE TABLE IF NOT EXISTS `director_mail` (
  `director_id` int(11) NOT NULL,
  `mail` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '1970-01-01 03:00:01',
  `updated_at` timestamp NOT NULL DEFAULT '1970-01-01 03:00:01'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `director_telefono`
--

CREATE TABLE IF NOT EXISTS `director_telefono` (
  `director_id` int(11) NOT NULL,
  `telefono` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '1970-01-01 03:00:01',
  `updated_at` timestamp NOT NULL DEFAULT '1970-01-01 03:00:01'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `docente`
--

CREATE TABLE IF NOT EXISTS `docente` (
  `id` int(11) NOT NULL,
  `tipo_documento_id` int(11) DEFAULT NULL,
  `nro_documento` varchar(50) DEFAULT NULL,
  `apellidos` varchar(50) NOT NULL,
  `nombres` varchar(50) NOT NULL,
  `descripcion` varchar(300) DEFAULT NULL,
  `disponibilidad_manana` tinyint(1) DEFAULT NULL,
  `disponibilidad_tarde` tinyint(1) DEFAULT NULL,
  `disponibilidad_noche` tinyint(1) DEFAULT NULL,
  `disponibilidad_sabados` tinyint(1) DEFAULT NULL,
  `filial_id` int(11) NOT NULL,
  `activo` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT '1970-01-01 03:00:01',
  `updated_at` timestamp NOT NULL DEFAULT '1970-01-01 03:00:01'
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `docente`
--

INSERT INTO `docente` (`id`, `tipo_documento_id`, `nro_documento`, `apellidos`, `nombres`, `descripcion`, `disponibilidad_manana`, `disponibilidad_tarde`, `disponibilidad_noche`, `disponibilidad_sabados`, `filial_id`, `activo`, `created_at`, `updated_at`) VALUES
(1, 1, '9872345', 'Roque', 'Perez alberto', 'descripcion del docente', 1, 1, NULL, NULL, 1, 1, '1970-01-01 03:00:01', '1970-01-01 03:00:01');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `examen`
--

CREATE TABLE IF NOT EXISTS `examen` (
  `nro_acta` int(11) NOT NULL,
  `recuperatorio_nro_acta` int(11) DEFAULT NULL,
  `matricula_id` int(11) NOT NULL,
  `grupo_id` varchar(50) DEFAULT NULL,
  `nota` int(2) NOT NULL,
  `carrera_id` varchar(50) NOT NULL,
  `materia_id` varchar(50) NOT NULL,
  `docente_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '1970-01-01 03:00:01',
  `updated_at` timestamp NOT NULL DEFAULT '1970-01-01 03:00:01'
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `examen`
--

INSERT INTO `examen` (`nro_acta`, `recuperatorio_nro_acta`, `matricula_id`, `grupo_id`, `nota`, `carrera_id`, `materia_id`, `docente_id`, `created_at`, `updated_at`) VALUES
(1, 1, 1000, '1', 1, '1', '1', 1, '1970-01-01 03:00:01', '2016-10-29 19:53:07'),
(2, 2, 1000, '1', 7, '1', '1', 1, '2016-10-29 19:34:44', '2016-10-29 19:34:44'),
(3, 3, 1000, '1', 1, '1', '1', 1, '2016-10-29 19:38:08', '2016-10-29 20:21:32'),
(5, 5, 1000, '1', 7, '1', '1', 1, '2016-10-29 21:07:54', '2016-10-29 21:07:54'),
(6, 6, 1000, '1', 8, '1', '1', 1, '2016-10-29 21:09:18', '2016-10-29 21:09:18');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `filial`
--

CREATE TABLE IF NOT EXISTS `filial` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `direccion` varchar(50) DEFAULT NULL,
  `localidad` varchar(50) DEFAULT NULL,
  `codigo_postal` int(11) DEFAULT NULL,
  `director_id` int(11) NOT NULL,
  `mail` varchar(50) DEFAULT NULL,
  `activo` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT '1970-01-01 03:00:01',
  `updated_at` timestamp NOT NULL DEFAULT '1970-01-01 03:00:01'
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `filial`
--

INSERT INTO `filial` (`id`, `nombre`, `direccion`, `localidad`, `codigo_postal`, `director_id`, `mail`, `activo`, `created_at`, `updated_at`) VALUES
(1, 'Filial 1', 'Marconi 5432', 'San justo', 5432, 1, 'filial@test.com', 1, '1970-01-01 03:00:01', '1970-01-01 03:00:01');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `filial_telefono`
--

CREATE TABLE IF NOT EXISTS `filial_telefono` (
  `filial_id` int(11) NOT NULL,
  `telefono` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '1970-01-01 03:00:01',
  `updated_at` timestamp NOT NULL DEFAULT '1970-01-01 03:00:01'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `grupo`
--

CREATE TABLE IF NOT EXISTS `grupo` (
  `id` varchar(50) NOT NULL,
  `curso_id` varchar(50) DEFAULT NULL,
  `carrera_id` varchar(50) DEFAULT NULL,
  `materia_id` varchar(50) DEFAULT NULL,
  `descripcion` varchar(300) DEFAULT NULL,
  `docente_id` int(11) NOT NULL,
  `turno_manana` tinyint(1) DEFAULT NULL,
  `turno_tarde` tinyint(1) DEFAULT NULL,
  `turno_noche` tinyint(1) DEFAULT NULL,
  `sabados` tinyint(1) DEFAULT NULL,
  `fecha_inicio` datetime NOT NULL,
  `fecha_fin` datetime DEFAULT NULL,
  `filial_id` int(11) NOT NULL,
  `activo` tinyint(1) NOT NULL DEFAULT '1',
  `terminado` tinyint(1) NOT NULL DEFAULT '0',
  `cancelado` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT '1970-01-01 03:00:01',
  `updated_at` timestamp NOT NULL DEFAULT '1970-01-01 03:00:01'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `grupo`
--

INSERT INTO `grupo` (`id`, `curso_id`, `carrera_id`, `materia_id`, `descripcion`, `docente_id`, `turno_manana`, `turno_tarde`, `turno_noche`, `sabados`, `fecha_inicio`, `fecha_fin`, `filial_id`, `activo`, `terminado`, `cancelado`, `created_at`, `updated_at`) VALUES
('1', '1', '1', '1', 'descripcion del grupo', 1, 1, NULL, NULL, NULL, '2016-10-25 00:00:00', '2016-10-25 00:00:00', 1, 1, 0, 0, '2016-10-26 01:48:20', '2016-10-26 01:48:20');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `grupo_horario`
--

CREATE TABLE IF NOT EXISTS `grupo_horario` (
  `grupo_id` varchar(50) NOT NULL,
  `dia` int(1) NOT NULL,
  `horario_desde` time NOT NULL,
  `horario_hasta` time NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '1970-01-01 03:00:01',
  `updated_at` timestamp NOT NULL DEFAULT '1970-01-01 03:00:01'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `grupo_matricula`
--

CREATE TABLE IF NOT EXISTS `grupo_matricula` (
  `grupo_id` varchar(50) NOT NULL,
  `matricula_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '1970-01-01 03:00:01',
  `updated_at` timestamp NOT NULL DEFAULT '1970-01-01 03:00:01'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `grupo_matricula`
--

INSERT INTO `grupo_matricula` (`grupo_id`, `matricula_id`, `created_at`, `updated_at`) VALUES
('1', 1000, '1970-01-01 03:00:01', '1970-01-01 03:00:01'),
('1', 1001, '1970-01-01 03:00:01', '1970-01-01 03:00:01');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `materia`
--

CREATE TABLE IF NOT EXISTS `materia` (
  `id` varchar(50) NOT NULL,
  `carrera_id` varchar(50) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `descripcion` varchar(300) DEFAULT 'Sin Descripción.',
  `created_at` timestamp NOT NULL DEFAULT '1970-01-01 03:00:01',
  `updated_at` timestamp NOT NULL DEFAULT '1970-01-01 03:00:01'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `materia`
--

INSERT INTO `materia` (`id`, `carrera_id`, `nombre`, `descripcion`, `created_at`, `updated_at`) VALUES
('1', '1', 'Materia 1', 'Sin Descripción.', '1970-01-01 03:00:01', '1970-01-01 03:00:01');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `matricula`
--

CREATE TABLE IF NOT EXISTS `matricula` (
  `id` int(11) NOT NULL,
  `persona_id` int(11) NOT NULL,
  `curso_id` varchar(50) DEFAULT NULL,
  `carrera_id` varchar(50) DEFAULT NULL,
  `filial_id` int(11) DEFAULT NULL,
  `asesor_id` int(11) DEFAULT NULL,
  `activo` tinyint(1) NOT NULL DEFAULT '1',
  `terminado` tinyint(1) NOT NULL DEFAULT '0',
  `cancelado` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT '1970-01-01 03:00:01',
  `updated_at` timestamp NOT NULL DEFAULT '1970-01-01 03:00:01'
) ENGINE=InnoDB AUTO_INCREMENT=1003 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `matricula`
--

INSERT INTO `matricula` (`id`, `persona_id`, `curso_id`, `carrera_id`, `filial_id`, `asesor_id`, `activo`, `terminado`, `cancelado`, `created_at`, `updated_at`) VALUES
(1000, 1, NULL, '1', 1, 1, 1, 0, 0, '2016-10-26 02:07:13', '2016-10-26 02:07:13'),
(1001, 3, NULL, '1', 1, 1, 1, 0, 0, '2016-10-26 02:30:32', '2016-10-26 02:30:32'),
(1002, 4, NULL, '1', 1, 1, 1, 0, 0, '2016-10-26 02:30:54', '2016-10-26 02:30:54');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `matricula_permisos`
--

CREATE TABLE IF NOT EXISTS `matricula_permisos` (
  `matricula_id` int(11) NOT NULL,
  `filial_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '1970-01-01 03:00:01',
  `updated_at` timestamp NOT NULL DEFAULT '1970-01-01 03:00:01'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `matricula_permisos`
--

INSERT INTO `matricula_permisos` (`matricula_id`, `filial_id`, `created_at`, `updated_at`) VALUES
(1000, 1, '2016-10-26 02:07:13', '2016-10-26 02:07:13'),
(1001, 1, '2016-10-26 02:30:32', '2016-10-26 02:30:32'),
(1002, 1, '2016-10-26 02:30:54', '2016-10-26 02:30:54');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pago`
--

CREATE TABLE IF NOT EXISTS `pago` (
  `id` int(11) NOT NULL,
  `matricula_id` int(11) NOT NULL,
  `nro_pago` int(11) NOT NULL,
  `pago_individual` tinyint(1) DEFAULT '0',
  `descripcion` varchar(50) DEFAULT 'Sin Descripción.',
  `terminado` tinyint(1) NOT NULL DEFAULT '0',
  `vencimiento` date DEFAULT NULL,
  `monto_original` float NOT NULL,
  `monto_actual` float DEFAULT NULL,
  `monto_pago` float DEFAULT NULL,
  `recargo` float NOT NULL,
  `filial_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '1970-01-01 03:00:01',
  `updated_at` timestamp NOT NULL DEFAULT '1970-01-01 03:00:01'
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `pago`
--

INSERT INTO `pago` (`id`, `matricula_id`, `nro_pago`, `pago_individual`, `descripcion`, `terminado`, `vencimiento`, `monto_original`, `monto_actual`, `monto_pago`, `recargo`, `filial_id`, `created_at`, `updated_at`) VALUES
(1, 1000, 0, 0, '', 0, '0000-00-00', 0, 0, NULL, 0, 1, '2016-10-26 02:07:13', '2016-10-26 02:07:13'),
(2, 1001, 0, 0, '', 0, '0000-00-00', 0, 0, NULL, 0, 1, '2016-10-26 02:30:33', '2016-10-26 02:30:33');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `persona`
--

CREATE TABLE IF NOT EXISTS `persona` (
  `id` int(11) NOT NULL,
  `tipo_documento_id` int(11) DEFAULT NULL,
  `nro_documento` varchar(50) DEFAULT NULL,
  `apellidos` varchar(50) NOT NULL,
  `nombres` varchar(50) NOT NULL,
  `genero` char(1) DEFAULT NULL,
  `fecha_nacimiento` date DEFAULT NULL,
  `domicilio` varchar(50) DEFAULT NULL,
  `localidad` varchar(50) DEFAULT NULL,
  `estado_civil` varchar(50) DEFAULT NULL,
  `nivel_estudios` varchar(50) DEFAULT NULL,
  `estudio_computacion` tinyint(1) DEFAULT NULL,
  `posee_computadora` tinyint(1) DEFAULT NULL,
  `disponibilidad_manana` tinyint(1) DEFAULT NULL,
  `disponibilidad_tarde` tinyint(1) DEFAULT NULL,
  `disponibilidad_noche` tinyint(1) DEFAULT NULL,
  `disponibilidad_sabados` tinyint(1) DEFAULT NULL,
  `aclaraciones` varchar(300) DEFAULT NULL,
  `filial_id` int(11) NOT NULL,
  `asesor_id` int(11) NOT NULL,
  `activo` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `persona`
--

INSERT INTO `persona` (`id`, `tipo_documento_id`, `nro_documento`, `apellidos`, `nombres`, `genero`, `fecha_nacimiento`, `domicilio`, `localidad`, `estado_civil`, `nivel_estudios`, `estudio_computacion`, `posee_computadora`, `disponibilidad_manana`, `disponibilidad_tarde`, `disponibilidad_noche`, `disponibilidad_sabados`, `aclaraciones`, `filial_id`, `asesor_id`, `activo`, `created_at`, `updated_at`) VALUES
(1, 1, '35432543', 'Rocha', 'Leandro', 'M', '2016-01-31', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, '', 1, 1, 1, '2016-10-26 02:07:13', '2016-10-26 02:07:13'),
(3, 1, '42343423', 'Perez', 'Leandro', NULL, '0000-00-00', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, '', 1, 1, 1, '2016-10-26 02:30:31', '2016-10-26 02:30:31'),
(4, 1, '435454343', 'Rodriguez', 'Leandro', 'M', '0000-00-00', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, '', 1, 1, 1, '2016-10-26 02:30:54', '2016-10-26 02:30:54');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `persona_interes`
--

CREATE TABLE IF NOT EXISTS `persona_interes` (
  `id` int(11) NOT NULL,
  `preinforme_id` int(11) DEFAULT NULL,
  `persona_id` int(11) NOT NULL,
  `carrera_id` varchar(50) DEFAULT NULL,
  `curso_id` varchar(50) DEFAULT NULL,
  `descripcion` varchar(300) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '1970-01-01 03:00:01',
  `updated_at` timestamp NOT NULL DEFAULT '1970-01-01 03:00:01'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `persona_mail`
--

CREATE TABLE IF NOT EXISTS `persona_mail` (
  `persona_id` int(11) NOT NULL,
  `mail` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `persona_mail`
--

INSERT INTO `persona_mail` (`persona_id`, `mail`, `created_at`, `updated_at`) VALUES
(1, '', '2016-10-26 02:07:13', '2016-10-26 02:07:13'),
(3, '', '2016-10-26 02:30:32', '2016-10-26 02:30:32'),
(4, '', '2016-10-26 02:30:54', '2016-10-26 02:30:54');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `persona_telefono`
--

CREATE TABLE IF NOT EXISTS `persona_telefono` (
  `persona_id` int(11) NOT NULL,
  `telefono` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '1970-01-01 03:00:01',
  `updated_at` timestamp NOT NULL DEFAULT '1970-01-01 03:00:01'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `persona_telefono`
--

INSERT INTO `persona_telefono` (`persona_id`, `telefono`, `created_at`, `updated_at`) VALUES
(1, '', '2016-10-26 02:07:13', '2016-10-26 02:07:13'),
(3, '', '2016-10-26 02:30:32', '2016-10-26 02:30:32'),
(4, '', '2016-10-26 02:30:54', '2016-10-26 02:30:54');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `preinforme`
--

CREATE TABLE IF NOT EXISTS `preinforme` (
  `id` int(11) NOT NULL,
  `persona_id` int(11) NOT NULL,
  `asesor_id` int(11) NOT NULL,
  `descripcion` varchar(300) DEFAULT NULL,
  `medio` varchar(50) DEFAULT NULL,
  `como_encontro` varchar(50) DEFAULT NULL,
  `filial_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '1970-01-01 03:00:01',
  `updated_at` timestamp NOT NULL DEFAULT '1970-01-01 03:00:01'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `recibo`
--

CREATE TABLE IF NOT EXISTS `recibo` (
  `id` int(11) NOT NULL,
  `recibo_tipo_id` int(11) NOT NULL,
  `pago_id` int(11) NOT NULL,
  `monto` float NOT NULL,
  `fecha` datetime NOT NULL,
  `recibo_concepto_pago_id` int(11) NOT NULL,
  `descripcion` varchar(50) DEFAULT NULL,
  `filial_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '1970-01-01 03:00:01',
  `updated_at` timestamp NOT NULL DEFAULT '1970-01-01 03:00:01'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `recibo_concepto_pago`
--

CREATE TABLE IF NOT EXISTS `recibo_concepto_pago` (
  `id` int(11) NOT NULL,
  `concepto_pago` varchar(50) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '1970-01-01 03:00:01',
  `updated_at` timestamp NOT NULL DEFAULT '1970-01-01 03:00:01'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `recibo_tipo`
--

CREATE TABLE IF NOT EXISTS `recibo_tipo` (
  `id` int(11) NOT NULL,
  `recibo_tipo` char(1) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '1970-01-01 03:00:01',
  `updated_at` timestamp NOT NULL DEFAULT '1970-01-01 03:00:01'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_documento`
--

CREATE TABLE IF NOT EXISTS `tipo_documento` (
  `id` int(11) NOT NULL,
  `tipo_documento` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '1970-01-01 03:00:01',
  `updated_at` timestamp NOT NULL DEFAULT '1970-01-01 03:00:01'
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tipo_documento`
--

INSERT INTO `tipo_documento` (`id`, `tipo_documento`, `created_at`, `updated_at`) VALUES
(1, 'Dni', '1970-01-01 03:00:01', '1970-01-01 03:00:01');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `asesor`
--
ALTER TABLE `asesor`
  ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `tipo_documento_id` (`tipo_documento_id`,`nro_documento`);

--
-- Indices de la tabla `asesor_filial`
--
ALTER TABLE `asesor_filial`
  ADD PRIMARY KEY (`asesor_id`,`filial_id`), ADD KEY `filial_id` (`filial_id`);

--
-- Indices de la tabla `asesor_mail`
--
ALTER TABLE `asesor_mail`
  ADD PRIMARY KEY (`asesor_id`,`mail`);

--
-- Indices de la tabla `asesor_telefono`
--
ALTER TABLE `asesor_telefono`
  ADD PRIMARY KEY (`asesor_id`,`telefono`);

--
-- Indices de la tabla `carrera`
--
ALTER TABLE `carrera`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `clase`
--
ALTER TABLE `clase`
  ADD PRIMARY KEY (`id`), ADD KEY `docente_id` (`docente_id`), ADD KEY `grupo_id` (`grupo_id`);

--
-- Indices de la tabla `clase_matricula`
--
ALTER TABLE `clase_matricula`
  ADD PRIMARY KEY (`id`), ADD KEY `matricula_id` (`matricula_id`), ADD KEY `clase_id` (`clase_id`);

--
-- Indices de la tabla `curso`
--
ALTER TABLE `curso`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `director`
--
ALTER TABLE `director`
  ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `tipo_documento_id` (`tipo_documento_id`,`nro_documento`);

--
-- Indices de la tabla `director_mail`
--
ALTER TABLE `director_mail`
  ADD PRIMARY KEY (`director_id`,`mail`);

--
-- Indices de la tabla `director_telefono`
--
ALTER TABLE `director_telefono`
  ADD PRIMARY KEY (`director_id`,`telefono`);

--
-- Indices de la tabla `docente`
--
ALTER TABLE `docente`
  ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `tipo_documento_id` (`tipo_documento_id`,`nro_documento`), ADD KEY `filial_id` (`filial_id`);

--
-- Indices de la tabla `examen`
--
ALTER TABLE `examen`
  ADD PRIMARY KEY (`nro_acta`,`matricula_id`), ADD KEY `recuperatorio_nro_acta` (`recuperatorio_nro_acta`,`matricula_id`), ADD KEY `grupo_id` (`grupo_id`), ADD KEY `carrera_id` (`carrera_id`,`materia_id`), ADD KEY `docente_id` (`docente_id`);

--
-- Indices de la tabla `filial`
--
ALTER TABLE `filial`
  ADD PRIMARY KEY (`id`), ADD KEY `director_id` (`director_id`);

--
-- Indices de la tabla `filial_telefono`
--
ALTER TABLE `filial_telefono`
  ADD PRIMARY KEY (`filial_id`,`telefono`);

--
-- Indices de la tabla `grupo`
--
ALTER TABLE `grupo`
  ADD PRIMARY KEY (`id`), ADD KEY `curso_id` (`curso_id`), ADD KEY `carrera_id` (`carrera_id`,`materia_id`), ADD KEY `docente_id` (`docente_id`), ADD KEY `filial_id` (`filial_id`);

--
-- Indices de la tabla `grupo_horario`
--
ALTER TABLE `grupo_horario`
  ADD PRIMARY KEY (`grupo_id`,`dia`,`horario_desde`,`horario_hasta`);

--
-- Indices de la tabla `grupo_matricula`
--
ALTER TABLE `grupo_matricula`
  ADD PRIMARY KEY (`grupo_id`,`matricula_id`), ADD KEY `matricula_id` (`matricula_id`);

--
-- Indices de la tabla `materia`
--
ALTER TABLE `materia`
  ADD PRIMARY KEY (`id`,`carrera_id`), ADD KEY `carrera_id` (`carrera_id`);

--
-- Indices de la tabla `matricula`
--
ALTER TABLE `matricula`
  ADD PRIMARY KEY (`id`), ADD KEY `persona_id` (`persona_id`), ADD KEY `curso_id` (`curso_id`), ADD KEY `carrera_id` (`carrera_id`), ADD KEY `filial_id` (`filial_id`), ADD KEY `asesor_id` (`asesor_id`);

--
-- Indices de la tabla `matricula_permisos`
--
ALTER TABLE `matricula_permisos`
  ADD PRIMARY KEY (`matricula_id`,`filial_id`), ADD KEY `filial_id` (`filial_id`);

--
-- Indices de la tabla `pago`
--
ALTER TABLE `pago`
  ADD PRIMARY KEY (`id`), ADD KEY `matricula_id` (`matricula_id`), ADD KEY `filial_id` (`filial_id`);

--
-- Indices de la tabla `persona`
--
ALTER TABLE `persona`
  ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `tipo_documento_id` (`tipo_documento_id`,`nro_documento`), ADD KEY `filial_id` (`filial_id`), ADD KEY `asesor_id` (`asesor_id`);

--
-- Indices de la tabla `persona_interes`
--
ALTER TABLE `persona_interes`
  ADD PRIMARY KEY (`id`), ADD KEY `persona_id` (`persona_id`), ADD KEY `preinforme_id` (`preinforme_id`), ADD KEY `carrera_id` (`carrera_id`), ADD KEY `curso_id` (`curso_id`);

--
-- Indices de la tabla `persona_mail`
--
ALTER TABLE `persona_mail`
  ADD PRIMARY KEY (`persona_id`,`mail`);

--
-- Indices de la tabla `persona_telefono`
--
ALTER TABLE `persona_telefono`
  ADD PRIMARY KEY (`persona_id`,`telefono`);

--
-- Indices de la tabla `preinforme`
--
ALTER TABLE `preinforme`
  ADD PRIMARY KEY (`id`), ADD KEY `persona_id` (`persona_id`), ADD KEY `asesor_id` (`asesor_id`), ADD KEY `filial_id` (`filial_id`);

--
-- Indices de la tabla `recibo`
--
ALTER TABLE `recibo`
  ADD PRIMARY KEY (`id`), ADD KEY `recibo_tipo_id` (`recibo_tipo_id`), ADD KEY `pago_id` (`pago_id`), ADD KEY `recibo_concepto_pago_id` (`recibo_concepto_pago_id`), ADD KEY `filial_id` (`filial_id`);

--
-- Indices de la tabla `recibo_concepto_pago`
--
ALTER TABLE `recibo_concepto_pago`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `recibo_tipo`
--
ALTER TABLE `recibo_tipo`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tipo_documento`
--
ALTER TABLE `tipo_documento`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `asesor`
--
ALTER TABLE `asesor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `clase`
--
ALTER TABLE `clase`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT de la tabla `clase_matricula`
--
ALTER TABLE `clase_matricula`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT de la tabla `director`
--
ALTER TABLE `director`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `docente`
--
ALTER TABLE `docente`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `examen`
--
ALTER TABLE `examen`
  MODIFY `nro_acta` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT de la tabla `filial`
--
ALTER TABLE `filial`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `matricula`
--
ALTER TABLE `matricula`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=1003;
--
-- AUTO_INCREMENT de la tabla `pago`
--
ALTER TABLE `pago`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `persona`
--
ALTER TABLE `persona`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `persona_interes`
--
ALTER TABLE `persona_interes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `preinforme`
--
ALTER TABLE `preinforme`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `recibo_concepto_pago`
--
ALTER TABLE `recibo_concepto_pago`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `recibo_tipo`
--
ALTER TABLE `recibo_tipo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `tipo_documento`
--
ALTER TABLE `tipo_documento`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `asesor`
--
ALTER TABLE `asesor`
ADD CONSTRAINT `asesor_ibfk_1` FOREIGN KEY (`tipo_documento_id`) REFERENCES `tipo_documento` (`id`);

--
-- Filtros para la tabla `asesor_filial`
--
ALTER TABLE `asesor_filial`
ADD CONSTRAINT `asesor_filial_ibfk_1` FOREIGN KEY (`asesor_id`) REFERENCES `asesor` (`id`),
ADD CONSTRAINT `asesor_filial_ibfk_2` FOREIGN KEY (`filial_id`) REFERENCES `filial` (`id`);

--
-- Filtros para la tabla `asesor_mail`
--
ALTER TABLE `asesor_mail`
ADD CONSTRAINT `asesor_mail_ibfk_1` FOREIGN KEY (`asesor_id`) REFERENCES `asesor` (`id`);

--
-- Filtros para la tabla `asesor_telefono`
--
ALTER TABLE `asesor_telefono`
ADD CONSTRAINT `asesor_telefono_ibfk_1` FOREIGN KEY (`asesor_id`) REFERENCES `asesor` (`id`);

--
-- Filtros para la tabla `clase`
--
ALTER TABLE `clase`
ADD CONSTRAINT `clase_ibfk_1` FOREIGN KEY (`grupo_id`) REFERENCES `grupo` (`id`),
ADD CONSTRAINT `clase_ibfk_2` FOREIGN KEY (`docente_id`) REFERENCES `docente` (`id`);

--
-- Filtros para la tabla `clase_matricula`
--
ALTER TABLE `clase_matricula`
ADD CONSTRAINT `clase_matricula_ibfk_1` FOREIGN KEY (`matricula_id`) REFERENCES `matricula` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `clase_matricula_ibfk_2` FOREIGN KEY (`clase_id`) REFERENCES `clase` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `director_mail`
--
ALTER TABLE `director_mail`
ADD CONSTRAINT `director_mail_ibfk_1` FOREIGN KEY (`director_id`) REFERENCES `director` (`id`);

--
-- Filtros para la tabla `director_telefono`
--
ALTER TABLE `director_telefono`
ADD CONSTRAINT `director_telefono_ibfk_1` FOREIGN KEY (`director_id`) REFERENCES `director` (`id`);

--
-- Filtros para la tabla `docente`
--
ALTER TABLE `docente`
ADD CONSTRAINT `docente_ibfk_1` FOREIGN KEY (`tipo_documento_id`) REFERENCES `tipo_documento` (`id`),
ADD CONSTRAINT `docente_ibfk_2` FOREIGN KEY (`filial_id`) REFERENCES `filial` (`id`);

--
-- Filtros para la tabla `examen`
--
ALTER TABLE `examen`
ADD CONSTRAINT `examen_ibfk_1` FOREIGN KEY (`recuperatorio_nro_acta`, `matricula_id`) REFERENCES `examen` (`nro_acta`, `matricula_id`),
ADD CONSTRAINT `examen_ibfk_2` FOREIGN KEY (`grupo_id`) REFERENCES `grupo` (`id`),
ADD CONSTRAINT `examen_ibfk_3` FOREIGN KEY (`carrera_id`, `materia_id`) REFERENCES `materia` (`carrera_id`, `id`),
ADD CONSTRAINT `examen_ibfk_4` FOREIGN KEY (`docente_id`) REFERENCES `docente` (`id`);

--
-- Filtros para la tabla `filial`
--
ALTER TABLE `filial`
ADD CONSTRAINT `filial_ibfk_1` FOREIGN KEY (`director_id`) REFERENCES `director` (`id`);

--
-- Filtros para la tabla `filial_telefono`
--
ALTER TABLE `filial_telefono`
ADD CONSTRAINT `filial_telefono_ibfk_1` FOREIGN KEY (`filial_id`) REFERENCES `filial` (`id`);

--
-- Filtros para la tabla `grupo`
--
ALTER TABLE `grupo`
ADD CONSTRAINT `grupo_ibfk_1` FOREIGN KEY (`curso_id`) REFERENCES `curso` (`id`),
ADD CONSTRAINT `grupo_ibfk_2` FOREIGN KEY (`carrera_id`, `materia_id`) REFERENCES `materia` (`carrera_id`, `id`),
ADD CONSTRAINT `grupo_ibfk_3` FOREIGN KEY (`docente_id`) REFERENCES `docente` (`id`),
ADD CONSTRAINT `grupo_ibfk_4` FOREIGN KEY (`filial_id`) REFERENCES `filial` (`id`);

--
-- Filtros para la tabla `grupo_horario`
--
ALTER TABLE `grupo_horario`
ADD CONSTRAINT `grupo_horario_ibfk_1` FOREIGN KEY (`grupo_id`) REFERENCES `grupo` (`id`);

--
-- Filtros para la tabla `grupo_matricula`
--
ALTER TABLE `grupo_matricula`
ADD CONSTRAINT `grupo_matricula_ibfk_1` FOREIGN KEY (`grupo_id`) REFERENCES `grupo` (`id`),
ADD CONSTRAINT `grupo_matricula_ibfk_2` FOREIGN KEY (`matricula_id`) REFERENCES `matricula` (`id`);

--
-- Filtros para la tabla `materia`
--
ALTER TABLE `materia`
ADD CONSTRAINT `materia_ibfk_1` FOREIGN KEY (`carrera_id`) REFERENCES `carrera` (`id`);

--
-- Filtros para la tabla `matricula`
--
ALTER TABLE `matricula`
ADD CONSTRAINT `matricula_ibfk_1` FOREIGN KEY (`persona_id`) REFERENCES `persona` (`id`),
ADD CONSTRAINT `matricula_ibfk_2` FOREIGN KEY (`curso_id`) REFERENCES `curso` (`id`),
ADD CONSTRAINT `matricula_ibfk_3` FOREIGN KEY (`carrera_id`) REFERENCES `carrera` (`id`),
ADD CONSTRAINT `matricula_ibfk_4` FOREIGN KEY (`filial_id`) REFERENCES `filial` (`id`),
ADD CONSTRAINT `matricula_ibfk_5` FOREIGN KEY (`asesor_id`) REFERENCES `asesor` (`id`);

--
-- Filtros para la tabla `matricula_permisos`
--
ALTER TABLE `matricula_permisos`
ADD CONSTRAINT `matricula_permisos_ibfk_1` FOREIGN KEY (`matricula_id`) REFERENCES `matricula` (`id`),
ADD CONSTRAINT `matricula_permisos_ibfk_2` FOREIGN KEY (`filial_id`) REFERENCES `filial` (`id`);

--
-- Filtros para la tabla `pago`
--
ALTER TABLE `pago`
ADD CONSTRAINT `pago_ibfk_1` FOREIGN KEY (`matricula_id`) REFERENCES `matricula` (`id`),
ADD CONSTRAINT `pago_ibfk_2` FOREIGN KEY (`filial_id`) REFERENCES `filial` (`id`);

--
-- Filtros para la tabla `persona`
--
ALTER TABLE `persona`
ADD CONSTRAINT `persona_ibfk_1` FOREIGN KEY (`tipo_documento_id`) REFERENCES `tipo_documento` (`id`),
ADD CONSTRAINT `persona_ibfk_2` FOREIGN KEY (`filial_id`) REFERENCES `filial` (`id`),
ADD CONSTRAINT `persona_ibfk_3` FOREIGN KEY (`asesor_id`) REFERENCES `asesor` (`id`);

--
-- Filtros para la tabla `persona_interes`
--
ALTER TABLE `persona_interes`
ADD CONSTRAINT `persona_interes_ibfk_1` FOREIGN KEY (`persona_id`) REFERENCES `persona` (`id`),
ADD CONSTRAINT `persona_interes_ibfk_2` FOREIGN KEY (`preinforme_id`) REFERENCES `preinforme` (`id`),
ADD CONSTRAINT `persona_interes_ibfk_3` FOREIGN KEY (`carrera_id`) REFERENCES `carrera` (`id`),
ADD CONSTRAINT `persona_interes_ibfk_4` FOREIGN KEY (`curso_id`) REFERENCES `curso` (`id`);

--
-- Filtros para la tabla `persona_mail`
--
ALTER TABLE `persona_mail`
ADD CONSTRAINT `persona_mail_ibfk_1` FOREIGN KEY (`persona_id`) REFERENCES `persona` (`id`);

--
-- Filtros para la tabla `persona_telefono`
--
ALTER TABLE `persona_telefono`
ADD CONSTRAINT `persona_telefono_ibfk_1` FOREIGN KEY (`persona_id`) REFERENCES `persona` (`id`);

--
-- Filtros para la tabla `preinforme`
--
ALTER TABLE `preinforme`
ADD CONSTRAINT `preinforme_ibfk_1` FOREIGN KEY (`persona_id`) REFERENCES `persona` (`id`),
ADD CONSTRAINT `preinforme_ibfk_2` FOREIGN KEY (`asesor_id`) REFERENCES `asesor` (`id`),
ADD CONSTRAINT `preinforme_ibfk_3` FOREIGN KEY (`filial_id`) REFERENCES `filial` (`id`);

--
-- Filtros para la tabla `recibo`
--
ALTER TABLE `recibo`
ADD CONSTRAINT `recibo_ibfk_1` FOREIGN KEY (`recibo_tipo_id`) REFERENCES `recibo_tipo` (`id`),
ADD CONSTRAINT `recibo_ibfk_2` FOREIGN KEY (`pago_id`) REFERENCES `pago` (`id`),
ADD CONSTRAINT `recibo_ibfk_3` FOREIGN KEY (`recibo_concepto_pago_id`) REFERENCES `recibo_concepto_pago` (`id`),
ADD CONSTRAINT `recibo_ibfk_4` FOREIGN KEY (`filial_id`) REFERENCES `filial` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
