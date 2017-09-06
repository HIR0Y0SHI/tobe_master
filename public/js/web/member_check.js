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
    var atai = 1;

    //＋が押されたとき
    $(".plus").on("click", function() {
        //６以上は発火しない
        var icon = '';
        if (atai < 6) {
            atai++;
            switch (atai) {
                case 2:
                    icon = 'ico_bear01.jpg';
                    break;
                case 3:
                    icon = 'ico_tiger01.jpg';
                    break;
                case 4:
                    icon = 'ico_rabbit01.jpg';
                    break;
                case 5:
                    icon = 'ico_fox01.jpg';
                    break;
                case 6:
                    icon = 'ico_elephant01.jpg';
                    break;
            };
            var chara = "";
            chara += "<li>";
            chara += '<img src = "/tobe_master/public/images/web/' + icon + '" alt = ""> <span> シロクマ </span>';
            chara += "</li>";
            $(".playerList01").append(chara);
        }
    });

    // ーが押されたとき
    $(".minus").on("click", function() {
        // ２以下では発火しない
        if (atai > 1) {
            $(".playerList01 li:last-child").remove();
            atai--;
        }
    });

    // 決定ボタンが押されたときクッキーを作成
    $(".gameStart").on("click", function() {
        $.cookie("playerQuantity", atai, { expires: 1 });
        console.log('値：' + atai)
        window.location.href = 'http://localhost/tobe_master/web/quiz/multiple';
    });
};
memberCheck();