@extends('layouts.main')
@section('title', $cat->__('title'))
@section('custom_css')
    <link rel="stylesheet" type="text/css" href="/styles/categories.css">
    <link rel="stylesheet" type="text/css" href="/styles/categories_responsive.css">
@endsection
@section('custom_js')
    {{-- <script src="js/categories.js"></script> --}}
    <script>
        $(document).ready(function(){
            $('.product_sorting_btn').click(function(){
                let orderBy = $(this).data('order')
                $('.sorting_text').text($(this).find('span').text())
                $.ajax({
                    url: "{{route('showCategory', $cat->slug)}}",
                    type: "GET",
                    data: {
                        orderBy: orderBy,
                        page: {{isset($_GET['page']) ? $_GET['page'] : 1}},
                    },
                    header: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: (data) => {
                        let positionParameters = location.pathname.indexOf('?');
                        let url = location.pathname.substring(positionParameters,location.pathname.length);
                        let newURL = url + '?'; // http://127.0.0.1:8001/phones?
                        newURL += 'orderBy=' + orderBy + "&page={{isset($_GET['page']) ? $_GET['page'] : 1}}"; // http://127.0.0.1:8001/phones?orderBy=name-z-a
                        history.pushState({}, '', newURL);

                        $('.product_pagination a').each(function(index, value){
                            let link= $(this).attr('href')
                            $(this).attr('href',link+'&orderBy='+orderBy)
                        })

                        $('.product_grid').html(data)
                        $('.product_grid').isotope('destroy')
                        $('.product_grid').imagesLoaded( function() {
                            let grid = $('.product_grid').isotope({
                                itemSelector: '.product',
                                layoutMode: 'fitRows',
                                fitRows:
                                    {
                                        gutter: 30
                                    }
                            });
                        });
                    }
                })
            })
        })
    </script>
@endsection



@section('content')
    <!-- Home -->

	<div class="home">
		<div class="home_container">
			<div class="home_background" style="background-image:url('/uploads/{{$cat->img}}')"></div>
			<div class="home_content_container">
				<div class="container">
					<div class="row">
						<div class="col">
							<div class="home_content">
								<div class="home_title">{{$cat->__('title')}}<span>.</span></div>
								<div class="home_text"><p>{{$cat->__('desc')}}</p></div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- Products -->

	<div class="products">
		<div class="container">
			<div class="row">
				<div class="col">

					<!-- Product Sorting -->
					<div class="sorting_bar d-flex flex-md-row flex-column align-items-md-center justify-content-md-start">
						<div class="results">Showing <span>{{$cat->products->map->skus->count()}}</span> results</div>
						<div class="sorting_container ml-md-auto">
							<div class="sorting">
								<ul class="item_sorting">
									<li>
										<span class="sorting_text">Sort by</span>
										<i class="fa fa-chevron-down" aria-hidden="true"></i>
										<ul>
											<li class="product_sorting_btn" data-order="default"><span>Default</span></li>
                                            <li class="product_sorting_btn" data-order="price-low-high"><span>Price: Low-High</span></li>
                                            <li class="product_sorting_btn" data-order="price-high-low"><span>Price: High-Low</span></li>
                                            <li class="product_sorting_btn" data-order="name-a-z"><span>Name: A-Z</span></li>
                                            <li class="product_sorting_btn" data-order="name-z-a"><span>Name: Z-A</span></li>
										</ul>
									</li>
								</ul>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col">

					<div class="product_grid">
                        @foreach ($cat->products->map->skus->flatten() as  $sku)
                            <!-- Product -->
                            @php
                                //$image = $product->getImage();
                                /* $image='';
                                if(count($product->images) > 1){
                                    $image = $product->images[0]['img'];
                                }else{
                                    $image = 'no_image.png';
                                } */
                            @endphp
                            <div class="product">
                                <div class="product_image"><img src="{{$sku->product->getImage()}}" alt="{{$sku->product->title}}"></div>
                                <div class="product_extra product_sale"><a href="{{route('showCategory', isset($cat) ? $cat->slug : $sku->product->category['title'])}}">{{$cat->title}}</a></div>
                                <div class="product_content">
                                    <div class="product_title"><a href="{{route('sku', [$cat->slug, $sku->product->id, $sku->id])}}">{{$sku->product->__('title')}}</a></div>
                                    @if($sku->product->new_price != null)
                                        <div style="text-decoration: line-through">{{ $currencySymbol }}{{$sku->price}}</div>
                                        <div class="product_price">{{ $currencySymbol }}{{$sku->new_price}}</div>
                                    @else
                                        <div class="product_price">{{ $currencySymbol }}{{$sku->price}}</div>
                                    @endif
                                </div>
                            </div>
                        @endforeach
					</div>
					{{$cat->links('pagination.index')}}
				</div>
			</div>
		</div>
	</div>
	@include('layouts.icon')
@endsection
