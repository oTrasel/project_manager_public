-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 27/08/2023 às 18:37
-- Versão do servidor: 10.4.28-MariaDB
-- Versão do PHP: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `project_manager`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `bloqueado`
--

CREATE TABLE `bloqueado` (
  `id_bloqueio` int(11) NOT NULL,
  `tipo_bloqueio` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `bloqueado`
--

INSERT INTO `bloqueado` (`id_bloqueio`, `tipo_bloqueio`) VALUES
(3, 'banido'),
(2, 'nao'),
(1, 'sim');

-- --------------------------------------------------------

--
-- Estrutura para tabela `linguagem`
--

CREATE TABLE `linguagem` (
  `id_linguagem` int(11) NOT NULL,
  `desc_linguagem` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Despejando dados para a tabela `linguagem`
--

INSERT INTO `linguagem` (`id_linguagem`, `desc_linguagem`) VALUES
(1, 'C#'),
(3, 'JAVA'),
(4, 'JAVA SCRIPT'),
(2, 'PHP');

-- --------------------------------------------------------

--
-- Estrutura para tabela `logs_gerais`
--

CREATE TABLE `logs_gerais` (
  `id_log_geral` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `descr_log` varchar(1500) NOT NULL,
  `data_log` datetime NOT NULL,
  `id_nivel` int(11) NOT NULL,
  `arquivo` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `logs_login`
--

CREATE TABLE `logs_login` (
  `id_log_login` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `descr_log` varchar(1500) NOT NULL,
  `data_login` datetime NOT NULL,
  `id_nivel` int(11) NOT NULL,
  `arquivo` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `nivel_log`
--

CREATE TABLE `nivel_log` (
  `id_nivel` int(11) NOT NULL,
  `descr_nivel` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Despejando dados para a tabela `nivel_log`
--

INSERT INTO `nivel_log` (`id_nivel`, `descr_nivel`) VALUES
(7, 'ALERT'),
(6, 'CRITICAL'),
(1, 'DEBUG'),
(8, 'EMERGENCY'),
(5, 'ERROR'),
(2, 'INFO'),
(3, 'NOTICE'),
(4, 'WARNING');

-- --------------------------------------------------------

--
-- Estrutura para tabela `projeto`
--

CREATE TABLE `projeto` (
  `id_projeto` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `nome_projeto` varchar(100) NOT NULL,
  `desc_projeto` varchar(10000) NOT NULL,
  `data_inicio_projeto` datetime NOT NULL,
  `data_ultimo_play` datetime DEFAULT NULL,
  `tempo_decorrido` float DEFAULT NULL,
  `id_status` int(11) NOT NULL,
  `id_linguagem` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `status`
--

CREATE TABLE `status` (
  `id_status` int(11) NOT NULL,
  `status` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Despejando dados para a tabela `status`
--

INSERT INTO `status` (`id_status`, `status`) VALUES
(1, 'andamento'),
(3, 'concluido'),
(4, 'novo'),
(2, 'pause');

-- --------------------------------------------------------

--
-- Estrutura para tabela `tipo_user`
--

CREATE TABLE `tipo_user` (
  `id_tipo_user` int(11) NOT NULL,
  `desc_tipo_user` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Despejando dados para a tabela `tipo_user`
--

INSERT INTO `tipo_user` (`id_tipo_user`, `desc_tipo_user`) VALUES
(1, 'Admin'),
(2, 'Normal');

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuario`
--

CREATE TABLE `usuario` (
  `id_user` int(11) NOT NULL,
  `nome` varchar(50) DEFAULT NULL,
  `id_tipo_user` int(11) NOT NULL,
  `senha` varchar(150) NOT NULL,
  `login` varchar(15) NOT NULL,
  `email` varchar(50) NOT NULL,
  `data_cadastro` datetime NOT NULL,
  `data_nascimento` date NOT NULL,
  `id_bloqueio` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `bloqueado`
--
ALTER TABLE `bloqueado`
  ADD PRIMARY KEY (`id_bloqueio`),
  ADD UNIQUE KEY `tipo_bloqueio` (`tipo_bloqueio`);

--
-- Índices de tabela `linguagem`
--
ALTER TABLE `linguagem`
  ADD PRIMARY KEY (`id_linguagem`),
  ADD UNIQUE KEY `desc_linguagem` (`desc_linguagem`);

--
-- Índices de tabela `logs_gerais`
--
ALTER TABLE `logs_gerais`
  ADD PRIMARY KEY (`id_log_geral`),
  ADD KEY `logs_ibfk_1` (`id_user`),
  ADD KEY `logs_ibfk_2` (`id_nivel`);

--
-- Índices de tabela `logs_login`
--
ALTER TABLE `logs_login`
  ADD PRIMARY KEY (`id_log_login`),
  ADD KEY `logs_login_fk1` (`id_nivel`),
  ADD KEY `logs_login_fk2` (`id_user`);

--
-- Índices de tabela `nivel_log`
--
ALTER TABLE `nivel_log`
  ADD PRIMARY KEY (`id_nivel`),
  ADD UNIQUE KEY `descr_nivel` (`descr_nivel`);

--
-- Índices de tabela `projeto`
--
ALTER TABLE `projeto`
  ADD PRIMARY KEY (`id_projeto`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_status` (`id_status`),
  ADD KEY `id_linguagem` (`id_linguagem`);

--
-- Índices de tabela `status`
--
ALTER TABLE `status`
  ADD PRIMARY KEY (`id_status`),
  ADD UNIQUE KEY `status` (`status`);

--
-- Índices de tabela `tipo_user`
--
ALTER TABLE `tipo_user`
  ADD PRIMARY KEY (`id_tipo_user`),
  ADD UNIQUE KEY `desc_tipo_user` (`desc_tipo_user`);

--
-- Índices de tabela `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `nome` (`nome`,`login`,`email`),
  ADD KEY `id_tipo_user` (`id_tipo_user`),
  ADD KEY `id_bloqueio` (`id_bloqueio`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `bloqueado`
--
ALTER TABLE `bloqueado`
  MODIFY `id_bloqueio` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `linguagem`
--
ALTER TABLE `linguagem`
  MODIFY `id_linguagem` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `logs_gerais`
--
ALTER TABLE `logs_gerais`
  MODIFY `id_log_geral` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `logs_login`
--
ALTER TABLE `logs_login`
  MODIFY `id_log_login` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `projeto`
--
ALTER TABLE `projeto`
  MODIFY `id_projeto` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `status`
--
ALTER TABLE `status`
  MODIFY `id_status` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `tipo_user`
--
ALTER TABLE `tipo_user`
  MODIFY `id_tipo_user` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `logs_gerais`
--
ALTER TABLE `logs_gerais`
  ADD CONSTRAINT `logs_gerais_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `usuario` (`id_user`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `logs_gerais_ibfk_2` FOREIGN KEY (`id_nivel`) REFERENCES `nivel_log` (`id_nivel`);

--
-- Restrições para tabelas `logs_login`
--
ALTER TABLE `logs_login`
  ADD CONSTRAINT `logs_login_fk1` FOREIGN KEY (`id_nivel`) REFERENCES `nivel_log` (`id_nivel`),
  ADD CONSTRAINT `logs_login_fk2` FOREIGN KEY (`id_user`) REFERENCES `usuario` (`id_user`);

--
-- Restrições para tabelas `projeto`
--
ALTER TABLE `projeto`
  ADD CONSTRAINT `projeto_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `usuario` (`id_user`) ON DELETE CASCADE,
  ADD CONSTRAINT `projeto_ibfk_2` FOREIGN KEY (`id_status`) REFERENCES `status` (`id_status`),
  ADD CONSTRAINT `projeto_ibfk_3` FOREIGN KEY (`id_linguagem`) REFERENCES `linguagem` (`id_linguagem`);

--
-- Restrições para tabelas `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `usuario_ibfk_1` FOREIGN KEY (`id_tipo_user`) REFERENCES `tipo_user` (`id_tipo_user`),
  ADD CONSTRAINT `usuario_ibfk_2` FOREIGN KEY (`id_bloqueio`) REFERENCES `bloqueado` (`id_bloqueio`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
