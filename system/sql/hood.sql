-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 23-07-2012 a las 15:46:25
-- Versión del servidor: 5.5.24-log
-- Versión de PHP: 5.3.13

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `hood`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tfile`
--

CREATE TABLE IF NOT EXISTS `tfile` (
  `idFiles` int(11) NOT NULL AUTO_INCREMENT,
  `path` varchar(45) DEFAULT NULL,
  `THoods_idHoods` int(11) NOT NULL,
  PRIMARY KEY (`idFiles`),
  KEY `fk_TFiles_THoods1` (`THoods_idHoods`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `thashtag`
--

CREATE TABLE IF NOT EXISTS `thashtag` (
  `idTHashtag` int(11) NOT NULL AUTO_INCREMENT,
  `topic` varchar(45) DEFAULT NULL,
  `count` int(11) DEFAULT NULL,
  PRIMARY KEY (`idTHashtag`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `thood`
--

CREATE TABLE IF NOT EXISTS `thood` (
  `idHoods` int(11) NOT NULL AUTO_INCREMENT,
  `text` varchar(500) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `time` time DEFAULT NULL,
  `TUsers_idUsers` int(11) NOT NULL,
  PRIMARY KEY (`idHoods`),
  KEY `fk_THoods_TUsers` (`TUsers_idUsers`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Volcado de datos para la tabla `thood`
--

INSERT INTO `thood` (`idHoods`, `text`, `date`, `time`, `TUsers_idUsers`) VALUES
(1, 'prueba de hood', '2012-07-23', '00:00:00', 1),
(2, 'prueba de hood', '2012-07-23', '09:37:00', 2),
(3, 'prueba de hood', '2012-07-23', '09:37:00', 3),
(4, 'prueba de hood', '2012-07-23', '09:38:00', 3),
(5, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry''s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop p', '2012-07-23', '09:38:00', 1),
(6, ' Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer augue felis, iaculis a aliquam quis, varius vel sem. Pellentesque a faucibus quam. In hac habitasse platea dictumst. Morbi eget lectus a tellus porttitor condimentum ut mattis lorem. Curabitur sed eros dolor. Aenean placerat, nibh quis euismod molestie, mauris lacus eleifend ligula, quis adipiscing ligula ante eget odio. Fusce volutpat lorem sed est rhoncus venenatis. Duis eget mauris in est consectetur accumsan. Cum sociis natoqu', '2012-07-23', '09:38:00', 2),
(7, 'Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Quisque bibendum, elit in aliquam auctor, mi lorem pulvinar nunc, eu tempus diam quam sit amet massa. Proin imperdiet, magna ut porta lacinia, lectus sem gravida risus, sit amet lobortis nulla turpis vitae dui. Sed fermentum metus id diam pharetra at vulputate tortor venenatis. Sed vitae lorem sit amet sem sagittis euismod. Morbi sodales fermentum erat eu egestas. Nulla facilisi. Duis quis tellus quis enim au', '2012-07-23', '09:39:00', 1),
(8, 'Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Quisque bibendum, elit in aliquam auctor, mi lorem pulvinar nunc, eu tempus diam quam sit amet massa. Proin imperdiet, magna ut porta lacinia, lectus sem gravida risus, sit amet lobortis nulla turpis vitae dui. Sed fermentum metus id diam pharetra at vulputate tortor venenatis. Sed vitae lorem sit amet sem sagittis euismod. Morbi sodales fermentum erat eu egestas. Nulla facilisi. Duis quis tellus quis enim au', '2012-07-23', '09:40:00', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `thoodthash`
--

CREATE TABLE IF NOT EXISTS `thoodthash` (
  `THashtag_idTHashtag` int(11) NOT NULL,
  `THoods_idHoods` int(11) NOT NULL,
  KEY `fk_THoodTHash_THashtag1` (`THashtag_idTHashtag`),
  KEY `fk_THoodTHash_THoods1` (`THoods_idHoods`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tuser`
--

CREATE TABLE IF NOT EXISTS `tuser` (
  `idUsers` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(15) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL,
  `name` varchar(64) DEFAULT NULL,
  `last_name` varchar(64) DEFAULT NULL,
  `email` varchar(45) DEFAULT NULL,
  `job_position` varchar(45) DEFAULT NULL,
  `user_type` varchar(1) DEFAULT NULL,
  `active` tinyint(1) DEFAULT NULL,
  `url_img` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idUsers`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Volcado de datos para la tabla `tuser`
--

INSERT INTO `tuser` (`idUsers`, `username`, `password`, `name`, `last_name`, `email`, `job_position`, `user_type`, `active`, `url_img`) VALUES
(1, 'rvega', 'vega123', 'ricardo', 'vega', 'vega@yahoo.com', 'jefe', '1', 1, NULL),
(2, 'jherrera', 'jherrera123', 'jorge', 'herrera', 'jherrera@yahoo.com', 'jefe', '1', 1, NULL),
(3, 'crisanto', 'crisanto123', 'cristian', 'campos', 'ccampos@yahoo.com', 'jefe', '1', 1, NULL);

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `tfile`
--
ALTER TABLE `tfile`
  ADD CONSTRAINT `fk_TFiles_THoods1` FOREIGN KEY (`THoods_idHoods`) REFERENCES `thood` (`idHoods`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `thood`
--
ALTER TABLE `thood`
  ADD CONSTRAINT `fk_THoods_TUsers` FOREIGN KEY (`TUsers_idUsers`) REFERENCES `tuser` (`idUsers`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `thoodthash`
--
ALTER TABLE `thoodthash`
  ADD CONSTRAINT `fk_THoodTHash_THashtag1` FOREIGN KEY (`THashtag_idTHashtag`) REFERENCES `thashtag` (`idTHashtag`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_THoodTHash_THoods1` FOREIGN KEY (`THoods_idHoods`) REFERENCES `thood` (`idHoods`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
