@extends('layouts.app')

@section('title')
	FishCube admin panel 
@endsection

@section('content')
	<div class="container col-xs-12">
		<h3 class="words">Admin Panel</h3>
		<br>
		<div class="col-xs-12">
			<button class="col-xs-2 box">
                <h4>
                    <a href="/admin/contactForm" class="words"> Contact Form</a>
                </h4>
            </button>
		</div>
	</div>
@endsection