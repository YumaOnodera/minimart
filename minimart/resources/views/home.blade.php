@extends('layouts/app')
@section('content')
<div class="container ops-main">
  <div class="row">
    <div class="col-md-12">
      <h3 class="ops-title">みんなのおすすめグッズ</h3>
    </div>
  </div>
  <div class="row">
    <div class="col-md-11 col-md-offset-1">
      <table class="table text-center">
        <tr>
          <th class="text-center text-nowrap">商品イメージ</th>
          <th class="text-center text-nowrap">商品名</th>
          <th class="text-center text-nowrap">説明</th>
          <th class="text-center text-nowrap">カテゴリー</th>
          <th class="text-center text-nowrap">紹介者</th>
          <th class="text-center text-nowrap">シェア</th>
        </tr>
        @foreach($goods as $item)
        <tr>
          <td><a href="{{ $item->goods_url }}"><img src="{{ $item->goods_img_src }}" alt="{{ $item->goods_name }}" height="200"></a></td>
          <td>{{ $item->goods_name }}</td>
          <td>{{ $item->goods_description }}</td>
          <td>{{ $item->category_name }}</td>
          <td>{{ $item->user_name }}</td>
          <td><a href="https://twitter.com/share?
          url={{ $item->goods_url }}&
          hashtags={{ $item->goods_name }}&
          text={{ $item->goods_url }}" 
          rel="nofollow" 
          target="_blank"><i class="fab fa-twitter-square fa-3x"></i></a>
          </td>
        </tr>
        @endforeach
      </table>
    </div>
  </div>
</div>
@endsection