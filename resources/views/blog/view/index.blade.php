@extends('layouts.app')

@section('title')
	FishCube blog listings
@endsection

@section('content')
	<list-view-blogs :water="{{ $style->toJson() }}"></list-view-blogs>
@endsection