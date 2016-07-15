
# This is a fix for InnoDB in MySQL >= 4.1.x
# It "suspends judgement" for fkey relationships until are tables are set.
SET FOREIGN_KEY_CHECKS = 0;

-- ---------------------------------------------------------------------
-- cuenta
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `cuenta`;

CREATE TABLE `cuenta`
(
    `id_cuenta` INTEGER(20) NOT NULL AUTO_INCREMENT,
    `nombre_cuenta` VARCHAR(150) NOT NULL,
    `valor_cuenta` FLOAT(11,2) DEFAULT 0.00 NOT NULL,
    `tipo_cuenta` enum('FORMAL','INFORMAL') DEFAULT 'FORMAL',
    `user_crea_cuenta` VARCHAR(20),
    `fecha_creacion_cuenta` DATETIME,
    `fecha_modificacion_cuenta` DATETIME,
    PRIMARY KEY (`id_cuenta`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- gasto
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `gasto`;

CREATE TABLE `gasto`
(
    `id_gasto` INTEGER(20) NOT NULL AUTO_INCREMENT,
    `fk_cuenta` INTEGER(20) DEFAULT 0 NOT NULL,
    `nombre_gasto` VARCHAR(100) NOT NULL,
    `costo_gasto` FLOAT(11,2) DEFAULT 0.00 NOT NULL,
    `fecha_emision_gasto` DATE,
    `fecha_pago_gasto` DATE,
    `numero_doc_gasto` TEXT,
    `fecha_creacion_gasto` DATETIME,
    `fecha_modificacion_gasto` DATETIME,
    PRIMARY KEY (`id_gasto`),
    INDEX `FI_gasto_cuenta` (`fk_cuenta`),
    CONSTRAINT `fk_gasto_cuenta`
        FOREIGN KEY (`fk_cuenta`)
        REFERENCES `cuenta` (`id_cuenta`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- venta
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `venta`;

CREATE TABLE `venta`
(
    `id_venta` INTEGER NOT NULL AUTO_INCREMENT,
    `fecha_venta` DATE NOT NULL,
    `total_venta` FLOAT(11,2) DEFAULT 0.00 NOT NULL,
    `formal_total_venta` FLOAT(11,2) DEFAULT 0.00 NOT NULL,
    `informal_total_venta` FLOAT(11,2) DEFAULT 0.00 NOT NULL,
    `total_iva_venta_formal` FLOAT(11,2) DEFAULT 0.00 NOT NULL,
    `detalle_venta` TEXT,
    `fecha_creacion_venta` DATETIME,
    `fecha_modificacion_venta` DATETIME,
    PRIMARY KEY (`id_venta`),
    UNIQUE INDEX `fecha_venta_UNIQUE` (`fecha_venta`)
) ENGINE=InnoDB;

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
