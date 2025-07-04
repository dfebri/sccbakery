<?php
/**
 * Created by PhpStorm.
 * User: Kim
 * Date: 6/16/2015
 * Time: 2:11 PM
 */
?>
<!doctype html>
<html lang="en">
<head>
@include('templates.parts.head')
<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
<script type="text/javascript">
	function initialize(longitude, latitude, selector, title) {
		var latlng = new google.maps.LatLng(longitude,latitude);
		var settings = {
			zoom: 15,
			center: latlng,
			mapTypeControl: true,
			mapTypeControlOptions: {style: google.maps.MapTypeControlStyle.DROPDOWN_MENU},
			navigationControl: true,
			navigationControlOptions: {style: google.maps.NavigationControlStyle.SMALL},
			mapTypeId: google.maps.MapTypeId.ROADMAP};
		var map = new google.maps.Map(document.getElementById(selector), settings);

		var contentString = '<div id="content">'+
			'<div id="siteNotice">'+
			'</div>'+
			'<h1 id="firstHeading" class="firstHeading" style="color:#000;">'+title+'</h1>'+
			'<div id="bodyContent"></div>'+
			'</div>';
		var infowindow = new google.maps.InfoWindow({
			content: contentString
		});

		var companyImage = new google.maps.MarkerImage('resources/assets/images/logo-marker.png',
			new google.maps.Size(77,69),
			new google.maps.Point(0,0),
			new google.maps.Point(50,50)
		);

		var companyPos = new google.maps.LatLng(longitude,latitude);

		var companyMarker = new google.maps.Marker({
			position: companyPos,
			map: map,
			icon: companyImage,
			title:title,
			zIndex: 3});

		google.maps.event.addListener(companyMarker, 'click', function() {
			infowindow.open(map,companyMarker);
		});
	}

$(function () {
    var currentMap  = 1;
    var location    = {!! json_encode($location) !!};

	$('#contact-form').submit(function(){
        $.ajax({type: "POST",url: "{{URL::route('send_message')}}",data: $(this).serialize()
        }).success(function(data){
            if(data.error){
                $('.sign_error').html(data.message);
                $('.sign_error').show();
                $('.sign_success').hide();
            }else{
                $('.sign_error').hide();
                $('.sign_success').html(data.message);
                $('.sign_success').show();
                
                $('.form-control').val('');
            }
        });
        return false;
    });

    $(".map-header a").click(function(){
        var selector    = $(this);
        var id          = selector.attr('id').split('-')[2];
        var parent      = selector.parent();
        var child       = selector.children('.product-line-blue');

        var prev    = $("#map-header-"+currentMap);
        var parentPrev  = prev.parent();
        var childPrev   = prev.children('.product-line-blue');
        parentPrev.removeClass('map-header-active');
        childPrev.removeClass('product-line-blue-active');
        parent.addClass('map-header-active');
        child.addClass('product-line-blue-active');

        initialize(location[id-1].longitude, location[id-1].latitude, 'mapframe', location[id-1].name);

        currentMap = id;
		return false;
	});

	$(".map-header:first-child a").trigger('click');

});
</script>
</head>
<body>
@include('templates.parts.header')

<div id="content-box">
    <div class="page-picture">
        <img src="{{ URL::asset('resources/assets/uploads/pages/'.$img) }}" />
    </div>
	<div class="container">
        <div class="page-header">
            <div class="page-header-title">{{ $title }}</div>
            <div class="page-header-subtitle">SCC Bakery</div>
            <div class="page-header-line-blue"></div>
        </div>
        <div class="clearfix">
            <div class="col-md-4 contact-part">
                <h4 class="page-content-header">
                    our office
                    <div class="line-blue"></div>
                </h4>
                @foreach($location as $address)
                <div class="address">
                    <h4 class="address-section">{!! $address->name !!}</h4>
                    <div class="content">{!! $address->address !!}</div>
                </div>
                @endforeach
            </div>

            <div class="col-md-6 contact-part">

                <h4 class="page-content-header">
                    send us a message
                    <div class="line-blue"></div>
                </h4>

                <div id="message">
                    <div class="sign_error" style="display:none"></div>
                    <div class="sign_success" style="display:none"></div>
                </div>

                {!! Form::open(array('id'=>'contact-form','method'=>'POST')) !!}
                {!! Form::hidden('auth', Input::old('auth')) !!}
                    <div>
                        <div class="row clearfix">
                            <div class="col-md-3">Name (required)</div>
                            <div class="col-md-9">
                                {!! Form::text('name', Input::old('name'), array('class'=>'form-control')) !!}
                            </div>
                        </div>
                        <div class="row clearfix">
                            <div class="col-md-3">Email (required)</div>
                            <div class="col-md-9">
                                {!! Form::text('email', Input::old('email'), array('class'=>'form-control')) !!}
                            </div>
                        </div>
                        <div class="row clearfix">
                            <div class="col-md-3">Subject</div>
                            <div class="col-md-9">
                                {!! Form::text('subject', Input::old('subject'), array('class'=>'form-control')) !!}
                            </div>
                        </div>
                        <div class="row clearfix">
                            <div class="col-md-3">Message</div>
                            <div class="col-md-9">
                                {!! Form::textarea('message', Input::old('message'), array('class'=>'form-control')) !!}
                            </div>
                        </div>
                        <div class="right">
                            {!! Form::submit('SUBMIT', array('class'=>'form-control')) !!}
                        </div>
                    </div>
                {!! Form::close() !!}
            </div>
        </div>

        <div class="maps">
            <div class="maps-header clearfix">
                <?php $i = 1;?>
                @foreach($location as $address)
                    <div class="map-header col-xs-4 col-lg-3"><a id="map-header-{{ $i }}" href="#">{{ $address->name }}<div class="product-line-blue"></div></a></div>
                <?php $i++; ?>
                @endforeach
            </div>
            <div id="mapframe" class="map"></div>
        </div>

    </div>
</div>
@include('templates.parts.newsletter')
@include('templates.parts.footer')
</body>
</html>