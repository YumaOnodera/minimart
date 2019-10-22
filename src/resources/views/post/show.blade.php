@extends('layouts/app')
@inject('like','App\Like')
@section('title', $post->goods_name . ' | ')
@section('content')
<div class="container ops-main w-75">
    <div class="row mb-3">
        <div class="category">
            <a class="text-dark small" href="#">カテゴリー</a> <i class="fas fa-angle-right text-dark small"></i> <a class="text-dark small" href="#">{{ $post->category_name }}</a>
        </div>
    </div>
    <div class="row mb-5 item" data-postid="{{ $post->post_id }}">
        <div class="col-12 col-sm-5">
            <div class="text-center">
                <a href="{{ $post->goods_url }}">
                    <img class="goods_img" src="{{ $post->goods_img_src }}" alt="{{ $post->goods_name }}">
                </a>
            </div>
        </div>
        <div class="col-12 col-sm-7">
            <div class="goods_name">
                <h3>{{ $post->goods_name }}</h3>
            </div>
            <div class="like_count mb-2">
                <div class="btn-like">
                    @if(Auth::check() && $like->getLikedUser($post->post_id, Auth::id()))
                    <i class="like-mark fas fa-heart text-danger"></i>
                    @else
                    <i class="like-mark far fa-heart text-danger"></i>
                    @endif
                    <span class="like-count text-danger ml-2">{{ $post->like_count }}</span>
                </div>
            </div>
            <div class="introducer d-flex align-items-center mb-5">
                <div class="mr-2">
                    @if (isset($user->avatar_img_src))
                    <a href="#"><img src="{{ $post->avatar_img_src }}" alt="{{ $post->user_name }}" height="32"></a>
                    @else
                    <a href="#"><img src="{{ asset('/img/default-avatar.jpeg') }}" alt="{{ $post->user_name }}" height="32"></a>
                    @endif
                </div>
                <div>
                    <a href="/{{ $post->user_id }}"> <span class="text-dark small">{{ $post->user_name }}</span></a>
                    <br>
                    <span class="text-dark small">{{ $post->updated_at->format('Y/m/d H:i') }}</span>
                </div>
            </div>
            <div class="goods_description">
                {{ $post->goods_description }}
            </div>
        </div>
    </div>
    <div class="row justify-content-center">
        <a class="btn btn-primary mr-4" href="{{ $post->goods_url }}"><i class="fas fa-shopping-cart"></i> 商品サイトへ</a>
    </div>
</div>

<footer class="footer-show fixed-bottom pt-2">
    <div class="container w-50">
        <div class="row">
            <div class="row mr-auto align-items-center item" data-postid="{{ $post->post_id }}">
                <div class="like_count">
                    <div class="btn-like d-flex align-items-center">
                        @if(Auth::check() && $like->getLikedUser($post->post_id, Auth::id()))
                        <i class="like-mark fas fa-heart text-danger h4"></i>
                        @else
                        <i class="like-mark far fa-heart text- h4"></i>
                        @endif
                        <span class="like-count text-secondary ml-2 h5">{{ $post->like_count }}</span>
                    </div>
                </div>
                <div class="btn-favorite d-flex align-items-center ml-4">
                    @if(Auth::check() && $like->getLikedUser($post->post_id, Auth::id()))
                    <i class="favorite-mark fas fa-star text-warning h4"></i>
                    @else
                    <i class="favorite-mark far fa-star text-secondary h4"></i>
                    @endif
                </div>
            </div>
            <div class="row mx-auto">
                @if(Auth::check() && $post->introducer == Auth::id())
                <button class="btn ml-4" onclick="location.href='/post/{{ $post->post_id }}/edit'"><i class="fas fa-edit text-secondary h4"></i></button>
                <form action="/post/{{ $post->post_id }}" method="post">
                    <input type="hidden" name="_method" value="DELETE">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <button class="btn" type="submit" aria-label="Left Align"><i class="fas fa-trash-alt text-secondary h4"></i></button>
                </form>
                @endif
            </div>
            <div class="row ml-auto">
                <a class="btn" 
                href="https://twitter.com/share?url={{ request()->fullUrl() }}&hashtags={{ $post->goods_name }}&text=私のお気に入り商品は「{{ $post->goods_name }}」です。ぜひみなさんも試してみてください！" 
                rel="nofollow" 
                target="_blank"><i class="fab fa-twitter text-secondary h3"></i></a>
                <a class="btn" 
                href="http://www.facebook.com/share.php?u={{ request()->fullUrl() }}" 
                rel="nofollow" 
                target="_blank"><i class="fab fa-facebook text-secondary h3"></i></a>
                <a class="btn" 
                href="https://social-plugins.line.me/lineit/share?url={{ request()->fullUrl() }}" 
                rel="nofollow" 
                target="_blank"><i class="fab fa-line text-secondary h3"></i></a>
            </div>
        </div>
    </div>
</footer>
@endsection