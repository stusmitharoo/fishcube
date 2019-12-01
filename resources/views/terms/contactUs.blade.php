@extends('layouts.app')

@section('title')
	FishCube Worldmap 
@endsection

@section('content')
	<div class="container col-xs-12 col-sm-8 col-sm-offset-2">
		<div class="box-still ">
			<h3 class="words">Contact Form</h3>
			<form action="{{ route('terms.contactUs') }}" method="post">
				{{ csrf_field() }}
				<div class="form-group">
			    	<label class="words"><p>Subject</p></label>
					<select class="form-control margin-b" 
									name="subject"
									id="subject">
								<option>I want to report misuse of the sight</option>
								<option>I cant find the fish species</option>
								<option>I cant find the location in x style</option>
								<option>Problems with Login or register</option>
								<option>I want to unsubscribe</option>
								<option>Suggest a feature</option>
								<option>Other</option>
							</select>
				</div>
				<div class="form-group">
				    <label class="words"><p>Email</p></label>
					<input type="email" name="email" id="email" required="" value="{{ old('email') }}" class="form-control margin-b">
					@if ($errors->has('email'))
                        <span class="help-block">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
				</div>
				<div class="form-group">
					<label class="words"><p>Content (no more than 500 words)</p></label>
					<textarea
						rows="4"
						id="content"
						name="content"
						class="form-control"
						type="alphanum"
						maxlength="500"
						required=""
						value="{{ old('content') }}">
					</textarea>
					@if ($errors->has('email'))
                        <span class="help-block">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
				</div>
				<input type="submit" value="send" class="btn btn-warning btn-block words">		
			</form>
		</div>
	</div>
@endsection