  
@extends('layouts.master')

@section('title')
	Trending Quotes
@endsection



@section('styles')
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
@endsection


@section('content')
	@if( !empty(Request::segment(1)))
		<section class="filter-bar">
			A filter has been set ! 
			<a href="{{ route('index') }}"> Show all quotes</a>
		</section>
	@endif
	@if(count($errors) > 0)
		<section class="info-box fail">
			<ul>
				@foreach($errors->all() as $error)
					{{ $error }}
				@endforeach
			</ul>
			
		</section>

	@endif

	@if( Session::has('success') )
		<section class="info-box success">
			{{ Session::get('success')}}
		</section>
	@endif

	<section class="quotes">
		<h1> Latest Quotes </h1>
		@for($i=0; $i<count($quotes);$i++)
			<article class="quote">
				<div class="delete">
					<a href="{{ route('delete', ['quote_id' => $quotes[$i]->id ] ) }}">x</a>
				</div>
				{{ $quotes[$i]->quote }}
				<div class="info">Created by <a href="{{ route('index',['author' => $quotes[$i]->author->name]) }}"> {{ $quotes[$i]->author->name }} </a> on {{$quotes[$i]->author->created_at}} </div>
			</article>
		@endfor
		<div class="pagination">
			@if( $quotes->currentPage() !==1 )
				<a href="{{ $quotes->previousPageUrl() }} "> 
					<span class="fa fa-caret-left"></span>
				 </a>
			@endif
			@if( $quotes->currentPage() !== $quotes->lastPage() && $quotes->hasPages())
				<a href="{{ $quotes->nextPageUrl() }} "> 
					<span class="fa fa-caret-right"></span>
				 </a>
			@endif
		</div>
	</section>

	<section class="edit-quote">
		<h1> Add a Quote</h1>
		<form method="post" action="{{ route('quote.postQuote') }}">
			<div class="input-group">
				<label for="author">Your name</label>
				<input type="text" name="author" id="author" placeholder="Your name"> </input>
			</div>
			<div class="input-group">
				<label for="email">Your email</label>
				<input type="text" name="email" id="email" placeholder="Your email"> </input>
			</div>
			<div class="input-group">
				<label for="quote">Your quote</label>
				<textarea name="quote" id="quote" placeholder="Your quote"> </textarea>
			</div>
			<button type="submit" class="btn">Submit Quote</button>
			<input type="hidden" name="_token" value = "{{ Session::token() }}">
		</form>
	</section>
@endsection