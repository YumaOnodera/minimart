<div class="container ops-main w-75">
    <div class="row mb-3">
        <div class="category">
            <a class="text-dark small" href="#">カテゴリー</a> <i class="fas fa-angle-right text-dark small"></i> <a class="text-dark small" href="#">{{ $goods->category_name }}</a>
        </div>
    </div>
    <div class="row mb-5 item" data-goodsid="{{ $goods->goods_id }}">
        <div class="col-12 col-sm-5">
            <div class="goods_img text-center">
                <a href="{{ $goods->goods_url }}">
                    <img src="{{ $goods->goods_img_src }}" alt="{{ $goods->goods_name }}" height="400">
                </a>
            </div>
        </div>
        <div class="col-12 col-sm-7">
            <div class="goods_name">
                <h3>{{ $goods->goods_name }}</h3>
            </div>
            <div class="like_count mb-2">
                <div class="btn-like">
                    @if(Auth::check() && $like->getLikedUser($goods->goods_id, Auth::id()))
                    <i class="like-mark fas fa-heart text-danger"></i>
                    @else
                    <i class="like-mark far fa-heart text-danger"></i>
                    @endif
                    <span class="like-count text-danger ml-2">{{ $goods->like_count }}</span>
                </div>
            </div>
            <div class="introducer d-flex align-items-center mb-5">
                <div class="mr-2">
                    <a href="#"><img src="{{ $goods->user_img_src }}" alt="{{ $goods->user_name }}" height="32"> <span class="caret"></span></a>
                </div>
                <div>
                    <a href="#"> <span class="text-dark small">{{ $goods->user_name }}</span></a>
                    <br>
                    <span class="text-dark small">{{ $goods->updated_at->format('Y/m/d H:i') }}</span>
                </div>
            </div>
            <div class="goods_description">
                {{ $goods->goods_description }}
            </div>
        </div>
    </div>
    <div class="row justify-content-center">
        <a class="btn btn-primary mr-4" href="{{ $goods->goods_url }}"><i class="fas fa-shopping-cart"></i> 商品サイトへ</a>
    </div>
</div>

<footer class="footer-show fixed-bottom pt-2">
    <div class="container w-50">
        <div class="row">
            <div class="row mr-auto align-items-center item" data-goodsid="{{ $goods->goods_id }}">
                <div class="like_count">
                    <div class="btn-like d-flex align-items-center">
                        @if(Auth::check() && $like->getLikedUser($goods->goods_id, Auth::id()))
                        <i class="like-mark fas fa-heart text-danger h4"></i>
                        @else
                        <i class="like-mark far fa-heart text-danger h4"></i>
                        @endif
                        <span class="like-count text-danger ml-2 h5">{{ $goods->like_count }}</span>
                    </div>
                </div>
                @if(Auth::check() && $goods->introducer == Auth::id())
                <button class="btn ml-4" onclick="location.href='/goods/{{ $goods->goods_id }}/edit'"><i class="fas fa-edit text-muted h4"></i></button>
                <form action="/mypage/{{ $goods->goods_id }}" method="post">
                    <input type="hidden" name="_method" value="DELETE">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <button class="btn" type="submit" aria-label="Left Align"><i class="fas fa-trash-alt text-muted h4"></i></button>
                </form>
                @endif
            </div>
            <div class="row ml-auto">
                <a class="btn" 
                href="https://twitter.com/share?url={{ request()->fullUrl() }}&hashtags={{ $goods->goods_name }}&text=私のお気に入り商品は「{{ $goods->goods_name }}」です。ぜひみなさんも試してみてください！" 
                rel="nofollow" 
                target="_blank"><i class="fab fa-twitter text-primary h3"></i></a>
            </div>
        </div>
    </div>
</footer>