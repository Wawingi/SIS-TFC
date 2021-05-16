-- --------------------------------------------------------
-- Servidor:                     localhost
-- Versão do servidor:           5.7.24 - MySQL Community Server (GPL)
-- OS do Servidor:               Win64
-- HeidiSQL Versão:              10.2.0.5599
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Copiando estrutura do banco de dados para sis_tfc
CREATE DATABASE IF NOT EXISTS `sis_tfc` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `sis_tfc`;

-- Copiando estrutura para tabela sis_tfc.area_aplicacao
CREATE TABLE IF NOT EXISTS `area_aplicacao` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nome` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `visibilidade` int(1) NOT NULL,
  `id_departamento` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `area_aplicacao_id_faculdade_foreign` (`id_departamento`),
  CONSTRAINT `area_aplicacao_id_faculdade_foreign` FOREIGN KEY (`id_departamento`) REFERENCES `departamento` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Copiando dados para a tabela sis_tfc.area_aplicacao: ~20 rows (aproximadamente)
/*!40000 ALTER TABLE `area_aplicacao` DISABLE KEYS */;
INSERT INTO `area_aplicacao` (`id`, `nome`, `visibilidade`, `id_departamento`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(1, 'Investigação Científica', 1, 10, '2020-04-19 04:00:00', '2020-04-19 04:00:00', NULL),
	(3, 'Estudo Ambiental', 1, 7, '2020-04-19 04:00:00', '2020-04-19 04:00:00', NULL),
	(4, 'Investigação Ambiental', 1, 7, '2020-04-19 04:00:00', '2020-04-19 04:00:00', NULL),
	(5, 'Empreendedorismo e Inovação', 1, 10, '2020-04-21 04:00:00', '2020-04-21 04:00:00', NULL),
	(6, 'Inovação Tecnológica', 1, 10, '2020-04-26 17:24:29', '2020-05-01 21:35:25', NULL),
	(9, 'Análise de dados', 1, 10, '2020-05-01 20:16:55', '2020-08-01 17:19:38', NULL),
	(10, 'Saúde', 1, 10, '2020-05-16 15:12:50', '2020-07-08 21:14:37', '2020-07-08 21:14:37'),
	(11, 'Prospecção Sísmica', 1, 15, '2020-05-24 17:28:22', '2020-07-08 20:39:52', '2020-07-08 20:39:52'),
	(12, 'Utilidade Pública', 1, 10, '2020-06-12 01:13:46', '2020-07-08 21:25:34', '2020-07-08 21:25:34'),
	(13, 'Internet das Coisas', 1, 10, '2020-07-08 19:53:09', '2020-07-08 21:15:22', NULL),
	(14, 'Redes', 1, 10, '2020-07-08 20:08:30', '2020-07-08 21:15:37', '2020-07-08 21:15:37'),
	(15, 'Geotecnia', 1, 15, '2020-07-08 20:12:30', '2020-07-08 20:12:30', NULL),
	(16, 'Diagrafias', 1, 15, '2020-07-08 20:39:21', '2020-07-08 20:39:21', NULL),
	(17, 'Matemática Computacional', 1, 11, '2020-07-24 00:29:37', '2020-07-24 00:29:37', NULL),
	(18, 'Matemática Aplicada', 1, 11, '2020-07-24 00:30:01', '2020-07-24 00:30:01', NULL),
	(19, 'TESTE', 1, 11, '2020-07-24 00:43:13', '2020-07-24 00:50:00', '2020-07-24 00:50:00'),
	(20, 'Dalton Cabeia', 1, 11, '2020-07-24 00:46:19', '2020-07-24 00:46:42', '2020-07-24 00:46:42'),
	(21, 'TESTE', 1, 11, '2020-07-24 00:47:23', '2020-07-24 00:50:13', '2020-07-24 00:50:13'),
	(22, 'TESTE', 1, 11, '2020-07-24 00:50:25', '2020-07-24 00:50:25', NULL),
	(23, 'TESTE', 1, 11, '2020-07-24 00:58:17', '2020-07-24 00:58:17', NULL);
/*!40000 ALTER TABLE `area_aplicacao` ENABLE KEYS */;

-- Copiando estrutura para tabela sis_tfc.avaliacao_sugestao
CREATE TABLE IF NOT EXISTS `avaliacao_sugestao` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `descricao` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_sugestao` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `avaliacao_sugestao_id_sugestao_foreign` (`id_sugestao`),
  CONSTRAINT `avaliacao_sugestao_id_sugestao_foreign` FOREIGN KEY (`id_sugestao`) REFERENCES `sugestao` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Copiando dados para a tabela sis_tfc.avaliacao_sugestao: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `avaliacao_sugestao` DISABLE KEYS */;
/*!40000 ALTER TABLE `avaliacao_sugestao` ENABLE KEYS */;

-- Copiando estrutura para tabela sis_tfc.curso
CREATE TABLE IF NOT EXISTS `curso` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nome` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_departamento` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `curso_nome_unique` (`nome`),
  KEY `curso_id_departamento_foreign` (`id_departamento`),
  CONSTRAINT `curso_id_departamento_foreign` FOREIGN KEY (`id_departamento`) REFERENCES `departamento` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Copiando dados para a tabela sis_tfc.curso: ~17 rows (aproximadamente)
