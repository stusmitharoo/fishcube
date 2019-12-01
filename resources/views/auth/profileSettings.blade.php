@extends('layouts.app')
@section('title')
    FishCube profile settings
@endsection
@section('content')
    <div class="col-sm-8 col-sm-offset-2 col-xs-12">
        <div class="box-still margin-s">
            <div class="margin-l">
                <h3 class="words">Update your Profile Details</h3>
            </div>
            <form enctype="multipart/form-data" class="form-horizontal" role="form" method="POST" action="{{ route('profileSettings.update') }}">
                                {{ csrf_field() }}  
                <div class="margin-s">
                    <label for="name" class="words">Name</label>
                        <input value="{{ $user->name }}" id="name" type="text" class="form-control" name="name" required="" maxlength="50">
                </div>
            
                <div class="margin-s">
                    <label for="email" class="words">Update Email</label>
                        <input value="{{ $user->email}}" id="email" type="email" class="form-control" name="email" required="" maxlength="100">
                </div>
                @if (Auth::user()->hasExpertSubscription('expert'))
                    <div class="margin-s">
                        <label for="email" class="words">Profile State</label>
                        <div class="margin-l col-xs-12 btn-group" data-toggle="buttons">
                          <label class="btn btn-primary active">
                            <input type="radio" name="view" id="view" autocomplete="off" value="1" checked> Public
                          </label>
                          <label class="btn btn-primary">
                            <input type="radio" name="view" id="view" autocomplete="off" value="0"> Private
                          </label>
                        </div>    
                    </div>
                @endif

                <div class="margin-s margin-t">
                    <input type="submit" name="Update Profile" class=" words btn btn-warning btn-block">
                </div>
            </form>{{-- 
            <div class="margin-s margin-t">
                <a class="words btn btn-primary" href="{{ route('password.request') }}">
                                            Reset Your Password?</a>
            </div> --}}
        </div> 
    </div>
@endsection
