<?php
/**
 * Created by PhpStorm.
 * User: Kim
 * Date: 6/23/2015
 * Time: 10:36 AM
 */
?>
<!DOCTYPE html>
<html lang="en">
<head>
@include('admin::parts/head')
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
        {!! $breadcrumb !!}
    </div>

    <div class="container">
    	<div class="row">
	    	<div class="col-xs-12">
	            <div class="portlet">
	                <div class="portlet-header">
	                    <h4>Edit Form</h4>
						<i class="icsw16-graph icsw16-white pull-right"></i>
	                </div>
	                <div class="portlet-content cnt_b">
	                    <div id="message">{!! Alert::get('success') !!}</div>
						<div id="userinteract">
						{!! Form::open(array('files'=>true, 'id'=>'form-scaffold'), 'POST') !!}
                            <div class="tab" id="tab-4">
                                <div class="form-group clearfix">
                                    <label class="col-sm-2 control-label">Video Title</label>
                                    <div class="col-sm-5">
                                        {!! Form::text('home_video_title', $edit_data->home_video_title, array('class'=>'form-control', 'placeholder'=>'')) !!}
                                    </div>
                                </div>
                                <div class="form-group clearfix">
                                    <label class="col-sm-2 control-label">Video Link</label>
                                    <div class="col-sm-5">
                                        {!! Form::text('home_video', $edit_data->home_video, array('class'=>'form-control', 'placeholder'=>'only video code ex:6sSynyd')) !!}
                                    </div>
                                </div>
                                <div class="form-group clearfix">
                                    <label class="col-sm-2 control-label">Video Description</label>
                                    <div class="col-sm-5">
                                        {!! Form::textarea('home_video_description', $edit_data->home_video_description, array('class'=>'form-control wysiwyg', 'placeholder'=>'')) !!}
                                    </div>
                                </div>
								<div class="form-group clearfix">
									<label class="col-sm-2 control-label">Video Link</label>
									<div class="col-sm-5">
										{!! Form::text('home_check_our_video', $edit_data->home_check_our_video, array('class'=>'form-control', 'placeholder'=>'with Http://')) !!}
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