-- --------------------------------------------------------
-- Servidor:                     127.0.0.1
-- Versão do servidor:           10.4.22-MariaDB - mariadb.org binary distribution
-- OS do Servidor:               Win64
-- HeidiSQL Versão:              12.4.0.6659
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Copiando estrutura para tabela test.tb_assinaturas
CREATE TABLE IF NOT EXISTS `tb_assinaturas` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(50) DEFAULT NULL,
  `nome` varchar(50) NOT NULL,
  `cargo` varchar(50) NOT NULL,
  `whatsapp` varchar(50) DEFAULT NULL,
  `telefone` varchar(50) DEFAULT NULL,
  `telefone2` varchar(50) DEFAULT NULL,
  `empresa` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=146 DEFAULT CHARSET=latin1;

-- Copiando dados para a tabela test.tb_assinaturas: ~12 rows (aproximadamente)
INSERT INTO `tb_assinaturas` (`id`, `email`, `nome`, `cargo`, `whatsapp`, `telefone`, `telefone2`, `empresa`) VALUES
	(1, 'marcelo@generic.com', 'Marcelo Santos', 'Diretor de T.I', '', '(11) 2727-2727', '', 'Generic'),
	(2, 'alex@generic.com', 'Alex de Souza', 'Dpto. Financeiro', '', '', '', 'Generic'),
	(3, 'luis@generic.com', 'Luis Garcia', 'Dpto. de T.I', '(11) 97519-5151', '', '', 'Generic'),
	(4, 'joaofreitas@generic.com', 'João Freitas', 'Dpto de T.I', '(11) 97519-5151', '', '', 'Generic'),
	(5, 'gabriel@generic.com', 'Gabriel da Silva', 'Dpto. de T.I', '(11) 97519-5151', '', '', 'Generic'),
	(6, 'lucio@generic.com', 'Lucio de Freitas', 'Dpto. de T.I', '(11) 97519-5151', '', '', 'Generic'),
	(7, 'guilherme@generic.com', 'Guilherme Alves', 'Dpto de T.I', '(11) 97519-5151', '', '', 'Generic'),
	(8, 'camila@generic.com', 'Camila Gomes', 'Recursos Humanos', '(11) 97777-7777', '', '', 'Generic'),
	(9, 'cleber@generic.com', 'Cléber Machado', 'Recursos Humanos', '(11) 97777-7777', '', '', 'Generic'),
	(10, 'bianca@generic.com', 'Bianca Santos', 'Dpto. Comercial', '(11) 99999-9999', '', '', 'Generic'),
	(11, 'joana@generic.com', 'Joana Dias', 'Dpto. Comercial', '(11) 99999-9999', '', '', 'Generic'),
	(12, 'sofia@generic.com.br', 'Sofia Pereira Silva', 'Dpto. Comercial', '(11) 99999-9999', '', '', 'Generic');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
