# 獣舎にその他を追加
# 個々で何も追加してなければ、idは19になる
INSERT INTO `tobe_master`.`m_beast_house` (`beast_house_id`, `name`) VALUES (NULL, 'その他');


# 問題の追加
INSERT INTO `tobe_master`.`m_questions` (`question_id`, `pattern_id`, `difficulty_id`, `solution_time_id`, `beast_house_id`, `title`, `problem_statement`, `problem_image_path`, `first_image_path`, `second_image_path`, `correct_answer`, `incorrect_answer`, `commentary`) VALUES (NULL, '1', '4', '2', '19', '前身は？', 'とべ動物園の前身となった動物園は、「道後動物園」である。', '20170622154100_1_1.png', NULL, NULL, 'はい', 'いいえ', 'より多くの動物がより自然生態に適した環境の中で生活できるようにと、昭和63年4月、静かな丘陵地の県総合運動公園内に移転し、とべ動物園が誕生しました。');
