-- Created by HIR0Y0SHI on 2017/06/11
-- VIEWの定義


-- みんなで遊ぶ用のVIEW
CREATE VIEW v_question_multiple_api AS
    SELECT 
        q.question_id, 
        q.title, 
        q.problem_statement, 
        q.problem_image_path, 
        q.first_image_path, 
        q.second_image_path,
        q.correct_answer,
        q.incorrect_answer,
        q.commentary,
        p.name AS pattern_name,
        d.difficulty_id AS difficulty_id,
        d.name AS difficulty_name,
        s.second,
        b.name AS beast_house_name
    FROM m_questions AS q
        INNER JOIN m_pattern AS p ON q.pattern_id = p.pattern_id
        INNER JOIN m_difficulty AS d ON q.difficulty_id = d.difficulty_id
        INNER JOIN m_solution_time AS s ON q.solution_time_id = s.solution_time_id
        INNER JOIN m_beast_house AS b ON q.beast_house_id = b.beast_house_id