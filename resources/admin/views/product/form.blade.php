<!DOCTYPE html>
<html lang="en">
<head>

@include('admin::parts.head')
<base href="/">
{{--
	<link rel="stylesheet" type="text/css" href="{{ URL::asset($asset_path.'css/dropzone.css')}}">
<link rel="stylesheet" type="text/css" href="{{ URL::asset($asset_path.'css/uploadify.css')}}">
<script type="text/javascript" src="{{ URL::asset($asset_path.'js/jquery.uploadify.min.js')}}"></script>
<script type="text/javascript" src="{{ URL::asset($asset_path.'js/dropzone.js')}}"></script>--}}

<script type="text/javascript">
	$(function(){

        $("#save-button").click(function () {
            $("#postAction").val(1);
            return submit_form('form');
        });

        $("#saveExit-button").click(function () {
            $("#postAction").val(0);
            return submit_form('form');
        });

		//--Auto Focus on first field
		$('.enter_execute form-control').first().focus();

		$("#tab-nav a").click(function(){
			$(".tab").hide();
			$($(this).attr('href')).show();
			$(".current").removeClass('current');
			$(this).parents('li').addClass('current');

			return false;
		});
		$("#tab-nav a:first").trigger('click');

		var checkChild      = $('.check-child');
		var checkParent     = $('.check-parent');

		@if($action == 'edit')
		// $('#fileupload').uploadify({
		// 	'swf'      		: '{{ URL::asset($asset_path."uploadify/uploadify.swf")}}',
		// 	'uploader' 		: '{{ URL::to("_admin/product_image?act=upload")."&id=".$data->id }}',
		// 	'buttonText' 	: 'BROWSE...',
		// 	'fileTypeDesc'  : 'Image Files',
    //     	'fileTypeExts'  : '*.gif; *.jpg; *.jpeg; *.png',
    //     	'formData'		: {
    //     	    '_token':'{{ csrf_token() }}',
    //     	    'id':'{{ $data->id }}'
    //     	},
		// 	"onUploadSuccess" : function(file, result, response) {
		// 		result =  $.parseJSON(result)
		// 		if(!result.error){
	  //           	var base = '<div class="image-list">';
		// 				base += '<div class="img" style="background:url();"></div>';
		// 				base += '<div class="action">';
		// 				base += '<a class="ajax default" title="Set as default" href=""><i class="glyphicon glyphicon-ok"></i></a> ';
		// 				base += '<a class="ajax publish" title="Set as default" href=""><i class="glyphicon glyphicon-eye-open"></i></a> ';
		// 				base += '<a class="ajax delete" title="Set as default" href=""><i class="glyphicon glyphicon-trash"></i></a> ';
		// 				base += '</div>';
		// 				base += '</div>';
		//
	  //           	var display_img = $(base);
		//
    //         		$(".img", display_img).attr('style', "background-image: url('"+result.thumb_url+"');");
	  //           	$(".publish", display_img).attr('href', result.publish_url).addClass('on');
	  //           	$(".default", display_img).attr('href', result.default_url).removeClass('on');
	  //           	$(".delete", display_img).attr('href', result.delete_url);
		//
	  //           	$("#image-list .row").append(display_img);
		//
	  //           }else{
	  //           	var queue = $("#"+file.id);
		//             	$(".uploadify-progress-bar", queue).css({'background-color': 'red'});
		//             	queue.append('<div style="color:#c6ff84;margin-top:5px;">'+result.message+'</div>');
	  //           }
	  //       }
		// });


		$(document).on('click', '.ajax', function(){
			var clicked   = $(this);
			var url  	  = clicked.attr('href');
			var wrapp 	  = clicked.parents('.image-list');
			var yes		  = true;

			if(clicked.hasClass('delete')){
				yes = confirm("Are you sure to delete this file?");
			}

			if(yes){
				$.get(url, function(response){
					if(response.success == true ){
						if(clicked.hasClass('default')){
							if(response.status == 1){
								$(".default.on").removeClass('on');
								$(".default", wrapp).addClass('on');
							}else{
								$(".default", wrapp).removeClass('on');
							}
						}else{
							if(clicked.hasClass('publish')){
								if(response.status == 1){
									clicked.addClass('on');
								}else{
									clicked.removeClass('on');
								}
							}else{ // has class delete
								wrapp.fadeOut('slow', function(){$(this).remove();});
							}
						}
					}else{
						alert('Failed to process!');
					}
				});
			}

			return false;
		});
		@endif
	});
