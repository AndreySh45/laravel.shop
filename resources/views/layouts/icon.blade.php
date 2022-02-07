<!-- Products -->

<div class="products">
    <div class="container">
        <div class="row">
            <div class="col text-center">
                <div class="products_title">@lang('main.pop_products')</div>
            </div>
        </div>
        <div class="row">
            <div class="col">

                <div class="product_grid">
                    @foreach ($bestSkus as $bestSku)
                    <!-- Product -->
                    <div class="product">
                        <div class="product_image"><img src="{{ $bestSku->product->getImage()}}" alt=""></div>
                        @if($bestSku->product->isNew())
                            <div class="product_extra product_new"><a href="{{route('showCategory', $bestSku->product->category['title'])}}">@lang('main.properties.new')</a></div>
                        @endif
                        @if($bestSku->product->isRecommend())
                            <div class="product_extra product_hot"><a href="{{route('showCategory', $bestSku->product->category['title'])}}">@lang('main.properties.recommend')</a></div>
                        @endif
                        @if($bestSku->product->isHit())
                            <div class="product_extra product_sale"><a href="{{route('showCategory', $bestSku->product->category['title'])}}">@lang('main.properties.hit')</a></div>
                        @endif
                        <div class="product_content">
                            <div class="product_title"><a href="{{ route('sku', [$bestSku->product->category->slug, $bestSku->product->id, $bestSku->id]) }}">{{$bestSku->product->__('title')}}</a></div>
                            <div class="product_price">{{ $currencySymbol }}{{$bestSku->price}}</div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>


<!-- Icon Boxes -->

<div class="icon_boxes">
    <div class="container">
        <div class="row icon_box_row">

            <!-- Icon Box -->
            <div class="col-lg-4 icon_box_col">
                <div class="icon_box">
                    <div class="icon_box_image"><img src="{{asset('front/images/icon_1.svg')}}" alt=""></div>
                    <div class="icon_box_title">Free Shipping Worldwide</div>
                    <div class="icon_box_text">
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam a ultricies metus. Sed nec molestie.</p>
                    </div>
                </div>
            </div>

            <!-- Icon Box -->
            <div class="col-lg-4 icon_box_col">
                <div class="icon_box">
                    <div class="icon_box_image"><img src="{{asset('front/images/icon_2.svg')}}" alt=""></div>
                    <div class="icon_box_title">Free Returns</div>
                    <div class="icon_box_text">
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam a ultricies metus. Sed nec molestie.</p>
                    </div>
                </div>
            </div>

            <!-- Icon Box -->
            <div class="col-lg-4 icon_box_col">
                <div class="icon_box">
                    <div class="icon_box_image"><img src="{{asset('front/images/icon_3.svg')}}" alt=""></div>
                    <div class="icon_box_title">24h Fast Support</div>
                    <div class="icon_box_text">
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam a ultricies metus. Sed nec molestie.</p>
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
