@extends('layouts.main')
@section('title', __('cart.cart'))
@section('custom_css')
    <link rel="stylesheet" type="text/css" href="/styles/cart.css">
    <link rel="stylesheet" type="text/css" href="/styles/cart_responsive.css">
@endsection
@section('custom_js')
    <script src="/js/cart.js"></script>
@endsection

@section('content')
<!-- Home -->

<div class="home">
    <div class="home_container">
        <div class="home_background" style="background-image:url(/images/cart.jpg)"></div>
        <div class="home_content_container">
            <div class="container">
                <div class="row">
                    <div class="col">
                        <div class="home_content">
                            <div class="breadcrumbs">
                                <ul>
                                    <li><a href="{{route('index')}}">@lang('main.title')</a></li>
                                    <li>@lang('cart.breadcrumbs_cart')</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Cart Info -->

<div class="cart_info">
    <div class="container">
        <div class="row">
            <div class="col">
                <!-- Column Titles -->
                <div class="cart_info_columns clearfix">
                    <div class="cart_info_col cart_info_col_product">@lang('cart.name')</div>
                    <div class="cart_info_col cart_info_col_price">@lang('cart.price')</div>
                    <div class="cart_info_col cart_info_col_quantity">@lang('cart.count')</div>
                    <div class="cart_info_col cart_info_col_total">@lang('cart.cost')</div>
                </div>
            </div>
        </div>

        <div class="row cart_items_row">
            <div class="col">
                @foreach($order->skus as $sku)
                <!-- Cart Item -->
                <div class="cart_item d-flex flex-lg-row flex-column align-items-lg-center align-items-start justify-content-start">
                    <!-- Name -->
                    <div class="cart_item_product d-flex flex-row align-items-center justify-content-start">
                        <div class="cart_item_image">
                            <div><img src="{{ $sku->product->getImage()}}" alt=""></div>
                        </div>
                        <div class="cart_item_name_container">
                            <div class="cart_item_name"><a href="{{route('sku', [$sku->product->category->slug, $sku->product->id, $sku->id])}}">{{$sku->product->__('title')}}</a></div>
                            @auth
                            @if (Auth::user()->hasRole('admin'))
                            <div class="cart_item_edit"><a href="{{ route('skus.edit', [$sku->product, $sku]) }}">@lang('cart.edit')</a></div>
                            @endif
                            @endauth
                        </div>
                    </div>
                    <!-- Price -->
                    <div class="cart_item_price">{{$sku->price}} {{ $currencySymbol }}.</div>
                    <!-- Quantity -->
                    <div class="cart_item_quantity">
                        <div class="product_quantity_container">
                            <div class="product_quantity clearfix">
                                <span class="badge">{{$sku->countInOrder}}</span>
                                {{-- <input id="quantity_input" type="text" value="{{$product->count->count}}"> --}}
                                <div class="quantity_buttons">
                                    <form action="{{ route('cartRemove', $sku) }}" method="POST">
                                        <button type="submit" id="quantity_inc_button" class="quantity_inc quantity_control"><i class="fa fa-minus" aria-hidden="true"></i></button>
                                        @csrf
                                    </form>
                                    <form action="{{ route('cartAdd', $sku) }}" method="POST">
                                        <button type="submit" id="quantity_dec_button" class="quantity_dec quantity_control"><i class="fa fa-plus" aria-hidden="true"></i></button>
                                        @csrf
                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Total -->
                    <div class="cart_item_total">{{ $sku->price * $sku->countInOrder }} {{ $currencySymbol }}.</div>
                </div>
                @endforeach
            </div>
        </div>

        <div class="row row_cart_buttons">
            <div class="col">
                <div class="cart_buttons d-flex flex-lg-row flex-column align-items-start justify-content-start">
                    <div class="button continue_shopping_button"><a href="#">Continue shopping</a></div>
                    <div class="cart_buttons_right ml-lg-auto">
                        <div class="button clear_cart_button"><a href="#">Clear cart</a></div>
                        <div class="button update_cart_button"><a href="#">Update cart</a></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row row_extra">
            <div class="col-lg-4">

                <!-- Delivery -->
                <div class="delivery">
                    <div class="section_title">Shipping method</div>
                    <div class="section_subtitle">Select the one you want</div>
                    <div class="delivery_options">
                        <label class="delivery_option clearfix">Next day delivery
                            <input type="radio" name="radio">
                            <span class="checkmark"></span>
                            <span class="delivery_price">$4.99</span>
                        </label>
                        <label class="delivery_option clearfix">Standard delivery
                            <input type="radio" name="radio">
                            <span class="checkmark"></span>
                            <span class="delivery_price">$1.99</span>
                        </label>
                        <label class="delivery_option clearfix">Personal pickup
                            <input type="radio" checked="checked" name="radio">
                            <span class="checkmark"></span>
                            <span class="delivery_price">Free</span>
                        </label>
                    </div>
                </div>
                @if(!$order->hasCoupon())
                    <!-- Coupon Code -->
                    <div class="coupon">
                        <div class="section_title">Coupon code</div>
                        <div class="section_subtitle">Добавить купон:</div>
                        <div class="coupon_form_container">
                            <form method="POST" action="{{ route('set-coupon') }}" id="coupon_form" class="coupon_form">
                                @csrf
                                <input type="text" name="coupon" class="coupon_input" required="required">
                                <button class="button coupon_button"><span>Применить</span></button>
                            </form>
                        </div>
                    </div>
                    @error('coupon')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                @else
                    <div class="coupon">
                        <div class="section_title">Вы используете купон</div>
                        <div class="section_subtitle">{{ $order->coupon->code }}</div>
                    </div>
                @endif
            </div>

            <div class="col-lg-6 offset-lg-2">
                <div class="cart_total">
                    <div class="section_title">@lang('cart.total')</div>
                    <div class="section_subtitle">Final info</div>
                    <div class="cart_total_container">
                        <ul>
                            <li class="d-flex flex-row align-items-center justify-content-start">
                                <div class="cart_total_title">@lang('cart.subtotal')</div>
                                @if($order->hasCoupon())
                                    <div class="cart_total_value ml-auto"> <strike>{{ $order->getFullSum(false) }}</strike> {{ $order->getFullSum() }} {{ $currencySymbol }} </div>

                                @else
                                    <div class="cart_total_value ml-auto">{{ $order->getFullSum() }} {{ $currencySymbol }}.</div>
                                @endif

                            </li>
                            <li class="d-flex flex-row align-items-center justify-content-start">
                                <div class="cart_total_title">@lang('cart.shipping')</div>
                                <div class="cart_total_value ml-auto">@lang('cart.free')</div>
                            </li>
                            <li class="d-flex flex-row align-items-center justify-content-start">
                                <div class="cart_total_title">Total</div>
                                <div class="cart_total_value ml-auto">{{ $order->getFullSum() }} {{ $currencySymbol }}</div>
                            </li>
                        </ul>
                    </div>
                    <div class="button checkout_button"><a href="{{ route('cartPlace')}}">@lang('cart.place_order')</a></div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
