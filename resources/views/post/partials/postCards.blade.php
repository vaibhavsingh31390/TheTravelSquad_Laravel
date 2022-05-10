
<div class="container">
  <div class="row">
    <h1 class="text-left mt-4 heading" style="font-weight: 600">  @if (isset($posts))
      All
      @else
      {{ $CARDS[0]->category[0]->category_Menu }}
    @endif Posts</h1>
  </div>
</div>

<div class="container mt-1 mb-3 px-2">
    <div class="row row-cols-1 row-cols-md-3 g-4">
      @if (isset($posts))
        @foreach ($posts as $CARD)
        <div class="col">
            <div class="card h-100 border">
              <div class="image-Img">
                <a href="{{ route('posts.show', [$CARD->id]) }}">
                  <img src="{{ $CARD->image_url }}" class="card-img-top">
                </a>
              </div>
              <div class="card-body">
                <h4 class="card-title">{{ $CARD->title }}</h4>
                <p class="card-text" style="text-overflow: ellipsis;
                overflow: hidden;
                white-space: nowrap;">{{ $CARD->content }}</p>
              </div>
              <div class="card-footer">
                <small class="date_Added">{{ $CARD->created_at->diffForHumans() }}</small>
              </div>
            </div>
          </div>
        @endforeach

      @else

          @foreach ($CARDS as $CARD)
          <div class="col">
              <div class="card h-100 border">
                <div class="image-Img">
                  <a href="{{ route('posts.show', [$CARD->id]) }}">
                    <img src="{{ $CARD->image_url }}" class="card-img-top">
                  </a>
                </div>
                <div class="card-body">
                  <h4 class="card-title">{{ $CARD->title }}</h4>
                  <p class="card-text" style="text-overflow: ellipsis;
                  overflow: hidden;
                  white-space: nowrap;">{{ $CARD->content }}</p>
                </div>
                <div class="card-footer">
                  <small class="date_Added">{{ $CARD->created_at->diffForHumans() }}</small>
                </div>
              </div>
            </div>
          @endforeach
      @endif

      </div>
</div>