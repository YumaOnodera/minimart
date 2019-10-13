$(function(){
    $('.btn-like').on('click',function(e){

        e.stopPropagation();

        // 商品IDを取得
        var liked_goods_id = $(this).parents('.item').data('goodsid');
        
        // クリックした要素の状態を格納
        var $this = $(this);

        // クリックした要素のいいね数を取得
        var like_count = parseInt($this.children('.like-count').text(), 10);

        $.ajax({
            type: 'POST',
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            url: '/like',
            data: { goods_id: liked_goods_id }
        }).done(function(data){
            console.log('Ajax Success');

            // いいねの総数を表示
            $this.children('.like-count').text();

            // すでにいいねされていた場合
            if ($this.children('.like-mark').attr('data-prefix') == 'fas') {
                
                // 空洞ハートのスタイルを適用
                $this.children('.like-mark').attr('data-prefix', 'far');

                // いいね数を減算
                $this.children('.like-count').text(like_count - 1)
            }
            // まだいいねされていない場合
            else {
                // 塗りつぶしハートのスタイルを適用
                $this.children('.like-mark').attr('data-prefix', 'fas');

                // いいね数を加算
                $this.children('.like-count').text(like_count + 1);
            }
        }).fail(function(msg) {
            console.log('Ajax Error');
        });
    });
});