/*!40000 ALTER TABLE `curso` DISABLE KEYS */;
INSERT INTO `curso` (`id`, `nome`, `id_departamento`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(3, 'Contabilidade e Auditoria', 4, '2019-12-20 03:00:00', '2019-12-20 03:00:00', NULL),
	(5, 'Contabilidade Fiscal Angolano', 4, '2019-12-24 03:00:00', '2019-12-24 03:00:00', NULL),
	(6, 'Sistemas de Informação', 10, '2020-02-26 04:00:00', '2020-02-26 04:00:45', NULL),
	(7, 'Ciências da Computação', 10, '2020-02-26 04:00:00', '2020-02-26 04:00:00', NULL),
	(8, 'Geofísica', 15, '2020-03-01 02:11:23', '2020-03-01 02:11:23', NULL),
	(9, 'Meteorologia', 15, '2020-03-01 02:12:25', '2020-03-01 02:12:25', NULL),
	(11, 'Matemática', 11, '2020-03-01 02:23:34', '2020-03-01 02:23:34', NULL),
	(14, 'Quimica Orgânica', 17, '2020-03-02 01:07:59', '2020-03-02 01:07:59', NULL),
	(17, 'Biologia', 7, '2020-03-04 23:55:57', '2020-08-01 19:52:17', '2020-08-01 19:52:17'),
	(18, 'Analise de Sistemas', 10, '2020-03-11 23:54:35', '2020-03-11 23:54:35', NULL),
	(19, 'BioInformática', 7, '2020-04-15 20:20:21', '2020-07-10 19:45:27', '2020-07-10 19:45:27'),
	(20, 'Agostinho Xavier', 15, '2020-04-17 00:48:09', '2020-07-24 00:29:05', '2020-07-24 00:29:05'),
	(21, 'TESTE', 13, '2020-06-26 00:18:20', '2020-06-26 00:18:20', NULL),
	(22, 'aasasas', 13, '2020-06-26 00:20:16', '2020-06-26 00:20:16', NULL),
	(23, 'Matemática Computacional', 11, '2020-06-30 19:17:32', '2020-06-30 19:17:32', NULL),
	(24, 'Botânica', 7, '2020-07-10 15:55:57', '2020-07-10 15:55:57', NULL),
	(25, 'Nutrição', 7, '2020-07-10 15:59:29', '2020-07-10 19:45:45', NULL),
	(26, 'Microbiologia', 7, '2020-12-07 00:30:54', '2020-12-07 00:30:54', NULL);
/*!40000 ALTER TABLE `curso` ENABLE KEYS */;

-- Copiando estrutura para tabela sis_tfc.departamento
CREATE TABLE IF NOT EXISTS `departamento` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nome` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telefone` int(11) NOT NULL,
  `tipo` int(1) NOT NULL,
  `id_faculdade` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `departamento_nome_unique` (`nome`),
  UNIQUE KEY `telefone` (`telefone`),
  UNIQUE KEY `email` (`email`),
  KEY `departamento_id_faculdade_foreign` (`id_faculdade`),
  CONSTRAINT `departamento_id_faculdade_foreign` FOREIGN KEY (`id_faculdade`) REFERENCES `faculdade` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Copiando dados para a tabela sis_tfc.departamento: ~13 rows (aproximadamente)
/*!40000 ALTER TABLE `departamento` DISABLE KEYS */;
INSERT INTO `departamento` (`id`, `nome`, `email`, `telefone`, `tipo`, `id_faculdade`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(1, 'Secretariado e Informação e Documentação', 'dei.info@fc.uan.ao', 925802655, 1, 1, '2019-12-19 02:00:00', '2020-07-15 16:27:26', NULL),
	(4, 'Contabilidade e Auditoria', 'contabilidade@fceconomia.ao', 940111111, 2, 3, '2019-12-19 03:00:00', '2019-12-19 03:00:00', NULL),
	(6, 'Decanato', 'economia@uan.ao', 944444444, 1, 3, '2019-12-24 03:00:00', '2019-12-24 03:00:00', NULL),
	(7, 'Biologia', 'dei.biologia@fcuan.ao', 911333333, 2, 1, '2019-12-29 16:40:12', '2019-12-29 16:40:12', NULL),
	(10, 'Ciências da Computação', 'dei.cc@fcuan.co.ao', 945565355, 2, 1, '2020-02-23 17:54:18', '2020-02-23 17:54:18', NULL),
	(11, 'Matemática', 'dei.matematica@fcuan.co.ao', 945656777, 2, 1, '2020-02-23 18:02:26', '2020-02-23 18:02:26', NULL),
	(13, 'Física', 'dei.fisica@fcuan.ao', 944344333, 2, 1, '2020-02-23 18:21:37', '2020-02-23 18:21:37', NULL),
	(15, 'Geofísica', 'dei.fisica@fcuan.co.ao', 946567890, 2, 1, '2020-02-23 18:51:31', '2020-02-23 18:51:31', NULL),
	(16, 'Associação dos Estudantes AEFC', 'aefc@fcuan.co.ao', 915986452, 1, 1, '2020-03-01 00:04:29', '2020-03-01 00:04:29', NULL),
	(17, 'Quimica', 'dei.quimica@fcuan.co.ao', 999877890, 2, 1, '2020-03-02 00:53:17', '2020-07-10 14:52:28', NULL),
	(18, 'Geologia', 'dei.geologia@fcuan.co.ao', 987764355, 2, 1, '2020-03-03 23:46:17', '2020-03-03 23:46:17', NULL),
	(22, 'Engenharia Geográfica', 'eng.geografica@fcuan.ao', 947777777, 2, 1, '2020-07-09 22:47:46', '2020-07-09 22:47:46', NULL),
	(25, 'Departamento de Assuntos Acadêmicos', 'dac@fcuan.ao', 940988990, 1, 1, '2020-08-03 16:15:32', '2020-08-03 16:15:32', NULL),
	(26, 'Astrologia', 'dei.astrologia@fcuan.ao', 918374600, 2, 1, '2021-02-22 20:18:32', '2021-02-22 20:18:32', NULL);
/*!40000 ALTER TABLE `departamento` ENABLE KEYS */;

-- Copiando estrutura para tabela sis_tfc.docente
CREATE TABLE IF NOT EXISTS `docente` (
  `id_pessoa` int(10) unsigned NOT NULL,
  `nivel_academico` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `privilegio` int(1) NOT NULL DEFAULT '0',
  KEY `docente_id_pessoa_foreign` (`id_pessoa`),
  CONSTRAINT `docente_id_pessoa_foreign` FOREIGN KEY (`id_pessoa`) REFERENCES `pessoa` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Copiando dados para a tabela sis_tfc.docente: ~19 rows (aproximadamente)
/*!40000 ALTER TABLE `docente` DISABLE KEYS */;
INSERT INTO `docente` (`id_pessoa`, `nivel_academico`, `created_at`, `updated_at`, `privilegio`) VALUES
	(10, 'Professor Auxiliar', '2019-12-19 03:00:00', '2019-12-19 03:00:00', 0),
	(59, 'Professor Assistente Estagiário', '2020-03-06 01:13:27', '2020-03-06 01:13:27', 0),
	(58, 'Professor Titular', '2020-03-05 04:00:00', '2020-03-05 04:00:00', 1),
	(61, 'Professor Assistente', '2020-03-06 01:39:19', '2020-03-06 01:39:19', 0),
	(66, 'Professor Assistente', '2020-04-15 18:37:43', '2020-04-15 18:37:43', 0),
	(69, 'Professor Assistente', '2020-04-17 23:44:27', '2020-04-17 23:44:27', 0),
	(74, 'Professor Assistente', NULL, NULL, 1),
	(77, 'Professor Assistente', '2020-05-24 15:28:14', '2020-05-24 15:28:14', 0),
	(78, 'Professor Auxiliar', '2020-05-24 15:39:55', '2020-05-24 15:39:55', 0),
	(82, 'Professor Assistente', '2020-05-24 17:05:34', '2020-05-24 17:05:34', 0),
	(83, 'Professor Auxiliar', '2020-05-24 17:16:52', '2020-05-24 17:16:52', 0),
	(84, 'Professor Assistente Estagiário', '2020-05-24 17:26:45', '2020-05-24 17:26:45', 0),
	(85, 'Professor Assistente', '2020-05-24 17:34:37', '2020-05-24 17:34:37', 0),
	(88, 'Professor Assistente Estagiário', '2020-05-24 18:16:19', '2020-05-24 18:16:19', 0),
	(91, 'Professor Titular', '2020-05-24 19:26:26', '2020-05-24 19:26:26', 1),
	(96, 'Professor Titular', '2020-07-16 00:29:41', '2020-07-16 00:29:41', 1),
	(103, 'Professor Titular', '2020-07-24 00:25:05', '2020-07-24 00:25:05', 0),
	(104, 'Professor Titular', '2020-08-01 17:10:05', '2020-08-01 17:10:05', 1),
	(105, 'Professor Catedrático', '2020-08-01 19:24:43', '2020-08-01 19:24:43', 1);
/*!40000 ALTER TABLE `docente` ENABLE KEYS */;

-- Copiando estrutura para tabela sis_tfc.envolvente
CREATE TABLE IF NOT EXISTS `envolvente` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_trabalho` int(10) unsigned NOT NULL,
  `id_estudante` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `envolvente_id_trabalho_foreign` (`id_trabalho`),
  KEY `envolvente_id_estudante_foreign` (`id_estudante`),
  CONSTRAINT `envolvente_id_estudante_foreign` FOREIGN KEY (`id_estudante`) REFERENCES `estudante` (`id_pessoa`) ON DELETE CASCADE,
  CONSTRAINT `envolvente_id_trabalho_foreign` FOREIGN KEY (`id_trabalho`) REFERENCES `trabalho` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Copiando dados para a tabela sis_tfc.envolvente: ~3 rows (aproximadamente)
/*!40000 ALTER TABLE `envolvente` DISABLE KEYS */;
INSERT INTO `envolvente` (`id`, `id_trabalho`, `id_estudante`, `created_at`, `updated_at`) VALUES
	(10, 160, 62, NULL, NULL),
	(11, 161, 67, NULL, NULL),
	(12, 161, 99, NULL, NULL);
/*!40000 ALTER TABLE `envolvente` ENABLE KEYS */;

-- Copiando estrutura para tabela sis_tfc.estudante
CREATE TABLE IF NOT EXISTS `estudante` (
  `id_pessoa` int(10) unsigned NOT NULL,
  `numero_mecanografico` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `periodo` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_curso` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  KEY `estudante_id_pessoa_foreign` (`id_pessoa`),
  KEY `estudante_id_curso_foreign` (`id_curso`),
  CONSTRAINT `estudante_id_curso_foreign` FOREIGN KEY (`id_curso`) REFERENCES `curso` (`id`) ON DELETE CASCADE,
  CONSTRAINT `estudante_id_pessoa_foreign` FOREIGN KEY (`id_pessoa`) REFERENCES `pessoa` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Copiando dados para a tabela sis_tfc.estudante: ~13 rows (aproximadamente)
/*!40000 ALTER TABLE `estudante` DISABLE KEYS */;
INSERT INTO `estudante` (`id_pessoa`, `numero_mecanografico`, `periodo`, `id_curso`, `created_at`, `updated_at`) VALUES
	(60, '0972016', 'Diurno', 3, '2020-03-06 01:15:34', '2020-03-06 01:15:34'),
	(62, '5677777', 'Diurno', 7, '2020-03-06 01:41:15', '2020-03-06 01:41:15'),
	(67, '161195', 'Diurno', 18, '2020-04-15 18:40:00', '2020-04-15 18:40:00'),
	(70, '130294', 'Diurno', 7, '2020-04-17 23:52:26', '2020-04-17 23:52:26'),
	(75, '0991', 'Diurno', 8, '2020-05-24 00:25:49', '2020-05-24 00:25:49'),
	(76, '4991', 'Diurno', 9, '2020-05-24 00:28:00', '2020-05-24 00:28:00'),
	(79, '1997', 'Diurno', 7, '2020-05-24 15:43:20', '2020-05-24 15:43:20'),
	(80, '968542', 'Diurno', 7, '2020-05-24 15:45:17', '2020-05-24 15:45:17'),
	(81, '104587', 'Diurno', 7, '2020-05-24 15:55:25', '2020-05-24 15:55:25'),
	(93, '102156', 'Diurno', 6, '2020-06-23 22:56:40', '2020-06-23 22:56:40'),
	(94, '19999', 'Diurno', 18, '2020-06-28 16:41:30', '2020-06-28 16:41:30'),
	(99, '1041995', 'Diurno', 7, '2020-07-16 01:39:05', '2020-07-16 01:39:05'),
	(101, '210794', 'Diurno', 9, '2020-07-23 23:42:05', '2020-07-23 23:42:05');
/*!40000 ALTER TABLE `estudante` ENABLE KEYS */;

-- Copiando estrutura para tabela sis_tfc.estudante_sugestao
CREATE TABLE IF NOT EXISTS `estudante_sugestao` (
  `id_estudante` int(10) unsigned NOT NULL,
  `id_sugestao` int(10) unsigned NOT NULL,
  `estado` int(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  KEY `estudante_sugestao_id_estudante_foreign` (`id_estudante`),
  KEY `estudante_sugestao_id_sugestao_foreign` (`id_sugestao`),
  CONSTRAINT `estudante_sugestao_id_estudante_foreign` FOREIGN KEY (`id_estudante`) REFERENCES `estudante` (`id_pessoa`) ON DELETE CASCADE,
  CONSTRAINT `estudante_sugestao_id_sugestao_foreign` FOREIGN KEY (`id_sugestao`) REFERENCES `sugestao` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Copiando dados para a tabela sis_tfc.estudante_sugestao: ~3 rows (aproximadamente)
/*!40000 ALTER TABLE `estudante_sugestao` DISABLE KEYS */;
INSERT INTO `estudante_sugestao` (`id_estudante`, `id_sugestao`, `estado`, `created_at`, `updated_at`) VALUES
	(62, 172, 1, NULL, NULL),
	(67, 173, 1, NULL, NULL),
	(99, 173, 1, NULL, NULL),
	(94, 174, 1, NULL, NULL);
/*!40000 ALTER TABLE `estudante_sugestao` ENABLE KEYS */;

-- Copiando estrutura para tabela sis_tfc.faculdade
CREATE TABLE IF NOT EXISTS `faculdade` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nome` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `decano` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telefone` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `faculdade_nome_unique` (`nome`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Copiando dados para a tabela sis_tfc.faculdade: ~3 rows (aproximadamente)
/*!40000 ALTER TABLE `faculdade` DISABLE KEYS */;
INSERT INTO `faculdade` (`id`, `nome`, `decano`, `telefone`, `created_at`, `updated_at`) VALUES
	(1, 'CIÊNCIAS', 'Suzanete Nunes da Costa', 999999999, '2019-09-24 04:00:00', '2019-09-22 04:00:00'),
	(2, 'ENGENHARIA', 'Alice Fortunato', 999333333, '2019-12-01 03:00:00', '2019-12-01 03:00:00'),
	(3, 'ECONOMIA', 'Redento Maia', 999444444, '2019-12-02 03:00:00', '2019-12-02 03:00:00');
/*!40000 ALTER TABLE `faculdade` ENABLE KEYS */;

-- Copiando estrutura para tabela sis_tfc.funcionario
CREATE TABLE IF NOT EXISTS `funcionario` (
  `id_pessoa` int(10) unsigned NOT NULL,
  `funcao` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `privilegio` int(11) NOT NULL DEFAULT '0',
  KEY `funcionario_id_pessoa_foreign` (`id_pessoa`),
  CONSTRAINT `funcionario_id_pessoa_foreign` FOREIGN KEY (`id_pessoa`) REFERENCES `pessoa` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Copiando dados para a tabela sis_tfc.funcionario: ~7 rows (aproximadamente)
/*!40000 ALTER TABLE `funcionario` DISABLE KEYS */;
INSERT INTO `funcionario` (`id_pessoa`, `funcao`, `created_at`, `updated_at`, `privilegio`) VALUES
	(1, 'Secretário de Informação', '2019-12-19 02:00:00', '2019-12-19 02:00:00', 0),
	(50, 'Decano', '2019-12-24 03:00:00', '2019-12-24 03:00:00', 0),
	(57, 'Secretário Geral da AEFC', '2020-03-06 00:42:11', '2020-03-06 00:42:11', 1),
	(72, 'Secretário de Informação e Comunicação', '2020-04-18 16:12:54', '2020-04-18 16:12:54', 1),
	(89, 'Secretário Adjunto', '2020-05-24 18:47:25', '2020-05-24 18:47:25', 0),
	(107, 'professor', '2020-08-01 19:49:13', '2020-08-01 19:49:13', 0),
	(110, 'Chefe de Deparamento', '2020-08-03 17:03:37', '2020-08-03 17:03:37', 1);
/*!40000 ALTER TABLE `funcionario` ENABLE KEYS */;

-- Copiando estrutura para tabela sis_tfc.item
CREATE TABLE IF NOT EXISTS `item` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `titulo` smallint(1) NOT NULL DEFAULT '0',
  `anexo` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_trabalho` int(10) unsigned NOT NULL,
  `avaliacao` smallint(6) DEFAULT NULL,
  `comentario` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `item_id_trabalho_foreign` (`id_trabalho`),
  CONSTRAINT `item_id_trabalho_foreign` FOREIGN KEY (`id_trabalho`) REFERENCES `trabalho` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=57 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Copiando dados para a tabela sis_tfc.item: ~2 rows (aproximadamente)
/*!40000 ALTER TABLE `item` DISABLE KEYS */;
INSERT INTO `item` (`id`, `titulo`, `anexo`, `id_trabalho`, `avaliacao`, `comentario`, `created_at`, `updated_at`) VALUES
	(54, 2, 'KULONGA_160_TEXTUAL.pdf', 160, 1, NULL, '2021-02-20 19:26:48', '2021-03-23 15:22:31'),
	(55, 1, 'KULONGA_160_PRETEXTUAL.pdf', 160, 0, 'a capa não possui insignia', '2021-02-20 20:53:57', '2021-04-22 13:24:51'),
	(56, 3, 'KULONGA_160_POSTEXTUAL.pdf', 160, 0, 'A conclusão está muito confusa.', '2021-03-23 15:21:33', '2021-03-28 16:47:32');
/*!40000 ALTER TABLE `item` ENABLE KEYS */;

-- Copiando estrutura para tabela sis_tfc.migrations
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Copiando dados para a tabela sis_tfc.migrations: ~30 rows (aproximadamente)
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(1, '2019_09_22_160323_create_pessoa_table', 1),
	(2, '2019_11_21_210013_create_faculdade_table', 1),
	(3, '2014_10_12_000000_create_users_table', 2),
	(4, '2019_11_24_122931_create_pessoafaculadade_table', 2),
	(5, '2014_10_12_100000_create_password_resets_table', 3),
	(6, '2019_09_22_163045_create_funcionario_faculdade_table', 3),
	(10, '2019_12_07_224104_create_orientador_table', 6),
	(11, '2019_11_30_214923_create_funcionario_departamento', 7),
	(13, '2019_12_08_211503_create_estudante_table', 9),
	(14, '2019_12_18_213503_create_docente_table', 10),
	(15, '2019_12_18_213829_create_funcionario_table', 10),
	(17, '2019_11_30_213504_create_departamento_table', 12),
	(18, '2019_12_08_205551_create_curso_table', 13),
	(19, '2019_12_18_221339_create_pessoa_departamento_table', 14),
	(21, '2019_12_18_214020_create_estudante_table', 15),
	(22, '2020_01_26_203424_create_roles_table', 16),
	(23, '2020_01_26_204019_create_permissions_table', 16),
	(24, '2020_04_19_175753_create_area_aplicacao_table', 17),
	(25, '2020_04_20_105723_create_sugestao_table', 18),
	(26, '2020_05_01_160407_add_softdelete_to_area_aplicacao_table', 19),
	(27, '2020_05_02_205441_create_estudante_sugestao_table', 20),
	(28, '2020_05_24_160521_add_privilegio_to_docente_table', 21),
	(29, '2020_06_27_122959_create__avaliacao_sugestao_table', 22),
	(30, '2020_10_02_201903_create_trabalho_table', 23),
	(31, '2020_10_05_204722_create_sugestao_departamento_table', 24),
	(32, '2020_10_21_211605_create_trabalho_departamento_table', 25),
	(33, '2020_11_21_195508_create_envolvente_table', 26),
	(34, '2020_12_28_214602_create_item_table', 27),
	(35, '2021_02_21_190114_create_predefesa_table', 28),
	(38, '2021_03_28_172119_create_nota_informativa_table', 29);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;

-- Copiando estrutura para tabela sis_tfc.nota_informativa
CREATE TABLE IF NOT EXISTS `nota_informativa` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `local` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `presidente` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `secretario` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `vogal_1` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `vogal_2` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_trabalho` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `nota_informativa_id_trabalho_foreign` (`id_trabalho`),
  CONSTRAINT `nota_informativa_id_trabalho_foreign` FOREIGN KEY (`id_trabalho`) REFERENCES `trabalho` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Copiando dados para a tabela sis_tfc.nota_informativa: ~2 rows (aproximadamente)
/*!40000 ALTER TABLE `nota_informativa` DISABLE KEYS */;
INSERT INTO `nota_informativa` (`id`, `local`, `presidente`, `secretario`, `vogal_1`, `vogal_2`, `id_trabalho`, `created_at`, `updated_at`) VALUES
	(1, 'Camama - Campus Universitário', 'Mateus Padoca', 'Timoteo Yenga', 'Dikiefue Fabiano', 'Vicente Lopes', 160, '2021-05-17 20:30:00', '2021-05-15 19:30:43');
/*!40000 ALTER TABLE `nota_informativa` ENABLE KEYS */;

-- Copiando estrutura para tabela sis_tfc.password_resets
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Copiando dados para a tabela sis_tfc.password_resets: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;

-- Copiando estrutura para tabela sis_tfc.permissions
CREATE TABLE IF NOT EXISTS `permissions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nome` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `desc` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tipo` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Copiando dados para a tabela sis_tfc.permissions: ~11 rows (aproximadamente)
/*!40000 ALTER TABLE `permissions` DISABLE KEYS */;
INSERT INTO `permissions` (`id`, `nome`, `desc`, `tipo`, `created_at`, `updated_at`) VALUES
	(1, 'criar_user', 'Criar user', 12, NULL, NULL),
	(2, 'visualizar_user', 'Visualizar user', 12, NULL, NULL),
	(3, 'editar_user', 'Editar user', 12, NULL, NULL),
	(4, 'apagar_user', 'Apagar user', 12, NULL, NULL),
	(5, 'visualizar_proposta', 'ver proposta ou sugestão geral', 23, NULL, NULL),
	(6, 'visualizar_tutorandos', 'ver os tutorandos de um orientador', 2, NULL, NULL),
	(7, 'visualizar_convite', 'ver o convite para trabalhar num tema', 3, NULL, NULL),
	(8, 'visualizar_departamento', 'ver os departamentos de uma faculdade', 1, NULL, NULL),
	(9, 'aprovar_rejeitar_proposta', 'Aprovar ou Rejeitar a proposta', 2, NULL, NULL),
	(10, 'menu_sugestao', 'Configurar a Sugestão', 2, NULL, NULL),
	(11, 'visualizar_minha_prop_sug', 'Ver apenas minhas propostas e sugestões', 2, NULL, NULL);
/*!40000 ALTER TABLE `permissions` ENABLE KEYS */;

-- Copiando estrutura para tabela sis_tfc.permission_role
CREATE TABLE IF NOT EXISTS `permission_role` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `permission_id` int(10) unsigned NOT NULL,
  `role_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `permission_role_id_permission_foreign` (`permission_id`),
  KEY `permission_role_id_role_foreign` (`role_id`),
  CONSTRAINT `permission_role_id_permission_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  CONSTRAINT `permission_role_id_role_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Copiando dados para a tabela sis_tfc.permission_role: ~19 rows (aproximadamente)
/*!40000 ALTER TABLE `permission_role` DISABLE KEYS */;
INSERT INTO `permission_role` (`id`, `permission_id`, `role_id`) VALUES
	(1, 1, 1),
	(2, 2, 2),
	(3, 2, 1),
	(4, 1, 4),
	(5, 5, 3),
	(6, 5, 4),
	(7, 5, 5),
	(9, 6, 4),
	(10, 7, 5),
	(11, 8, 1),
	(12, 8, 2),
	(13, 9, 4),
	(16, 6, 3),
	(17, 2, 4),
	(18, 3, 1),
	(19, 4, 1),
	(20, 10, 4),
	(22, 11, 3),
	(23, 11, 4);
/*!40000 ALTER TABLE `permission_role` ENABLE KEYS */;

-- Copiando estrutura para tabela sis_tfc.pessoa
CREATE TABLE IF NOT EXISTS `pessoa` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nome` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `data_nascimento` date NOT NULL,
  `telefone` int(11) NOT NULL,
  `bi` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `genero` int(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `pessoa_telefone_unique` (`telefone`),
  UNIQUE KEY `pessoa_bi_unique` (`bi`)
) ENGINE=InnoDB AUTO_INCREMENT=111 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Copiando dados para a tabela sis_tfc.pessoa: ~39 rows (aproximadamente)
/*!40000 ALTER TABLE `pessoa` DISABLE KEYS */;
INSERT INTO `pessoa` (`id`, `nome`, `data_nascimento`, `telefone`, `bi`, `genero`, `created_at`, `updated_at`) VALUES
	(1, 'Wawingi Sebastiao', '1993-12-25', 925802655, '003246621BO030', 1, '2019-09-24 04:00:00', '2019-09-24 04:00:00'),
	(10, 'Eloice Marta', '1993-04-12', 912564355, '009845678LA025', 1, '2019-12-02 03:00:00', '2019-12-02 03:00:00'),
	(50, 'Redento Maya', '1962-12-02', 996565656, '0034578ME056', 1, '2019-09-24 04:00:00', '2019-12-24 03:00:00'),
	(57, 'Eunice João Julio Gastão', '1984-05-15', 912434343, '00873674LA035', 1, NULL, NULL),
	(58, 'Mateus Padoca Calado', '1972-03-05', 923122198, '008934577LA072', 1, '2020-03-05 04:00:00', '2020-03-05 04:00:00'),
	(59, 'Kianguebeni Manuel Gonga', '1990-02-04', 990122112, '0098734LA090', 2, NULL, NULL),
	(60, 'Diambi Elisabeth', '1997-05-07', 998823456, '00985673LA097', 2, NULL, NULL),
	(61, 'Amândio de Jesus Almada', '1989-12-12', 991888999, '00158765LA089', 1, NULL, NULL),
	(62, 'Dalton Cabeia', '1997-01-25', 990299016, '007635397LS097', 1, NULL, NULL),
	(66, 'Lufialuiso Sampaio Velho Jose', '1987-11-12', 923941675, '0012345678UE087', 1, NULL, NULL),
	(67, 'Juliana Pedro Dias Acordeon', '1995-11-16', 924231822, '0016113324LA095', 2, NULL, NULL),
	(69, 'Vicente Lopes', '1967-07-19', 926981172, '000456789UE067', 1, NULL, NULL),
	(70, 'Sediamuana Utuca Congolo', '1994-02-13', 945600079, '00456789LA094', 1, NULL, NULL),
	(72, 'Loy Gonçalves Inancio', '1980-02-25', 993975656, '003234567LA088', 1, NULL, NULL),
	(74, 'António GerónimoBYT', '1977-05-23', 923057719, '001977055ME043', 1, NULL, NULL),
	(75, 'Helias Samuel Quintas', '1990-11-12', 912467434, '001211195LA090', 1, NULL, NULL),
	(76, 'Leocadia Santana', '1994-03-11', 998653947, '001103199BA094', 2, NULL, NULL),
	(77, 'Dikiefu Fabiano', '1971-01-27', 914310223, '000087662KN030', 1, NULL, NULL),
	(78, 'Darlines Sanchez Muñoz', '1986-01-20', 990767750, '004585459CA032', 2, NULL, NULL),
	(79, 'Lucas Catumbi', '2000-10-15', 916257865, '004847573ME042', 1, NULL, NULL),
	(80, 'kiala manzambi', '2004-05-20', 914587965, '004875874ZE032', 1, NULL, NULL),
	(81, 'Fumadeso Lunfuakenda Ndembisala', '1999-01-20', 913587965, '004578546ZE042', 2, NULL, NULL),
	(82, 'Suamino Joao', '1988-10-15', 912007414, '005885897LA042', 1, NULL, NULL),
	(83, 'Jose Miranda', '1972-02-26', 921221123, '004847538La042', 1, NULL, NULL),
	(84, 'Teofili Molumba', '1972-05-24', 925252525, '004849658LA042', 1, NULL, NULL),
	(85, 'Antonio Messias', '1988-07-27', 918677289, '001486772HO042', 1, NULL, NULL),
	(88, 'Enoque Benjamin', '1993-03-24', 922556633, '001274859LA042', 1, NULL, NULL),
	(89, 'Alfredo Chitunda', '1991-08-12', 912081991, '001991081LA091', 1, NULL, NULL),
	(91, 'Maria de Natividade', '1972-08-12', 923721908, '000729180LA047', 1, NULL, NULL),
	(93, 'Diabanza Zimbombe Mavitidi Lopes', '2020-06-23', 916851932, '004847573ue042', 1, NULL, NULL),
	(94, 'Mateus Chiemba', '1993-07-02', 995688114, '003542016LA037', 1, NULL, NULL),
	(96, 'José Algas dos Fungos', '1975-07-06', 975757575, '000197556LA045', 1, NULL, NULL),
	(99, 'Agostinho Xavier', '1995-04-12', 995959595, '00959595LA095', 1, NULL, NULL),
	(101, 'Sebastião Ramos', '1994-07-21', 932233445, '004567897LA045', 1, NULL, NULL),
	(103, 'Ivan Alexei', '1978-04-11', 997787878, 'UCR1104', 1, NULL, NULL),
	(104, 'Fany', '1996-09-01', 916253698, '004875966La042', 1, NULL, NULL),
	(105, 'Filipe João', '1997-08-01', 913258963, '002563895la047', 1, NULL, NULL),
	(107, 'macaca Baba', '1996-06-30', 998526398, '004523568UE042', 1, NULL, NULL),
	(110, 'Leila Aragão', '2000-08-03', 933333333, '03082010', 2, NULL, NULL);
/*!40000 ALTER TABLE `pessoa` ENABLE KEYS */;

-- Copiando estrutura para tabela sis_tfc.pessoa_departamento
CREATE TABLE IF NOT EXISTS `pessoa_departamento` (
  `id_pessoa` int(10) unsigned NOT NULL,
  `id_departamento` int(10) unsigned NOT NULL,
  `tipo` int(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  KEY `pessoa_departamento_id_pessoa_foreign` (`id_pessoa`),
  KEY `pessoa_departamento_id_departamento_foreign` (`id_departamento`),
  CONSTRAINT `pessoa_departamento_id_departamento_foreign` FOREIGN KEY (`id_departamento`) REFERENCES `departamento` (`id`) ON DELETE CASCADE,
  CONSTRAINT `pessoa_departamento_id_pessoa_foreign` FOREIGN KEY (`id_pessoa`) REFERENCES `pessoa` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Copiando dados para a tabela sis_tfc.pessoa_departamento: ~38 rows (aproximadamente)
/*!40000 ALTER TABLE `pessoa_departamento` DISABLE KEYS */;
INSERT INTO `pessoa_departamento` (`id_pessoa`, `id_departamento`, `tipo`, `created_at`, `updated_at`) VALUES
	(1, 1, 1, NULL, NULL),
	(50, 6, 1, '2019-12-24 03:00:00', '2019-12-24 03:00:00'),
	(10, 4, 2, '2019-12-26 03:00:00', '2019-12-26 03:00:00'),
	(58, 10, 2, '2020-03-05 04:00:00', '2020-03-05 04:00:00'),
	(59, 4, 2, NULL, NULL),
	(60, 4, 3, NULL, NULL),
	(61, 10, 2, NULL, NULL),
	(62, 10, 3, NULL, NULL),
	(66, 10, 2, NULL, NULL),
	(67, 10, 3, NULL, NULL),
	(69, 10, 2, NULL, NULL),
	(70, 10, 3, NULL, NULL),
	(72, 1, 1, NULL, NULL),
	(74, 15, 2, NULL, NULL),
	(75, 15, 3, NULL, NULL),
	(76, 15, 3, NULL, NULL),
	(77, 10, 2, NULL, NULL),
	(78, 10, 2, NULL, NULL),
	(79, 10, 3, NULL, NULL),
	(80, 10, 3, NULL, NULL),
	(81, 10, 3, NULL, NULL),
	(82, 15, 2, NULL, NULL),
	(83, 15, 2, NULL, NULL),
	(84, 15, 2, NULL, NULL),
	(85, 15, 2, NULL, NULL),
	(88, 15, 2, NULL, NULL),
	(89, 1, 1, NULL, NULL),
	(91, 11, 2, NULL, NULL),
	(93, 10, 3, NULL, NULL),
	(94, 10, 3, NULL, NULL),
	(57, 16, 1, NULL, NULL),
	(96, 7, 2, NULL, NULL),
	(99, 10, 3, NULL, NULL),
	(101, 15, 3, NULL, NULL),
	(103, 11, 2, NULL, NULL),
	(104, 13, 2, NULL, NULL),
	(105, 15, 2, NULL, NULL),
	(110, 25, 1, NULL, NULL);
/*!40000 ALTER TABLE `pessoa_departamento` ENABLE KEYS */;

-- Copiando estrutura para tabela sis_tfc.predefesa
CREATE TABLE IF NOT EXISTS `predefesa` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `avaliacao` smallint(6) NOT NULL,
  `tipo` smallint(6) NOT NULL,
  `nota` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_trabalho` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `predefesa_id_trabalho_foreign` (`id_trabalho`),
  CONSTRAINT `predefesa_id_trabalho_foreign` FOREIGN KEY (`id_trabalho`) REFERENCES `trabalho` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Copiando dados para a tabela sis_tfc.predefesa: ~4 rows (aproximadamente)
/*!40000 ALTER TABLE `predefesa` DISABLE KEYS */;
INSERT INTO `predefesa` (`id`, `avaliacao`, `tipo`, `nota`, `id_trabalho`, `created_at`, `updated_at`) VALUES
	(5, 1, 1, 'yesssssss', 160, '2021-02-25 00:00:00', '2021-05-06 19:56:37'),
	(6, 0, 2, 'N36A!92A', 160, '2021-02-28 00:00:00', '2021-03-23 17:52:57');
/*!40000 ALTER TABLE `predefesa` ENABLE KEYS */;

-- Copiando estrutura para tabela sis_tfc.prova_publica
CREATE TABLE IF NOT EXISTS `prova_publica` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nota` smallint(6) NOT NULL,
  `anotacao` longtext COLLATE utf8mb4_unicode_ci,
  `id_trabalho` int(10) unsigned NOT NULL,
  `id_nota_informativa` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Copiando dados para a tabela sis_tfc.prova_publica: ~1 rows (aproximadamente)
/*!40000 ALTER TABLE `prova_publica` DISABLE KEYS */;
INSERT INTO `prova_publica` (`id`, `nota`, `anotacao`, `id_trabalho`, `id_nota_informativa`, `created_at`, `updated_at`) VALUES
	(5, 15, NULL, 160, 1, '2021-05-17 00:00:00', '2021-05-15 19:43:21');
/*!40000 ALTER TABLE `prova_publica` ENABLE KEYS */;

-- Copiando estrutura para tabela sis_tfc.roles
CREATE TABLE IF NOT EXISTS `roles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nome` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `desc` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tipo` int(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Copiando dados para a tabela sis_tfc.roles: ~5 rows (aproximadamente)
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` (`id`, `nome`, `desc`, `tipo`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(1, 'administrador', 'Administrador funcionário', 1, NULL, NULL, NULL),
	(2, 'visualizador', 'Visualizador funcionario', 1, NULL, NULL, NULL),
	(3, 'orientador', 'Orientador do departamento', 2, '2020-02-03 03:00:00', '2020-07-05 01:47:49', NULL),
	(4, 'coordenador', 'Coordenação científica do departamento', 2, '2020-02-03 03:00:00', '2020-02-03 03:00:00', NULL),
	(5, 'estudante', 'Estudante de um curso', 3, '2020-02-10 03:00:46', '2020-07-05 01:47:55', NULL);
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;

-- Copiando estrutura para tabela sis_tfc.role_user
CREATE TABLE IF NOT EXISTS `role_user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `role_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `role_user_id_user_foreign` (`user_id`),
  KEY `role_user_id_role_foreign` (`role_id`),
  CONSTRAINT `role_user_id_role_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE,
  CONSTRAINT `role_user_id_user_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=88 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Copiando dados para a tabela sis_tfc.role_user: ~27 rows (aproximadamente)
/*!40000 ALTER TABLE `role_user` DISABLE KEYS */;
INSERT INTO `role_user` (`id`, `user_id`, `role_id`) VALUES
	(18, 1, 2),
	(53, 1, 1),
	(55, 5, 1),
	(56, 35, 5),
	(57, 33, 4),
	(59, 32, 2),
	(60, 37, 5),
	(64, 40, 5),
	(66, 39, 3),
	(68, 36, 3),
	(69, 43, 5),
	(70, 46, 4),
	(71, 47, 5),
	(72, 48, 5),
	(73, 51, 5),
	(74, 52, 5),
	(75, 53, 5),
	(78, 50, 3),
	(79, 42, 3),
	(80, 64, 5),
	(81, 65, 5),
	(82, 42, 4),
	(83, 69, 5),
	(84, 71, 5),
	(85, 62, 3),
	(86, 62, 4),
	(87, 49, 3);
/*!40000 ALTER TABLE `role_user` ENABLE KEYS */;

-- Copiando estrutura para tabela sis_tfc.sugestao
CREATE TABLE IF NOT EXISTS `sugestao` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `tema` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `descricao` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `proveniencia` int(1) NOT NULL,
  `estado` int(1) NOT NULL,
  `visibilidade` int(1) NOT NULL,
  `id_area` int(10) unsigned NOT NULL,
  `id_docente` int(10) unsigned NOT NULL,
  `avaliacao` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `sugestao_id_area_foreign` (`id_area`),
  KEY `sugestao_id_docente_foreign` (`id_docente`),
  CONSTRAINT `sugestao_id_area_foreign` FOREIGN KEY (`id_area`) REFERENCES `area_aplicacao` (`id`) ON DELETE CASCADE,
  CONSTRAINT `sugestao_id_docente_foreign` FOREIGN KEY (`id_docente`) REFERENCES `docente` (`id_pessoa`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=175 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Copiando dados para a tabela sis_tfc.sugestao: ~2 rows (aproximadamente)
/*!40000 ALTER TABLE `sugestao` DISABLE KEYS */;
INSERT INTO `sugestao` (`id`, `tema`, `descricao`, `proveniencia`, `estado`, `visibilidade`, `id_area`, `id_docente`, `avaliacao`, `created_at`, `updated_at`) VALUES
	(172, 'KULONGA', 'KULONGA62.pdf', 2, 3, 1, 6, 61, 1, '2020-12-30 00:00:00', '2020-12-30 00:00:00'),
	(173, 'TESTE', 'TESTE58.pdf', 1, 3, 1, 1, 58, 1, '2020-12-30 00:00:00', '2020-12-30 00:00:00'),
	(174, 'KULONGA', 'KULONGA69.pdf', 1, 3, 1, 6, 69, 1, '2021-04-22 00:00:00', '2021-04-22 00:00:00');
/*!40000 ALTER TABLE `sugestao` ENABLE KEYS */;

-- Copiando estrutura para tabela sis_tfc.sugestao_departamento
CREATE TABLE IF NOT EXISTS `sugestao_departamento` (
  `id_sugestao` int(10) unsigned NOT NULL,
  `id_departamento` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  KEY `sugestao_departamento_id_sugestao_foreign` (`id_sugestao`),
  KEY `sugestao_departamento_id_departamento_foreign` (`id_departamento`),
  CONSTRAINT `sugestao_departamento_id_departamento_foreign` FOREIGN KEY (`id_departamento`) REFERENCES `departamento` (`id`) ON DELETE CASCADE,
  CONSTRAINT `sugestao_departamento_id_sugestao_foreign` FOREIGN KEY (`id_sugestao`) REFERENCES `sugestao` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Copiando dados para a tabela sis_tfc.sugestao_departamento: ~6 rows (aproximadamente)
/*!40000 ALTER TABLE `sugestao_departamento` DISABLE KEYS */;
INSERT INTO `sugestao_departamento` (`id_sugestao`, `id_departamento`, `created_at`, `updated_at`) VALUES
	(172, 10, NULL, NULL),
	(173, 10, NULL, NULL),
	(173, 10, NULL, NULL),
	(173, 10, NULL, NULL),
	(174, 10, NULL, NULL),
	(174, 10, NULL, NULL);
/*!40000 ALTER TABLE `sugestao_departamento` ENABLE KEYS */;

-- Copiando estrutura para tabela sis_tfc.trabalho
CREATE TABLE IF NOT EXISTS `trabalho` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `tema` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `descricao` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `proveniencia` int(11) NOT NULL,
  `estado` int(11) NOT NULL,
  `id_area` int(10) unsigned NOT NULL,
  `id_docente` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `trabalho_id_area_foreign` (`id_area`),
  KEY `trabalho_id_docente_foreign` (`id_docente`),
  CONSTRAINT `trabalho_id_area_foreign` FOREIGN KEY (`id_area`) REFERENCES `area_aplicacao` (`id`) ON DELETE CASCADE,
  CONSTRAINT `trabalho_id_docente_foreign` FOREIGN KEY (`id_docente`) REFERENCES `docente` (`id_pessoa`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=162 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Copiando dados para a tabela sis_tfc.trabalho: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `trabalho` DISABLE KEYS */;
INSERT INTO `trabalho` (`id`, `tema`, `descricao`, `proveniencia`, `estado`, `id_area`, `id_docente`, `created_at`, `updated_at`) VALUES
	(160, 'KULONGA', 'Relatorio_KULONGA_160.pdf', 2, 2, 6, 61, '2020-12-30 00:00:00', '2021-03-23 14:33:05'),
	(161, 'TESTE TESTE ', 'default.pdf', 1, 1, 1, 58, '2021-03-14 00:00:00', '2021-03-14 00:00:00');
/*!40000 ALTER TABLE `trabalho` ENABLE KEYS */;

-- Copiando estrutura para tabela sis_tfc.trabalho_departamento
CREATE TABLE IF NOT EXISTS `trabalho_departamento` (
  `id_trabalho` int(10) unsigned NOT NULL,
  `id_departamento` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  KEY `trabalho_departamento_id_trabalho_foreign` (`id_trabalho`),
  KEY `trabalho_departamento_id_departamento_foreign` (`id_departamento`),
  CONSTRAINT `trabalho_departamento_id_departamento_foreign` FOREIGN KEY (`id_departamento`) REFERENCES `departamento` (`id`) ON DELETE CASCADE,
  CONSTRAINT `trabalho_departamento_id_trabalho_foreign` FOREIGN KEY (`id_trabalho`) REFERENCES `trabalho` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Copiando dados para a tabela sis_tfc.trabalho_departamento: ~3 rows (aproximadamente)
/*!40000 ALTER TABLE `trabalho_departamento` DISABLE KEYS */;
INSERT INTO `trabalho_departamento` (`id_trabalho`, `id_departamento`, `created_at`, `updated_at`) VALUES
	(160, 10, NULL, NULL),
	(161, 10, NULL, NULL),
	(161, 10, NULL, NULL);
/*!40000 ALTER TABLE `trabalho_departamento` ENABLE KEYS */;

-- Copiando estrutura para tabela sis_tfc.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `estado` int(1) NOT NULL,
  `tipo` int(1) NOT NULL,
  `qtd_vezes` int(1) NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `id_pessoa` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  KEY `users_id_pessoa_foreign` (`id_pessoa`),
  CONSTRAINT `users_id_pessoa_foreign` FOREIGN KEY (`id_pessoa`) REFERENCES `pessoa` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=81 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Copiando dados para a tabela sis_tfc.users: ~39 rows (aproximadamente)
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`, `email`, `email_verified_at`, `password`, `estado`, `tipo`, `qtd_vezes`, `remember_token`, `created_at`, `updated_at`, `id_pessoa`) VALUES
	(1, 'wsa@gmail.com', '2019-09-24 04:00:00', '$2y$10$XpNQefi7MxXb4v.blp.f7.Tc5xP9CGoo5hEaiLEfLoSWYkCEj48BK', 1, 1, 1, 'fEtOtecYQ4sqwYCPygynQG9Cqlb5BVbGNnA0e35x9R0JXFcPSlzKLj5QHLM5', '2019-09-24 04:00:00', '2019-09-24 04:00:00', 1),
	(5, 'eloicemarta@gmail.com', '2019-12-02 03:00:00', '$2y$10$zGyMTjucO2YibCuwtKJpaeVQtT5AuCwGSFRt.ZIiYD7DiNMqazmmW', 1, 2, 1, 's3lMyLoBCCoHPTSvyBDdC4vWOfWTwFh1GJJq2SdKHP5PMtAbhdT2zpIXZBs7', '2019-12-02 03:00:00', '2019-12-02 03:00:00', 10),
	(25, 'redento@fceconomia.ao', '2019-12-24 03:00:00', '$2y$10$czScxQf4n4GThpV7M9wQKu/zkSC5LKtZfvwVvt0RH3.CO5Jgq0ZC6', 1, 1, 1, 'hT952zHdTTkAtU1GvWue8Pw85f1OWGegRL54Fo7bEWwdGQ5pqSR9BazPe7nm', '2019-12-24 03:00:00', '2019-12-24 03:00:00', 50),
	(32, 'eunice@gmail.com', NULL, '$2y$10$mHs30WjbdV/6mYVPExHdbOe8fGnSHGNlZQSizZpalz9Ssz1QhJXZC', 1, 1, 1, 'oIfKJ4FmiWXjqwd5Ecd3UTz9lAZcXQgtW5StoGlv6pwf7fYfXum6T1zNxILg', NULL, NULL, 57),
	(33, 'mateuspadoca@hotmail.com', '2019-09-24 04:00:00', '$2y$10$ORbb2H5obkVKJZcCeSY28eSPEEtKeLbxVdpCvHMvcXWtghYaal2SK', 1, 2, 1, 'XfZRMXrTq3Y0350nSVy5zGPjU53eymWutwhXkLpeo814w6mN33xWXGbt59Kx', '2019-09-24 04:00:00', '2019-12-20 03:00:00', 58),
	(34, 'kianguebeni@gmail.com', NULL, '$2y$10$AUIWcnk7obTqsMfzLrpo7OAAQB6Mvyv2T0.9Em6eRAThM..emzza6', 1, 2, 1, 'mrThY1gfJOR8KvQ53uCv1SjCyZbHFXdvkVjar1jGJkBPgPlIOfpsDCCsm21m', NULL, NULL, 59),
	(35, 'diambielizabeth@gmail.com', NULL, '$2y$10$ArkgMg.qF/xb/FIF5RSgA.D0iD5/eemsJ9dkjaOoqROv3egMqLajW', 1, 3, 1, '467J5ZZkSbovNZhAVgObKO7IZ6GYhxe1xOKbKp66eMU3CBslejtDhYd3bfWt', NULL, NULL, 60),
	(36, 'amandio.almada@gmail.com', NULL, '$2y$10$FQfC.Mj8/4MnhwTYopzwpO7WMvzBSOPy160Sa2Z1qRJAYVezZdJiW', 1, 2, 1, 'vxAodET7V8kf02szCpYJhIBKdRELk2tGPgkMGD91lHyI8J7G6dUdl3IARLNJ', NULL, NULL, 61),
	(37, 'dalton.cabeia@gmail.com', NULL, '$2y$10$FcL.Iu6C.2RqjaAANm0CLuDY.4NDCOdkCYa02VgDAbw4al7DMpQmO', 1, 3, 1, 'D3LQXv5GPCa0zt096RO6jT3vc9Dzy0D79ir4BgV1pcVMYgrKhcTFo1capfjN', NULL, NULL, 62),
	(39, 'lufialuiso@fcuan.ao', NULL, '$2y$10$ppQ8lirCH80qly5FYYrW5O6YK8K7oiZs/kxcVfNaDSkvUYvspLk8O', 1, 2, 1, 'jLRn45xK2ZHh0AjBs8ANDuw7x5idH7x61ZW97o9Hx6hzFN5dJzcUcnr1iZgQ', NULL, NULL, 66),
	(40, 'juliana.dias@gmail.com', NULL, '$2y$10$y94iQ.5qTjdRkBr.rZcyZOJhV7b1AzAB5DQZ1fsSXdBuZNI39PG4K', 1, 3, 1, 'iEQWduzPMAdNuyMYwGrMcvKblYQcLQfFhCojKYzGSMz97lMCOzrNaEi1cqhU', NULL, NULL, 67),
	(42, 'vicente@gmail.com', NULL, '$2y$10$EubNMRl6lUQlSbvPTxOrpuhdvlslb3pr2Dl4HgeydkD9Um.1G7Vhq', 1, 2, 1, 'SskYDGt4rwUGwTEYcL5Jf08eO6JMnZifCNBMq5VFw2MvgnK2qGEsEPDqn6Tc', NULL, NULL, 69),
	(43, 'sediamuanacongolo@gmail.com', NULL, '$2y$10$QG1C39jQyE4SOzKuJjiYVucNvugVMQOGaj2CvAt4uTv9HpdHIWWV2', 1, 3, 1, 'nz7AhqpgKbBIBIznAXLBuPLl1DQFNzTAjlX3mVRQ45srDWvgfTT5l1DHh54v', NULL, NULL, 70),
	(44, 'loy@gmail.com', NULL, '$2y$10$RDY46f10bBliKbVf28JJfe9kS0z/vm95kbu2oo0hWX31rog/Lb9d.', 1, 1, 0, NULL, NULL, NULL, 72),
	(46, 'geronimo@hotmail.com', NULL, '$2y$10$3hBW7WSPsAg3MBiviVHApemLAkWvXXL08a1TQ3SGQF9qbDa2uhGVy', 1, 2, 1, 'GZ9oMHU38jURNtS3hsR67AfMoQg7fY1lgpaEaAai4nBL0jHB87ym1bxluc9B', NULL, NULL, 74),
	(47, 'helias@gmail.com', NULL, '$2y$10$Kh.S1QcHBZLGFrKsevtQJOfJ9dalHJkQmKgWNPcCR7tx0X/5Itrou', 1, 3, 1, '0i4ntjCQhozfBHc8xkREaBX97eT1qeUftSQ6UM33UuIp45jRzwV5EnRpRw5P', NULL, NULL, 75),
	(48, 'leocadia@gmail.com', NULL, '$2y$10$sFLIE5gDVWII/ZfQ5gzMhO5GCj0XIKy4mC5VuLBJCgj7rvrKCVXU2', 1, 3, 1, 'HkkD7sbQADlwcUk71kWP0AQA52isJ94MaBNgo5A2XBPzGvY1ly2HseuDLB62', NULL, NULL, 76),
	(49, 'dikiefu@gmail.com', NULL, '$2y$10$tXhnZ2FFqDXVzM/Sq2Nfbuv0TvdmjVBzUFXso.57N.2FIizyoxu8e', 1, 2, 1, 'ZVDzJumeLJsqqWfuwaopx9Ysznx0qPC0VwyYdT1iiLTI05YhMKoBn0bYkgt9', NULL, NULL, 77),
	(50, 'darlines@gmail.com', NULL, '$2y$10$YKPpxWedWLjDkdXzE9oQoOqR6MuxL6Tbvm6m4RXKL8iYgyyKXrnHS', 1, 2, 0, NULL, NULL, NULL, 78),
	(51, 'banza@gmail.com', NULL, '$2y$10$3b/hpKjlSnD.n3UolWHPqOGSXfTUw4SU.vawCMr9kqqO7gphhV9j.', 1, 3, 1, 'PM4QYQVSaf2KRx30wm89lzZ8C7W9y81JE44lafQLk6hkAMRqBZz0murZzyyw', NULL, NULL, 79),
	(52, 'kiala@gmail.com', NULL, '$2y$10$orRM1g.11PKpkVPSP1nfy.uUlijGyKCy3ntZAvdEgfSEZpvd/DgTa', 1, 3, 0, NULL, NULL, NULL, 80),
	(53, 'fumadeso@gmail.com', NULL, '$2y$10$fxDMAiVzRq3igy7a4aqQMOZ8.6ce.sGLsFVLlSUNjMCLbkVMs4Rmu', 1, 3, 0, NULL, NULL, NULL, 81),
	(54, 'suamino@gmail.com', NULL, '$2y$10$lPLMIofc8iP..9B8aGht9eJtva2j4pJdUJG8/6fW9x18xAfq5HUzu', 1, 2, 0, NULL, NULL, NULL, 82),
	(55, 'Jose@gmail.com', NULL, '$2y$10$SQNJc2/bD8l8QJnaYCO38.eJhYHBVg5y7KWqQJtaEOTJbX/1PytBS', 1, 2, 0, NULL, NULL, NULL, 83),
	(56, 'teofili@gmail.com', NULL, '$2y$10$FdaWbrjFTP7KZURWotwLoet3NEJYvQ/4uzaOH61h07QrPTrbLPdFq', 1, 2, 0, NULL, NULL, NULL, 84),
	(57, 'messias@gmail.com', NULL, '$2y$10$rcpQ5BpADl6ld2dS9cYFeOk54bzPeL0gujvQR.Y74XWsF8XX0aSLG', 1, 2, 0, NULL, NULL, NULL, 85),
	(60, 'Enoque@gmail.com', NULL, '$2y$10$DO434.H/mYOonhUCCtSLtut7QZTWYxMu4TmiYK.CWPkFw.zs/v5.C', 1, 2, 0, NULL, NULL, NULL, 88),
	(61, 'alberto@gmail.com', NULL, '$2y$10$c33xasPeCZekmk5FThPOf.ebPhRU.EiGnix7tOJjfvHbkvgR9lfRu', 1, 1, 0, NULL, NULL, NULL, 89),
	(62, 'natividade@hotmail.com', NULL, '$2y$10$u4.PCAfayfZF84221/7jcunCpWCkw970Bm8Be2JLU4MJbhwHdSOrK', 1, 2, 1, NULL, NULL, NULL, 91),
	(64, 'diabanzamavitidi@gmail.com', NULL, '$2y$10$tjk5eTee9TfgDK3taCMEV.4yOP9FzlEteTuTj2I9SmCfpCEC.Q4zy', 1, 3, 1, NULL, NULL, NULL, 93),
	(65, 'mateus@gmail.com', NULL, '$2y$10$nnU27mJO4D/LZgEx6YhKiO0EUerVDAKdybYxUCGvsJN4ltBtXlwj.', 1, 3, 1, 'rJq696BP1hJJHuAbhL2sPcl1eoJXLH2gY5i2vR0gTzgqYZvR7sp2YH94UuVq', NULL, NULL, 94),
	(67, 'jose_algas@gmail.com', NULL, '$2y$10$pTWd7C.GaKSbmJ7VdO7ndOdqp6FZRlQoHzZ64sOkjGV.WshYqUJx2', 1, 2, 0, NULL, NULL, NULL, 96),
	(69, 'agx@gmail.com', NULL, '$2y$10$zGInyDi8FzxrVsop5mCPQu/LqL6rTxbDsSApQtIArJ7yoVD7XjiqW', 1, 3, 1, 'FZJGP1AEDW677bNqR4ohw9haCDgMdfpDo9jmOdlA5HzNwlsVvi3DKvDN8Ms6', NULL, NULL, 99),
	(71, 'sebas@hotmail.com', NULL, '$2y$10$q9aaDzmZrvo5t2Rb22N/bOU8tHJ294840cTJVpIweehKH43S98UQK', 1, 3, 0, NULL, NULL, NULL, 101),
	(73, 'ivan.alexei@hotmail.com', NULL, '$2y$10$xBw208AdZx78WhCVe0ELi.7mqMgRsDO0SrUEay8recuGVKOynzm2G', 1, 2, 0, NULL, NULL, NULL, 103),
	(74, 'fany@gmail.com', NULL, '$2y$10$ACNKHpRlciP.e9JLXUUgh.XItokwQ4dVD.fAwVUT62HSF7CChGz2m', 1, 2, 0, NULL, NULL, NULL, 104),
	(75, 'filipe@gmail.com', NULL, '$2y$10$ypT69DCdVgsASSpvSSbKLug4UV5NiWGlGN/VFsPUumDBkRERvLRr2', 1, 2, 0, NULL, NULL, NULL, 105),
	(77, 'macaca@gmail.com', NULL, '$2y$10$d45DwRITzj7czqZFDos5/OQZmdbcjk8i3Hn6L9LOjaDPhGM39VK06', 1, 1, 0, NULL, NULL, NULL, 107),
	(80, 'leilaaragao@gmail.com', NULL, '$2y$10$dBgk/14QR9yPs9ioonifRu0aGgfLakvl5NO8ApIcUJWRn1fovpmwe', 1, 1, 0, NULL, NULL, NULL, 110);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
