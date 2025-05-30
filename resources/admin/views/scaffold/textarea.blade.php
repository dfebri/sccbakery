<div class="row {{ $group }}">
	<div class="col-xs-{{ $label_width }}">
		{!! Form::label($name, $label, $label_property) !!}
	</div>
	<div class="col-xs-{{ $input_width}}">
		{!! Form::textarea($name, Input::old($name, $value), $property); !!}

		@if($suffix)
			<div class="form-suffix clearfix">
				{!! $suffix !!}
			</div>
		@endif
	</div>
</div>