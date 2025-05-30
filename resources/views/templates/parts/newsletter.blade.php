<script type="text/javascript">
$(function(){
	$('#newsletter-form').submit(function(){
		$.ajax({
			type: "POST",
			url: "{{URL::route('dosubscribe')}}",
			data: {
			    'email':$('input[name=email]').val(),
                '_token': '{{ csrf_token() }}'
			}
		})
		.done(function(data){
			data	= jQuery.parseJSON(data);
			if(data.class == "error"){
				$('.subscribe-text').addClass(data.class);
				$('.subscribe-text').html(data.message.email);
			}else{
				$('.subscribe-text').addClass(data.class);
				$('.subscribe-text').html(data.message.email);
				$('#newsletter-form').html('<p class="newsletter-thankyou center">THANK YOU FOR SUBSCRIBING. WE WILL REPLY YOU SOON!</p>');
			}
			$('.error-box').fadeIn('fast');
			$('.error-box-mobile').fadeIn('fast');
		})
		.fail(function(){
			alert('Failed');
		});

		return false;
	});
});
</script>
<div id="newsletter">
	<div class="container">
		{!! Form::open(array('id'=>'newsletter-form','method'=>'POST')) !!}
		<div class="row clearfix">
            <div class="col-md-6">
                <p class="newsletter-notes"><span>BE THE FIRST TO HEAR FROM US !</span> SUBSCRIBE FOR OUR NEWSLETTER</p>
            </div>
            <div class="col-md-6 pos-relative">
                {!! Form::text('email', Input::old('email'), array('class'=>'form-control', 'placeholder'=>'enter your email address...')) !!}
                {!! Form::submit('SUBSCRIBE', array('class'=>'form-control')) !!}
                <div class="desktop">
                    <div class="error-box">
                        <span class="up-arrow"></span>
                        <p class="subscribe-text"></p>
                    </div>
                </div>
                <div class="mobile">
                    <div class="error-box-mobile">
                        <p class="subscribe-text"></p>
                    </div>
                </div>
            </div>
        </div>
		{!! Form::close() !!}
	</div>
</div>