/*
 *
 * 概要：問題表示、人数分のループなどメイン部分
 * 作成者:荒井大輝
 * ディレクトリ：tobe_master\public\js\web
 *
 */

$(function() {
    var mySwiper = new Swiper('.swiper-container', {
        effect: "flip",
        loop: true,
        pagination: '.swiper-pagination',
        nextButton: '.swiper-button-next',
        prevButton: '.swiper-button-prev',
    })
});

$(function() {
    $.ajax({
        type: "GET",
        url: "/tobe_master/api/mock/question/multiple/1",
        dataType: "json",
        crossdomain: true
    }).done(function(data) {
        var i = 0;
        var question = data.questions[i].problem_statement;
        var image = data.questions[i].problem_image_path;
        var correct = data.questions[i].correct_answer;
        var incorrect = data.questions[i].incorrect_answer;
        var pattern = data.questions[i].pattern_name;
        var second = data.questions[i].second;
        $.cookie("second", second, { expires: 1 });

        $(".questionText").text(question);
        $(".correct").text(correct);
        $(".incorrect").text(incorrect);

        //次の問題数を投げる。

    }).fail(function(XMLHttpRequest, textStatus, errorThrown) {
        alert("chk失敗");
        console.log(XMLHttpRequest);
        console.log('2:' + textStatus);
        console.log('3:' + errorThrown);
    });
});
var playerQuantity = 1;
// プレイヤー数分の繰り返し表示
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

var disp = function disp() {
    $("#quizRepeat").empty();
    var a = "";
    for (i = 0; i < playerQuantity; i++) {

        a = '';
        a += '<div class="playerConfirm confPage' + i + '">';
        a += '<h2>プレイヤー確認</h2>';
        a += '<div class="playerArea">';
        a += '<p><img src="../../public/images/web/ico_animal01.png" alt=""></p>';
        a += '<p class="playerName">あなたは<span class="animal animalNumber">シロクマ</span>さんですか？</p>';
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
        a += '<p class="playerName"><span class="animal">シロクマ</span>さんのターン</p>';
        a += '</div>';
        a += '<ul class="answerArea">';
        a += '<li><button type="button" class="correct answerBtn btnStyle01" value=""></button></li>';
        a += '<li><button type="button" class="incorrect answerBtn btnStyle02" value=""></button></li>';
        a += '</ul>';
        a += '</div>';

        $("#quizRepeat").append(a);
    }
};

// sec02,03の.nextクリックでsec03,04の読み込み
var nextPage = function nextPage() {
    for (var i = 2; i > 5; i++) {
        $('.next').on('click', function() {
            (function(n) {
                $('sec0' + n).css('z-index', '-1');
                $('sec0' + n + 1).css('z-index', '999');
                alert(n);
            })(i);
        });
    }
};

// デザインとかその他もろもろ最初に実行したいやつら
$(".contentIn > div").css("z-index", "-1");
$("#quizRepeat").css("z-index", "900");
$("#quizRepeat > div").css("z-index", "-1");
disp();
repeat();