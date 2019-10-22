@extends('layouts/app')
@inject('post_model','App\Post')
@inject('like','App\Like')
@section('title', 'レビュー編集 | ')
@section('content')
@include('layouts/form', ['target' => 'update'])
@endsection