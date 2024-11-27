-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 27/11/2024 às 22:45
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
-- Banco de dados: `agendasenac`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `contatos`
--

CREATE TABLE `contatos` (
  `id` int(11) NOT NULL,
  `nome` varchar(80) NOT NULL,
  `telefone` varchar(15) NOT NULL,
  `endereco` varchar(100) NOT NULL,
  `dt_nasc` date NOT NULL,
  `descricao` text NOT NULL,
  `linkedin` varchar(50) NOT NULL,
  `email` varchar(150) NOT NULL,
  `foto` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `contatos`
--

INSERT INTO `contatos` (`id`, `nome`, `telefone`, `endereco`, `dt_nasc`, `descricao`, `linkedin`, `email`, `foto`) VALUES
(5, 'Alyssonzinho', '(42)99837-7160', 'Rua Quem Leu é Gay - 6969', '2003-03-24', 'Valorant é uma merda, CS é muito superior mas eu sou ruim no CS, então fico no Valorant.', 'alyssoncunhag', 'alyssoncunhag@gmail.com', '591f2650656a4b83cae47945dfeeb8f8.jpg'),
(6, 'Maxixo Baitola', '(42)96969-6969', 'Rua do Escorrega na Peça', '2005-08-14', 'Faz parte do movimento LGBT e luta pela igualdade de gênero', 'viadinfazjob', 'maxixo@gmail.com', '9b11b9a6fffaef4d55dfe9b6f1c11d76.jpg'),
(7, 'VTXP Buzi', '(42)22424-2424', 'Rua do Escorrega na Grandona', '2424-04-24', 'Escravo da Vivo', 'vtzinchupaengole', 'vtxp@gmail.com', 'vt.gif'),
(8, 'Luis Palha', '(42)omais-viado', 'palhabatata@gmail.com', '2011-11-11', 'O cara não gosta de batata palha na pizza kkkkkkkkkkkkkkkkkkkkk', 'palhinhabuzi123', 'lulupalha@gmail.com', 'palha.png'),
(10, 'Cachorrinho bem doidinho', '(42)aauau-auau', 'Casinha Azul  - 1245', '2011-11-14', 'auauauau', 'auauau', 'auauau@gmail.com', 'cachorro.gif');

-- --------------------------------------------------------

--
-- Estrutura para tabela `foto_contato`
--

CREATE TABLE `foto_contato` (
  `id` int(11) NOT NULL,
  `id_contato` int(11) NOT NULL,
  `url` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nome` varchar(80) NOT NULL,
  `email` varchar(150) NOT NULL,
  `senha` varchar(300) NOT NULL,
  `permissoes` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `usuarios`
--

INSERT INTO `usuarios` (`id`, `nome`, `email`, `senha`, `permissoes`) VALUES
(7, 'Alysson', 'alysson@admin.com', '$2y$10$QSRD6ayTdL9Kxt6c8.txTuE5GhO3T1/MxIaBLxudSGJH7c8QU1IFm', 'SUPER, ADD, EDIT, DELETE'),
(9, 'Bruna', 'bruna@gmail.com', '92eb5ffee6ae2fec3ad71c777531578f', 'SUPER, ADD, EDIT, DELETE');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `contatos`
--
ALTER TABLE `contatos`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `foto_contato`
--
ALTER TABLE `foto_contato`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `contatos`
--
ALTER TABLE `contatos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de tabela `foto_contato`
--
ALTER TABLE `foto_contato`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
