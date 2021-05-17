@extends('layouts.app')
@section('title','MYShop')
@section('content')
    <product-detail :product-id="{{ $productId }}" ></product-detail>
@endsection
