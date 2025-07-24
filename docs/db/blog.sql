-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 24/07/2025 às 18:31
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
-- Banco de dados: `blog`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Despejando dados para a tabela `posts`
--

INSERT INTO `posts` (`id`, `title`, `image`, `description`, `user_id`, `created_at`, `updated_at`) VALUES
(10, 'Programação Moderna: Você Está Acompanhando?', 'uploads/posts/1753332606_f8c6c1d6b9a279b7f075.jpg', 'Novas linguagens, frameworks e metodologias estão moldando o futuro. Veja o que está em alta e como não ficar para trás no mercado tech.', 1, '2025-07-24 04:50:06', '2025-07-24 04:50:06'),
(11, 'Como Pensam os Programadores?', 'uploads/posts/1753332645_cc2e73345f92129ed488.jpg', 'Programar vai além de escrever código. É resolver problemas, otimizar processos e criar o invisível. Veja os bastidores da mente de um dev moderno.', 1, '2025-06-24 04:50:45', '2025-07-24 01:54:32'),
(12, 'Código Limpo: O Poder da Simplicidade', 'uploads/posts/1753332684_4d18ff0b0f9f442b9f2c.jpg', 'Menos é mais. Aprenda por que escrever código limpo e legível é o que separa iniciantes de profissionais no mundo da programação.', 1, '2025-05-24 04:51:24', '2025-07-24 01:54:25'),
(13, 'Frameworks que Estão Dominando 2025', 'uploads/posts/1753333205_b4632fe3ae812e272962.jpg', 'React, Svelte, Astro, Next… quais ferramentas estão moldando os projetos mais rápidos da web? Conheça o que está em alta agora.', 1, '2025-07-24 05:00:05', '2025-07-24 05:00:05');

-- --------------------------------------------------------

--
-- Estrutura para tabela `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) DEFAULT NULL,
  `session_token` varchar(128) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Despejando dados para a tabela `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `session_token`, `created_at`, `updated_at`) VALUES
(1, 'Leandro De Souza Lima', 'admin@gmail.com', '$2a$12$FkDyYVfHAUA987eIwZ0VqeyzFKEjg59FLsfXxfPHmbXkvFz5g59pC', 'f802352584b71f56163f54856cd7de79e123f6f59929d02952abe329dd8c7a30', '2025-07-23 22:56:33', '2025-07-24 16:23:09');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_posts_users` (`user_id`);

--
-- Índices de tabela `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de tabela `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `fk_posts_users` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
