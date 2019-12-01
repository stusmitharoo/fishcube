@extends('layouts.waters')

@section('meta')
	
        
@endsection

@section('title')
	FishCube profile 
@endsection

@section('content')
	@if(Auth::user()->hasRole('admin'))
		<profile 
			:auth="{{ Auth::user() }}" 
			:main="{{ Auth::user()->subscribed('main') }}"
			:admin="{{ Auth::user()->hasRole('admin') }}">
		</profile>
	@elseif(Auth::user()->subscribed('main'))
		<profile 
			:auth="{{ Auth::user() }}" 
			:main="{{ Auth::user()->subscribed('main') }}">
		</profile>
	@else
		<profile 
			:auth="{{ Auth::user() }}">
		</profile>
	@endif
@endsection

@section('script')
@endsection
