<?php
/**
 * Created by PhpStorm.
 * User: Kim
 * Date: 6/12/2015
 * Time: 6:53 AM
 */
?>
<!doctype html>
<html lang="en">
<head>
@include('templates.parts.head')
<style>
		a,
		img {
			display: block;
		}
		img {
			border: 0;
		}
		img:not([src]) {
			visibility: hidden;
		}
		/* Fixes Firefox anomaly during image load */
		@-moz-document url-prefix() {
			img:-moz-loading {
				visibility: hidden;
			}
		}
	</style>
<script src="{{ URL::asset('resources/assets/js/blazy.min.js') }}"></script>
<script type="text/javascript">
$(function () {
    $("#product-menu").click(function () {
        $(this).children('ul').stop().slideToggle();
        $(this).children('ul').toggleClass('active');
		$('.menu-close', $(this)).toggle();
		$('.menu-open', $(this)).toggle();
    });
});
</script>
</head>
<body>
@include('templates.parts.header')
<div class="desktop">
    <div class="product-menu">
        <div class="container">
            <div class="product-menu-header clearfix">
                <div class="product-header col-md-2 {{$subPage == 'category' ? 'product-header-active' : ''}}" id="product-category"><a href="{{URL::route('category_null')}}">CATEGORIES<div class="product-line-blue {{$subPage == 'category' ? "product-line-blue-active" : ""}}"></div></a></div>
                <div class="product-header col-md-2 {{$subPage == 'brand' ? 'product-header-active' : ''}}" id="product-brands"><a href="{{URL::route('brand_null')}}">BRANDS<div class="product-line-blue {{$subPage == 'brand' ? "product-line-blue-active" : ""}}"></div></a></div>
            </div>
            <div class="product-menu-list clearfix">
            <a class="product-menu-list-all {{ $product->permalink == 'all-products' ? 'product-menu-all-active' : '' }}" href="{{ $subPage == 'category' ? URL::route('category_null') : URL::route('brand_null') }}">ALL PRODUCTS</a>
                <ul>
                    @foreach($menuList as $menu)
                    <li class="col-md-3 {{ $product->permalink == $menu->permalink ? 'product-menu-list-active' : '' }}"><a href="{{URL::route($subPage, $menu->permalink)}}">{{ $menu->name }}</a></li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</div>
<div class="mobile" id="product-menu">
    <p>FILTER</p>
    <img class="menu-close" src="{{URL::asset('resources/assets/images/footer-menu-close.png')}}">
    <img class="menu-open sembunyi" src="{{URL::asset('resources/assets/images/footer-menu-open.png')}}">
    <ul>
        <li><a title="{{ $subPage == 'category' ? 'category' : 'brand' }}" href="{{ $subPage == 'category' ? 'category_null' : 'brand_null' }}">ALL PRODUCTS</a></li>
        @foreach($menuList as $menu)
        <li class="{{ $product->permalink == $menu->permalink ? 'product-menu-list-active' : '' }}"><a href="{{URL::route($subPage, $menu->permalink)}}">{{ $menu->name }}</a></li>
        @endforeach
    </ul>
</div>

<div id="content-box">
	<div class="container">
        {!! $breadcrumb !!}
		<h1 class="current-category-title">{{$product->name}}</h1>
		<div class="clearfix">
		@if(count($product_list))
			@foreach($product_list as $list)
			<?php
			?>
			<div class="col-xs-6 col-md-4 product-list-box">
				<a href="{{URL::route('product',array($subPage,$product->permalink,$list->permalink))}}">
				<div class="product-list center">
					<div class="product-list-picture">
                        <div class="product-list-overlay">
                            <div class="product-list-overlay-button">SEE DETAIL</div>
                        </div>
                        @if(count($list->image)>0)
					    <img
    src="{{asset('resources/assets/uploads/products/'.$product_stage_size.'/'.$list->image[0]->img)}}" class="b-lazy"  />
					    @else
					    <img src="{{asset('resources/assets/images/no-image.png')}}" class="b-lazy" />
					    @endif
					</div>
					<div class="product-list-title">{{$list->name}}</div>
					<div class="product-list-subtitle">{{$list->subtitle}}</div>

				</div>
				</a>
			</div>
			@endforeach
        @else
            <div class="product-empty-container">There is no product found in here.</div>
        @endif
		</div>
                @if($data)
			<div class="center">{!! $product_list->setPath($data)->render(new sccbakery\Http\Presenters\PaginationPresenter($product_list)) !!}</div>
		@else
			<div class="center">{!! $product_list->setPath($subPage)->render(new sccbakery\Http\Presenters\PaginationPresenter($product_list)) !!}</div>
		@endif
</div>
</div>
@include('templates.parts.newsletter')
@include('templates.parts.footer')
<script>
//     window.bLazy = new Blazy({
// 		container: '.container',
// 		success: function(element){
// 			console.log("Element loaded: ", element.nodeName);
// 		}
// 	});
	</script>
</body>
</html>
