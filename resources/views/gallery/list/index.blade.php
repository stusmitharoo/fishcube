@extends('layouts.app')

@section('title')
	List your'e galleries
@endsection

@section('content')
	<gallery-list :water="{{ $style->toJson() }}"></gallery-list>
@endsection