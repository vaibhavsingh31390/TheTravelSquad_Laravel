 {{-- HERO SECTION --}}
 {{-- $postData to access all posts data inside the posts model via controllers --}}
 <div class="container mt-4 mb-4">
   <div class="row">
     <div class="col-sm-12 col-md-12 col-lg-12">
       <div id="carouselExampleControlsNoTouching" class="carousel slide carousel-fade hero_Carousel" data-bs-touch="false" data-bs-interval="false">
         <div class="carousel-inner">

           @foreach ($postsData as $IMG )
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
   <div class="row row-cols-1 row-cols-md-3 g-4" id="data-col">
     @foreach ($postsData->take(6) as $card)
     <div class="col">
      @postCard(['route'=>'posts.show', 'id'=>$card->id, 'imageUrl'=>$card->image_url, 'title'=>$card->title, 
      'content'=>$card->content, 'createdAt'=>$card->created_at->diffForHumans(), 'comments'=>$card->comments->count()])
      @endpostCard
     </div>
     @endforeach
   </div>
 </div>

 <div class="container">
   <div class="row">
     <div class="col-sm-12">
      <div class="load_More text-center">
          <button type="submit" class="btn load_MoreBtn mb-3 mt-1" id="load_More">Load More</button>
       </div>
     </div>
   </div>
 </div>


 <script>
  var countAmt = 6;
  $(document).ready(function () {
      $("#load_More").click(function (e) {
          // console.log('working');
          $(document).on({
              ajaxStart: function() { $("#load_More").text('Loading..');},
              ajaxStop: function() { $("#load_More").text('Load More'); }    
          });
          $.ajax({
              type: "POST",
              url: "/card-data",
              data: { load_Data: 'load_Data', _token: "{{ csrf_token() }}",count: countAmt},
              dataType: "json",
              success: function (data) {
                if(data.cards == ""){
                  $("#load_More").hide();
                }else{
                  $('#data-col').append(data.cards);
                }
                countAmt+=6;
              },
              error: function (error) {
                  console.log(error.responseText);
                  console.log('error');
              },
          });
      });
  });
</script>