-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 15-03-2023 a las 02:03:31
-- Versión del servidor: 10.4.27-MariaDB
-- Versión de PHP: 8.0.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `adk`
--
CREATE DATABASE IF NOT EXISTS `adk` DEFAULT CHARACTER SET utf8 COLLATE utf8_bin;
USE `adk`;

DELIMITER $$
--
-- Procedimientos
--
DROP PROCEDURE IF EXISTS `SP_AUTH`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_AUTH` (IN `P_SUSER` VARCHAR(80), IN `P_SPASSWORD` VARCHAR(255))   BEGIN
	SELECT U.SUSER    AS "USUARIO",
		   U.NSTATUS  AS "ESTADO",
		   U.SNOMBRE AS "NOMBRE",
		   U.SAPELLIDO_PAT AS "APELLIDO_PAT",
		   U.SAPELLIDO_MAT AS "APELLIDO_MAT",
		   U.NPASSWORD_RESET  AS "RESET"
	FROM usuario U
	WHERE U.SUSER = P_SUSER AND U.SPASSWORD = P_SPASSWORD
	AND U.NSTATUS = 1;
    
    END$$

DROP PROCEDURE IF EXISTS `SP_AUTH_ROLES`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_AUTH_ROLES` (IN `P_SUSER` VARCHAR(80), IN `P_SPASSWORD` VARCHAR(80))   BEGIN
	SELECT P.SLABEL   AS "LABEL",
		   P.SURL	  AS "URL",
           P.SICON	  AS "ICON"
	FROM usuario U
	INNER JOIN usuario_privilegio UP ON UP.NUSER = U.NID
	INNER JOIN privilegios P ON UP.NPRIVILEGIO = P.NID
	WHERE U.SUSER = P_SUSER AND U.SPASSWORD = P_SPASSWORD AND UP.NSTATUS = 1;
	END$$

DROP PROCEDURE IF EXISTS `SP_DEL_PARAMETER`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_DEL_PARAMETER` (IN `P_NID` INT)   BEGIN

    DELETE FROM parametros_servicios
    WHERE NID = P_NID;

    COMMIT;

END$$

DROP PROCEDURE IF EXISTS `SP_DEL_USER`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_DEL_USER` (IN `P_SDOCUMENT` VARCHAR(9))  DETERMINISTIC BEGIN

	DELETE FROM USUARIO 
        WHERE SDOCUMENT = P_SDOCUMENT;

	COMMIT;

END$$

DROP PROCEDURE IF EXISTS `SP_INS_PARAMETER`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_INS_PARAMETER` (IN `P_SLABEL` VARCHAR(100), IN `P_SVALUE` VARCHAR(250), IN `P_CTYPE` VARCHAR(1))   BEGIN
	DECLARE COUNT_PARAMETER INT;
    
    SELECT COUNT(*)
    INTO COUNT_PARAMETER
    FROM parametros_servicios
    WHERE SLABEL = P_SLABEL;
    
    IF COUNT_PARAMETER = 0 THEN
    	INSERT INTO parametros_servicios (SLABEL, SVALUE, CTYPE)
        VALUES (P_SLABEL, P_SVALUE, P_CTYPE);
    ELSE
    	UPDATE parametros_servicios
        SET SVALUE = P_SVALUE
		WHERE SLABEL = P_SLABEL;
    END IF;
    
    COMMIT;
END$$

DROP PROCEDURE IF EXISTS `SP_INS_USER`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_INS_USER` (IN `P_SDOCUMENT` VARCHAR(8), IN `P_SNOMBRE` VARCHAR(100), IN `P_SAPELLIDO_PAT` VARCHAR(100), IN `P_SAPELLIDO_MAT` VARCHAR(100), IN `P_SEMAIL` VARCHAR(100), IN `P_SNUMBER` VARCHAR(9), IN `P_NSTATUS` INT, IN `P_SUSER` VARCHAR(50), IN `P_NPASSWORD_RESET` INT, IN `P_SDIRECCION` VARCHAR(250), IN `P_SPASSWORD` VARCHAR(250))   BEGIN
	DECLARE COUNT_USER INT;
	
	SELECT COUNT(*)
	INTO COUNT_USER
	FROM usuario 
	WHERE SDOCUMENT = P_SDOCUMENT;
	
	IF COUNT_USER = 0 THEN
		INSERT INTO usuario
		(SDOCUMENT, SNOMBRE, SAPELLIDO_PAT, SAPELLIDO_MAT, SEMAIL, SNUMBER, NSTATUS, SPASSWORD, SDIRECCION, SUSER)
		VALUES(P_SDOCUMENT, P_SNOMBRE, P_SAPELLIDO_PAT, P_SAPELLIDO_MAT, P_SEMAIL, P_SNUMBER, P_NSTATUS, P_SPASSWORD, P_SDIRECCION, P_SUSER);
	ELSE 
		UPDATE usuario SET 
			SNOMBRE = P_SNOMBRE, 
			SAPELLIDO_PAT = P_SAPELLIDO_PAT, 
			SAPELLIDO_MAT = P_SAPELLIDO_MAT, 
			SEMAIL = P_SEMAIL, 
			SNUMBER = P_SNUMBER,
            NSTATUS = P_NSTATUS,
            SDIRECCION = P_SDIRECCION
		WHERE SDOCUMENT = P_SDOCUMENT;
	END IF;

