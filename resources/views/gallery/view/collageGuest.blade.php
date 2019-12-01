@extends('layouts.waters')

@section('title')
	Gallery collage 
@endsection

@section('content')
	<div class="margin-t container">
		<collage 
			:gallery-pictures="{{ $galleryPictures->toJson() }}"
			:gallery-header="{{ $galleryHeader->toJson() }}">
		</collage>
	</div>
@endsection