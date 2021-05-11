@extends('layouts.app')
@section('title','Акционные товары')
@section('content')
    <products :product-type="{ id : 0 , name : 'Акционные товары'}"></products>
@endsection
