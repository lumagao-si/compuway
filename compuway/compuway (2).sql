-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 04/11/2026 às 20:39
-- Versão do servidor: 10.4.32-MariaDB
-- Versão do PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `compuway`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `administradores`
--

CREATE TABLE `administradores` (
  `id` int(11) NOT NULL,
  `nome` varchar(150) NOT NULL,
  `email` varchar(150) NOT NULL,
  `senha` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `administradores`
--

INSERT INTO `administradores` (`id`, `nome`, `email`, `senha`) VALUES
(1, 'Administrador', 'admin@compuway.com', '$2y$10$spsJ3346j8D1pmcKRMCDOudUKIiPN8SD7Sp2Xa7CNXg7voIJ.AU0S');

-- --------------------------------------------------------

--
-- Estrutura para tabela `clientes`
--

CREATE TABLE `clientes` (
  `id` int(11) NOT NULL,
  `nome` varchar(150) NOT NULL,
  `email` varchar(150) NOT NULL,
  `senha` varchar(255) NOT NULL,
  `telefone` varchar(20) DEFAULT NULL,
  `data_cadastro` datetime DEFAULT current_timestamp(),
  `cpf` varchar(14) DEFAULT NULL,
  `data_nascimento` date DEFAULT NULL,
  `endereco` varchar(255) DEFAULT NULL,
  `ativo` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `clientes`
--

INSERT INTO `clientes` (`id`, `nome`, `email`, `senha`, `telefone`, `data_cadastro`, `cpf`, `data_nascimento`, `endereco`, `ativo`) VALUES
(1, 'João Vitor Martins Bento', 'joaovitorbento531@gmail.com', '$2y$10$e5na4WeRsL1kvQXgKRK63epnsmoPwERWgoNwNMwdP41HiIiUnuK16', '34999521316', '2026-09-19 11:09:27', '', NULL, '', 1),
(2, 'aura da silva', 'ego123@gmail.com', '$2y$10$P4x1qQpb5e.q/V8/S.gt.OBcmWk0sXr7sebMiK3Dfg9ECww5/SCra', '6767676766767667', '2026-10-21 14:51:03', '123456789', '2007-07-06', 'Rua olivio Ferreira de Camargos, 31', 1),
(3, 'emanuel silva rodrigues', 'joaovitorbento532@gmail.com', '$2y$10$ACbpArWyBfQ53crozp1RGOOnO0OsXcVfOqn0ob1CYWri1d.S/rchO', '34999521317', '2026-11-04 16:14:20', '12345689767', '2012-12-12', 'Rua olivio Ferreira de Camargos, 31', 1);

-- --------------------------------------------------------

--
-- Estrutura para tabela `cursos`
--

CREATE TABLE `cursos` (
  `id` int(11) NOT NULL,
  `nome` varchar(150) NOT NULL,
  `descricao` text DEFAULT NULL,
  `valor` decimal(10,2) NOT NULL,
  `carga_horaria` int(11) DEFAULT NULL,
  `data_cadastro` datetime DEFAULT current_timestamp(),
  `duracao_meses` int(11) DEFAULT NULL,
  `parcelas` int(11) DEFAULT NULL,
  `ativo` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `cursos`
--

INSERT INTO `cursos` (`id`, `nome`, `descricao`, `valor`, `carga_horaria`, `data_cadastro`, `duracao_meses`, `parcelas`, `ativo`) VALUES
(1, 'excel avançado', '', 199.90, 20, '2026-09-19 11:22:05', NULL, NULL, 1),
(2, 'excel basico', '', 233.00, 67, '2026-10-21 14:42:06', NULL, NULL, 1);

-- --------------------------------------------------------

--
-- Estrutura para tabela `matriculas`
--

CREATE TABLE `matriculas` (
  `id` int(11) NOT NULL,
  `cliente_id` int(11) NOT NULL,
  `curso_id` int(11) DEFAULT NULL,
  `pacote_id` int(11) DEFAULT NULL,
  `data_matricula` date NOT NULL,
  `primeiro_vencimento` date NOT NULL,
  `quantidade_mensalidades` int(11) NOT NULL DEFAULT 1,
  `status` enum('ativa','concluida','cancelada') NOT NULL DEFAULT 'ativa'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `matriculas`
--

INSERT INTO `matriculas` (`id`, `cliente_id`, `curso_id`, `pacote_id`, `data_matricula`, `primeiro_vencimento`, `quantidade_mensalidades`, `status`) VALUES
(1, 1, 1, NULL, '2026-10-21', '2026-12-31', 20, 'ativa'),
(2, 1, 1, NULL, '2026-10-21', '2026-12-31', 20, 'ativa');

-- --------------------------------------------------------

--
-- Estrutura para tabela `matricula_historico`
--

CREATE TABLE `matricula_historico` (
  `id` int(11) NOT NULL,
  `matricula_id` int(11) NOT NULL,
  `status` varchar(20) NOT NULL,
  `descricao` varchar(255) DEFAULT NULL,
  `data_alteracao` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `matricula_historico`
--

INSERT INTO `matricula_historico` (`id`, `matricula_id`, `status`, `descricao`, `data_alteracao`) VALUES
(1, 1, 'ativa', 'Matrícula criada', '2026-10-21 14:14:16'),
(2, 2, 'ativa', 'Matrícula criada', '2026-10-21 14:14:56');

-- --------------------------------------------------------

--
-- Estrutura para tabela `pacotes`
--

CREATE TABLE `pacotes` (
  `id` int(11) NOT NULL,
  `nome` varchar(150) NOT NULL,
  `valor` decimal(10,2) NOT NULL,
  `parcelas` int(11) DEFAULT NULL,
  `descricao` text DEFAULT NULL,
  `ativo` tinyint(1) NOT NULL DEFAULT 1,
  `data_cadastro` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `pacotes`
--

INSERT INTO `pacotes` (`id`, `nome`, `valor`, `parcelas`, `descricao`, `ativo`, `data_cadastro`) VALUES
(1, 'office', 501.18, NULL, 'completo chefe', 1, '2026-10-21 14:16:08');

-- --------------------------------------------------------

--
-- Estrutura para tabela `pacote_cursos`
--

CREATE TABLE `pacote_cursos` (
  `pacote_id` int(11) NOT NULL,
  `curso_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `pacote_cursos`
--

INSERT INTO `pacote_cursos` (`pacote_id`, `curso_id`) VALUES
(1, 1);

-- --------------------------------------------------------

--
-- Estrutura para tabela `pagamentos`
--

CREATE TABLE `pagamentos` (
  `id` int(11) NOT NULL,
  `cliente_id` int(11) NOT NULL,
  `curso_id` int(11) DEFAULT NULL,
  `valor` decimal(10,2) NOT NULL,
  `data_vencimento` date NOT NULL,
  `data_pagamento` date DEFAULT NULL,
  `status` enum('pendente','pago','atrasado') DEFAULT 'pendente',
  `matricula_id` int(11) DEFAULT NULL,
  `pacote_id` int(11) DEFAULT NULL,
  `referencia` char(7) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `pagamentos`
--

INSERT INTO `pagamentos` (`id`, `cliente_id`, `curso_id`, `valor`, `data_vencimento`, `data_pagamento`, `status`, `matricula_id`, `pacote_id`, `referencia`) VALUES
(3, 1, 1, 199.90, '2027-01-31', '2026-10-21', 'pago', 1, NULL, '2027-01'),
(4, 1, 1, 199.90, '2027-02-28', '2026-10-21', 'pago', 1, NULL, '2027-02'),
(5, 1, 1, 199.90, '2027-03-31', '2026-10-21', 'pago', 1, NULL, '2027-03'),
(6, 1, 1, 199.90, '2027-04-30', '2026-10-21', 'pago', 1, NULL, '2027-04'),
(7, 1, 1, 199.90, '2027-05-31', '2026-10-21', 'pago', 1, NULL, '2027-05'),
(8, 1, 1, 199.90, '2027-06-30', '2026-10-21', 'pago', 1, NULL, '2027-06'),
(9, 1, 1, 199.90, '2027-07-31', NULL, 'pendente', 1, NULL, '2027-07'),
(10, 1, 1, 199.90, '2027-08-31', NULL, 'pendente', 1, NULL, '2027-08'),
(11, 1, 1, 199.90, '2027-09-30', NULL, 'pendente', 1, NULL, '2027-09'),
(12, 1, 1, 199.90, '2027-10-31', NULL, 'pendente', 1, NULL, '2027-10'),
(13, 1, 1, 199.90, '2027-11-30', NULL, 'pendente', 1, NULL, '2027-11'),
(14, 1, 1, 199.90, '2027-12-31', NULL, 'pendente', 1, NULL, '2027-12'),
(15, 1, 1, 199.90, '2028-01-31', NULL, 'pendente', 1, NULL, '2028-01'),
(16, 1, 1, 199.90, '2028-02-29', NULL, 'pendente', 1, NULL, '2028-02'),
(17, 1, 1, 199.90, '2028-03-31', NULL, 'pendente', 1, NULL, '2028-03'),
(18, 1, 1, 199.90, '2028-04-30', NULL, 'pendente', 1, NULL, '2028-04'),
(19, 1, 1, 199.90, '2028-05-31', NULL, 'pendente', 1, NULL, '2028-05'),
(20, 1, 1, 199.90, '2028-06-30', NULL, 'pendente', 1, NULL, '2028-06'),
(21, 1, 1, 199.90, '2028-07-31', NULL, 'pendente', 1, NULL, '2028-07'),
(22, 1, 1, 199.90, '2026-12-31', NULL, 'pendente', 2, NULL, '2026-12'),
(23, 1, 1, 199.90, '2027-01-31', NULL, 'pendente', 2, NULL, '2027-01'),
(24, 1, 1, 199.90, '2027-02-28', NULL, 'pendente', 2, NULL, '2027-02'),
(25, 1, 1, 199.90, '2027-03-31', NULL, 'pendente', 2, NULL, '2027-03'),
(26, 1, 1, 199.90, '2027-04-30', NULL, 'pendente', 2, NULL, '2027-04'),
(27, 1, 1, 199.90, '2027-05-31', NULL, 'pendente', 2, NULL, '2027-05'),
(28, 1, 1, 199.90, '2027-06-30', NULL, 'pendente', 2, NULL, '2027-06'),
(29, 1, 1, 199.90, '2027-07-31', NULL, 'pendente', 2, NULL, '2027-07'),
(30, 1, 1, 199.90, '2027-08-31', NULL, 'pendente', 2, NULL, '2027-08'),
(31, 1, 1, 199.90, '2027-09-30', NULL, 'pendente', 2, NULL, '2027-09'),
(32, 1, 1, 199.90, '2027-10-31', NULL, 'pendente', 2, NULL, '2027-10'),
(33, 1, 1, 199.90, '2027-11-30', NULL, 'pendente', 2, NULL, '2027-11'),
(34, 1, 1, 199.90, '2027-12-31', NULL, 'pendente', 2, NULL, '2027-12'),
(35, 1, 1, 199.90, '2028-01-31', NULL, 'pendente', 2, NULL, '2028-01'),
(36, 1, 1, 199.90, '2028-02-29', NULL, 'pendente', 2, NULL, '2028-02'),
(37, 1, 1, 199.90, '2028-03-31', NULL, 'pendente', 2, NULL, '2028-03'),
(38, 1, 1, 199.90, '2028-04-30', NULL, 'pendente', 2, NULL, '2028-04'),
(39, 1, 1, 199.90, '2028-05-31', NULL, 'pendente', 2, NULL, '2028-05'),
(40, 1, 1, 199.90, '2028-06-30', NULL, 'pendente', 2, NULL, '2028-06'),
(41, 1, 1, 199.90, '2028-07-31', NULL, 'pendente', 2, NULL, '2028-07');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `administradores`
--
ALTER TABLE `administradores`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Índices de tabela `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Índices de tabela `cursos`
--
ALTER TABLE `cursos`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `matriculas`
--
ALTER TABLE `matriculas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_matriculas_cliente` (`cliente_id`),
  ADD KEY `idx_matriculas_curso` (`curso_id`),
  ADD KEY `idx_matriculas_pacote` (`pacote_id`);

--
-- Índices de tabela `matricula_historico`
--
ALTER TABLE `matricula_historico`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_historico_matricula` (`matricula_id`);

--
-- Índices de tabela `pacotes`
--
ALTER TABLE `pacotes`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `pacote_cursos`
--
ALTER TABLE `pacote_cursos`
  ADD PRIMARY KEY (`pacote_id`,`curso_id`),
  ADD KEY `fk_pacote_cursos_curso` (`curso_id`);

--
-- Índices de tabela `pagamentos`
--
ALTER TABLE `pagamentos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cliente_id` (`cliente_id`),
  ADD KEY `curso_id` (`curso_id`),
  ADD KEY `idx_pagamentos_matricula` (`matricula_id`),
  ADD KEY `idx_pagamentos_pacote` (`pacote_id`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `administradores`
--
ALTER TABLE `administradores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `cursos`
--
ALTER TABLE `cursos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `matriculas`
--
ALTER TABLE `matriculas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `matricula_historico`
--
ALTER TABLE `matricula_historico`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `pacotes`
--
ALTER TABLE `pacotes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `pagamentos`
--
ALTER TABLE `pagamentos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `matriculas`
--
ALTER TABLE `matriculas`
  ADD CONSTRAINT `fk_matriculas_cliente` FOREIGN KEY (`cliente_id`) REFERENCES `clientes` (`id`),
  ADD CONSTRAINT `fk_matriculas_curso` FOREIGN KEY (`curso_id`) REFERENCES `cursos` (`id`),
  ADD CONSTRAINT `fk_matriculas_pacote` FOREIGN KEY (`pacote_id`) REFERENCES `pacotes` (`id`);

--
-- Restrições para tabelas `matricula_historico`
--
ALTER TABLE `matricula_historico`
  ADD CONSTRAINT `fk_historico_matricula` FOREIGN KEY (`matricula_id`) REFERENCES `matriculas` (`id`) ON DELETE CASCADE;

--
-- Restrições para tabelas `pacote_cursos`
--
ALTER TABLE `pacote_cursos`
  ADD CONSTRAINT `fk_pacote_cursos_curso` FOREIGN KEY (`curso_id`) REFERENCES `cursos` (`id`),
  ADD CONSTRAINT `fk_pacote_cursos_pacote` FOREIGN KEY (`pacote_id`) REFERENCES `pacotes` (`id`) ON DELETE CASCADE;

--
-- Restrições para tabelas `pagamentos`
--
ALTER TABLE `pagamentos`
  ADD CONSTRAINT `fk_pagamentos_matricula` FOREIGN KEY (`matricula_id`) REFERENCES `matriculas` (`id`),
  ADD CONSTRAINT `fk_pagamentos_pacote` FOREIGN KEY (`pacote_id`) REFERENCES `pacotes` (`id`),
  ADD CONSTRAINT `pagamentos_ibfk_1` FOREIGN KEY (`cliente_id`) REFERENCES `clientes` (`id`),
  ADD CONSTRAINT `pagamentos_ibfk_2` FOREIGN KEY (`curso_id`) REFERENCES `cursos` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
