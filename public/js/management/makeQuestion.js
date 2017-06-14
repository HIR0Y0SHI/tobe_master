$(function (){

$('.tab-title li').on('click', function(e){
  /* タブ */
  var th = $(this).index();  // 何番目のタブがクリックされたか
  var $tab_contents = $('.tab-contents li');
  $tab_contents.removeClass('active');
  $tab_contents.eq(th).addClass('active');

  /* スライドバー */
  var position = $(this).width() * th;  // 位置
  $('.tab-title-bar').css('left', position+'px');

  /* 波紋エフェクト */
  $('.tab .ripple').remove();  // 前の波紋要素を消す

  var tab_width = $(this).width(),
      tab_height = $(this).height(),
      tab_x = $(this).offset().left,
      tab_y = $(this).offset().top;

  // 大きい方の幅に合わせる
  var size = tab_width >= tab_height ? tab_width : tab_height;

  // 波紋要素を追加
  $(this).prepend('<div class="ripple"></div>');

  // 中心座標を算出
  var x = e.pageX - tab_x - size / 2,
      y = e.pageY - tab_y - size / 2;

  $('.ripple').css({
    width: size,
    height: size,
    top: y + 'px',
    left: x + 'px'
  }).addClass('ripple-animation');
});

});

// 解答方法
function entryChange1() {
  radio = document.getElementsByName('answertype')
  if (radio[0].checked) {
    //フォーム
    document.getElementById('firstBox').style.display = "";
    document.getElementById('secondBox').style.display = "none";
  } else if (radio[1].checked) {
    //フォーム
    document.getElementById('firstBox').style.display = "none";
    document.getElementById('secondBox').style.display = "";
  }
}

// 解答方法
function entryChange2() {
  radio = document.getElementsByName('answertype2')
  if (radio[0].checked) {
    //フォーム
    document.getElementById('firstBox2').style.display = "";
    document.getElementById('secondBox2').style.display = "none";
  } else if (radio[1].checked) {
    //フォーム
    document.getElementById('firstBox2').style.display = "none";
    document.getElementById('secondBox2').style.display = "";
  }
}

//オンロードさせ、リロード時に選択を保持
window.onload = function () { // ページ読み込み時
    entryChange1(); // 関数呼び出し
    entryChange2(); // 関数呼び出し
}
