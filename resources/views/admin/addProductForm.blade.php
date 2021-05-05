@extends('layouts.app')
@section('title','Добавление продукта')
@section('content')
<div class="container">
    <h1 class="title1">
        Добавление продукта
    </h1>
    <div class="body">
        <form
            action=""
            method="post"
            enctype="multipart/form-data"
        >
            @csrf
            <form-input
                :name="'type_id'"
                :title="'Тип продукта'"
            >
            </form-input>
            <form-input
                :name="'name'"
                :title="'Название продукта'"
            >
            </form-input>
            <form-input
                :name="'price'"
                :title="'Цена продукта'"
            >
            </form-input>
            <form-input
                :name="'discount_price'"
                :title="'Скидочная цена(необязательно)'"
            >
            </form-input>
            <form-input
                :name="'img'"
                :title="'Фотография'"
                :type="'file'"
            >
            </form-input>
            <input type="submit" class="button">
        </form>
    </div>
</div>
@endsection
