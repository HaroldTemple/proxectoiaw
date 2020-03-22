CREATE DATABASE
    `equipamentos`
        DEFAULT CHARSET=utf32
        COLLATE utf32_spanish_ci;

CREATE TABLE
    `equipamentos`.`usuario` (
        `usuario` VARCHAR(24) CHARACTER SET utf32 COLLATE utf32_spanish_ci,
        `contrasinal` VARCHAR(8) CHARACTER SET utf32 COLLATE utf32_spanish_ci,
        `nome` VARCHAR(60) CHARACTER SET utf32 COLLATE utf32_spanish_ci,
        `direccion` VARCHAR(90) CHARACTER SET utf32 COLLATE utf32_spanish_ci,
        `telefono` INT,
        `nifdni` VARCHAR(9) CHARACTER SET utf32 COLLATE utf32_spanish_ci,
        `tipo_usuario` VARCHAR(1) CHARACTER SET utf32 COLLATE utf32_spanish_ci)
	ENGINE = InnoDB
	CHARSET=utf32
    COLLATE utf32_spanish_ci;

CREATE TABLE
    `equipamentos`.`novo_rexistro` (
        `usuario` VARCHAR(24) CHARACTER SET utf32 COLLATE utf32_spanish_ci,
        `contrasinal` VARCHAR(8) CHARACTER SET utf32 COLLATE utf32_spanish_ci,
        `nome` VARCHAR(60) CHARACTER SET utf32 COLLATE utf32_spanish_ci,
        `direccion` VARCHAR(90) CHARACTER SET utf32 COLLATE utf32_spanish_ci,
        `telefono` INT,
        `nifdni` VARCHAR(9) CHARACTER SET utf32 COLLATE utf32_spanish_ci)
	ENGINE = InnoDB
	CHARSET=utf32
	COLLATE utf32_spanish_ci;

CREATE TABLE
    `equipamentos`.`equipo_aluguer` (
        `modelo` VARCHAR(50) CHARACTER SET utf32 COLLATE utf32_spanish_ci,
        `cantidade` INT,
        `descripcion` VARCHAR(100) CHARACTER SET utf32 COLLATE utf32_spanish_ci,
        `marca` VARCHAR(24) CHARACTER SET utf32 COLLATE utf32_spanish_ci,
        `prezo` INT,
        `foto` VARCHAR(1000) CHARACTER SET utf32 COLLATE utf32_spanish_ci)
	ENGINE = InnoDB
	CHARSET=utf32
    COLLATE utf32_spanish_ci;

CREATE TABLE
    `equipamentos`.`equipo_alugado` (
        `modelo` VARCHAR(50) CHARACTER SET utf32 COLLATE utf32_spanish_ci,
        `cantidade` INT,
        `descripcion` VARCHAR(100) CHARACTER SET utf32 COLLATE utf32_spanish_ci,
        `marca` VARCHAR(24) CHARACTER SET utf32 COLLATE utf32_spanish_ci,
        `foto` VARCHAR(1000) CHARACTER SET utf32 COLLATE utf32_spanish_ci,
        `usuario` VARCHAR(24) CHARACTER SET utf32 COLLATE utf32_spanish_ci)
	ENGINE = InnoDB
	CHARSET=utf32
    COLLATE utf32_spanish_ci;

CREATE TABLE
    `equipamentos`.`equipo_devolto` (
        `modelo` VARCHAR(50) CHARACTER SET utf32 COLLATE utf32_spanish_ci,
        `cantidade` INT,
        `descripcion` VARCHAR(100) CHARACTER SET utf32 COLLATE utf32_spanish_ci,
        `marca` VARCHAR(24) CHARACTER SET utf32 COLLATE utf32_spanish_ci,
        `foto` VARCHAR(1000) CHARACTER SET utf32 COLLATE utf32_spanish_ci,
        `usuario` VARCHAR(24) CHARACTER SET utf32 COLLATE utf32_spanish_ci)
	ENGINE = InnoDB
	CHARSET=utf32
    COLLATE utf32_spanish_ci;

CREATE TABLE
    `equipamentos`.`equipo_venda` (
        `modelo` VARCHAR(50) CHARACTER SET utf32 COLLATE utf32_spanish_ci,
        `cantidade` INT,
        `descripcion` VARCHAR(100) CHARACTER SET utf32 COLLATE utf32_spanish_ci,
        `marca` VARCHAR(24) CHARACTER SET utf32 COLLATE utf32_spanish_ci,
        `prezo` INT,
        `foto` VARCHAR(1000) CHARACTER SET utf32 COLLATE utf32_spanish_ci)
	ENGINE = InnoDB
	CHARSET=utf32
    COLLATE utf32_spanish_ci;