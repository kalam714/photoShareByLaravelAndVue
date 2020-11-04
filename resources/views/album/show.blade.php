@extends('layouts.app')

@section('content')
<div class="container">
    
            <div class="card">
               

                <div class="card-body">
                 <div class="row">
                 @foreach($albums as $album)
                 @foreach($album->allAlbumImages as $image)
                 <div class="col-lg-3 col-md-4 col-6">  
                 <a href="{{asset('images')}}/{{$image->image}}" data-lightbox="photos">
                 <img src="{{asset('images')}}/{{$image->image}}" class="img-fluid img-thumbnail">
                 </a>
                 </div>


                 @endforeach
                 @endforeach


                 </div>
                </div>
                <div class="col-md-12">
                <div class="card-body">
                @foreach($albums as $album)
                <h3><storng>{{$album->name}}</strong></h3>
                <p>{{$album->description}}</p>

                @endforeach

                </div>
                <div id="disqus_thread"></div>
<script>

/**
*  RECOMMENDED CONFIGURATION VARIABLES: EDIT AND UNCOMMENT THE SECTION BELOW TO INSERT DYNAMIC VALUES FROM YOUR PLATFORM OR CMS.
*  LEARN WHY DEFINING THESE VARIABLES IS IMPORTANT: https://disqus.com/admin/universalcode/#configuration-variables*/
/*
var disqus_config = function () {
this.page.url = PAGE_URL;  // Replace PAGE_URL with your page's canonical URL variable
this.page.identifier = PAGE_IDENTIFIER; // Replace PAGE_IDENTIFIER with your page's unique identifier variable
};
*/
(function() { // DON'T EDIT BELOW THIS LINE
var d = document, s = d.createElement('script');
s.src = 'https://photoshare-3.disqus.com/embed.js';
s.setAttribute('data-timestamp', +new Date());
(d.head || d.body).appendChild(s);
})();
</script>

                            






                </div>
        </div>
      
</div>
@endsection
