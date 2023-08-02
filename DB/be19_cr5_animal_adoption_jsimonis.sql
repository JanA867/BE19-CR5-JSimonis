-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Erstellungszeit: 02. Aug 2023 um 14:07
-- Server-Version: 10.4.28-MariaDB
-- PHP-Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `be19_cr5_animal_adoption_jsimonis`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `animals`
--

CREATE TABLE `animals` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `location` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `size` varchar(255) NOT NULL,
  `vaccinated` varchar(255) NOT NULL,
  `age` int(11) NOT NULL,
  `breed` varchar(255) NOT NULL,
  `gender` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'available',
  `picture` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Daten für Tabelle `animals`
--

INSERT INTO `animals` (`id`, `name`, `location`, `description`, `size`, `vaccinated`, `age`, `breed`, `gender`, `status`, `picture`) VALUES
(5, 'Bärli', 'Berlin, Germany', 'Your new best friend, except he is hungry', 'medium', '1', 9, 'Icebear', 'other', 'adopted', '64c4f0dbc1482.jpg'),
(6, 'Herold', 'Siberia, Russia', 'Fluffy, but angry all the time', 'large', '1', 8, 'Deer', 'male', 'adopted', '64c4f1cd49a06.jpg'),
(7, 'Dora', 'Toronto, Canada', 'Wild and playful, loves to cuddle', 'large', '1', 4, 'Bear', 'female', 'adopted', '64c4f24c26b9d.jpg'),
(8, 'Lasslo', 'Chang Mai, Thailand', 'In training', 'medium', '2', 2, 'Elephant', 'male', 'adopted', '64c4f2a59c647.jpg'),
(9, 'Samira', 'Vienna, Austria', 'Queen of the Danube', 'medium', '2', 9, 'Swan', 'female', 'available', '64c4f2e0baba8.jpg'),
(10, 'Tonya', 'San Diego, California', 'Smart, wise and kinky', 'small', '1', 10, 'Fox', 'female', 'available', '64c4f344a19b2.jpg'),
(11, 'Barong', 'Kenia, Africa', 'Learned how to draw, he is the next Picasso', 'large', '1', 12, 'Gorilla', 'male', 'adopted', '64c4f38134259.jpg'),
(12, 'Bipo', 'Kiel, Germany', 'A white Snowflake, loves to run fast', 'medium', '1', 3, 'Horse', 'male', 'available', '64c4f3f54be0c.jpg'),
(13, 'Hank', 'Edinburgh, Scotland', 'Feels confident to be the king, bit arrogant', 'large', '1', 6, 'Lion', 'male', 'available', '64c4f46367653.jpg'),
(14, 'Shannaya', 'Sri Lanka, India', 'Hunts everything down and loves to play fetch', 'medium', '1', 12, 'Tiger', 'female', 'available', '64c4f4c0ac270.jpg'),
(15, 'Pinoccio', 'Rom, Italy', 'Desires to be a real horse', 'small', '2', 24, 'Rocking Horse', 'other', 'adopted', '64c4f5174a482.jpg'),
(16, 'Jenny', 'New Mexico, US', 'Channels voices from outside, be carful...claims she is a medium', 'small', '2', 1, 'Sheep', 'female', 'available', '64c4f5b398f4a.jpg'),
(17, 'Michael J. Jr.', 'Siberia, Russia', 'Chilled old dude', 'medium', '1', 13, 'Tiger', 'male', 'available', '64c4f5ec0c3ea.jpg'),
(18, 'Ronda', 'Sao Paulo, Brazil', 'Thinks she is an alligator, was found in a waste press ', 'large', '2', 700, 'T-Rex', 'other', 'available', '64c4f6a881d9d.jpg');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `pet_adoption`
--

CREATE TABLE `pet_adoption` (
  `ID` int(11) NOT NULL,
  `DATE` datetime DEFAULT NULL,
  `NEW_OWNER_ID` int(11) DEFAULT NULL,
  `PET_ID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Daten für Tabelle `pet_adoption`
--

INSERT INTO `pet_adoption` (`ID`, `DATE`, `NEW_OWNER_ID`, `PET_ID`) VALUES
(5, '2023-07-31 11:53:58', 1, 7),
(6, '2023-07-31 11:54:04', 1, 11),
(7, '2023-07-31 11:55:18', 1, 8),
(8, '2023-07-31 12:05:06', 1, 5),
(9, '2023-07-31 12:12:52', 1, 6),
(10, '2023-07-31 12:13:33', 1, 15);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `picture` varchar(255) DEFAULT NULL,
  `status` varchar(4) NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Daten für Tabelle `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `password`, `email`, `address`, `phone`, `picture`, `status`) VALUES
(1, 'Lady', 'Bugeru', '96cae35ce8a9b0244178bf28e4966c2ce1b8385723a96a6b838858cdd6ca0a1e', 'test@gmail.com', 'Praterstraße, 23', '123456', '64c50091cb0d9.jpg', 'user'),
(2, 'Admin', 'Administrator', '96cae35ce8a9b0244178bf28e4966c2ce1b8385723a96a6b838858cdd6ca0a1e', 'admin@admin.org', 'Praterstraße 23', '123456', '64c4f97bea199.jpg', 'adm');

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `animals`
--
ALTER TABLE `animals`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `pet_adoption`
--
ALTER TABLE `pet_adoption`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `NEW_OWNER_ID` (`NEW_OWNER_ID`),
  ADD KEY `PET_ID` (`PET_ID`);

--
-- Indizes für die Tabelle `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `animals`
--
ALTER TABLE `animals`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT für Tabelle `pet_adoption`
--
ALTER TABLE `pet_adoption`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT für Tabelle `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints der exportierten Tabellen
--

--
-- Constraints der Tabelle `pet_adoption`
--
ALTER TABLE `pet_adoption`
  ADD CONSTRAINT `pet_adoption_ibfk_1` FOREIGN KEY (`NEW_OWNER_ID`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `pet_adoption_ibfk_2` FOREIGN KEY (`PET_ID`) REFERENCES `animals` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
