/*
 *
 * 概要：問題表示、人数分のループなどメイン部分
 * 作成者:荒井大輝
 * ディレクトリ：tobe_master\public\js\web
 *
 */

//swiperの実行
$(function() {
    var mySwiper = new Swiper('.swiper-container', {
        loop: true,
        paginationClickable: true,
        pagination: '.swiper-pagination',
        nextButton: '.swiper-button-next',
        prevButton: '.swiper-button-prev',
    })
});


// Deferredの宣言
var dfd = $.Deferred();
// プレイヤー数
var playerQuantity = 1;
playerQuantity = Number($.cookie('playerQuantity'));
$.removeCookie('playerQuantity');

// 現在の問題番号
var questionNumber = 1;
// 現在の問題番号の表示
$('.questionNo').text(questionNumber);
// 問題の秒数用変数
var second = 0;

// 変更していく動物配列の宣言
var animals = [];
//動物の画像と名前の配列を宣言
var fixAnimals = [];
switch (playerQuantity) {
    case 6:
        animals.unshift('ペンギン');
        fixAnimals.unshift('ペンギン');
    case 5:
        animals.unshift('ウサギ');
        fixAnimals.unshift('ウサギ');
    case 4:
        animals.unshift('ゾウ');
        fixAnimals.unshift('ゾウ');
    case 3:
        animals.unshift('キツネ');
        fixAnimals.unshift('キツネ');
    case 2:
        animals.unshift('トラ');
        fixAnimals.unshift('トラ');
    case 1:
        animals.unshift('シロクマ');
        fixAnimals.unshift('シロクマ');
}


var animalImagePath = "/tobe_master/public/images/web/";
var animalsImage = [];
// animalsImage[0] = '/tobe_master/public/images/web/ico_bear01.jpg';
// animalsImage[1] = '/tobe_master/public/images/web/ico_tiger01.jpg';
// animalsImage[2] = '/tobe_master/public/images/web/ico_fox01.jpg';
// animalsImage[3] = '/tobe_master/public/images/web/ico_elephant01.jpg';
// animalsImage[4] = '/tobe_master/public/images/web/ico_rabbit01.jpg';
// animalsImage[5] = '/tobe_master/public/images/web/ico_penguin01.jpg';

animalsImage[0] = '/tobe_master/public/images/web/ico_animal01.png';
animalsImage[1] = '/tobe_master/public/images/web/ico_animal02.png';
animalsImage[2] = '/tobe_master/public/images/web/ico_animal03.png';
animalsImage[3] = '/tobe_master/public/images/web/ico_animal04.png';
animalsImage[4] = '/tobe_master/public/images/web/ico_animal03.png';
animalsImage[5] = '/tobe_master/public/images/web/ico_animal04.png';

// 配列を宣言
var answer = "";
var answerPlayerName = "";
var correctGroup = [];
var incorrectGroup = [];
var dropGroup = [];

// swiperのスライドボタンとかの可視、不可視を変更する関数
var visible = function visible(vis) {
    $('.sec02 .swiper-container .swiper-slide:last-child').css('visibility', vis);
    $('.sec02 .swiper-container .swiper-pagination').css('visibility', vis);
    $('.sec02 .swiper-container .swiper-button-prev').css('visibility', vis);
    $('.sec02 .swiper-container .swiper-button-next').css('visibility', vis);

    $('.sec03 .swiper-container .swiper-slide:last-child').css('visibility', vis);
    $('.sec03 .swiper-container .swiper-pagination').css('visibility', vis);
    $('.sec03 .swiper-container .swiper-button-prev').css('visibility', vis);
    $('.sec03 .swiper-container .swiper-button-next').css('visibility', vis);
}

// ajaxでapiから値を受け取り格納する
var getData = function getData(questionDifficulty) {
    $.ajax({
        type: "GET",
        // url: "/tobe_master/api/question/multiple/" + questionDifficulty,
        url: "/tobe_master/api/question/multiple/3",
        dataType: "json",
        crossdomain: true
    }).done(function(data) {
        output(data);
    }).fail(function(XMLHttpRequest, textStatus, errorThrown) {
        alert("chk失敗");
        console.log(XMLHttpRequest);
        console.log('2:' + textStatus);
        console.log('3:' + errorThrown);
    });
}

