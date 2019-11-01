<div class="container ops-main w-75">
    @include('common/message')
    @if($target == 'store')
    <form class="post-form" action="/post" method="post" enctype="multipart/form-data">
    @elseif($target == 'update')
    <form class="post-form" action="/post/{{ $post->post_id }}" method="post" enctype="multipart/form-data">
        <input type="hidden" name="_method" value="PUT">
    @endif
        {{ csrf_field() }}
        <div class="row">
            <div class="col-12 col-sm-5">
                <div class="form-group">
                    <label for="goods-img" class="font-weight-bold">商品イメージ</label>
                    <div class="card bg-dark text-white border-0">
                        @if($target == 'store')
                            <img class="goods-img translucent" src="{{ asset('/img/preview.png') }}" alt="商品画像プレビュー">
                        @elseif($target == 'update')
                            <img class="goods-img translucent" src="/storage/{{ $post->goods_img_src }}" alt="{{ $post->goods_name }}">
                        @endif
                        <div class="card-img-overlay p-1">
                            <div class="card-img-inner text-center">
                                <i class="fas fa-camera h4 mb-1"></i>
                                <p class="card-text">商品画像を登録</p>
                            </div>
                        </div>
                        <input type="file" class="input-img input-goods-img form-control @error('goods_img') is-invalid @enderror" name="goods_img">
                    </div>
                    @error('goods_img')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            <div class="col-12 col-sm-7">
                <div class="form-group">
                    <label for="goods_name" class="font-weight-bold">商品名</label>
                    <input type="text" class="form-control @error('goods_name') is-invalid @enderror" name="goods_name" value="{{ $post->goods_name }}">
                    @error('goods_name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="category" class="font-weight-bold">カテゴリー</label>
                    <select name="category" class="form-control @error('category') is-invalid @enderror">
                        @foreach($categories as $category)
                        <option value="{{ $category->category_id }}" @if($target == 'update') {{ $post_model->checkSelectedCategory($post->category_id, $category->category_id) }} @endif>{{ $category->category_name }}</option>
                        @endforeach
                    </select>
                    @error('category')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="goods_description" class="font-weight-bold">コメント</label>
                    <textarea class="form-control @error('goods_description') is-invalid @enderror" name="goods_description" rows="6">{{ $post->goods_description }}</textarea>
                    @error('goods_description')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="goods_url" class="font-weight-bold">商品サイトURL</label>
                    <textarea type="text" class="form-control @error('goods_url') is-invalid @enderror" name="goods_url" rows="6">{{ $post->goods_url }}</textarea>
                    @error('goods_url')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            <button type="submit" class="btn btn-primary">保存</button>
            @if($target == 'update')
            <a class="page-link text-dark font-weight-bold d-inline-block ml-3" href="/post/{{ $post->post_id }}">詳細画面へ</a>
            @endif
        </div>
    </form>
</div>