-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le :  mer. 28 fév. 2018 à 14:15
-- Version du serveur :  5.7.19
-- Version de PHP :  7.1.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `mealoclock`
--

-- --------------------------------------------------------

--
-- Structure de la table `communities`
--

CREATE TABLE `communities` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` mediumtext NOT NULL,
  `image` varchar(1000) NOT NULL DEFAULT 'public/images/community.jpg',
  `slug` varchar(255) NOT NULL,
  `creator_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `communities`
--

INSERT INTO `communities` (`id`, `name`, `description`, `image`, `slug`, `creator_id`) VALUES
(1, 'Vegan', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 'vegan.jpg', 'vegan', 1),
(2, 'Gluten-free', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 'glutenfree.jpg', 'gluten-free', 1),
(3, 'No Lactose', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 'lactosefree.jpg', 'no-lactose', 1);

-- --------------------------------------------------------

--
-- Structure de la table `events`
--

CREATE TABLE `events` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` mediumtext NOT NULL,
  `event_date` datetime NOT NULL,
  `limit_person` int(10) UNSIGNED NOT NULL,
  `address` varchar(255) NOT NULL,
  `cash` float NOT NULL,
  `creator_id` int(10) UNSIGNED NOT NULL,
  `community_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `events`
--

INSERT INTO `events` (`id`, `title`, `description`, `event_date`, `limit_person`, `address`, `cash`, `creator_id`, `community_id`) VALUES
(1, 'On a faim', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit.', '2018-03-01 00:00:00', 5, 'Lyon', 15, 1, 2),
(2, 'On en a gros', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit.', '2018-04-01 00:00:00', 6, 'Paris', 0, 1, 1),
(3, 'Les affamés', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit.', '2018-03-15 00:00:00', 0, 'Paris', 30, 1, 3),
(4, 'Qu\'est ce qui rend aimable ?', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit.', '2018-03-01 00:00:00', 5, 'Nantes', 0, 1, 3);

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` int(11) UNSIGNED NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `photo` varchar(1000) NOT NULL DEFAULT 'public/images/profil.jpg',
  `address` varchar(255) NOT NULL,
  `description` mediumtext NOT NULL,
  `is_admin` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `firstname`, `lastname`, `email`, `password`, `photo`, `address`, `description`, `is_admin`) VALUES
(1, 'julien', 'poupouille', 'julien@oclock.io', '', 'public/images/profil.jpg', '', '', 1),
(4, 'Toto', 'lasticot', 'toto@gmail.com', '$2y$10$jNcbXcLY50dM/5ikzC6dUunLPuDQoQwF9ekyihEEWJqktlT298aXe', 'public/images/profil.jpg', '3 rue des gigolos, 66 600 Oulche la vallée foulon', '                                                non....                                                                                                                                                ', 0),
(5, 'Toto', 'lasticot', 'toto@gmail.com', '$2y$10$Q/sB0w0wLmDolqP1UH4YTuxEHF.dPFUYg93C2hbOYd6q/dJw.JwSa', 'public/images/profil.jpg', '3 rue des gigolos, 66 600 Oulche la vallée foulon', '                                                                        non....                                                                                                                                                                    ', 0);

-- --------------------------------------------------------

--
-- Structure de la table `users_communities`
--

CREATE TABLE `users_communities` (
  `user_id` int(10) UNSIGNED NOT NULL,
  `community_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `users_events`
--

CREATE TABLE `users_events` (
  `user_id` int(10) UNSIGNED NOT NULL,
  `event_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `communities`
--
ALTER TABLE `communities`
  ADD PRIMARY KEY (`id`),
  ADD KEY `creator_id` (`creator_id`);

--
-- Index pour la table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`),
  ADD KEY `creator_id` (`creator_id`),
  ADD KEY `community_id` (`community_id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `users_communities`
--
ALTER TABLE `users_communities`
  ADD PRIMARY KEY (`user_id`,`community_id`);

--
-- Index pour la table `users_events`
--
ALTER TABLE `users_events`
  ADD PRIMARY KEY (`user_id`,`event_id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `communities`
--
ALTER TABLE `communities`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `events`
--
ALTER TABLE `events`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
