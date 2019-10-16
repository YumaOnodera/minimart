@extends('layouts/app')
@inject('like','App\Like')
@section('title', $goods->goods_name . ' | ')
@section('content')
@include('layouts/show')
@endsection