-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Erstellungszeit: 21. Apr 2023 um 08:14
-- Server-Version: 10.4.27-MariaDB
-- PHP-Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `tripontime`
--
CREATE DATABASE IF NOT EXISTS `tripontime` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `tripontime`;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `accommodation`
--

CREATE TABLE `accommodation` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `fk_location_id` int(11) DEFAULT NULL,
  `fk_type_id` int(11) DEFAULT NULL,
  `fk_preferences_id` int(11) DEFAULT NULL,
  `fk_budget_id` int(11) DEFAULT NULL,
  `fk_season_id` int(11) DEFAULT NULL,
  `image` varchar(255) NOT NULL,
  `description` varchar(600) DEFAULT NULL,
  `capacity` int(11) DEFAULT NULL,
  `website` varchar(255) DEFAULT NULL,
  `review` varchar(600) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `activity`
--

CREATE TABLE `activity` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `fk_location_id` int(11) DEFAULT NULL,
  `fk_type_id` int(11) DEFAULT NULL,
  `fk_preferences_id` int(11) DEFAULT NULL,
  `fk_budget_id` int(11) DEFAULT NULL,
  `fk_season_id` int(11) DEFAULT NULL,
  `image` varchar(255) NOT NULL,
  `description` varchar(600) DEFAULT NULL,
  `website` varchar(255) DEFAULT NULL,
  `capacity` int(11) DEFAULT NULL,
  `review` varchar(600) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `budget`
--

