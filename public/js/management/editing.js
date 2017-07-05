$(function(){
  //画像ファイルプレビュー表示(Aパターン）
  $('.input-file_A').on('change', 'input[type="file"]', function(e) {
    var file = e.target.files[0],
        reader = new FileReader(),
        $preview = $(".preview");
        t = this;

    // 画像ファイル以外の場合は何もしない
    if(file.type.indexOf("image") < 0){
      return false;
    }

    reader.onload = (function(file) {
      return function(e) {
        $preview.empty();
        $preview.append($('<img>').attr({
                  src: e.target.result,
                  width: "150px",
                   class: "preview",
                  title: file.name
              }));
      };
    })(file);
    reader.readAsDataURL(file);
  });


  //画像ファイルプレビュー表示(Bパターン)
  $('.input-file1').on('change', 'input[type="file"]', function(e) {
    var file = e.target.files[0],
        reader = new FileReader(),
        $preview1 = $(".preview1");
        t = this;
    // 画像ファイル以外の場合は何もしない
    if(file.type.indexOf("image") < 0){
      return false;
    }
    reader.onload = (function(file) {
      return function(e) {
        $preview1.empty();
        $preview1.append($('<img>').attr({
                  src: e.target.result,
                  width: "150px",
                   class: "preview1",
                  title: file.name
              }));
      };
    })(file);
    reader.readAsDataURL(file);
  });
  $('.input-file2').on('change', 'input[type="file"]', function(e) {
    var file = e.target.files[0],
        reader = new FileReader(),
        $preview2 = $(".preview2");
        t = this;
    // 画像ファイル以外の場合は何もしない
    if(file.type.indexOf("image") < 0){
      return false;
    }
    reader.onload = (function(file) {
      return function(e) {
        $preview2.empty();
        $preview2.append($('<img>').attr({
                  src: e.target.result,
                  width: "150px",
                   class: "preview2",
                  title: file.name
              }));
      };
    })(file);
    reader.readAsDataURL(file);
  });

  //画像ファイルプレビュー表示(Cパターン)
  $('.input-fileA').on('change', 'input[type="file"]', function(e) {
    var file = e.target.files[0],
        reader = new FileReader(),
        $preview_A = $(".preview_A");
        t = this;
    // 画像ファイル以外の場合は何もしない
    if(file.type.indexOf("image") < 0){
      return false;
    }

    reader.onload = (function(file) {
      return function(e) {
        $preview_A.empty();
        $preview_A.append($('<img>').attr({
                  src: e.target.result,
                  width: "150px",
                   class: "preview_A",
                  title: file.name
              }));
      };
    })(file);
    reader.readAsDataURL(file);
  });
  $('.input-fileB').on('change', 'input[type="file"]', function(e) {
    var file = e.target.files[0],
        reader = new FileReader(),
        $preview_B = $(".preview_B");
        t = this;
    // 画像ファイル以外の場合は何もしない
    if(file.type.indexOf("image") < 0){
      return false;
    }
    reader.onload = (function(file) {
      return function(e) {
        $preview_B.empty();
        $preview_B.append($('<img>').attr({
                  src: e.target.result,
                  width: "150px",
                   class: "preview_B",
                  title: file.name
              }));
      };
    })(file);
    reader.readAsDataURL(file);
  });
});
