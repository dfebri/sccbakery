<script type="text/javascript">
$(function(){
	$('.toggle-menu').click(function(){
		$('#navigation').slideToggle();
		$('.nav-toggle', $(this)).toggleClass('active');
	});

	$('.toggle-search button').click(function(){
		if($('input[type="text"]', $(this).parent()).val() != ""){
			return true;
		}else{
			$('input[type="text"]', $(this).parent()).fadeToggle();
			return false;
		}
	});
	
	$("#navigation > ul > li.dropdown").bind({
        "mouseenter" : function() {
            $( "ul", this ).stop(true, false).slideDown('fast');
        },
        "mouseleave" : function() {
            $( "ul", this ).stop(true, false).slideUp('fast');
        }
    });

		if($(this).width()>999){
			$('#navigation').css({'display':'block'});
			$('.nav-toggle').removeClass('active');
		}else{
			$('#navigation').css({'display':'none'});
		}
});
</script>
<header id="header">
	<div class="container">
		<a title="Home Page" href="{{URL::route('home')}}"><img class="website-logo" alt="Website Logo" src="{{URL::asset('resources/assets/images/'.$website_logo)}}"></a>
		<nav id="navigation">
			<ul>
				<li class="{{$page=="home"?"curr":""}}"><a href="{{URL::route('home')}}" title="HOME">HOME<div class="line-white{{$page=="home"?" line-white-curr":""}}"></div></a></li>
				<li class="{{$page=="about"?"curr":""}}"><a href="{{URL::route('single-page', 'about')}}" title="ABOUT">ABOUT<div class="line-white{{$page=="about"?" line-white-curr":""}}"></div></a></li>
				<li class="dropdown {{$page=="product"?"curr":""}}">
					<a title="PRODUCT">PRODUCT<div class="line-white {{$page=="product"?"line-white-curr":""}}"></div></a>

					<div class="mobile">
						<img class="menu-close" src="{{URL::asset('resources/assets/images/nav-menu-close.png')}}">
						<img class="menu-open sembunyi" src="{{URL::asset('resources/assets/images/nav-menu-open.png')}}">
					</div>
					<ul>
						<li><a title="category" href="{{URL::route('category_null')}}">Categories</a></li>
						<li><a title="brand" href="{{URL::route('brand_null')}}">Brands</a></li>
					</ul>
				</li>

			
				<li class="{{$page=="food-service"?"curr":""}}"><a href="{{URL::route('pages', 'food-service')}}" title="FOOD SERVICE">FOOD SERVICE<div class="line-white{{$page=="food-service"?" line-white-curr":""}}"></div></a></li>
				<li class="{{$page=="industrial-line"?"curr":""}}"><a href="{{ URL::route('single-page', 'industrial-line') }}" title="INDUSTRIAL LINE">INDUSTRIAL LINE<div class="line-white"></div></a></li>
				<li class=""><a href="http://{{ $bakeware_link }}" title="BAKEWARE&CO.">BAKEWARE & CO<div class="line-white"></div></a></li>
				<li class="{{$page=="contact"?"curr":""}}"><a href="{{URL::to('contact')}}" title="CONTACT">CONTACT<div class="line-white{{$page=="contact"?" line-white-curr":""}}"></div></a></li>
			</ul>
		</nav>
		<div class="desktop">
			<div class="search-box">
				{!! Form::open(array('id'=>'search-form','method'=>'POST', 'route'=>'search')) !!}
				{!! Form::text('search', Input::get('search'), array('placeholder'=>'')) !!}
				<button type="submit"><img alt="Search Icon" title="Search" src="{{URL::asset('resources/assets/images/search-desktop.png')}}"></button>
				{!! Form::close() !!}
			</div>
		</div>
		<div class="mobile">
			<div class="toggle-menu"><a class="nav-toggle" href="#"><span></span></a></div>
			<div class="toggle-search">
				{!! Form::open(array('id'=>'search-form-mobile','method'=>'GET', 'route'=>'search')) !!}
				{!! Form::text('search', Input::get('search'), array('placeholder'=>'search for products, topic and more...')) !!}
				<button type="submit"><img alt="Search Icon" title="Search" src="{{URL::asset('resources/assets/images/search-mobile.png')}}"></button>
				{!! Form::close() !!}
			</div>
		</div>
	</div>
</header>