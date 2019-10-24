$(function () {

    // プロフィール編集ボタンをクリックした場合
    $('.btn-profile-setting').click(function() {
  
        // プロフィール表示切り替え
        profileDispSwitch();
    });

    // キャンセルボタンをクリックした場合
    $('.btn-cancel').click(function() {
  
        // プロフィール表示切り替え
        profileDispSwitch();
    });

    // アバター画像を選択した場合
    $('.input-avatar-img').change(function(e) {

        // アバター画像を取得
        var image = $('.avatar-img');

        // プレビュー画像表示
        imagePreview(e, image);
    });

    // ヘッダー画像を選択した場合
    $('.input-header-img').change(function(e){

        // ヘッダー画像を取得
        var image = $('.header-img');

        // プレビュー画像表示
        imagePreview(e, image);
    });

    // 商品画像を選択した場合
    $('.input-goods-img').change(function(e){

        // ヘッダー画像を取得
        var image = $('.goods-img');

        // プレビュー画像表示
        imagePreview(e, image);
    });
});

// プロフィール表示切り替え
function profileDispSwitch() {
    $('.user-name').toggle();
    $('.input-user-name').toggle();
    $('.introduction').toggle();
    $('.input-introduction').toggle();
    $('.row-site-url').toggle();
    $('.user-info-nav').toggle();
    $('.ops-main').toggle();
    $('.btn-profile-setting').toggle();
    $('.row-profile-edit').toggle();
    $('.card-img-overlay').toggle();
    $('.input-img').toggle();
    $('.card-img-custom').toggleClass('translucent');
}

// プレビュー画像表示
function imagePreview(e, image) {

    //ファイルオブジェクトを取得する
    var file = e.target.files[0];
    var reader = new FileReader();

    //画像でない場合は処理終了
    if(file.type.indexOf("image") < 0){
        alert("画像ファイルを指定してください。");
        return false;
    }
 
    //アップロードした画像を設定する
    reader.onload = (function() {
        return function(e){
            image.attr("src", e.target.result);
        };
    })(file);
    reader.readAsDataURL(file);
}
