-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 06/01/2025 às 13:53
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
-- Banco de dados: `dbsisagendador`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `ordemservico`
--

CREATE TABLE `ordemservico` (
  `idOrdemServico` int(11) NOT NULL,
  `produtoServicoOS` varchar(100) NOT NULL,
  `descricaoOS` text NOT NULL,
  `dataEntrada` date NOT NULL,
  `dataSaida` date DEFAULT NULL,
  `idCliente` int(11) NOT NULL,
  `statusOS` varchar(100) NOT NULL,
  `valorServico` float NOT NULL,
  `tipoPagamento` varchar(100) NOT NULL,
  `statusPagamento` varchar(80) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `ordemservico`
--

INSERT INTO `ordemservico` (`idOrdemServico`, `produtoServicoOS`, `descricaoOS`, `dataEntrada`, `dataSaida`, `idCliente`, `statusOS`, `valorServico`, `tipoPagamento`, `statusPagamento`) VALUES
(1, 'Manutenção de Computador', 'Troca de peças e limpeza interna.', '2024-01-05', '2024-01-10', 1, 'Concluído', 350, 'Cartão de Crédito', '1'),
(2, 'Reparo de Smartphone', 'Substituição da tela quebrada.', '2024-01-08', '2024-01-12', 2, 'Pendente', 250, 'Dinheiro', '0'),
(3, 'Instalação de Software', 'Instalação do pacote Office.', '2024-01-09', '2024-01-10', 3, 'Concluído', 150, 'Pix', '1'),
(4, 'Manutenção de Impressora', 'Troca do cartucho e limpeza.', '2024-01-11', '2024-01-15', 4, 'Concluído', 200, 'Não informado', 'Pago'),
(5, 'Configuração de Rede', 'Configuração de roteador e Wi-Fi.', '2024-01-10', '2024-01-13', 5, 'Concluído', 180, 'Dinheiro', 'Pago'),
(6, 'Troca de Teclado', 'Teclado do notebook com defeito.', '2024-01-12', '2024-01-14', 1, 'Concluído', 300, 'Não informado', 'Pago'),
(7, 'Reparo de Monitor', 'Correção de problemas de imagem.', '2024-01-14', '2024-01-18', 2, 'Concluído', 400, 'Pix', '1'),
(8, 'Atualização de Sistema', 'Atualização para a última versão.', '2024-01-15', '2024-01-16', 3, 'Concluído', 120, 'Dinheiro', 'Pago'),
(9, 'Manutenção de Notebook', 'Troca de HD para SSD.', '2024-01-17', '2024-01-20', 4, 'Concluído', 600, 'Dinheiro', 'Pago'),
(10, 'Reparo de Cabo', 'Substituição de cabo danificado.', '2024-01-18', '2024-01-19', 5, 'Pendente', 80, 'Dinheiro', '0'),
(14, 'Formatação', 'Realizar a  limpesa e formatação em um LG A530.', '2025-01-02', '2025-01-03', 4, 'Em Andamento', 100, 'Dinheiro', 'Pago');

-- --------------------------------------------------------

--
-- Estrutura para tabela `tbcliente`
--

CREATE TABLE `tbcliente` (
  `idCliente` int(11) NOT NULL,
  `nomeCliente` varchar(100) NOT NULL,
  `emailCliente` varchar(100) NOT NULL,
  `telefoneCliente` varchar(80) NOT NULL,
  `sexoCliente` char(1) NOT NULL,
  `dataNascCliente` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `tbcliente`
--

INSERT INTO `tbcliente` (`idCliente`, `nomeCliente`, `emailCliente`, `telefoneCliente`, `sexoCliente`, `dataNascCliente`) VALUES
(1, 'João Silva', 'joao.silva@gmail.com', '11987654321', 'M', '1985-04-12'),
(2, 'Maria Oliveira', 'maria.oliveira@yahoo.com', '21987654321', 'F', '1990-07-25'),
(3, 'Pedro Santos', 'pedro.santos@outlook.com', '31987654321', 'M', '1982-12-10'),
(4, 'Ana Paula', 'ana.paula@gmail.com', '41987654321', 'F', '1995-03-08'),
(5, 'Carlos Souza', 'carlos.souza@hotmail.com', '51987654321', 'M', '1988-09-15'),
(6, 'Maria da Silva', 'maria@gmail.com', '48996459865', 'F', '1992-11-28');

-- --------------------------------------------------------

--
-- Estrutura para tabela `users`
--

CREATE TABLE `users` (
  `idUser` int(11) NOT NULL,
  `email` varchar(30) NOT NULL,
  `senha` varchar(64) NOT NULL,
  `nome` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `users`
--

INSERT INTO `users` (`idUser`, `email`, `senha`, `nome`) VALUES
(1, 'crisscbc.21@gmail.com', '8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92', 'Cristiano'),
(2, 'criss@gmail.com', '8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92', 'Cristiano'),
(3, 'carlos@gmail.com', '8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92', 'Carlos');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `ordemservico`
--
ALTER TABLE `ordemservico`
  ADD PRIMARY KEY (`idOrdemServico`),
  ADD KEY `idCliente` (`idCliente`);

--
-- Índices de tabela `tbcliente`
--
ALTER TABLE `tbcliente`
  ADD PRIMARY KEY (`idCliente`);

--
-- Índices de tabela `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`idUser`),
  ADD UNIQUE KEY `mail` (`email`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `ordemservico`
--
ALTER TABLE `ordemservico`
  MODIFY `idOrdemServico` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT de tabela `tbcliente`
--
ALTER TABLE `tbcliente`
  MODIFY `idCliente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de tabela `users`
--
ALTER TABLE `users`
  MODIFY `idUser` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `ordemservico`
--
ALTER TABLE `ordemservico`
  ADD CONSTRAINT `ordemservico_ibfk_1` FOREIGN KEY (`idCliente`) REFERENCES `tbcliente` (`idCliente`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
