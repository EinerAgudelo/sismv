
--
-- Base de datos: `sismv_db`
--
drop database if exists sismv_db;
create database sismv_db;
use sismv_db;


DELIMITER ;

-- --------------------------------------------------------
CREATE TABLE `rol` (
  `idRol` int(11) NOT NULL AUTO_INCREMENT,
  `nombreRol` varchar(100) NOT NULL UNIQUE,
  `estadoRol` enum('activo','inactivo') NOT NULL,
  `create_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (idRol)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `rol`
--

INSERT INTO `rol` (`idRol`, `nombreRol`, `estadoRol`, `create_at`, `updated_at`) VALUES
(1, 'Administrador', 'activo', '2019-10-13 03:25:52', NULL),
(2, 'Cliente', 'activo', '2019-10-13 03:25:52', NULL);

-- --------------------------------------------------------
CREATE TABLE `usuarios` (
  `idUsuario` int(11) NOT NULL AUTO_INCREMENT,
  `tipo_documento` enum('CC','TI','CE','TP','otro') DEFAULT NULL,
  `numero_documento` bigint(20) NOT NULL,
  `nombreUsuario` varchar(100) NOT NULL,
  `apellidoUsuario` varchar(100) NOT NULL,
  `correoUsuario` varchar(100) NOT NULL UNIQUE,
  `passwordUsuario` varchar(50) NOT NULL,
  `token` varchar(200) DEFAULT NULL,
  `estadoUsuario` enum('activo','inactivo') NOT NULL,
  `rol` int(11) NOT NULL,
  PRIMARY KEY (idUsuario),
  FOREIGN KEY (rol) REFERENCES rol(idRol)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`idUsuario`, `tipo_documento`, `numero_documento`, `nombreUsuario`, `apellidoUsuario`, `correoUsuario`, `passwordUsuario`, `token`, `estadoUsuario`, `rol`) VALUES
(1, 'CC', 1010058202, 'Victor Santiago', 'Vivas Palacios', 'vsvivas2@misena.edu.co', '123', NULL, 'activo', 1),
(3, 'CC', 1001176664, 'Valen', 'Velandia LondoÃ±o', 'valen.velandia@gmail.com', '123', '5690917e2d3d2ee4e45445c3e36f1db0', 'activo', 2),
(4, 'CC', 123, 'prueba', 'prueba', 'prueba@gmail.com', '123', NULL, 'activo', 2),
(5, 'CC', 1, 'Prueba', 'palaces', '1@gmail.com', '1', '1f6d2d9cb909f7ab03e9f23cc83d6d41', 'inactivo', 2),
(11, 'CC', 12, 'Maria Paula', 'Vivas Palacios', 'mvivas@udca.edu.co', '123', '2f57cc0acaba762ea1fd8630c3ba460f', 'inactivo', 2),
(29, 'CC', 987, 'Tiago', 'Vivas Palacios', 'winzlowxdxd@gmail.com', '123', '5ef64a0742900d8e2fa3fdd05168de93', 'activo', 2);

--
--
-- Estructura de tabla para la tabla `centros`
--

CREATE TABLE `centros` (
  `idCentro` int(11) NOT NULL AUTO_INCREMENT,
  `nombreCentro` varchar(100) NOT NULL UNIQUE,
  `acronimoCentro` varchar(50) NOT NULL,
  `estadoCentro` enum('activo','inactivo') NOT NULL,
  PRIMARY KEY (idCentro)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `centros`
--

INSERT INTO `centros` (`idCentro`, `nombreCentro`, `acronimoCentro`, `estadoCentro`) VALUES
(1, 'Centro de Gestion de Mercados, Logistica y Tecnologias de la Informacion', 'CM', 'activo');

-- --------------------------------------------------------
-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sedes`
--

CREATE TABLE `sedes` (
  `idSede` int(11) NOT NULL AUTO_INCREMENT,
  `idCentro` int(11) NOT NULL,
  `nombreSede` varchar(100) NOT NULL,
  `direccion` varchar(200) NOT NULL,
  `telefono` varchar(20) NOT NULL,
  `estadoSede` enum('activo','inactivo') NOT NULL,
  PRIMARY KEY(idSede),
  FOREIGN KEY (idCentro) REFERENCES centros(idCentro)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `sedes`
--

INSERT INTO `sedes` (`idSede`, `idCentro`, `nombreSede`, `direccion`, `telefono`, `estadoSede`) VALUES
(1, 1, 'Principal', 'cll 52', '123', 'activo'),
(2, 1, 'Ingles', 'call 44', '321', 'activo');

-- --------------------------------------------------------
--
-- Estructura de tabla para la tabla `areas`
--

CREATE TABLE `areas` (
  `idArea` int(11) NOT NULL AUTO_INCREMENT,
  `idSede` int(11) NOT NULL,
  `nombreArea` varchar(100) NOT NULL,
  `piso` varchar(10) DEFAULT NULL,
  `estadoArea` enum('activo','inactivo') NOT NULL,
	PRIMARY KEY (idArea),
    FOREIGN KEY (idSede) REFERENCES sedes(idSede)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `areas`
--

INSERT INTO `areas` (`idArea`, `idSede`, `nombreArea`, `piso`, `estadoArea`) VALUES
(1, 1, 'agora', '4', 'activo'),
(2, 1, 'Biblioteca', '1', 'activo'),
(3, 1, 'Cafeteria', '2', 'activo'),
(4, 2, 'Escaleras', '5', 'activo');

--
-- Estructura de tabla para la tabla `sensores`
--

CREATE TABLE `sensores` (
  `idSensor` int(11) NOT NULL AUTO_INCREMENT,
  `referencia` varchar(50) NOT NULL,
  `estadoSensor` enum('activo','inactivo') NOT NULL,
  `idArea` int(11) NOT NULL, 
  PRIMARY KEY(idSensor),
  FOREIGN KEY (idArea) REFERENCES areas(idArea)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `sensores`
--

INSERT INTO `sensores` (`idSensor`, `referencia`, `estadoSensor`, `idArea`) VALUES
(1, 'DTH-11', 'activo', 1),
(2, 'DTH-22', 'activo', 2),
(3, 'MQ-135', 'activo', 1),
(4, 'MQ-3', 'activo', 1),
(6, 'MQ2', 'inactivo', 1),
(7, 'asdf', 'inactivo', 3),
(8, 'Me lo pela', 'inactivo', 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tiposdatos`
--

CREATE TABLE `tiposdatos` (
  `idTipoDato` int(11) NOT NULL,
  `nombreTipoDato` varchar(100) NOT NULL UNIQUE,
  PRIMARY KEY (idTipoDato)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tiposdatos`
--

INSERT INTO `tiposdatos` (`idTipoDato`, `nombreTipoDato`) VALUES
(3, 'Calidad de aire'),
(4, 'CO2'),
(2, 'Humedad'),
(1, 'Temperatura');

-- --------------------------------------------------------

-- Estructura de tabla para la tabla `datossensor`
--

CREATE TABLE `datossensor` (
  `idDatosSensor` int(11) NOT NULL AUTO_INCREMENT,
  `idSensor` int(11) NOT NULL,
  `idTipoDato` int(11) NOT NULL,
  `dato` varchar(50) NOT NULL,
  `fecha` datetime NOT NULL, 
  PRIMARY KEY (idDatosSensor),
  FOREIGN KEY (idSensor) REFERENCES sensores(idSensor),
  FOREIGN KEY (idTipoDato) REFERENCES tiposdatos(idTipoDato)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
--
-- Procedimientos
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `InsertRandomData_Sensor1` ()  INSERT INTO DATOSSENSOR (
		IDSENSOR,
		IDTIPODATO,
		DATO,
		FECHA
	)
	SELECT 1 AS IDSENSOR,
	1 AS IDTIPODATO,
	FLOOR(RAND()*(50-1+1)+1) AS DATO,
	NOW() AS FECHA;

CREATE DEFINER=`root`@`localhost` PROCEDURE `InsertRandomData_Sensor2` ()  NO SQL
INSERT INTO DATOSSENSOR (
		IDSENSOR,
		IDTIPODATO,
		DATO,
		FECHA
	)
	SELECT 2 AS IDSENSOR,
	2 AS IDTIPODATO,
	FLOOR(RAND()*(50-1+1)+1) AS DATO,
	NOW() AS FECHA;

CREATE DEFINER=`root`@`localhost` PROCEDURE `InsertRandomData_Sensor3` ()  NO SQL
INSERT INTO DATOSSENSOR (
		IDSENSOR,
		IDTIPODATO,
		DATO,
		FECHA
	)
	SELECT 3 AS IDSENSOR,
	3 AS IDTIPODATO,
	FLOOR(RAND()*(50-1+1)+1) AS DATO,
	NOW() AS FECHA;

CREATE DEFINER=`root`@`localhost` PROCEDURE `InsertRandomData_Sensor4` ()  NO SQL
INSERT INTO DATOSSENSOR (
		IDSENSOR,
		IDTIPODATO,
		DATO,
		FECHA
	)
	SELECT 4 AS IDSENSOR,
	4 AS IDTIPODATO,
	FLOOR(RAND()*(50-1+1)+1) AS DATO,
	NOW() AS FECHA;

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_Activar_Cuenta` (IN `inputIdUsuario` INT, IN `inputToken` VARCHAR(200))  NO SQL
UPDATE usuarios 
SET `estadoUsuario` = 1 
WHERE idUsuario = inputIdUsuario 
AND token = inputToken;

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_Consulta_Estado_Sensor` (IN `inputEstadoSensor` INT)  NO SQL
SELECT  sensores.idSensor, 
		sensores.referencia, 
        sensores.estadoSensor,
        sensores.idArea,
        areas.nombreArea, 
        areas.piso, 
        areas.idSede,
        sedes.nombreSede,
        sedes.idCentro,
        centros.nombreCentro
FROM sensores 
INNER JOIN areas 
ON sensores.idArea = areas.idArea 
INNER JOIN sedes 
ON areas.idSede = sedes.idSede
INNER JOIN centros
ON sedes.idCentro = centros.idCentro WHERE sensores.estadoSensor = inputEstadoSensor;

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_Consulta_Referencia` (IN `inputReferencia` VARCHAR(50))  NO SQL
SELECT  sensores.idSensor, 
		sensores.referencia, 
        sensores.estadoSensor,
        sensores.idArea,
        areas.nombreArea, 
        areas.piso, 
        areas.idSede,
        sedes.nombreSede,
        sedes.idCentro,
        centros.nombreCentro
FROM sensores 
INNER JOIN areas 
ON sensores.idArea = areas.idArea 
INNER JOIN sedes 
ON areas.idSede = sedes.idSede
INNER JOIN centros
ON sedes.idCentro = centros.idCentro WHERE sensores.referencia = inputReferencia;

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_Consulta_Sensor_Areas` (IN `inputIdArea` INT)  NO SQL
SELECT  sensores.idSensor, 
		sensores.referencia, 
        sensores.estadoSensor,
        sensores.idArea,
        areas.nombreArea, 
        areas.piso, 
        areas.idSede,
        sedes.nombreSede,
        sedes.idCentro,
        centros.nombreCentro
FROM sensores 
INNER JOIN areas 
ON sensores.idArea = areas.idArea 
INNER JOIN sedes 
ON areas.idSede = sedes.idSede
INNER JOIN centros
ON sedes.idCentro = centros.idCentro WHERE sensores.idArea = inputIdArea;

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_Consulta_Sensor_Centro` (IN `inputIdCentro` INT)  NO SQL
SELECT  sensores.idSensor, 
		sensores.referencia, 
        sensores.estadoSensor,
        sensores.idArea,
        areas.nombreArea, 
        areas.piso, 
        areas.idSede,
        sedes.nombreSede,
        sedes.idCentro,
        centros.nombreCentro
FROM sensores 
INNER JOIN areas 
ON sensores.idArea = areas.idArea 
INNER JOIN sedes 
ON areas.idSede = sedes.idSede
INNER JOIN centros
ON sedes.idCentro = centros.idCentro WHERE sedes.idCentro = inputIdCentro;

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_Consulta_Sensor_Id` (IN `inputIdSensor` INT)  NO SQL
SELECT  sensores.idSensor, 
		sensores.referencia, 
        sensores.estadoSensor,
        sensores.idArea,
        areas.nombreArea, 
        areas.piso, 
        areas.idSede,
        sedes.nombreSede,
        sedes.idCentro,
        centros.nombreCentro
FROM sensores 
INNER JOIN areas 
ON sensores.idArea = areas.idArea 
INNER JOIN sedes 
ON areas.idSede = sedes.idSede
INNER JOIN centros
ON sedes.idCentro = centros.idCentro WHERE sensores.idSensor = inputIdSensor;

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_Consulta_Sensor_Sedes` (IN `inputIdSede` INT)  NO SQL
SELECT  sensores.idSensor, 
		sensores.referencia, 
        sensores.estadoSensor,
        sensores.idArea,
        areas.nombreArea, 
        areas.piso, 
        areas.idSede,
        sedes.nombreSede,
        sedes.idCentro,
        centros.nombreCentro
FROM sensores 
INNER JOIN areas 
ON sensores.idArea = areas.idArea 
INNER JOIN sedes 
ON areas.idSede = sedes.idSede
INNER JOIN centros
ON sedes.idCentro = centros.idCentro WHERE areas.idSede = inputIdSede;

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_Consulta_Tabla` ()  NO SQL
SELECT  sensores.idSensor, 
		sensores.referencia, 
        sensores.estadoSensor,
        sensores.idArea,
        areas.nombreArea, 
        areas.piso, 
        areas.idSede,
        sedes.nombreSede,
        sedes.idCentro,
        centros.nombreCentro
FROM sensores 
INNER JOIN areas 
ON sensores.idArea = areas.idArea 
INNER JOIN sedes 
ON areas.idSede = sedes.idSede
INNER JOIN centros
ON sedes.idCentro = centros.idCentro;

--
-- Eventos
--
CREATE DEFINER=`root`@`localhost` EVENT `ExecuteInsertRandomData` ON SCHEDULE EVERY 10 SECOND STARTS '2019-10-14 12:16:00' ON COMPLETION NOT PRESERVE ENABLE DO CALL InsertRandomData_Sensor1();

CREATE DEFINER=`root`@`localhost` EVENT `ExecuteInsertRandomData_2` ON SCHEDULE EVERY 10 SECOND STARTS '2019-10-16 00:00:00' ON COMPLETION NOT PRESERVE ENABLE DO CALL InsertRandomData_Sensor2();

CREATE DEFINER=`root`@`localhost` EVENT `ExecuteInsertRandomData_3` ON SCHEDULE EVERY 10 SECOND STARTS '2019-10-17 22:44:03' ON COMPLETION NOT PRESERVE ENABLE DO CALL InsertRandomData_Sensor3();

CREATE DEFINER=`root`@`localhost` EVENT `ExecuteInsertRandomData_4` ON SCHEDULE EVERY 10 SECOND STARTS '2019-10-17 22:55:29' ON COMPLETION NOT PRESERVE ENABLE DO CALL InsertRandomData_Sensor4();

DELIMITER ;
COMMIT;
	