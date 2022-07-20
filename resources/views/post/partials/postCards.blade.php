{{-- $cardsData to access the posts by category thorugh controllers  --}}
{{-- $postsData to access the all posts thorugh controllers  --}}
<div class="container">
  <div class="row">
    <h1 class="text-left mt-4 mb-4 heading" style="font-weight: 600"> @if (isset($posts))
      All
      @else
      {{ $cardsData[0]->category[0]->category_Menu }}
      @endif Posts
    </h1>
  </div>
</div>

<div class="container mt-1 mb-3 px-2">
  <div class="row row-cols-1 row-cols-md-3 g-4">
    {{-- CARDS FOR CATEGORY WISE POSTS --}}
    @if (isset($cardsData))
    @foreach ($cardsData as $card)
    <div class="col">
      @postCard(['route'=>'posts.show', 'id'=>$card->id, 'media'=>$card->media, 'path' => $card->media->url(), 'title'=>$card->title, 
      'content'=>$card->content, 'createdAt'=>$card->created_at->diffForHumans(), 'comments'=>$card->comments->count()])
      @endpostCard
    </div>
    @endforeach

    {{-- CARDS FOR ALL POSTS --}}
    @else
    @foreach ($posts as $card)
    <div class="col">
      @postCard(['route'=>'posts.show', 'id'=>$card->id, 'media'=>$card->media, 'path' => $card->media->url(), 'title'=>$card->title, 
      'content'=>$card->content, 'createdAt'=>$card->created_at->diffForHumans(), 'comments'=>$card->comments->count()])
      @endpostCard
    </div>
    @endforeach
    @endif
  </div>
</div>