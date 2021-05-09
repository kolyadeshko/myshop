@extends('layouts.app')
@section('title','MYShop')
@section('content')
    <div class="mp__container">
        <div class="mp__title title1">
            MYShop
        </div>
        <div class="mp__body">
            <div class="mp__products-block">
                <products-block
                    :type="'promotion-products'"
                    :title="'Акции'"
                >
                </products-block>
            </div>
            <div class="mp__products-block">
                <products-block
                    :type="'1'"
                    :title="'Фрукты и овощи'"
                >
                </products-block>
            </div>
            <div class="mp__products-block">
                <products-block
                    :type="'2'"
                    :title="'Мясо-колбасные изделия'"
                >
                </products-block>
            </div>
            <div class="mp__products-block">
                <products-block
                    :type="'3'"
                    :title="'Напитки'"
                >
                </products-block>
            </div>
            <div class="mp__products-block">
                <products-block
                    :type="'4'"
                    :title="'Молочные продукты'"
                >
                </products-block>
            </div>
        </div>
    </div>
@endsection
