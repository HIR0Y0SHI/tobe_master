/*
 *
 * 概要：問題表示、人数分のループなどメイン部分
 * 作成者:荒井大輝
 * ディレクトリ：tobe_master\public\js\web
 *
 */


$(function (){
    $.ajax({
		type:"GET",
		url:"/tobe_master/api/mock/question/multiple/1",
        // /api/mock/question/multiple/{number}
        dataType:"json",
        crossdomain: true
	}).done(function(data){
		var question = data.question;
        var pattern = data.pattern;
        var ans = data.choices.ans;
        var inc = data.choices.inc;
        var image = data.image;

        console.log(pattern);
        console.log(question);
        console.log(ans);
        console.log(inc);
        console.log(image);
        
        $("#qu").text(question);
        $("#ans").text(ans);
        $("#inc").text(inc);
        $("#answer").text(ans);

        //次の問題数を投げる。

	}).fail(function(XMLHttpRequest, textStatus, errorThrown){
		alert("chk失敗");
		console.log(XMLHttpRequest);
		console.log('2:'+textStatus);
		console.log('3:'+errorThrown);
	});
});




/**
 *
 *
 *TweenMaxを使って、アニメーションなどの制御を行う
 *
 *
 */

$(".next").on("click", function(){
    TweenMax.to('#box1', -1, {
        display: 'none',
        onComplete: function(){// 処理完了後に実行される
            timeBlueBar();
        }
    });
});



var loadBox = function loadbox() {
    TweenMax.to('#box2', -1, {
        display: 'none'
    });
};

$("#box3").on("click", function(){
    TweenMax.to('#box3', -1, {
        display: 'none'
    });
});