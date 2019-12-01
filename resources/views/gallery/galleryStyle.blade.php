@extends('layouts.app')

@section('title')
	Gallery Constructor
@endsection

@section('content')
	<galleryconstructor :choice="{{ $style->toJson() }}"></galleryconstructor>
@endsection