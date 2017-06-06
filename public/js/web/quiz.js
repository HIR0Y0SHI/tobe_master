// $(function(){
//     $("#1k").on("click", function(){
//         $("#1k").fadeOut(1000, "linear");
//         $("#2k").fadeIn(1000, "linear");
//         // $("#1k").fadeIn(1000, "linear");
//     });

//     $("#2k").on("click", function(){
//         $("#2k").fadeOut(1000, "linear");
//         $("#1k").fadeIn(1000, "linear");
//     });
// });


$(function (){
    $.ajax({
		type:"GET",
		url:"http://160.16.107.190/tobe_api.php",
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
        $("#answ").text(ans);
        $("#inc").text(inc);

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

$("#box1").on("click", function(){
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