<div class="container ops-main">
    <div class="row">
        <div class="col-md-6">
            <h2>商品登録</h2>
        </div>
    </div>
    <div class="row">
        <div class="col-md-8 col-md-offset-1">
            @include('mypage/message')
            @if($target == 'store')
            <form action="/mypage" method="post">
            @elseif($target == 'update')
            <form action="/mypage/{{ $goods->goods_id }}" method="post">
                <input type="hidden" name="_method" value="PUT">
            @endif
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="form-group">
                    <label for="goods_name">商品名</label>
                    <input type="text" class="form-control @error('goods_name') is-invalid @enderror" name="goods_name" value="{{ $goods->goods_name }}">
                    @error('goods_name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="goods_description">商品紹介文</label>
                    <textarea class="form-control @error('goods_description') is-invalid @enderror" name="goods_description">{{ $goods->goods_description }}</textarea>
                    @error('goods_description')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="category">カテゴリー</label>
                    <select name="category" class="form-control @error('category') is-invalid @enderror">
                        @foreach($categories as $category)
                        <option value="{{ $category->category_id }}">{{ $category->category_name }}</option>
                        @endforeach
                    </select>
                    @error('category')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="goods_url">商品サイトURL</label>
                    <textarea type="text" class="form-control @error('goods_url') is-invalid @enderror" name="goods_url">{{ $goods->goods_url }}</textarea>
                    @error('goods_url')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="goods_img_src">商品イメージパス</label>
                    <textarea type="text" class="form-control @error('goods_img_src') is-invalid @enderror" name="goods_img_src">{{ $goods->goods_img_src }}</textarea>
                    @error('goods_img_src')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary">登録</button>
                <a class="ml-3" href="/mypage">戻る</a>
            </form>
        </div>
    </div>
</div>