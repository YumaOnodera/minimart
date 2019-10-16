@extends('layouts/app')
@inject('like','App\Like')
@section('title', 'レビュー編集 | ')
@section('content')
@include('layouts/form', ['target' => 'update'])
@endsection