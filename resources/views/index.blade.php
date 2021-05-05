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
                >
                </products-block>
            </div>
            <div class="mp__products-block">
                <products-block
                    :type="'1'"
                >
                </products-block>
            </div>
            <div class="mp__products-block">
                <products-block
                    :type="'2'"
                >
                </products-block>
            </div>
            <div class="mp__products-block">
                <products-block
                    :type="'3'"
                >
                </products-block>
            </div>
            <div class="mp__products-block">
                <products-block
                    :type="'4'"
                >
                </products-block>
            </div>
        </div>
    </div>
@endsection
