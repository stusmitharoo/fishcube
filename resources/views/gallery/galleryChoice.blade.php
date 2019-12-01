@extends('layouts.app')

@section('title')
	Gallery Choice 
@endsection

@section('content')
    <h4 class="words">Create a gallery</h4>
	<div class="row padding-s">
        <div class="col-xs-4 background "> 
            <a href="{{ route('gallery.style',['1'])}}">  
	        <div class="box">       
	            <img class="img-responsive image" src="/images/index/stilldefault.jpg" alt="stillwater angling"/>
	        </div>  
            
        </div>

        <div class="col-xs-4 background">
            <a href="{{ route('gallery.style',['3'])}}">
	        <div class="box">
	            <img class="img-responsive image" src="/images/index/riverdefault.jpg" alt="River angling "/>
	        </div>
            
        </div>

        <div class="col-xs-4 background">
            <a href="{{ route('gallery.style',['4'])}}">
	        <div class="box">
	            <img class="img-responsive image" src="/images/index/riverLuredefault.jpg" alt="Rivers fly and lures"/>
	        </div>
            
            </div>
    </div>
    <div class="row padding-s">
        <div class="col-xs-4 background">
         	<a href="{{ route('gallery.style',['2'])}}">
	        <div class="box">
	            <img class="img-responsive image" src="/images/index/stillLuredefault.jpg" alt="stillwaters fly and lures"/>
	        </div>
        
        </div>

        <div class="col-xs-4 background">
          	<a href="{{ url('/worldmap')}}">
            <div class="box">
                <img class="img-responsive image" src="/images/index/worldmap.jpg" alt="world map"/>
            </div>
		</div>

        <div class="col-xs-4 background">
         	<a href="{{ route('gallery.style',['5'])}}">
	        <div class="box">
	            <img class="img-responsive image" src="/images/index/canaldefault.jpg" alt="canal fishing"/>
	        </div>
        
        </div>

    </div>
    <div class="row padding-s">
        <div class="col-xs-4 background">
         	<a href="{{ route('gallery.style',['8'])}}">
	        <div class="box">
	            <img class="img-responsive image" src="/images/index/seaShoredefault.jpg" alt="sea shore fishing"/>
	        </div>
            
            </div>

        <div class="col-xs-4 background">
         	<a href="{{ route('gallery.style',['7'])}}">
			<div class="box">
				<img class="img-responsive image" src="/images/index/seaBoatdefault.jpg" alt="sea boat fishing"/>
			</div>
        </div>

        <div class="col-xs-4 background">
        	<a href="{{ route('gallery.style',['6'])}}">
	        <div class="box">
	            <img class="img-responsive image" src="/images/index/canalLuredefault.jpg" alt="world map"/>
	        </div>
        
        </div>
    </div>
@endsection