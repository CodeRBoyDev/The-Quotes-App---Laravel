@extends('layouts.master')



@section('content')
	@if(count($errors) > 0)
		<section class="info-box fail">
			<ul>
				@foreach($errors->all() as $error)
					{{ $error }}
				@endforeach
			</ul>
			
		</section>

	@endif

	@if(Session::has('fail'))
		<section class="info-box fail">
			{{ Session::get('fail') }}
		</section>
	@endif
	<form action=" {{ route('admin.login') }} " method="post">
		
		<div class="input-group">
			<label for="name">Your name</label>
			<input type="text" name="name" id="name" placeholder="Your name"> </input>
		</div>

		<div class="input-group">
			<label for="password">Your password</label>
			<input type="password" name="password" id="password" placeholder="Your password"> </input>
		</div>

		<button type="submit">Login</button>
		<input type="hidden" name="_token" value="  {{ Session::token() }} "/>

	</form>
@endsection