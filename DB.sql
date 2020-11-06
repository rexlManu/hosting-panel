-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Erstellungszeit: 06. Jun 2020 um 18:43
-- Server-Version: 10.1.44-MariaDB-0+deb9u1
-- PHP-Version: 7.3.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `startyournode`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `bots`
--

CREATE TABLE `bots` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `bot_name` varchar(255) NOT NULL,
  `node_id` varchar(255) NOT NULL,
  `state` enum('active','deleted') NOT NULL,
  `server_addr` varchar(255) DEFAULT NULL,
  `volume` int(11) NOT NULL DEFAULT '20',
  `template_name` varchar(255) NOT NULL,
  `bot_id` int(11) DEFAULT NULL,
  `price` decimal(12,2) NOT NULL,
  `last_stream` varchar(255) DEFAULT NULL,
  `auto_repeat` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `bot_nodes`
--

CREATE TABLE `bot_nodes` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `node_ip` varchar(255) NOT NULL,
  `unique_id` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `state` enum('active','disabled') NOT NULL,
  `limit` int(11) DEFAULT NULL,
  `port` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `settings`
--

CREATE TABLE `settings` (
  `login` int(11) NOT NULL,
  `register` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `settings`
--

INSERT INTO `settings` (`login`, `register`) VALUES
(1, 1);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `stream_links`
--

CREATE TABLE `stream_links` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `url` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `tickets`
--

CREATE TABLE `tickets` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `categorie` varchar(255) NOT NULL,
  `priority` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `state` varchar(255) NOT NULL,
  `last_msg` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `ticket_message`
--

CREATE TABLE `ticket_message` (
  `id` int(11) NOT NULL,
  `ticket_id` int(11) NOT NULL,
  `writer_id` int(11) NOT NULL,
  `message` longtext NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `state` enum('pending','active') NOT NULL,
  `role` enum('customer','supporter','admin') NOT NULL,
  `plesk_uid` varchar(255) DEFAULT NULL,
  `plesk_password` varchar(255) DEFAULT NULL,
  `session_token` varchar(255) DEFAULT NULL,
  `verify_code` varchar(255) DEFAULT NULL,
  `user_addr` varchar(255) DEFAULT NULL,
  `support_pin` varchar(255) DEFAULT NULL,
  `bot_limit` int(11) NOT NULL DEFAULT '2',
  `webspace_limit` int(11) NOT NULL DEFAULT '2',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `voucher`
--

CREATE TABLE `voucher` (
  `id` int(11) NOT NULL,
  `code` varchar(255) NOT NULL,
  `bot_slots` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `webspace`
--

CREATE TABLE `webspace` (
  `id` int(11) NOT NULL,
  `plan_id` varchar(255) NOT NULL,
  `user_id` int(11) NOT NULL,
  `ftp_name` varchar(255) NOT NULL,
  `ftp_password` varchar(255) NOT NULL,
  `domainName` varchar(255) NOT NULL,
  `webspace_id` int(11) NOT NULL,
  `state` enum('active','suspended','deleted') NOT NULL,
  `expire_at` datetime NOT NULL,
  `price` decimal(12,2) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `webspace_host`
--

CREATE TABLE `webspace_host` (
  `id` int(11) NOT NULL,
  `domainName` varchar(255) NOT NULL,
  `ip` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `webspace_host`
--

INSERT INTO `webspace_host` (`id`, `domainName`, `ip`, `name`, `password`, `created_at`, `updated_at`) VALUES
(1, 'startyournode.web.space', '193.70.68.138', 'web_reseller01_startyournode', 'aXzaC5O2KjdtKmlWSJTE52MjSUrf7v2bPWCJU5qj2iljEy8JetSvuCWfeSEgiDYJhKgZhMzL9WzHQJziQd7Its2wRxKNtKpybYpm', '2019-11-13 22:13:00', '2020-05-26 18:51:57');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `webspace_packs`
--

CREATE TABLE `webspace_packs` (
  `id` int(11) NOT NULL,
  `plesk_id` varchar(255) NOT NULL,
  `price` decimal(12,2) NOT NULL,
  `disc` varchar(255) NOT NULL,
  `subdomains` varchar(255) NOT NULL,
  `databases` varchar(255) NOT NULL,
  `ftp_accounts` varchar(255) NOT NULL,
  `emails` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `webspace_packs`
--

INSERT INTO `webspace_packs` (`id`, `plesk_id`, `price`, `disc`, `subdomains`, `databases`, `ftp_accounts`, `emails`, `created_at`, `updated_at`) VALUES
(1, 'Starter', '0.00', '1', '5', '5', '5', '5', '2019-11-13 05:17:27', '2020-05-21 20:28:07');

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `bots`
--
ALTER TABLE `bots`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `bot_nodes`
--
ALTER TABLE `bot_nodes`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `stream_links`
--
ALTER TABLE `stream_links`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `tickets`
--
ALTER TABLE `tickets`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_2` (`id`),
  ADD KEY `id` (`id`);

--
-- Indizes für die Tabelle `ticket_message`
--
ALTER TABLE `ticket_message`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `voucher`
--
ALTER TABLE `voucher`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `webspace`
--
ALTER TABLE `webspace`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `webspace_host`
--
ALTER TABLE `webspace_host`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `webspace_packs`
--
ALTER TABLE `webspace_packs`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `bots`
--
ALTER TABLE `bots`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `bot_nodes`
--
ALTER TABLE `bot_nodes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `stream_links`
--
ALTER TABLE `stream_links`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `tickets`
--
ALTER TABLE `tickets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `ticket_message`
--
ALTER TABLE `ticket_message`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `voucher`
--
ALTER TABLE `voucher`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `webspace`
--
ALTER TABLE `webspace`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT für Tabelle `webspace_host`
--
ALTER TABLE `webspace_host`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT für Tabelle `webspace_packs`
--
ALTER TABLE `webspace_packs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
