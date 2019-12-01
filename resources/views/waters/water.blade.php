@extends('layouts.waters')

@section('title')
	FishCube {{ $style->name }} 
@endsection

@section('content')
	@if(Auth::user())
		<water 
			:auth="{{ Auth::user() }}" 
			:main="{{ Auth::user()->subscribed('main') }}"
			:admin="{{ Auth::user()->hasRole('admin') }}" 
			:water="{{ $style->toJson() }}">
		</water>
	@endif
	@if(Auth::guest())
		<water :water="{{ $style->toJson() }}"></water>
	@endif
@endsection