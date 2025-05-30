<?php
/**
 * Created by PhpStorm.
 * User: Outpost-PC2
 * Date: 9/16/2015
 * Time: 12:48 PM
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
    <div class="container">
        <div class="page-header">
            <div class="page-header-title">SEARCH</div>
            <div class="page-header-subtitle">Results</div>
            <div class="page-header-line-blue"></div>
        </div>
        <div class="search-result clearfix">
            <div class="search-title">SEARCH RESULT FOR "<span>{{ $search }}</span>  "</div>
            <div class="search-total">{{ $totalfound }} FOUND</div>
            <div class="search-line"></div>
            <div class="search-list-content clearfix">
                @foreach($search_list as $list)
                <div>
                    <a href="{{URL::route('product',['category',$list->category->permalink, $list->permalink])}}">
                    <div class="search-result-title">{{ $list->name }}</div>
                    <div class="search-result-description">{!! $list->description !!}</div>
                    </a>
                </div>
                @endforeach
            </div>
        </div>
        <div class="center">{!! $search_list->setPath($subPage)->render(new sccbakery\Http\Presenters\PaginationPresenter($search_list)) !!}</div>
    </div>
</div>
@include('templates.parts.newsletter')
@include('templates.parts.footer')
</body>
</html>