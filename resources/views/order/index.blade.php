@extends('layouts.main')
@section('title', __('cart.ordering'))
@section('custom_css')
    <link rel="stylesheet" type="text/css" href="/styles/checkout.css">
    <link rel="stylesheet" type="text/css" href="/styles/checkout_responsive.css">
@endsection
@section('custom_js')
    <script src="/js/checkout.js"></script>
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
                                    <li><a href="{{route('cartIndex')}}">@lang('cart.breadcrumbs_cart')</a></li>
                                    <li>@lang('cart.ordering')</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Checkout -->

<div class="checkout">
    <div class="container">

        <form action="{{ route('cartConfirm') }}" method="POST" id="checkout_form" class="checkout_form">
        @csrf
        <div class="row">
            <!-- Billing Info -->
            <div class="col-lg-6">
                <div class="billing checkout_section">
                    <div class="section_title">Billing Address</div>
                    <div class="section_subtitle">Enter your address info</div>
                    <div class="checkout_form_container">
                            <div class="row">
                                <div class="col-xl-6">
                                    <!-- Name -->
                                    <label for="name">Name:</label>
                                    <input type="text" name="name" id="name" value="" class="checkout_input">
                                </div>
                            </div>
                            <div>
                                <!-- Country -->
                                <label for="checkout_country">Country*</label>
                                <select name="checkout_country" id="checkout_country" class="dropdown_item_select checkout_input">
                                    <option></option>
                                    <option>Lithuania</option>
                                    <option>Sweden</option>
                                    <option>UK</option>
                                    <option>Italy</option>
                                </select>
                            </div>
                            <div>
                                <!-- Address -->
                                <label for="checkout_address">Address*</label>
                                <input type="text" id="checkout_address" class="checkout_input">
                            </div>
                            <div>
                                <!-- Zipcode -->
                                <label for="checkout_zipcode">Zipcode*</label>
                                <input type="text" id="checkout_zipcode" class="checkout_input">
                            </div>
                            <div>
                                <!-- City / Town -->
                                <label for="checkout_city">City/Town*</label>
                                <select name="checkout_city" id="checkout_city" class="dropdown_item_select checkout_input">
                                    <option></option>
                                    <option>City</option>
                                    <option>City</option>
                                    <option>City</option>
                                    <option>City</option>
                                </select>
                            </div>
                            <div>
                                <!-- Province -->
                                <label for="checkout_province">Province*</label>
                                <select name="checkout_province" id="checkout_province" class="dropdown_item_select checkout_input">
                                    <option></option>
                                    <option>Province</option>
                                    <option>Province</option>
                                    <option>Province</option>
                                    <option>Province</option>
                                </select>
                            </div>
                            <div>
                                <!-- Phone no -->
                                <label for="phone">Phone:</label>
                                <input type="phone" name="phone" id="phone" value="" class="checkout_input">
                            </div>
                            <div>
                                <!-- Email -->
                                <label for="checkout_email">Email Address*</label>
                                <input type="phone" name="email" id="checkout_email" class="checkout_input">
                            </div>
                            <div class="checkout_extra">
                                <div>
                                    <input type="checkbox" id="checkbox_terms" name="regular_checkbox" class="regular_checkbox" checked="checked">
                                    <label for="checkbox_terms"><img src="images/check.png" alt=""></label>
                                    <span class="checkbox_title">Terms and conditions</span>
                                </div>
                                <div>
                                    <input type="checkbox" id="checkbox_account" name="regular_checkbox" class="regular_checkbox">
                                    <label for="checkbox_account"><img src="images/check.png" alt=""></label>
                                    <span class="checkbox_title">Create an account</span>
                                </div>
                                <div>
                                    <input type="checkbox" id="checkbox_newsletter" name="regular_checkbox" class="regular_checkbox">
                                    <label for="checkbox_newsletter"><img src="images/check.png" alt=""></label>
                                    <span class="checkbox_title">Subscribe to our newsletter</span>
                                </div>
                            </div>
                    </div>
                </div>
            </div>

            <!-- Order Info -->

            <div class="col-lg-6">
                <div class="order checkout_section">
                    <div class="section_title">Your order</div>
                    <div class="section_subtitle">Order details</div>

                    <!-- Order details -->
                    <div class="order_list_container">
                        <div class="order_list_bar d-flex flex-row align-items-center justify-content-start">
                            <div class="order_list_title">Product</div>
                            <div class="order_list_value ml-auto">Total</div>
                        </div>
                        <ul class="order_list">
                            <li class="d-flex flex-row align-items-center justify-content-start">
                                <div class="order_list_title">Cocktail Yellow dress</div>
                                <div class="order_list_value ml-auto">$59.90</div>
                            </li>
                            <li class="d-flex flex-row align-items-center justify-content-start">
                                <div class="order_list_title">Subtotal</div>
                                <div class="order_list_value ml-auto">{{ $order->sum }} {{ $order->currency->symbol }}.</div>
                            </li>
                            <li class="d-flex flex-row align-items-center justify-content-start">
                                <div class="order_list_title">Shipping</div>
                                <div class="order_list_value ml-auto">Free</div>
                            </li>
                            <li class="d-flex flex-row align-items-center justify-content-start">
                                <div class="order_list_title">Total</div>
                                <div class="order_list_value ml-auto">$59.90</div>
                            </li>
                        </ul>
                    </div>

                    <!-- Payment Options -->
                    <div class="payment">
                        <div class="payment_options">
                            <label class="payment_option clearfix">Paypal
                                <input type="radio" name="radio">
                                <span class="checkmark"></span>
                            </label>
                            <label class="payment_option clearfix">Cach on delivery
                                <input type="radio" name="radio">
                                <span class="checkmark"></span>
                            </label>
                            <label class="payment_option clearfix">Credit card
                                <input type="radio" name="radio">
                                <span class="checkmark"></span>
                            </label>
                            <label class="payment_option clearfix">Direct bank transfer
                                <input type="radio" checked="checked" name="radio">
                                <span class="checkmark"></span>
                            </label>
                        </div>
                    </div>

                    <!-- Order Text -->
                    <div class="order_text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin pharetra temp or so dales. Phasellus sagittis auctor gravida. Integ er bibendum sodales arcu id te mpus. Ut consectetur lacus.</div>
                    {{-- <div class="button order_button"><a href="#">Place Order</a></div> --}}

                    <button type="submit" class="newsletter_button trans_200"><span>Place Order</span></button>
                </div>
            </div>
        </div>
        </form>
    </div>
</div>
@endsection
