 {{-- HERO SECTION --}}
 {{-- $postData to access all posts data inside the posts model via controllers --}}
 <div class="container mt-4 mb-4">
   <div class="row">
     <div class="col-sm-12 col-md-12 col-lg-12">
       <div id="carouselExampleControlsNoTouching" class="carousel slide carousel-fade hero_Carousel" data-bs-touch="false" data-bs-interval="false">
         <div class="carousel-inner">

           @foreach ($postsData->slice(0, 5) as $IMG )
           @if ($loop->first)
           <div class="carousel-item active">
            <a href="{{ route('posts.show', [$IMG->id]) }}">
             <img src="{{ $IMG->image_url }}" class="d-block w-100" alt="...">
            </a>
           </div>
           @else
           <div class="carousel-item">
            <a href="{{ route('posts.show', [$IMG->id]) }}">
              <img src="{{ $IMG->image_url }}" class="d-block w-100" alt="...">
             </a>
           </div>
           @endif

           @endforeach

         </div>
         <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControlsNoTouching" data-bs-slide="prev">
           <span class="carousel-control-prev-icon" aria-hidden="true"></span>
           <span class="visually-hidden">Previous</span>
         </button>
         <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControlsNoTouching" data-bs-slide="next">
           <span class="carousel-control-next-icon" aria-hidden="true"></span>
           <span class="visually-hidden">Next</span>
         </button>
       </div>
     </div>
   </div>
 </div>

 <div class="container">
   <div class="row">
     <h1 class="text-left mt-4 heading" style="font-weight: 600"> Popular Posts</h1>
   </div>
 </div>

 <div class="container mt-1 mb-3 px-2">
   <div class="row row-cols-1 row-cols-md-3 g-4">
     @foreach ($postsData->slice(0, 3) as $card)
     <div class="col">
       <div class="card h-100 border">
         <div class="image-Img">
           <a href="{{ route('posts.show', [$card->id]) }}">
             <img src="{{ $card->image_url }}" class="card-img-top">
           </a>
         </div>
         <div class="card-body">
           <h4 class="card-title">{{ $card->title }}</h4>
           <p class="card-text" style="text-overflow: ellipsis;
                overflow: hidden;
                white-space: nowrap;">{{ $card->content }}</p>
         </div>
         <div class="card-footer">
           <small class="date_Added">{{ $card->created_at->diffForHumans() }}</small>
         </div>
       </div>
     </div>
     @endforeach
   </div>
 </div>

 <div class="container">
   <div class="row">
     <div class="col-sm-12">
      <div class="load_More text-center">
        <a href="#">
          <button type="submit"
              class="btn load_MoreBtn mb-3 mt-1" id="loadMore">Load More</button>
          </a>
       </div>
     </div>
   </div>
 </div>


