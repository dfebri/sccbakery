<div class="row {!! $group !!}">
	<div class="col-xs-{!! $label_width !!}">
		{!! Form::label($name, $label, $label_property) !!}
	</div>
	<div class="col-xs-{!! $input_width !!}">
		@foreach($option as $val => $text)
			@php $checked = in_array($val, (array)$value)
			@if($inline)
				<label class="checkbox-inline">
			@else
				<div class="checkbox">
					<label>
			@endif

			{!! Form::checkbox($name."[]", $val, $checked, $property) !!} {!! $text !!}
			
			@if($inline)
				</label>
			@else
                    </label>
				</div>
			@endif
		@endforeach
		@if($suffix)
			<div class="form-suffix clearfix">
				{!! $suffix !!}
			</div>
		@endif
	</div>
</div>