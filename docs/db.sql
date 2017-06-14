-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: 2017 年 6 月 12 日 14:01
-- サーバのバージョン： 10.1.19-MariaDB
-- PHP Version: 5.6.28

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

CREATE TABLE `m_beast_house` (
  `beast_house_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='クイズに紐付ける獣舎を管理する';

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
(12, 'モンキータウン'),
(13, '類人猿舎'),
(14, 'カンガルー舎'),
(15, 'サル山'),
(16, 'ラクダ舎'),
(17, 'リトルワールド'),
(18, 'クマ舎');

-- --------------------------------------------------------

--
-- テーブルの構造 `m_difficulty`
--

CREATE TABLE `m_difficulty` (
  `difficulty_id` int(11) NOT NULL,
  `name` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='クイズ問題の難易度を管理する';

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

CREATE TABLE `m_management_user` (
  `management_user_id` int(11) NOT NULL,
  `login_id` varchar(20) NOT NULL,
  `password` varchar(300) NOT NULL COMMENT 'base64で暗号化した値が入る\n'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- テーブルのデータのダンプ `m_management_user`
--

INSERT INTO `m_management_user` (`management_user_id`, `login_id`, `password`) VALUES
(1, 'admin', 'password');

-- --------------------------------------------------------

--
-- テーブルの構造 `m_pattern`
--

CREATE TABLE `m_pattern` (
  `pattern_id` int(11) NOT NULL,
  `name` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='クイズ問題の問題パターンを管理する';

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

CREATE TABLE `m_questions` (
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

--
-- テーブルのデータのダンプ `m_questions`
--

INSERT INTO `m_questions` (`question_id`, `pattern_id`, `difficulty_id`, `solution_time_id`, `beast_house_id`, `title`, `problem_statement`, `problem_image_path`, `first_image_path`, `second_image_path`, `correct_answer`, `incorrect_answer`, `commentary`) VALUES
(1, 1, 2, 1, 1, 'フクロウ', 'この動物は園内のどこで過ごしているでしょうか？', '20170601101000_1_1.jpg', NULL, NULL, 'スネークハウス', 'バードパーク', 'フクロウはスネークハウスで暮らしているよ。会いに行ってみてね！'),
(2, 1, 2, 1, 2, 'ペンギン', 'ペンギンお食事タイムは１０時３０分と何時に行われているでしょうか？', '20170602101000_1_1.jpg', '', NULL, '１５時', '１５時３０分', 'ペンギンお食事タイムは毎日１０時３０分と１５時に行われています。ペンギン広場に遊びに来てくださいね！'),
(3, 1, 1, 1, 3, 'ピューマ', 'この動物は？※どちらもメス', '20170603101000_1_1.jpg', NULL, NULL, 'ピューマ', 'ライオン', 'ピューマのマリーです。ピューマ界きっての美女は南米獣舎にいるので是非会いに来て下さい！'),
(4, 1, 1, 1, 4, 'ジャガー', 'この動物は？', '20170604101000_1_1.jpg', '', '', 'ジャガー', 'ヒョウ', 'ジャガーは梅花紋の中に黒い斑点があるかないかで見分けることができます。'),
(5, 1, 1, 1, 5, 'ライオン', 'この動物は？', '20170605101000_1_1.jpg', NULL, NULL, 'ライオン', 'ピューマ', 'ライオンの親子です。メスだけでなくこどものライオンもふさふさの毛が生えていません。'),
(6, 1, 2, 2, 6, 'キリン', 'とべ動物園のキリン、リュウキ。好きな食べ物は何でしょう？', '20170606101000_1_1.jpg', NULL, NULL, 'カシの枝葉', 'サボテン', 'カシの枝葉が好きなようです。キリンは木の葉を好んで食べます。サボテンが好きなキリンもいるそうですよ。'),
(7, 1, 1, 1, 7, 'カバ', 'カバにエサやり体験ができるイベント。何という名前？', '20170607101000_1_1.jpg', NULL, NULL, 'ヒポヒポランチ', 'ヒポポランチ', 'ヒポヒポランチは毎週 土曜・日曜・祝日の13時15分から行っているよ。是非エサやり体験に来てね！'),
(8, 1, 1, 1, 8, 'エランド', 'この動物は？', '20170608101000_1_1.jpg', NULL, NULL, 'エランド', 'オリックス', 'エランドはウシの仲間で胸に胸垂というものがあるのが特徴です。'),
(9, 1, 1, 2, 9, 'ヒョウ', 'この動物はヒョウである。', '20170609101000_1_1.jpg', NULL, NULL, 'はい', 'いいえ', 'ヒョウです。チーターやジャガーと間違えやすいですが、ヒョウは花の模様のような斑点があるのが特徴です。'),
(10, 1, 1, 1, 10, 'ゾウ', 'とべ動物園以外でアフリカゾウの親子が見られる動物園はあるでしょうか？', '20170610101000_1_1.jpg', NULL, NULL, 'いいえ', 'はい', 'アフリカゾウの親子が見られるのは現在とべ動物園だけです。是非見に来てくださいね。'),
(11, 1, 1, 1, 11, 'トラ', 'とべ動物園にてトラが暮らしている場所を何というでしょうか？', '20170611101000_1_1.jpg', NULL, NULL, 'タイガーヒル', 'トラ山', 'タイガーヒルといいます。トラを近くで見られる迫力満点のエリアなので是非見に来て下さい！'),
(12, 1, 1, 1, 12, 'マンドリル', 'この動物はマントヒヒ？', '20170612101000_1_1.jpg', '', NULL, 'いいえ', 'はい', 'マンドリルは顔は赤と青色、お尻は虹色というとてもカラフルな動物なんですよ。是非確かめに来てくださいね。'),
(13, 1, 2, 2, 13, 'オランウータン', 'オランウータンと同じ『類人猿』なのは？', '20170613101000_1_1.jpg', NULL, NULL, 'チンパンジー', 'ニホンザル', '類人猿はしっぽがあるかないかで判断できます。類人猿舎に行くと自分に似たおさるさんに出会えるかも…？'),
(14, 1, 1, 1, 14, 'カンガルー', 'とべ動物園にてカンガルーが暮らしているストリートを何ストリートというでしょうか？', '20170614101000_1_1.jpg', NULL, NULL, 'オーストラリア', 'アフリカ', 'オーストラリアストリートではオーストラリアやニュージーランドに生息する動物たちに出会えます。'),
(15, 1, 1, 1, 15, 'サル', 'サル山にある鐘の名前は？', '20170615101000_1_1.jpg', NULL, NULL, 'しあわせの鐘', 'へいわの鐘', 'しあわせの鐘はサル山にいるサルがごくまれに鳴らしてくれます。好きな人と聞くと恋が成就するとかしないとか…'),
(16, 1, 1, 1, 16, 'ラクダ', 'この動物は？', '20170616101000_1_1.jpg', NULL, NULL, 'ヒトコブラクダ', 'フタコブラクダ', 'ヒトコブです。コブの中には水ではなく脂肪が貯められており、過酷な環境でのエネルギー源となります。'),
(17, 1, 1, 1, 17, 'カピバラ', 'この動物は？', '20170617101000_1_1.jpg', NULL, NULL, 'カピバラ', 'ヌートリア', 'カピバラです。冬には打たせ湯を行っておりますのでカピバラの温まる様子を是非見に来てくださいね！'),
(18, 1, 1, 1, 18, 'シロクマ', 'このシロクマの名前は？', '20170618101000_1_1.jpg', NULL, NULL, 'ピース', 'バリーバ', 'ピースはメスのホッキョクグマです。バリーバはピースのお母さん。是非会いに来てください！'),
(19, 2, 1, 2, 1, 'ケヅメリクガメ', 'ケヅメリクガメはどっち？', NULL, '20170619101000_2_1.jpg', '20170619101000_2_2.jpg', '', '', 'ケヅメリクガメとアルダブラゾウガメでした。のんびり生きている姿を是非見て下さい。'),
(20, 2, 1, 1, 2, 'ウォーターストリート', 'ウォーターストリートはどっち？', NULL, '20170620101000_2_1.jpg', '20170620101000_2_2.jpg', '', '', 'ウォーターストリートはペンギンたちがいるストリートです。アシカたちがいるストリートはベアストリートなんですよ。'),
(21, 2, 1, 1, 17, 'ウサギ', '毎日行われているイベントはどっち？', NULL, '20170621101000_2_1.jpg', '20170621101000_2_2.jpg', '', '', 'ウサギ・モルモットのスキンシップはふれあい広場にて毎日開催しているよ。'),
(22, 2, 3, 2, 18, 'シロクマ', '若いのはどっちのピース？', NULL, '20170622101000_2_1.jpg', '20170622101000_2_2.jpg', '', '', '16歳のピースと15歳のピースの写真でした。どちらもお誕生日会のピースの様子。まだまだ元気に頑張っています。'),
(23, 3, 3, 1, 17, 'オシドリ', 'どちらもオシドリである！', NULL, '20170623101000_3_1.jpg', '20170623101000_3_2.jpg', 'はい', 'いいえ', 'どちらもオシドリ。春に繁殖期を迎えますが、その準備として前年の秋にはとても鮮やかな羽に換羽するんですよ。'),
(24, 3, 3, 2, 9, 'サーバルキャット', 'どちらもサーバルキャットの『ユカ』である！', NULL, '20170624101000_3_1.jpg', '20170624101000_3_2.jpg', 'はい', 'いいえ', 'どちらもユカです。アニメの影響で人気急上昇中！とても可愛い美猫なので是非会いに来てください。'),
(25, 3, 2, 1, 17, 'オシドリ', '間違いはいくつ？', NULL, '20170625101000_3_1.jpg', '20170625101000_3_2.jpg', '1', '2', '親オシドリの後ろにいるオシドリがいなくなっています。'),
(26, 3, 2, 1, 13, 'チンパンジー', '間違いはいくつ？', NULL, '20170626101000_3_1.jpg', '20170626101000_3_2.jpg', '1', '0', '写真下部の飼育員さんが半分隠れています。');

-- --------------------------------------------------------

--
-- テーブルの構造 `m_solution_time`
--

CREATE TABLE `m_solution_time` (
  `solution_time_id` int(11) NOT NULL,
  `second` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='クイズの回答時間を管理する';

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
  MODIFY `beast_house_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT for table `m_difficulty`
--
ALTER TABLE `m_difficulty`
  MODIFY `difficulty_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `m_management_user`
--
ALTER TABLE `m_management_user`
  MODIFY `management_user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `m_pattern`
--
ALTER TABLE `m_pattern`
  MODIFY `pattern_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `m_questions`
--
ALTER TABLE `m_questions`
  MODIFY `question_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
--
-- AUTO_INCREMENT for table `m_solution_time`
--
ALTER TABLE `m_solution_time`
  MODIFY `solution_time_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
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
