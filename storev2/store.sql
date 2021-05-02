-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:3306
-- Généré le : jeu. 29 avr. 2021 à 08:49
-- Version du serveur :  5.7.24
-- Version de PHP : 7.4.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `store`
--

-- --------------------------------------------------------

--
-- Structure de la table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `name` varchar(50) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `category`
--

INSERT INTO `category` (`id`, `name`) VALUES
(1, 'Consoles de jeux'),
(2, 'Animaux');

-- --------------------------------------------------------

--
-- Structure de la table `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_bin NOT NULL,
  `description` text COLLATE utf8_bin NOT NULL,
  `price` float NOT NULL,
  `image` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `available` tinyint(1) NOT NULL DEFAULT '1',
  `category_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `product`
--

INSERT INTO `product` (`id`, `name`, `description`, `price`, `image`, `available`, `category_id`) VALUES
(4, 'Sega Megadrive ', 'C\'était super mais le son, punaise, c\'était affreux...', 46.76, 'picto.jpg', 1, 1),
(5, 'Nintendo 64', 'Une console avec de bons jeux mais des cartouches toutes pourries...', 109, NULL, 1, 1),
(10, 'Xbox Series X', 'Pffrrt !', 350, NULL, 1, 1),
(13, 'Xbox Series S', 'Moins bien !', 299, NULL, 1, 1),
(15, 'PlayStation 5', 'Ohlala', 145, NULL, 1, 1),
(16, 'Panda', 'Eh ben, c&#39;est pas très légal ça...', 145, NULL, 1, 2),
(17, 'Lémurien', 'Lé mu rien, mais en fait un peu quand même !', 25, NULL, 1, 2),
(18, 'Atari 7800', 'alert(&#34;hello&#34;)', 25, NULL, 1, 1),
(19, 'Lapin', 'WHERE 1 = 1;DROP DATABASE store;', 10, NULL, 1, 2);

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `email` varchar(255) COLLATE utf8_bin NOT NULL,
  `password` varchar(255) COLLATE utf8_bin NOT NULL,
  `role` varchar(20) COLLATE utf8_bin NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `email`, `password`, `role`, `created_at`) VALUES
(2, 'virgile.gibello@gmail.com', '$argon2i$v=19$m=65536,t=4,p=1$bUwvVUtrMkNxMmFSR0Z5dw$EujpCRd7ZM3fLeACQ//H/NwUkNvrDFIIXqYmH1vzHp0', 'ROLE_ADMIN', '2021-04-12 10:12:41'),
(7, 'virgile.gibello@kikoo.com', '$argon2i$v=19$m=65536,t=4,p=1$WThqOXBTSlA1RXpZT0h6RQ$EWjYSxuKyqHp744Tr64T3Uk+vEO5EuiTGCDnAYvmy58', 'ROLE_USER', '2021-04-12 11:30:11'),
(8, 'DOE@johndoe.com', '$argon2i$v=19$m=65536,t=4,p=1$SGN3RHFYckIzeWVHaEo4MA$bZvnkQ/bg5cH6AjFs4wzJu4NTNw6R540ynBgZhaVEjQ', 'ROLE_USER', '2021-04-12 11:31:21'),
(9, 'dii@gmail.com', '$argon2i$v=19$m=65536,t=4,p=1$QnF2THhFYXB1YldsOWxLbw$Bd0avgjxYF3T1W/DQT/tks+LqKvQASUFjSLhj6CCP3o', 'ROLE_USER', '2021-04-12 11:34:19'),
(10, 'virgile.gibello@gil.com', '$argon2i$v=19$m=65536,t=4,p=1$ZkhLRGRERTQwT3A1Tngvbw$SnP3ZDfhxfc9Kz0IzRRpcK01f0RkX+8ebXmpSfE4Y3o', 'ROLE_USER', '2021-04-12 14:44:52'),
(11, 'admin@gail.com', '$argon2i$v=19$m=65536,t=4,p=1$bjdJV1ExdU13VXRnV0ZxRA$C5xlSJy1dRPSy3JMbC9QnmF3maQNpVArllMLoDyOdyA', 'ROLE_USER', '2021-04-13 16:08:44');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_CAT_PROD` (`category_id`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `FK_CAT_PROD` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
