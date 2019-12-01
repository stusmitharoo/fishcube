@extends('layouts.waters')

@section('title')
	FishCube view anglers profile 
@endsection

@section('content')
	@if(Auth::user())
		<viewprofile 
			:auth="{{ Auth::user() }}" 
			:main="{{ Auth::user()->subscribed('main') }}"
			:admin="{{ Auth::user()->hasRole('admin') }}" 
			:card="{{ $card->toJson() }}">
		</viewprofile>
	@endif
	@if(Auth::guest())
		<viewprofile :card="{{ $card->toJson() }}"></viewprofile>
	@endif
@endsection