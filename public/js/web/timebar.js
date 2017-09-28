/**
 *
 * 内容：タイムバー
 * 種類：Web
 * 作成者：荒井大輝
 *
 */

//青色のタイムバー
var timeBlueBar = function blueBar(timebarCount) {
    $('.timebar').css('right', '0%');
    $(".timebar").css("backgroundColor", "#60D3FF");
    TweenMax.to('.timebar', timebarCount, {
        right: '33%',
        ease: Power0.easeNone,
        onComplete: function() {
            timeYellowBar(timebarCount);
            $(".timebar").css("backgroundColor", "yellow");
        }
    });
};

//黄色のタイムバー
var timeYellowBar = function yellowBar(timebarCount) {
    TweenMax.to('.timebar', timebarCount, {
        right: '66%',
        ease: Power0.easeNone,
        onComplete: function() {
            timeRedBar(timebarCount);
            $(".timebar").css("backgroundColor", "red");
        }
    });
};

//赤色のタイムバー
var timeRedBar = function redBar(timebarCount) {
    TweenMax.to('.timebar', timebarCount, {
        right: '100%',
        ease: Power0.easeNone,
        onComplete: function() {
            nextPlayer();
            answerCheck();
        }
    });
};