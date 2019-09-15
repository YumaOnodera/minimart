@extends('layouts/app')
@section('content')
<div class="container ops-main">
  <div class="row">
    <div class="col-md-12">
      <h3 class="ops-title">お気に入りグッズ</h3>
    </div>
  </div>
  <div class="row">
    <div class="col-md-11 col-md-offset-1">
      <table class="table text-center">
        <tr>
          <th class="text-center">商品イメージ</th>
          <th class="text-center">商品名</th>
          <th class="text-center">説明</th>
          <th class="text-center">カテゴリー</th>
          <th class="text-center">編集</th>
          <th class="text-center">削除</th>
        </tr>
        @foreach($goods as $item)
        <tr>
          <td><a href="{{ $item->goods_url }}"><img src="{{ $item->goods_img_src }}" alt="{{ $item->goods_name }}" height="200"></a></td>
          <td>{{ $item->goods_name }}</td>
          <td>{{ $item->goods_description }}</td>
          <td>{{ $item->category_name }}</td>
          <td>
            <button onclick="location.href='/mypage/{{ $item->goods_id }}/edit'" class="btn btn-xs btn-success px-2 py-1" aria-label="Left Align"><i class="fas fa-edit"></i></button>
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