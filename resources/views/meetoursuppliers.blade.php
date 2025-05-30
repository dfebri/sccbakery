<?php
/**
 * Created by PhpStorm.
 * User: Kim
 * Date: 6/19/2015
 * Time: 4:51 PM
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
    <div class="page-picture" style="background-image:url('{{ URL::asset('assets/uploads/content/'.$contact_picture) }}');"></div>
	<div class="container">
        <div class="page-header">
            <div class="page-header-title">MEET</div>
            <div class="page-header-subtitle">Our Suppliers</div>
            <div class="page-header-line-blue"></div>
        </div>
        <div class="page-content-description clearfix">
            @foreach($suppliers as $supplier)
            <div class="supplier">
                <div class="supplier-title">{{ $supplier->title }}</div>
                <div class="supplier-description">{!! $supplier->description !!}</div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@include('templates.parts.newsletter')
@include('templates.parts.footer')
</body>
</html>