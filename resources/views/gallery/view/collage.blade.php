@extends('layouts.waters')

@section('title')
	Gallery collage 
@endsection

@section('content')
	<div class="margin-t container">
		@if(Auth::user()->hasRole('admin'))
			<collage 
				:gallery-header="{{ $galleryHeader->toJson() }}"
				:gallery-pictures="{{ $galleryPictures->toJson() }}"
				:auth="{{ Auth::user() }}" 
				:main="{{ Auth::user()->subscribed('main') }}"
				:admin="{{ Auth::user()->hasRole('admin') }}">	
			</collage>
		@elseif(Auth::user()->subscribed('main'))
			<collage 
				:gallery-header="{{ $galleryHeader->toJson() }}"
				:gallery-pictures="{{ $galleryPictures->toJson() }}"
				:auth="{{ Auth::user() }}" 
				:main="{{ Auth::user()->subscribed('main') }}">	
			</collage>
		@else
			<collage 
				:gallery-header="{{ $galleryHeader->toJson() }}"
				:gallery-pictures="{{ $galleryPictures->toJson() }}"
				:auth="{{ Auth::user() }}">	
			</collage>
		@endif
	</div>
@endsection