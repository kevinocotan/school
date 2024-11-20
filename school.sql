-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 20-11-2024 a las 08:26:37
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
-- Base de datos: `school`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alumnos`
--

CREATE TABLE `alumnos` (
  `id_alumno` int(11) NOT NULL,
  `nombre_completo` varchar(255) NOT NULL,
  `direccion` varchar(255) NOT NULL,
  `telefono` varchar(15) NOT NULL,
  `email` varchar(255) NOT NULL,
  `foto` varchar(255) NOT NULL,
  `genero` enum('Masculino','Femenino') NOT NULL,
  `latitud` decimal(9,6) NOT NULL,
  `longitud` decimal(9,6) NOT NULL,
  `id_grado` int(11) NOT NULL,
  `id_seccion` int(11) NOT NULL,
  `id_school` int(11) NOT NULL,
  `id_usr` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `alumnos`
--

INSERT INTO `alumnos` (`id_alumno`, `nombre_completo`, `direccion`, `telefono`, `email`, `foto`, `genero`, `latitud`, `longitud`, `id_grado`, `id_seccion`, `id_school`, `id_usr`) VALUES
(1, 'Carlos Alberto Hernández Pérez', 'Calle El Progreso, San Salvador', '79234567', 'carlos.hernandez@gmail.com', '', 'Masculino', 13.807132, -89.181020, 1, 1, 1, 3),
(2, 'María Fernanda González Rodríguez', 'Calle El Pedregal, San Salvador', '72234567', 'maria.gonzalez@hotmail.com', '/school/public_html/fotos/alumna1.jpg', 'Femenino', 13.708912, -89.220039, 2, 1, 2, 4),
(3, 'Luis Fernando Hernández Pérez', 'Avenida Monseñor Romero, San Salvador', '73523456', 'luis.mendez@yahoo.com', '', 'Masculino', 13.593768, -89.291596, 3, 2, 7, 5),
(4, 'Ana María Jiménez Pérez', 'Calle La Cima, Santa Ana', '75456789', 'ana.jimenez@gmail.com', '', 'Femenino', 13.997581, -89.555273, 4, 2, 4, 6),
(5, 'José Antonio Martínez López', 'Calle Principal, San Vicente', '78543210', 'jose.martinez@hotmail.com', '', 'Masculino', 13.581453, -88.018725, 5, 3, 5, 7),
(6, 'Elena Patricia Díaz García', 'Boulevard de Los Héroes, San Salvador', '78345678', 'elena.diaz@gmail.com', '', 'Femenino', 13.713599, -89.214184, 6, 3, 7, 8),
(7, 'Fernando Javier Rodríguez Martínez', 'Calle Don Bosco, San Salvador', '79123456', 'fernando.rodriguez@yahoo.com', '', 'Masculino', 13.699800, -89.210450, 7, 4, 1, 9),
(8, 'Valeria Isabel López Sánchez', 'Calle Principal, La Unión', '74653210', 'valeria.lopez@hotmail.com', '', 'Femenino', 13.333879, -87.839330, 8, 4, 9, 10),
(9, 'Ricardo Alejandro Martínez Flores', 'Avenida 12 de Octubre, San Salvador', '75987654', 'ricardo.martinez@gmail.com', '', 'Masculino', 13.711410, -89.222306, 9, 1, 10, 11),
(31, 'Joaquín Ernesto Polanco Rodriguez', 'Calle Antigua San Salvador, Santa Ana', '7232-0831', 'joaquin.polanco@catolica.edu.sv', '', 'Masculino', 13.725209, -90.001014, 11, 3, 2, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `escuelas`
--

CREATE TABLE `escuelas` (
  `id_school` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `direccion` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `foto` varchar(255) NOT NULL,
  `latitud` decimal(9,6) NOT NULL,
  `longitud` decimal(9,6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `escuelas`
--

INSERT INTO `escuelas` (`id_school`, `nombre`, `direccion`, `email`, `foto`, `latitud`, `longitud`) VALUES
(1, 'Liceo Francés de San Salvador', 'Carrt a Sta Tecla, 19 Avenida Sur 1/2, Santa Tecla', 'liceofrances@edu.sv', '/school/public_html/fotos/liceofrances.png', 13.675496, -89.275405),
(2, 'Escuela Alemana', 'Calle del Mediterráneo, Jardines de Guadalupe, Antiguo Cuscatlán, La Libertad, EL Salvador.', ' info@ds.edu.sv', '/school/public_html/fotos/escuelaalemana.jpg', 13.679278, -89.238795),
(3, 'Escuela Militar \"Capitán General Gerardo Barrios\"', 'Alameda Manuel Enrique Araujo, Km 5 1/2 Carretera a Santa Tecla', 'escuelamilitarsv@gmail.com', '/school/public_html/fotos/escuelamilitargerardobarrios.jpg', 13.687097, -89.234080),
(4, 'Instituto Nacional de Santa Ana (INSA)', 'Calle La Cima, Santa Ana', 'insa@edu.sv', '/school/public_html/fotos/insa.png', 13.980158, -89.563751),
(5, 'Escuela Nacional de Agricultura (ENA)', 'Carretera Panamericana KM 33.5, El Chilamatal', 'ena@edu.sv', '/school/public_html/fotos/ena.jpg', 13.804416, -89.400980),
(6, 'Academia Británica Cuscatleca', 'Km. 10 1/2, Carretera a Santa Tecla, Pasaje Edimburgo, La Libertad.', 'escuelabritanica@edu.sv', '/school/public_html/fotos/academiabritanica.jpg', 13.673164, -89.275432),
(7, 'Highlands International School San Salvador ', 'Carretera a Santa Tecla y Boulevar Mons. Romero.', 'colegiohighlands@edu.sv', '/school/public_html/fotos/highlands.jpg', 13.684411, -89.241698),
(9, 'Colegio Santa Cecilia', 'Calle Don Bosco y Av. Manuel Gallardo, 1-1, Santa Tecla', 'santacecilia@edu.sv', '/school/public_html/fotos/santacecilia.png', 13.677649, -89.287379),
(10, 'Colegio Externado de San José', '33ª AV. Norte, Final Pje. San José, res. Decápolis.', 'webmaster@externado.edu.sv', '/school/public_html/fotos/colegioexternadosanjose.jpg', 13.706399, -89.206041),
(15, 'Escuela Nacional Ciudad Obrera Apopa', 'Calle Principal, Apopa, San Salvador', 'inusulutan@gmail.com', '/school/public_html/fotos/institutonacionalciudadobrera.jfif', 13.807132, -89.181020);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `grados`
--

CREATE TABLE `grados` (
  `id_grado` int(11) NOT NULL,
  `nombre_grado` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `grados`
--

INSERT INTO `grados` (`id_grado`, `nombre_grado`) VALUES
(1, 'Primer Grado'),
(2, 'Segundo Grado'),
(3, 'Tercer Grado'),
(4, 'Cuarto Grado'),
(5, 'Quinto Grado'),
(6, 'Sexto Grado'),
(7, 'Séptimo Grado'),
(8, 'Octavo Grado'),
(9, 'Noveno Grado'),
(10, 'Primer Año de Bachillerato'),
(11, 'Segundo Año de Bachillerato');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `padres`
--

CREATE TABLE `padres` (
  `id_padre` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `direccion` varchar(255) NOT NULL,
  `telefono` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `padres`
--

INSERT INTO `padres` (`id_padre`, `nombre`, `direccion`, `telefono`) VALUES
(1, 'Alejandro José Fernández Rodríguez', 'Calle El Progreso, San Salvador', '79234567'),
(2, 'Samuel Eduardo García Sánchez', 'Calle El Pedregal, San Salvador', '72234567'),
(3, 'Isabela Victoria Martínez González', 'Avenida Monseñor Romero, San Salvador', '73523456'),
(4, 'Gabriel Antonio López Pérez', 'Calle La Cima, Santa Ana', '75456789'),
(5, 'Carolina Sofía Rodríguez Castillo', 'Calle Principal, San Vicente', '78543210'),
(6, 'Miguel Ángel Hernández Vargas', 'Boulevard de Los Héroes, San Salvador', '78345678'),
(7, 'Fernando Javier Rodríguez', 'Calle Don Bosco, San Salvador', '79123456'),
(8, 'Joaquín Ricardo Ramírez Morales', 'Calle Principal, La Unión', '74653210'),
(9, 'Camila Elena López Pérez', 'Avenida 12 de Octubre, San Salvador', '75987654');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `padresalumnos`
--

CREATE TABLE `padresalumnos` (
  `id_padre_alumno` int(11) NOT NULL,
  `parentesco` varchar(50) NOT NULL,
  `id_alumno` int(11) NOT NULL,
  `id_padre` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `padresalumnos`
--

INSERT INTO `padresalumnos` (`id_padre_alumno`, `parentesco`, `id_alumno`, `id_padre`) VALUES
(46, 'Padre', 1, 6),
(47, 'Madre', 1, 9),
(48, 'Padre', 8, 2),
(49, 'Madre', 8, 3),
(51, 'Padre', 3, 6),
(53, 'Madre', 3, 9);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `secciones`
--

CREATE TABLE `secciones` (
  `id_seccion` int(11) NOT NULL,
  `nombre_seccion` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `secciones`
--

INSERT INTO `secciones` (`id_seccion`, `nombre_seccion`) VALUES
(1, 'Sección A'),
(2, 'Sección B'),
(3, 'Sección C'),
(4, 'Sección D');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id_usr` int(11) NOT NULL,
  `nombres` varchar(100) NOT NULL,
  `apellidos` varchar(100) NOT NULL,
  `usuario` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `tipo` enum('Administrador','Usuario') NOT NULL,
  `foto` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_usr`, `nombres`, `apellidos`, `usuario`, `password`, `tipo`, `foto`) VALUES
(1, 'Kevin', 'Ocotán', 'kevinocotan', 'a1fc297f36fb8b831ada3a3db21eef6a0845b776', 'Administrador', '/school//public_html/fotos/fotokevin.png'),
(2, 'Joaquín', 'Polanco', 'joaquin', '13bc4abdf045c3709e100100c06441a66453ebd9', 'Usuario', '/school//public_html/fotos/fotojoakin.png'),
(3, 'Carlos Alberto', 'Hernández', 'carlos.hernandez', 'cbfdac6008f9cab4083784cbd1874f76618d2a97', 'Usuario', '/school//public_html/fotos/alumno1.jpg'),
(4, 'María Fernanda', 'González', 'maria.gonzalez', 'cbfdac6008f9cab4083784cbd1874f76618d2a97', 'Usuario', '/school//public_html/fotos/alumna1.jpg'),
(5, 'Luis Fernando', 'Hernández', 'luis.hernandez', 'cbfdac6008f9cab4083784cbd1874f76618d2a97', 'Usuario', '/school//public_html/fotos/alumno2.jpg'),
(6, 'Ana María', 'Jiménez Pérez', 'ana.jimenez', 'cbfdac6008f9cab4083784cbd1874f76618d2a97', 'Usuario', 'default.jpg'),
(7, 'José Antonio', 'Martínez López', 'jose.martinez', 'cbfdac6008f9cab4083784cbd1874f76618d2a97', 'Usuario', 'default.jpg'),
(8, 'Elena Patricia', 'Díaz García', 'elena.diaz', 'cbfdac6008f9cab4083784cbd1874f76618d2a97', 'Usuario', 'default.jpg'),
(9, 'Fernando Javier', 'Rodríguez Martínez', 'fernando.rodriguez', 'cbfdac6008f9cab4083784cbd1874f76618d2a97', 'Usuario', 'default.jpg'),
(10, 'Valeria Isabel', 'López Sánchez', 'valeria.lopez', 'cbfdac6008f9cab4083784cbd1874f76618d2a97', 'Usuario', 'default.jpg'),
(11, 'Ricardo Alejandro', 'Martínez Flores', 'ricardo.martinez', 'cbfdac6008f9cab4083784cbd1874f76618d2a97', 'Usuario', 'default.jpg');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `alumnos`
--
ALTER TABLE `alumnos`
  ADD PRIMARY KEY (`id_alumno`),
  ADD KEY `fk_alumno_school` (`id_school`),
  ADD KEY `fk_alumno_grado` (`id_grado`),
  ADD KEY `fk_alumno_seccion` (`id_seccion`),
  ADD KEY `fk_alumno_usuarios` (`id_usr`);

--
-- Indices de la tabla `escuelas`
--
ALTER TABLE `escuelas`
  ADD PRIMARY KEY (`id_school`);

--
-- Indices de la tabla `grados`
--
ALTER TABLE `grados`
  ADD PRIMARY KEY (`id_grado`);

--
-- Indices de la tabla `padres`
--
ALTER TABLE `padres`
  ADD PRIMARY KEY (`id_padre`);

--
-- Indices de la tabla `padresalumnos`
--
ALTER TABLE `padresalumnos`
  ADD PRIMARY KEY (`id_padre_alumno`),
  ADD KEY `fk_padre_alumno` (`id_alumno`),
  ADD KEY `fk_padre` (`id_padre`);

--
-- Indices de la tabla `secciones`
--
ALTER TABLE `secciones`
  ADD PRIMARY KEY (`id_seccion`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usr`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `alumnos`
