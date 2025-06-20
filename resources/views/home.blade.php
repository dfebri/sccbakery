<?php
/**
 * Created by PhpStorm.
 * User: Kim
 * Date: 6/2/2015
 * Time: 10:55 PM
 */
?>
<!doctype html>

<html lang="en">

<head>
    @include('templates.parts.head')
    <link rel="stylesheet" href="{{URL::asset('resources/assets/css/default.css')}}" type="text/css" media="screen" />
    <link rel="stylesheet" href="{{URL::asset('resources/assets/css/nivo-slider.css')}}" type="text/css" media="screen" />
    <script type="text/javascript" src="{{URL::asset('resources/assets/js/jquery.nivo.slider.js')}}"></script>

    <script type="text/javascript">
        $(window).load(function() {
            $('#slider').nivoSlider({
                effect: 'fade',               // Specify sets like: 'fold,fade,sliceDown'
                slices: 15,                     // For slice animations
                boxCols: 8,                     // For box animations
                boxRows: 4,                     // For box animations
                animSpeed: 500,                 // Slide transition speed
                pauseTime: 6000,                // How long each slide will show
                startSlide: 0,                  // Set starting Slide (0 index)
                directionNav: true,             // Next & Prev navigation
                controlNav: true,               // 1,2,3... navigation
                controlNavThumbs: false,        // Use thumbnails for Control Nav
                pauseOnHover: true,             // Stop animation while hovering
                manualAdvance: false,           // Force manual transitions
                prevText: '<img src="{{URL::asset('resources/assets/images/slide-prev.png')}}">',               // Prev directionNav text
                nextText: '<img src="{{URL::asset('resources/assets/images/slide-next.png')}}">',               // Next directionNav text
                randomStart: false,             // Start on a random slide
                beforeChange: function(){},     // Triggers before a slide transition
                afterChange: function(){},      // Triggers after a slide transition
                slideshowEnd: function(){},     // Triggers after all slides have been shown
                lastSlide: function(){},        // Triggers when last slide is shown
                afterLoad: function(){}
            });
        });

        $(function () {
            var speed   = 150;
            //if browser are mobile disable this
            $(".home-tile-box").hover(function () {
                tileHover($(this),'fadeIn');
            }, function () {
                tileHover($(this),'fadeOut');
            });

            function tileHover(selector, effect) {
                var width   = $(window).width();
                var bottom  = width < 1000 ? 45 : 120;
                var overlay     = selector.find('.home-tile-overlay');
                var textContain = selector.find('.home-tile-text');

                if(effect == 'fadeIn') {
                    overlay.stop().fadeIn(speed);
                    textContain.stop().animate({bottom: bottom},speed);
                } else if(effect == 'fadeOut') {
                    overlay.stop().fadeOut(speed);
                    textContain.stop().animate({bottom: "20"},speed);
                }
            }
        });
    </script>
</head>
<body>

@include('templates.parts.header')
<div id="content-box">

	<div class="slideshow">
		<div id="slider" class="nivoSlider">
			@foreach($slideshow_list as $slide)
			<a href="{{$slide->url}}"><img src="{{URL::asset('resources/assets/uploads/home_slideshow/'.$slide->img)}}" data-thumb="{{URL::asset('resources/assets/uploads/home_slideshow/'.$slide->picture)}}" alt="" title="" /></a>
			@endforeach
		</div>
	</div>

	<div class="container">
        <div class="row clearfix banner-home">
            <div class="col-md-4 home-tile-box">
                <a href="{{ $tile_1_link }}">
                    <div class="home-tile" style="background-image:url('{{ URL::asset('resources/assets/uploads/content/'.$tile_1_picture) }}')">
                        <div class="home-tile-overlay"></div>
                        <div class="home-tile-text center">
                            <div class="home-tile-title">{!! $tile_1_title !!}</div>
                            <div class="home-tile-button">{{ $tile_1_button }}</div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-4 home-tile-box">
                <a href="{{ $tile_2_link }}">
                    <div class="home-tile" style="background-image:url('{{URL::asset('resources/assets/uploads/content/'.$tile_2_picture)}}')">
                        <div class="home-tile-overlay"></div>
                        <div class="home-tile-text center">
                            <div class="home-tile-title">{!! $tile_2_title !!}</div>
                            <div class="home-tile-button">{{ $tile_2_button }}</div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-4 home-tile-box">
				<a href="{{ $tile_3_link }}">
                    <div class="home-tile" style="background-image:url('{{URL::asset('resources/assets/uploads/content/'.$tile_3_picture)}}')">
                        <div class="home-tile-overlay"></div>
                        <div class="home-tile-text center">
                            <div class="home-tile-title">{!! $tile_3_title !!}</div>
                            <div class="home-tile-button">{{ $tile_3_button }}</div>
                        </div>
                    </div>
				</a>
            </div>
        </div>

        <div class="row"><hr /></div>

        <div class="widget-video row clearfix">
            <h3 class="center">video</h3>
            <div class="center">
                <div class="line-blue"></div>
            </div>

            <div class="widget-video-wrapper clearfix">
                <div class="widget-video-content col-md-4 center">
                    <a href="{{ $home_check_our_video != '' ? $home_check_our_video : '#' }}" target="_blank" class="btn widget-video-button">check our video</a>
                    <div class="widget-video-title">{!! $home_video_title !!}</div>
                    <div class="widget-video-title-line"></div>
                    <div class="widget-video-description">
                        {!! $home_video_description !!}
                    </div>
                </div>
                <!--<div class="col-md-8" id="home-video">-->
                <!--    <iframe width="100%" height="395" src="https://www.youtube.com/embed/{{ $home_video }}" frameborder="0" allowfullscreen></iframe>-->
                <!--</div>-->
                <div class="col-md-8" id="home-video">
                    <iframe width="100%" height="395" src="https://www.youtube.com/embed/r-ozBSRoXyQ" frameborder="0" allowfullscreen  style="border-radius: 10px; overflow: hidden;"></iframe>
                </div>
            </div>
        </div>
	</div>


</div>
@include('templates.parts.newsletter')
@include('templates.parts.footer')
</body>
</html>

