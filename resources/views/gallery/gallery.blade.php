@extends('layouts.waters')

@section('title')
	Gallery  
@endsection

@section('content')
		<gallery 
			:auth="{{ Auth::user() }}" 
			:data="{{ $galleryHeaders->toJson() }}"
			:main="{{ Auth::user()->subscribed('main') }}"
			:admin="{{ Auth::user()->hasRole('admin') }}">
		</gallery>
@endsection