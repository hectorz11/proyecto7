<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Subscribe to Newsletter</title>
	<style>
	
		body{
			margin: 0;
			font-family: Arial,Tahoma,sans-serif;
			text-align: center;
			padding-top: 60px;
			color: #666;
			font-size: 24px
		}
		input{ font-size: 18px }
		input[type=text] { width: 300px }
		div.content { padding-top: 24px; font-weight: 700; font-size: 24px}
		.success { color: #0b0 }
		.error { color: #b00 }
	</style>
</head>
<body>
	{{-- Form Starts Here --}}
	{{Form::open(array('url'=> URL::to('subscribers/submit'),'method' => 'post'))}}
	<p>Simple Newsletter Subscription</p>
	{{Form::text('email',null,array('placeholder'=>'Type your E-mail address here'))}}
	{{Form::submit('Submit!')}}
	{{Form::close()}}

	{{-- Form Ends Here --}}
	{{-- This div will show the ajax response --}}

	<div class="content"></div>
	{{-- Because it'll be sent over AJAX, We add thejQuery source --}}
	{{ HTML::script('http://code.jquery.com/jquery-1.8.3.min.js') }}
	<script type="text/javascript">
	//A pesar de que está en pie de página, me gusta para asegurarse de que DOM está listo
		$(function(){

			$('div.content').hide();

			$('input[type="submit"]').click(function(e){
				e.preventDefault();
				$.post('/subscribers/submit', {
					email: $('input[name="email"]').val()
				}, function($data){
				if($data=='1') {
					$('div.content').hide().removeClass
					('success error').addClass('success').html
					('You\'ve successfully subscribed to our
					newsletter').fadeIn('fast');
				} else {
					$('div.content').hide().removeClass
					('success error').addClass('error').html
					('There has been an error occurred:<br />
					<br />'+$data).fadeIn('fast');
				}
				});
			});

			$('form').submit(function(e){
				e.preventDefault();
				$('input[type="submit"]').click();
			});
		});
	</script>
</body>
</html>
