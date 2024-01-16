-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 07-01-2024 a las 03:57:47
-- Versión del servidor: 10.4.28-MariaDB
-- Versión de PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `sabaticos`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `fichainscripcion`
--

CREATE TABLE `fichainscripcion` (
  `idFichaInscripcion` int(11) NOT NULL,
  `fechaAlta` date NOT NULL,
  `apellidopaterno` text NOT NULL,
  `apellidomaterno` text NOT NULL,
  `nombres` text NOT NULL,
  `fecha_nac` date NOT NULL,
  `direccion` text NOT NULL,
  `cd` int(5) NOT NULL,
  `municipio` text NOT NULL,
  `estado` text NOT NULL,
  `pais` text NOT NULL,
  `tel_fijo` text NOT NULL,
  `tel_mov` text NOT NULL,
  `correo` text NOT NULL,
  `alumno` text NOT NULL,
  `externo` text NOT NULL,
  `nombre_curso` text NOT NULL,
  `horario_curso` text NOT NULL,
  `re_de_con` text NOT NULL,
  `correo_ut` text NOT NULL,
  `pag_internet` text NOT NULL,
  `pag_int_ut` text NOT NULL,
  `prensa_escrita` text NOT NULL,
  `otro` text NOT NULL,
  `id_usuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `fichainscripcion`
--

INSERT INTO `fichainscripcion` (`idFichaInscripcion`, `fechaAlta`, `apellidopaterno`, `apellidomaterno`, `nombres`, `fecha_nac`, `direccion`, `cd`, `municipio`, `estado`, `pais`, `tel_fijo`, `tel_mov`, `correo`, `alumno`, `externo`, `nombre_curso`, `horario_curso`, `re_de_con`, `correo_ut`, `pag_internet`, `pag_int_ut`, `prensa_escrita`, `otro`, `id_usuario`) VALUES
(55600, '2023-06-02', 'Rubio', 'González', 'Jesús Oliverio', '2023-06-02', 'Paseo de los limones #120 Paseo de las Torres', 5, 'García', 'Nuevo León', 'México', '2222222222', '8812345678', 'rubiogonzalez1004@gmail.com', 'x', '', 'Inglés', '8:00 a 2:00', '', 'x', '', '', '', '', 2),
(55601, '2023-06-06', 'Rubio', 'González', 'Carmen Paola', '2004-04-23', 'Paseo de los limones #120 Paseo de las Torres', 66004, 'García', 'Nuevo León', 'México', '2222222222', '8812345678', 'Paola1@gmail.com', '', 'x', 'Inglés', '9:00 a 3:00', '', 'x', '', '', '', '', 9),
(55603, '2023-06-07', 'Galvan ', 'Contreras', 'Sergio Ulises', '1975-07-31', 'Sierra real #15 16 de septiembre', 66099, 'santa catarina', 'Nuevo León', 'México', '2222222222', '8812345678', 'salvan@utsc.edu.mx', 'x', '', 'frances', '8:00 a 3:00', '', 'x', '', '', '', '', 10),
(55604, '2023-06-13', 'Rubio', 'González', 'Jesús Oliverio', '2003-07-14', 'Paseo de los limones #120 Paseo de las Torres', 66004, 'García', 'Nuevo León', 'México', '2222222222', '8812345678', 'Giorno@gmail.com', 'x', '', 'Inglés', '8:00 a 2:00', '', '', 'x', '', '', '', 12),
(55609, '0001-11-11', 'a', 'a', 'a', '0001-11-11', 'aaa', 2, 'a', 'a', 'a', '1', '1', 'a@gmail.com', '', 'x', 'a', 'a', 'x', '', '', '', '', '', 14);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `grupos`
--

CREATE TABLE `grupos` (
  `id` int(11) NOT NULL,
  `grado` text NOT NULL,
  `grupo` int(1) NOT NULL,
  `periodo` enum('Enero-Abril','Mayo-Agosto','Septiembre-Diciembre') NOT NULL,
  `año` int(4) NOT NULL,
  `alumnos_count` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `grupos`
--

INSERT INTO `grupos` (`id`, `grado`, `grupo`, `periodo`, `año`, `alumnos_count`) VALUES
(1, 'a', 1, 'Mayo-Agosto', 2023, 0),
(3, 'b', 1, 'Mayo-Agosto', 2023, 0),
(4, 'c', 1, 'Mayo-Agosto', 2023, 0),
(5, 'd', 1, 'Mayo-Agosto', 2023, 0),
(6, 'e', 1, 'Mayo-Agosto', 2023, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `nuevoingreso`
--

CREATE TABLE `nuevoingreso` (
  `idNuevoIngreso` int(11) NOT NULL,
  `apellidopaterno` text NOT NULL,
  `apellidomaterno` text NOT NULL,
  `nombres` text NOT NULL,
  `alumnoextranjero` enum('alumno','externo') NOT NULL,
  `matricula` int(11) NOT NULL,
  `nivel` enum('1','2','3','4','5','6','7','8','9','10','11') NOT NULL,
  `fichaingreso` text NOT NULL,
  `comprobantepago` text NOT NULL,
  `id_usuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `nuevoingreso`
--

INSERT INTO `nuevoingreso` (`idNuevoIngreso`, `apellidopaterno`, `apellidomaterno`, `nombres`, `alumnoextranjero`, `matricula`, `nivel`, `fichaingreso`, `comprobantepago`, `id_usuario`) VALUES
(26, 'Rubio', 'González', 'Jesús Oliverio', 'alumno', 19351, '1', '1685733771_archivo (1).pdf', '1685733771_fichainscripciónJORG.pdf', 2),
(27, 'Rubio', 'González', 'Carmen Paola', 'externo', 0, '1', '1686068543_CPRG_FI.pdf', '1686068543_Presentación2.pdf', 9),
(29, 'Galvan ', 'Contreras', 'Sergio Ulises', 'alumno', 99898, '1', '1686154560_SUGC.pdf', '1686154560_archivo (1).pdf', 10),
(30, 'Rubio', 'González', 'Jesús Oliverio', 'alumno', 19351, '1', '', '', 12),
(35, 'a', 'a', 'a', 'externo', 12345, '1', '', '', 14);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `temporal_nuevoingreso`
--

CREATE TABLE `temporal_nuevoingreso` (
  `idNuevoIngreso` int(11) NOT NULL,
  `apellidopaterno` text NOT NULL,
  `apellidomaterno` text NOT NULL,
  `nombres` text NOT NULL,
  `alumnoextranjero` enum('alumno','externo') NOT NULL,
  `matricula` int(11) NOT NULL,
  `nivel` enum('1','2','3','4','5','6','7','8','9','10','11') NOT NULL,
  `fichaingreso` text NOT NULL,
  `comprobantepago` text NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `aprobado` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `temporal_nuevoingreso`
--

INSERT INTO `temporal_nuevoingreso` (`idNuevoIngreso`, `apellidopaterno`, `apellidomaterno`, `nombres`, `alumnoextranjero`, `matricula`, `nivel`, `fichaingreso`, `comprobantepago`, `id_usuario`, `aprobado`) VALUES
(30, 'Rubio', 'González', 'Jesús Oliverio', 'alumno', 19351, '1', '1685733771_archivo (1).pdf', '1685733771_fichainscripciónJORG.pdf', 2, 0),
(31, 'Rubio', 'González', 'Carmen Paola', 'externo', 0, '1', '1686068543_CPRG_FI.pdf', '1686068543_Presentación2.pdf', 9, 0),
(33, 'Galvan ', 'Contreras', 'Sergio Ulises', 'alumno', 99898, '1', '1686154560_SUGC.pdf', '1686154560_archivo (1).pdf', 10, 0),
(36, 'a', 'a', 'a', 'externo', 12345, '1', '', '', 14, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `id` int(11) NOT NULL,
  `usuario` text NOT NULL,
  `password` text NOT NULL,
  `correo` text NOT NULL,
  `tipo` enum('alumno','maestro','administrador') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id`, `usuario`, `password`, `correo`, `tipo`) VALUES
(1, 'Emi', 'Emiliano', 'Emi@gmail.com', 'administrador'),
(2, 'Jesús2005', '200520052005', 'rubiogonzalez1004@gmail.com', 'alumno'),
(3, 'Luis123', '123123123', 'Luis@gmail.com', 'maestro'),
(8, 'Carmen', 'Carmen', 'Carmen@gmail.com', 'maestro'),
(9, 'Paola', 'PaolaPaolaPaola', 'Paola1@gmail.com', 'alumno'),
(10, 'Ulises', '1234', 'salvan@utsc.edu.mx', 'alumno'),
(11, 'luis123', 'luis123', 'luis123@gmail.com', 'alumno'),
(12, 'Giorno', 'Giorno', 'Giorno@gmail.com', 'alumno'),
(13, 'Beto', 'luis1', 'at4253102@gmail.com', 'alumno'),
(14, 'a', 'a', 'a@gmail.com', 'alumno'),
(15, 'Eduardo', 'Eduardo', 'Eduardo@gmail.com', 'alumno'),
(16, 'eduardo', 'pikachu', 'senagarzaeduardoismael@gmail.com', 'alumno'),
(19, 's', 's', 's@gmail.com', 'alumno'),
(20, 'd', 'd', 'd@gmail.com', 'alumno'),
(21, 'Vincentk', 'Vincent', 'Vincent@gmai.com', 'alumno'),
(24, 'q', 'q', 'q@gmail.com', 'alumno');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `fichainscripcion`
--
ALTER TABLE `fichainscripcion`
  ADD PRIMARY KEY (`idFichaInscripcion`);

--
-- Indices de la tabla `grupos`
--
ALTER TABLE `grupos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `nuevoingreso`
--
ALTER TABLE `nuevoingreso`
  ADD PRIMARY KEY (`idNuevoIngreso`);

--
-- Indices de la tabla `temporal_nuevoingreso`
--
ALTER TABLE `temporal_nuevoingreso`
  ADD PRIMARY KEY (`idNuevoIngreso`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `fichainscripcion`
--
ALTER TABLE `fichainscripcion`
  MODIFY `idFichaInscripcion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55610;

--
-- AUTO_INCREMENT de la tabla `grupos`
--
ALTER TABLE `grupos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `nuevoingreso`
--
ALTER TABLE `nuevoingreso`
  MODIFY `idNuevoIngreso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT de la tabla `temporal_nuevoingreso`
--
ALTER TABLE `temporal_nuevoingreso`
  MODIFY `idNuevoIngreso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