--
ALTER TABLE `alumnos`
  MODIFY `id_alumno` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT de la tabla `escuelas`
--
ALTER TABLE `escuelas`
  MODIFY `id_school` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT de la tabla `grados`
--
ALTER TABLE `grados`
  MODIFY `id_grado` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT de la tabla `padres`
--
ALTER TABLE `padres`
  MODIFY `id_padre` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT de la tabla `padresalumnos`
--
ALTER TABLE `padresalumnos`
  MODIFY `id_padre_alumno` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT de la tabla `secciones`
--
ALTER TABLE `secciones`
  MODIFY `id_seccion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usr` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `alumnos`
--
ALTER TABLE `alumnos`
  ADD CONSTRAINT `fk_alumno_grado` FOREIGN KEY (`id_grado`) REFERENCES `grados` (`id_grado`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_alumno_school` FOREIGN KEY (`id_school`) REFERENCES `escuelas` (`id_school`),
  ADD CONSTRAINT `fk_alumno_seccion` FOREIGN KEY (`id_seccion`) REFERENCES `secciones` (`id_seccion`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_alumno_usuarios` FOREIGN KEY (`id_usr`) REFERENCES `usuarios` (`id_usr`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `padresalumnos`
--
ALTER TABLE `padresalumnos`
  ADD CONSTRAINT `fk_padre` FOREIGN KEY (`id_padre`) REFERENCES `padres` (`id_padre`),
  ADD CONSTRAINT `fk_padre_alumno` FOREIGN KEY (`id_alumno`) REFERENCES `alumnos` (`id_alumno`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
