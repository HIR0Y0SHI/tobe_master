/* 
 *
 * 概要：読み込み用ファイル。絶対パスで記述願う
 * ディレクトリ：/tobe_master/public/js
 * 作成者：荒井大輝
 *
 */

function importJS() {
    if (!new Array().push) return false;
    var scripts = new Array(
        // JQueryの読み込み
        '/tobe_master/public/js/jquery-3.1.1.min.js',
        // web側のjsの読み込み
        '/tobe_master/public/js/web/jquery.cookie.js',
        '/tobe_master/public/js/web/member_check.js',
        '/tobe_master/public/js/web/quiz_top.js'
    );
    for (var i = 0; i < scripts.length; i++) {
        document.write('<script type="text/javascript" src="' + scripts[i] + '" charset="utf-8"></script>');
    }
}
importJS();