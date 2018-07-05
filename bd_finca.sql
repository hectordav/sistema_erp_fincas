-- phpMyAdmin SQL Dump
-- version 3.5.2
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 17-09-2017 a las 02:46:53
-- Versión del servidor: 5.5.25a
-- Versión de PHP: 5.4.4

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `bd_finca`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `t_det_gasto`
--

CREATE TABLE IF NOT EXISTS `t_det_gasto` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_gasto` int(11) NOT NULL,
  `id_tipo_gasto` int(11) NOT NULL,
  `descripcion` varchar(60) NOT NULL,
  `cantidad` varchar(45) DEFAULT NULL,
  `total` varchar(45) DEFAULT NULL,
  `observacion` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_t_det_gasto_t_gasto1_idx` (`id_gasto`),
  KEY `fk_t_det_gasto_t_tipo_gasto1_idx` (`id_tipo_gasto`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Volcado de datos para la tabla `t_det_gasto`
--

INSERT INTO `t_det_gasto` (`id`, `id_gasto`, `id_tipo_gasto`, `descripcion`, `cantidad`, `total`, `observacion`) VALUES
(4, 1, 2, 'uuuu', '1', '1', 'lo que sea'),
(5, 1, 2, 'el numero 2', '1', '122', 'jjjjj'),
(7, 1, 1, 'aqui va algo', '1', '1000', 'no se');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `t_det_gasto_proveedor`
--

CREATE TABLE IF NOT EXISTS `t_det_gasto_proveedor` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_proveedor` int(11) NOT NULL,
  `id_tipo_gasto_proveedor` int(11) NOT NULL,
  `monto` varchar(60) DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_t_det_gasto_proveedor_t_proveedor1_idx` (`id_proveedor`),
  KEY `fk_t_det_gasto_proveedor_t_tipo_gasto_proveedor1_idx` (`id_tipo_gasto_proveedor`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=13 ;

--
-- Volcado de datos para la tabla `t_det_gasto_proveedor`
--

INSERT INTO `t_det_gasto_proveedor` (`id`, `id_proveedor`, `id_tipo_gasto_proveedor`, `monto`, `fecha`) VALUES
(7, 1, 1, '100', '2017-09-15'),
(8, 1, 2, '150', '2017-09-15'),
(9, 1, 3, '120', '2017-09-15'),
(10, 1, 1, '110', '2017-09-15'),
(11, 1, 2, '110', '2017-09-15'),
(12, 1, 3, '110', '2017-09-15');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `t_det_informe_gasto_proveedor`
--

CREATE TABLE IF NOT EXISTS `t_det_informe_gasto_proveedor` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_informe_gasto_proveedor` int(11) NOT NULL,
  `id_tipo_gasto_proveedor` int(11) NOT NULL,
  `monto` varchar(60) DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_t_det_informe_gasto_proveedor_t_informe_gasto_proveedor1_idx` (`id_informe_gasto_proveedor`),
  KEY `fk_t_det_informe_gasto_proveedor_t_tipo_gasto_proveedor1_idx` (`id_tipo_gasto_proveedor`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=28 ;

--
-- Volcado de datos para la tabla `t_det_informe_gasto_proveedor`
--

INSERT INTO `t_det_informe_gasto_proveedor` (`id`, `id_informe_gasto_proveedor`, `id_tipo_gasto_proveedor`, `monto`, `fecha`) VALUES
(25, 12, 1, '210', '2017-09-15'),
(26, 12, 2, '260', '2017-09-15'),
(27, 12, 3, '230', '2017-09-15');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `t_det_inventario`
--

CREATE TABLE IF NOT EXISTS `t_det_inventario` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_inventario` int(11) NOT NULL,
  `id_herramienta` int(11) DEFAULT NULL,
  `cantidad` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_t_det_inventario_t_inventario1_idx` (`id_inventario`),
  KEY `fk_t_det_inventario_t_herramienta1_idx` (`id_herramienta`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Volcado de datos para la tabla `t_det_inventario`
--

INSERT INTO `t_det_inventario` (`id`, `id_inventario`, `id_herramienta`, `cantidad`) VALUES
(3, 1, 3, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `t_det_medidas`
--

CREATE TABLE IF NOT EXISTS `t_det_medidas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_medidas` int(11) NOT NULL,
  `id_faena` int(11) NOT NULL,
  `rodal` varchar(45) DEFAULT NULL,
  `medidas_gps` varchar(60) DEFAULT NULL,
  `medida_cas` varchar(45) DEFAULT NULL,
  `precio_faena` varchar(45) DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_t_det_medidas_t_faena1_idx` (`id_faena`),
  KEY `fk_t_det_medidas_t_medidas1_idx` (`id_medidas`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=41 ;

--
-- Volcado de datos para la tabla `t_det_medidas`
--

INSERT INTO `t_det_medidas` (`id`, `id_medidas`, `id_faena`, `rodal`, `medidas_gps`, `medida_cas`, `precio_faena`, `fecha`) VALUES
(37, 6, 1, '1', '12', '21', '1200', '2017-07-21'),
(38, 6, 2, '2', '14', '34', '56', '2017-07-22'),
(39, 6, 3, '4', '16', '43', '543', '2017-07-25'),
(40, 6, 1, '5', '18', '67', '678', '2017-07-30');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `t_det_medidas_valor`
--

CREATE TABLE IF NOT EXISTS `t_det_medidas_valor` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_medida_valor` int(11) NOT NULL,
  `id_det_medidas` int(11) NOT NULL,
  `diferencia` varchar(45) DEFAULT NULL,
  `observacion` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_t_det_medidas_t_det_medidas1_idx` (`id_det_medidas`),
  KEY `fk_t_medidas_valores_t_medida_valores1_idx` (`id_medida_valor`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `t_det_medidas_valor`
--

INSERT INTO `t_det_medidas_valor` (`id`, `id_medida_valor`, `id_det_medidas`, `diferencia`, `observacion`) VALUES
(1, 1, 37, '-9', 'con diferencia a -9'),
(2, 1, 40, NULL, 'un ultima medida');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `t_det_nomina`
--

CREATE TABLE IF NOT EXISTS `t_det_nomina` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_nomina` int(11) NOT NULL,
  `id_empleado` int(11) NOT NULL,
  `salario` varchar(60) DEFAULT NULL,
  `mercado` varchar(45) DEFAULT NULL,
  `seguro` varchar(45) DEFAULT NULL,
  `gastos_per` varchar(45) DEFAULT NULL,
  `servicios` varchar(45) DEFAULT NULL,
  `herramientas` varchar(45) DEFAULT NULL,
  `prestamos` varchar(45) DEFAULT NULL,
  `inasistencia` varchar(45) DEFAULT NULL,
  `pasajes` varchar(45) DEFAULT NULL,
  `liquidacion` varchar(60) DEFAULT NULL,
  `otros` varchar(60) DEFAULT NULL,
  `prestaciones` varchar(60) DEFAULT NULL,
  `incapacidades` varchar(60) DEFAULT NULL,
  `trabajos_varios` varchar(60) DEFAULT NULL,
  `valor_final` varchar(45) DEFAULT NULL,
  `firma` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_t_det_nomina_t_nomina1_idx` (`id_nomina`),
  KEY `fk_t_det_nomina_t_empleado1_idx` (`id_empleado`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=15 ;

--
-- Volcado de datos para la tabla `t_det_nomina`
--

INSERT INTO `t_det_nomina` (`id`, `id_nomina`, `id_empleado`, `salario`, `mercado`, `seguro`, `gastos_per`, `servicios`, `herramientas`, `prestamos`, `inasistencia`, `pasajes`, `liquidacion`, `otros`, `prestaciones`, `incapacidades`, `trabajos_varios`, `valor_final`, `firma`) VALUES
(13, 3, 4, '1000', '100', '100', '150', '100', '120', '100', '100', '100', '100', '100', '100', '100', '100', '630', NULL),
(14, 3, 4, '1000', '110', '100', '110', '100', '110', '100', '100', '100', '100', '100', '100', '100', '100', '670', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `t_det_proforma`
--

CREATE TABLE IF NOT EXISTS `t_det_proforma` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_proforma` int(11) NOT NULL,
  `id_finca` int(11) NOT NULL,
  `id_faena` int(11) NOT NULL,
  `fecha` date DEFAULT NULL,
  `unidad` varchar(60) DEFAULT NULL,
  `rodal` varchar(60) DEFAULT NULL,
  `medida` varchar(45) DEFAULT NULL,
  `precio_unidad` varchar(45) DEFAULT NULL,
  `total` varchar(45) DEFAULT NULL,
  `observacion` varchar(45) DEFAULT NULL,
  `nota` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_t_det_proforma_general_t_faena1_idx` (`id_faena`),
  KEY `fk_t_det_proforma_general_t_proforma_original1_idx` (`id_proforma`),
  KEY `fk_t_det_proforma_general_t_finca1_idx` (`id_finca`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=169 ;

--
-- Volcado de datos para la tabla `t_det_proforma`
--

INSERT INTO `t_det_proforma` (`id`, `id_proforma`, `id_finca`, `id_faena`, `fecha`, `unidad`, `rodal`, `medida`, `precio_unidad`, `total`, `observacion`, `nota`) VALUES
(146, 118, 1, 2, '2017-07-10', 'Rollo', '3', '321', '333', '11122333', 'algo', '2'),
(147, 118, 1, 3, '2017-07-10', 'HA', '4', '333', '44', '4455444', 'algo', '3'),
(148, 118, 1, 1, '2017-07-10', 'Rollo', '5', '123', '4433', '12111', 'algo', '4'),
(149, 118, 1, 3, '2017-07-10', 'HA', '6', '321', '55', '11122333', 'no se', '5'),
(150, 118, 1, 2, '2017-07-10', 'Metros', '7', '333', '6765', '4455444', 'lo que sea', '6'),
(151, 118, 1, 1, '2017-07-10', 'Metros', '4', '123', '222', '12111', 'algo', '7'),
(152, 118, 1, 2, '2017-07-10', 'Rollo', '3', '321', '333', '11122333', 'algo', '8'),
(153, 118, 1, 3, '2017-07-10', 'HA', '2', '333', '44', '4455444', 'algo', '9'),
(154, 118, 1, 1, '2017-07-10', 'Rollo', '2', '123', '4433', '12111', 'algo', '10'),
(155, 118, 1, 3, '2017-07-10', 'HA', '3', '321', '55', '11122333', 'no se', '11'),
(156, 118, 1, 2, '2017-07-10', 'Metros', '4', '333', '6765', '4455444', 'lo que sea', '12'),
(157, 118, 1, 1, '2017-07-10', 'Metros', '5', '123', '222', '12111', 'algo', '13'),
(158, 118, 1, 2, '2017-07-10', 'Rollo', '6', '321', '333', '11122333', 'algo', '14'),
(159, 118, 1, 3, '2017-07-10', 'HA', '7', '333', '44', '4455444', 'algo', '15'),
(160, 118, 1, 1, '2017-07-10', 'Rollo', '4', '123', '4433', '12111', 'algo', '16'),
(161, 118, 1, 3, '2017-07-10', 'HA', '3', '321', '55', '11122333', 'no se', '17'),
(162, 118, 1, 2, '2017-07-10', 'Metros', '2', '333', '6765', '4455444', 'lo que sea', '18'),
(163, 118, 2, 1, '2017-07-10', 'Metros', '2', '123', '222', '12111', 'algo', '19'),
(164, 118, 2, 2, '2017-07-10', 'Rollo', '3', '321', '333', '11122333', 'algo', '20'),
(165, 118, 2, 3, '2017-07-10', 'HA', '4', '333', '44', '4455444', 'algo', '21'),
(166, 118, 2, 1, '2017-07-10', 'Rollo', '5', '123', '4433', '12111', 'algo', '22'),
(167, 118, 2, 3, '2017-07-10', 'HA', '6', '321', '55', '11122333', 'no se', '23'),
(168, 118, 2, 2, '2017-07-10', 'Metros', '7', '333', '6765', '4455444', 'lo que sea', '24');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `t_det_proforma_pago`
--

CREATE TABLE IF NOT EXISTS `t_det_proforma_pago` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_proforma_pago` int(11) NOT NULL,
  `id_faena` int(11) NOT NULL,
  `rodal` varchar(45) DEFAULT NULL,
  `medida` varchar(45) DEFAULT NULL,
  `precio_unidad` varchar(45) DEFAULT NULL,
  `total` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_t_tabla_t_proforma_pago1_idx` (`id_proforma_pago`),
  KEY `fk_t_det_proforma_t_faena1_idx` (`id_faena`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=91 ;

--
-- Volcado de datos para la tabla `t_det_proforma_pago`
--

INSERT INTO `t_det_proforma_pago` (`id`, `id_proforma_pago`, `id_faena`, `rodal`, `medida`, `precio_unidad`, `total`) VALUES
(87, 20, 1, '1', '21', '1200', '25200'),
(88, 20, 2, '2', '34', '56', '1904'),
(89, 20, 3, '4', '43', '543', '23349'),
(90, 20, 1, '5', '67', '678', '45426');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `t_empleado`
--

CREATE TABLE IF NOT EXISTS `t_empleado` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_finca` int(11) NOT NULL,
  `id_seguro` int(11) NOT NULL,
  `cedula` varchar(60) NOT NULL,
  `nombre` varchar(60) NOT NULL,
  `direccion` varchar(200) NOT NULL,
  `telf` varchar(60) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_t_cliente_t_finca1_idx` (`id_finca`),
  KEY `fk_t_empleado_t_seguro1_idx` (`id_seguro`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Volcado de datos para la tabla `t_empleado`
--

INSERT INTO `t_empleado` (`id`, `id_finca`, `id_seguro`, `cedula`, `nombre`, `direccion`, `telf`) VALUES
(4, 1, 2, '88', '88', '88', '88');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `t_empresa`
--

CREATE TABLE IF NOT EXISTS `t_empresa` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(60) NOT NULL,
  `dni` varchar(60) NOT NULL,
  `direccion` varchar(60) NOT NULL,
  `telf` varchar(60) NOT NULL,
  `email` varchar(60) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `t_empresa`
--

INSERT INTO `t_empresa` (`id`, `nombre`, `dni`, `direccion`, `telf`, `email`) VALUES
(1, 'NAcer', '010101', 'por alli', '010101', 'nacer@gmail.com');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `t_estado_resultados`
--

CREATE TABLE IF NOT EXISTS `t_estado_resultados` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_gasto` int(11) NOT NULL,
  `nombre_empresa` varchar(60) NOT NULL,
  `nit` varchar(45) NOT NULL,
  `nombre_compania` varchar(45) DEFAULT NULL,
  `ingresos` varchar(45) DEFAULT NULL,
  `ventas` varchar(45) DEFAULT NULL,
  `costo_ventas` varchar(45) DEFAULT NULL,
  `utilidad_bruta` varchar(45) DEFAULT NULL,
  `utilidad_operativa` varchar(45) DEFAULT NULL,
  `utilidad_neta_ajustada` varchar(45) DEFAULT NULL,
  `fecha_i` date DEFAULT NULL,
  `fecha_f` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_t_estado_resultados_t_gasto1_idx` (`id_gasto`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `t_faena`
--

CREATE TABLE IF NOT EXISTS `t_faena` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(60) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Volcado de datos para la tabla `t_faena`
--

INSERT INTO `t_faena` (`id`, `descripcion`) VALUES
(1, 'Machete'),
(2, 'Mant. Quimico'),
(3, 'Guadana');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `t_finca`
--

CREATE TABLE IF NOT EXISTS `t_finca` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `codigo` varchar(45) DEFAULT NULL,
  `nombre` varchar(60) NOT NULL,
  `dni` varchar(60) NOT NULL,
  `direccion` varchar(60) NOT NULL,
  `telf` varchar(60) NOT NULL,
  `email` varchar(60) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `t_finca`
--

INSERT INTO `t_finca` (`id`, `codigo`, `nombre`, `dni`, `direccion`, `telf`, `email`) VALUES
(1, '1234', 'Maniizales', '12345', 'por alli', '1010101', 'manizales@gmail.com'),
(2, '1010011', 'La Dolorita', '0000', '0000', '0000', '000@gmail.com');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `t_gasto`
--

CREATE TABLE IF NOT EXISTS `t_gasto` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_finca` int(11) NOT NULL,
  `observacion` varchar(60) DEFAULT NULL,
  `total` varchar(45) DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_t_gasto_t_finca1_idx` (`id_finca`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `t_gasto`
--

INSERT INTO `t_gasto` (`id`, `id_finca`, `observacion`, `total`, `fecha`) VALUES
(1, 1, 'lalala', '1123', '2017-09-15'),
(2, 1, 'lalala', '1123', '2017-09-01');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `t_herramienta`
--

CREATE TABLE IF NOT EXISTS `t_herramienta` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(60) DEFAULT NULL,
  `cantidad` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Volcado de datos para la tabla `t_herramienta`
--

INSERT INTO `t_herramienta` (`id`, `descripcion`, `cantidad`) VALUES
(3, 'agua', 10);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `t_informe_gasto_proveedor`
--

CREATE TABLE IF NOT EXISTS `t_informe_gasto_proveedor` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_proveedor` int(11) NOT NULL,
  `fecha_i` date DEFAULT NULL,
  `fecha_f` date DEFAULT NULL,
  `total` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_t_gasto_proveedor_t_proveedor1_idx` (`id_proveedor`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=13 ;

--
-- Volcado de datos para la tabla `t_informe_gasto_proveedor`
--

INSERT INTO `t_informe_gasto_proveedor` (`id`, `id_proveedor`, `fecha_i`, `fecha_f`, `total`) VALUES
(12, 1, '2017-09-01', '2017-09-30', '700');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `t_ingreso`
--

CREATE TABLE IF NOT EXISTS `t_ingreso` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(60) NOT NULL,
  `total` varchar(45) DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `t_ingreso`
--

INSERT INTO `t_ingreso` (`id`, `descripcion`, `total`, `fecha`) VALUES
(1, 'Un ingreso', '1230', '2017-09-01'),
(2, 'Un ingreso', '121', '2017-09-15');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `t_inventario`
--

CREATE TABLE IF NOT EXISTS `t_inventario` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_empleado` int(11) NOT NULL,
  `observacion` varchar(200) DEFAULT NULL,
  `fecha` date NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_t_inventario_t_empleado1_idx` (`id_empleado`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `t_inventario`
--

INSERT INTO `t_inventario` (`id`, `id_empleado`, `observacion`, `fecha`) VALUES
(1, 4, '', '2017-08-03');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `t_medidas`
--

CREATE TABLE IF NOT EXISTS `t_medidas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_finca` int(11) NOT NULL,
  `fecha_i` date DEFAULT NULL,
  `fecha_f` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_t_medidas_t_finca1_idx` (`id_finca`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Volcado de datos para la tabla `t_medidas`
--

INSERT INTO `t_medidas` (`id`, `id_finca`, `fecha_i`, `fecha_f`) VALUES
(6, 1, '2017-07-01', '2017-07-31');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `t_medida_valor`
--

CREATE TABLE IF NOT EXISTS `t_medida_valor` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_medidas` int(11) NOT NULL,
  `observacion` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_t_medida_valores_t_medidas1_idx` (`id_medidas`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `t_medida_valor`
--

INSERT INTO `t_medida_valor` (`id`, `id_medidas`, `observacion`) VALUES
(1, 6, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `t_mes`
--

CREATE TABLE IF NOT EXISTS `t_mes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `mes` varchar(60) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=13 ;

--
-- Volcado de datos para la tabla `t_mes`
--

INSERT INTO `t_mes` (`id`, `mes`) VALUES
(1, 'Enero'),
(2, 'Febrero'),
(3, 'Marzo'),
(4, 'Abril'),
(5, 'Mayo'),
(6, 'Junio'),
(7, 'Julio'),
(8, 'Agosto'),
(9, 'Septiembre'),
(10, 'Octubre'),
(11, 'Noviembre'),
(12, 'Diciembre');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `t_nivel`
--

CREATE TABLE IF NOT EXISTS `t_nivel` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(60) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `t_nivel`
--

INSERT INTO `t_nivel` (`id`, `descripcion`) VALUES
(1, 'Admin'),
(2, 'Descarga');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `t_nomina`
--

CREATE TABLE IF NOT EXISTS `t_nomina` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_finca` int(11) NOT NULL,
  `fecha_i` date DEFAULT NULL,
  `fecha_f` date DEFAULT NULL,
  `total` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_t_nomina_t_finca1_idx` (`id_finca`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Volcado de datos para la tabla `t_nomina`
--

INSERT INTO `t_nomina` (`id`, `id_finca`, `fecha_i`, `fecha_f`, `total`) VALUES
(3, 1, '2017-08-03', '2017-08-31', NULL),
(4, 2, '2017-08-09', '2017-08-30', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `t_proforma`
--

CREATE TABLE IF NOT EXISTS `t_proforma` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_empresa` int(11) NOT NULL,
  `fecha_i` date DEFAULT NULL,
  `fecha_f` date DEFAULT NULL,
  `total` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_t_proforma_original_t_empresa1_idx` (`id_empresa`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=119 ;

--
-- Volcado de datos para la tabla `t_proforma`
--

INSERT INTO `t_proforma` (`id`, `id_empresa`, `fecha_i`, `fecha_f`, `total`) VALUES
(118, 1, '2017-07-10', '2017-07-10', '124706993');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `t_proforma_pago`
--

CREATE TABLE IF NOT EXISTS `t_proforma_pago` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_empresa` int(11) NOT NULL,
  `id_finca` int(11) NOT NULL,
  `fecha_i` date DEFAULT NULL,
  `fecha_f` date DEFAULT NULL,
  `total` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_t_proforma_pago_t_empresa1_idx` (`id_empresa`),
  KEY `fk_t_proforma_pago_t_finca1_idx` (`id_finca`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=21 ;

--
-- Volcado de datos para la tabla `t_proforma_pago`
--

INSERT INTO `t_proforma_pago` (`id`, `id_empresa`, `id_finca`, `fecha_i`, `fecha_f`, `total`) VALUES
(20, 1, 1, '2017-07-01', '2017-07-31', '95879');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `t_proveedor`
--

CREATE TABLE IF NOT EXISTS `t_proveedor` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(60) NOT NULL,
  `dni` varchar(60) NOT NULL,
  `direccion` varchar(60) NOT NULL,
  `telf` varchar(60) NOT NULL,
  `email` varchar(60) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `t_proveedor`
--

INSERT INTO `t_proveedor` (`id`, `nombre`, `dni`, `direccion`, `telf`, `email`) VALUES
(1, 'Un proveedror', '1010101', 'detras de la mata', '1010101', 'proveedor@gmail.com');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `t_seguro`
--

CREATE TABLE IF NOT EXISTS `t_seguro` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(60) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `t_seguro`
--

INSERT INTO `t_seguro` (`id`, `descripcion`) VALUES
(1, 'Si'),
(2, 'No');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `t_tipo_gasto`
--

CREATE TABLE IF NOT EXISTS `t_tipo_gasto` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(60) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `t_tipo_gasto`
--

INSERT INTO `t_tipo_gasto` (`id`, `descripcion`) VALUES
(1, 'Un gasto'),
(2, 'Otro Gasto');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `t_tipo_gasto_proveedor`
--

CREATE TABLE IF NOT EXISTS `t_tipo_gasto_proveedor` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(60) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Volcado de datos para la tabla `t_tipo_gasto_proveedor`
--

INSERT INTO `t_tipo_gasto_proveedor` (`id`, `descripcion`) VALUES
(1, 'Mercado'),
(2, 'Gastos Personales'),
(3, 'Herramientas');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `t_unidad`
--

CREATE TABLE IF NOT EXISTS `t_unidad` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(60) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `t_usuario`
--

CREATE TABLE IF NOT EXISTS `t_usuario` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_nivel` int(11) NOT NULL,
  `nombre` varchar(60) NOT NULL,
  `login` varchar(60) NOT NULL,
  `clave` varchar(60) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_t_usuario_t_nivel1_idx` (`id_nivel`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `t_usuario`
--

INSERT INTO `t_usuario` (`id`, `id_nivel`, `nombre`, `login`, `clave`) VALUES
(1, 1, '999', 'admin@gmail.com', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220'),
(2, 2, '999', 'cliente@gmail.com', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220');

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `t_det_gasto`
--
ALTER TABLE `t_det_gasto`
  ADD CONSTRAINT `fk_t_det_gasto_t_gasto1` FOREIGN KEY (`id_gasto`) REFERENCES `t_gasto` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_t_det_gasto_t_tipo_gasto1` FOREIGN KEY (`id_tipo_gasto`) REFERENCES `t_tipo_gasto` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `t_det_gasto_proveedor`
--
ALTER TABLE `t_det_gasto_proveedor`
  ADD CONSTRAINT `fk_t_det_gasto_proveedor_t_proveedor1` FOREIGN KEY (`id_proveedor`) REFERENCES `t_proveedor` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_t_det_gasto_proveedor_t_tipo_gasto_proveedor1` FOREIGN KEY (`id_tipo_gasto_proveedor`) REFERENCES `t_tipo_gasto_proveedor` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `t_det_informe_gasto_proveedor`
--
ALTER TABLE `t_det_informe_gasto_proveedor`
  ADD CONSTRAINT `fk_t_det_informe_gasto_proveedor_t_informe_gasto_proveedor1` FOREIGN KEY (`id_informe_gasto_proveedor`) REFERENCES `t_informe_gasto_proveedor` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_t_det_informe_gasto_proveedor_t_tipo_gasto_proveedor1` FOREIGN KEY (`id_tipo_gasto_proveedor`) REFERENCES `t_tipo_gasto_proveedor` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `t_det_inventario`
--
ALTER TABLE `t_det_inventario`
  ADD CONSTRAINT `fk_t_det_inventario_t_herramienta1` FOREIGN KEY (`id_herramienta`) REFERENCES `t_herramienta` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_t_det_inventario_t_inventario1` FOREIGN KEY (`id_inventario`) REFERENCES `t_inventario` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `t_det_medidas`
--
ALTER TABLE `t_det_medidas`
  ADD CONSTRAINT `fk_t_det_medidas_t_faena1` FOREIGN KEY (`id_faena`) REFERENCES `t_faena` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_t_det_medidas_t_medidas1` FOREIGN KEY (`id_medidas`) REFERENCES `t_medidas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `t_det_medidas_valor`
--
ALTER TABLE `t_det_medidas_valor`
  ADD CONSTRAINT `fk_t_det_medidas_t_det_medidas1` FOREIGN KEY (`id_det_medidas`) REFERENCES `t_det_medidas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_t_medidas_valores_t_medida_valores1` FOREIGN KEY (`id_medida_valor`) REFERENCES `t_medida_valor` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `t_det_nomina`
--
ALTER TABLE `t_det_nomina`
  ADD CONSTRAINT `fk_t_det_nomina_t_empleado1` FOREIGN KEY (`id_empleado`) REFERENCES `t_empleado` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_t_det_nomina_t_nomina1` FOREIGN KEY (`id_nomina`) REFERENCES `t_nomina` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `t_det_proforma`
--
ALTER TABLE `t_det_proforma`
  ADD CONSTRAINT `fk_t_det_proforma_general_t_faena1` FOREIGN KEY (`id_faena`) REFERENCES `t_faena` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_t_det_proforma_general_t_finca1` FOREIGN KEY (`id_finca`) REFERENCES `t_finca` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_t_det_proforma_general_t_proforma_original1` FOREIGN KEY (`id_proforma`) REFERENCES `t_proforma` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `t_det_proforma_pago`
--
ALTER TABLE `t_det_proforma_pago`
  ADD CONSTRAINT `fk_t_det_proforma_t_faena1` FOREIGN KEY (`id_faena`) REFERENCES `t_faena` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_t_tabla_t_proforma_pago1` FOREIGN KEY (`id_proforma_pago`) REFERENCES `t_proforma_pago` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `t_empleado`
--
ALTER TABLE `t_empleado`
  ADD CONSTRAINT `fk_t_cliente_t_finca1` FOREIGN KEY (`id_finca`) REFERENCES `t_finca` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_t_empleado_t_seguro1` FOREIGN KEY (`id_seguro`) REFERENCES `t_seguro` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `t_estado_resultados`
--
ALTER TABLE `t_estado_resultados`
  ADD CONSTRAINT `fk_t_estado_resultados_t_gasto1` FOREIGN KEY (`id_gasto`) REFERENCES `t_gasto` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `t_gasto`
--
ALTER TABLE `t_gasto`
  ADD CONSTRAINT `fk_t_gasto_t_finca1` FOREIGN KEY (`id_finca`) REFERENCES `t_finca` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `t_informe_gasto_proveedor`
--
ALTER TABLE `t_informe_gasto_proveedor`
  ADD CONSTRAINT `fk_t_gasto_proveedor_t_proveedor1` FOREIGN KEY (`id_proveedor`) REFERENCES `t_proveedor` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `t_inventario`
--
ALTER TABLE `t_inventario`
  ADD CONSTRAINT `fk_t_inventario_t_empleado1` FOREIGN KEY (`id_empleado`) REFERENCES `t_empleado` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `t_medidas`
--
ALTER TABLE `t_medidas`
  ADD CONSTRAINT `fk_t_medidas_t_finca1` FOREIGN KEY (`id_finca`) REFERENCES `t_finca` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `t_medida_valor`
--
ALTER TABLE `t_medida_valor`
  ADD CONSTRAINT `fk_t_medida_valores_t_medidas1` FOREIGN KEY (`id_medidas`) REFERENCES `t_medidas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `t_nomina`
--
ALTER TABLE `t_nomina`
  ADD CONSTRAINT `fk_t_nomina_t_finca1` FOREIGN KEY (`id_finca`) REFERENCES `t_finca` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `t_proforma`
--
ALTER TABLE `t_proforma`
  ADD CONSTRAINT `fk_t_proforma_original_t_empresa1` FOREIGN KEY (`id_empresa`) REFERENCES `t_empresa` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `t_proforma_pago`
--
ALTER TABLE `t_proforma_pago`
  ADD CONSTRAINT `fk_t_proforma_pago_t_empresa1` FOREIGN KEY (`id_empresa`) REFERENCES `t_empresa` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_t_proforma_pago_t_finca1` FOREIGN KEY (`id_finca`) REFERENCES `t_finca` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `t_usuario`
--
ALTER TABLE `t_usuario`
  ADD CONSTRAINT `fk_t_usuario_t_nivel1` FOREIGN KEY (`id_nivel`) REFERENCES `t_nivel` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
