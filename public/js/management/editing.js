$(function(){
  //画像ファイルプレビュー表示(Aパターン）
  $('.input-file_A_1').on('change', 'input[type="file"]', function(e) {
    var file = e.target.files[0],
        reader = new FileReader(),
        $preview = $(".preview_A_1");
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
                   class: "preview_A_1",
                  title: file.name
              }));
      };
    })(file);
    reader.readAsDataURL(file);
  });


  //画像ファイルプレビュー表示(Bパターン)
  $('.input-file_B_1').on('change', 'input[type="file"]', function(e) {
    var file = e.target.files[0],
        reader = new FileReader(),
        $preview1 = $(".preview_B_1");
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
                   class: "preview_B_1",
                  title: file.name
              }));
      };
    })(file);
    reader.readAsDataURL(file);
  });

  $('.input-file_B_2').on('change', 'input[type="file"]', function(e) {
    var file = e.target.files[0],
        reader = new FileReader(),
        $preview2 = $(".preview_B_2");
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
                   class: "preview_B_2",
                  title: file.name
              }));
      };
    })(file);
    reader.readAsDataURL(file);
  });

  //画像ファイルプレビュー表示(Cパターン)
  $('.input-file_C_1').on('change', 'input[type="file"]', function(e) {
    var file = e.target.files[0],
        reader = new FileReader(),
        $preview_A = $(".preview_C_1");
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
                   class: "preview_C_1",
                  title: file.name
              }));
      };
    })(file);
    reader.readAsDataURL(file);
  });
  $('.input-file_C_2').on('change', 'input[type="file"]', function(e) {
    var file = e.target.files[0],
        reader = new FileReader(),
        $preview_B = $(".preview_C_2");
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
                   class: "preview_C_2",
                  title: file.name
              }));
      };
    })(file);
    reader.readAsDataURL(file);
  });
});
