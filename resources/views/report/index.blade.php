@extends('layouts.app')

@section('title')
	Predetor & prey report
@endsection

@section('content')
	<report :water="{{ $style->toJson() }}"></report>
@endsection