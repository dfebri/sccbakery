<div class="row {{ $group }}">
	<div class="col-xs-{{ $label_width }}">
		{!! Form::label($name, $label, $label_property) !!}
	</div>
	<div class="col-xs-{{ $input_width }}">
		@if($addon_prefix || $addon_suffix)
		<div class="input-group">
			@if($addon_prefix)
				<div class="input-group-addon">{!! $addon_prefix !!}</div>
			@endif
		@endif

		{!! Form::text($name, Input::old($name, $value), $property) !!}

		@if($addon_prefix || $addon_suffix)
			@if($addon_suffix)
				<div class="input-group-addon">{!! $addon_suffix !!}</div>
			@endif
			</div>
		@endif
		@if($suffix)
			<div class="form-suffix clearfix">
				{!! $suffix !!}
			</div>
		@endif
	</div>
</div>