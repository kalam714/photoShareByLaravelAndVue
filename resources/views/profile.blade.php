@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
              

                <div class="card-body">
                <ul class="nav nav-tabs" role="tablist">
  
  <li class="nav-item">
    <a class="nav-link" href="#buzz" role="tab" data-toggle="tab">Following</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="#references" role="tab" data-toggle="tab">Profile picture</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="#coverPic" role="tab" data-toggle="tab">Cover Photo</a>
  </li>
</ul>

<!-- Tab panes -->
<div class="tab-content">

  <div role="tabpanel" class="tab-pane active" id="buzz">
  @foreach($followings as $following)
 <p> {{$following->userfollow->name}};
 <a href="{{route('user.album',[$following->userfollow->id])}}">
  <img src="{{Storage::url($following->userfollow->dp)}}" width="100px" height="100px"> 
  </a>
 </p>
 <p>
 @if(Auth::check() && auth()->user()->id !=$userId)
                <follow userId="{{$userId}}" follows="{{$follows}}"></follow>
                @endif
 </p>
  @endforeach
    
  </div>
  <div role="tabpanel" class="tab-pane fade" id="references">
  <avatar userid="{{auth()->user()->id}}"></avatar>
    
  </div>
  <div role="tabpanel" class="tab-pane fade" id="coverPic">
  <cover userid="{{auth()->user()->id}}"></cover>
    
  </div>
</div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
