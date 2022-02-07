@extends('layouts.main')
@section('title', __('main.title'))


@section('content')
<!-- Home -->

<div class="home">
    <div class="home_slider_container">

        <!-- Home Slider -->
        <div class="owl-carousel owl-theme home_slider">

            <!-- Slider Item -->
            <div class="owl-item home_slider_item">
                <div class="home_slider_background" style="background-image:url(images/home_slider_1.jpg)"></div>
                <div class="home_slider_content_container">
                    <div class="container">
                        <div class="row">
                            <div class="col">
                                <div class="home_slider_content"  data-animation-in="fadeIn" data-animation-out="animate-out fadeOut">
                                    <div class="home_slider_title">A new Online Shop experience.</div>
                                    <div class="home_slider_subtitle">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam a ultricies metus. Sed nec molestie eros. Sed viverra velit venenatis fermentum luctus.</div>
                                    <div class="button button_light home_button"><a href="#">Shop Now</a></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Slider Item -->
            <div class="owl-item home_slider_item">
                <div class="home_slider_background" style="background-image:url(images/home_slider_1.jpg)"></div>
                <div class="home_slider_content_container">
                    <div class="container">
                        <div class="row">
                            <div class="col">
                                <div class="home_slider_content"  data-animation-in="fadeIn" data-animation-out="animate-out fadeOut">
                                    <div class="home_slider_title">A new Online Shop experience.</div>
                                    <div class="home_slider_subtitle">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam a ultricies metus. Sed nec molestie eros. Sed viverra velit venenatis fermentum luctus.</div>
                                    <div class="button button_light home_button"><a href="#">Shop Now</a></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Slider Item -->
            <div class="owl-item home_slider_item">
                <div class="home_slider_background" style="background-image:url(images/home_slider_1.jpg)"></div>
                <div class="home_slider_content_container">
                    <div class="container">
                        <div class="row">
                            <div class="col">
                                <div class="home_slider_content"  data-animation-in="fadeIn" data-animation-out="animate-out fadeOut">
                                    <div class="home_slider_title">A new Online Shop experience.</div>
                                    <div class="home_slider_subtitle">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam a ultricies metus. Sed nec molestie eros. Sed viverra velit venenatis fermentum luctus.</div>
                                    <div class="button button_light home_button"><a href="#">Shop Now</a></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <!-- Home Slider Dots -->

        <div class="home_slider_dots_container">
            <div class="container">
                <div class="row">
                    <div class="col">
                        <div class="home_slider_dots">
                            <ul id="home_slider_custom_dots" class="home_slider_custom_dots">
                                <li class="home_slider_custom_dot active">01.</li>
                                <li class="home_slider_custom_dot">02.</li>
                                <li class="home_slider_custom_dot">03.</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

<!-- Ads -->

<div class="avds">
    <div class="avds_container d-flex flex-lg-row flex-column align-items-start justify-content-between">
        <div class="avds_small">
            <div class="avds_background" style="background-image:url(front/images/avds_small.jpg)"></div>
            <div class="avds_small_inner">
                <div class="avds_discount_container">
                    <img src="{{asset('front/images/discount.png')}}" alt="">
                    <div>
                        <div class="avds_discount">
                            <div>40<span>%</span></div>
                            <div>Discount</div>
                        </div>
                    </div>
                </div>
                <div class="avds_small_content">
                    <div class="avds_title">Smart Phones</div>
                    <div class="avds_link"><a href="categories.html">See More</a></div>
                </div>
            </div>
        </div>
        <div class="avds_large">
            <div class="avds_background" style="background-image:url(front/images/avds_large.jpg)"></div>
            <div class="avds_large_container">
                <div class="avds_large_content">
                    <div class="avds_title">Professional Cameras</div>
                    <div class="avds_text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam a ultricies metus. Sed nec molestie eros. Sed viver ra velit venenatis fermentum luctus.</div>
                    <div class="avds_link avds_link_large"><a href="categories.html">See More</a></div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container mt-3">
