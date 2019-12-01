@extends('layouts.waters')

@section('title')
	Gallery  
@endsection

@section('content')
	@if(Auth::user())
		<gallery :auth="{{ Auth::user() }}" :gallery-headers="{{ $galleryHeader->toJson() }}"></gallery>
	@endif
	@if(Auth::guest())
		<gallery :gallery-headers="{{ $galleryHeader->toJson() }}"></gallery>
	@endif
@endsection