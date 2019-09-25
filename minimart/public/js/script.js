$(document).ready(function () {

    // タブをクリックした場合
    $('.nav-tabs .nav-item .nav-link').click(function() {
  
        var index = $('.nav-tabs .nav-item .nav-link').index(this);
    
        // カードヘッダー表示切り替え
        $('.nav-tabs .nav-item .nav-link').removeClass('active');
        $(this).addClass('active');

        // カードボディ表示切り替え
        $('.item').removeClass('active');
        $('.item').eq(index).addClass('active');
    });

    // アカウント設定をクリックした場合
    $('#account-header').click(function() {
        $('#delete-form').addClass('active');
    });

    // パスワード変更をクリックした場合
    $('#password-header').click(function() {
        $('#delete-form').removeClass('active');
    });
});