END$$

DROP PROCEDURE IF EXISTS `SP_INS_USER_PRIVILEGIOS`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_INS_USER_PRIVILEGIOS` (IN `P_SDOCUMENT` VARCHAR(80), IN `P_SPRIVILEGIOS` VARCHAR(80), IN `P_BSTATUS` INT)   BEGIN
	DECLARE NIDUSER INT;
	DECLARE NIDPRIVILEGIOS INT;
	DECLARE COUNT_ROLES INT;

	SELECT U.NID
	INTO NIDUSER
	FROM USUARIO U
	WHERE U.SDOCUMENT = P_SDOCUMENT;

	SELECT NID
	INTO NIDPRIVILEGIOS
	FROM PRIVILEGIOS P
	WHERE P.SLABEL = P_SPRIVILEGIOS;

	SELECT COUNT(*) 
	INTO COUNT_ROLES
	FROM USUARIO_PRIVILEGIO UP
	WHERE UP.NPRIVILEGIO = NIDPRIVILEGIOS AND UP.NUSER = NIDUSER;
	
	IF COUNT_ROLES = 0 THEN
		INSERT INTO USUARIO_PRIVILEGIO 
		(NUSER, NPRIVILEGIO, NSTATUS)
		VALUES(NIDUSER, NIDPRIVILEGIOS, P_BSTATUS);
	ELSE 
		UPDATE USUARIO_PRIVILEGIO UP
		SET NSTATUS = P_BSTATUS
		WHERE UP.NPRIVILEGIO = NIDPRIVILEGIOS 
		  AND UP.NUSER = NIDUSER;
	END IF;

END$$

DROP PROCEDURE IF EXISTS `SP_RESET_PASSWORD`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_RESET_PASSWORD` (IN `P_SUSER` VARCHAR(80), IN `P_SPASSWORD` VARCHAR(80))   BEGIN
	UPDATE usuario 
	SET SPASSWORD = P_SPASSWORD, 
		NPASSWORD_RESET = 0 
	WHERE SUSER = P_SUSER;
END$$

DROP PROCEDURE IF EXISTS `SP_SEL_PARAMETER`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_SEL_PARAMETER` ()   BEGIN
     SELECT SLABEL AS "LABEL",
            SVALUE AS "VALOR",
            CTYPE  AS "TIPO",
            NID    AS "ID"
     FROM parametros_servicios;
END$$

DROP PROCEDURE IF EXISTS `SP_SEL_PARAMETER_ID`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_SEL_PARAMETER_ID` (IN `P_NID` INT)   BEGIN
	SELECT SLABEL AS "LABEL",
            SVALUE AS "VALOR",
            CTYPE  AS "TIPO",
            NID    AS "ID"
     FROM parametros_servicios
     WHERE NID = P_NID;
