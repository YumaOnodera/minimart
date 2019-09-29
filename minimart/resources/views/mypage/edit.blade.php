@extends('layouts/app')
@inject('like','App\Like')
@section('content')
@include('layouts/form', ['target' => 'update'])
@endsection