-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 28 Lis 2022, 16:14
-- Wersja serwera: 10.4.25-MariaDB
-- Wersja PHP: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `schronisko`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `datek`
--

CREATE TABLE `datek` (
  `imie` varchar(25) NOT NULL,
  `nazwisko` varchar(26) NOT NULL,
  `ilosc` int(11) NOT NULL,
  `numer` int(26) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `datek`
--

INSERT INTO `datek` (`imie`, `nazwisko`, `ilosc`, `numer`) VALUES
('jgd', 'Szczygiel', 4324, 2147483647);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `pieski`
--

CREATE TABLE `pieski` (
  `id` int(11) NOT NULL,
  `imie` varchar(25) NOT NULL,
  `wiek` int(11) NOT NULL,
  `gatunek` varchar(25) NOT NULL,
  `data` date DEFAULT NULL,
  `adopcja` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `pieski`
--

INSERT INTO `pieski` (`id`, `imie`, `wiek`, `gatunek`, `data`, `adopcja`) VALUES
(1, 'latek', 2, 'pies', NULL, 0),
(2, 'Robin', 4, 'Pies', '2021-03-05', 0),
(3, 'Lulus', 1, 'pies', '2021-10-10', 0),
(4, 'Fufus', 5, 'Koń', '2022-04-06', 0),
(5, 'Latek', 2, 'Kot', '2022-11-01', 0),
(6, 'Feliks', 3, 'Kot', '2021-05-07', 0);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `users`
--

CREATE TABLE `users` (
  `imie` varchar(25) NOT NULL,
  `nazwisko` varchar(30) NOT NULL,
  `login` text NOT NULL,
  `email` text NOT NULL,
  `haslo` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `users`
--

INSERT INTO `users` (`imie`, `nazwisko`, `login`, `email`, `haslo`) VALUES
('Bartek', 'Szczygiel', 'bszczygiel', 'bartekszczygiel6@gmail.com', 'bartek123'),
('szymon', 'Szczygiel', 'momuczen60', '$2y$10$8K2TUwgF9xyv2rSV9kbJjeOgezKAxSSXudp4iYvTNbJe4O14d/quG', 'seriale003@gmail.com'),
('jgd', 'Szczygiel', 'owasz', '$2y$10$L473gEMjl3KexrRKCtIWxO1LTTX00bJbcobCe8K1JOgFBr/dDfRlO', 'Jakubszczygiel100@gmail.com'),
('artur', 'klatka', 'arturito', 'klatka@klatka.pl', '$2y$10$xtEGWoe6syRvHJ83gGN02uGLdCOz5KT5J44dTdrm5KT7HdXJym9ye');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `wolontariusz`
--

CREATE TABLE `wolontariusz` (
  `imie` varchar(25) NOT NULL,
  `nazwisko` varchar(30) NOT NULL,
  `email` text NOT NULL,
  `telefon` int(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `wolontariusz`
--

INSERT INTO `wolontariusz` (`imie`, `nazwisko`, `email`, `telefon`) VALUES
('jgdx', 'xxxxxxxxxxxxxxx', 'seriale003@gmail.com', 123456789),
('Bartosz', 'Szczygiel', 'Jakubszczygiel100@gmail.com', 543252);

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `pieski`
--
ALTER TABLE `pieski`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT dla zrzuconych tabel
--

--
-- AUTO_INCREMENT dla tabeli `pieski`
--
ALTER TABLE `pieski`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
