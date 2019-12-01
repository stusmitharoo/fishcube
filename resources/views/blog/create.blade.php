@extends('layouts.app')

@section('title')
	FishCube create blog 
@endsection

@section('content')
	<blogconstructor 
		:data="{{ $style->toJson() }}" 
		url="{{url('/')}}"
		subdirectory="blog">
	</blogconstructor>
@endsection