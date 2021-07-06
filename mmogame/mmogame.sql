-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- 主機： 127.0.0.1
-- 產生時間： 2019 年 04 月 22 日 13:32
-- 伺服器版本： 10.1.38-MariaDB
-- PHP 版本： 7.3.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 資料庫： `mmogame`
--

-- --------------------------------------------------------

--
-- 資料表結構 `character_info`
--

CREATE TABLE `character_info` (
  `User_ID` varchar(8) DEFAULT NULL,
  `Level` int(11) DEFAULT NULL,
  `Char_Name` varchar(20) NOT NULL,
  `EXP` int(11) DEFAULT NULL,
  `Char_Money` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- 傾印資料表的資料 `character_info`
--

INSERT INTO `character_info` (`User_ID`, `Level`, `Char_Name`, `EXP`, `Char_Money`) VALUES
('peter', 3, 'chan', 8, 59),
('peter', 1, 'fightc', 0, 6),
('peter', 1, 'fighterr', 0, 0),
('ricky', 2, 'fightr', 14, 6),
('testing', 1, 'hi', 0, 6);

-- --------------------------------------------------------

--
-- 資料表結構 `enemy`
--

CREATE TABLE `enemy` (
  `Enemy_ID` char(4) NOT NULL,
  `Enemy_Name` varchar(30) DEFAULT NULL,
  `ATK` int(11) DEFAULT NULL,
  `DEF` int(11) DEFAULT NULL,
  `EXP` int(11) DEFAULT NULL,
  `money` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- 傾印資料表的資料 `enemy`
--

INSERT INTO `enemy` (`Enemy_ID`, `Enemy_Name`, `ATK`, `DEF`, `EXP`, `money`) VALUES
('EN01', 'slime', 5, 1, 5, 3),
('EN02', 'goblin', 15, 7, 9, 15),
('EN03', 'orc', 25, 20, 30, 30),
('EN04', 'ape hero', 56, 50, 50, 50),
('EN05', 'sheild', 20, 90, 70, 5);

-- --------------------------------------------------------

--
-- 資料表結構 `inventory`
--

CREATE TABLE `inventory` (
  `Char_Name` varchar(20) DEFAULT NULL,
  `Item_ID` char(4) DEFAULT NULL,
  `Equipped` char(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- 傾印資料表的資料 `inventory`
--

INSERT INTO `inventory` (`Char_Name`, `Item_ID`, `Equipped`) VALUES
('chan', 'IT02', 'E'),
('chan', 'IT03', NULL),
('chan', 'IT01', NULL),
('chan', 'IT04', 'E'),
('chan', 'IT03', NULL);

-- --------------------------------------------------------

--
-- 資料表結構 `item`
--

CREATE TABLE `item` (
  `Item_ID` char(4) NOT NULL,
  `Item_type` int(11) NOT NULL,
  `Item_name` varchar(20) DEFAULT NULL,
  `Item_stats` int(11) DEFAULT NULL,
  `Item_description` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- 傾印資料表的資料 `item`
--

INSERT INTO `item` (`Item_ID`, `Item_type`, `Item_name`, `Item_stats`, `Item_description`) VALUES
('IT01', 1, 'Excalibur', 999999, 'you dirty hacker.'),
('IT02', 2, 'cotton shirt', 2, 'A shirt made by cotton,quite warm in winter.'),
('IT03', 2, 'Iron plate', 5, 'an iron-made armor, quite tough'),
('IT04', 1, 'ironsword', 5, 'A simple tough sword made in iron');

-- --------------------------------------------------------

--
-- 資料表結構 `level_stats`
--

CREATE TABLE `level_stats` (
  `Level` int(11) NOT NULL,
  `HP` int(11) DEFAULT NULL,
  `ATK` int(11) DEFAULT NULL,
  `DEF` int(11) DEFAULT NULL,
  `exp_to_next` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- 傾印資料表的資料 `level_stats`
--

INSERT INTO `level_stats` (`Level`, `HP`, `ATK`, `DEF`, `exp_to_next`) VALUES
(1, 10, 10, 10, 10),
(2, 12, 12, 12, 15),
(3, 15, 15, 15, 25);

-- --------------------------------------------------------

--
-- 資料表結構 `room`
--

CREATE TABLE `room` (
  `RID` int(11) DEFAULT NULL,
  `Char_Name` varchar(20) DEFAULT NULL,
  `HP` int(11) DEFAULT NULL,
  `Enemy_ID` char(4) DEFAULT NULL,
  `EHP` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- 資料表結構 `shop`
--

CREATE TABLE `shop` (
  `Item_ID` char(4) DEFAULT NULL,
  `prices` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- 傾印資料表的資料 `shop`
--

INSERT INTO `shop` (`Item_ID`, `prices`) VALUES
('IT02', 25),
('IT03', 15),
('IT04', 30),
('IT01', 99999);

-- --------------------------------------------------------

--
-- 資料表結構 `user_account`
--

CREATE TABLE `user_account` (
  `User_ID` varchar(8) NOT NULL,
  `User_pw` varchar(8) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- 傾印資料表的資料 `user_account`
--

INSERT INTO `user_account` (`User_ID`, `User_pw`) VALUES
('a', 'bb'),
('chan', 'aa'),
('peter', '12345'),
('ricky', '45678'),
('testing', '1234');

--
-- 已傾印資料表的索引
--

--
-- 資料表索引 `character_info`
--
ALTER TABLE `character_info`
  ADD PRIMARY KEY (`Char_Name`),
  ADD KEY `User_ID` (`User_ID`),
  ADD KEY `Level` (`Level`);

--
-- 資料表索引 `enemy`
--
ALTER TABLE `enemy`
  ADD PRIMARY KEY (`Enemy_ID`);

--
-- 資料表索引 `inventory`
--
ALTER TABLE `inventory`
  ADD KEY `Char_Name` (`Char_Name`),
  ADD KEY `Item_ID` (`Item_ID`);

--
-- 資料表索引 `item`
--
ALTER TABLE `item`
  ADD PRIMARY KEY (`Item_ID`,`Item_type`);

--
-- 資料表索引 `level_stats`
--
ALTER TABLE `level_stats`
  ADD PRIMARY KEY (`Level`);

--
-- 資料表索引 `room`
--
ALTER TABLE `room`
  ADD KEY `Char_Name` (`Char_Name`),
  ADD KEY `Enemy_ID` (`Enemy_ID`);

--
-- 資料表索引 `shop`
--
ALTER TABLE `shop`
  ADD KEY `Item_ID` (`Item_ID`);

--
-- 資料表索引 `user_account`
--
ALTER TABLE `user_account`
  ADD PRIMARY KEY (`User_ID`);

--
-- 已傾印資料表的限制(constraint)
--

--
-- 資料表的限制(constraint) `character_info`
--
ALTER TABLE `character_info`
  ADD CONSTRAINT `character_info_ibfk_1` FOREIGN KEY (`User_ID`) REFERENCES `user_account` (`User_ID`),
  ADD CONSTRAINT `character_info_ibfk_2` FOREIGN KEY (`Level`) REFERENCES `level_stats` (`Level`);

--
-- 資料表的限制(constraint) `inventory`
--
ALTER TABLE `inventory`
  ADD CONSTRAINT `inventory_ibfk_1` FOREIGN KEY (`Char_Name`) REFERENCES `character_info` (`Char_Name`),
  ADD CONSTRAINT `inventory_ibfk_2` FOREIGN KEY (`Item_ID`) REFERENCES `item` (`Item_ID`);

--
-- 資料表的限制(constraint) `room`
--
ALTER TABLE `room`
  ADD CONSTRAINT `room_ibfk_1` FOREIGN KEY (`Char_Name`) REFERENCES `character_info` (`Char_Name`),
  ADD CONSTRAINT `room_ibfk_2` FOREIGN KEY (`Enemy_ID`) REFERENCES `enemy` (`Enemy_ID`);

--
-- 資料表的限制(constraint) `shop`
--
ALTER TABLE `shop`
  ADD CONSTRAINT `shop_ibfk_1` FOREIGN KEY (`Item_ID`) REFERENCES `item` (`Item_ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
