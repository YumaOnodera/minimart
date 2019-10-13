@extends('layouts/app')
@inject('goodsModel','App\Goods')
@inject('like','App\Like')
@section('title', $user->user_name . '(' . $user->user_id . ')さん | ')
@section('header')
@include('common/message')
<header class="header-profile">
    <form action="/user/{{ Auth::id() }}" method="post" enctype="multipart/form-data">
        <input type="hidden" name="_method" value="PUT">
        {{ csrf_field() }}
        <div class="card bg-dark text-white mb-0">
            @if (isset(Auth::user()->header_img_src))
            <img class="card-img-custom header-img" src="{{ Auth::user()->header_img_src }}" alt="ヘッダー画像" height="360">
            @else
            <img class="card-img-custom header-img" src="{{ asset('/img/default-header.jpeg') }}" alt="ヘッダー画像" height="360">
            @endif
            <div class="card-img-overlay">
                <div class="card-img-inner text-center">
                    <i class="fas fa-camera h4 mb-1"></i>
                    <p class="card-text">ヘッダー画像を変更</p>
                </div>
            </div>
            <input class="input-img input-header-img" type="file" name="header_img">
        </div>
        <div class="container-fluid bg-white px-0 border-bottom">
            <div class="col-xl-7 mx-auto">
                <div class="row py-4">
                    <div class="pr-4">
                        <div class="card bg-dark text-white rounded-circle mb-0">
                            @if (isset(Auth::user()->avatar_img_src))
                            <img class="card-img-custom avatar-img rounded-circle" src="{{ Auth::user()->avatar_img_src }}" alt="{{ Auth::user()->user_name }}" height="120">
                            @else
                            <img class="card-img-custom avatar-img rounded-circle" src="{{ asset('/img/default-avatar.jpeg') }}" alt="{{ Auth::user()->user_name }}" height="120">
                            @endif
                            <div class="card-img-overlay rounded-circle">
                                <div class="card-img-inner">
                                    <i class="fas fa-camera h4 mb-0"></i>
                                </div>
                            </div>
                            <input class="input-img input-avatar-img rounded-circle" type="file" name="avatar_img">
                        </div>
                    </div>
                    <div class="col">
                        <div class="row">
                            <h4 class="user-name text-dark font-weight-bold">{{ Auth::user()->user_name }}</h4>
                            <input type="text" class="input-user-name form-control mb-2 @error('user_name') is-invalid @enderror" name="user_name" placeholder="ユーザー名" value="{{ Auth::user()->user_name }}">
                            <button class="btn btn-profile-setting page-link text-secondary font-weight-bold rounded-pill ml-auto my-auto" type="button">プロフィールを編集</button>
                        </div>
                        <div class="row">
                            <p class="introduction text-dark">{{ Auth::user()->introduction }}</p>
                            <textarea type="text" class="input-introduction form-control mb-2 @error('introduction') is-invalid @enderror" name="introduction" placeholder="紹介文" rows="4">{{ Auth::user()->introduction }}</textarea>
                        </div>
                        <div class="row row-site-url">
                            <input type="text" class="input-site-url form-control @error('site_url') is-invalid @enderror" name="site_url" placeholder="サイトURL" value="{{ Auth::user()->site_url }}">
                        </div>
                        <nav class="row navbar user-info-nav p-0">
                            <div class="navbar-nav flex-row">
                                <li class="nav-item text-center pr-4">
                                    <a class="nav-link py-0" href="#">
                                        <span class="text-dark font-weight-bold small d-inline-block mb-1">投稿数</span><br>
                                        <span class="text-dark font-weight-bold h5">{{ $goodsModel->getTotalPostCount(Auth::id()) }}</span>
                                    </a>
                                </li>
                                <li class="nav-item text-center pr-4">
                                    <a class="nav-link py-0" href="#">
                                        <span class="text-dark font-weight-bold small d-inline-block mb-1">フォロー</span><br>
                                        <span class="text-dark font-weight-bold h5">0</span>
                                    </a>
                                </li>
                                <li class="nav-item text-center pr-4">
                                    <a class="nav-link py-0" href="#">
                                        <span class="text-dark font-weight-bold small d-inline-block mb-1">フォロワー</span><br>
                                        <span class="text-dark font-weight-bold h5">0</span>
                                    </a>
                                </li>
                                <li class="nav-item text-center pr-4">
                                    <a class="nav-link py-0" href="#">
                                        <span class="text-dark font-weight-bold small d-inline-block mb-1">いいね</span><br>
                                        <span class="text-dark font-weight-bold h5">{{ $like->getTotalLikeCount(Auth::id()) }}</span>
                                    </a>
                                </li>
                                @if(Auth::user()->site_url)
                                <li class="nav-item text-center">
                                    <a class="nav-link btn" href="{{ Auth::user()->site_url }}" target="_blank">
                                        <span class="text-secondary font-weight-bold h4"><i class="fas fa-home"></i></span>
                                    </a>
                                </li>
                                @endif
                            </div>
                        </nav>
                    </div>
                </div>
                <div class="row-profile-edit row pb-4">
                    <div class="d-flex justify-content-end">
                        <button class="btn btn-cancel page-link text-secondary font-weight-bold rounded-pill mr-1" type="button">キャンセル</button>
                        <button class="btn btn-save btn btn-primary font-weight-bold rounded-pill" type="submit">保存</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- Twitter風 -->
        <!-- <div class="container-fluid bg-white px-0 border-bottom">
            <div class="col-xl-7 mx-auto">
                <nav class="row navbar user-info-nav p-0">
                    <div class="navbar-nav flex-row">
                        <li class="nav-item text-center pr-4">
                            <a class="nav-link py-0" href="#">
                                <span class="text-dark font-weight-bold small d-inline-block mb-1">投稿数</span><br>
                                <span class="text-dark font-weight-bold h5">{{ $goodsModel->getTotalPostCount(Auth::id()) }}</span>
                            </a>
                        </li>
                        <li class="nav-item text-center pr-4">
                            <a class="nav-link py-0" href="#">
                                <span class="text-dark font-weight-bold small d-inline-block mb-1">フォロー</span><br>
                                <span class="text-dark font-weight-bold h5">0</span>
                            </a>
                        </li>
                        <li class="nav-item text-center pr-4">
                            <a class="nav-link py-0" href="#">
                                <span class="text-dark font-weight-bold small d-inline-block mb-1">フォロワー</span><br>
                                <span class="text-dark font-weight-bold h5">0</span>
                            </a>
                        </li>
                        <li class="nav-item text-center pr-4">
                            <a class="nav-link py-0" href="#">
                                <span class="text-dark font-weight-bold small d-inline-block mb-1">いいね</span><br>
                                <span class="text-dark font-weight-bold h5">{{ $like->getTotalLikeCount(Auth::id()) }}</span>
                            </a>
                        </li>
                        @if(Auth::user()->site_url)
                        <li class="nav-item text-center">
                            <a class="nav-link btn" href="{{ Auth::user()->site_url }}" target="_blank">
                                <span class="text-secondary font-weight-bold h4"><i class="fas fa-home"></i></span>
                            </a>
                        </li>
                        @endif
                    </div>
                </nav>
            </div>
        </div> -->
    </form>
</header>
@endsection
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