// apiからデータもらって問題を出力
var output = function output(data) {
    i = 0;
    if (!data) {
        getData(questionDifficulty);
    } else {
        var question = data.questions[i].problem_statement;
        var image = data.questions[i].problem_image_path;
        var correct = data.questions[i].correct_answer;
        var incorrect = data.questions[i].incorrect_answer;
        var pattern = data.questions[i].pattern_name;
        var commentary = data.questions[i].commentary;
        var firstImage = data.questions[i].first_image_path;
        var secondImage = data.questions[i].second_image_path;
        second = data.questions[i].second;

        var x = "";
        // 表示のために実行しないといけない関数
        var firstExecution = function firstExecution() {
            disp(x);
            repeat();
            nextPage();
            answerSelect();
        };
        // 問題パターンによってそれぞれの処理
        switch (true) {
            case /A/.test(pattern):
                x = "A";
                firstExecution();
                // 解答をランダム表示
                // 1か2をランダムで取得
                var r = Math.round(Math.random() + 1);
                (r == 1) ? $(".answer01").text(correct) + $(".answer02").text(incorrect): $(".answer02").text(correct) + $(".answer01").text(incorrect);
                $(".correct").text(correct);
                $.cookie("correct", correct, { expires: 1 });
                visible('hidden');
                break;
            case /B/.test(pattern):
                x = "B";
                firstExecution();
                visible('visible');
                break;
            case /C/.test(pattern):
                x = "C";
                firstExecution();
                // 解答をランダム表示
                // 1か2をランダムで取得
                var r = Math.round(Math.random() + 1);
                (r == 1) ? $(".answer01").text(correct) + $(".answer02").text(incorrect): $(".answer02").text(correct) + $(".answer01").text(incorrect);
                visible('visible');
                break;
        }

        // 問題
        $(".questionText").text(question);
        // 解説
        $('.commentaryArea > p').text(commentary);


        // パターンＢの時の画像表示
        $('.swiper-slide').empty();
        if (!image) {
            var firstCorrect = correct;
            var secondCorrect = correct;
            if (pattern.match(/B/)) {
                firstCorrect = "A";
                secondCorrect = "B";
            }
            var qweqwe = data.questions[i].title;

            console.log(qweqwe);
            console.log(question);
            console.log(firstImage);
            console.log(secondImage);

            var ssFirst = '<img src="/tobe_master/public/images/questions/' + firstImage + '">';
            var ssLast = '<img src="/tobe_master/public/images/questions/' + secondImage + '">';

            var r = Math.round(Math.random() + 1);
            (r == 1) ? $('.swiper-slide:first-child').append(ssFirst) + $('.swiper-slide:last-child').append(ssLast) + $(".correct").text(firstCorrect) +
                $.cookie("correct", firstCorrect, { expires: 1 }):
                $('.swiper-slide:last-child').append(ssFirst) + $('.swiper-slide:first-child').append(ssLast) + $(".correct").text(secondCorrect) +
                $.cookie("correct", secondCorrect, { expires: 1 });
        } else {
            // 画像を表示
            $('.swiper-slide').append('<img src="/tobe_master/public/images/questions/' + image + '">');
        }
        i++;
    }
};

// プレイヤー数分の繰り返し表示
var repeat = function repeat() {
    var zindex = 998;
    for (var i = 0; i < playerQuantity; i++) {
        (function(n) {
            $('.confPage' + i).css("z-index", zindex - i);
            $('.confPage' + i + ' > .outputQuestion').on('click', function() {
                $('.confPage' + n).css("z-index", "-1");
                $('.secPage' + n).css('z-index', "999");
                timeBlueBar(Number(second) / 3);
                console.log(second);
            });
        })(i);
    }
}

// 選択された回答に .selected を付与
var answerSelect = function answerSelect() {
    // .answer01,02につけた .selectedを消す
    var answerReset = function() {
        $('.answer01').removeClass('selected');
        $('.answer02').removeClass('selected');
    };

    $('.answer01').on('click', function() {
        answerReset();
        $(this).addClass('selected');
    });

    $('.answer02').on('click', function() {
        answerReset();
        $(this).addClass('selected');
    });
}




// 選択された回答を取得
var answerCheck = function answerCheck() {
    // 選択された回答を取得
    answer = $('.selected').text();
    // 解答したプレイヤー名を取得
    answerPlayerName = $('.selected').parent('li').parent('.answerArea').prev('.playerArea').find('.playerName').find('span').text();
    anwswerCheckIF(answer, answerPlayerName);
};