END$$

DROP PROCEDURE IF EXISTS `SP_SEL_ROLES`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_SEL_ROLES` ()   BEGIN
	SELECT P.NID    AS "ID",
		   P.SLABEL AS "LABEL"
	FROM privilegios P;
END$$

DROP PROCEDURE IF EXISTS `SP_SEL_ROLES_DNI`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_SEL_ROLES_DNI` (IN `P_SDOCUMENT` VARCHAR(9))   BEGIN
	SELECT P.SLABEL   AS "LABEL",
	       UP.NSTATUS AS "STATUS"
	FROM USUARIO U
	INNER JOIN USUARIO_PRIVILEGIO UP ON UP.NUSER = U.NID
	INNER JOIN PRIVILEGIOS P ON UP.NPRIVILEGIO = P.NID
	WHERE U.SDOCUMENT = P_SDOCUMENT;
END$$

DROP PROCEDURE IF EXISTS `SP_SEL_USER`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_SEL_USER` (IN `P_SUSER` VARCHAR(80))   BEGIN
	SELECT U.SUSER    AS "USUARIO",
		   U.NSTATUS  AS "ESTADO",
		   U.SNOMBRE AS "NOMBRE",
		   U.SAPELLIDO_PAT AS "APELLIDO_PAT",
		   U.SAPELLIDO_MAT AS "APELLIDO_MAT",
		   U.SDOCUMENT 	AS "DOCUMENTO"
	FROM usuario U
	WHERE U.SUSER <> P_SUSER AND U.SUSER <> "ROOT";
 END$$

DROP PROCEDURE IF EXISTS `SP_SEL_USER_DNI`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_SEL_USER_DNI` (IN `P_SDOCUMENT` VARCHAR(9))   BEGIN
	SELECT U.SDOCUMENT AS "DOCUMENTO", 
	       U.SNOMBRE AS "NOMBRE", 
	       U.SAPELLIDO_PAT AS "APELLIDO_PAT", 
	       U.SAPELLIDO_MAT AS "APELLIDO_MAT", 
	       U.SEMAIL AS "EMAIL", 
	       U.SNUMBER AS "NUMERO", 
	       U.NSTATUS AS "STATUS", 
	       U.SUSER AS "USER", 
	       U.NPASSWORD_RESET AS "RESET",
	       U.SDIRECCION AS "DIRECCION"
	FROM  USUARIO U
	WHERE U.SDOCUMENT = P_SDOCUMENT;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `casas`
--

