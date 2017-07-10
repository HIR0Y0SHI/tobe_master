/**
 *
 * 内容：タイムバー
 * 種類：Web
 * 作成者：荒井大輝
 *
 */


var timebarCount = $.cookie("second");
timebarCount = 3;
console.log("カウント時間" + timebarCount);
timebarCount = timebarCount / 3;

//青色のタイムバー
var timeBlueBar = function blueBar() {
    $('.timebar').css('right', '0%');
    $(".timebar").css("backgroundColor", "#60D3FF");
    TweenMax.to('.timebar', timebarCount, {
        right: '33%',
        ease: Power0.easeNone,
        onComplete: function() {
            timeYellowBar();
            $(".timebar").css("backgroundColor", "yellow");
        }
    });
};

//黄色のタイムバー
var timeYellowBar = function yellowBar() {
    TweenMax.to('.timebar', timebarCount, {
        right: '66%',
        ease: Power0.easeNone,
        onComplete: function() {
            timeRedBar();
            $(".timebar").css("backgroundColor", "red");
        }
    });
};

//赤色のタイムバー
var timeRedBar = function redBar() {
    TweenMax.to('.timebar', timebarCount, {
        right: '100%',
        ease: Power0.easeNone,
        onComplete: function() {
            nextQuestion();
        }
    });
};