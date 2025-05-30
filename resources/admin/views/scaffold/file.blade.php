<div class="row {{ $group }}">
	<div class="col-xs-{{ $label_width }}">
		{!! Form::label($name, $label, $label_property) !!}
	</div>
	<div class="col-xs-{{ $input_width }}">
		<div class="fileinput fileinput-{{ empty($value) ? 'new' : 'exists'}}" data-provides="fileinput">
		  	<div class="fileinput-new thumbnail" style="max-width: 200px; max-height: 150px;">
		    	<img style="width: 100%;" src="{{ URL::asset('resources/assets/images/none.png')}}">
		  	</div>
		  	<div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;">
		  		@if($value && strstr($value, 'data:image'))
		  			<img style="width: 100%;" src="{{ $value }}">
		  		@else
		  			{{ $value }}
		  		@endif
		  	</div>
		  	<div>
		    	<span class="btn btn-default btn-file">
		    		<span class="fileinput-new">Select File</span>
		    		<span class="fileinput-exists">Change</span>
		    		<input type="file" name="{{ $name }}">
		    	</span>
		    	<a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a>
		    	@if(isset($file_notes))
		    	<p class="file-detail">{!! $file_notes !!}</p>
		    	@endif
		  	</div>
		</div>
	
		@if($suffix)
			<div class="form-suffix clearfix">
				{!! $suffix !!}
			</div>
		@endif

	</div>
</div>