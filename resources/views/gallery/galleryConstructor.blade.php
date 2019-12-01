@extends('layouts.app')

@section('title')
	Gallery Constructor
@endsection

@section('content')
	<galleryconstructor :data="{{ $card->toJson() }}"></galleryconstructor>
@endsection