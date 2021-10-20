-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : mar. 19 oct. 2021 à 10:00
-- Version du serveur : 10.4.20-MariaDB
-- Version de PHP : 8.0.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `ecf_mediatheque`
--

-- --------------------------------------------------------

--
-- Structure de la table `administrateur`
--

CREATE TABLE `administrateur` (
  `id` int(11) NOT NULL,
  `email` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `roles` longtext COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '(DC2Type:json)',
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prenom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `administrateur`
--

INSERT INTO `administrateur` (`id`, `email`, `roles`, `password`, `prenom`, `nom`) VALUES
(1, 'admin@test.com', '[\"ROLE_ADMIN\"]', '$2y$13$HltIWbVNfcXUIZF6GP7RpemjX7W5Z7j1mWK/69CXDFoBagtoeRzVm', 'John', 'Smith');

-- --------------------------------------------------------

--
-- Structure de la table `administrateur_employe`
--

CREATE TABLE `administrateur_employe` (
  `administrateur_id` int(11) NOT NULL,
  `employe_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `doctrine_migration_versions`
--

CREATE TABLE `doctrine_migration_versions` (
  `version` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `doctrine_migration_versions`
--

INSERT INTO `doctrine_migration_versions` (`version`, `executed_at`, `execution_time`) VALUES
('DoctrineMigrations\\Version20211012082846', '2021-10-12 08:29:00', 249),
('DoctrineMigrations\\Version20211012083519', '2021-10-12 08:35:26', 48),
('DoctrineMigrations\\Version20211012090633', '2021-10-12 09:06:41', 47),
('DoctrineMigrations\\Version20211012090746', '2021-10-12 09:07:53', 48),
('DoctrineMigrations\\Version20211012091032', '2021-10-12 09:10:39', 153),
('DoctrineMigrations\\Version20211012091309', '2021-10-12 09:13:16', 171),
('DoctrineMigrations\\Version20211012131315', '2021-10-12 13:13:19', 34),
('DoctrineMigrations\\Version20211012134827', '2021-10-12 13:48:33', 36),
('DoctrineMigrations\\Version20211012165343', '2021-10-12 16:53:47', 47),
('DoctrineMigrations\\Version20211012170441', '2021-10-12 17:04:45', 44),
('DoctrineMigrations\\Version20211013082203', '2021-10-13 08:22:10', 62),
('DoctrineMigrations\\Version20211013121822', '2021-10-13 12:18:27', 37),
('DoctrineMigrations\\Version20211013122732', '2021-10-13 12:27:38', 36),
('DoctrineMigrations\\Version20211013153025', '2021-10-13 15:30:31', 37),
('DoctrineMigrations\\Version20211015161520', '2021-10-15 16:15:29', 119),
('DoctrineMigrations\\Version20211017072757', '2021-10-17 07:28:08', 205),
('DoctrineMigrations\\Version20211018123933', '2021-10-18 12:39:40', 213),
('DoctrineMigrations\\Version20211018134951', '2021-10-18 13:49:56', 47),
('DoctrineMigrations\\Version20211018135102', '2021-10-18 13:51:07', 193);

-- --------------------------------------------------------

--
-- Structure de la table `employe`
--

CREATE TABLE `employe` (
  `id` int(11) NOT NULL,
  `email` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `roles` longtext COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '(DC2Type:json)',
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prenom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `livre_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `employe`
--

INSERT INTO `employe` (`id`, `email`, `roles`, `password`, `prenom`, `nom`, `livre_id`) VALUES
(7, 'employe@test.com', '[\"ROLE_EMPLOYE\"]', '$2y$13$xajyuJjzteo5i0ZY3rkGSewhBPVYQhIZpBmCGh95ssYhz7fTMQf86', 'John', 'Smith', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `inscrit`
--

CREATE TABLE `inscrit` (
  `id` int(11) NOT NULL,
  `email` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `roles` longtext COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '(DC2Type:json)',
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prenom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `adresse_postale` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_naissance` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `inscrit`
--

INSERT INTO `inscrit` (`id`, `email`, `roles`, `password`, `prenom`, `nom`, `adresse_postale`, `date_naissance`) VALUES
(1, 'jean@rochefort.com', '[\"ROLE_INSCRIT\"]', '$2y$13$0dQ/AfBKb7t0fFnKc5IVr.9f/N5LNOp96/qJX34LVrqca.Vwd.cSm', 'Jean', 'Rochefort', '22 rue chapelle', '1971-05-01 00:00:00'),
(2, 'pierre@pierre.com', '[\"ROLE_ATTENTE\",\"ROLE_INSCRIT\"]', '$2y$13$n3A758am1HuJT7ehRljKJ.J2/QSXOtBtArr2Q5uUegFPe7uOdHEne', 'pierre', 'pierrre', 'pierre', '1971-01-01 00:00:00'),
(3, 'amelie@poulain.com', '[]', '$2y$13$fdpnT0GAKY4S3wVR3CpcSuUg8IKwPjWI/cxNVaII0q2OdZQZgTCk2', 'Amelie', 'Poulain', '14 rue Poulain', '1971-01-01 00:00:00');

-- --------------------------------------------------------

--
-- Structure de la table `livre`
--

CREATE TABLE `livre` (
  `id` int(11) NOT NULL,
  `titre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `auteur` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_parution` datetime NOT NULL,
  `genre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `disponible` tinyint(1) NOT NULL,
  `file` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date_emprunt` datetime DEFAULT NULL,
  `date_retour` datetime DEFAULT NULL,
  `inscrit_id` int(11) DEFAULT NULL,
  `confirme` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `livre`
--

INSERT INTO `livre` (`id`, `titre`, `auteur`, `date_parution`, `genre`, `description`, `disponible`, `file`, `date_emprunt`, `date_retour`, `inscrit_id`, `confirme`) VALUES
(3, 'Harry Potter et l\'école des sorciers', 'J.K.Rowling', '1997-06-26 00:00:00', 'Fantastique', 'Harry Potter et ses amis', 0, '6166e14f1255d013340738.jpg', '2021-10-18 09:15:52', '2021-11-08 09:15:52', 1, 0),
(5, 'Le Seigneur des anneaux (Tome 1) - La fraternité de l\'anneau', 'J. R. R. Tolkien', '1954-04-02 00:00:00', 'Fantastique', 'Le récit des aventures de Frodo et de ses compagnons, traversant la Terre du Milieu.', 0, '6167d7bf12f3f294019712.jpg', '2021-09-02 12:08:16', '2021-11-07 12:08:16', 1, 1),
(6, 'Le Seigneur des anneaux (Tome 2) - Les Deux Tours', 'J. R. R. Tolkien', '1955-04-21 00:00:00', 'Fantastique', 'Poursuit le récit des aventures de Frodo et de ses compagnons, lancés dans leur périple en Terre du Milieu.', 0, '6167d827de5bb994497542.jpg', '2021-10-17 12:10:28', '2021-11-07 12:10:28', 1, 1),
(7, 'Autant en emporte le vent', 'Margaret Mitchell', '1936-01-01 00:00:00', 'Romance', 'Au printemps de l\'année 1861, la vie s\'écoule paisiblement en Géorgie. Des rumeurs de guerre circulent, car l\'État de Géorgie a quitté l\'Union pour devenir un État confédéré.', 1, '6167d8a6a86ed952671308.jpg', '2021-11-05 15:29:45', '2021-11-05 15:29:45', NULL, NULL),
(8, 'Le Roi Lion - le roman du film', 'Walt Disney Company', '2019-07-01 00:00:00', 'Enfant', 'Sur les plaines arides de la savane africaine, un prince vient de naître. Tous les animaux de la Terre des Lions se sont rassemblés pour rendre hommage à Simba, leur futur roi.', 1, '6167da4217fad725711709.jpg', '2021-11-05 15:30:13', '2021-11-05 15:30:13', NULL, NULL);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `administrateur`
--
ALTER TABLE `administrateur`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_32EB52E8E7927C74` (`email`);

--
-- Index pour la table `administrateur_employe`
--
ALTER TABLE `administrateur_employe`
  ADD PRIMARY KEY (`administrateur_id`,`employe_id`),
  ADD KEY `IDX_CF51F4297EE5403C` (`administrateur_id`),
  ADD KEY `IDX_CF51F4291B65292` (`employe_id`);

--
-- Index pour la table `doctrine_migration_versions`
--
ALTER TABLE `doctrine_migration_versions`
  ADD PRIMARY KEY (`version`);

--
-- Index pour la table `employe`
--
ALTER TABLE `employe`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_F804D3B9E7927C74` (`email`),
  ADD KEY `IDX_F804D3B937D925CB` (`livre_id`);

--
-- Index pour la table `inscrit`
--
ALTER TABLE `inscrit`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_927FA365E7927C74` (`email`);

--
-- Index pour la table `livre`
--
ALTER TABLE `livre`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_AC634F996DCD4FEE` (`inscrit_id`);
ALTER TABLE `livre` ADD FULLTEXT KEY `IDX_AC634F99FF7747B455AB140` (`titre`,`auteur`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `administrateur`
--
ALTER TABLE `administrateur`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `employe`
--
ALTER TABLE `employe`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pour la table `inscrit`
--
ALTER TABLE `inscrit`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `livre`
--
ALTER TABLE `livre`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `administrateur_employe`
--
ALTER TABLE `administrateur_employe`
  ADD CONSTRAINT `FK_CF51F4291B65292` FOREIGN KEY (`employe_id`) REFERENCES `employe` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_CF51F4297EE5403C` FOREIGN KEY (`administrateur_id`) REFERENCES `administrateur` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `employe`
--
ALTER TABLE `employe`
  ADD CONSTRAINT `FK_F804D3B937D925CB` FOREIGN KEY (`livre_id`) REFERENCES `livre` (`id`);

--
-- Contraintes pour la table `livre`
--
ALTER TABLE `livre`
  ADD CONSTRAINT `FK_AC634F996DCD4FEE` FOREIGN KEY (`inscrit_id`) REFERENCES `inscrit` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
