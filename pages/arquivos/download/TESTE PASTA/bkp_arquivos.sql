-- --------------------------------------------------------
-- Servidor:                     apppsicoped.mysql.dbaas.com.br
-- Versão do servidor:           5.7.17-13-log - Percona Server (GPL), Release 13, Revision fd33d43
-- OS do Servidor:               Linux
-- HeidiSQL Versão:              10.3.0.5771
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Copiando estrutura para tabela apppsicoped.tbl_arquivo
CREATE TABLE IF NOT EXISTS `tbl_arquivo` (
  `ID_ARQUIVO` int(11) NOT NULL AUTO_INCREMENT,
  `ID_ARQUIVO_PASTA` int(11) DEFAULT NULL,
  `ID_USUARIO` int(11) DEFAULT NULL,
  `NOME_ARQUIVO` varchar(255) DEFAULT NULL,
  `ARQUIVO` varchar(255) DEFAULT NULL,
  `ID_USUARIO_CANCELAMENTO` int(11) DEFAULT NULL,
  `MOTIVO_CANCELAMENTO` varchar(255) DEFAULT NULL,
  `DATA_CANCELAMENTO` date DEFAULT NULL,
  `SITUACAO` enum('CADASTRADO','CANCELADO') DEFAULT NULL,
  `ID_USUARIO_CADASTRO` int(11) DEFAULT NULL,
  `DATA_CADASTRO` datetime DEFAULT NULL,
  PRIMARY KEY (`ID_ARQUIVO`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Copiando dados para a tabela apppsicoped.tbl_arquivo: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `tbl_arquivo` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_arquivo` ENABLE KEYS */;

-- Copiando estrutura para tabela apppsicoped.tbl_arquivo_pasta
CREATE TABLE IF NOT EXISTS `tbl_arquivo_pasta` (
  `ID_ARQUIVO_PASTA` int(11) NOT NULL AUTO_INCREMENT,
  `ID_USUARIO` int(11) DEFAULT NULL,
  `NOME_PASTA` varchar(255) DEFAULT NULL,
  `ID_USUARIO_CANCELAMENTO` int(11) DEFAULT NULL,
  `MOTIVO_CANCELAMENTO` varchar(255) DEFAULT NULL,
  `DATA_CANCELAMENTO` date DEFAULT NULL,
  `SITUACAO` enum('CADASTRADO','CANCELADO') DEFAULT NULL,
  `ID_USUARIO_CADASTRO` int(11) DEFAULT NULL,
  `DATA_CADASTRO` datetime DEFAULT NULL,
  PRIMARY KEY (`ID_ARQUIVO_PASTA`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Copiando dados para a tabela apppsicoped.tbl_arquivo_pasta: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `tbl_arquivo_pasta` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_arquivo_pasta` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
