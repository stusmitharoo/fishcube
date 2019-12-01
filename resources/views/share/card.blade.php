@extends('layouts.share')

@section('title')
  FishCube share card 
@endsection

@section('meta')
@endsection

@section('content')
 <sharecard :user="{{ $user->toJson() }}" :data="{{ $card->toJson() }}"></sharecard>
@endsection

@section('script')
  <script>(function(d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0]
      if (d.getElementById(id)) return
      js = d.createElement(s); js.id = id
      js.src = 'https://connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v2.11&appId=193142197923337';
      fjs.parentNode.insertBefore(js, fjs)
    }(document, 'script', 'facebook-jssdk'))
  </script>
@endsection