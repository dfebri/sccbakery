<script>
$(function(){
	$('.dropdown').click(function(){
		$('ul', $(this)).slideToggle('fast');
		$('.menu-close', $(this)).toggle();
		$('.menu-open', $(this)).toggle();
	});
});
</script>
	<ul class="footer-menu mobile">
		<li class="dropdown pos-relative">
			<p>SCC BAKERY</p>
			<img class="menu-close" src="{{URL::asset('resources/assets/images/footer-menu-close.png')}}">
			<img class="menu-open sembunyi" src="{{URL::asset('resources/assets/images/footer-menu-open.png')}}">
			<ul>
				@foreach($page_list as $list)
					@if($list->custom_page)
					<li><a title="{{$list->name}}" href="{{ URL::to($list->url) }}">{{ $list->name }}</a></li>
					@else
					<li><a title="{{$list->name}}" href="{{ URL::route('pages', $list->permalink )}}">{{ $list->name }}</a></li>
					@endif
				@endforeach
			</ul>
		</li>
		<li class="dropdown pos-relative">
			<p>PRODUCT</p>
			<img class="menu-close" src="{{URL::asset('resources/assets/images/footer-menu-close.png')}}">
			<img class="menu-open sembunyi" src="{{URL::asset('resources/assets/images/footer-menu-open.png')}}">
			<ul>
				<li><a title="All Products" href="{{URL::route('category_null')}}">Category</a></li>
				<li><a title="All Products" href="{{URL::route('brand_null')}}">Brands</a></li>
				{{--@foreach($category_list as $list)--}}
				{{--<li><a title="{{$list->name}}" href="{{URL::route('category', $list->permalink)}}">{{$list->name}}</a></li>--}}
				{{--@endforeach--}}
			</ul>
		</li>
	</ul>
<footer id="footer">
	<div class="container">
		<div id="sub-footer-area">
			<div class="row">
                <div class="sub-footer-part col-md-3 desktop">
                    <h3>SCC BAKERY<div class="line-blue"></div></h3>
                    <ul>
                        @foreach($page_list as $list)
                            @if($list->custom_page)
                            <li><a title="{{$list->name}}" href="{{ URL::to($list->url) }}">{{ $list->name }}</a></li>
                            @else
                            <li><a title="{{$list->name}}" href="{{ URL::route('pages', $list->permalink) }}">{{ $list->name }}</a></li>
                            @endif
                        @endforeach
                    </ul>
                </div>
				<div class="sub-footer-part col-md-3 desktop">
					<h3>PRODUCT<div class="line-blue"></div></h3>
					<ul>
						<li><a title="category" href="{{URL::route('category_null')}}">Categories</a></li>
						<li><a title="brand" href="{{URL::route('brand_null')}}">Brands</a></li>
					</ul>
				</div>
				<div class="sub-footer-part col-md-3">
					<h3>CONTACT US<div class="line-blue"></div></h3>
					<div class="content">{!! $contact_footer !!}</div>
{{--					<div class="content">{{ $contact_footer }}</div>--}}
				</div>
				<div class="sub-footer-part col-md-3 find-us">
					<h3>FIND US<div class="line-blue"></div></h3>
					@foreach($social_link_list as $list)
					<a target="_blank" href="{{$list->link}}"><img title="{{$list->name}}" src="{{URL::asset('resources/assets/uploads/social_link/'.$list->picture)}}"></a>
					@endforeach
				</div>
			</div>
		</div>
	</div>
    <!-- <div id="copyright" class="center">
        <span>{{$copyright}}</span>
        <span>, All rights reserved 2025.</span>  -->
        <!--<span>Developed by <a title="Go To Outpost Interactive Website" href="http://www.outpost-interactive.com" target="_blank">Outpost-Interactive.</a></span>-->
    <!-- </div> -->
	<div id="copyright" class="center">
		<span>Copyright SCCBAKERY © 2015</span>
		<span>, All right reserved</span> 
</footer>