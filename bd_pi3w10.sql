-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3356
-- Generation Time: Nov 30, 2022 at 09:25 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bd_pi3w`
--
CREATE DATABASE IF NOT EXISTS `bd_pi3w` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `bd_pi3w`;

DELIMITER $$
--
-- Procedures
--
DROP PROCEDURE IF EXISTS `sp_addcli`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_addcli` (IN `nomecli` VARCHAR(50), IN `cnpjcli` CHAR(14), IN `cepcli` CHAR(8), IN `ruacli` VARCHAR(30), IN `ncli` INT, IN `baicli` VARCHAR(50), IN `cidcli` VARCHAR(50), IN `ufcli` CHAR(2), IN `emailcli` VARCHAR(50), IN `senhacli` VARCHAR(50))  INSERT INTO `tbl_cli` (`nome`, `cnpj`, `cep`, `rua`, `numero`, `bairro`, `cidade`, `uf`, `email`, `senha`) VALUES (`nomecli`, `cnpjcli`, `cepcli`, `ruacli`, `ncli`, `baicli`, `cidcli`, `ufcli`, `emailcli`, `senhacli`)$$

DROP PROCEDURE IF EXISTS `sp_additem`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_additem` (IN `codven` INT, IN `codprod` INT, IN `qtdeitem` INT)  INSERT INTO tbl_itens (`cod_ven`, `cod_prod`, `qtde`) VALUES (`codven`, `codprod`, `qtdeitem`)$$

DROP PROCEDURE IF EXISTS `sp_addprod`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_addprod` (IN `nomeprod` VARCHAR(100), IN `qtdeprod` INT, IN `disprod` BOOLEAN, IN `val_ven_prod` DECIMAL(10,2), IN `img_url` VARCHAR(100))  INSERT INTO tbl_prod (`nome`, `qtde`, `disponibilidade`, `valor_venda`, `img_url`) VALUES (`nomeprod`, `qtdeprod`, `disprod`, `val_ven_prod`, `img_url`)$$

DROP PROCEDURE IF EXISTS `sp_addven`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_addven` (IN `codcli` INT)  INSERT INTO tbl_ven (`cod_cli`) VALUES (`codcli`)$$

DROP PROCEDURE IF EXISTS `sp_desconto`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_desconto` (`codprod` INT, `valtemp` DECIMAL(10,2))  BEGIN
	IF (`valtemp` = null) THEN
    	UPDATE `tbl_prod` SET `valor_temp` = 0 WHERE `cod_prod` = `codprod`;
    ELSE
    	UPDATE `tbl_prod` SET `valor_temp` = `valtemp` WHERE `cod_prod` = `codprod`;
    END IF;
END$$

DROP PROCEDURE IF EXISTS `sp_updinfocli`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_updinfocli` (`codcli` INT, `nomecli` VARCHAR(50), `cnpjcli` CHAR(14), `cepcli` CHAR(8), `ruacli` VARCHAR(30), `ncli` INT, `baicli` VARCHAR(50), `cidcli` VARCHAR(50), `ufcli` CHAR(2))  UPDATE tbl_cli SET `cnpj` = `cnpjcli`, `nome` = `nomecli`, `cep` = `cepcli`, `rua` = `ruacli`, `numero` = `ncli`, `bairro` = `baicli`, `cidade` = `cidcli`, `uf` = `ufcli` where `cod_cli` = `codcli`$$

DROP PROCEDURE IF EXISTS `sp_updprod`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_updprod` (`cod` INT, `n` VARCHAR(100), `qtd` INT, `disp` TINYINT, `val_ven` DECIMAL(10,2), `val_temp` DECIMAL(10,2), `url` VARCHAR(100), `forn` VARCHAR(30))  BEGIN
	UPDATE tbl_prod SET
    nome = n,
    qtde = qtd,
    disponibilidade = disp,
    valor_venda = val_ven,
    valor_temp = val_temp,
    img_url = url,
    fornecedor = forn
    WHERE cod_prod = cod;
END$$

DROP PROCEDURE IF EXISTS `sp_updsenhacli`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_updsenhacli` (`emailcli` VARCHAR(50), `senhacli` VARCHAR(50))  UPDATE tbl_cli SET `senha` = `senhacli` where `email` = `emailcli`$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_cli`
--

