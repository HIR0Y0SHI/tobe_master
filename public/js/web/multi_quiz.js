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
		var i = 0;
			var question = data.questions[i].question;
			var pattern = data.questions[i].pattern;
			var correct = data.questions[i].choices.ans;
			var incorrect = data.questions[i].choices.inc;
			var image = data.questions[i].image;
			var solution_time = data.questions[i].solution_time;
			$.cookie("solution_time", solution_time, { expires: 1 });
			
			$(".questionText").text(question);
			$("#correct").text(correct);
			$("#incorrect").text(incorrect);	
		// $("#answer").text(ans);

		//次の問題数を投げる。

	}).fail(function(XMLHttpRequest, textStatus, errorThrown){
		alert("chk失敗");
		console.log(XMLHttpRequest);
		console.log('2:'+textStatus);
		console.log('3:'+errorThrown);
	});
});

var disp = function disp() {
	$("#test").empty();
	// var k = 0;
	// // ここのplayerのクッキー発行はテスト用
	// $.cookie("player", 3, { expires: 1 });
	// for (var i = $.cookie("player"); k <= i; k++) {
	// 	console.log(i);
	var a = "";
	// for (var i = 0; i < 3; i++) {
		

		a += '<div class="box1" style="width:100%;height:100%;background-color:beige;z-index:10">';
			a += '<h1>複数人プレイで決定押して飛んでくるページ<br>kuwanoですか？</h1>';
			a += '<button class="next">kuwanoです</button>';
		a += '</div>';

		a += '<div class="box2" style="width:100%;height:100%;background-color:white;z-index:9">';
			a += '<h1 id="questionText"></h1>';
			a += '<div class="time"><div class="timebar"></div></div>';
			a += '<button type="button" id="correct" value=""></button>';
			a += '<button type="button" id="incorrect" value=""></button>';
		a += '</div>';

	$("#test").append(a);
	// }
	// };
	
};
disp();


/**
 *
 *
 *TweenMaxを使って、アニメーションなどの制御を行う
 *
 *
 */

$(".outputQuestion").on("click", function(){
	TweenMax.to('.playerConfirm', -1, {
		zIndex: '-1',
		onComplete: function(){// 処理完了後に実行される
			$(".sec01").css("z-index","999");
			timeBlueBar();
		}
	});
});

var loadBox = function loadbox() {
	TweenMax.to('#quizRepeat', -1, {
		zIndex: '-1',
		onComplete: function(){
			$(".sec01").css("z-index","-1");
			$(".sec02").css("z-index","999");
		}
	});
};

$("#box3").on("click", function(){
	TweenMax.to('#box3', -1, {
		display: 'none'
	});
});



$(".contentIn > div").css("z-index","-1");
$("#quizRepeat > .sec01").css("z-index","-1");
$("#quizRepeat > .playerConfirm").css("z-index","998");
$("#quizRepeat").css("z-index","999");