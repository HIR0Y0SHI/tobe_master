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

//最初の○○さんですか？の画像と名前の配列を宣言
var animals = [];
animals[0] = "シロクマ";
animals[1] = "トラ";
animals[2] = "キツネ";
animals[3] = "ゾウ";
animals[4] = "ウサギ";
animals[5] = "ペンギン";

var animalsImage = [];
animalsImage[0] = '/tobe_master/public/images/sample.jpg';
animalsImage[1] = '/tobe_master/public/images/sample.jpg';
animalsImage[2] = '/tobe_master/public/images/sample.jpg';
animalsImage[3] = '/tobe_master/public/images/sample.jpg';
animalsImage[4] = '/tobe_master/public/images/sample.jpg';
animalsImage[5] = '/tobe_master/public/images/sample.jpg';

//ajaxでapiから値を受け取り格納する
$(function() {
    $.ajax({
        type: "GET",
        url: "/tobe_master/api/mock/question/multiple/1",
        dataType: "json",
        crossdomain: true
    }).done(function(data) {
        var i = 1;
        var question = data.questions[i].problem_statement;
        var image = data.questions[i].problem_image_path;
        var correct = data.questions[i].correct_answer;
        var incorrect = data.questions[i].incorrect_answer;
        var pattern = data.questions[i].pattern_name;
        var commentary = data.questions[i].commentary;
        var second = data.questions[i].second;
        $.cookie("second", second, { expires: 1 });

        // 問題
        $(".questionText").text(question);
        // 正解
        $(".correct").text(correct);
        $.cookie("correct", correct, { expires: 1 });
        // 解説
        $('.commentaryArea > p').text(commentary);

        // 解答をランダム表示
        // 1か2をランダムで取得
        var r = Math.round(Math.random() + 1);
        (r == 1) ? $(".answer01").text(correct) + $(".answer02").text(incorrect): $(".answer02").text(correct) + $(".answer01").text(incorrect);

        //次の問題数を投げる。

    }).fail(function(XMLHttpRequest, textStatus, errorThrown) {
        alert("chk失敗");
        console.log(XMLHttpRequest);
        console.log('2:' + textStatus);
        console.log('3:' + errorThrown);
    });
});

// プレイヤー数分の繰り返し表示
var playerQuantity = 4;
var repeat = function repeat() {
    var zindex = 998;
    for (var i = 0; i < playerQuantity; i++) {
        (function(n) {
            $('.confPage' + i).css("z-index", zindex - i);
            $('.confPage' + i + ' > .outputQuestion').on('click', function() {
                $('.confPage' + n).css("z-index", "-1");
                $('.secPage' + n).css('z-index', "999");
                timeBlueBar();
            });
        })(i);
    }
}

// 配列を宣言
var answer = "";
var answerPlayerName = "";
var correctGroup = [];
var incorrectGroup = [];
var dropGroup = [];
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
var answerCheck = function answerCheck() {
    // 選択された回答を取得
    answer = $('.selected').text();
    // 解答したプレイヤー名を取得
    answerPlayerName = $('.selected').parent('li').parent('.answerArea').prev('.playerArea').find('.playerName').find('span').text();
    anwswerCheckIF(answer, answerPlayerName);
};
var anwswerCheckIF = function anwswerCheckIF(answer, answerPlayerName) {
    for (key in animals) {
        if (animals[key] == answerPlayerName) {
            answerPlayerName = key;
        }
    }
    (answer == $.cookie('correct')) ? correctGroup.push(answerPlayerName): incorrectGroup.push(answerPlayerName) + dropGroup.push(answerPlayerName);
    dfd.resolve()
    dfd.promise().then(function() {
        if ($('.correctPlayer > ul').empty()) {
            // console.log("qwe");
        }

        // 正解者、不正解者、脱落者の画像を表示する
        var correctCharaImage = "";
        for (i in correctGroup) {
            correctCharaImage += "<li><img src='" + animalsImage[i] + "' alt='asd'></li>";
        }
        $('.correctPlayer > ul').append(correctCharaImage);

        $('.incorrectPlayer > ul').empty();
        var incorrectCharaImage = "";
        for (i in incorrectGroup) {
            incorrectCharaImage += "<li><img src='" + animalsImage[i] + "'></li>";
        }
        $('.incorrectPlayer > ul').append(incorrectCharaImage);

        $('.dropoutPlayer > ul').empty();
        var dropCharaImage = "";
        for (i in $.cookie("dropGroup")) {
            dropCharaImage += "<li><img src='" + animalsImage[i] + "'></li>";
        }
        $('.correctPlayer > ul').append(dropCharaImage);
        // 正解者と不正解者の配列を空にする
        $.cookie("correctGroup", "", { expires: 1 });
        $.cookie("incorrectGroup", "", { expires: 1 });
        // 正解者と不正解者を配列に入れる
        $.cookie("correctGroup", correctGroup, { expires: 1 });
        $.cookie("incorrectGroup", incorrectGroup, { expires: 1 });

        $.cookie("dropGroup", dropGroup, { expires: 1 });

        console.log("正解:" + $.cookie("correctGroup"));
        console.log("不正解:" + $.cookie("incorrectGroup"));
        console.log("脱落:" + $.cookie("dropGroup"));
    });
};

//プレイヤー確認と問題の表示
var asd = 0;
nextQuestion = function nextQuestion() {
    asd++;
    if (asd != playerQuantity) {
        $('.secPage' + asd - 1).css('z-index', "-1");
        $('.confPage' + asd).css("z-index", "999");
    } else {
        $('.secPage' + asd - 1).css('z-index', "-1");
        $('.sec02').css("z-index", "999");
    }

};

//htmlを整形して、表示する
var disp = function disp() {
    $("#quizRepeat").empty();

    //整形
    var a = "";
    for (i = 0; i < playerQuantity; i++) {

        a = '';
        a += '<div class="playerConfirm confPage' + i + '">';
        a += '<h2>プレイヤー確認</h2>';
        a += '<div class="playerArea">';
        a += '<p><img src="../../public/images/web/ico_animal01.png" alt=""></p>';
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
        a += '<li class="swiper-slide">';
        a += '<img src="../../public/images/web/dummy.png" alt="">';
        a += '</li>';
        a += '</ul>';
        a += '<div class="swiper-pagination"></div>';
        a += '<div class="swiper-button-prev"></div>';
        a += '<div class="swiper-button-next"></div>';
        a += '</div>';

        a += '<div class="questionArea">';
        a += '<div class="inner">';
        a += '<p class="tC">第<span class="questionNo">1</span>問</p>';
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

// sec02,03の.nextクリックでsec03,04の読み込み
var nextPage = function nextPage() {
    $('.next02').on('click', function() {
        $('.sec02').css('z-index', '-1');
        $('.sec03').css('z-index', '999');
    });
    $('.next03').on('click', function() {
        $('.sec03').css('z-index', '-1');
        $('.sec04').css('z-index', '999');
    });

    //次の問題へ
    $('.next04').on('click', function() {

    });
};

// デザインとかその他もろもろ最初の方に実行したいやつら
// プレイヤー数が無ければ実行しないようにしないといけない
$(".contentIn > div").css("z-index", "-1");
$("#quizRepeat").css("z-index", "900");
$("#quizRepeat > div").css("z-index", "-1");
disp();
repeat();
nextPage();
answerSelect();