var anwswerCheckIF = function anwswerCheckIF(answer, answerPlayerName) {
    // animalsの要素分ループする。keyは添え字
    for (key in animals) {
        // 配列の値と回答者が同じ場合の添え字を取得
        if (animals[key] == answerPlayerName) {
            answerPlayerName = key;
        }
    }
    // 選択された解答と正解が同じとき
    (answer == $.cookie('correct')) ? correctGroup.push(answerPlayerName): incorrectGroup.push(answerPlayerName);
    dfd.resolve();
    // resolveが実行されたら実行。    正解者等の画像を表示する。
    dfd.promise().then(function() {
        // 正解者の画像を表示する
        $('.correctPlayer > ul').empty();
        var correctCharaImage = "";
        for (var i in correctGroup) {
            correctCharaImage += "<li><img src='" + animalsImage[i] + "'></li>";
        }
        $('.correctPlayer > ul').append(correctCharaImage);

        // 不正解者の画像を表示
        $('.incorrectPlayer > ul').empty();
        var incorrectCharaImage = "";
        for (var i in incorrectGroup) {
            incorrectCharaImage += "<li><img src='" + animalsImage[i] + "'></li>";
        }
        console.log(incorrectGroup);
        $('.incorrectPlayer > ul').append(incorrectCharaImage);

        // 脱落者の画像を表示する
        $('.dropoutPlayer > ul').empty();
        var dropCharaImage = "";
        for (var i in dropGroup) {
            dropCharaImage += "<li><img src='" + animalsImage[i] + "'></li>";
        }
        $('.dropoutPlayer > ul').append(dropCharaImage);

        // 正解者と不正解者の配列を空にする
        $.removeCookie("correctGroup");
        $.removeCookie("incorrectGroup");
        // 正解者と不正解者を配列に入れる
        $.cookie("correctGroup", correctGroup, { expires: 1 });
        $.cookie("incorrectGroup", incorrectGroup, { expires: 1 });

        $.cookie("dropGroup", dropGroup, { expires: 1 });

        console.log("正解:" + correctGroup);
        console.log("不正解:" + incorrectGroup);
        console.log("脱落:" + dropGroup);
    });
};

