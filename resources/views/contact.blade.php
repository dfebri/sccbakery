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
    <style>
        #mapframe {
            height: 500px;
            width: 100%;
            border: 0;
        }
    </style>
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

        <!-- <div class="maps">
            <div class="maps-header clearfix">
                <?php $i = 1; ?>
                @foreach($location as $address)
                    <div class="map-header col-xs-4 col-lg-3"><a id="map-header-{{ $i }}" href="#">{{ $address->name }}<div class="product-line-blue"></div></a></div>
                    <?php $i++; ?>
                @endforeach
            </div> -->
            <div id="mapframe" class="my-5">
            <iframe
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3966.7196424752974!2d106.83875981070484!3d-6.168284260423302!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69f5c8470d8b95%3A0xd113cc064e33e996!2sPT.%20Sinar%20Cahaya%20Cemerlang!5e0!3m2!1sid!2sid!4v1752921405099!5m2!1sid!2sid"
                width="100%"
                height="450"
                style="border:0; border-radius:16px; margin-top:20px; margin-bottom:20px; display: block;"
                allowfullscreen=""
                loading="lazy"
                referrerpolicy="no-referrer-when-downgrade">
            </iframe>
            </div>
    </div>
</div>
@include('templates.parts.newsletter')
@include('templates.parts.footer')
</body>
</html>
