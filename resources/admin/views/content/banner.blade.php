<?php
/**
 * Created by PhpStorm.
 * User: Kim
 * Date: 6/23/2015
 * Time: 9:02 AM
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
							<div class="tab" id="tab-1">
								<div class="form-group clearfix">
									<label class="col-sm-2 control-label">Tile 1 Picture</label>
									<div class="col-sm-5">
										<div class="fileinput fileinput-new" data-provides="fileinput">
											<div class="fileinput-new thumbnail">
												<img style="max-width:300px; max-height:300px;" src="{{ URL::asset('resources/assets/uploads/content/'.$edit_data->tile_1_picture) }}">
											</div>
											<div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;"></div>
											<div>
												<span class="btn btn-default btn-file">
													<span class="fileinput-new">Select image</span>
													<span class="fileinput-exists">Change</span>
													<input type="file" name="tile_1_picture">
												</span>
												<a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a>
												<p class="file-detail">For Best Resolution: 800x450 px</p>
											</div>
										</div>
									</div>
								</div>
								<div class="form-group clearfix">
									<label class="col-sm-2 control-label">Tile 1 Title</label>
									<div class="col-sm-5">
										{!! Form::text('tile_1_title', $edit_data->tile_1_title, array('class'=>'form-control', 'placeholder'=>'')) !!}
									</div>
								</div>
								<div class="form-group clearfix">
									<label class="col-sm-2 control-label">Tile 1 Button</label>
									<div class="col-sm-5">
										{!! Form::text('tile_1_button', $edit_data->tile_1_button, array('class'=>'form-control', 'placeholder'=>'')) !!}
									</div>
								</div>
								<div class="form-group clearfix">
									<label class="col-sm-2 control-label">Tile 1 Link</label>
									<div class="col-sm-5">
										{!! Form::text('tile_1_link', $edit_data->tile_1_link, array('class'=>'form-control', 'placeholder'=>'')) !!}
										<div class="form-suffix clearfix">with http://</div>
									</div>
								</div>
								<div class="form-group clearfix">
									<label class="col-sm-2 control-label">Tile 2 Picture</label>
									<div class="col-sm-5">
										<div class="fileinput fileinput-new" data-provides="fileinput">
											<div class="fileinput-new thumbnail">
												<img style="max-width:300px; max-height:300px;" src="{{ URL::asset('resources/assets/uploads/content/'.$edit_data->tile_2_picture) }}">
											</div>
											<div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;"></div>
											<div>
												<span class="btn btn-default btn-file">
													<span class="fileinput-new">Select image</span>
													<span class="fileinput-exists">Change</span>
													<input type="file" name="tile_2_picture">
												</span>
												<a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a>
												<p class="file-detail">For Best Resolution: 800x450 px</p>
											</div>
										</div>
									</div>
								</div>
								<div class="form-group clearfix">
									<label class="col-sm-2 control-label">Tile 2 Title</label>
									<div class="col-sm-5">
										{!! Form::text('tile_2_title', $edit_data->tile_2_title, array('class'=>'form-control', 'placeholder'=>'')) !!}
									</div>
								</div>
								<div class="form-group clearfix">
									<label class="col-sm-2 control-label">Tile 2 Button</label>
									<div class="col-sm-5">
										{!! Form::text('tile_2_button', $edit_data->tile_2_button, array('class'=>'form-control', 'placeholder'=>'')) !!}
									</div>
								</div>
								<div class="form-group clearfix">
									<label class="col-sm-2 control-label">Tile 2 Link</label>
									<div class="col-sm-5">
										{!! Form::text('tile_2_link', $edit_data->tile_2_link, array('class'=>'form-control', 'placeholder'=>'')) !!}
										<div class="form-suffix clearfix">with http://</div>
									</div>
								</div>
								<div class="form-group clearfix">
									<label class="col-sm-2 control-label">Tile 3 Picture</label>
									<div class="col-sm-5">
										<div class="fileinput fileinput-new" data-provides="fileinput">
											<div class="fileinput-new thumbnail">
												<img style="max-width:300px; max-height:300px;" src="{{ URL::asset('resources/assets/uploads/content/'.$edit_data->tile_3_picture) }}">
											</div>
											<div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;"></div>
											<div>
												<span class="btn btn-default btn-file">
													<span class="fileinput-new">Select image</span>
													<span class="fileinput-exists">Change</span>
													<input type="file" name="tile_3_picture">
												</span>
												<a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a>
												<p class="file-detail">For Best Resolution: 800x450 px</p>
											</div>
										</div>
									</div>
								</div>
								<div class="form-group clearfix">
									<label class="col-sm-2 control-label">Tile 3 Title</label>
									<div class="col-sm-5">
										{!! Form::text('tile_3_title', $edit_data->tile_3_title, array('class'=>'form-control', 'placeholder'=>'')) !!}
									</div>
								</div>
								<div class="form-group clearfix">
									<label class="col-sm-2 control-label">Tile 3 Button</label>
									<div class="col-sm-5">
										{!! Form::text('tile_3_button', $edit_data->tile_3_button, array('class'=>'form-control', 'placeholder'=>'')) !!}
									</div>
								</div>
								<div class="form-group clearfix">
									<label class="col-sm-2 control-label">Tile 3 Link</label>
									<div class="col-sm-5">
										{!! Form::text('tile_3_link', $edit_data->tile_3_link, array('class'=>'form-control', 'placeholder'=>'')) !!}
										<div class="form-suffix clearfix">with http://</div>
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