//htmlを整形して、表示する
var disp = function disp(x) {
    $("#quizRepeat").empty();

    // 整形
    // 写真１枚と解答２個
    var patternA = function patternA() {
        var a = "";
        for (i = 0; i < animals.length; i++) {

            a = '';
            a += '<div class="playerConfirm confPage' + i + '">';
            a += '<h2>プレイヤー確認</h2>';
            a += '<div class="playerArea">';
            a += '<p><img src="../../public/images/web/ico_animal02.png" alt=""></p>';
            a += '<p class="playerName">あなたは<span class="animal' + i + ' animalNumber">シロクマ</span>さんですか？</p>';
            a += '</div>';
            a += '<div class="outputQuestion">';
            a += '<button type="button" class="btnStyle03" value="">はい</button>';
            a += '</div>';
            a += '</div>';

            a += '<div class="sec01 secPage' + i + '">';

            a += '<div class="swiper-container">';
            a += '<ul class="swiper-wrapper slider questionImg">';
            a += '<li class="swiper-slide">';
            a += '<img src="../../public/images/web/dummy.png" alt="">';
            a += '</li>';
            a += '</ul>';
            a += '</div>';

            a += '<div class="questionArea">';
            a += '<div class="inner">';
            a += '<p class="tC">第<span class="questionNo">' + questionNumber + '</span>問</p>';
            a += '<p class="questionText">この動物はカピバラ？それともヌートリア？</p>';
            a += '</div>';
            a += '</div>';
            a += '<div class="time"><div class="timebar"></div></div>';

            a += '<div class="playerArea">';
            a += '<p><img src="../../public/images/web/ico_animal01.png" alt="" class="icon"></p>';
            a += '<p class="playerName"><span class="animal' + i + '">シロクマ</span>さんのターン</p>';
            a += '</div>';

            a += '<ul class="answerArea">';
            a += '<li><button type="button" class="answer01 answerBtn btnStyle01" value=""></button></li>';
            a += '<li><button type="button" class="answer02 answerBtn btnStyle02" value=""></button></li>';
            a += '</ul>';
            a += '</div>';

            // 出力
            $("#quizRepeat").append(a);

            // 繰り返しの部分の動物名をセット
            $('.animal' + i).text(animals[i]);
        }
    };

    // 写真２枚と解答２個
    var patternB = function patternB() {
        var b = "";
        for (i = 0; i < animals.length; i++) {

            b = '';
            b += '<div class="playerConfirm confPage' + i + '">';
            b += '<h2>プレイヤー確認</h2>';
            b += '<div class="playerArea">';
            b += '<p><img src="../../public/images/web/ico_animal01.png" alt=""></p>';
            b += '<p class="playerName">あなたは<span class="animal' + i + ' animalNumber">シロクマ</span>さんですか？</p>';
            b += '</div>';
            b += '<div class="outputQuestion">';
            b += '<button type="button" class="btnStyle03" value="">はい</button>';
            b += '</div>';
            b += '</div>';

            b += '<div class="sec01 secPage' + i + '">';

            b += '<div class="swiper-container">';
            b += '<ul class="swiper-wrapper slider questionImg">';
            b += '<li class="swiper-slide">';
            b += '<img src="../../public/images/web/dummy.png" alt="">';
            b += '</li>';
            b += '<li class="swiper-slide">';
            b += '<img src="../../public/images/web/dummy.png" alt="">';
            b += '</li>';
            b += '</ul>';
            b += '<div class="swiper-pagination"></div>';
            b += '<div class="swiper-button-prev"></div>';
            b += '<div class="swiper-button-next"></div>';
            b += '</div>';

            b += '<div class="questionArea">';
            b += '<div class="inner">';
            b += '<p class="tC">第<span class="questionNo">' + questionNumber + '</span>問</p>';
            b += '<p class="questionText">この動物はカピバラ？それともヌートリア？</p>';
            b += '</div>';
            b += '</div>';
            b += '<div class="time"><div class="timebar"></div></div>';

            b += '<div class="playerArea">';
            b += '<p><img src="../../public/images/web/ico_animal01.png" alt="" class="icon"></p>';
            b += '<p class="playerName"><span class="animal' + i + '">シロクマ</span>さんのターン</p>';
            b += '</div>';

            b += '<ul class="answerArea">';
            b += '<li><button type="button" class="answer01 answerBtn btnStyle01" value="">A</button></li>';
            b += '<li><button type="button" class="answer02 answerBtn btnStyle02" value="">B</button></li>';
            b += '</ul>';
            b += '</div>';

            // 出力
            $("#quizRepeat").append(b);

            // 繰り返しの部分の動物名をセット
            $('.animal' + i).text(animals[i]);
        }
    };

    // 写真で解答２枚
    var patternC = function patternC() {
        var c = "";
        for (i = 0; i < animals.length; i++) {

            c = '';
            c += '<div class="playerConfirm confPage' + i + '">';
            c += '<h2>プレイヤー確認</h2>';
            c += '<div class="playerArea">';
            c += '<p><img src="../../public/images/web/ico_animal01.png" alt=""></p>';
            c += '<p class="playerName">あなたは<span class="animal' + i + ' animalNumber">シロクマ</span>さんですか？</p>';
            c += '</div>';
            c += '<div class="outputQuestion">';
            c += '<button type="button" class="btnStyle03" value="">はい</button>';
            c += '</div>';
            c += '</div>';

            c += '<div class="sec01 secPage' + i + '">';

            c += '<div class="swiper-container">';
            c += '<ul class="swiper-wrapper slider questionImg">';
            c += '<li class="swiper-slide">';
            c += '<img src="../../public/images/web/dummy.png" alt="">';
            c += '</li>';
            c += '<li class="swiper-slide">';
            c += '<img src="../../public/images/web/dummy.png" alt="">';
            c += '</li>';
            c += '</ul>';
            c += '<div class="swiper-pagination"></div>';
            c += '<div class="swiper-button-prev"></div>';
            c += '<div class="swiper-button-next"></div>';
            c += '</div>';

            c += '<div class="questionArea">';
            c += '<div class="inner">';
            c += '<p class="tC">第<span class="questionNo">' + questionNumber + '</span>問</p>';
            c += '<p class="questionText">この動物はカピバラ？それともヌートリア？</p>';
            c += '</div>';
            c += '</div>';
            c += '<div class="time"><div class="timebar"></div></div>';

            c += '<div class="playerArea">';
            c += '<p><img src="../../public/images/web/ico_animal01.png" alt="" class="icon"></p>';
            c += '<p class="playerName"><span class="animal' + i + '">シロクマ</span>さんのターン</p>';
            c += '</div>';

            c += '<ul class="answerArea">';
            c += '<li><button type="button" class="answer01 answerBtn btnStyle01" value="">A</button></li>';
            c += '<li><button type="button" class="answer02 answerBtn btnStyle02" value="">B</button></li>';
            c += '</ul>';
            c += '</div>';

            // 出力
            $("#quizRepeat").append(c);

            // 繰り返しの部分の動物名をセット
            $('.animal' + i).text(animals[i]);
        }
    };

    switch (x) {
        case "A":
            console.log("A");
            patternA();
            break;
        case "B":
            console.log("B");
            patternB();
            break;
        case "C":
            console.log("C");
            patternC();
            break;
    }
};

