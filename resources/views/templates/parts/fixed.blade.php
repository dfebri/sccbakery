<script>
$(function(){
	$('.toggle-menu').click(function(){
		$('.nav-toggle', $(this)).toggleClass('active');
		if($(this).hasClass('opened')){
			$(this).removeClass('opened');
			$('#fix-left').animate({'left':'0px'}, 'fast');
		}else{
			$(this).addClass('opened');
			$('#fix-left').animate({'left':'200px'}, 'fast');
		}
	});
});
</script>
<div id="fix-left" class="desktop">
	<header id="header" class="center">
		<div><div class="toggle-menu"><a class="nav-toggle" href="#"><span></span></a></div></div>
		<a title="Home Page" href="{{URL::route('home')}}"><img class="website-logo" src="{{URL::asset('assets/images/'.$logo)}}"></a>
	</header>
	<nav id="navigation">
		<ul>
			<li class="{{$page=="home"?"curr":""}}"><a href="{{URL::route('home')}}" title="Home">HOME</a></li>
			<li class="{{$page=="menu"?"curr":""}} dropdown">
				<a title="Works">Works</a>
				<ul style="{{!empty($submenu)?'display:block':''}}">
					@foreach($category_list as $list)
					<li class="{{$submenu==$list->id?'curr':''}}"><a href="{{URL::route('work_list', $list->permalink)}}" title="{{$list->name}}">{{$list->name}}</a></li>
					@endforeach
				</ul>
			</li>
			<li class="{{$page=="about"?"curr":""}}"><a href="{{URL::route('about')}}" title="About">ABOUT</a></li>
			<li class="{{$page=="contact"?"curr":""}}"><a href="{{URL::route('contact')}}" title="Contact">CONTACT</a></li>
		</ul>
	</nav>
	<footer id="footer">
		<div id="social-link" class="center">
			@foreach($social_link_list as $list)
			<a target="_blank" href="{{$list->link}}"><img title="{{$list->name}}" src="{{URL::asset('assets/uploads/social_link/'.$list->picture)}}"></a>
			@endforeach
		</div>
		<div class="copyright">
			<span>{{ $copyright }}</span>
			<span>{{ $powered }}</span>
		</div>
	</footer>
</div>
</div>