</script>
</head>
<body>
<div id="full-container">
	@include('admin::parts.menu')

	<div id="page-info">
		<div class="container">
			<div class="row">
				<div class="col-xs-8">
					<h1>{{ $page_title}}</h1>
				</div>
				<div class="col-xs-4">
					<div class="btn-holder">
						<a id="save-button" href="{{ URL::to('_admin/product/save') }}" class="btn btn-primary"><i class="glyphicon glyphicon-floppy-disk"></i> Save</a>
						<a id="saveExit-button" href="#" class="btn btn-info"><i class="glyphicon glyphicon-floppy-disk"></i> Save and Exit</a>
						<a id="save-button" href="{{ URL::to('_admin/product')}}" class="btn btn-default"> &laquo; Back</a>
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
    		<div class="col-xs-2">
                <div class="sidebar">
                    <ul id="tab-nav">
                        <li class="current"><a href="#tab-1">+ Product Details</a></li>
                        <li><a href="#tab-2">+ Images</a></li>
                    </ul>
                </div>
            </div>
	    	<div class="col-xs-10">
	            <div class="portlet">
	                <div class="portlet-header">
	                    <h4>{!! ucfirst($action) !!} Form</h4>
	                </div>
	                <div class="portlet-content cnt_b">

						<div id="message">{!! Alert::show() !!}</div>

						<div id="userinteract">
							<form id="form" method="post" enctype="multipart/form-data" action="">
							<input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input type="hidden" id="postAction" name="postAction" />
							<div class="tab" id="tab-1">
								<h2>Product Details</h2>
								<div class="row">
									<div class="col-xs-3">
										<label id="tablerow_label">Product Name <span class="markrequired">*</span></label>
									</div>
									<div class="col-xs-5">
										{!! Form::text('name', Input::old('name', isset($data->name) ? $data->name : ''), array('class' => 'enter_execute form-control')) !!}
									</div>
								</div>
								<div class="row">
									<div class="col-xs-3">
										<label id="tablerow_label">Subtitle<span class="markrequired">*</span></label>
										<label id="tablerow_label"><span style="font-style: italic;font-size: 12px;">*15 chars max</span></label>
									</div>
									<div class="col-xs-5">
										{!! Form::text('subtitle', Input::old('name', isset($data->subtitle) ? $data->subtitle: ''), array('class' => 'enter_execute form-control')) !!}
									</div>
								</div>
								<div class="row">
									<div class="col-xs-3">
										<label id="tablerow_label">Category <span class="markrequired">*</span></label>
									</div>
									<div class="col-xs-5">
										<select name="category_id" class="form-control">
										    <option selected=selected> - Select category - </option>

										    @foreach ($category_list as $brand)
                                                <option {{isset($data->category_id) ? $data->category_id== $brand->id ? 'selected="selected"' : "" : "" }} value="{{$brand->id}}">{{$brand->name}}</option>
                                            @endforeach
										</select>
									</div>
								</div>
								<div class="row">
									<div class="col-xs-3">
										<label id="tablerow_label">Brand Name <span class="markrequired">*</span></label>
									</div>
									<div class="col-xs-5">
										<select name="brand_id" class="form-control">
										    <option selected=selected> - Select Brand - </option>

										    @foreach ($brand_list as $brand)
                                                <option {{isset($data->brand_id) ? $data->brand_id == $brand->id ? 'selected="selected"' : "" : "" }} value="{{$brand->id}}">{{$brand->name}}</option>
                                            @endforeach
										</select>
									</div>
								</div>
								<div class="row">
									<div class="col-xs-3">
										<label id="tablerow_label">Displayed <span class="markrequired">*</span></label>
									</div>
									<div class="col-xs-5">
										{!! Form::radio('publish', '1', Input::old('publish', isset($data->publish) ? $data->publish : '' ) == 1) !!} Yes
										{!! Form::radio('publish', '0', Input::old('publish', isset($data->publish) ? $data->publish : '' ) == 0) !!} No
									</div>
								</div>
								<div class="row">
									<div class="col-xs-3">
										<label id="tablerow_label">Description <span class="markrequired">*</span></label>
									</div>
									<div class="col-xs-5">
										{!! Form::textarea('description', Input::old('description', isset($data->description) ? $data->description : ''), array('class'=>"wysiwyg") ) !!}
									</div>
								</div>
								<div class="row">
                                    <div class="col-xs-3">
                                        <label id="tablerow_label">Video</label>
                                    </div>
                                    <div class="col-xs-5">
                                        {!! Form::text('video', Input::old('name', isset($data->video) ? $data->video : ''), array('class' => 'enter_execute form-control')) !!}
                                    </div>
                                </div>
							</div>

							<div class="tab" id="tab-2">
								<h2 id="h2tabs">Images</h2>
								<div>
                                @if($action == 'add')
                                    <div class="alert alert-warning">
                                        Please save product first before adding images.
                                    </div>
                                @else
