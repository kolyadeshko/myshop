@extends('layouts.app')
@section('title',$type->name)
@section('content')
    <products :product-type="{{ json_encode($type) }}" />
@endsection
