-- phpMyAdmin SQL Dump
-- version 4.0.4.2
-- http://www.phpmyadmin.net
--
-- Máquina: localhost
-- Data de Criação: 17-Jun-2019 às 22:09
-- Versão do servidor: 5.6.13
-- versão do PHP: 5.4.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de Dados: `banco_apm`
--
CREATE DATABASE IF NOT EXISTS `banco_apm` DEFAULT CHARACTER SET utf8 COLLATE utf8_bin;
USE `banco_apm`;

-- --------------------------------------------------------

--
-- Estrutura da tabela `aluno`
--

CREATE TABLE IF NOT EXISTS `aluno` (
  `Matricula` int(11) NOT NULL,
  `Aluno` varchar(50) COLLATE utf8_bin NOT NULL,
  `Telefone` varchar(15) COLLATE utf8_bin NOT NULL,
  `Email` varchar(50) COLLATE utf8_bin NOT NULL,
  `Dia` date NOT NULL,
  `APM` double(5,2) DEFAULT NULL,
  PRIMARY KEY (`Matricula`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Extraindo dados da tabela `aluno`
--

INSERT INTO `aluno` (`Matricula`, `Aluno`, `Telefone`, `Email`, `Dia`, `APM`) VALUES
(1, 'LuÃ­s Gustavo dos Santos', '1935619944', 'luis@email.com', '2019-05-05', 40.00);

-- --------------------------------------------------------

--
-- Estrutura da tabela `conta`
--

CREATE TABLE IF NOT EXISTS `conta` (
  `codigo` int(5) NOT NULL AUTO_INCREMENT,
  `usuario` varchar(100) COLLATE utf8_bin NOT NULL,
  `senha` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  `nome` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `tipo` char(1) COLLATE utf8_bin DEFAULT NULL,
  `foto` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  PRIMARY KEY (`codigo`),
  UNIQUE KEY `usuario` (`usuario`),
  KEY `usuario_2` (`usuario`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=10 ;

--
-- Extraindo dados da tabela `conta`
--

INSERT INTO `conta` (`codigo`, `usuario`, `senha`, `nome`, `tipo`, `foto`) VALUES
(8, 'Luis', 'e8d95a51f3af4a3b134bf6bb680a213a', 'Luis Gustavo', 'A', '8fd4af576f412faa069b70e2b52e3f5e.png'),
(9, 'Luis2', 'e8d95a51f3af4a3b134bf6bb680a213a', 'Luis Gustavo', 'M', 'f8289ef33796dc634d4bc78381c788d8.png');

-- --------------------------------------------------------

--
-- Estrutura da tabela `professores`
--

CREATE TABLE IF NOT EXISTS `professores` (
  `Matricula` int(5) NOT NULL,
  `Nome` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `Email` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `Telefone` varchar(15) COLLATE utf8_bin DEFAULT NULL,
  `Celular` varchar(15) COLLATE utf8_bin DEFAULT NULL,
  `Dia` date DEFAULT NULL,
  `Valor` decimal(5,2) NOT NULL,
  PRIMARY KEY (`Matricula`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Extraindo dados da tabela `professores`
--

INSERT INTO `professores` (`Matricula`, `Nome`, `Email`, `Telefone`, `Celular`, `Dia`, `Valor`) VALUES
(8, 'Luis Gustavo dos Santos', '1@1', '1', '1', '2019-05-21', '40.00');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