<!--																 <div class="row test" style="display: block;">-->
<!--	<div class="col-xs-3">-->
<!--		<label for="img">Picture</label>-->
<!--	</div>-->
<!--	<div class="col-xs-5">-->
<!--		<div class="fileinput fileinput-new" data-provides="fileinput">-->
<!--		  	<div class="fileinput-new thumbnail" style="max-width: 200px; max-height: 150px;">-->
<!--		    	<img style="width: 100%;" src="http://sccbakery.com/resources/assets/images/none.png">-->
<!--		  	</div>-->
<!--		  	<div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;">-->

<!--		  				  	</div>-->
<!--		  	<div>-->
<!--		    	<span class="btn btn-default btn-file">-->
<!--		    		<span class="fileinput-new">Select File</span>-->
<!--		    		<span class="fileinput-exists">Change</span>-->
<!--		    		<input type="file" name="img">-->
<!--		    	</span>-->
<!--		    	<a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a>-->
<!--		    			    	<p class="file-detail">Select Images (900 x 900 px)</p>-->
<!--		    			  	</div>-->
<!--		</div>-->


<!--	</div>-->
<!--</div> -->
                                    <div id="tablerow">
                                        <div id="tablecol" class="labelin">
                                            <label id="tablerow_label">Select Images (900 x 900 px)</label>
                                        </div>
                                        <div id="tablecol" class="inputfield">
                                            <input type="file" name="img[]" id="img" multiple="true" class="fileupload">
                                        </div>
                                        <div class="clear"></div>
                                    </div>
                                </div>

                                <div id="image-list">
                                    <div class="row">
                                        <?php
                                        foreach($data->images as $images){
                                        ?>
                                        <div class="image-list">
                                            <div class="img" style="background:url('{{ URL::asset('resources/assets/uploads/products/'.$product_admin_size.'/'.$images->img)}}') center center no-repeat;"></div>
                                            <div class="action">
                                                <a class="ajax default{{ $images->as_default ?' on':''}}" title="Set as default" href="{{ URL::to('_admin/product_image?act=default&id='.$images->id)}}"><i class="glyphicon glyphicon-ok"></i></a>
                                                <a class="ajax publish{{ $images->publish ?' on':''}}" title="Publish/Unpublish" href="{{ URL::to('_admin/product_image?act=publish&id='.$images->id)}}"><i class="glyphicon glyphicon-eye-open"></i></a>
                                                <a class="ajax delete" title="Delete image" href="{{ URL::to('_admin/product_image?act=delete&id='.$images->id)}}"><i class="glyphicon glyphicon-trash"></i></a>
                                            </div>
                                        </div>
                                        <?php
                                        }
                                        ?>
                                    </div>
                                </div>
                                @endif
                            </div>
							</div>


								<input type="hidden" name="action" value="{{ $action}}">
								<input type="hidden" name="submit_save" value="1">
								@if($action=='edit')
									<input type="hidden" name="id" value="{{ $data->id}}">
								@endif
							</form>
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
