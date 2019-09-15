<div class="container ops-main">
    <div class="row">
        <div class="col-md-6">
            <h2>商品登録</h2>
        </div>
    </div>
    <div class="row">
        <div class="col-md-8 col-md-offset-1">
            @if($target == 'store')
            <form action="/mypage" method="post">
            @elseif($target == 'update')
            <form action="/mypage/{{ $goods->goods_id }}" method="post">
                <input type="hidden" name="_method" value="PUT">
            @endif
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="form-group">
                    <label for="goods_name">商品名</label>
                    <input type="text" class="form-control" name="goods_name" value="{{ $goods->goods_name }}">
                </div>
                <div class="form-group">
                    <label for="goods_description">説明</label>
                    <textarea class="form-control" name="goods_description">{{ $goods->goods_description }}</textarea>
                </div>
                <div class="form-group">
                    <label for="category">カテゴリー</label>
                    <select name="category" class="form-control">
                        @foreach($categories as $category)
                        <option value="{{ $category->category_id }}">{{ $category->category_name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="goods_url">商品サイトURL</label>
                    <textarea type="text" class="form-control" name="goods_url">{{ $goods->goods_url }}</textarea>
                </div>
                <div class="form-group">
                    <label for="goods_img_src">商品イメージURL</label>
                    <textarea type="text" class="form-control" name="goods_img_src">{{ $goods->goods_img_src }}</textarea>
                </div>
                <button type="submit" class="btn btn-primary">登録</button>
                <a class="ml-3" href="/mypage">戻る</a>
            </form>
        </div>
    </div>
</div>