<form method="GET" action="{{route("index")}}">
    <div class="filters row">
        <div class="col-sm-6 col-md-3">
            <label for="price_from">@lang('main.price_from')
                <input type="text" name="price_from" id="price_from" size="6" value="{{ request()->price_from}}">
            </label>
            <label for="price_to">@lang('main.to')
                <input type="text" name="price_to" id="price_to" size="6"  value="{{ request()->price_to }}">
            </label>
        </div>
        <div class="col-sm-2 col-md-2">
            <label for="hit">
                <input type="checkbox" name="hit" id="hit" @if(request()->has('hit')) checked @endif> @lang('main.properties.hit')
            </label>
        </div>
        <div class="col-sm-2 col-md-2">
            <label for="new">
                <input type="checkbox" name="new" id="new" @if(request()->has('new')) checked @endif> @lang('main.properties.new')
            </label>
        </div>
        <div class="col-sm-2 col-md-2">
            <label for="recommend">
                <input type="checkbox" name="recommend" id="recommend" @if(request()->has('recommend')) checked @endif> @lang('main.properties.recommend')
            </label>
        </div>
        <div class="col-sm-6 col-md-3">
            <button type="submit" class="btn btn-primary">@lang('main.filter')</button>
            <a href="{{ route("index") }}" class="btn btn-warning">@lang('main.reset')</a>
        </div>
    </div>
</form>
</div>
<!-- Products -->

<div class="products">
    <div class="container">
        <div class="row">
            <div class="col">

                <div class="product_grid">
                    @foreach ($skus as  $sku)
                            <!-- Product -->

                            <div class="product">
                                <div class="product_image"><img src="{{ $sku->product->getImage()}}" alt="{{$sku->product->title}}"></div>
                                <div class="product_extra">
                                    @if($sku->product->isNew())
                                        <div class="product_new"><a href="{{route('showCategory', $sku->product->category['title'])}}">@lang('main.properties.new')</a></div>
                                    @endif
                                    @if($sku->product->isRecommend())
                                        <div class="product_hot"><a href="{{route('showCategory', $sku->product->category['title'])}}">@lang('main.properties.recommend')</a></div>
                                    @endif
                                    @if($sku->product->isHit())
                                        <div class="product_sale"><a href="{{route('showCategory', $sku->product->category['title'])}}">@lang('main.properties.hit')</a></div>
                                    @endif
                                </div>
                                <div class="product_content">
                                    <div class="product_title"><a href="{{ route('sku', [$sku->product->category->slug, $sku->product->id, $sku->id]) }}">{{$sku->product->__('title')}}</a></div>
                                    @isset($sku->product->properties)
                                        @foreach ($sku->propertyOptions as $propertyOption)
                                            <h4>{{ $propertyOption->property->__('name') }}: {{ $propertyOption->__('name') }}</h4>
                                        @endforeach
                                    @endisset
                                    @if($sku->product->new_price != null)
                                        <div style="text-decoration: line-through">{{ $currencySymbol }}{{$sku->price}}</div>
                                        <div class="product_price">{{ $currencySymbol }}{{$sku->product->new_price}}</div>  {{-- $sku->new_price --}}
                                    @else
                                        <div class="product_price">{{ $currencySymbol }}{{$sku->price}}</div>
                                    @endif
                                </div>
                                <form action="{{ route('cartAdd', $sku) }}" method="POST">
                                    @csrf
                                    @if($sku->isAvailable())
                                        <button type="submit" class="newsletter_button trans_200"><span>@lang('main.add_to_basket')</span></button>
                                    @else
                                        @lang('main.not_available')
                                    @endif
                                </form>
                            </div>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="col-md-12 mb-3">
            {{ $skus->links() }}
        </div>
    </div>
</div>

<!-- Ad -->

<div class="avds_xl">
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="avds_xl_container clearfix">
                    <div class="avds_xl_background" style="background-image:url(front/images/avds_xl.jpg)"></div>
                    <div class="avds_xl_content">
                        <div class="avds_title">Amazing Devices</div>
                        <div class="avds_text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam a ultricies metus.</div>
                        <div class="avds_link avds_xl_link"><a href="categories.html">See More</a></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@include('layouts.icon')
@endsection
