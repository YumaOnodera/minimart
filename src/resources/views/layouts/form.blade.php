<div class="container ops-main w-75">
    @include('common/message')
    @if($target == 'store')
    <form action="/mypage" method="post" enctype="multipart/form-data">
    @elseif($target == 'update')
    <form action="/mypage/{{ $goods->goods_id }}" method="post" enctype="multipart/form-data">
        <input type="hidden" name="_method" value="PUT">
    @endif
        {{ csrf_field() }}
        <div class="row">
            <div class="col-12 col-sm-5">
                <div class="form-group">
                    <label for="goods_img" class="font-weight-bold">商品イメージ</label>
                    <div class="mb-3 text-center">
                        @if($target == 'update')
                            <img class="goods_img" src="{{ $goods->goods_img_src }}" alt="{{ $goods->goods_name }}">
                        @endif
                    </div>
                    <input type="file" class="form-control @error('goods_img') is-invalid @enderror" name="goods_img">
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
                    <input type="text" class="form-control @error('goods_name') is-invalid @enderror" name="goods_name" value="{{ $goods->goods_name }}">
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
                    <label for="goods_description" class="font-weight-bold">コメント</label>
                    <textarea class="form-control @error('goods_description') is-invalid @enderror" name="goods_description" rows="6">{{ $goods->goods_description }}</textarea>
                    @error('goods_description')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="goods_url" class="font-weight-bold">商品サイトURL</label>
                    <textarea type="text" class="form-control @error('goods_url') is-invalid @enderror" name="goods_url" rows="6">{{ $goods->goods_url }}</textarea>
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
            <a class="page-link text-dark font-weight-bold d-inline-block ml-3" href="/mypage/{{ $goods->goods_id }}">詳細画面へ</a>
        </div>
    </form>
</div>