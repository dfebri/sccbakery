<!DOCTYPE html>
<html lang="en">
<head>
	@include('admin::parts.head')
</head>

<body>
<div id="full-container">
	@include('admin::parts.menu')

	<div id="page-info">
		<div class="container">
			<div class="row">
				<div class="col-xs-6">
					<h1>{!! $page_title !!}</h1>
				</div>
				<div class="col-xs-6">
					@if(isset($button))
					<div class="btn-holder">
						{!! $button !!}
					</div>
					@endif
				</div>
			</div>
		</div>
	</div>

	<div class="container">
        {!! $breadcrumb !!}
    </div>

    <div class="container">
    	<div class="row">
	    	<div class="col-xs-12">
	            <div class="portlet">
	                <div class="portlet-header">
	                    <h4>{!! $sub_title !!}</h4>
	                </div>
	                <div class="portlet-content cnt_b">
	                	@if(isset($date_range_filter))
	                		{!! $date_range_filter !!}
	                	@endif
	                	<div id="message">
	                		{!! Alert::show() !!}
	                	</div>
	                	<div>
	                		{!! $content !!}
						</div>
					</div>
				</div>
	        </div>
	    </div>
    </div>

    @include('admin::parts.footer')

</div>
</body>
</html>