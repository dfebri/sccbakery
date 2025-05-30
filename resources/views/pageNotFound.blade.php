<?php
/**
 * Created by PhpStorm.
 * User: Kim
 * Date: 6/19/2015
 * Time: 4:37 PM
 */
?>
<!doctype html>
<html lang="en">
<head>
@include('templates.parts.head')
</head>
<body>
@include('templates.parts.header')
<div class="error-content center">
    <div class="error-header">page not found</div>
    <div class="error-desc">
        <p>
            we are sorry but the page you are looking does not exist<br />
            you may have mistyped or the page has been removed by our system.
        </p>
    </div>
    <div class="error-link">
        <a href="{{ URL::route('home') }}">try to go back to home</a>
    </div>
</div>
@include('templates.parts.newsletter')
@include('templates.parts.footer')
</body>
</html>