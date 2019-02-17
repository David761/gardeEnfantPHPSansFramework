-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:8889
-- Généré le :  mar. 27 nov. 2018 à 13:18
-- Version du serveur :  5.7.23
-- Version de PHP :  7.2.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `childcare`
--

-- --------------------------------------------------------

--
-- Structure de la table `availability`
--

CREATE TABLE `availability` (
  `id` int(11) NOT NULL,
  `date` date DEFAULT NULL,
  `begin` time DEFAULT NULL,
  `end` time DEFAULT NULL,
  `seats` int(11) DEFAULT NULL,
  `professionnels_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `children`
--

CREATE TABLE `children` (
  `id` int(11) NOT NULL,
  `name` varchar(45) DEFAULT NULL,
  `firstname` varchar(45) DEFAULT NULL,
  `birthday` date DEFAULT NULL,
  `description` longtext,
  `user_id1` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `children_has_professionnels`
--

CREATE TABLE `children_has_professionnels` (
  `children_id` int(11) NOT NULL,
  `professionnels_id` int(11) NOT NULL,
  `planning_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `planning`
--

CREATE TABLE `planning` (
  `id` int(11) NOT NULL,
  `date` date NOT NULL,
  `begin` time DEFAULT NULL,
  `end` time DEFAULT NULL,
  `ref` int(11) DEFAULT NULL,
  `active` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `professionnels`
--

CREATE TABLE `professionnels` (
  `id` int(11) NOT NULL,
  `name` varchar(80) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `pwd` char(100) DEFAULT NULL,
  `valid` tinyint(1) NOT NULL,
  `phone` varchar(45) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `num_agreement` varchar(100) DEFAULT NULL,
  `num_siret` varchar(100) DEFAULT NULL,
  `active` tinyint(4) DEFAULT NULL,
  `price` int(11) DEFAULT NULL,
  `picture` varchar(255) DEFAULT NULL,
  `verif` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `name` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `name` varchar(45) DEFAULT NULL,
  `firstname` varchar(45) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(100) NOT NULL,
  `pwd` char(64) DEFAULT NULL,
  `valid` tinyint(1) NOT NULL,
  `roles_id` int(11) NOT NULL,
  `verif` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `availability`
--
ALTER TABLE `availability`
  ADD PRIMARY KEY (`id`,`professionnels_id`),
  ADD KEY `fk_availability_professionnels1_idx` (`professionnels_id`);

--
-- Index pour la table `children`
--
ALTER TABLE `children`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_children_user1_idx` (`user_id1`);

--
-- Index pour la table `children_has_professionnels`
--
ALTER TABLE `children_has_professionnels`
  ADD PRIMARY KEY (`children_id`,`professionnels_id`,`planning_id`),
  ADD KEY `fk_children_has_professionnels_professionnels1_idx` (`professionnels_id`),
  ADD KEY `fk_children_has_professionnels_children1_idx` (`children_id`),
  ADD KEY `fk_children_has_professionnels_planning1_idx` (`planning_id`);

--
-- Index pour la table `planning`
--
ALTER TABLE `planning`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `professionnels`
--
ALTER TABLE `professionnels`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`,`roles_id`),
  ADD KEY `fk_user_roles1_idx` (`roles_id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `availability`
--
ALTER TABLE `availability`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `children`
--
ALTER TABLE `children`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `planning`
--
ALTER TABLE `planning`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `professionnels`
--
ALTER TABLE `professionnels`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `availability`
--
ALTER TABLE `availability`
  ADD CONSTRAINT `fk_availability_professionnels1` FOREIGN KEY (`professionnels_id`) REFERENCES `professionnels` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `children`
--
ALTER TABLE `children`
  ADD CONSTRAINT `fk_children_user1` FOREIGN KEY (`user_id1`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `children_has_professionnels`
--
ALTER TABLE `children_has_professionnels`
  ADD CONSTRAINT `fk_children_has_professionnels_children1` FOREIGN KEY (`children_id`) REFERENCES `children` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_children_has_professionnels_planning1` FOREIGN KEY (`planning_id`) REFERENCES `planning` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_children_has_professionnels_professionnels1` FOREIGN KEY (`professionnels_id`) REFERENCES `professionnels` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `fk_user_roles1` FOREIGN KEY (`roles_id`) REFERENCES `roles` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
