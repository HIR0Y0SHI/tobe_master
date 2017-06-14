/*
 *
 * 概要：人数選択。プレイヤー追加js
 * ディレクトリ：/tobe_master/public/js/web
 * 作成者：荒井大輝
 * 使用場所：top.html
 *
 */



var memberCheck = function memberCheck() {
	//初期人数
	var atai = 2;
	$("#members").val(atai);

	//＋が押されたとき
	$("#plus").on("click", function(){
		//６以上は発火しない
		if (atai < 6) {
			atai++;
			$("#members").val(atai);

			var chara = "";
			chara += "<div>";
				chara += '<img src="/tobe_master/public/images/sample.jpg" alt="" width="100px" height="100px" class="chara'+atai+'">';
			chara += "</div>";
			$("#charactorBox").append(chara);
		}
	});

	// ーが押されたとき
	$("#minus").on("click", function(){
		// ２以下では発火しない
		if (atai > 2) {
			$(".chara"+atai).remove();
			atai--;
			$("#members").val(atai);
		}
	});

	// 決定ボタンが押されたときクッキーを作成
	$("input[type='submit']").on("click", function(){
		atai = $("#members").val();
		$.cookie("player", atai, { expires: 1 });	
		window.location.href = 'http://localhost/tobe_master/templates/web/test_html/timebar.html';
	});
};
memberCheck();