CREATE TABLE `budget` (
  `id` int(11) NOT NULL,
  `name` varchar(55) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Daten für Tabelle `budget`
--

INSERT INTO `budget` (`id`, `name`) VALUES
(1, 'economy'),
(2, 'medium'),
(3, 'luxury'),
(4, 'any');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `doctrine_migration_versions`
--

CREATE TABLE `doctrine_migration_versions` (
  `version` varchar(191) NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Daten für Tabelle `doctrine_migration_versions`
--

INSERT INTO `doctrine_migration_versions` (`version`, `executed_at`, `execution_time`) VALUES
('DoctrineMigrations\\Version20230419091957', '2023-04-19 09:20:15', 103);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `journal`
--

CREATE TABLE `journal` (
  `id` int(11) NOT NULL,
  `fk_user_id` int(11) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `image` varchar(255) NOT NULL,
  `description` varchar(900) DEFAULT NULL,
  `website` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Daten für Tabelle `journal`
--

INSERT INTO `journal` (`id`, `fk_user_id`, `name`, `image`, `description`, `website`) VALUES
(1, 3, 'journal1', 'pic.jpg', 'dsfdsfdsfdsfdsf', 'jkjkj.com'),
(2, 3, 'gym holiday', 'gym-644134de28421.jpg', 'what a nice holiday', 'www.gym.at');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `location`
--

CREATE TABLE `location` (
  `id` int(11) NOT NULL,
  `continent` varchar(55) DEFAULT NULL,
  `country` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `zip` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Daten für Tabelle `location`
--

INSERT INTO `location` (`id`, `continent`, `country`, `city`, `zip`) VALUES
(1, 'Europe', 'Austria', 'Vienna', 1050);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `messenger_messages`
--

CREATE TABLE `messenger_messages` (
  `id` bigint(20) NOT NULL,
  `body` longtext NOT NULL,
  `headers` longtext NOT NULL,
  `queue_name` varchar(190) NOT NULL,
  `created_at` datetime NOT NULL,
  `available_at` datetime NOT NULL,
  `delivered_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `packinglist`
--

CREATE TABLE `packinglist` (
  `id` int(11) NOT NULL,
  `name` varchar(55) NOT NULL,
  `icon` varchar(255) DEFAULT NULL,
  `fk_type_id` int(11) DEFAULT NULL,
  `fk_preferences_id` int(11) DEFAULT NULL,
  `fk_season_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Daten für Tabelle `packinglist`
--

INSERT INTO `packinglist` (`id`, `name`, `icon`, `fk_type_id`, `fk_preferences_id`, `fk_season_id`) VALUES
(3, 'sun glasses', 'fa-solid  fa-glasses', 4, 4, 4),
(4, 'shirt', 'fa-solid fa-shirt', 3, 3, 3),
(5, 'socks', 'fa-solid fa-socks', 3, 3, 3),
(6, 'Dress', 'fa-solid fa-person-dress', 3, 3, 3),
(7, 'gloves', 'fa-solid fa-mitten', 3, 3, 3),
(8, 'shoes', 'fa-solid fa-shoe-prints', 3, 3, 3),
(9, 'ticket', 'fa-solid fa-ticket', 3, 3, 3),
(10, 'passport', 'fa-solid fa-passport', 3, 3, 3),
(11, 'credit cards', 'fa-regular fa-credit-card', 3, 3, 3),
(12, 'Insurance card', 'fa-solid fa-address-card', 3, 3, 3),
(13, 'Identity card', 'fa-regular fa-id-card', 3, 3, 3),
(14, 'Mobile', 'fa-solid fa-mobile-screen-button', 3, 3, 3),
(15, 'laptop', 'fa-solid fa-laptop', 3, 3, 3),
(16, 'Medicine', 'fa-solid fa-tablets', 3, 3, 3),
(17, 'water bottle', 'fa-solid fa-bottle-water', 3, 3, 3),
(18, 'Medical-kit', 'fa-solid fa-kit-medical', 3, 3, 3),
(19, 'headphones', 'fa-solid fa-headphones', 3, 3, 3),
(20, 'book', 'fa-solid fa-book', 3, 3, 3),
(21, 'lipbalm', 'fa-regular fa-face-kiss', 3, 3, 3),
(22, 'Body lotion', 'fa-solid fa-bottle-droplet', 3, 3, 3),
(23, 'sunscream', 'fa-regular fa-face-smile', 3, 3, 3),
(24, 'deodorant', 'fa-solid fa-bottle-droplet', 3, 3, 3),
(25, 'tooth-brush', 'fa-solid fa-tooth', 3, 3, 3),
(26, 'hair gel', 'fa-brands fa-twitter', 3, 3, 3);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `preferences`
--

CREATE TABLE `preferences` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `indoor` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Daten für Tabelle `preferences`
--

INSERT INTO `preferences` (`id`, `name`, `indoor`) VALUES
(1, 'music', 1),
(2, 'film', 1),
(3, 'literature', 1),
(4, 'hiking', 0),
(5, 'swimming', 0),
(6, 'tennis', 0),
(7, 'spa', 1),
(8, 'beach', 0),
(9, 'yoga', 1),
(10, 'any', 1),
(11, 'any', 0);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `restaurant`
--

CREATE TABLE `restaurant` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `fk_location_id` int(11) DEFAULT NULL,
  `fk_type_id` int(11) DEFAULT NULL,
  `fk_preferences_id` int(11) DEFAULT NULL,
  `fk_budget_id` int(11) DEFAULT NULL,
  `fk_season_id` int(11) DEFAULT NULL,
  `image` varchar(255) NOT NULL,
  `description` varchar(600) DEFAULT NULL,
  `capacity` int(11) DEFAULT NULL,
  `website` varchar(255) DEFAULT NULL,
  `review` varchar(600) DEFAULT NULL,
  `cuisine` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `season`
--

CREATE TABLE `season` (
  `id` int(11) NOT NULL,
  `name` varchar(55) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Daten für Tabelle `season`
--

INSERT INTO `season` (`id`, `name`) VALUES
(1, 'Spring'),
(2, 'Summer'),
(3, 'Autumn'),
(4, 'Winter'),
(5, 'Any');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `type`
--

CREATE TABLE `type` (
  `id` int(11) NOT NULL,
  `name` varchar(55) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Daten für Tabelle `type`
--

INSERT INTO `type` (`id`, `name`) VALUES
(1, 'Culture'),
(2, 'Sport'),
(3, 'Relax'),
(4, 'Adventure'),
(5, 'Any');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `email` varchar(180) NOT NULL,
  `roles` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`roles`)),
  `password` varchar(255) NOT NULL,
  `first_name` varchar(55) NOT NULL,
  `last_name` varchar(55) NOT NULL,
  `picture` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Daten für Tabelle `user`
--

INSERT INTO `user` (`id`, `email`, `roles`, `password`, `first_name`, `last_name`, `picture`) VALUES
(1, 'user@one.com', '[\"ROLE_ADMIN\"]', 'userone', 'user', 'one', 'pic.jpg'),
(2, 'admin@admin.com', '[\"ROLE_ADMIN\"]', 'admin', 'admin', 'admin', 'admin.jpg'),
(3, 'xtine@gmx.at', '[\"ROLE_ADMIN\"]', '$2y$13$jstPp5HEWdI2rHRSSb1y6eVgrIPO3oI2ldal.t2Xi7CQRAtyc.sHK', 'Christine', 'Weidhofer', NULL),
(4, 'email2@email.com', '[]', '$2y$13$qcHRSB/f.U4qNYHyD/Xaxu3mz1SO3BueRTaT6A1HuFgu.7/JYX.ge', 'asd', 'asd', 'text.jpg'),
(5, 'admin2@admin.com', '[\"ROLE_ADMIN\"]', '$2y$13$CLsoWc0iqRu/tgwEnXBUfelMMo20LnqSgdp1SD9DB1dmNNpleo6ke', 'a', 'bbbb', 'd.jpg'),
(6, 'serri@gmail.com', '[]', '$2y$13$r3YE5YD3X4YGYWDDihGPzeeQG4QMrH4NmbjXSyOC2tac..4IbCNfC', 'test', 'test', NULL),
(7, 'admin@mail.com', '[]', '$2y$13$HNk.nhd.PlmFF4rpFOC7n./TqR2MDlZ5iaHpn/NhtnvsYxWCIMeUS', 'Admin', 'Admin', NULL);

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `accommodation`
--
ALTER TABLE `accommodation`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_2D3854126FBB8DBA` (`fk_location_id`),
  ADD KEY `IDX_2D3854123563B1BF` (`fk_type_id`),
  ADD KEY `IDX_2D3854129C3865E` (`fk_preferences_id`),
  ADD KEY `IDX_2D38541257F27128` (`fk_budget_id`),
  ADD KEY `IDX_2D3854122F99D641` (`fk_season_id`);

--
-- Indizes für die Tabelle `activity`
--
ALTER TABLE `activity`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_AC74095A6FBB8DBA` (`fk_location_id`),
  ADD KEY `IDX_AC74095A3563B1BF` (`fk_type_id`),
  ADD KEY `IDX_AC74095A9C3865E` (`fk_preferences_id`),
  ADD KEY `IDX_AC74095A57F27128` (`fk_budget_id`),
  ADD KEY `IDX_AC74095A2F99D641` (`fk_season_id`);

--
-- Indizes für die Tabelle `budget`
--
ALTER TABLE `budget`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `doctrine_migration_versions`
--
ALTER TABLE `doctrine_migration_versions`
  ADD PRIMARY KEY (`version`);

--
-- Indizes für die Tabelle `journal`
--
ALTER TABLE `journal`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_C1A7E74D5741EEB9` (`fk_user_id`);

--
-- Indizes für die Tabelle `location`
--
ALTER TABLE `location`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `messenger_messages`
--
ALTER TABLE `messenger_messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_75EA56E0FB7336F0` (`queue_name`),
  ADD KEY `IDX_75EA56E0E3BD61CE` (`available_at`),
  ADD KEY `IDX_75EA56E016BA31DB` (`delivered_at`);

--
-- Indizes für die Tabelle `packinglist`
--
ALTER TABLE `packinglist`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_21A166983563B1BF` (`fk_type_id`),
  ADD KEY `IDX_21A166989C3865E` (`fk_preferences_id`),
  ADD KEY `IDX_21A166982F99D641` (`fk_season_id`);

--
-- Indizes für die Tabelle `preferences`
--
ALTER TABLE `preferences`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `restaurant`
--
ALTER TABLE `restaurant`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_EB95123F6FBB8DBA` (`fk_location_id`),
  ADD KEY `IDX_EB95123F3563B1BF` (`fk_type_id`),
  ADD KEY `IDX_EB95123F9C3865E` (`fk_preferences_id`),
  ADD KEY `IDX_EB95123F57F27128` (`fk_budget_id`),
  ADD KEY `IDX_EB95123F2F99D641` (`fk_season_id`);

--
-- Indizes für die Tabelle `season`
--
ALTER TABLE `season`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `type`
--
ALTER TABLE `type`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_8D93D649E7927C74` (`email`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `accommodation`
--
ALTER TABLE `accommodation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `activity`
--
ALTER TABLE `activity`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `budget`
--
ALTER TABLE `budget`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT für Tabelle `journal`
--
ALTER TABLE `journal`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT für Tabelle `location`
--
ALTER TABLE `location`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT für Tabelle `messenger_messages`
--
ALTER TABLE `messenger_messages`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `packinglist`
--
ALTER TABLE `packinglist`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT für Tabelle `preferences`
--
ALTER TABLE `preferences`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT für Tabelle `restaurant`
--
ALTER TABLE `restaurant`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `season`
--
ALTER TABLE `season`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT für Tabelle `type`
--
ALTER TABLE `type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT für Tabelle `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints der exportierten Tabellen
--

--
-- Constraints der Tabelle `accommodation`
--
ALTER TABLE `accommodation`
  ADD CONSTRAINT `FK_2D3854122F99D641` FOREIGN KEY (`fk_season_id`) REFERENCES `season` (`id`),
  ADD CONSTRAINT `FK_2D3854123563B1BF` FOREIGN KEY (`fk_type_id`) REFERENCES `type` (`id`),
  ADD CONSTRAINT `FK_2D38541257F27128` FOREIGN KEY (`fk_budget_id`) REFERENCES `budget` (`id`),
  ADD CONSTRAINT `FK_2D3854126FBB8DBA` FOREIGN KEY (`fk_location_id`) REFERENCES `location` (`id`),
  ADD CONSTRAINT `FK_2D3854129C3865E` FOREIGN KEY (`fk_preferences_id`) REFERENCES `preferences` (`id`);

--
-- Constraints der Tabelle `activity`
--
ALTER TABLE `activity`
  ADD CONSTRAINT `FK_AC74095A2F99D641` FOREIGN KEY (`fk_season_id`) REFERENCES `season` (`id`),
  ADD CONSTRAINT `FK_AC74095A3563B1BF` FOREIGN KEY (`fk_type_id`) REFERENCES `type` (`id`),
  ADD CONSTRAINT `FK_AC74095A57F27128` FOREIGN KEY (`fk_budget_id`) REFERENCES `budget` (`id`),
  ADD CONSTRAINT `FK_AC74095A6FBB8DBA` FOREIGN KEY (`fk_location_id`) REFERENCES `location` (`id`),
  ADD CONSTRAINT `FK_AC74095A9C3865E` FOREIGN KEY (`fk_preferences_id`) REFERENCES `preferences` (`id`);

--
-- Constraints der Tabelle `journal`
--
ALTER TABLE `journal`
  ADD CONSTRAINT `FK_C1A7E74D5741EEB9` FOREIGN KEY (`fk_user_id`) REFERENCES `user` (`id`);

--
-- Constraints der Tabelle `packinglist`
--
ALTER TABLE `packinglist`
  ADD CONSTRAINT `FK_21A166982F99D641` FOREIGN KEY (`fk_season_id`) REFERENCES `season` (`id`),
  ADD CONSTRAINT `FK_21A166983563B1BF` FOREIGN KEY (`fk_type_id`) REFERENCES `type` (`id`),
  ADD CONSTRAINT `FK_21A166989C3865E` FOREIGN KEY (`fk_preferences_id`) REFERENCES `preferences` (`id`);

--
-- Constraints der Tabelle `restaurant`
--
ALTER TABLE `restaurant`
  ADD CONSTRAINT `FK_EB95123F2F99D641` FOREIGN KEY (`fk_season_id`) REFERENCES `season` (`id`),
  ADD CONSTRAINT `FK_EB95123F3563B1BF` FOREIGN KEY (`fk_type_id`) REFERENCES `type` (`id`),
  ADD CONSTRAINT `FK_EB95123F57F27128` FOREIGN KEY (`fk_budget_id`) REFERENCES `budget` (`id`),
  ADD CONSTRAINT `FK_EB95123F6FBB8DBA` FOREIGN KEY (`fk_location_id`) REFERENCES `location` (`id`),
  ADD CONSTRAINT `FK_EB95123F9C3865E` FOREIGN KEY (`fk_preferences_id`) REFERENCES `preferences` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
