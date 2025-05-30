<?php
/**
 * Created by PhpStorm.
 * User: Kim
 * Date: 6/25/2015
 * Time: 8:00 PM
 */
?>
<!doctype html>
<html lang="en">
<head>
@include('templates.parts.head')
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
        <div class="page-content-description clearfix">
            {!! $industrial->description !!}
        </div>
    </div>
</div>
@include('templates.parts.newsletter')
@include('templates.parts.footer')
</body>
</html>