-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 08/01/2025 às 17:18
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
-- Banco de dados: `nutribox`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_carrinho`
--

CREATE TABLE `tb_carrinho` (
  `id` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `produto_id` int(11) NOT NULL,
  `quantidade` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_pedidos`
--

CREATE TABLE `tb_pedidos` (
  `id` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `status` varchar(50) NOT NULL,
  `data_criacao` datetime NOT NULL,
  `valor_total` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `tb_pedidos`
--

INSERT INTO `tb_pedidos` (`id`, `usuario_id`, `status`, `data_criacao`, `valor_total`) VALUES
(3, 29, 'ENTREGUE', '2024-08-21 17:07:09', 40.00),
(4, 29, 'ENTREGUE', '2024-08-21 17:18:24', 80.00),
(5, 29, 'ENTREGUE', '2024-08-21 17:32:58', 36.00),
(6, 28, 'ENTREGUE', '2024-08-21 17:41:31', 36.00),
(7, 28, 'ENTREGUE', '2024-08-21 17:51:10', 140.00),
(8, 28, 'ENTREGUE', '2024-08-21 17:51:22', 16.00),
(9, 29, 'ENTREGUE', '2024-08-21 18:33:02', 212.00),
(11, 29, 'ENTREGUE', '2024-09-11 18:05:00', 20.00),
(12, 29, 'ENTREGUE', '2024-09-11 18:05:36', 40.00),
(13, 28, 'ENTREGUE', '2024-09-11 18:09:05', 16.00),
(15, 29, 'PENDENTE', '2024-09-11 18:20:55', 60.00),
(16, 29, 'PENDENTE', '2024-09-11 18:20:57', 60.00),
(17, 29, 'PENDENTE', '2024-09-11 18:21:00', 80.00),
(18, 29, 'ENTREGUE', '2024-09-11 18:21:35', 80.00),
(19, 29, 'ENTREGUE', '2024-09-12 22:05:38', 66.00),
(20, 29, 'ENTREGUE', '2025-01-03 16:17:39', 16.00),
(21, 33, 'ENTREGUE', '2025-01-03 16:41:09', 20.00),
(22, 33, 'ENTREGUE', '2025-01-04 18:56:23', 9.00),
(23, 33, 'ENTREGUE', '2025-01-08 12:37:07', 24.00),
(24, 35, 'ENTREGUE', '2025-01-08 12:52:53', 16.00),
(25, 36, 'ENTREGUE', '2025-01-08 12:55:37', 16.00),
(26, 37, 'ENTREGUE', '2025-01-08 12:57:24', 22.00),
(27, 29, 'ENTREGUE', '2025-01-08 13:00:29', 45.00),
(28, 29, 'ENTREGUE', '2025-01-08 13:00:50', 64.00),
(29, 39, 'PENDENTE', '2025-01-08 13:04:59', 20.00),
(30, 29, 'ENTREGUE', '2025-01-08 13:06:30', 44.00),
(31, 29, 'PENDENTE', '2025-01-08 13:07:04', 63.00);

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_pedido_itens`
--

CREATE TABLE `tb_pedido_itens` (
  `id` int(11) NOT NULL,
  `pedido_id` int(11) NOT NULL,
  `produto_id` int(11) NOT NULL,
  `quantidade` int(11) NOT NULL,
  `preco` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `tb_pedido_itens`
--

INSERT INTO `tb_pedido_itens` (`id`, `pedido_id`, `produto_id`, `quantidade`, `preco`) VALUES
(1, 3, 12, 2, 20.00),
(2, 4, 12, 4, 20.00),
(3, 5, 3, 1, 16.00),
(4, 5, 12, 1, 20.00),
(5, 6, 3, 1, 16.00),
(6, 6, 12, 1, 20.00),
(7, 7, 12, 7, 20.00),
(8, 8, 3, 1, 16.00),
(9, 9, 3, 7, 16.00),
(10, 9, 12, 5, 20.00),
(13, 11, 12, 1, 20.00),
(14, 12, 12, 2, 20.00),
(15, 13, 3, 1, 16.00),
(16, 18, 12, 4, 20.00),
(17, 19, 12, 1, 20.00),
(20, 20, 3, 1, 16.00),
(21, 21, 3, 1, 16.00),
(22, 21, 20, 1, 4.00),
(23, 22, 16, 1, 9.00),
(24, 23, 3, 1, 16.00),
(25, 23, 18, 1, 8.00),
(26, 24, 3, 1, 16.00),
(27, 25, 3, 1, 16.00),
(28, 26, 16, 1, 9.00),
(29, 26, 17, 1, 13.00),
(30, 27, 3, 1, 16.00),
(31, 27, 12, 1, 20.00),
(32, 27, 16, 1, 9.00),
(33, 28, 3, 4, 16.00),
(34, 29, 12, 1, 20.00),
(35, 30, 3, 1, 16.00),
(36, 30, 12, 1, 20.00),
(37, 30, 18, 1, 8.00),
(38, 31, 16, 7, 9.00);

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_produtos`
--

CREATE TABLE `tb_produtos` (
  `id` int(11) NOT NULL,
  `descricao` text NOT NULL,
  `preco` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `imagem` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `tb_produtos`
--

INSERT INTO `tb_produtos` (`id`, `descricao`, `preco`, `nome`, `imagem`) VALUES
(3, '- Arroz <br> \n- Feijão <br>\n- Batata <br>\n- Salada <br>\n- Farofa <br>\n- Carne do Dia <br>', 16, 'Marmita P', '1723593270_52866d65-a282-4568-ad0d-08c526bec45f.webp'),
(12, '- Arroz <br> \r\n- Feijão <br>\r\n- Batata <br>\r\n- Salada <br>\r\n- Farofa <br>\r\n- Carne do Dia <br>\r\n- Pure', 20, 'Marmita M', '1723756910_Dicas-para-uma-marmita.png'),
(16, 'Folhas verdes, tomate, pepino, cenoura, cebola roxa, abacate, azeitonas, queijo, sementes ou nozes, azeite de oliva, vinagre ou limão, sal e pimenta.', 9, 'Porção de Salada P', '1735932693_prato-de-salada-orig-1.webp'),
(17, 'Folhas verdes, tomate, pepino, cenoura, cebola roxa, abacate, azeitonas, queijo, sementes ou nozes, azeite de oliva, vinagre ou limão, sal e pimenta.', 13, 'Porção de Salada M', '1735932749_salada1-1.webp'),
(18, 'Refrigente Coca Cola zero ', 8, 'Coca Cola zero 600ml', '1735932862_coca coal 600.jfif'),
(20, 'Água Gaseficada', 4, 'Água com gás 600ml', '1735932979_agua com gas.webp');

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_user`
--

CREATE TABLE `tb_user` (
  `id` int(11) NOT NULL,
  `nome` varchar(254) NOT NULL DEFAULT 'admin',
  `img` text DEFAULT NULL,
  `cargo` varchar(12) NOT NULL DEFAULT 'ADMIN',
  `nivel` int(11) DEFAULT 1,
  `xp` int(11) NOT NULL DEFAULT 1,
  `email` varchar(200) NOT NULL DEFAULT 'admin@gmail.com',
  `senha` varchar(255) NOT NULL,
  `endereco` varchar(255) NOT NULL DEFAULT 'rua exemplo, cidade exemplo'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `tb_user`
--

INSERT INTO `tb_user` (`id`, `nome`, `img`, `cargo`, `nivel`, `xp`, `email`, `senha`, `endereco`) VALUES
(28, 'Wesley', 'uploads/IMG-20240804-WA0054.jpg', 'USER', 1, 63, 'wesley@gmail.com', '1234567', 'rua exemplo, cidade exemplo'),
(29, 'admin', 'uploads/Default_Create_a_logo_for_a_web_development_agency_that_convey_0.jpg', 'ADMIN', 4, 331, 'admin@nutribox.com', '1234567', 'Sombrio, Januária'),
(33, 'Mateus Rosa', 'uploads/mateus.jfif', 'USER', 1, 16, 'mateusrshu1@gmail.com', '123', 'Dario Irineu Colarez, 123');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `tb_carrinho`
--
ALTER TABLE `tb_carrinho`
  ADD PRIMARY KEY (`id`),
  ADD KEY `usuario_id` (`usuario_id`),
  ADD KEY `marmita_id` (`produto_id`);

--
-- Índices de tabela `tb_pedidos`
--
ALTER TABLE `tb_pedidos`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `tb_pedido_itens`
--
ALTER TABLE `tb_pedido_itens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pedido_id` (`pedido_id`),
  ADD KEY `marmita_id` (`produto_id`);

--
-- Índices de tabela `tb_produtos`
--
ALTER TABLE `tb_produtos`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `tb_user`
--
ALTER TABLE `tb_user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `tb_carrinho`
--
ALTER TABLE `tb_carrinho`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;

--
-- AUTO_INCREMENT de tabela `tb_pedidos`
--
ALTER TABLE `tb_pedidos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT de tabela `tb_pedido_itens`
--
ALTER TABLE `tb_pedido_itens`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT de tabela `tb_produtos`
--
ALTER TABLE `tb_produtos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de tabela `tb_user`
--
ALTER TABLE `tb_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `tb_carrinho`
--
ALTER TABLE `tb_carrinho`
  ADD CONSTRAINT `tb_carrinho_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `tb_user` (`id`),
  ADD CONSTRAINT `tb_carrinho_ibfk_2` FOREIGN KEY (`produto_id`) REFERENCES `tb_produtos` (`id`);

--
-- Restrições para tabelas `tb_pedido_itens`
--
ALTER TABLE `tb_pedido_itens`
  ADD CONSTRAINT `tb_pedido_itens_ibfk_1` FOREIGN KEY (`pedido_id`) REFERENCES `tb_pedidos` (`id`),
  ADD CONSTRAINT `tb_pedido_itens_ibfk_2` FOREIGN KEY (`produto_id`) REFERENCES `tb_produtos` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
