-- Database Setup for Inventario de Motos
-- Motorcycle Inventory Management System
-- Developer: Sebastian Ibarra

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `inventario_motos_db`
--
CREATE DATABASE IF NOT EXISTS `inventario_motos_db` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `inventario_motos_db`;

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
(1, 'Deportivas'),
(2, 'Cruiser'),
(3, 'Touring'),
(4, 'Off-Road'),
(5, 'Scooter');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `cilindrada` varchar(10) NOT NULL,
  `color` varchar(50) NOT NULL,
  `precio` decimal(10,2) NOT NULL,
  `stock` int(11) NOT NULL,
  `categoria_id` int(11) NOT NULL,
  `imagen` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id`, `nombre`, `cilindrada`, `color`, `precio`, `stock`, `categoria_id`, `imagen`) VALUES
(1, 'Yamaha YZF-R1', '998cc', 'Azul Racing', 65000000, 5, 1, ''),
(2, 'Kawasaki Ninja ZX-10R', '998cc', 'Verde Kawasaki', 68000000, 3, 1, ''),
(3, 'Harley-Davidson Street 750', '750cc', 'Negro Mate', 35000000, 8, 2, ''),
(4, 'Honda Shadow 750', '745cc', 'Rojo Metálico', 28000000, 10, 2, ''),
(5, 'BMW R 1250 GS', '1254cc', 'Blanco', 85000000, 4, 3, ''),
(6, 'Honda Africa Twin', '1084cc', 'Rojo Adventure', 55000000, 6, 3, ''),
(7, 'KTM 450 EXC-F', '450cc', 'Naranja KTM', 42000000, 7, 4, ''),
(8, 'Yamaha WR250F', '250cc', 'Azul Yamaha', 32000000, 9, 4, ''),
(9, 'Vespa Primavera 150', '150cc', 'Verde Menta', 18000000, 12, 5, ''),
(10, 'Honda PCX 160', '160cc', 'Gris Plata', 15000000, 15, 5, '');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `categoria_id` (`categoria_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `productos`
--
ALTER TABLE `productos`
  ADD CONSTRAINT `productos_ibfk_1` FOREIGN KEY (`categoria_id`) REFERENCES `categorias` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
