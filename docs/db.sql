-- phpMyAdmin SQL Dump
-- version 4.4.14
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: 2017 年 6 月 03 日 23:38
-- サーバのバージョン： 5.6.26
-- PHP Version: 5.6.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tobe_master`
--

-- --------------------------------------------------------

--
-- テーブルの構造 `m_beast_house`
--

CREATE TABLE IF NOT EXISTS `m_beast_house` (
  `beast_house_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8 COMMENT='クイズに紐付ける獣舎を管理する';

--
-- テーブルのデータのダンプ `m_beast_house`
--

INSERT INTO `m_beast_house` (`beast_house_id`, `name`) VALUES
(1, 'スネークハウス'),
(2, 'ペンギン広場'),
(3, '南米獣舎'),
(4, '中獣舎'),
(5, 'ライオン舎'),
(6, 'キリン舎'),
(7, 'サイ・カバ舎'),
(8, 'サバンナ'),
(9, 'ヒョウ舎'),
(10, 'ゾウ舎'),
(11, 'タイガーヒル'),
(12, 'トラ舎'),
(13, 'モンキータウン'),
(14, '類人猿舎'),
(15, 'カンガルー舎'),
(16, 'サル山'),
(17, 'ラクダ舎'),
(18, 'クマ舎');

-- --------------------------------------------------------

--
-- テーブルの構造 `m_difficulty`
--

CREATE TABLE IF NOT EXISTS `m_difficulty` (
  `difficulty_id` int(11) NOT NULL,
  `name` varchar(10) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COMMENT='クイズ問題の難易度を管理する';

--
-- テーブルのデータのダンプ `m_difficulty`
--

INSERT INTO `m_difficulty` (`difficulty_id`, `name`) VALUES
(1, '簡単'),
(2, '普通'),
(3, '難しい'),
(4, '最終問題');

-- --------------------------------------------------------

--
-- テーブルの構造 `m_management_user`
--

CREATE TABLE IF NOT EXISTS `m_management_user` (
  `management_user_id` int(11) NOT NULL,
  `login_id` varchar(20) NOT NULL,
  `password` varchar(300) NOT NULL COMMENT 'base64で暗号化した値が入る\n'
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- テーブルのデータのダンプ `m_management_user`
--

INSERT INTO `m_management_user` (`management_user_id`, `login_id`, `password`) VALUES
(1, 'admin', 'password');

-- --------------------------------------------------------

--
-- テーブルの構造 `m_pattern`
--

CREATE TABLE IF NOT EXISTS `m_pattern` (
  `pattern_id` int(11) NOT NULL,
  `name` varchar(50) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COMMENT='クイズ問題の問題パターンを管理する';

--
-- テーブルのデータのダンプ `m_pattern`
--

INSERT INTO `m_pattern` (`pattern_id`, `name`) VALUES
(1, 'Aパターン（仮）'),
(2, 'Bパターン（仮）'),
(3, 'Cパターン');

-- --------------------------------------------------------

--
-- テーブルの構造 `m_questions`
--

CREATE TABLE IF NOT EXISTS `m_questions` (
  `question_id` int(11) NOT NULL,
  `pattern_id` int(11) NOT NULL,
  `difficulty_id` int(11) NOT NULL,
  `solution_time_id` int(11) NOT NULL,
  `beast_house_id` int(11) NOT NULL,
  `title` varchar(20) NOT NULL,
  `problem_statement` varchar(100) NOT NULL,
  `problem_image_path` varchar(500) DEFAULT NULL,
  `first_image_path` varchar(500) DEFAULT NULL COMMENT 'Bパターンの問題の場合、１枚目に正解の画像が入る',
  `second_image_path` varchar(500) DEFAULT NULL COMMENT 'Bパターンの問題の場合、２枚目に不正解の画像が入る',
  `correct_answer` varchar(8) NOT NULL,
  `incorrect_answer` varchar(8) NOT NULL,
  `commentary` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='クイズ問題を管理する';

-- --------------------------------------------------------

--
-- テーブルの構造 `m_solution_time`
--

CREATE TABLE IF NOT EXISTS `m_solution_time` (
  `solution_time_id` int(11) NOT NULL,
  `second` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COMMENT='クイズの回答時間を管理する';

--
-- テーブルのデータのダンプ `m_solution_time`
--

INSERT INTO `m_solution_time` (`solution_time_id`, `second`) VALUES
(1, 10),
(2, 15);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `m_beast_house`
--
ALTER TABLE `m_beast_house`
  ADD PRIMARY KEY (`beast_house_id`);

--
-- Indexes for table `m_difficulty`
--
ALTER TABLE `m_difficulty`
  ADD PRIMARY KEY (`difficulty_id`);

--
-- Indexes for table `m_management_user`
--
ALTER TABLE `m_management_user`
  ADD PRIMARY KEY (`management_user_id`);

--
-- Indexes for table `m_pattern`
--
ALTER TABLE `m_pattern`
  ADD PRIMARY KEY (`pattern_id`);

--
-- Indexes for table `m_questions`
--
ALTER TABLE `m_questions`
  ADD PRIMARY KEY (`question_id`),
  ADD KEY `beast_house_id` (`beast_house_id`),
  ADD KEY `difficulty_id` (`difficulty_id`),
  ADD KEY `pattern_id` (`pattern_id`),
  ADD KEY `solution_time_id` (`solution_time_id`);

--
-- Indexes for table `m_solution_time`
--
ALTER TABLE `m_solution_time`
  ADD PRIMARY KEY (`solution_time_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `m_beast_house`
--
ALTER TABLE `m_beast_house`
  MODIFY `beast_house_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT for table `m_difficulty`
--
ALTER TABLE `m_difficulty`
  MODIFY `difficulty_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `m_management_user`
--
ALTER TABLE `m_management_user`
  MODIFY `management_user_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `m_pattern`
--
ALTER TABLE `m_pattern`
  MODIFY `pattern_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `m_questions`
--
ALTER TABLE `m_questions`
  MODIFY `question_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `m_solution_time`
--
ALTER TABLE `m_solution_time`
  MODIFY `solution_time_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- ダンプしたテーブルの制約
--

--
-- テーブルの制約 `m_questions`
--
ALTER TABLE `m_questions`
  ADD CONSTRAINT `m_questions_ibfk_1` FOREIGN KEY (`beast_house_id`) REFERENCES `m_beast_house` (`beast_house_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `m_questions_ibfk_2` FOREIGN KEY (`difficulty_id`) REFERENCES `m_difficulty` (`difficulty_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `m_questions_ibfk_3` FOREIGN KEY (`pattern_id`) REFERENCES `m_pattern` (`pattern_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `m_questions_ibfk_4` FOREIGN KEY (`solution_time_id`) REFERENCES `m_solution_time` (`solution_time_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
