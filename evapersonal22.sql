/*
 Navicat Premium Data Transfer

 Source Server         : evaluacionpersonalHAP22
 Source Server Type    : MySQL
 Source Server Version : 50051
 Source Host           : localhost:3306
 Source Schema         : evapersonal22

 Target Server Type    : MySQL
 Target Server Version : 50051
 File Encoding         : 65001

 Date: 23/04/2022 14:10:57
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for bloquecompetencia
-- ----------------------------
DROP TABLE IF EXISTS `bloquecompetencia`;
CREATE TABLE `bloquecompetencia`  (
  `idbloque` int(11) NOT NULL AUTO_INCREMENT,
  `bloquecompetencia` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `idstatus` int(255) NOT NULL,
  `fecha` date NOT NULL,
  PRIMARY KEY USING BTREE (`idbloque`)
) ENGINE = InnoDB AUTO_INCREMENT = 16 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of bloquecompetencia
-- ----------------------------
INSERT INTO `bloquecompetencia` VALUES (1, 'ACTITUD COLABORATIVA HACIA EL EQUIPO', 1, '2022-03-24');
INSERT INTO `bloquecompetencia` VALUES (2, 'ACTITUD DE LIDERAZGO Y EFICIENCIA PERSONAL', 1, '2022-03-24');
INSERT INTO `bloquecompetencia` VALUES (3, 'FORMACIÓN, DESARROLLO Y CONOCIMIENTO DEL PUESTO DE TRABAJO.', 1, '2022-03-24');
INSERT INTO `bloquecompetencia` VALUES (4, 'CALIDAD EN EL DESEMPEÑO DE SU FUNCIÓN ESPECÍFICA', 2, '2022-03-24');
INSERT INTO `bloquecompetencia` VALUES (5, 'VISIÓN DE SERVICIO HACIA EL USUARIO', 1, '2022-03-24');
INSERT INTO `bloquecompetencia` VALUES (6, 'DISCIPLINA PERSONAL', 1, '2022-03-24');
INSERT INTO `bloquecompetencia` VALUES (7, 'COMPETENCIAS TÉCNICAS', 1, '2022-03-24');
INSERT INTO `bloquecompetencia` VALUES (8, 'COMPROMISOS', 1, '2022-03-24');
INSERT INTO `bloquecompetencia` VALUES (9, 'COMPETENCIAS TÉCNICAS', 1, '2022-03-24');
INSERT INTO `bloquecompetencia` VALUES (13, 'BLOQUE DE COMPETENCIA DE PRUEBA MODOFICADA', 2, '2022-03-25');
INSERT INTO `bloquecompetencia` VALUES (14, 'BLOQUE DE COMPETENCIA DE PRUEBA1', 1, '2022-03-25');
INSERT INTO `bloquecompetencia` VALUES (15, 'BLOQUE DE COMPETENCIA DE PRUEBA1', 1, '2022-03-25');

-- ----------------------------
-- Table structure for competenciastecnicas
-- ----------------------------
DROP TABLE IF EXISTS `competenciastecnicas`;
CREATE TABLE `competenciastecnicas`  (
  `idcopentenciatecnica` int(11) NOT NULL AUTO_INCREMENT,
  `idpuesto` int(11) NOT NULL,
  `idstatus` int(11) NOT NULL DEFAULT 1,
  `competencia` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `fecha_alta` date NOT NULL,
  PRIMARY KEY USING BTREE (`idcopentenciatecnica`),
  INDEX `fk_competenciastecnicas_competenciastecnicas_puestos` USING BTREE(`idpuesto`),
  INDEX `fk_competenciastecnicas_competenciastecnicas_estatus` USING BTREE(`idstatus`),
  CONSTRAINT `fk_competenciastecnicas_competenciastecnicas_estatus` FOREIGN KEY (`idstatus`) REFERENCES `estatus` (`idstatus`) ON DELETE RESTRICT ON UPDATE CASCADE,
  CONSTRAINT `fk_competenciastecnicas_competenciastecnicas_puestos` FOREIGN KEY (`idpuesto`) REFERENCES `puestos` (`idpuesto`) ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8 COLLATE = utf8_general_ci COMMENT = 'InnoDB free: 11264 kB; (`idstatus`) REFER `evapersonal22/estatus`(`idstatus`) ON' ROW_FORMAT = Compact;

-- ----------------------------
-- Records of competenciastecnicas
-- ----------------------------
INSERT INTO `competenciastecnicas` VALUES (1, 228, 1, 'Comprender el requerimiento de software.', '2022-04-12');
INSERT INTO `competenciastecnicas` VALUES (2, 228, 1, 'Modelizar y refinar especificaciones a fin de determinar un diseño detallado para implantar la\r\nfuncionalidad requerida.', '2022-04-12');

-- ----------------------------
-- Table structure for compromisos
-- ----------------------------
DROP TABLE IF EXISTS `compromisos`;
CREATE TABLE `compromisos`  (
  `idcompromiso` int(11) NOT NULL AUTO_INCREMENT,
  `idusuario` int(11) NOT NULL,
  `compromiso` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `fechacompromiso` date NOT NULL,
  `fechaCaptura` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY USING BTREE (`idcompromiso`),
  INDEX `fk_compromisos_usuarios` USING BTREE(`idusuario`),
  CONSTRAINT `fk_compromisos_usuarios` FOREIGN KEY (`idusuario`) REFERENCES `usuarios` (`idusuario`) ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci COMMENT = 'InnoDB free: 11264 kB; (`idusuario`) REFER `evapersonal22/usuarios`(`idusuario`)' ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for cuestcompetenciatecnica
-- ----------------------------
DROP TABLE IF EXISTS `cuestcompetenciatecnica`;
CREATE TABLE `cuestcompetenciatecnica`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idpuesto` int(255) NOT NULL,
  `competenciatecnica` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `fecha` date NOT NULL,
  PRIMARY KEY USING BTREE (`id`)
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for cuestionariogeneral
-- ----------------------------
DROP TABLE IF EXISTS `cuestionariogeneral`;
CREATE TABLE `cuestionariogeneral`  (
  `idcuestionariog` int(11) NOT NULL AUTO_INCREMENT,
  `pregunta` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `idbloque` int(11) NOT NULL,
  `fechaalta` date NOT NULL,
  `idstatus` int(11) NOT NULL,
  `idtipoevaluacion` int(11) NULL DEFAULT NULL,
  PRIMARY KEY USING BTREE (`idcuestionariog`),
  INDEX `fk_cuestionariogeneral_cuestionariogeneral_estatus` USING BTREE(`idstatus`),
  INDEX `fk_cuestionariogeneral_cuestionariogeneral_1` USING BTREE(`idbloque`),
  INDEX `fk_cuestionariogeneral_tipoevaluacion` USING BTREE(`idtipoevaluacion`),
  CONSTRAINT `fk_cuestionariogeneral_cuestionariogeneral_1` FOREIGN KEY (`idbloque`) REFERENCES `bloquecompetencia` (`idbloque`) ON DELETE RESTRICT ON UPDATE CASCADE,
  CONSTRAINT `fk_cuestionariogeneral_cuestionariogeneral_estatus` FOREIGN KEY (`idstatus`) REFERENCES `estatus` (`idstatus`) ON DELETE RESTRICT ON UPDATE CASCADE,
  CONSTRAINT `fk_cuestionariogeneral_tipoevaluacion` FOREIGN KEY (`idtipoevaluacion`) REFERENCES `tipoevaluacion` (`idtipoeveluacion`) ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 7 CHARACTER SET = utf8 COLLATE = utf8_general_ci COMMENT = 'InnoDB free: 11264 kB; (`idbloque`) REFER `evapersonal22/bloquecompetencia`(`idb' ROW_FORMAT = Compact;

-- ----------------------------
-- Records of cuestionariogeneral
-- ----------------------------
INSERT INTO `cuestionariogeneral` VALUES (2, '¿ESTA SERA UNA PREGUNTA DEL CUESTIONAIO4?', 1, '2022-04-14', 1, 8);
INSERT INTO `cuestionariogeneral` VALUES (5, '¿ESTA SERA UNA PREGUNTA DEL CUESTIONAIO2?', 1, '2022-04-18', 1, 8);
INSERT INTO `cuestionariogeneral` VALUES (6, '¿ESTA SERA UNA PREGUNTA DEL CUESTIONAIO35?', 1, '2022-04-18', 1, 8);

-- ----------------------------
-- Table structure for departamento
-- ----------------------------
DROP TABLE IF EXISTS `departamento`;
CREATE TABLE `departamento`  (
  `iddepartamento` int(11) NOT NULL AUTO_INCREMENT,
  `idstatus` int(11) NOT NULL DEFAULT 1,
  `depnombre` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `fechaalta` date NOT NULL,
  PRIMARY KEY USING BTREE (`iddepartamento`),
  INDEX `fk_departamento_estatus` USING BTREE(`idstatus`),
  CONSTRAINT `fk_departamento_estatus` FOREIGN KEY (`idstatus`) REFERENCES `estatus` (`idstatus`) ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 75 CHARACTER SET = utf8 COLLATE = utf8_general_ci COMMENT = 'InnoDB free: 11264 kB; (`idstatus`) REFER `evapersonal22/estatus`(`idstatus`) ON' ROW_FORMAT = Compact;

-- ----------------------------
-- Records of departamento
-- ----------------------------
INSERT INTO `departamento` VALUES (12, 1, 'ADMISION', '2022-03-30');
INSERT INTO `departamento` VALUES (13, 1, 'ADMISION P.I.', '2022-03-30');
INSERT INTO `departamento` VALUES (14, 1, 'AMBULANCIA', '2022-03-30');
INSERT INTO `departamento` VALUES (15, 1, 'AMBULANCIA P.I.', '2022-03-30');
INSERT INTO `departamento` VALUES (16, 1, 'BIOMEDICA', '2022-03-30');
INSERT INTO `departamento` VALUES (17, 1, 'BIOMEDICA P.I.', '2022-03-30');
INSERT INTO `departamento` VALUES (18, 1, 'CAJA', '2022-03-30');
INSERT INTO `departamento` VALUES (19, 1, 'CAMILLEROS P.I.', '2022-03-30');
INSERT INTO `departamento` VALUES (20, 1, 'CARPINTERIA', '2022-03-30');
INSERT INTO `departamento` VALUES (21, 1, 'COBRANZA', '2022-03-30');
INSERT INTO `departamento` VALUES (22, 1, 'COMPRAS', '2022-03-30');
INSERT INTO `departamento` VALUES (23, 1, 'CONTABILIDAD', '2022-03-30');
INSERT INTO `departamento` VALUES (24, 1, 'COSTURA', '2022-03-30');
INSERT INTO `departamento` VALUES (25, 1, 'CUNEROS', '2022-03-30');
INSERT INTO `departamento` VALUES (26, 1, 'DIRECCION GENERAL', '2022-03-30');
INSERT INTO `departamento` VALUES (27, 1, 'DIRECCION MEDICA', '2022-03-30');
INSERT INTO `departamento` VALUES (28, 1, 'ENSENANZA E INV MEDICA', '2022-03-30');
INSERT INTO `departamento` VALUES (29, 1, 'ESTACIONAMIENTO', '2022-03-30');
INSERT INTO `departamento` VALUES (30, 1, 'FARMACIA', '2022-03-30');
INSERT INTO `departamento` VALUES (31, 1, 'FARMACIA P.I', '2022-03-30');
INSERT INTO `departamento` VALUES (32, 1, 'FARMACOVIGILANCIA', '2022-03-30');
INSERT INTO `departamento` VALUES (33, 1, 'FINANZAS', '2022-03-30');
INSERT INTO `departamento` VALUES (34, 1, 'GERENCIA COMERCIAL', '2022-03-30');
INSERT INTO `departamento` VALUES (35, 1, 'GERENCIA DE ABASTECIMIENTOS', '2022-03-30');
INSERT INTO `departamento` VALUES (36, 1, 'GERENCIA DE MEJORA CONTINUA', '2022-03-30');
INSERT INTO `departamento` VALUES (37, 1, 'GERENCIA DESARROLLO PERSONAL', '2022-03-30');
INSERT INTO `departamento` VALUES (38, 1, 'HEMODIALISIS', '2022-03-30');
INSERT INTO `departamento` VALUES (39, 1, 'HEMODIALISIS P.I.', '2022-03-30');
INSERT INTO `departamento` VALUES (40, 1, 'HEMODINAMIA', '2022-03-30');
INSERT INTO `departamento` VALUES (41, 1, 'HOTEL ADMIN', '2022-03-30');
INSERT INTO `departamento` VALUES (42, 1, 'HOTEL REST', '2022-03-30');
INSERT INTO `departamento` VALUES (43, 1, 'INHALOTERAPIA ', '2022-03-30');
INSERT INTO `departamento` VALUES (44, 1, 'INTENDENCIA', '2022-03-30');
INSERT INTO `departamento` VALUES (45, 1, 'INTENDENCIA P.I.', '2022-03-30');
INSERT INTO `departamento` VALUES (46, 1, 'JURIDICO', '2022-03-30');
INSERT INTO `departamento` VALUES (47, 1, 'LABORATORIO', '2022-03-30');
INSERT INTO `departamento` VALUES (48, 1, 'LABORATORIO  P.I.', '2022-03-30');
INSERT INTO `departamento` VALUES (49, 1, 'LAVANDERIA', '2022-03-30');
INSERT INTO `departamento` VALUES (50, 1, 'MANTENIMIENTO', '2022-03-30');
INSERT INTO `departamento` VALUES (51, 1, 'MEDICOS CHECK UP', '2022-03-30');
INSERT INTO `departamento` VALUES (52, 1, 'MEDICOS QUIROFANO', '2022-03-30');
INSERT INTO `departamento` VALUES (53, 1, 'MEDICOS TERAPIA', '2022-03-30');
INSERT INTO `departamento` VALUES (54, 1, 'MEDICOS URGENCIAS', '2022-03-30');
INSERT INTO `departamento` VALUES (55, 1, 'MEDICOS URGENCIAS P.I.', '2022-03-30');
INSERT INTO `departamento` VALUES (56, 1, 'MONITOREO Y LOGISTICA', '2022-03-30');
INSERT INTO `departamento` VALUES (57, 1, 'MONITOREO Y LOGISTICA P.I.', '2022-03-30');
INSERT INTO `departamento` VALUES (58, 1, 'NUTRICION', '2022-03-30');
INSERT INTO `departamento` VALUES (59, 1, 'NUTRICION P.I.', '2022-03-30');
INSERT INTO `departamento` VALUES (60, 1, 'ONCOLOGIA ', '2022-03-30');
INSERT INTO `departamento` VALUES (61, 1, 'PISOS', '2022-03-30');
INSERT INTO `departamento` VALUES (62, 1, 'QUIROFANO', '2022-03-30');
INSERT INTO `departamento` VALUES (63, 1, 'QUIROFANO P.I.', '2022-03-30');
INSERT INTO `departamento` VALUES (64, 1, 'RAYOS X', '2022-03-30');
INSERT INTO `departamento` VALUES (65, 1, 'RAYOS X P.I.', '2022-03-30');
INSERT INTO `departamento` VALUES (66, 1, 'REPRODUCCION', '2022-03-30');
INSERT INTO `departamento` VALUES (67, 1, 'RESTAURANTE', '2022-03-30');
INSERT INTO `departamento` VALUES (68, 1, 'ROPERIA', '2022-03-30');
INSERT INTO `departamento` VALUES (69, 1, 'SISTEMAS', '2022-03-30');
INSERT INTO `departamento` VALUES (70, 1, 'TERAPIA', '2022-03-30');
INSERT INTO `departamento` VALUES (71, 1, 'TOMOGRAFIA P.I.', '2022-03-30');
INSERT INTO `departamento` VALUES (72, 1, 'URGENCIAS', '2022-03-30');
INSERT INTO `departamento` VALUES (73, 1, 'URGENCIAS P.I', '2022-03-30');
INSERT INTO `departamento` VALUES (74, 1, 'UVEH', '2022-03-30');

-- ----------------------------
-- Table structure for deppuesto
-- ----------------------------
DROP TABLE IF EXISTS `deppuesto`;
CREATE TABLE `deppuesto`  (
  `iddeppuesto` int(11) NOT NULL AUTO_INCREMENT,
  `idpuesto` int(11) NOT NULL,
  `iddepartamento` int(11) NOT NULL,
  PRIMARY KEY USING BTREE (`iddeppuesto`),
  INDEX `idpuesto` USING BTREE(`idpuesto`),
  INDEX `iddepartamento` USING BTREE(`iddepartamento`),
  CONSTRAINT `deppuesto_ibfk_1` FOREIGN KEY (`idpuesto`) REFERENCES `puestos` (`idpuesto`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `deppuesto_ibfk_2` FOREIGN KEY (`iddepartamento`) REFERENCES `departamento` (`iddepartamento`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 244 CHARACTER SET = utf8 COLLATE = utf8_general_ci COMMENT = 'InnoDB free: 11264 kB; (`idpuesto`) REFER `evapersonal22/puestos`(`idpuesto`) ON' ROW_FORMAT = Compact;

-- ----------------------------
-- Records of deppuesto
-- ----------------------------
INSERT INTO `deppuesto` VALUES (1, 1, 12);
INSERT INTO `deppuesto` VALUES (2, 2, 12);
INSERT INTO `deppuesto` VALUES (3, 3, 12);
INSERT INTO `deppuesto` VALUES (4, 4, 12);
INSERT INTO `deppuesto` VALUES (5, 5, 12);
INSERT INTO `deppuesto` VALUES (6, 6, 12);
INSERT INTO `deppuesto` VALUES (7, 7, 12);
INSERT INTO `deppuesto` VALUES (8, 8, 12);
INSERT INTO `deppuesto` VALUES (9, 9, 12);
INSERT INTO `deppuesto` VALUES (10, 10, 13);
INSERT INTO `deppuesto` VALUES (11, 11, 13);
INSERT INTO `deppuesto` VALUES (12, 12, 13);
INSERT INTO `deppuesto` VALUES (13, 13, 14);
INSERT INTO `deppuesto` VALUES (14, 14, 15);
INSERT INTO `deppuesto` VALUES (15, 15, 16);
INSERT INTO `deppuesto` VALUES (16, 16, 16);
INSERT INTO `deppuesto` VALUES (17, 17, 16);
INSERT INTO `deppuesto` VALUES (18, 18, 17);
INSERT INTO `deppuesto` VALUES (19, 19, 18);
INSERT INTO `deppuesto` VALUES (20, 20, 18);
INSERT INTO `deppuesto` VALUES (21, 21, 18);
INSERT INTO `deppuesto` VALUES (22, 22, 18);
INSERT INTO `deppuesto` VALUES (23, 23, 18);
INSERT INTO `deppuesto` VALUES (24, 24, 19);
INSERT INTO `deppuesto` VALUES (25, 25, 20);
INSERT INTO `deppuesto` VALUES (26, 26, 20);
INSERT INTO `deppuesto` VALUES (27, 27, 20);
INSERT INTO `deppuesto` VALUES (28, 28, 21);
INSERT INTO `deppuesto` VALUES (29, 29, 21);
INSERT INTO `deppuesto` VALUES (30, 30, 21);
INSERT INTO `deppuesto` VALUES (31, 31, 21);
INSERT INTO `deppuesto` VALUES (32, 32, 21);
INSERT INTO `deppuesto` VALUES (33, 33, 21);
INSERT INTO `deppuesto` VALUES (34, 34, 22);
INSERT INTO `deppuesto` VALUES (35, 35, 22);
INSERT INTO `deppuesto` VALUES (36, 36, 22);
INSERT INTO `deppuesto` VALUES (37, 37, 23);
INSERT INTO `deppuesto` VALUES (38, 38, 23);
INSERT INTO `deppuesto` VALUES (39, 39, 23);
INSERT INTO `deppuesto` VALUES (40, 40, 23);
INSERT INTO `deppuesto` VALUES (41, 41, 23);
INSERT INTO `deppuesto` VALUES (42, 42, 23);
INSERT INTO `deppuesto` VALUES (43, 43, 24);
INSERT INTO `deppuesto` VALUES (44, 44, 25);
INSERT INTO `deppuesto` VALUES (45, 45, 25);
INSERT INTO `deppuesto` VALUES (46, 46, 25);
INSERT INTO `deppuesto` VALUES (47, 47, 25);
INSERT INTO `deppuesto` VALUES (48, 48, 26);
INSERT INTO `deppuesto` VALUES (49, 49, 26);
INSERT INTO `deppuesto` VALUES (50, 50, 26);
INSERT INTO `deppuesto` VALUES (51, 51, 27);
INSERT INTO `deppuesto` VALUES (52, 52, 27);
INSERT INTO `deppuesto` VALUES (53, 53, 27);
INSERT INTO `deppuesto` VALUES (54, 54, 28);
INSERT INTO `deppuesto` VALUES (55, 55, 29);
INSERT INTO `deppuesto` VALUES (56, 56, 29);
INSERT INTO `deppuesto` VALUES (57, 57, 29);
INSERT INTO `deppuesto` VALUES (58, 58, 29);
INSERT INTO `deppuesto` VALUES (59, 59, 30);
INSERT INTO `deppuesto` VALUES (60, 60, 30);
INSERT INTO `deppuesto` VALUES (61, 61, 30);
INSERT INTO `deppuesto` VALUES (62, 62, 30);
INSERT INTO `deppuesto` VALUES (63, 63, 30);
INSERT INTO `deppuesto` VALUES (64, 64, 30);
INSERT INTO `deppuesto` VALUES (65, 65, 30);
INSERT INTO `deppuesto` VALUES (66, 66, 30);
INSERT INTO `deppuesto` VALUES (67, 67, 30);
INSERT INTO `deppuesto` VALUES (68, 68, 30);
INSERT INTO `deppuesto` VALUES (69, 69, 30);
INSERT INTO `deppuesto` VALUES (70, 70, 31);
INSERT INTO `deppuesto` VALUES (71, 71, 31);
INSERT INTO `deppuesto` VALUES (72, 72, 31);
INSERT INTO `deppuesto` VALUES (73, 73, 32);
INSERT INTO `deppuesto` VALUES (74, 74, 32);
INSERT INTO `deppuesto` VALUES (75, 75, 33);
INSERT INTO `deppuesto` VALUES (76, 76, 34);
INSERT INTO `deppuesto` VALUES (77, 77, 34);
INSERT INTO `deppuesto` VALUES (78, 78, 34);
INSERT INTO `deppuesto` VALUES (79, 79, 34);
INSERT INTO `deppuesto` VALUES (80, 80, 34);
INSERT INTO `deppuesto` VALUES (81, 81, 34);
INSERT INTO `deppuesto` VALUES (82, 82, 34);
INSERT INTO `deppuesto` VALUES (83, 83, 34);
INSERT INTO `deppuesto` VALUES (84, 84, 34);
INSERT INTO `deppuesto` VALUES (85, 85, 34);
INSERT INTO `deppuesto` VALUES (86, 86, 34);
INSERT INTO `deppuesto` VALUES (87, 87, 35);
INSERT INTO `deppuesto` VALUES (88, 88, 35);
INSERT INTO `deppuesto` VALUES (89, 89, 35);
INSERT INTO `deppuesto` VALUES (90, 90, 35);
INSERT INTO `deppuesto` VALUES (91, 91, 35);
INSERT INTO `deppuesto` VALUES (92, 92, 36);
INSERT INTO `deppuesto` VALUES (93, 93, 36);
INSERT INTO `deppuesto` VALUES (94, 94, 36);
INSERT INTO `deppuesto` VALUES (95, 95, 36);
INSERT INTO `deppuesto` VALUES (96, 96, 36);
INSERT INTO `deppuesto` VALUES (97, 97, 37);
INSERT INTO `deppuesto` VALUES (98, 98, 37);
INSERT INTO `deppuesto` VALUES (99, 99, 37);
INSERT INTO `deppuesto` VALUES (100, 100, 37);
INSERT INTO `deppuesto` VALUES (101, 101, 37);
INSERT INTO `deppuesto` VALUES (102, 102, 37);
INSERT INTO `deppuesto` VALUES (103, 103, 37);
INSERT INTO `deppuesto` VALUES (104, 104, 37);
INSERT INTO `deppuesto` VALUES (105, 105, 38);
INSERT INTO `deppuesto` VALUES (106, 106, 38);
INSERT INTO `deppuesto` VALUES (107, 107, 38);
INSERT INTO `deppuesto` VALUES (108, 108, 38);
INSERT INTO `deppuesto` VALUES (109, 109, 39);
INSERT INTO `deppuesto` VALUES (110, 110, 39);
INSERT INTO `deppuesto` VALUES (111, 111, 39);
INSERT INTO `deppuesto` VALUES (112, 112, 40);
INSERT INTO `deppuesto` VALUES (113, 113, 40);
INSERT INTO `deppuesto` VALUES (114, 114, 41);
INSERT INTO `deppuesto` VALUES (115, 115, 41);
INSERT INTO `deppuesto` VALUES (116, 116, 42);
INSERT INTO `deppuesto` VALUES (117, 117, 43);
INSERT INTO `deppuesto` VALUES (118, 118, 44);
INSERT INTO `deppuesto` VALUES (119, 119, 44);
INSERT INTO `deppuesto` VALUES (120, 120, 44);
INSERT INTO `deppuesto` VALUES (121, 121, 44);
INSERT INTO `deppuesto` VALUES (122, 122, 44);
INSERT INTO `deppuesto` VALUES (123, 123, 44);
INSERT INTO `deppuesto` VALUES (124, 124, 44);
INSERT INTO `deppuesto` VALUES (125, 125, 44);
INSERT INTO `deppuesto` VALUES (126, 126, 44);
INSERT INTO `deppuesto` VALUES (127, 127, 44);
INSERT INTO `deppuesto` VALUES (128, 128, 44);
INSERT INTO `deppuesto` VALUES (129, 129, 44);
INSERT INTO `deppuesto` VALUES (130, 130, 44);
INSERT INTO `deppuesto` VALUES (131, 131, 44);
INSERT INTO `deppuesto` VALUES (132, 132, 44);
INSERT INTO `deppuesto` VALUES (133, 133, 44);
INSERT INTO `deppuesto` VALUES (134, 134, 44);
INSERT INTO `deppuesto` VALUES (135, 135, 44);
INSERT INTO `deppuesto` VALUES (136, 136, 44);
INSERT INTO `deppuesto` VALUES (137, 137, 45);
INSERT INTO `deppuesto` VALUES (138, 138, 46);
INSERT INTO `deppuesto` VALUES (139, 139, 47);
INSERT INTO `deppuesto` VALUES (140, 140, 47);
INSERT INTO `deppuesto` VALUES (141, 141, 47);
INSERT INTO `deppuesto` VALUES (142, 142, 47);
INSERT INTO `deppuesto` VALUES (143, 143, 47);
INSERT INTO `deppuesto` VALUES (144, 144, 47);
INSERT INTO `deppuesto` VALUES (145, 145, 47);
INSERT INTO `deppuesto` VALUES (146, 146, 47);
INSERT INTO `deppuesto` VALUES (147, 147, 47);
INSERT INTO `deppuesto` VALUES (148, 148, 47);
INSERT INTO `deppuesto` VALUES (149, 149, 47);
INSERT INTO `deppuesto` VALUES (150, 150, 47);
INSERT INTO `deppuesto` VALUES (151, 151, 49);
INSERT INTO `deppuesto` VALUES (152, 152, 49);
INSERT INTO `deppuesto` VALUES (153, 153, 50);
INSERT INTO `deppuesto` VALUES (154, 154, 50);
INSERT INTO `deppuesto` VALUES (155, 155, 50);
INSERT INTO `deppuesto` VALUES (156, 156, 50);
INSERT INTO `deppuesto` VALUES (157, 157, 50);
INSERT INTO `deppuesto` VALUES (158, 158, 51);
INSERT INTO `deppuesto` VALUES (159, 159, 52);
INSERT INTO `deppuesto` VALUES (160, 160, 53);
INSERT INTO `deppuesto` VALUES (161, 161, 53);
INSERT INTO `deppuesto` VALUES (162, 162, 54);
INSERT INTO `deppuesto` VALUES (163, 163, 54);
INSERT INTO `deppuesto` VALUES (164, 164, 54);
INSERT INTO `deppuesto` VALUES (165, 165, 54);
INSERT INTO `deppuesto` VALUES (166, 166, 54);
INSERT INTO `deppuesto` VALUES (167, 167, 55);
INSERT INTO `deppuesto` VALUES (168, 168, 55);
INSERT INTO `deppuesto` VALUES (169, 169, 56);
INSERT INTO `deppuesto` VALUES (170, 170, 56);
INSERT INTO `deppuesto` VALUES (171, 171, 56);
INSERT INTO `deppuesto` VALUES (172, 172, 56);
INSERT INTO `deppuesto` VALUES (173, 173, 57);
INSERT INTO `deppuesto` VALUES (174, 174, 58);
INSERT INTO `deppuesto` VALUES (175, 175, 58);
INSERT INTO `deppuesto` VALUES (176, 176, 58);
INSERT INTO `deppuesto` VALUES (177, 177, 58);
INSERT INTO `deppuesto` VALUES (178, 178, 58);
INSERT INTO `deppuesto` VALUES (179, 179, 58);
INSERT INTO `deppuesto` VALUES (180, 180, 58);
INSERT INTO `deppuesto` VALUES (181, 181, 59);
INSERT INTO `deppuesto` VALUES (182, 182, 59);
INSERT INTO `deppuesto` VALUES (183, 183, 60);
INSERT INTO `deppuesto` VALUES (184, 184, 60);
INSERT INTO `deppuesto` VALUES (185, 185, 60);
INSERT INTO `deppuesto` VALUES (186, 186, 60);
INSERT INTO `deppuesto` VALUES (187, 187, 60);
INSERT INTO `deppuesto` VALUES (188, 188, 60);
INSERT INTO `deppuesto` VALUES (189, 189, 60);
INSERT INTO `deppuesto` VALUES (190, 190, 60);
INSERT INTO `deppuesto` VALUES (191, 191, 61);
INSERT INTO `deppuesto` VALUES (192, 192, 61);
INSERT INTO `deppuesto` VALUES (193, 193, 61);
INSERT INTO `deppuesto` VALUES (194, 194, 61);
INSERT INTO `deppuesto` VALUES (195, 195, 61);
INSERT INTO `deppuesto` VALUES (196, 196, 61);
INSERT INTO `deppuesto` VALUES (197, 197, 61);
INSERT INTO `deppuesto` VALUES (198, 198, 61);
INSERT INTO `deppuesto` VALUES (199, 199, 61);
INSERT INTO `deppuesto` VALUES (200, 200, 62);
INSERT INTO `deppuesto` VALUES (201, 201, 62);
INSERT INTO `deppuesto` VALUES (202, 202, 62);
INSERT INTO `deppuesto` VALUES (203, 203, 62);
INSERT INTO `deppuesto` VALUES (204, 204, 62);
INSERT INTO `deppuesto` VALUES (205, 205, 62);
INSERT INTO `deppuesto` VALUES (206, 206, 62);
INSERT INTO `deppuesto` VALUES (207, 207, 63);
INSERT INTO `deppuesto` VALUES (208, 208, 63);
INSERT INTO `deppuesto` VALUES (209, 209, 63);
INSERT INTO `deppuesto` VALUES (210, 210, 63);
INSERT INTO `deppuesto` VALUES (211, 211, 64);
INSERT INTO `deppuesto` VALUES (212, 212, 64);
INSERT INTO `deppuesto` VALUES (213, 213, 64);
INSERT INTO `deppuesto` VALUES (214, 214, 65);
INSERT INTO `deppuesto` VALUES (215, 215, 66);
INSERT INTO `deppuesto` VALUES (216, 216, 67);
INSERT INTO `deppuesto` VALUES (217, 217, 67);
INSERT INTO `deppuesto` VALUES (218, 218, 67);
INSERT INTO `deppuesto` VALUES (219, 219, 67);
INSERT INTO `deppuesto` VALUES (220, 220, 67);
INSERT INTO `deppuesto` VALUES (221, 221, 68);
INSERT INTO `deppuesto` VALUES (222, 222, 68);
INSERT INTO `deppuesto` VALUES (223, 223, 69);
INSERT INTO `deppuesto` VALUES (224, 224, 69);
INSERT INTO `deppuesto` VALUES (225, 225, 69);
INSERT INTO `deppuesto` VALUES (226, 226, 69);
INSERT INTO `deppuesto` VALUES (227, 227, 69);
INSERT INTO `deppuesto` VALUES (228, 228, 69);
INSERT INTO `deppuesto` VALUES (229, 229, 69);
INSERT INTO `deppuesto` VALUES (231, 231, 70);
INSERT INTO `deppuesto` VALUES (232, 232, 70);
INSERT INTO `deppuesto` VALUES (233, 233, 70);
INSERT INTO `deppuesto` VALUES (234, 234, 70);
INSERT INTO `deppuesto` VALUES (235, 235, 70);
INSERT INTO `deppuesto` VALUES (236, 236, 70);
INSERT INTO `deppuesto` VALUES (237, 237, 70);
INSERT INTO `deppuesto` VALUES (238, 238, 71);
INSERT INTO `deppuesto` VALUES (239, 239, 72);
INSERT INTO `deppuesto` VALUES (240, 240, 73);
INSERT INTO `deppuesto` VALUES (241, 241, 73);
INSERT INTO `deppuesto` VALUES (242, 242, 74);
INSERT INTO `deppuesto` VALUES (243, 243, 74);

-- ----------------------------
-- Table structure for estatus
-- ----------------------------
DROP TABLE IF EXISTS `estatus`;
CREATE TABLE `estatus`  (
  `idstatus` int(11) NOT NULL AUTO_INCREMENT,
  `status` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  PRIMARY KEY USING BTREE (`idstatus`)
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of estatus
-- ----------------------------
INSERT INTO `estatus` VALUES (1, 'ACTIVO');
INSERT INTO `estatus` VALUES (2, 'INACTIVO');

-- ----------------------------
-- Table structure for eva360
-- ----------------------------
DROP TABLE IF EXISTS `eva360`;
CREATE TABLE `eva360`  (
  `ideva` int(11) NOT NULL AUTO_INCREMENT,
  `idevaluacion` int(11) NOT NULL,
  `idpersonal360` int(11) NOT NULL,
  PRIMARY KEY USING BTREE (`ideva`),
  INDEX `fk_eva360_eva360_evaluacionusario` USING BTREE(`idevaluacion`),
  INDEX `fk_eva360_personal360` USING BTREE(`idpersonal360`),
  CONSTRAINT `fk_eva360_eva360_evaluacionusario` FOREIGN KEY (`idevaluacion`) REFERENCES `evaluacionusario` (`idevaluacion`) ON DELETE RESTRICT ON UPDATE CASCADE,
  CONSTRAINT `fk_eva360_personal360` FOREIGN KEY (`idpersonal360`) REFERENCES `personal360` (`idpersonal360`) ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci COMMENT = 'InnoDB free: 11264 kB; (`idevaluacion`) REFER `evapersonal22/evaluacionusario`(`' ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for evaluacioncompentencias
-- ----------------------------
DROP TABLE IF EXISTS `evaluacioncompentencias`;
CREATE TABLE `evaluacioncompentencias`  (
  `idevaluacion` int(11) NOT NULL AUTO_INCREMENT,
  `idusuario` int(255) NOT NULL,
  `idpregunta` int(255) NOT NULL,
  `puntuacion` int(11) NULL DEFAULT NULL,
  `totalpuntos` float NULL DEFAULT NULL,
  `periodo` smallint(1) NULL DEFAULT NULL,
  `idstatus` int(11) NULL DEFAULT NULL,
  `idempleadoautoriza` int(255) NULL DEFAULT NULL,
  `fecharesolucion` date NOT NULL,
  PRIMARY KEY USING BTREE (`idevaluacion`)
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for evaluacionusario
-- ----------------------------
DROP TABLE IF EXISTS `evaluacionusario`;
CREATE TABLE `evaluacionusario`  (
  `idevaluacion` int(11) NOT NULL AUTO_INCREMENT,
  `idusuario` int(255) NOT NULL,
  `idpregunta` int(255) NOT NULL,
  `idponderacion` int(11) NULL DEFAULT NULL,
  `totalpuntos` float NULL DEFAULT NULL,
  `periodo` smallint(1) NULL DEFAULT NULL,
  `idstatus` int(11) NULL DEFAULT NULL,
  `fecharesolucion` date NOT NULL,
  PRIMARY KEY USING BTREE (`idevaluacion`),
  INDEX `fk_evaluacionusario_evaluacionusario_usuarios` USING BTREE(`idusuario`),
  INDEX `fk_evaluacionusario_evaluacionusario_cuestionariogeneral` USING BTREE(`idpregunta`),
  INDEX `fk_evaluacionusario_evaluacionusario_ponderacion` USING BTREE(`idponderacion`),
  CONSTRAINT `fk_evaluacionusario_evaluacionusario_cuestionariogeneral` FOREIGN KEY (`idpregunta`) REFERENCES `cuestionariogeneral` (`idcuestionariog`) ON DELETE RESTRICT ON UPDATE CASCADE,
  CONSTRAINT `fk_evaluacionusario_evaluacionusario_ponderacion` FOREIGN KEY (`idponderacion`) REFERENCES `ponderacion` (`idponderacion`) ON DELETE RESTRICT ON UPDATE CASCADE,
  CONSTRAINT `fk_evaluacionusario_evaluacionusario_usuarios` FOREIGN KEY (`idusuario`) REFERENCES `usuarios` (`idusuario`) ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci COMMENT = 'InnoDB free: 11264 kB; (`idpregunta`) REFER `evapersonal22/cuestionariogeneral`(' ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for jerarquia
-- ----------------------------
DROP TABLE IF EXISTS `jerarquia`;
CREATE TABLE `jerarquia`  (
  `idjerarquia` int(11) NOT NULL AUTO_INCREMENT,
  `idstatus` int(11) NOT NULL DEFAULT 1,
  `nombre` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  PRIMARY KEY USING BTREE (`idjerarquia`),
  INDEX `fk_jerarquia_estatus` USING BTREE(`idstatus`),
  CONSTRAINT `fk_jerarquia_estatus` FOREIGN KEY (`idstatus`) REFERENCES `estatus` (`idstatus`) ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 7 CHARACTER SET = utf8 COLLATE = utf8_general_ci COMMENT = 'InnoDB free: 11264 kB; (`idstatus`) REFER `evapersonal22/estatus`(`idstatus`) ON' ROW_FORMAT = Compact;

-- ----------------------------
-- Records of jerarquia
-- ----------------------------
INSERT INTO `jerarquia` VALUES (1, 1, 'DIRECTOR');
INSERT INTO `jerarquia` VALUES (2, 1, 'GERENTE');
INSERT INTO `jerarquia` VALUES (3, 1, 'JEFE');
INSERT INTO `jerarquia` VALUES (4, 1, 'COORDINADOR');
INSERT INTO `jerarquia` VALUES (5, 1, 'SUPERVISOR');
INSERT INTO `jerarquia` VALUES (6, 1, 'COLABORADOR');

-- ----------------------------
-- Table structure for personal360
-- ----------------------------
DROP TABLE IF EXISTS `personal360`;
CREATE TABLE `personal360`  (
  `idpersonal360` int(11) NOT NULL AUTO_INCREMENT,
  `idevaluador` int(11) NOT NULL,
  `idevaluado` int(11) NOT NULL,
  PRIMARY KEY USING BTREE (`idpersonal360`),
  INDEX `fk_personal360_usuarios` USING BTREE(`idevaluador`),
  INDEX `fk_personal360_usuariosevaluado` USING BTREE(`idevaluado`),
  CONSTRAINT `fk_personal360_usuarios` FOREIGN KEY (`idevaluador`) REFERENCES `usuarios` (`idusuario`) ON DELETE RESTRICT ON UPDATE CASCADE,
  CONSTRAINT `fk_personal360_usuariosevaluado` FOREIGN KEY (`idevaluado`) REFERENCES `usuarios` (`idusuario`) ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci COMMENT = 'InnoDB free: 11264 kB; (`idevaluador`) REFER `evapersonal22/usuarios`(`idusuario' ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for ponderacion
-- ----------------------------
DROP TABLE IF EXISTS `ponderacion`;
CREATE TABLE `ponderacion`  (
  `idponderacion` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `puntos` int(10) NOT NULL,
  PRIMARY KEY USING BTREE (`idponderacion`)
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of ponderacion
-- ----------------------------
INSERT INTO `ponderacion` VALUES (1, 'No lo tiene, no es identificable', 1);
INSERT INTO `ponderacion` VALUES (2, 'Lo tiene en nivel bajo o no sensible', 2);
INSERT INTO `ponderacion` VALUES (3, 'Lo tiene y lo usa adecuadamente', 3);
INSERT INTO `ponderacion` VALUES (4, 'Es excelente, se percibe en su trabajo', 4);

-- ----------------------------
-- Table structure for puestos
-- ----------------------------
DROP TABLE IF EXISTS `puestos`;
CREATE TABLE `puestos`  (
  `idpuesto` int(11) NOT NULL AUTO_INCREMENT,
  `idstatus` int(11) NOT NULL DEFAULT 1,
  `nombrepuesto` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `descripcion` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `fechaalta` date NOT NULL,
  PRIMARY KEY USING BTREE (`idpuesto`),
  INDEX `fk_puestos_estatus` USING BTREE(`idstatus`),
  CONSTRAINT `fk_puestos_estatus` FOREIGN KEY (`idstatus`) REFERENCES `estatus` (`idstatus`) ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 245 CHARACTER SET = utf8 COLLATE = utf8_general_ci COMMENT = 'InnoDB free: 11264 kB; (`idstatus`) REFER `evapersonal22/estatus`(`idstatus`) ON' ROW_FORMAT = Compact;

-- ----------------------------
-- Records of puestos
-- ----------------------------
INSERT INTO `puestos` VALUES (1, 1, 'CONMUTADOR', NULL, '2022-03-30');
INSERT INTO `puestos` VALUES (2, 1, 'COORDINADOR DE ADMISION URGENCIAS', NULL, '2022-03-30');
INSERT INTO `puestos` VALUES (3, 1, 'INFORMACION HAP', NULL, '2022-03-30');
INSERT INTO `puestos` VALUES (4, 1, 'COORDINADOR DE ADMISION', NULL, '2022-03-30');
INSERT INTO `puestos` VALUES (5, 1, 'EJECUTIVO DE ADMISION URGENCIAS', NULL, '2022-03-30');
INSERT INTO `puestos` VALUES (6, 1, 'JEFE DE ADMISION', NULL, '2022-03-30');
INSERT INTO `puestos` VALUES (7, 1, 'AUXILIAR DE ADMISION', NULL, '2022-03-30');
INSERT INTO `puestos` VALUES (8, 1, 'EJECUTIVO DE ADMISION', NULL, '2022-03-30');
INSERT INTO `puestos` VALUES (9, 1, 'ARCHIVISTA CLINICO', NULL, '2022-03-30');
INSERT INTO `puestos` VALUES (10, 1, 'EJECUTIVO DE ADMISION', NULL, '2022-03-30');
INSERT INTO `puestos` VALUES (11, 1, 'EJECUTIVO DE ADMISION BILINGUE', NULL, '2022-03-30');
INSERT INTO `puestos` VALUES (12, 1, 'EJECUTIVO DE ADMISION DE HEMODIALISIS', NULL, '2022-03-30');
INSERT INTO `puestos` VALUES (13, 1, 'PARAMEDICO', NULL, '2022-03-30');
INSERT INTO `puestos` VALUES (14, 1, 'PARAMEDICO P.I.', NULL, '2022-03-30');
INSERT INTO `puestos` VALUES (15, 1, 'INGENIERO BIOMEDICO', NULL, '2022-03-30');
INSERT INTO `puestos` VALUES (16, 1, 'JEFE DE BIOMEDICA', NULL, '2022-03-30');
INSERT INTO `puestos` VALUES (17, 1, 'INGENIERO BIOMEDICO', NULL, '2022-03-30');
INSERT INTO `puestos` VALUES (18, 1, 'COORDINADOR DE BIOMEDICA', NULL, '2022-03-30');
INSERT INTO `puestos` VALUES (19, 1, 'COORDINADOR DE CAJA', NULL, '2022-03-30');
INSERT INTO `puestos` VALUES (20, 1, 'CAJERA DE ESTACIONAMIENTO', NULL, '2022-03-30');
INSERT INTO `puestos` VALUES (21, 1, 'CAJERA DE HONORARIOS', NULL, '2022-03-30');
INSERT INTO `puestos` VALUES (22, 1, 'CAJERA GENERAL', NULL, '2022-03-30');
INSERT INTO `puestos` VALUES (23, 1, 'CAJERA DE LABORATORIO', NULL, '2022-03-30');
INSERT INTO `puestos` VALUES (24, 1, 'CAMILLERO P.I.', NULL, '2022-03-30');
INSERT INTO `puestos` VALUES (25, 1, 'BARNIZADOR', NULL, '2022-03-30');
INSERT INTO `puestos` VALUES (26, 1, 'SUPERVISOR DE CARPINTERIA', NULL, '2022-03-30');
INSERT INTO `puestos` VALUES (27, 1, 'CARPINTERO', NULL, '2022-03-30');
INSERT INTO `puestos` VALUES (28, 1, 'EJECUTIVO DE CUENTAS POR COBRAR', NULL, '2022-03-30');
INSERT INTO `puestos` VALUES (29, 1, 'JEFE DE COBRANZA', NULL, '2022-03-30');
INSERT INTO `puestos` VALUES (30, 1, 'ANALISTA DE FACTURACION', NULL, '2022-03-30');
INSERT INTO `puestos` VALUES (31, 1, 'EJECUTIVO DE CUENTAS POR COBRAR', NULL, '2022-03-30');
INSERT INTO `puestos` VALUES (32, 1, 'TESORERA', NULL, '2022-03-30');
INSERT INTO `puestos` VALUES (33, 1, 'EJECUTIVO DE HONORARIOS', NULL, '2022-03-30');
INSERT INTO `puestos` VALUES (34, 1, 'COORDINADOR DE COMPRAS', NULL, '2022-03-30');
INSERT INTO `puestos` VALUES (35, 1, 'AUXILIAR DE COMPRAS', NULL, '2022-03-30');
INSERT INTO `puestos` VALUES (36, 1, 'AUXILIAR ADMINISTRATIVO DE COMPRAS', NULL, '2022-03-30');
INSERT INTO `puestos` VALUES (37, 1, 'EJECUTIVA DE COSTOS', NULL, '2022-03-30');
INSERT INTO `puestos` VALUES (38, 1, 'JEFE DE CONTABILIDAD', NULL, '2022-03-30');
INSERT INTO `puestos` VALUES (39, 1, 'AUDITOR DE ALMACENES Y ACTIVO FIJO', NULL, '2022-03-30');
INSERT INTO `puestos` VALUES (40, 1, 'COORDINADOR DE IMPUESTOS', NULL, '2022-03-30');
INSERT INTO `puestos` VALUES (41, 1, 'EJECUTIVA DE CUENTAS POR PAGAR', NULL, '2022-03-30');
INSERT INTO `puestos` VALUES (42, 1, 'ANALISTA DE COMPRAS Y GASTOS', NULL, '2022-03-30');
INSERT INTO `puestos` VALUES (43, 1, 'COSTURERA', NULL, '2022-03-30');
INSERT INTO `puestos` VALUES (44, 1, 'ENFERMERA CLINICA ESPECIALIZADA DE CUNEROS', NULL, '2022-03-30');
INSERT INTO `puestos` VALUES (45, 1, 'ENFERMERA CLINICA ESPECIALIZADA DE UCIN', NULL, '2022-03-30');
INSERT INTO `puestos` VALUES (46, 1, 'ENFERMERA CLINICA DE CUNEROS', NULL, '2022-03-30');
INSERT INTO `puestos` VALUES (47, 1, 'ENFERMERA CLINICA DE UCIN', NULL, '2022-03-30');
INSERT INTO `puestos` VALUES (48, 1, 'JEFE ADMINISTRATIVO DE HOTEL', NULL, '2022-03-30');
INSERT INTO `puestos` VALUES (49, 1, 'JEFA DE COMUNICACION INSTITUCIONAL E IMAGEN', NULL, '2022-03-30');
INSERT INTO `puestos` VALUES (50, 1, 'ASISTENTE DE DIRECCION GENERAL', NULL, '2022-03-30');
INSERT INTO `puestos` VALUES (51, 1, 'DIRECTOR MEDICO', NULL, '2022-03-30');
INSERT INTO `puestos` VALUES (52, 1, 'EJECUTIVO DE BIOESTADISTICA', NULL, '2022-03-30');
INSERT INTO `puestos` VALUES (53, 1, 'GERENTE MEDICO', NULL, '2022-03-30');
INSERT INTO `puestos` VALUES (54, 1, 'ASISTENTE DE DIRECCION MEDICA', NULL, '2022-03-30');
INSERT INTO `puestos` VALUES (55, 1, 'CHOFER DE RESIDUOS SOLIDOS', NULL, '2022-03-30');
INSERT INTO `puestos` VALUES (56, 1, 'CHOFER', NULL, '2022-03-30');
INSERT INTO `puestos` VALUES (57, 1, 'ACOMODADOR', NULL, '2022-03-30');
INSERT INTO `puestos` VALUES (58, 1, 'ACOMODADOR', NULL, '2022-03-30');
INSERT INTO `puestos` VALUES (59, 1, 'SUPERVISOR DE FARMACIA', NULL, '2022-03-30');
INSERT INTO `puestos` VALUES (60, 1, 'AUXILIAR DE SUB ALMACEN', NULL, '2022-03-30');
INSERT INTO `puestos` VALUES (61, 1, 'AUXILIAR ADMINISTRATIVO DE FARMACIA', NULL, '2022-03-30');
INSERT INTO `puestos` VALUES (62, 1, 'EMPLEADA DE MOSTRADOR FARMACIA', NULL, '2022-03-30');
INSERT INTO `puestos` VALUES (63, 1, 'SUPERVISOR DE FARMACIA', NULL, '2022-03-30');
INSERT INTO `puestos` VALUES (64, 1, 'JEFE DE FARMACIA', NULL, '2022-03-30');
INSERT INTO `puestos` VALUES (65, 1, 'SUPERVISOR DE FARMACIA', NULL, '2022-03-30');
INSERT INTO `puestos` VALUES (66, 1, 'COORDINADOR DE FARMACIA', NULL, '2022-03-30');
INSERT INTO `puestos` VALUES (67, 1, 'EMPLEADA DE MOSTRADOR FARMACIA', NULL, '2022-03-30');
INSERT INTO `puestos` VALUES (68, 1, 'MENSAJERA DE PISOS', NULL, '2022-03-30');
INSERT INTO `puestos` VALUES (69, 1, 'EMPLEADA DE MOSTRADOR FARMACIA', NULL, '2022-03-30');
INSERT INTO `puestos` VALUES (70, 1, 'AUXILIAR DE FARMACIA GENERAL', NULL, '2022-03-30');
INSERT INTO `puestos` VALUES (71, 1, 'ALMACENISTA GENERAL', NULL, '2022-03-30');
INSERT INTO `puestos` VALUES (72, 1, 'AUXILIAR DE FARMACIA GENERAL', NULL, '2022-03-30');
INSERT INTO `puestos` VALUES (73, 1, 'JEFE DE FARMACOVIGILANCIA', NULL, '2022-03-30');
INSERT INTO `puestos` VALUES (74, 1, 'QUIMICO DE FARMACOVIGILANCIA', NULL, '2022-03-30');
INSERT INTO `puestos` VALUES (75, 1, 'GERENTE DE FINANZA', NULL, '2022-03-30');
INSERT INTO `puestos` VALUES (76, 1, 'ASESOR COMERCIAL', NULL, '2022-03-30');
INSERT INTO `puestos` VALUES (77, 1, 'JEFE COMERCIAL', NULL, '2022-03-30');
INSERT INTO `puestos` VALUES (78, 1, 'AUXILIAR DE PAQUETES DE MATERNIDAD', NULL, '2022-03-30');
INSERT INTO `puestos` VALUES (79, 1, 'ASESOR COMERCIAL DE CONVENIOS', NULL, '2022-03-30');
INSERT INTO `puestos` VALUES (80, 1, 'PUBLICISTA', NULL, '2022-03-30');
INSERT INTO `puestos` VALUES (81, 1, 'ASESOR COMERCIAL DE CONVENIOS', NULL, '2022-03-30');
INSERT INTO `puestos` VALUES (82, 1, 'EJECUTIVO DE VENTAS ATENCION POLIFORUM', NULL, '2022-03-30');
INSERT INTO `puestos` VALUES (83, 1, 'COORDINADOR DE PUBLICIDAD Y MEDIOS', NULL, '2022-03-30');
INSERT INTO `puestos` VALUES (84, 1, 'ASESOR COMERCIAL DE CHECK UP', NULL, '2022-03-30');
INSERT INTO `puestos` VALUES (85, 1, 'AUXILIAR DE CHECK UP', NULL, '2022-03-30');
INSERT INTO `puestos` VALUES (86, 1, 'MEDICO DE POLIFORUM', NULL, '2022-03-30');
INSERT INTO `puestos` VALUES (87, 1, 'JEFE DE ABASTECIMIENTOS', NULL, '2022-03-30');
INSERT INTO `puestos` VALUES (88, 1, 'ALMACENISTA DE VIVERES', NULL, '2022-03-30');
INSERT INTO `puestos` VALUES (89, 1, 'ALMACENISTA GENERAL', NULL, '2022-03-30');
INSERT INTO `puestos` VALUES (90, 1, 'ALMACENISTA DE LABORATORIO', NULL, '2022-03-30');
INSERT INTO `puestos` VALUES (91, 1, 'FARMACEUTICO', NULL, '2022-03-30');
INSERT INTO `puestos` VALUES (92, 1, 'GERENTE DE MEJORA CONTINUA', NULL, '2022-03-30');
INSERT INTO `puestos` VALUES (93, 1, 'JEFE DE INTENDENCIA Y ROPA HOSPITALARIA', NULL, '2022-03-30');
INSERT INTO `puestos` VALUES (94, 1, 'COORDINADOR DE SERVICIO AL CLIENTE', NULL, '2022-03-30');
INSERT INTO `puestos` VALUES (95, 1, 'COORDINADOR DE CALIDAD', NULL, '2022-03-30');
INSERT INTO `puestos` VALUES (96, 1, 'AUXILIAR DE CALIDAD', NULL, '2022-03-30');
INSERT INTO `puestos` VALUES (97, 1, 'COORDINADOR DE CAPACITACION Y SEGURIDAD LABORAL', NULL, '2022-03-30');
INSERT INTO `puestos` VALUES (98, 1, 'GERENTE DE DESARROLLO DE PERSONAL', NULL, '2022-03-30');
INSERT INTO `puestos` VALUES (99, 1, 'COORDINADOR DE NOMINAS Y PRESTACIONES', NULL, '2022-03-30');
INSERT INTO `puestos` VALUES (100, 1, 'COORDINADOR DE RECLUTAMIENTO Y SELECCION', NULL, '2022-03-30');
INSERT INTO `puestos` VALUES (101, 1, 'AUXILIAR DE NOMINA', NULL, '2022-03-30');
INSERT INTO `puestos` VALUES (102, 1, 'AUXILIAR DE CAPACITACION Y DO', NULL, '2022-03-30');
INSERT INTO `puestos` VALUES (103, 1, 'AUXILIAR DE RECLUTAMIENTO Y SELECCION', NULL, '2022-03-30');
INSERT INTO `puestos` VALUES (104, 1, 'ENFERMERA CLINICA ESPECIALIZADA DE HEMODIALISIS', NULL, '2022-03-30');
INSERT INTO `puestos` VALUES (105, 1, 'ASISTENTE ADMVO DE HEMODIALISIS', NULL, '2022-03-30');
INSERT INTO `puestos` VALUES (106, 1, 'EJECUTIVO DE ADMISION DE HEMODIALISIS', NULL, '2022-03-30');
INSERT INTO `puestos` VALUES (107, 1, 'ENFERMERA CLINICA', NULL, '2022-03-30');
INSERT INTO `puestos` VALUES (108, 1, 'ENFERMERA CLINICA ESPECIALIZADA DE HEMODIALISIS', NULL, '2022-03-30');
INSERT INTO `puestos` VALUES (109, 1, 'ENFERMERA CLINICA', NULL, '2022-03-30');
INSERT INTO `puestos` VALUES (110, 1, 'AUXILIAR DE FARMACIA HEMODIALISIS', NULL, '2022-03-30');
INSERT INTO `puestos` VALUES (111, 1, 'TECNICO RADIOLOGO DE HEMODINAMIA', NULL, '2022-03-30');
INSERT INTO `puestos` VALUES (112, 1, 'ASISTENTE ADMINISTRATIVO DE HEMODINAMIA', NULL, '2022-03-30');
INSERT INTO `puestos` VALUES (113, 1, 'RECEPCIONISTA DE HOTEL', NULL, '2022-03-30');
INSERT INTO `puestos` VALUES (114, 1, 'CAMARISTA', NULL, '2022-03-30');
INSERT INTO `puestos` VALUES (115, 1, 'MESERO DE RESTAURANTE HOTEL', NULL, '2022-03-30');
INSERT INTO `puestos` VALUES (116, 1, 'MESERO DE RESTAURANTE', NULL, '2022-03-30');
INSERT INTO `puestos` VALUES (117, 1, 'TECNICO DE INHALOTERAPIA', NULL, '2022-03-30');
INSERT INTO `puestos` VALUES (118, 1, 'AFANADORA DE ONCOLOGIA', NULL, '2022-03-30');
INSERT INTO `puestos` VALUES (119, 1, 'AFANADORA DE QUIROFANO', NULL, '2022-03-30');
INSERT INTO `puestos` VALUES (120, 1, 'AFANADORA DE HOSPITALIZACION', NULL, '2022-03-30');
INSERT INTO `puestos` VALUES (121, 1, 'SUPERVISOR DE INTENDENCIA', NULL, '2022-03-30');
INSERT INTO `puestos` VALUES (122, 1, 'AFANADORA DE URGENCIAS', NULL, '2022-03-30');
INSERT INTO `puestos` VALUES (123, 1, 'AFANADORA DE OFICINAS Y AREAS GENERALES', NULL, '2022-03-30');
INSERT INTO `puestos` VALUES (124, 1, 'AFANADORA DE ASEO Y LAVADO DE MATERIAL', NULL, '2022-03-30');
INSERT INTO `puestos` VALUES (125, 1, 'AFANADORA DE HEMODIALISIS', NULL, '2022-03-30');
INSERT INTO `puestos` VALUES (126, 1, 'AFANADORA DE UCIN', NULL, '2022-03-30');
INSERT INTO `puestos` VALUES (127, 1, 'PULIDOR', NULL, '2022-03-30');
INSERT INTO `puestos` VALUES (128, 1, 'AFANADORA CONTROL DE ROPA', NULL, '2022-03-30');
INSERT INTO `puestos` VALUES (129, 1, 'AFANADORA DE TERAPIA', NULL, '2022-03-30');
INSERT INTO `puestos` VALUES (130, 1, 'AFANADORA DE HEMODINAMIA', NULL, '2022-03-30');
INSERT INTO `puestos` VALUES (131, 1, 'AFANADORA DE RAYOS X', NULL, '2022-03-30');
INSERT INTO `puestos` VALUES (132, 1, 'SUPERVISOR DE INTENDENCIA', NULL, '2022-03-30');
INSERT INTO `puestos` VALUES (133, 1, 'LAVAMUEBLES', NULL, '2022-03-30');
INSERT INTO `puestos` VALUES (134, 1, 'AFANADORA DE HOSPITALIZACION', NULL, '2022-03-30');
INSERT INTO `puestos` VALUES (135, 1, 'AUXILIAR DE SERVICIOS GENERALES', NULL, '2022-03-30');
INSERT INTO `puestos` VALUES (136, 1, 'AUXILIAR DE SERVICIOS GENERALES', NULL, '2022-03-30');
INSERT INTO `puestos` VALUES (137, 1, 'AFANADORA DE HOSPITALIZACION', NULL, '2022-03-30');
INSERT INTO `puestos` VALUES (138, 1, 'JEFE DE JURIDICO', NULL, '2022-03-30');
INSERT INTO `puestos` VALUES (139, 1, 'TECNICO DE LABORATORIO', NULL, '2022-03-30');
INSERT INTO `puestos` VALUES (140, 1, 'TECNICO DE BANCO DE SANGRE', NULL, '2022-03-30');
INSERT INTO `puestos` VALUES (141, 1, 'QUIMICO A', NULL, '2022-03-30');
INSERT INTO `puestos` VALUES (142, 1, 'SECRETARIA OPERATIVA', NULL, '2022-03-30');
INSERT INTO `puestos` VALUES (143, 1, 'COORDINADOR TECNICO DE LABORATORIO', NULL, '2022-03-30');
INSERT INTO `puestos` VALUES (144, 1, 'QUIMICO B', NULL, '2022-03-30');
INSERT INTO `puestos` VALUES (145, 1, 'ASEO Y LAVADO DE MATERIAL', NULL, '2022-03-30');
INSERT INTO `puestos` VALUES (146, 1, 'TECNICO DE LABORATORIO', NULL, '2022-03-30');
INSERT INTO `puestos` VALUES (147, 1, 'SECRETARIA OPERATIVA', NULL, '2022-03-30');
INSERT INTO `puestos` VALUES (148, 1, 'TECNICO DE LABORATORIO DE SUCURSAL', NULL, '2022-03-30');
INSERT INTO `puestos` VALUES (149, 1, 'COORDINADOR DE LABORATORIO Y BANCO DE SANGRE', NULL, '2022-03-30');
INSERT INTO `puestos` VALUES (150, 1, 'JEFE DE LABORATORIO Y BANCO DE SANGRE', NULL, '2022-03-30');
INSERT INTO `puestos` VALUES (151, 1, 'SUPERVISOR DE LAVANDERIA', NULL, '2022-03-30');
INSERT INTO `puestos` VALUES (152, 1, 'LAVANDERO', NULL, '2022-03-30');
INSERT INTO `puestos` VALUES (153, 1, 'OPERARIO DE MANTENIMIENTO MULTITECNICO A', NULL, '2022-03-30');
INSERT INTO `puestos` VALUES (154, 1, 'PINTOR', NULL, '2022-03-30');
INSERT INTO `puestos` VALUES (155, 1, 'AUXILIAR GENERAL', NULL, '2022-03-30');
INSERT INTO `puestos` VALUES (156, 1, 'COORDINADOR DE MANTENIMIENTO', NULL, '2022-03-30');
INSERT INTO `puestos` VALUES (157, 1, 'OPERARIO DE MANTENIMIENTO MULTITECNICO B', NULL, '2022-03-30');
INSERT INTO `puestos` VALUES (158, 1, 'MEDICO DE CHECK UP', NULL, '2022-03-30');
INSERT INTO `puestos` VALUES (159, 1, 'MEDICO DE QUIROFANO', NULL, '2022-03-30');
INSERT INTO `puestos` VALUES (160, 1, 'MEDICO DE TERAPIA INTENSIVA', NULL, '2022-03-30');
INSERT INTO `puestos` VALUES (161, 1, 'JEFE DE TERAPIA', NULL, '2022-03-30');
INSERT INTO `puestos` VALUES (162, 1, 'COORDINADOR DE URGENCIAS', NULL, '2022-03-30');
INSERT INTO `puestos` VALUES (163, 1, 'MEDICO DE URGENCIAS BILINGUE', NULL, '2022-03-30');
INSERT INTO `puestos` VALUES (164, 1, 'COORDINADOR DE URGENCIAS', NULL, '2022-03-30');
INSERT INTO `puestos` VALUES (165, 1, 'MEDICO DE URGENCIAS', NULL, '2022-03-30');
INSERT INTO `puestos` VALUES (166, 1, 'JEFE DE URGENCIAS', NULL, '2022-03-30');
INSERT INTO `puestos` VALUES (167, 1, 'MEDICO DE URGENCIAS', NULL, '2022-03-30');
INSERT INTO `puestos` VALUES (168, 1, 'MEDICO DE URGENCIAS BILINGUE', NULL, '2022-03-30');
INSERT INTO `puestos` VALUES (169, 1, 'COORDINADOR DE MONITOREO Y LOGISTICA', NULL, '2022-03-30');
INSERT INTO `puestos` VALUES (170, 1, 'AUXILIAR DE MONITOREO Y LOGISTICA', NULL, '2022-03-30');
INSERT INTO `puestos` VALUES (171, 1, 'SUPERVISOR DE MONITOREO Y LOGISTICA', NULL, '2022-03-30');
INSERT INTO `puestos` VALUES (172, 1, 'MONITORISTA', NULL, '2022-03-30');
INSERT INTO `puestos` VALUES (173, 1, 'AUXILIAR DE MONITOREO Y LOGISTICA', NULL, '2022-03-30');
INSERT INTO `puestos` VALUES (174, 1, 'REPOSTERA DE NUTRICION', NULL, '2022-03-30');
INSERT INTO `puestos` VALUES (175, 1, 'COCINERA DE NUTRICION', NULL, '2022-03-30');
INSERT INTO `puestos` VALUES (176, 1, 'AUXILIAR DE COCINA DE NUTRICION', NULL, '2022-03-30');
INSERT INTO `puestos` VALUES (177, 1, 'JEFE DE NUTRICION', NULL, '2022-03-30');
INSERT INTO `puestos` VALUES (178, 1, 'CHAROLERA', NULL, '2022-03-30');
INSERT INTO `puestos` VALUES (179, 1, 'SUPERVISOR DE COCINA', NULL, '2022-03-30');
INSERT INTO `puestos` VALUES (180, 1, 'COORDINADOR DE NUTRICION', NULL, '2022-03-30');
INSERT INTO `puestos` VALUES (181, 1, 'COMODIN DE NUTRICION', NULL, '2022-03-30');
INSERT INTO `puestos` VALUES (182, 1, 'CHAROLERA', NULL, '2022-03-30');
INSERT INTO `puestos` VALUES (183, 1, 'ENFERMERA CLINICA DE ONCOLOGIA', NULL, '2022-03-30');
INSERT INTO `puestos` VALUES (184, 1, 'TECNICO DE RADIOTERAPIA', NULL, '2022-03-30');
INSERT INTO `puestos` VALUES (185, 1, 'ENFERMERA CLINICA ESPECIALIZADA DE ONCOLOGIA', NULL, '2022-03-30');
INSERT INTO `puestos` VALUES (186, 1, 'TECNICO DE RADIOTERAPIA', NULL, '2022-03-30');
INSERT INTO `puestos` VALUES (187, 1, 'EJECUTIVO DE ADMISION DE ONCOLOGIA', NULL, '2022-03-30');
INSERT INTO `puestos` VALUES (188, 1, 'SUPERVISOR DE SEGURIDAD RADIOLOGICA', NULL, '2022-03-30');
INSERT INTO `puestos` VALUES (189, 1, 'FISICO MEDICO EN RADIOTERAPIA', NULL, '2022-03-30');
INSERT INTO `puestos` VALUES (190, 1, 'JEFE DE ONCOLOGÍA', NULL, '2022-03-30');
INSERT INTO `puestos` VALUES (191, 1, 'ENFERMERA CLINICA ESPECIALIZADA DE HOSPITALIZACION', NULL, '2022-03-30');
INSERT INTO `puestos` VALUES (192, 1, 'SUPERVISOR DE ENFERMERIA DE HOSPITALIZACION', NULL, '2022-03-30');
INSERT INTO `puestos` VALUES (193, 1, 'ENFERMERA CLINICA DE HOSPITALIZACION', NULL, '2022-03-30');
INSERT INTO `puestos` VALUES (194, 1, 'GERENTE DE ENFERMERIA', NULL, '2022-03-30');
INSERT INTO `puestos` VALUES (195, 1, 'ENFERMERA CLINICA DE HOSPITALIZACION', NULL, '2022-03-30');
INSERT INTO `puestos` VALUES (196, 1, 'ENFERMERA CLINICA ESPECIALIZADA DE UCIN', NULL, '2022-03-30');
INSERT INTO `puestos` VALUES (197, 1, 'CAMILLERO', NULL, '2022-03-30');
INSERT INTO `puestos` VALUES (198, 1, 'ENFERMERA CLINICA', NULL, '2022-03-30');
INSERT INTO `puestos` VALUES (199, 1, 'ENFERMERA CLINICA ESPECIALIZADA EN UVEH', NULL, '2022-03-30');
INSERT INTO `puestos` VALUES (200, 1, 'ENFERMERA CLINICA ESPECIALIZADA DE QUIROFANO', NULL, '2022-03-30');
INSERT INTO `puestos` VALUES (201, 1, 'SUPERVISOR DE ENFERMERIA DE QUIROFANO', NULL, '2022-03-30');
INSERT INTO `puestos` VALUES (202, 1, 'ENFERMERA CLINICA DE QUIROFANO', NULL, '2022-03-30');
INSERT INTO `puestos` VALUES (203, 1, 'SUPERVISOR DE INVENTARIOS QUIROFANO', NULL, '2022-03-30');
INSERT INTO `puestos` VALUES (204, 1, 'ENFERMERA CLINICA DE QUIROFANO', NULL, '2022-03-30');
INSERT INTO `puestos` VALUES (205, 1, 'ALMACENISTA DE QUIROFANO', NULL, '2022-03-30');
INSERT INTO `puestos` VALUES (206, 1, 'JEFE DE ENFERMERAS QUIROFANO', NULL, '2022-03-30');
INSERT INTO `puestos` VALUES (207, 1, 'ENFERMERA CLINICA DE QUIROFANO', NULL, '2022-03-30');
INSERT INTO `puestos` VALUES (208, 1, 'JEFE DE SERVICIOS DE ENFERMERIA', NULL, '2022-03-30');
INSERT INTO `puestos` VALUES (209, 1, 'ENFERMERA CLINICA ESPECIALIZADA DE QUIROFANO', NULL, '2022-03-30');
INSERT INTO `puestos` VALUES (210, 1, 'ENFERMERA CLINICA DE QUIROFANO', NULL, '2022-03-30');
INSERT INTO `puestos` VALUES (211, 1, 'TECNICO RADIOLOGO', NULL, '2022-03-30');
INSERT INTO `puestos` VALUES (212, 1, 'ASISTENTE ADMINISTRATIVO DE RAYOS X', NULL, '2022-03-30');
INSERT INTO `puestos` VALUES (213, 1, 'JEFE DE RAYOS X', NULL, '2022-03-30');
INSERT INTO `puestos` VALUES (214, 1, 'TECNICO RADIOLOGO', NULL, '2022-03-30');
INSERT INTO `puestos` VALUES (215, 1, 'BIOLOGO EN REPRODUCCION', NULL, '2022-03-30');
INSERT INTO `puestos` VALUES (216, 1, 'LAVA LOZA RESTAURANTE', NULL, '2022-03-30');
INSERT INTO `puestos` VALUES (217, 1, 'COCINERA DE RESTAURANTE', NULL, '2022-03-30');
INSERT INTO `puestos` VALUES (218, 1, 'CAJERA DE RESTAURANTE', NULL, '2022-03-30');
INSERT INTO `puestos` VALUES (219, 1, 'AUXILIAR DE COCINA RESTAURANTE', NULL, '2022-03-30');
INSERT INTO `puestos` VALUES (220, 1, 'COORDINADOR DE RESTAURANTES', NULL, '2022-03-30');
INSERT INTO `puestos` VALUES (221, 1, 'AUXILIAR DE ROPERIA', NULL, '2022-03-30');
INSERT INTO `puestos` VALUES (222, 1, 'COORDINADOR DE ROPERIA', NULL, '2022-03-30');
INSERT INTO `puestos` VALUES (223, 1, 'COORDINADOR DE SOPORTE TECNICO', NULL, '2022-03-30');
INSERT INTO `puestos` VALUES (224, 1, 'COORDINADOR DE DESARROLLO VISUAL', NULL, '2022-03-30');
INSERT INTO `puestos` VALUES (225, 1, 'JEFE DE TECNOLOGIAS DE LA INFORMACION Y COMUNICACION', NULL, '2022-03-30');
INSERT INTO `puestos` VALUES (226, 1, 'PROGRAMADOR ANALISTA VISUAL', NULL, '2022-03-30');
INSERT INTO `puestos` VALUES (227, 1, 'COORDINADOR DE DESARROLLO WEB', NULL, '2022-03-30');
INSERT INTO `puestos` VALUES (228, 1, 'PROGRAMADOR ANALISTA WEB', NULL, '2022-03-30');
INSERT INTO `puestos` VALUES (229, 1, 'TECNICO DE SOPORTE EN TI', NULL, '2022-03-30');
INSERT INTO `puestos` VALUES (231, 1, 'ENFERMERA CLINICA ASISTENCIAL', NULL, '2022-03-30');
INSERT INTO `puestos` VALUES (232, 1, 'ENFERMERA CLINICA ESPECIALIZADA DE TERAPIA', NULL, '2022-03-30');
INSERT INTO `puestos` VALUES (233, 1, 'JEFE DE ENFERMERAS DE TERAPIA', NULL, '2022-03-30');
INSERT INTO `puestos` VALUES (234, 1, 'COORDINADOR DE TERAPIA', NULL, '2022-03-30');
INSERT INTO `puestos` VALUES (235, 1, 'ENFERMERA CLINICA DE TERAPIA', NULL, '2022-03-30');
INSERT INTO `puestos` VALUES (236, 1, 'ENFERMERA CLINICA ESPECIALISTA DE TERAPIA', NULL, '2022-03-30');
INSERT INTO `puestos` VALUES (237, 1, 'ASISTENTE ADMINISTRATIVO DE TERAPIA', NULL, '2022-03-30');
INSERT INTO `puestos` VALUES (238, 1, 'TECNICO RADIOLOGO', NULL, '2022-03-30');
INSERT INTO `puestos` VALUES (239, 1, 'ENFERMERA CLINICA ESPECIALIZADA DE URGENCIAS', NULL, '2022-03-30');
INSERT INTO `puestos` VALUES (240, 1, 'JEFE DE SERVICIOS MEDICOS PI', NULL, '2022-03-30');
INSERT INTO `puestos` VALUES (241, 1, 'ENFERMERA CLINICA', NULL, '2022-03-30');
INSERT INTO `puestos` VALUES (242, 1, 'COORDINADOR DE UVEH', NULL, '2022-03-30');
INSERT INTO `puestos` VALUES (243, 1, 'ENFERMERA CLINICA ESPECIALIZADA DE URGENCIAS', NULL, '2022-03-30');
INSERT INTO `puestos` VALUES (244, 1, 'PUESTO DE PRUEBA', 'PRUEBA PRUEBA PRUEBA PRUEBA PRUEBA', '2022-04-09');

-- ----------------------------
-- Table structure for requierecapacitacion
-- ----------------------------
DROP TABLE IF EXISTS `requierecapacitacion`;
CREATE TABLE `requierecapacitacion`  (
  `idcapacitacion` int(11) NOT NULL AUTO_INCREMENT,
  `idusuario` int(11) NOT NULL,
  `nececitacapacitacion` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `fecha` date NULL DEFAULT NULL,
  PRIMARY KEY USING BTREE (`idcapacitacion`),
  INDEX `fk_requierecapacitacion_usuarios` USING BTREE(`idusuario`)
) ENGINE = MyISAM AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for tipoevaluacion
-- ----------------------------
DROP TABLE IF EXISTS `tipoevaluacion`;
CREATE TABLE `tipoevaluacion`  (
  `idtipoeveluacion` int(11) NOT NULL AUTO_INCREMENT,
  `evaluacion` varchar(150) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `fechaalta` date NOT NULL,
  `idstatus` int(11) NOT NULL,
  PRIMARY KEY USING BTREE (`idtipoeveluacion`)
) ENGINE = InnoDB AUTO_INCREMENT = 9 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of tipoevaluacion
-- ----------------------------
INSERT INTO `tipoevaluacion` VALUES (6, 'EVALUACION 360', '2022-04-12', 2);
INSERT INTO `tipoevaluacion` VALUES (8, 'EVALUACION SEMESTRAL', '2022-04-14', 1);

-- ----------------------------
-- Table structure for usuarios
-- ----------------------------
DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE `usuarios`  (
  `idusuario` int(11) NOT NULL AUTO_INCREMENT,
  `nombreuser` varchar(150) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `appaterno` varchar(150) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `apmaterno` varchar(150) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `usuario` varchar(150) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `noempleado` int(11) NULL DEFAULT NULL,
  `password` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `rol` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `idstatus` int(11) NOT NULL DEFAULT 1,
  `iddepartamento` int(11) NOT NULL,
  `idpuesto` int(11) NOT NULL,
  `idjerarquia` int(11) NOT NULL,
  `idevaluadopor` int(255) NULL DEFAULT NULL,
  `idcompromiso` int(11) NULL DEFAULT NULL,
  `idrequierecapacitacion` int(11) NULL DEFAULT NULL,
  `tipoevaluacion` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `autoevalua` smallint(1) NOT NULL,
  `evalua360` char(2) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `statusevaluado` int(11) NULL DEFAULT NULL,
  `fechaalta` date NULL DEFAULT NULL,
  `fecha` timestamp NULL DEFAULT NULL,
  PRIMARY KEY USING BTREE (`idusuario`),
  INDEX `fk_usuarios_estatus` USING BTREE(`idstatus`),
  INDEX `fk_usuarios_departamento` USING BTREE(`iddepartamento`),
  INDEX `fk_usuarios_puestos` USING BTREE(`idpuesto`),
  INDEX `fk_usuarios_jerarquia` USING BTREE(`idjerarquia`),
  CONSTRAINT `fk_usuarios_departamento` FOREIGN KEY (`iddepartamento`) REFERENCES `departamento` (`iddepartamento`) ON DELETE RESTRICT ON UPDATE CASCADE,
  CONSTRAINT `fk_usuarios_estatus` FOREIGN KEY (`idstatus`) REFERENCES `estatus` (`idstatus`) ON DELETE RESTRICT ON UPDATE CASCADE,
  CONSTRAINT `fk_usuarios_jerarquia` FOREIGN KEY (`idjerarquia`) REFERENCES `jerarquia` (`idjerarquia`) ON DELETE RESTRICT ON UPDATE CASCADE,
  CONSTRAINT `fk_usuarios_puestos` FOREIGN KEY (`idpuesto`) REFERENCES `puestos` (`idpuesto`) ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8 COLLATE = utf8_general_ci COMMENT = 'InnoDB free: 11264 kB; (`iddepartamento`) REFER `evapersonal22/departamento`(`id' ROW_FORMAT = Compact;

-- ----------------------------
-- Records of usuarios
-- ----------------------------
INSERT INTO `usuarios` VALUES (1, 'Cristian Isaac', 'Torres', 'Uribe', 'TORRES7158', 7158, '7158', 'admin', 1, 69, 227, 6, NULL, NULL, NULL, 'OPERATIVO', 1, 'SI', 2, '2022-03-17', '2022-04-22 14:00:39');
INSERT INTO `usuarios` VALUES (2, 'CRISTIAN ISAAC', 'TORRES', 'URIBE', 'TORRES7170', 7170, '7170', 'user', 2, 69, 228, 6, 1, NULL, NULL, 'OPERATIVO', 1, 'SI', 2, '2022-03-15', '2022-04-22 13:17:00');
INSERT INTO `usuarios` VALUES (3, 'FRANCISCO JAVIER', 'GONZALEZ', 'VARGAS', 'GONZALEZ7171', 7171, '7171', 'user', 2, 69, 229, 6, 1, NULL, NULL, 'OPERATIVO', 1, 'SI', 1, '2022-04-20', '2022-04-22 13:23:20');

SET FOREIGN_KEY_CHECKS = 1;
