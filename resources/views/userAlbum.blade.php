@extends('layouts.app')

@section('content')
<div class="container">
   
    <img src="{{Storage::url($coverpic)}}" width="100%" height="100%">
   
    <br><br>
    @if(Auth::check() && auth()->user()->id !=$userId)
                <follow userId="{{$userId}}" follows="{{$follows}}"></follow>
     @endif
   
    <div class="row">
    @foreach($albums as $album)
    <div class="col-lg-3">
    <div class="card">
    <img src="{{asset('album')}}/{{$album->image}}" class="card-img-top">
    <div class="card-body">
    <h4 class="card-title" ><center>{{$album->name}}</center></h4>
    <center>
    <a href="{{route('album.image',[$album->slug,$album->id])}}" class="btn btn-success">View</a>
    </center>
    </div>

    </div>
    </div>
    @endforeach
</div>

</div>
@endsection
