-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 14/09/2024 às 21:55
-- Versão do servidor: 10.4.32-MariaDB
-- Versão do PHP: 8.0.30

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
(1, 29, 'PENDENTE', '2024-08-21 17:06:27', 20.00),
(2, 29, 'ENTREGUE', '2024-08-21 17:06:34', 40.00),
(3, 29, 'ENTREGUE', '2024-08-21 17:07:09', 40.00),
(4, 29, 'PENDENTE', '2024-08-21 17:18:24', 80.00),
(5, 29, 'ENTREGUE', '2024-08-21 17:32:58', 36.00),
(6, 28, 'PENDENTE', '2024-08-21 17:41:31', 36.00),
(7, 28, 'ENTREGUE', '2024-08-21 17:51:10', 140.00),
(8, 28, 'EM PREPARO', '2024-08-21 17:51:22', 16.00),
(9, 29, 'ENTREGUE', '2024-08-21 18:33:02', 212.00),
(11, 29, 'PENDENTE', '2024-09-11 18:05:00', 20.00),
(12, 29, 'PENDENTE', '2024-09-11 18:05:36', 40.00),
(13, 28, 'ENTREGUE', '2024-09-11 18:09:05', 16.00),
(14, 29, 'PENDENTE', '2024-09-11 18:20:29', 60.00),
(15, 29, 'PENDENTE', '2024-09-11 18:20:55', 60.00),
(16, 29, 'PENDENTE', '2024-09-11 18:20:57', 60.00),
(17, 29, 'PENDENTE', '2024-09-11 18:21:00', 80.00),
(18, 29, 'PENDENTE', '2024-09-11 18:21:35', 80.00),
(19, 29, 'PENDENTE', '2024-09-12 22:05:38', 66.00);

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
(18, 19, 13, 3, 8.00);

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
(13, 'Coca docinha para você curtir sua marmita com sabor e qualidade', 8, 'Coca Top Zero', '1726089774_coca-cola-zero-600-ml.jpg');

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
  `senha` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `tb_user`
--

INSERT INTO `tb_user` (`id`, `nome`, `img`, `cargo`, `nivel`, `xp`, `email`, `senha`) VALUES
(28, 'Wesley', 'uploads/IMG-20240804-WA0054.jpg', 'USER', 1, 63, 'wesley@gmail.com', '1234567'),
(29, 'admin', 'uploads/Default_Create_a_logo_for_a_web_development_agency_that_convey_0.jpg', 'ADMIN', 3, 261, 'conradtsamuel@gmail.com', '1234567');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT de tabela `tb_pedidos`
--
ALTER TABLE `tb_pedidos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT de tabela `tb_pedido_itens`
--
ALTER TABLE `tb_pedido_itens`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT de tabela `tb_produtos`
--
ALTER TABLE `tb_produtos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de tabela `tb_user`
--
ALTER TABLE `tb_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

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
