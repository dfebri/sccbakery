<?php
/**
 * Created by PhpStorm.
 * User: Kim
 * Date: 6/19/2015
 * Time: 4:56 PM
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
            <div class="page-header-title">UPCOMING</div>
            <div class="page-header-subtitle">Events</div>
            <div class="page-header-line-blue"></div>
        </div>
        <div class="page-content-description clearfix">
            @foreach($events as $event)
            <div class="event">
                <div class="event_header">
                    @if($event->period_time)
                    <div class="event_date">{{ $event->start_date->format('d') }}</div>
                    <div class="event_monthyear">{{ $event->start_date->format('M').' '.$event->start_date->format('Y') }}</div>
                    <div class="event_date_separator">-</div>
                    <div class="event_date">{{ $event->end_date->format('d') }}</div>
                    <div class="event_monthyear">{{ $event->end_date->format('M').' '.$event->end_date->format('Y') }}</div>
                    @else
                    <div class="event_date">{{ $event->events_date->format('d') }}</div>
                    <div class="event_monthyear">{{ $event->events_date->format('M').' '.$event->events_date->format('Y') }}</div>

                    @endif
                </div>
                <div class="event_content">
                    <div class="event_title">{{ $event->title }}</div>
                    <div class="event_description">
                    {!! $event->description !!}
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@include('templates.parts.newsletter')
@include('templates.parts.footer')
</body>
</html>
