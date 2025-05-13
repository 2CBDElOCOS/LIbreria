-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 12-05-2025 a las 21:37:42
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `libreria`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`id`, `nombre`) VALUES
(1, 'Finanzas'),
(2, 'Consejos sobre carreras'),
(3, 'Educacion sexual'),
(4, 'Literatura Juvenil'),
(5, 'Autoayuda y superacion'),
(6, 'Literatura y Ficción');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `libros`
--

CREATE TABLE `libros` (
  `id` int(11) NOT NULL,
  `titulo` varchar(255) NOT NULL,
  `autor` varchar(255) NOT NULL,
  `descripcion` text DEFAULT NULL,
  `precio` decimal(10,2) NOT NULL,
  `stock` int(11) NOT NULL DEFAULT 0,
  `imagen` varchar(255) DEFAULT NULL,
  `creado_en` timestamp NOT NULL DEFAULT current_timestamp(),
  `categoria_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `libros`
--

INSERT INTO `libros` (`id`, `titulo`, `autor`, `descripcion`, `precio`, `stock`, `imagen`, `creado_en`, `categoria_id`) VALUES
(5, 'Sabiduría Financiera: El Dinero se hace en la Mente', 'Raimon Samsó ', 'La riqueza esta en tu mente', 100000.00, 5, 'uploads/mente.jpg', '2025-05-09 14:41:44', 1),
(6, 'El Poder del Pensamiento Positivo', 'Frank Mullani  ', 'Este libro le ayudará a descubrir el secreto para convertirse en una persona de pensamiento positivo inquebrantable. ', 900000.00, 3, 'uploads/28002731.jpg', '2025-05-09 15:06:18', 2),
(7, 'El porno NO mola', 'Anna Salvia Ribera', 'Desde que Internet ha puesto el porno al alcance de todo el mundo, el primer contacto con él se da a una edad cada vez más temprana y su consumo en la adolescencia se ha disparado. En este libro te explicamos cinco razones por las que el porno no mola y te ofrecemos herramientas para que no se convierta en tu educador sexual.', 50000.00, 5, 'uploads/71qtNpa1JwL._SL1500_.jpg', '2025-05-09 15:17:02', 3),
(8, '  El Principito', 'Saint-Exupéry Antoine ', 'Desesperado por su situación, y tras haber pasado su primera noche en el desierto, a la mañana siguiente recibe una sorpresa cuando un niño lo despierta. ', 450000.00, 5, 'uploads/content.jpg', '2025-05-09 21:07:50', 4),
(9, 'Sabiduría Financiera: El Dinero se hace en la Mente', '12', 'e', 100.00, 8, 'uploads/content (1).jpg', '2025-05-12 12:47:12', NULL),
(10, 'Nadie Tiene Que Saberlo Excepto Tu', 'Madame G Rouge', 'Nadie tiene que saber el contenido de este libro, excepto tú. Sus páginas son un lugar seguro para ti. La vida está llena de altibajos, y a veces nos enfrentamos a situaciones difíciles que nos hunden y hacen que nos sintamos desesperadas. Si has pasado por una ruptura amorosa, la pérdida de una amistad, una pelea familiar o cualquier otro momento complicado y estás buscando una manera de superar este periodo complicado y mirar al futuro con esperanza y optimismo, este libro es para ti. En él encontrarás las herramientas para tomar el control de tu vida de nuevo y convertir las dificultades en oportunidades: aprenderás a sanar tus heridas y a hacer las paces contigo misma. ', 50000.00, 15, 'uploads/shopping.jpg', '2025-05-12 12:52:51', 5),
(11, 'Quicksilver 1', 'Callie Hart', 'No toques la espada. No gires la llave. No abras la puerta. A la joven Saeris Fane se le da bien guardar secretos. Nadie está al tanto de los poderes que posee ni de que lleva toda la vida robando para sobrevivir y escamoteando de los depósitos de la Reina Imperecedera.', 75000.00, 10, 'uploads/348218-1200-auto.jpg', '2025-05-12 15:47:20', 6);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `libros`
--
ALTER TABLE `libros`
  ADD PRIMARY KEY (`id`),
  ADD KEY `categoria_id` (`categoria_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `libros`
--
ALTER TABLE `libros`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `libros`
--
ALTER TABLE `libros`
  ADD CONSTRAINT `libros_ibfk_1` FOREIGN KEY (`categoria_id`) REFERENCES `categorias` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
