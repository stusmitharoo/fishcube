@extends('layouts.app')

@section('title')
	Gallery Edit 
@endsection

@section('content')
	<galleryedit :data="{{ $galleryHeader->toJson() }}"></galleryedit>
@endsection