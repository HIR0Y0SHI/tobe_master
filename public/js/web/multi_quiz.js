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
		var solution_time = data.solution_time;
		$.cookie("solution_time", solution_time, { expires: 1 });
		
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

var disp = function disp() {
	$("#test").empty();
	var k = 0;
	alert($.cookie("player"));
	for (var i = $.cookie("player"); k <= i; k++) {
		console.log(i);
		var a = "";
		a += '<div id="box1" style="width:100%;height:100%;background-color:beige;z-index:10">';
			a += '<h1>複数人プレイで決定押して飛んでくるページ<br>kuwanoですか？</h1>';
			a += '<button class="next">kuwanoです</button>';
		a += '</div>';

		a += '<div id="box2" style="width:100%;height:100%;background-color:white;z-index:9">';
			a += '<h1 id="qu"></h1>';
			a += '<div id="time"><div id="timebar"></div></div>';
			a += '<button type="button" id="ans" value=""></button>';
			a += '<button type="button" id="inc" value=""></button>';
		a += '</div>';

	
		$("#test").append(a);
	}
	
};
disp();


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