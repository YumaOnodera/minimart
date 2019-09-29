@extends('layouts/app')
@inject('like','App\Like')
@section('content')
<div class="container ops-main">
  @include('common/message')
  <div class="row">
    <div class="col-md-12">
      <h3 class="ops-title">お気に入りグッズ</h3>
    </div>
  </div>
  <div class="row">
    <div class="col-md-11 col-md-offset-1">
      <table class="table text-center">
        <tr>
          <th class="text-center text-nowrap">商品イメージ</th>
          <th class="text-center text-nowrap">商品名</th>
          <th class="text-center text-nowrap">商品紹介文</th>
          <th class="text-center text-nowrap">カテゴリー</th>
          <th class="text-center text-nowrap">いいね</th>
          <th class="text-center text-nowrap">詳細</th>
          <th class="text-center text-nowrap">編集</th>
          <th class="text-center text-nowrap">削除</th>
        </tr>
        @foreach($goods as $item)
        <tr class="item" data-goodsid="{{ $item->goods_id }}">
          <td><a href="{{ $item->goods_url }}"><img src="{{ $item->goods_img_src }}" alt="{{ $item->goods_name }}" height="200"></a></td>
          <td>{{ $item->goods_name }}</td>
          <td>{{ $item->goods_description }}</td>
          <td>{{ $item->category_name }}</td>
          <td>
            <div class="btn-like">
              @if(Auth::check() && $like->getLikedUser($item->goods_id, Auth::id()))
              <i class="like-mark fas fa-heart text-danger"></i>
              @else
              <i class="like-mark far fa-heart text-danger"></i>
              @endif
              <span class="like-count text-danger ml-2">{{ $item->like_count }}</span>
            </div>
          </td>
          <td><a class="btn btn-primary text-nowrap" href="/mypage/goods/{{ $item->goods_id }}">詳細</a></td>
          <td>
            <button onclick="location.href='/goods/{{ $item->goods_id }}/edit'" class="btn btn-xs btn-success px-2 py-1" aria-label="Left Align"><i class="fas fa-edit"></i></button>
          </td>
          <td>
            <form action="/mypage/{{ $item->goods_id }}" method="post">
              <input type="hidden" name="_method" value="DELETE">
              <input type="hidden" name="_token" value="{{ csrf_token() }}">
              <button type="submit" class="btn btn-xs btn-danger px-2 py-1" aria-label="Left Align"><i class="fas fa-trash-alt"></i></button>
            </form>
          </td>
        </tr>
        @endforeach
      </table>
    </div>
  </div>
</div>
@endsection