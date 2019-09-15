@extends('layouts/app')
@section('content')
<div class="container ops-main w-50">
    <div class="row">
        <div class="col-md-6">
            <h2>商品詳細</h2>
        </div>
    </div>
    <hr>
    <div class="d-flex flex-column">
        <strong>商品イメージ</strong>
        <a href="{{ $goods->goods_url }}"><img src="{{ $goods->goods_img_src }}" alt="{{ $goods->goods_name }}" height="200"></a>
    </div>
    <hr>
    <div class="d-flex flex-column">
        <strong for="goods_name">商品名</strong>
        {{ $goods->goods_name }}
    </div>
    <hr>
    <div class="d-flex flex-column">
        <strong for="goods_description">商品紹介文</strong>
        {{ $goods->goods_description }}
    </div>
    <hr>
    <div class="d-flex flex-column">
        <strong for="category">カテゴリー</strong>
        {{ $goods->category_name }}
    </div>
    <hr>
    <div class="d-flex flex-column">
        <strong for="category">紹介者</strong>
        {{ $goods->user_name }}
    </div>
    <hr>
    <div class="d-flex">
        <a href="/">ホームへ</a>
        <a class="ml-3" href="/mypage">マイページへ</a>
        <a class="btn btn-primary ml-auto" 
        href="https://twitter.com/share?url={{ request()->fullUrl() }}&hashtags={{ $goods->goods_name }}&text=私のお気に入り商品は「{{ $goods->goods_name }}」です。ぜひみなさんも試してみてください！" 
        rel="nofollow" 
        target="_blank"><i class="fab fa-twitter"></i> シェアする</a>
    </div>
</div>
@endsection