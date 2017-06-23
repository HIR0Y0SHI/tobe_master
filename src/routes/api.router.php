<?php
/**
* Created by HIR0Y0SHI on 2017/06/10
*
* APIのルーティングを行う
*/

/* ==================================================================================================== */
// クイズ API
/* ==================================================================================================== */

$app->get('/api/question/one/{number}', function($request, $response, $args) {
    $response->getBody()->write("Question! " . $args['number']);
    return $response;
});


$app->get('/api/question/multiple/{number}', function($request, $response, $args) {
    $qc = new App\Controllers\QuestionAPIController($this, $response);
    $qc->multipleQuestionAPI($args['number']);
});







/* ==================================================================================================== */
// APIのモック
// テスト用なので、最終的には削除する
/* ==================================================================================================== */

//Mock


// 複数で遊ぶ（画像２枚の解答）
$app->get('/api/mock/question/multiple/1', function($request, $response, $args) {
    $json = '{"status":"Successful","questions":[{"question_id":"5","title":"ライオン","problem_statement":"この動物は？","problem_image_path":"20170605101000_1_1.jpg","first_image_path":null,"second_image_path":null,"correct_answer":"ライオン","incorrect_answer":"ピューマ","commentary":"ライオンの親子です。メスだけでなくこどものライオンもふさふさの毛が生えていません。","pattern_name":"Aパターン","difficulty_id":"1","difficulty_name":"簡単","second":"10","beast_house_name":"ライオン舎"},{"question_id":"11","title":"トラ","problem_statement":"とべ動物園にてトラが暮らしている場所を何というでしょうか？","problem_image_path":"20170611101000_1_1.jpg","first_image_path":null,"second_image_path":null,"correct_answer":"タイガーヒル","incorrect_answer":"トラ山","commentary":"タイガーヒルといいます。トラを近くで見られる迫力満点のエリアなので是非見に来て下さい！","pattern_name":"Aパターン","difficulty_id":"1","difficulty_name":"簡単","second":"10","beast_house_name":"タイガーヒル"},{"question_id":"16","title":"ラクダ","problem_statement":"この動物は？","problem_image_path":"20170616101000_1_1.jpg","first_image_path":null,"second_image_path":null,"correct_answer":"ヒトコブラクダ","incorrect_answer":"フタコブラクダ","commentary":"ヒトコブです。コブの中には水ではなく脂肪が貯められており、過酷な環境でのエネルギー源となります。","pattern_name":"Aパターン","difficulty_id":"1","difficulty_name":"簡単","second":"10","beast_house_name":"ラクダ舎"}]}';
    echo $json;
});

$app->get('/api/mock/question/multiple/2', function($request, $response, $args) {
    $json = '{"status":"Successful","questions":[{"question_id":"1","title":"フクロウ","problem_statement":"この動物は園内のどこで過ごしているでしょうか？","problem_image_path":"20170601101000_1_1.jpg","first_image_path":null,"second_image_path":null,"correct_answer":"スネークハウス","incorrect_answer":"バードパーク","commentary":"フクロウはスネークハウスで暮らしているよ。会いに行ってみてね！","pattern_name":"Aパターン","difficulty_id":"2","difficulty_name":"普通","second":"10","beast_house_name":"スネークハウス"},{"question_id":"2","title":"ペンギン","problem_statement":"ペンギンお食事タイムは１０時３０分と何時に行われているでしょうか？","problem_image_path":"20170602101000_1_1.jpg","first_image_path":"","second_image_path":null,"correct_answer":"１５時","incorrect_answer":"１５時３０分","commentary":"ペンギンお食事タイムは毎日１０時３０分と１５時に行われています。ペンギン広場に遊びに来てくださいね！","pattern_name":"Aパターン","difficulty_id":"2","difficulty_name":"普通","second":"10","beast_house_name":"ペンギン広場"},{"question_id":"25","title":"オシドリ","problem_statement":"間違いはいくつ？","problem_image_path":null,"first_image_path":"20170625101000_3_1.jpg","second_image_path":"20170625101000_3_2.jpg","correct_answer":"1","incorrect_answer":"2","commentary":"親オシドリの後ろにいるオシドリがいなくなっています。","pattern_name":"Cパターン","difficulty_id":"2","difficulty_name":"普通","second":"10","beast_house_name":"リトルワールド"}]}';
    echo $json;
});

$app->get('/api/mock/question/multiple/3', function($request, $response, $args) {
    $json = '{"status":"Successful","questions":[{"question_id":"22","title":"シロクマ","problem_statement":"若いのはどっちのピース？","problem_image_path":null,"first_image_path":"20170622101000_2_1.jpg","second_image_path":"20170622101000_2_2.jpg","correct_answer":"","incorrect_answer":"","commentary":"16歳のピースと15歳のピースの写真でした。どちらもお誕生日会のピースの様子。まだまだ元気に頑張っています。","pattern_name":"Bパターン","difficulty_id":"3","difficulty_name":"難しい","second":"15","beast_house_name":"クマ舎"},{"question_id":"23","title":"オシドリ","problem_statement":"どちらもオシドリである！","problem_image_path":null,"first_image_path":"20170623101000_3_1.jpg","second_image_path":"20170623101000_3_2.jpg","correct_answer":"はい","incorrect_answer":"いいえ","commentary":"どちらもオシドリ。春に繁殖期を迎えますが、その準備として前年の秋にはとても鮮やかな羽に換羽するんですよ。","pattern_name":"Cパターン","difficulty_id":"3","difficulty_name":"難しい","second":"10","beast_house_name":"リトルワールド"},{"question_id":"24","title":"サーバルキャット","problem_statement":"どちらもサーバルキャットの『ユカ』である！","problem_image_path":null,"first_image_path":"20170624101000_3_1.jpg","second_image_path":"20170624101000_3_2.jpg","correct_answer":"はい","incorrect_answer":"いいえ","commentary":"どちらもユカです。アニメの影響で人気急上昇中！とても可愛い美猫なので是非会いに来てください。","pattern_name":"Cパターン","difficulty_id":"3","difficulty_name":"難しい","second":"15","beast_house_name":"ヒョウ舎"}]}';
    echo $json;
});

$app->get('/api/mock/question/multiple/4', function($request, $response, $args) {
    $json = '{"status":"Successful","questions":[{"question_id":"27","title":"前身は？","problem_statement":"とべ動物園の前身となった動物園は、「道後動物園」である。","problem_image_path":"20170622154100_1_1.png","first_image_path":null,"second_image_path":null,"correct_answer":"はい","incorrect_answer":"いいえ","commentary":"より多くの動物がより自然生態に適した環境の中で生活できるようにと、昭和63年4月、静かな丘陵地の県総合運動公園内に移転し、とべ動物園が誕生しました。","pattern_name":"Aパターン","difficulty_id":"4","difficulty_name":"最終問題","second":"15","beast_house_name":"その他"}]}';
    echo $json;
});



// エラーの場合
$app->get('/api/mock/question/error', function($request, $response, $args) {
    $json = [
        'status' => 'Failed',
        'message' => 'データベースが起動していません。'
    ];

    echo json_encode($json, JSON_UNESCAPED_UNICODE);
});