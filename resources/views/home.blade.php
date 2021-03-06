@extends('layouts.app')

@section('content')
<div class="container">
    <div class="jumbotron jumbotron-fluid">
    <h5 class="display-4">Share Your Photos</h5>
    <p class="lead">Share Your Photos With The People</p>
    </div>
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
{{$albums->links()}}
</div>
@endsection