DROP TABLE IF EXISTS `casas`;
CREATE TABLE `casas` (
  `NID` int(11) NOT NULL,
  `NCLIENTE` int(11) NOT NULL,
  `SDIRECCION` varchar(99) NOT NULL,
  `NURBANIZACION` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `casas_servicios`
--

DROP TABLE IF EXISTS `casas_servicios`;
CREATE TABLE `casas_servicios` (
  `NID` int(11) NOT NULL,
  `NCASA` int(11) NOT NULL,
  `NSERVICIO` int(11) NOT NULL,
  `DINICIO_SERVICIO` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

DROP TABLE IF EXISTS `clientes`;
CREATE TABLE `clientes` (
  `NID` int(11) NOT NULL,
  `SDOCUMENT` int(11) NOT NULL,
  `SNOMBRE` varchar(99) NOT NULL,
  `SAPELLIDO_PAT` varchar(99) NOT NULL,
  `SAPELLIDO_MAT` varchar(99) NOT NULL,
  `SEMAIL` varchar(99) NOT NULL,
  `SNUMBER` int(11) NOT NULL,
  `SDIRECCION` varchar(99) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_pago`
--

DROP TABLE IF EXISTS `detalle_pago`;
CREATE TABLE `detalle_pago` (
  `NID` int(11) NOT NULL,
  `NCLIENTE` int(11) NOT NULL,
  `NSERVICIO` int(11) NOT NULL,
  `NMONTO` int(11) NOT NULL,
  `NUSER` int(11) NOT NULL,
  `DREGISTRO` varchar(99) NOT NULL,
  `SOBSERVACION` varchar(99) NOT NULL,
  `MMEDICION` varchar(99) NOT NULL,
  `NSTATUS` int(11) NOT NULL,
  `DVENCIMIENTO` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `parametros_servicios`
--

DROP TABLE IF EXISTS `parametros_servicios`;
CREATE TABLE `parametros_servicios` (
  `NID` int(11) NOT NULL,
  `SLABEL` varchar(99) NOT NULL,
  `SVALUE` varchar(250) NOT NULL,
  `CTYPE` varchar(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `parametros_servicios`
--

INSERT INTO `parametros_servicios` (`NID`, `SLABEL`, `SVALUE`, `CTYPE`) VALUES
(2, 'AAAAAAS', '12321', 'S'),
(3, 'SASSSSS', 'DDDDD', 'S'),
(6, 'qqqqqqqqqqqqqqq', '123123', 'N');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `privilegios`
--

DROP TABLE IF EXISTS `privilegios`;
CREATE TABLE `privilegios` (
  `NID` int(11) NOT NULL,
  `SLABEL` varchar(50) NOT NULL,
  `SURL` varchar(50) NOT NULL,
  `SICON` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `privilegios`
--

INSERT INTO `privilegios` (`NID`, `SLABEL`, `SURL`, `SICON`) VALUES
(1, 'Usuarios', '/user', '                                <svg class=\"icon-32\" width=\"32\" viewBox=\"0 0 24 24\" fill=\"none\" xmlns=\"http://www.w3.org/2000/svg\">                                <path d=\"M11.9488 14.54C8.49884 14.54 5.58789 15.1038 5.58789 17.2795C5.58789 19.4562 8.51765 20.0001 11.9488 20.0001C15.3988 20.0001 18.3098 19.4364 18.3098 17.2606C18.3098 15.084 15.38 14.54 11.9488 14.54Z\" fill=\"currentColor\"></path>                                <path opacity=\"0.4\" d=\"M11.949 12.467C14.2851 12.467 16.1583 10.5831 16.1583 8.23351C16.1583 5.88306 14.2851 4 11.949 4C9.61293 4 7.73975 5.88306 7.73975 8.23351C7.73975 10.5831 9.61293 12.467 11.949 12.467Z\" fill=\"currentColor\"></path>                                <path opacity=\"0.4\" d=\"M21.0881 9.21923C21.6925 6.84176 19.9205 4.70654 17.664 4.70654C17.4187 4.70654 17.1841 4.73356 16.9549 4.77949C16.9244 4.78669 16.8904 4.802 16.8725 4.82902C16.8519 4.86324 16.8671 4.90917 16.8895 4.93889C17.5673 5.89528 17.9568 7.0597 17.9568 8.30967C17.9568 9.50741 17.5996 10.6241 16.9728 11.5508C16.9083 11.6462 16.9656 11.775 17.0793 11.7948C17.2369 11.8227 17.3981 11.8371 17.5629 11.8416C19.2059 11.8849 20.6807 10.8213 21.0881 9.21923Z\" fill=\"currentColor\"></path>                                <path d=\"M22.8094 14.817C22.5086 14.1722 21.7824 13.73 20.6783 13.513C20.1572 13.3851 18.747 13.205 17.4352 13.2293C17.4155 13.232 17.4048 13.2455 17.403 13.2545C17.4003 13.2671 17.4057 13.2887 17.4316 13.3022C18.0378 13.6039 20.3811 14.916 20.0865 17.6834C20.074 17.8032 20.1698 17.9068 20.2888 17.8888C20.8655 17.8059 22.3492 17.4853 22.8094 16.4866C23.0637 15.9589 23.0637 15.3456 22.8094 14.817Z\" fill=\"currentColor\"></path>                                <path opacity=\"0.4\" d=\"M7.04459 4.77973C6.81626 4.7329 6.58077 4.70679 6.33543 4.70679C4.07901 4.70679 2.30701 6.84201 2.9123 9.21947C3.31882 10.8216 4.79355 11.8851 6.43661 11.8419C6.60136 11.8374 6.76343 11.8221 6.92013 11.7951C7.03384 11.7753 7.09115 11.6465 7.02668 11.551C6.3999 10.6234 6.04263 9.50765 6.04263 8.30991C6.04263 7.05904 6.43303 5.89462 7.11085 4.93913C7.13234 4.90941 7.14845 4.86348 7.12696 4.82926C7.10906 4.80135 7.07593 4.78694 7.04459 4.77973Z\" fill=\"currentColor\"></path>                                <path d=\"M3.32156 13.5127C2.21752 13.7297 1.49225 14.1719 1.19139 14.8167C0.936203 15.3453 0.936203 15.9586 1.19139 16.4872C1.65163 17.4851 3.13531 17.8066 3.71195 17.8885C3.83104 17.9065 3.92595 17.8038 3.91342 17.6832C3.61883 14.9167 5.9621 13.6046 6.56918 13.3029C6.59425 13.2885 6.59962 13.2677 6.59694 13.2542C6.59515 13.2452 6.5853 13.2317 6.5656 13.2299C5.25294 13.2047 3.84358 13.3848 3.32156 13.5127Z\" fill=\"currentColor\"></path>                                </svg>                            '),
(2, 'Parámetros', '/parameter', '                                <svg class=\"icon-32\" width=\"32\" viewBox=\"0 0 24 24\" fill=\"none\" xmlns=\"http://www.w3.org/2000/svg\">                                <path d=\"M12.0122 14.8299C10.4077 14.8299 9.10986 13.5799 9.10986 12.0099C9.10986 10.4399 10.4077 9.17993 12.0122 9.17993C13.6167 9.17993 14.8839 10.4399 14.8839 12.0099C14.8839 13.5799 13.6167 14.8299 12.0122 14.8299Z\" fill=\"currentColor\"></path>                                <path opacity=\"0.4\" d=\"M21.2301 14.37C21.036 14.07 20.76 13.77 20.4023 13.58C20.1162 13.44 19.9322 13.21 19.7687 12.94C19.2475 12.08 19.5541 10.95 20.4228 10.44C21.4447 9.87 21.7718 8.6 21.179 7.61L20.4943 6.43C19.9118 5.44 18.6344 5.09 17.6226 5.67C16.7233 6.15 15.5685 5.83 15.0473 4.98C14.8838 4.7 14.7918 4.4 14.8122 4.1C14.8429 3.71 14.7203 3.34 14.5363 3.04C14.1582 2.42 13.4735 2 12.7172 2H11.2763C10.5302 2.02 9.84553 2.42 9.4674 3.04C9.27323 3.34 9.16081 3.71 9.18125 4.1C9.20169 4.4 9.10972 4.7 8.9462 4.98C8.425 5.83 7.27019 6.15 6.38109 5.67C5.35913 5.09 4.09191 5.44 3.49917 6.43L2.81446 7.61C2.23194 8.6 2.55897 9.87 3.57071 10.44C4.43937 10.95 4.74596 12.08 4.23498 12.94C4.06125 13.21 3.87729 13.44 3.59115 13.58C3.24368 13.77 2.93709 14.07 2.77358 14.37C2.39546 14.99 2.4159 15.77 2.79402 16.42L3.49917 17.62C3.87729 18.26 4.58245 18.66 5.31825 18.66C5.66572 18.66 6.0745 18.56 6.40153 18.36C6.65702 18.19 6.96361 18.13 7.30085 18.13C8.31259 18.13 9.16081 18.96 9.18125 19.95C9.18125 21.1 10.1215 22 11.3069 22H12.6968C13.872 22 14.8122 21.1 14.8122 19.95C14.8429 18.96 15.6911 18.13 16.7029 18.13C17.0299 18.13 17.3365 18.19 17.6022 18.36C17.9292 18.56 18.3278 18.66 18.6855 18.66C19.411 18.66 20.1162 18.26 20.4943 17.62L21.2097 16.42C21.5776 15.75 21.6083 14.99 21.2301 14.37Z\" fill=\"currentColor\"></path>                                </svg>                            ');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `servicios`
--

DROP TABLE IF EXISTS `servicios`;
CREATE TABLE `servicios` (
  `NID` int(11) NOT NULL,
  `SNOMBRE` varchar(99) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `urbanizaciones`
--

DROP TABLE IF EXISTS `urbanizaciones`;
CREATE TABLE `urbanizaciones` (
  `NID` int(11) NOT NULL,
  `SURBANIZACION` varchar(99) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

DROP TABLE IF EXISTS `usuario`;
CREATE TABLE `usuario` (
  `NID` int(11) NOT NULL,
  `NSTATUS` int(1) NOT NULL,
  `SUSER` varchar(50) NOT NULL,
  `SPASSWORD` varchar(250) NOT NULL,
  `NPASSWORD_RESET` int(1) NOT NULL DEFAULT 1,
  `SDOCUMENT` varchar(8) NOT NULL,
  `SNOMBRE` varchar(100) NOT NULL,
  `SAPELLIDO_PAT` varchar(100) NOT NULL,
  `SAPELLIDO_MAT` varchar(100) NOT NULL,
  `SNUMBER` varchar(9) NOT NULL,
  `SDIRECCION` varchar(250) NOT NULL,
  `SEMAIL` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`NID`, `NSTATUS`, `SUSER`, `SPASSWORD`, `NPASSWORD_RESET`, `SDOCUMENT`, `SNOMBRE`, `SAPELLIDO_PAT`, `SAPELLIDO_MAT`, `SNUMBER`, `SDIRECCION`, `SEMAIL`) VALUES
(1, 1, 'root', '25d55ad283aa400af464c76d713c07ad', 0, '12345678', 'Usuario', 'Prueba', 'Anker', '987654321', 'Villa el salvador', ''),
(2, 1, 'prueba', '25d55ad283aa400af464c76d713c07ad', 1, '78946546', 'Guillermo', 'AAAAsd', 'AAAAAaas', '79879', 'dfssdffsdfsdasdsad af', 'ASD@ASD.COM'),
(5, 1, 'prueba3', 'bac76b0feb747e3bde11269cf367c97b', 1, '98765432', 'Nombre', 'Prueba', 'Funcional2', '987654321', 'Villa el salvador', 'asdasd@asd.com'),
(7, 1, 'aadsasfdsgfdsgfd', '53524a70ce307a863e7d46a05da526c0', 1, '98876546', 'Guillermo', 'AAAA', 'AAAAA', '79879', 'dfssdffsdfsd', 'ASD@ASD.COM');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario_privilegio`
--

DROP TABLE IF EXISTS `usuario_privilegio`;
CREATE TABLE `usuario_privilegio` (
  `NID` int(11) NOT NULL,
  `NUSER` int(11) NOT NULL,
  `NPRIVILEGIO` int(11) NOT NULL,
  `NSTATUS` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `usuario_privilegio`
--

INSERT INTO `usuario_privilegio` (`NID`, `NUSER`, `NPRIVILEGIO`, `NSTATUS`) VALUES
(5, 1, 1, 1),
(6, 1, 2, 1),
(7, 2, 1, 0),
(8, 2, 2, 1),
(9, 5, 1, 1),
(10, 5, 2, 0),
(11, 7, 1, 0),
(12, 7, 2, 0);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `casas`
--
ALTER TABLE `casas`
  ADD PRIMARY KEY (`NID`),
  ADD UNIQUE KEY `NCLIENTE` (`NCLIENTE`),
  ADD UNIQUE KEY `NURBANIZACION` (`NURBANIZACION`),
  ADD KEY `NCLIENTE_2` (`NCLIENTE`,`NURBANIZACION`);

--
-- Indices de la tabla `casas_servicios`
--
ALTER TABLE `casas_servicios`
  ADD PRIMARY KEY (`NID`),
  ADD UNIQUE KEY `NCASA` (`NCASA`,`NSERVICIO`),
  ADD KEY `NCASA_2` (`NCASA`,`NSERVICIO`),
  ADD KEY `NSERVICIO` (`NSERVICIO`);

--
-- Indices de la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`NID`);

--
-- Indices de la tabla `detalle_pago`
--
ALTER TABLE `detalle_pago`
  ADD PRIMARY KEY (`NID`),
  ADD UNIQUE KEY `NCLIENTE` (`NCLIENTE`,`NUSER`),
  ADD UNIQUE KEY `NSERVICIO` (`NSERVICIO`),
  ADD KEY `NCLIENTE_2` (`NCLIENTE`,`NUSER`),
  ADD KEY `NSERVICIO_2` (`NSERVICIO`),
  ADD KEY `NUSER` (`NUSER`);

--
-- Indices de la tabla `parametros_servicios`
--
ALTER TABLE `parametros_servicios`
  ADD PRIMARY KEY (`NID`);

--
-- Indices de la tabla `privilegios`
--
ALTER TABLE `privilegios`
  ADD PRIMARY KEY (`NID`);

--
-- Indices de la tabla `servicios`
--
ALTER TABLE `servicios`
  ADD PRIMARY KEY (`NID`);

--
-- Indices de la tabla `urbanizaciones`
--
ALTER TABLE `urbanizaciones`
  ADD PRIMARY KEY (`NID`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`NID`);

--
-- Indices de la tabla `usuario_privilegio`
--
ALTER TABLE `usuario_privilegio`
  ADD PRIMARY KEY (`NID`),
  ADD KEY `NUSER_2` (`NUSER`,`NPRIVILEGIO`),
  ADD KEY `NPRIVILEGIO` (`NPRIVILEGIO`) USING BTREE;

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `casas`
--
ALTER TABLE `casas`
  MODIFY `NID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `casas_servicios`
--
ALTER TABLE `casas_servicios`
  MODIFY `NID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `clientes`
--
ALTER TABLE `clientes`
  MODIFY `NID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `detalle_pago`
--
ALTER TABLE `detalle_pago`
  MODIFY `NID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `parametros_servicios`
--
ALTER TABLE `parametros_servicios`
  MODIFY `NID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `privilegios`
--
ALTER TABLE `privilegios`
  MODIFY `NID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `servicios`
--
ALTER TABLE `servicios`
  MODIFY `NID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `urbanizaciones`
--
ALTER TABLE `urbanizaciones`
  MODIFY `NID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `NID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `usuario_privilegio`
--
ALTER TABLE `usuario_privilegio`
  MODIFY `NID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `casas`
--
ALTER TABLE `casas`
  ADD CONSTRAINT `casas_ibfk_1` FOREIGN KEY (`NURBANIZACION`) REFERENCES `urbanizaciones` (`NID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `casas_ibfk_2` FOREIGN KEY (`NCLIENTE`) REFERENCES `clientes` (`NID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `casas_servicios`
--
ALTER TABLE `casas_servicios`
  ADD CONSTRAINT `casas_servicios_ibfk_1` FOREIGN KEY (`NCASA`) REFERENCES `casas` (`NID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `casas_servicios_ibfk_2` FOREIGN KEY (`NSERVICIO`) REFERENCES `servicios` (`NID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `detalle_pago`
--
ALTER TABLE `detalle_pago`
  ADD CONSTRAINT `detalle_pago_ibfk_1` FOREIGN KEY (`NUSER`) REFERENCES `usuario` (`NID`),
  ADD CONSTRAINT `detalle_pago_ibfk_2` FOREIGN KEY (`NCLIENTE`) REFERENCES `clientes` (`NID`),
  ADD CONSTRAINT `detalle_pago_ibfk_3` FOREIGN KEY (`NSERVICIO`) REFERENCES `casas_servicios` (`NID`);

--
-- Filtros para la tabla `usuario_privilegio`
--
ALTER TABLE `usuario_privilegio`
  ADD CONSTRAINT `usuario_privilegio_ibfk_1` FOREIGN KEY (`NPRIVILEGIO`) REFERENCES `privilegios` (`NID`),
  ADD CONSTRAINT `usuario_privilegio_ibfk_2` FOREIGN KEY (`NUSER`) REFERENCES `usuario` (`NID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
