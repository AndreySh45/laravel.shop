@extends('layouts.main')
@section('title', __('main.product'))
@section('custom_css')
    <link rel="stylesheet" type="text/css" href="/styles/product.css">
    <link rel="stylesheet" type="text/css" href="/styles/product_responsive.css">
@endsection
@section('custom_js')
    <script src="/js/product.js"></script>

@endsection

@section('content')
<!-- Home -->

<div class="home">
    <div class="home_container">
        <div class="home_background" style="background-image:url('/uploads/{{$sku->product->category->img}}')"></div>
        <div class="home_content_container">
            <div class="container">
                <div class="row">
                    <div class="col">
                        <div class="home_content">
                            <div class="home_title">{{$sku->product->category->__('title')}}<span>.</span></div>
                            <div class="home_text"><p>{{$sku->product->category->__('desc')}}</p></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Product Details -->

<div class="product_details">
    <div class="container">
        <div class="row details_row">

            <!-- Product Image -->
            <div class="col-lg-6">
                <div class="details_image">

                    <div class="details_image_large"><img src="{{ $sku->product->getImage()}}" alt=""></div>
                    <div class="details_image_thumbnails d-flex flex-row align-items-start justify-content-between">
                        @if($sku->product->getImage() == 'no_image.png')

                        @else
                            @foreach($sku->product->images as $img)
                                @if($loop->first)
                                    <div class="details_image_thumbnail active" data-image="{{$img['img']}}"><img src="{{$img['img']}}" alt="{{$sku->product->title}}"></div>
                                @else
                                    <div class="details_image_thumbnail" data-image="{{$img['img']}}"><img src="{{$img['img']}}" alt="{{$sku->product->title}}"></div>
                                @endif
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>

            <!-- Product Content -->
            <div class="col-lg-6">
                <div class="details_content">
                    <div class="details_name" data-id="{{$sku->product->id}}">{{$sku->product->__('title')}}</div>
                    @if($sku->new_price != null)
                        <div class="details_discount">{{ $currencySymbol }}{{$sku->price}}</div>
                        <div class="details_price">{{ $currencySymbol }}{{$sku->new_price}}</div>
                    @else
                        <div class="product_price">{{ $currencySymbol }}{{$sku->price}}</div>
                    @endif
                    <!-- Labels -->
                    <div class="in_stock_container">
                        <div class="availability">Labels:</div>
                        @if($sku->product->isNew())
                            <span style="color: #4519f5">@lang('main.properties.new')</span>
                        @endif
                        @if($sku->product->isRecommend())
                            <span style="color: #e0cb0b">@lang('main.properties.recommend')</span>
                        @endif
                        @if($sku->product->isHit())
                            <span style="color: #e95a5a">@lang('main.properties.hit')</span>
                        @endif
                    </div>
                    @isset($sku->product->properties)
                        @foreach ($sku->propertyOptions as $propertyOption)
                            <h4>{{ $propertyOption->property->__('name') }}: {{ $propertyOption->__('name') }}</h4>
                        @endforeach
                    @endisset
                    <div class="details_text">
                        <p>{!!$sku->product->__('description')!!}</p>
                    </div>

                    @if($sku->isAvailable())
                        <form action="{{ route('cartAdd', $sku) }}" method="POST">
                            @csrf
                            <button type="submit" class="newsletter_button trans_200"><span>@lang('product.add_to_cart')</span></button>
                        </form>
                    @else
                        <div class="product_quantity_container">
                            <span style="color: #cc0000">@lang('main.not_available')</span>
                            <br>
                            <span style="color: #4519f5">@lang('product.tell_me')</span>
                            <form method="POST" action="{{ route('subscription', $sku) }}">
                                @csrf
                                <input type="email" class="contact_email" name="email" placeholder="Email">
                                <button type="submit" class="newsletter_button trans_200"><span>@lang('product.subscribe')</span></button>
                            </form>
                        </div>
                    @endif


                    <!-- Share -->
                    <div class="details_share">
                        <span>Share:</span>
                        <ul>
                            <li><a href="#"><i class="fa fa-pinterest" aria-hidden="true"></i></a></li>
                            <li><a href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
                            <li><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                            <li><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="row description_row">
            <div class="col">
                <div class="description_title_container">
                    <div class="description_title">Description</div>
                    <div class="reviews_title"><a href="#">Reviews <span>(1)</span></a></div>
                </div>
                <div class="description_text">
                    <p>{!!$sku->product->__('description')!!}</p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Products -->

<div class="products">
    <div class="container">
        <div class="row">
            <div class="col text-center">
                <div class="products_title">Related Products</div>
            </div>
        </div>
        <div class="row">
            <div class="col">

                <div class="product_grid">

                    <!-- Product -->
                    <div class="product">
                        <div class="product_image"><img src="/images/product_1.jpg" alt=""></div>
                        <div class="product_extra product_new"><a href="categories.html">New</a></div>
                        <div class="product_content">
                            <div class="product_title"><a href="product.html">Smart Phone</a></div>
                            <div class="product_price">$670</div>
                        </div>
                    </div>

                    <!-- Product -->
                    <div class="product">
                        <div class="product_image"><img src="/images/product_2.jpg" alt=""></div>
                        <div class="product_extra product_sale"><a href="categories.html">Sale</a></div>
                        <div class="product_content">
                            <div class="product_title"><a href="product.html">Smart Phone</a></div>
                            <div class="product_price">$520</div>
                        </div>
                    </div>

                    <!-- Product -->
                    <div class="product">
                        <div class="product_image"><img src="/images/product_3.jpg" alt=""></div>
                        <div class="product_content">
                            <div class="product_title"><a href="product.html">Smart Phone</a></div>
                            <div class="product_price">$710</div>
                        </div>
                    </div>

                    <!-- Product -->
                    <div class="product">
                        <div class="product_image"><img src="/images/product_4.jpg" alt=""></div>
                        <div class="product_content">
                            <div class="product_title"><a href="product.html">Smart Phone</a></div>
                            <div class="product_price">$330</div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

<!-- Newsletter -->

<div class="newsletter">
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="newsletter_border"></div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-8 offset-lg-2">
                <div class="newsletter_content text-center">
                    <div class="newsletter_title">Subscribe to our newsletter</div>
                    <div class="newsletter_text"><p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam a ultricies metus. Sed nec molestie eros</p></div>
                    <div class="newsletter_form_container">
                        <form action="#" id="newsletter_form" class="newsletter_form">
                            <input type="email" class="newsletter_input" required="required">
                            <button class="newsletter_button trans_200"><span>Subscribe</span></button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