// sec02,03の.nextクリックでsec03,04の読み込み
// ゲームオーバー時の設定
var nextPage = function nextPage() {
    $('.next02').on('click', function() {
        $('.sec02').css('z-index', '-1');
        $('.sec03').css('z-index', '999');
    });
    $('.next03').on('click', function() {
        $('.sec03').css('z-index', '-1');
        $('.sec04').css('z-index', '999');
    });
};

// 次の問題へ
// まだ正解者がいるとき
var nextQuestion = function nextQuestion() {
    $('.nextQuestion').on('click', function() {
        // ３問ごとに難易度アップ
        if (isInteger(questionNumber / 3)) {
            questionDifficulty++;
            console.log('難易度アップ');
        }
        // クリアに飛ぶ
        if (questionNumber == 10) {
            $('.gameclear').css('z-index', '999');
            $('.playerList03').empty();
            var gameclearPlayer = "";
            for (var k = 0; k < fixAnimals.length; k++) {
                gameclearPlayer += '<li>';
                gameclearPlayer += '<p class="image"><img src="' + animalsImage[k] + '"></p>';
                gameclearPlayer += '<div class="text">';
                gameclearPlayer += '<p class="playerName">' + fixAnimals[k] + '</p>';
                gameclearPlayer += '</div>';
                gameclearPlayer += '</li>';
            }
            $('.playerList03').append(gameclearPlayer);
        } else {
            questionNumber++;
            console.log("次は問" + questionNumber);
            // 色々初期設定に戻す
            $('.sec04').css('z-index', '-1');
            $('.confPage0').css('z-index', '999');
            // nextPlayerのページ捲る用変数の初期化
            asd = 0;
            // 現在の総人数 = 総人数 - 間違えた人
            playerQuantity = playerQuantity - incorrectGroup.length;
            if (playerQuantity == 0) {
                // ゲームオーバーの時の表示と整形
                $('.gameover').css('z-index', '999');
                $('.playerList03').empty();
                var gameoverPlayer = "";
                for (var k = 0; k < fixAnimals.length; k++) {
                    gameoverPlayer += '<li>';
                    gameoverPlayer += '<p class="image"><img src="' + animalsImage[k] + '"></p>';
                    gameoverPlayer += '<div class="text">';
                    gameoverPlayer += '<p class="playerName">' + fixAnimals[k] + '</p>';
                    gameoverPlayer += '</div>';
                    gameoverPlayer += '</li>';
                }
                $('.playerList03').append(gameoverPlayer);
            } else {
                var delAnimals = function delAnimals() {
                    var f;
                    var key;
                    var i = 0;
                    for (f in incorrectGroup) {
                        for (key in animals) {
                            if (key - i == incorrectGroup[f]) {
                                animals.splice(key, 1);
                                if (incorrectGroup.length != 1) {
                                    i++;
                                }
                            }
                        }
                    }
                }

                // 間違えた人を脱落者配列に追加
                for (var k = 0; k < incorrectGroup.length; k++) {
                    dropGroup.push(incorrectGroup[k]);
                }
                delAnimals();

                // 正解者と不正解者配列を初期化$('.gameover').css('z-index', '999');
                correctGroup = [];
                incorrectGroup = [];
                output();
                $('.questionNo').text(questionNumber);
            }
        }
    });
};

// 整数チェック
var isInteger = function isInteger(x) {
    return Math.round(x) === x;
}

//プレイヤー確認と問題の表示
var asd = 0;
nextPlayer = function nextPlayer() {
    asd++;
    if (asd != playerQuantity) {
        $('.secPage' + asd - 1).css('z-index', "-1");
        $('.confPage' + asd).css("z-index", "999");
    } else {
        $('.secPage' + asd - 1).css('z-index', "-1");
        $('.sec02').css("z-index", "999");
    }
};

// クッキーの初期化
$.removeCookie("data");
$.removeCookie("correct");
$.removeCookie("second");

// デザインとかその他もろもろ最初の方に実行したいやつら
$(".contentIn > div").css("z-index", "-1");
$("#quizRepeat").css("z-index", "900");
$("#quizRepeat > div").css("z-index", "-1");
// 関数の実行
var questionDifficulty = 1;
getData(questionDifficulty);
nextQuestion();