DROP TABLE IF EXISTS `tbl_cli`;
CREATE TABLE `tbl_cli` (
  `cod_cli` int(11) NOT NULL,
  `cnpj` char(14) NOT NULL,
  `email` varchar(50) NOT NULL,
  `senha` varchar(50) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `rua` varchar(30) NOT NULL,
  `bairro` varchar(50) NOT NULL,
  `numero` int(11) NOT NULL,
  `cidade` varchar(50) NOT NULL,
  `uf` char(2) NOT NULL,
  `cep` char(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_cli`
--

INSERT INTO `tbl_cli` (`cod_cli`, `cnpj`, `email`, `senha`, `nome`, `rua`, `bairro`, `numero`, `cidade`, `uf`, `cep`) VALUES
(2, '27783510000139', 'droga.raia@gmail.com', 'teste', 'DrogaRaia', '1452', 'Passagem de Maciambú (Ens Brito)', 2048, 'Palhoça', 'SC', '70610905'),
(10, '82050578000117', 'farmazul@gmail.com', 'kgvteste', 'Farmácia FarmAzul', 'R. Juarez Távora', 'Centro', 98, 'Cabedelo', 'PB', '58100158');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_itens`
--

DROP TABLE IF EXISTS `tbl_itens`;
CREATE TABLE `tbl_itens` (
  `cod_ven` int(11) NOT NULL,
  `cod_prod` int(11) NOT NULL,
  `qtde` int(11) NOT NULL,
  `val_venda` decimal(10,2) NOT NULL,
  `subtotal` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_itens`
--

INSERT INTO `tbl_itens` (`cod_ven`, `cod_prod`, `qtde`, `val_venda`, `subtotal`) VALUES
(6, 1, 20, '15.00', '300.00'),
(6, 4, 32, '7.50', '240.00'),
(6, 5, 128, '35.40', '4531.20'),
(6, 7, 60, '16.72', '1003.20'),
(10, 1, 6, '12.10', '72.60'),
(10, 4, 1, '7.00', '7.00'),
(10, 5, 1, '32.20', '32.20'),
(11, 4, 6, '7.00', '42.00'),
(12, 1, 5, '12.10', '60.50'),
(13, 4, 10, '7.00', '70.00'),
(14, 3, 3, '19.99', '59.97'),
(14, 4, 3, '7.00', '21.00');

--
-- Triggers `tbl_itens`
--
DROP TRIGGER IF EXISTS `tgr_itens_ai`;
DELIMITER $$
CREATE TRIGGER `tgr_itens_ai` AFTER INSERT ON `tbl_itens` FOR EACH ROW UPDATE `tbl_prod` SET `qtde` = `qtde` - new.qtde WHERE `cod_prod` = new.cod_prod
$$
DELIMITER ;
DROP TRIGGER IF EXISTS `tgr_itens_bd`;
DELIMITER $$
CREATE TRIGGER `tgr_itens_bd` BEFORE DELETE ON `tbl_itens` FOR EACH ROW UPDATE `tbl_prod` SET `qtde` = `qtde` + old.qtde WHERE `cod_prod` = old.cod_prod
$$
DELIMITER ;
DROP TRIGGER IF EXISTS `tgr_itens_bi`;
DELIMITER $$
CREATE TRIGGER `tgr_itens_bi` BEFORE INSERT ON `tbl_itens` FOR EACH ROW BEGIN
IF ((SELECT `valor_temp` FROM `tbl_prod` WHERE `cod_prod` = NEW.cod_prod) <= 0 OR (SELECT `valor_temp` FROM `tbl_prod` WHERE `cod_prod` = NEW.cod_prod) = (SELECT `valor_venda` FROM `tbl_prod` WHERE `cod_prod` = NEW.cod_prod)) THEN
SELECT `valor_venda` FROM `tbl_prod` WHERE `cod_prod` = NEW.cod_prod INTO @valven;
ELSE
SELECT `valor_temp` FROM `tbl_prod` WHERE `cod_prod` = NEW.cod_prod INTO @valven;
END IF;
SET NEW.val_venda = @valven;
SET NEW.subtotal = NEW.qtde * NEW.val_venda;
UPDATE `tbl_ven` SET `total` = `total` + NEW.subtotal WHERE `cod_ven` = NEW.cod_ven;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_prod`
--

DROP TABLE IF EXISTS `tbl_prod`;
CREATE TABLE `tbl_prod` (
  `cod_prod` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `qtde` int(11) NOT NULL,
  `disponibilidade` tinyint(1) NOT NULL,
  `valor_venda` decimal(10,2) NOT NULL,
  `valor_temp` decimal(10,2) NOT NULL DEFAULT 0.00,
  `img_url` varchar(100) NOT NULL,
  `fornecedor` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_prod`
--

INSERT INTO `tbl_prod` (`cod_prod`, `nome`, `qtde`, `disponibilidade`, `valor_venda`, `valor_temp`, `img_url`, `fornecedor`) VALUES
(1, 'Xarope 120ml', 10, 1, '15.00', '12.10', 'xarope120ml.png', 'Vick'),
(2, 'Dorflex 50 comp.', 90, 0, '32.00', '29.99', 'dorflex50c.png', 'Divino Remédio'),
(3, 'Buscopan 20ml Gotas', 37, 1, '20.10', '19.99', 'buscopan20mlg.png', 'Buscopan'),
(4, 'Dipirona monohidratada 500mg', 76, 1, '7.50', '7.00', 'dipirona500mg.png', 'Divino Remédio'),
(5, 'Buscopan 10mg', 127, 1, '35.40', '32.20', 'buscopan10mg.png', 'Buscopan'),
(6, 'Dorflex 10 comp.', 64, 1, '3.00', '0.00', 'dorflex10c.png', 'Divino Remédio'),
(7, 'Novalgina 1g 10 comp. efervescentes', 65, 1, '16.72', '15.49', 'novalgina1g10ce.png', 'P&G'),
(9, 'Allegra Cloridrato de Fexofenadina 120mg', 512, 1, '55.20', '45.20', 'allegracf120mg10c.png', 'Allegra'),
(10, 'Soro Fisiológico cloreto de sódio 0,9% needs 500ml', 300, 1, '7.79', '6.99', 'sorofiscs09needs500ml.png', 'Needs'),
(11, 'Cimegripe 10 capsulas', 512, 1, '8.89', '0.00', 'cimegripe10cap.png', 'EMS'),
(12, 'Buscopan Composto 10ml Gotas', 320, 0, '35.40', '0.00', 'buscopancomp10mlg.png', 'Buscopan'),
(13, 'Neosaldina', 30, 1, '10.29', '0.00', 'neosaldina20c.png', 'EMS'),
(14, 'Allegra Pediátrico 150ml', 90, 1, '35.59', '0.00', 'allegrapediatrico150ml.png', 'Allegra');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_ven`
--

DROP TABLE IF EXISTS `tbl_ven`;
CREATE TABLE `tbl_ven` (
  `cod_ven` int(11) NOT NULL,
  `cod_cli` int(11) NOT NULL,
  `total` decimal(10,2) NOT NULL DEFAULT 0.00,
  `data_venda` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_ven`
--

INSERT INTO `tbl_ven` (`cod_ven`, `cod_cli`, `total`, `data_venda`) VALUES
(6, 2, '6074.40', '2022-11-21 14:24:37'),
(10, 2, '111.80', '2022-11-27 16:57:14'),
(11, 2, '42.00', '2022-11-27 17:06:17'),
(12, 2, '60.50', '2022-11-27 17:58:25'),
(13, 2, '70.00', '2022-11-29 13:37:14'),
(14, 2, '80.97', '2022-11-30 13:28:05');

-- --------------------------------------------------------

--
-- Structure for view `vw_cli`
--
DROP TABLE IF EXISTS `vw_cli`;

DROP VIEW IF EXISTS `vw_cli`;
CREATE VIEW `vw_cli`  AS SELECT `tbl_cli`.`nome` AS `nome`, `tbl_cli`.`cnpj` AS `cnpj`, `tbl_cli`.`rua` AS `rua`, `tbl_cli`.`bairro` AS `bairro`, `tbl_cli`.`numero` AS `numero`, `tbl_cli`.`cidade` AS `cidade`, `tbl_cli`.`uf` AS `uf`, `tbl_cli`.`cep` AS `cep` FROM `tbl_cli` ;

-- --------------------------------------------------------

--
-- Structure for view `vw_desconto`
--
DROP TABLE IF EXISTS `vw_desconto`;

DROP VIEW IF EXISTS `vw_desconto`;
CREATE VIEW `vw_desconto`  AS SELECT `tbl_prod`.`cod_prod` AS `cod_prod`, `tbl_prod`.`nome` AS `nome`, `tbl_prod`.`qtde` AS `qtde`, `tbl_prod`.`disponibilidade` AS `disponibilidade`, `tbl_prod`.`valor_venda` AS `valor_venda`, `tbl_prod`.`valor_temp` AS `valor_temp`, `tbl_prod`.`img_url` AS `img_url`, `tbl_prod`.`fornecedor` AS `fornecedor` FROM `tbl_prod` WHERE `tbl_prod`.`valor_temp` > 0 AND `tbl_prod`.`valor_temp` <> `tbl_prod`.`valor_venda` ;

-- --------------------------------------------------------

--
-- Structure for view `vw_itensvenda`
--
DROP TABLE IF EXISTS `vw_itensvenda`;

DROP VIEW IF EXISTS `vw_itensvenda`;
CREATE VIEW `vw_itensvenda`  AS SELECT `i`.`cod_ven` AS `cod_ven`, `p`.`cod_prod` AS `cod_prod`, `p`.`nome` AS `nome`, `i`.`qtde` AS `qtde`, `i`.`val_venda` AS `val_venda`, `i`.`subtotal` AS `subtotal` FROM (`tbl_prod` `p` join `tbl_itens` `i`) WHERE `p`.`cod_prod` = `i`.`cod_prod` ;

-- --------------------------------------------------------

--
-- Structure for view `vw_maisvendidos`
--
DROP TABLE IF EXISTS `vw_maisvendidos`;

DROP VIEW IF EXISTS `vw_maisvendidos`;
CREATE VIEW `vw_maisvendidos`  AS SELECT `p`.`cod_prod` AS `cod_prod`, `p`.`nome` AS `nome`, `p`.`qtde` AS `qtde`, `p`.`disponibilidade` AS `disponibilidade`, `p`.`valor_venda` AS `valor_venda`, `p`.`valor_temp` AS `valor_temp`, `p`.`img_url` AS `img_url` FROM (`tbl_prod` `p` join `tbl_itens` `i`) WHERE `p`.`cod_prod` = `i`.`cod_prod` GROUP BY `p`.`cod_prod` ORDER BY sum(`i`.`qtde`) ASC ;

-- --------------------------------------------------------

--
-- Structure for view `vw_prod`
--
DROP TABLE IF EXISTS `vw_prod`;

DROP VIEW IF EXISTS `vw_prod`;
CREATE VIEW `vw_prod`  AS SELECT `tbl_prod`.`cod_prod` AS `cod_prod`, `tbl_prod`.`nome` AS `nome`, `tbl_prod`.`qtde` AS `qtde`, `tbl_prod`.`disponibilidade` AS `disponibilidade`, `tbl_prod`.`valor_venda` AS `valor_venda`, `tbl_prod`.`valor_temp` AS `valor_temp`, `tbl_prod`.`img_url` AS `img_url`, `tbl_prod`.`fornecedor` AS `fornecedor` FROM `tbl_prod` ;

-- --------------------------------------------------------

--
-- Structure for view `vw_ven`
--
DROP TABLE IF EXISTS `vw_ven`;

DROP VIEW IF EXISTS `vw_ven`;
CREATE VIEW `vw_ven`  AS SELECT `v`.`cod_ven` AS `cod_ven`, `c`.`nome` AS `nome`, `v`.`data_venda` AS `data_venda`, `v`.`total` AS `total` FROM (`tbl_ven` `v` join `tbl_cli` `c`) WHERE `v`.`cod_cli` = `c`.`cod_cli` ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_cli`
--
ALTER TABLE `tbl_cli`
  ADD PRIMARY KEY (`cod_cli`),
  ADD UNIQUE KEY `cnpj` (`cnpj`);

--
-- Indexes for table `tbl_itens`
--
ALTER TABLE `tbl_itens`
  ADD PRIMARY KEY (`cod_ven`,`cod_prod`),
  ADD KEY `fk_itens_cod_prod` (`cod_prod`);

--
-- Indexes for table `tbl_prod`
--
ALTER TABLE `tbl_prod`
  ADD PRIMARY KEY (`cod_prod`),
  ADD KEY `idx_prod_forn` (`fornecedor`),
  ADD KEY `idx_prod_nome` (`nome`);

--
-- Indexes for table `tbl_ven`
--
ALTER TABLE `tbl_ven`
  ADD PRIMARY KEY (`cod_ven`),
  ADD KEY `fk_ven_cod_cli` (`cod_cli`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_cli`
--
ALTER TABLE `tbl_cli`
  MODIFY `cod_cli` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tbl_prod`
--
ALTER TABLE `tbl_prod`
  MODIFY `cod_prod` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `tbl_ven`
--
ALTER TABLE `tbl_ven`
  MODIFY `cod_ven` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbl_itens`
--
ALTER TABLE `tbl_itens`
  ADD CONSTRAINT `fk_itens_cod_prod` FOREIGN KEY (`cod_prod`) REFERENCES `tbl_prod` (`cod_prod`),
  ADD CONSTRAINT `fk_itens_cod_ven` FOREIGN KEY (`cod_ven`) REFERENCES `tbl_ven` (`cod_ven`);

--
-- Constraints for table `tbl_ven`
--
ALTER TABLE `tbl_ven`
  ADD CONSTRAINT `fk_ven_cod_cli` FOREIGN KEY (`cod_cli`) REFERENCES `tbl_cli` (`cod_cli`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
