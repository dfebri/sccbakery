<?php
/**
 * Upcoming Event Detail
 */
?>
<!doctype html>
<html lang="en">

<head>
    @include('templates.parts.head')
</head>

<body>

@include('templates.parts.header')
   <link rel="stylesheet"
          href="{{ URL::asset('resources/assets/css/styles.css')}}?v=3">

<div id="content-box">
    <div class="page-picture"
         style="background-image:url('{{ URL::asset('assets/uploads/content/'.$contact_picture) }}');">
    </div>

    <div class="container">
        <div class="page-content-description clearfix">
            <div class="event_detail">

                <!-- <div class="event_detail_content">

                    <h2 class="event_detail_title">
                        {{ $event->title }}
                    </h2>

                    <div class="event_time">
                        @if($event->period_time)

                            {{ $event->start_date->format('d M Y') }}

                            @if($event->start_date->format('Y-m-d') != $event->end_date->format('Y-m-d'))
                                - {{ $event->end_date->format('d M Y') }}
                            @endif

                        @else

                            {{ $event->events_date->format('d M Y') }}

                        @endif
                    </div>

                    {!! $event->description !!}
                </div> -->
                <div class="event_detail_content">
                    <!-- image  -->
                    @if(preg_match('/<img[^>]+src=["\']([^"\']+)["\']/i', $event->description, $matches))
                        <div class="event_detail_image">
                            <img src="{{ $matches[1] }}" alt="{{ $event->title }}">
                        </div>
                    @endif

                    <!-- title -->
                    <h2 class="event_detail_title">
                        {{ $event->title }}
                    </h2>
                    <!-- time -->
                    <!-- <div class="event_time">
                        @if($event->period_time)

                            {{ $event->start_date->format('d M Y') }}

                            @if($event->start_date->format('Y-m-d') != $event->end_date->format('Y-m-d'))
                                - {{ $event->end_date->format('d M Y') }}
                            @endif

                        @else

                            {{ $event->events_date->format('d M Y') }}

                        @endif
                    </div> -->

                    <!-- deskripsi -->
                    <div class="event_detail_description">
                        {!! preg_replace('/<img[^>]*>/i', '', $event->description) !!}
                    </div>

                </div>

                <div class="event_back">
                    <a href="{{ url('/upcoming-events') }}">
                        &laquo; BACK TO EVENTS
                    </a>
                </div>

            </div>

        </div>

    </div>

</div>

@include('templates.parts.newsletter')
@include('templates.parts.footer')

</body>
</html>