@extends('layouts.app')

@section('title')
	search all galleries
@endsection

@section('content')
	<gallery-search-list :water="{{ $style->toJson() }}"></gallery-search-list>
@endsection