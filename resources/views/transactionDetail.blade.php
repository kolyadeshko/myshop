@extends('layouts.app')
@section('title','Заказ № ' . $transaction -> id)
@section('content')
<transaction-detail transaction-id="{{$transaction->id}}" trans-status-id="{{$transaction->transaction_status_id}}"></transaction-detail>
@endsection
