@extends('layouts.waters')

@section('title')
	Gallery Slideshow 
@endsection

@section('content')
	<div class="margin-t container">
		@if(Auth::user()->hasRole('admin'))
			<flip 
				:gallery-header="{{ $galleryHeader->toJson() }}"
				:auth="{{ Auth::user() }}" 
				:main="{{ Auth::user()->subscribed('main') }}"
				:admin="{{ Auth::user()->hasRole('admin') }}">	
			</flip>
		@elseif(Auth::user()->subscribed('main'))
			<flip 
				:gallery-header="{{ $galleryHeader->toJson() }}"
				:auth="{{ Auth::user() }}" 
				:main="{{ Auth::user()->subscribed('main') }}">	
			</flip>
		@else
			<flip 
				:gallery-header="{{ $galleryHeader->toJson() }}"
				:auth="{{ Auth::user() }}">	
			</flip>
		@endif
	    <div id="myCarousel" class="carousel slide" data-ride="carousel"> 
	        <!-- Wrapper for carousel items -->
	        <div class="carousel-inner">
	            <div class="item active">
	                <img class="img-responsive image-gallery image-corners box-flip" src="/images/cards/{{$galleryHeader->image}}" alt="{{$galleryHeader->name}}">
	                <h3 class="words-gallery">{{$galleryHeader->name}}</h3>
	            </div>
	            @foreach($galleryPictures as $galleryPicture)
	            <div class="item">
	                <img class="img-responsive image-gallery image-corners box-flip" src="/images/cards/{{$galleryPicture->image}}" alt="{{$galleryPicture->name}}">
	                <h3 class="words-gallery">{{$galleryPicture->name}}</h3>
	            </div>
	            @endforeach
	        </div>
	        <!-- Carousel controls -->
	        <a class="words carousel-control left" href="#myCarousel" data-slide="prev">
	            <span class="glyphicon glyphicon-chevron-left"></span>
	        </a>
	        <a class="words carousel-control right" href="#myCarousel" data-slide="next">
	            <span class="glyphicon glyphicon-chevron-right"></span>
	        </a>
	    </div>
	</div>
@endsection