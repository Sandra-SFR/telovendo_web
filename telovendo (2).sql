-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 12-05-2023 a las 00:11:24
-- Versión del servidor: 10.4.27-MariaDB
-- Versión de PHP: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `telovendo`
--
CREATE DATABASE IF NOT EXISTS `telovendo` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `telovendo`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `product_name` varchar(25) DEFAULT NULL,
  `category` varchar(25) DEFAULT NULL,
  `price` decimal(11,2) DEFAULT NULL,
  `selling_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `available` tinyint(1) NOT NULL,
  `latitude` float NOT NULL,
  `longitude` float NOT NULL,
  `user_user` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `products`
--

INSERT INTO `products` VALUES(0, 'Caramelos', 'Chuches', '1.00', '2023-05-11 19:12:33', 1, 0, 0, NULL);
INSERT INTO `products` VALUES(1, 'Prueba', 'Comida', '0.00', '2023-05-11 13:53:40', 0, 0, 0, NULL);
INSERT INTO `products` VALUES(2, 'prueba', 'Borrar', '0.05', '2023-05-11 13:53:40', 0, 0, 0, NULL);
INSERT INTO `products` VALUES(3, 'prueba', 'Borrar', '1.00', '2023-05-11 13:53:40', 0, 0, 0, NULL);
INSERT INTO `products` VALUES(4, 'prueba', 'Borrar', '6.30', '2023-05-11 13:53:40', 0, 0, 0, NULL);
INSERT INTO `products` VALUES(6, 'Refresco', 'Bebidas', '6.20', '2023-05-11 19:12:41', 0, 0, 0, NULL);
INSERT INTO `products` VALUES(7, 'Prueba', 'Bebidas', '1.59', '2023-05-11 13:53:40', 0, 0, 0, NULL);
INSERT INTO `products` VALUES(9, 'Pruebas', 'Categoria', '6.00', '2023-05-11 13:53:40', 0, 0, 0, NULL);
INSERT INTO `products` VALUES(10, 'Galletas', 'Comida', '3.00', '2023-05-11 19:12:50', 0, 0, 0, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sales`
--

CREATE TABLE `sales` (
  `id` int(11) NOT NULL,
  `id_product` int(10) DEFAULT NULL,
  `id_user` varchar(50) DEFAULT NULL,
  `sale_date` date DEFAULT NULL,
  `quantity` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `sales`
--

INSERT INTO `sales` VALUES(0, 6, 'Administrador', '2023-04-10', 2);
INSERT INTO `sales` VALUES(1, 10, 'Usuario', '2023-12-04', 4);
INSERT INTO `sales` VALUES(2, 6, 'Administrador', '2023-04-20', 3);
INSERT INTO `sales` VALUES(3, 0, 'Usuario', '2023-03-03', 2);
INSERT INTO `sales` VALUES(4, 10, 'Usuario', '2023-03-03', 3);
INSERT INTO `sales` VALUES(5, 10, 'Usuario', '2023-03-02', 2);
INSERT INTO `sales` VALUES(6, 10, 'Administrador', '2023-03-06', 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `USER` varchar(20) NOT NULL,
  `NAME` varchar(20) NOT NULL,
  `SURNAME` varchar(20) NOT NULL,
  `EMAIL` varchar(50) NOT NULL,
  `PASSWORD` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` VALUES(0, 'aaaaaaaa', 'aaaaaaaa', 'aaaaaaaa', 'aaaaaaaa@aaaaaaaa.com', 'c8fc60d36d9ef5a218808b1cb4740641');
INSERT INTO `users` VALUES(1, 'Administrador', 'Administrador', 'Administrador', 'Administrador@Administrador.com', 'ed6703691cbed2825815c61717b0e351');
INSERT INTO `users` VALUES(3, 'ddddddd', 'ddddddd', 'ddddddd', 'ddddddd@ddddddd.com', 'c609034d28ed38a59c8a1c2e1b08a6df');
INSERT INTO `users` VALUES(4, 'ffffffffff', 'ffffffffff', 'ffffffffff', 'ffffffffff@ffffffffff.com', '2f0e71e2e8615663476b330a5890e571');
INSERT INTO `users` VALUES(5, 'Usuario', 'Nombusuario', 'Apellidousuario', 'usuario@hotmail.com', 'f7f4e20f42fecf68830c49d867a16231');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK9u40amd3wkqr83bkpwf2li0rn` (`user_user`);

--
-- Indices de la tabla `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_product` (`id_product`),
  ADD KEY `id_user` (`id_user`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`USER`);

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `FK9u40amd3wkqr83bkpwf2li0rn` FOREIGN KEY (`user_user`) REFERENCES `users` (`USER`) ON DELETE CASCADE;

--
-- Filtros para la tabla `sales`
--
ALTER TABLE `sales`
  ADD CONSTRAINT `sales_ibfk_1` FOREIGN KEY (`id_product`) REFERENCES `products` (`id`),
  ADD CONSTRAINT `sales_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `users` (`USER`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
