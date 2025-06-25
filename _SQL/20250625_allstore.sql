-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 25-Jun-2025 às 21:50
-- Versão do servidor: 10.4.27-MariaDB
-- versão do PHP: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `allstore`
--
CREATE DATABASE IF NOT EXISTS `allstore` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `allstore`;

-- --------------------------------------------------------

--
-- Estrutura da tabela `grupos`
--

DROP TABLE IF EXISTS `grupos`;
CREATE TABLE `grupos` (
  `idgrupos` int(11) NOT NULL,
  `grupo_descricao` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `grupos`
--

INSERT INTO `grupos` (`idgrupos`, `grupo_descricao`) VALUES
(1, 'blusas'),
(2, 'calças'),
(3, 'vestido'),
(4, 'jaqueta'),
(5, 'short'),
(6, 'meia'),
(7, 'vestido'),
(8, 'regata');

-- --------------------------------------------------------

--
-- Estrutura da tabela `item_venda`
--

DROP TABLE IF EXISTS `item_venda`;
CREATE TABLE `item_venda` (
  `iditem_venda` int(11) NOT NULL,
  `itvd_idpedidos` int(11) NOT NULL,
  `itvd_idprodutos` int(11) NOT NULL,
  `itvd_qte` int(11) NOT NULL,
  `itvd_valor` decimal(10,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `marcas`
--

DROP TABLE IF EXISTS `marcas`;
CREATE TABLE `marcas` (
  `idmarcas` int(11) NOT NULL,
  `marca_descricao` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `marcas`
--

INSERT INTO `marcas` (`idmarcas`, `marca_descricao`) VALUES
(1, 'Adidas'),
(3, 'Adidas'),
(4, 'Oppinus'),
(5, 'sawary'),
(6, 'zara');

-- --------------------------------------------------------

--
-- Estrutura da tabela `pedidos`
--

DROP TABLE IF EXISTS `pedidos`;
CREATE TABLE `pedidos` (
  `idpedidos` int(11) NOT NULL,
  `ped_data` date NOT NULL,
  `ped_idcliente` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `produtos`
--

DROP TABLE IF EXISTS `produtos`;
CREATE TABLE `produtos` (
  `idprodutos` int(11) NOT NULL,
  `prod_descricao` varchar(100) NOT NULL,
  `prod_vlr_un` decimal(10,2) DEFAULT NULL,
  `prod_cor` varchar(50) DEFAULT NULL,
  `prod_genero` varchar(10) DEFAULT NULL,
  `prod_idmarcas` int(11) DEFAULT NULL,
  `prod_idgrupos` int(11) DEFAULT NULL,
  `prod_foto` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `produtos`
--

INSERT INTO `produtos` (`idprodutos`, `prod_descricao`, `prod_vlr_un`, `prod_cor`, `prod_genero`, `prod_idmarcas`, `prod_idgrupos`, `prod_foto`) VALUES
(1, 'blusa ciganinha', '100.00', 'azul', 'feminino', 3, 1, ''),
(2, 'calça jeans', '100.00', 'jeans', 'masculino', 4, 2, 'calca.jpeg.jpeg'),
(3, 'short jeans', '50.00', 'azul', 'feminino', 5, 5, '');

-- --------------------------------------------------------

--
-- Estrutura da tabela `routes`
--

DROP TABLE IF EXISTS `routes`;
CREATE TABLE `routes` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `controller` varchar(100) NOT NULL,
  `template` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Extraindo dados da tabela `routes`
--

INSERT INTO `routes` (`id`, `name`, `controller`, `template`) VALUES
(1, 'home', 'App\\Controller\\HomeController', 'home.html.twig'),
(12, 'Vitrine', 'App\\Controller\\ProductController', 'vitrine.html.twig'),
(4, 'error', 'App\\Controller\\ErrorController', '404.html.twig'),
(5, 'login', 'App\\Controller\\LoginController', 'login.html.twig'),
(6, 'logout', 'App\\Controller\\LogoutController', ''),
(7, 'cadastrar', 'App\\Controller\\RegisterController', 'register.html.twig'),
(8, 'Produtos', 'App\\Controller\\ProductController', 'newProduct.html.twig'),
(9, 'Grupos', 'App\\Controller\\GroupController', 'groups.html.twig'),
(11, 'Marcas', 'App\\Controller\\BrandController', 'brands.html.twig');

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE `usuarios` (
  `idusuarios` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `email` varchar(50) NOT NULL,
  `senha` varchar(255) NOT NULL,
  `tipoadmin` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `usuarios`
--

INSERT INTO `usuarios` (`idusuarios`, `nome`, `email`, `senha`, `tipoadmin`) VALUES
(1, 'marina', 'marina@gmail.com', '202cb962ac59075b964b07152d234b70', 1),
(2, 'edna', 'edna@gmail.com', '202cb962ac59075b964b07152d234b70', 0);

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `grupos`
--
ALTER TABLE `grupos`
  ADD PRIMARY KEY (`idgrupos`);

--
-- Índices para tabela `item_venda`
--
ALTER TABLE `item_venda`
  ADD PRIMARY KEY (`iditem_venda`);

--
-- Índices para tabela `marcas`
--
ALTER TABLE `marcas`
  ADD PRIMARY KEY (`idmarcas`);

--
-- Índices para tabela `pedidos`
--
ALTER TABLE `pedidos`
  ADD PRIMARY KEY (`idpedidos`);

--
-- Índices para tabela `produtos`
--
ALTER TABLE `produtos`
  ADD PRIMARY KEY (`idprodutos`),
  ADD KEY `prod_idmarcas` (`prod_idmarcas`),
  ADD KEY `produtos_ibfk_2` (`prod_idgrupos`);

--
-- Índices para tabela `routes`
--
ALTER TABLE `routes`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`idusuarios`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `grupos`
--
ALTER TABLE `grupos`
  MODIFY `idgrupos` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de tabela `item_venda`
--
ALTER TABLE `item_venda`
  MODIFY `iditem_venda` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `marcas`
--
ALTER TABLE `marcas`
  MODIFY `idmarcas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de tabela `pedidos`
--
ALTER TABLE `pedidos`
  MODIFY `idpedidos` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `produtos`
--
ALTER TABLE `produtos`
  MODIFY `idprodutos` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `routes`
--
ALTER TABLE `routes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `idusuarios` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `produtos`
--
ALTER TABLE `produtos`
  ADD CONSTRAINT `produtos_ibfk_2` FOREIGN KEY (`prod_idgrupos`) REFERENCES `grupos` (`idgrupos`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
