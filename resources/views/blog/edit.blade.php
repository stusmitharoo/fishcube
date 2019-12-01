@extends('layouts.app')

@section('title')
	FishCube create blog 
@endsection

@section('content')
		<blogedit :blog="{{ $blog->toJson() }}"></blogedit>
@endsection