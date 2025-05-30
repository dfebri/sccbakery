<?php
/**
 * Created by PhpStorm.
 * User: Kim
 * Date: 6/12/2015
 * Time: 9:12 AM
 */
?>
<!doctype html>
<html lang="en">
<head>
@include('templates.parts.head')
<meta property="og:title" content="{{$productDetail->name}}" />
<meta property="og:image" content="{{URL::asset('resources/assets/uploads/products/'.$product_stage_size.'/'.@$primaryImage->img)}}" />
<meta property="og:site_name" content="SCC Bakery" />
<meta property="og:description" content="{!! strip_tags($productDetail->description) !!}" />
<script type="text/javascript" src="{{ URL::asset('resources/assets/js/jquery.jcarousel.min.js') }}"></script>
<script type="text/javascript">
    $(function () {
        var current = 1;
        $(".product-detail-tab a").click(function () {
            var dest    = $(this).attr('class');
            dest        = dest.split('-')[2];

            $(".detail-tab-"+current).parent().removeClass('product-detail-tab-active');
            $(".detail-tab-"+current).find('div').hide();
            $(".tab-"+current).hide();


            $(".detail-tab-"+dest).parent().addClass('product-detail-tab-active');
            $(".detail-tab-"+dest).find('div').show();
            $(".tab-"+dest).show();
            current = dest;
            return false;
        });

        $(".img-thumb").click(function(){
            var img 		= $(this).attr('href');
            var img_full 	= $(this).attr('data');
            var stage		= "<img src='"+img+"' class='jqzoom' data-zoom-image='"+img_full+"'/>";
            $('.stage').html(stage);

            return false;
        });

        $(".img-thumb:first").trigger('click');


        $('.product-carousel').jcarousel();
        $('.carousel-navigation.prev')
            .on('jcarouselcontrol:inactive', function() {
                $(this).addClass('inactive');
            })
            .on('jcarouselcontrol:active', function() {
                $(this).removeClass('inactive');
            })
            .jcarouselControl({
                target: '-=1'
            });

        $('.carousel-navigation.next')
            .on('jcarouselcontrol:inactive', function() {
                $(this).addClass('inactive');
            })
            .on('jcarouselcontrol:active', function() {
                $(this).removeClass('inactive');
            })
            .jcarouselControl({
                target: '+=1'
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

<div id="content-box">
	<div class="container">
	    {!! $breadcrumb !!}
		<div class="back-link desktop"><a href="{{ $typeName == 'all-products' ? URL::route($type.'_null') : URL::route($type,$typeName)}}">BACK TO PRODUCT PAGE >></a></div>
		<div class="product-detail clearfix">
			<div class="col-md-5">
                <div class="stage">
                    <img src="{{ URL::asset('resources/assets/uploads/products/'.$product_stage_size.'/'.@$primaryImage->img)}}" />
                </div>
                <div class="thumb">
                    <a href="#" class="carousel-navigation prev"></a>
                    <a href="#" class="carousel-navigation next"></a>
                    <div class="carousel product-carousel">
                        <ul>
                            @foreach($productDetail->image as $image)
                                <li><a class="img-thumb" href="{{ URL::asset('resources/assets/uploads/products/'.$product_stage_size.'/'.$image->img )}}" data="{{ URL::asset('resources/assets/uploads/products/'.$image->img)}}"><img src="{{ URL::asset('resources/assets/uploads/products/'.$product_carousel_size.'/'.$image->img) }}" /></a></li>
                            @endforeach
                        </ul>
                    </div>
                </div>

			</div>
			<div class="col-md-7">
				<h1 class="product-title">{{$productDetail->name}}</h1>
				<div class="product-subtitle">{{$productDetail->subtitle}}</div>

                <div class="product-detail-container">
                    <div class="product-detail-header clearfix">
                        <div class="product-detail-tab product-detail-tab-active col-xs-5">
                            <a href="#" class="detail-tab-1">
                                details
                                <div class="product-line-blue product-line-blue-active"></div>
                            </a>
                        </div>
                        <div class="product-detail-tab col-xs-5">
                            <a href="#" class="detail-tab-2">
                                see video
                                <div class="product-line-blue"></div>
                            </a>
                        </div>
                    </div>

				    <div class="product-description tab-1">{!! $productDetail->description !!}</div>
				    <div class="product-video tab-2">
				        @if($productDetail->video)
				        <iframe width="100%" height="250" src="https://www.youtube.com/embed/{{ $productDetail->video }}" frameborder="0" allowfullscreen></iframe>
				        @else
				        There is no video for this product..
				        @endif

				    </div>
                </div>

				<div class="share-box">
					<h3>
					    SHARE
                        <div class="line-blue"></div>
					</h3>
					<a href="https://www.facebook.com/sharer/sharer.php?u={{ URL::current() }}" target="_blank" class="fb share_btn"><img src="{{ URL::asset('resources/assets/images/fb-share.png') }}"></a>
					<a href="http://twitter.com/share?url={{URL::current()}}" target="_blank" class="email share_btn"><img src="{{URL::asset('resources/assets/images/twitter-share.png')}}"></a>
					<a href="http://www.pinterest.com/pin/create/button/?url={{URL::current()}}&media={{URL::asset('resources/assets/uploads/products/'.$product_stage_size.'/'.@$primaryImage->img)}}&description=''" target="_blank" class="email share_btn"><img src="{{URL::asset('resources/assets/images/pinterest-share.png')}}"></a>
				</div>
			</div>
		</div>
		<div class="back-link mobile"><a href="{{ $typeName == 'all-products' ? URL::route($type.'_null') : URL::route($type,$typeName)}}">BACK TO PRODUCT PAGE >></a></div>
	</div>
</div>
@include('templates.parts.newsletter')
@include('templates.parts.footer')
</body>
</html>
