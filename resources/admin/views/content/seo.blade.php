<!DOCTYPE html>
<html lang="en">
<head>
@include('admin::parts/head')
<script>
$(function(){
	$("#tab-nav a").click(function(){
		$(".tab").hide();
		$($(this).attr('href')).show();
		$(".current").removeClass('current');
		$(this).parents('li').addClass('current');

		return false;
	});
	$("#tab-nav a:first").trigger('click');
});
</script>
</head>
<body>
<div id="full-container">
	@include('admin::parts/menu')
	<div id="page-info">
		<div class="container">
			<div class="row">
				<div class="col-xs-6">
					<h1><?php echo $page_title;?></h1>
				</div>
				<div class="col-xs-6">
					<div class="btn-holder">
						<a href="#" class="btn btn-info save-button" onclick="return submit_form();"><i class="glyphicon glyphicon-floppy-disk"></i> Save</a>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="container">
        <ul id='breadcrumbs'><li class="last"><a href='{{ URL::route('admin_slideshow') }}'><i class="glyphicon glyphicon-home"></i></a></li></ul>
    </div>

    <div class="container">
    	<div class="row">
	    	<div class="col-xs-2">
                <div class="sidebar">
                    <ul id="tab-nav">
                        <li class="current"><a href="#tab-1">+ Home Page</a></li>
                        <li><a href="#tab-2">+ About Page</a></li>
                        <li><a href="#tab-3">+ Contact Page</a></li>
                        <li><a href="#tab-4">+ Industrial Line Page</a></li>
                        <li><a href="#tab-5">+ Product Page</a></li>
                        <li><a href="#tab-6">+ Why Choose Us Page</a></li>
                        <li><a href="#tab-7">+ Meet Our Supplier Page</a></li>
                        <li><a href="#tab-8">+ Upcoming Events Page</a></li>
                    </ul>
                </div>
            </div>
	    	<div class="col-xs-10">
	            <div class="portlet">
	                <div class="portlet-header">
	                    <h4>Edit Form</h4>
						<i class="icsw16-graph icsw16-white pull-right"></i>
	                </div>
	                <div class="portlet-content cnt_b">
	                    <div id="message">{!! Alert::get('success') !!}</div>
						<div id="userinteract">
						{!! Form::open(array('files'=>true, 'id'=>'form-scaffold'), 'POST') !!}
							<div class="tab" id="tab-1">
								<div class="form-group clearfix">
									<label class="col-sm-2 control-label">Home Meta Title</label>
									<div class="col-sm-5">
										{!! Form::text('home_meta_title', $edit_data->home_meta_title, array('class'=>'form-control', 'placeholder'=>'')) !!}
									</div>
								</div>
								<div class="form-group clearfix">
									<label class="col-sm-2 control-label">Home Meta Keyword</label>
									<div class="col-sm-5">
										{!! Form::text('home_meta_keyword', $edit_data->home_meta_keyword, array('class'=>'form-control', 'placeholder'=>'')) !!}
									</div>
								</div>
								<div class="form-group clearfix">
									<label class="col-sm-2 control-label">Home Meta Description</label>
									<div class="col-sm-5">
										{!! Form::text('home_meta_description', $edit_data->home_meta_description, array('class'=>'form-control', 'placeholder'=>'')) !!}
									</div>
								</div>
							</div>

							<div class="tab" id="tab-2">
								<div class="form-group clearfix">
									<label class="col-sm-2 control-label">About Meta Title</label>
									<div class="col-sm-5">
										{!! Form::text('about_meta_title', $edit_data->about_meta_title, array('class'=>'form-control', 'placeholder'=>'')) !!}
									</div>
								</div>
								<div class="form-group clearfix">
									<label class="col-sm-2 control-label">About Meta Keyword</label>
									<div class="col-sm-5">
										{!! Form::text('about_meta_keyword', $edit_data->about_meta_keyword, array('class'=>'form-control', 'placeholder'=>'')) !!}
									</div>
								</div>
								<div class="form-group clearfix">
									<label class="col-sm-2 control-label">About Meta Description</label>
									<div class="col-sm-5">
										{!! Form::text('about_meta_description', $edit_data->about_meta_description, array('class'=>'form-control', 'placeholder'=>'')) !!}
									</div>
								</div>
								
							</div>

							<div class="tab" id="tab-3">
								<div class="form-group clearfix">
									<label class="col-sm-2 control-label">Contact Meta Title</label>
									<div class="col-sm-5">
										{!! Form::text('contact_meta_title', $edit_data->contact_meta_title, array('class'=>'form-control', 'placeholder'=>'')) !!}
									</div>
								</div>
								<div class="form-group clearfix">
									<label class="col-sm-2 control-label">Contact Meta Keyword</label>
									<div class="col-sm-5">
										{!! Form::text('contact_meta_keyword', $edit_data->contact_meta_keyword, array('class'=>'form-control', 'placeholder'=>'')) !!}
									</div>
								</div>
								<div class="form-group clearfix">
									<label class="col-sm-2 control-label">Contact Meta Description</label>
									<div class="col-sm-5">
										{!! Form::text('contact_meta_description', $edit_data->contact_meta_description, array('class'=>'form-control', 'placeholder'=>'')) !!}
									</div>
								</div>
							</div>

							<div class="tab" id="tab-4">
                                <div class="form-group clearfix">
                                    <label class="col-sm-2 control-label">Industrial Meta Title</label>
                                    <div class="col-sm-5">
                                        {!! Form::text('industrial_meta_title', $edit_data->industrial_meta_title, array('class'=>'form-control', 'placeholder'=>'')) !!}
                                    </div>
                                </div>
                                <div class="form-group clearfix">
                                    <label class="col-sm-2 control-label">Industrial Meta Keyword</label>
                                    <div class="col-sm-5">
                                        {!! Form::text('industrial_meta_keyword', $edit_data->industrial_meta_keyword, array('class'=>'form-control', 'placeholder'=>'')) !!}
                                    </div>
                                </div>
                                <div class="form-group clearfix">
                                    <label class="col-sm-2 control-label">Industrial Meta Description</label>
                                    <div class="col-sm-5">
                                        {!! Form::text('industrial_meta_description', $edit_data->industrial_meta_description, array('class'=>'form-control', 'placeholder'=>'')) !!}
                                    </div>
                                </div>
                            </div>

							<div class="tab" id="tab-5">
                                <div class="form-group clearfix">
                                    <label class="col-sm-2 control-label">Product Meta Title</label>
                                    <div class="col-sm-5">
                                        {!! Form::text('product_meta_title', $edit_data->product_meta_title, array('class'=>'form-control', 'placeholder'=>'')) !!}
                                    </div>
                                </div>
                                <div class="form-group clearfix">
                                    <label class="col-sm-2 control-label">Product Meta Keyword</label>
                                    <div class="col-sm-5">
                                        {!! Form::text('product_meta_keyword', $edit_data->product_meta_keyword, array('class'=>'form-control', 'placeholder'=>'')) !!}
                                    </div>
                                </div>
                                <div class="form-group clearfix">
                                    <label class="col-sm-2 control-label">Product Meta Description</label>
                                    <div class="col-sm-5">
                                        {!! Form::text('product_meta_description', $edit_data->product_meta_description, array('class'=>'form-control', 'placeholder'=>'')) !!}
                                    </div>
                                </div>
                            </div>

                            <div class="tab" id="tab-6">
                                <div class="form-group clearfix">
                                    <label class="col-sm-2 control-label">Why Choose Us Meta Title</label>
                                    <div class="col-sm-5">
                                        {!! Form::text('why_meta_title', $edit_data->why_meta_title, array('class'=>'form-control', 'placeholder'=>'')) !!}
                                    </div>
                                </div>
                                <div class="form-group clearfix">
                                    <label class="col-sm-2 control-label">Why Choose Us Meta Keyword</label>
                                    <div class="col-sm-5">
                                        {!! Form::text('why_meta_keyword', $edit_data->why_meta_keyword, array('class'=>'form-control', 'placeholder'=>'')) !!}
                                    </div>
                                </div>
                                <div class="form-group clearfix">
                                    <label class="col-sm-2 control-label">Why Choose Us Meta Description</label>
                                    <div class="col-sm-5">
                                        {!! Form::text('why_meta_description', $edit_data->why_meta_description, array('class'=>'form-control', 'placeholder'=>'')) !!}
                                    </div>
                                </div>
                            </div>

                            <div class="tab" id="tab-7">
                                <div class="form-group clearfix">
                                    <label class="col-sm-2 control-label">Meet Our Suppliers Meta Title</label>
                                    <div class="col-sm-5">
                                        {!! Form::text('meet_meta_title', $edit_data->meet_meta_title, array('class'=>'form-control', 'placeholder'=>'')) !!}
                                    </div>
                                </div>
                                <div class="form-group clearfix">
                                    <label class="col-sm-2 control-label">Products Meta Keyword</label>
                                    <div class="col-sm-5">
                                        {!! Form::text('meet_meta_keyword', $edit_data->meet_meta_keyword, array('class'=>'form-control', 'placeholder'=>'')) !!}
                                    </div>
                                </div>
                                <div class="form-group clearfix">
                                    <label class="col-sm-2 control-label">Products Meta Description</label>
                                    <div class="col-sm-5">
                                        {!! Form::text('meet_meta_description', $edit_data->meet_meta_description, array('class'=>'form-control', 'placeholder'=>'')) !!}
                                    </div>
                                </div>
                            </div>

                            <div class="tab" id="tab-8">
                                <div class="form-group clearfix">
                                    <label class="col-sm-2 control-label">Upcoming Meta Title</label>
                                    <div class="col-sm-5">
                                        {!! Form::text('upcoming_meta_title', $edit_data->upcoming_meta_title, array('class'=>'form-control', 'placeholder'=>'')) !!}
                                    </div>
                                </div>
                                <div class="form-group clearfix">
                                    <label class="col-sm-2 control-label">Products Meta Keyword</label>
                                    <div class="col-sm-5">
                                        {!! Form::text('upcoming_meta_keyword', $edit_data->upcoming_meta_keyword, array('class'=>'form-control', 'placeholder'=>'')) !!}
                                    </div>
                                </div>
                                <div class="form-group clearfix">
                                    <label class="col-sm-2 control-label">Products Meta Description</label>
                                    <div class="col-sm-5">
                                        {!! Form::text('upcoming_meta_description', $edit_data->upcoming_meta_description, array('class'=>'form-control', 'placeholder'=>'')) !!}
                                    </div>
                                </div>
                            </div>

							<input type="hidden" name="save" value="1"/>
						{!! Form::close() !!}
						</div>
					</div>
	            </div>
	        </div>
	    </div>
    </div>
    @include('admin::parts/footer')
</div>
</body>
</html>