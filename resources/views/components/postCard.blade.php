<div class="card h-100 border">
    <div class="image-Img">
      <a href="{{ route("$route", [$id]) }}">
        <img src="{{ $imageUrl }}" class="card-img-top">
      </a>
    </div>
    <div class="card-body">
      <h4 class="card-title">{{ Str::of($title)->limit(40) }}</h4>
      <p class="card-text" style="text-overflow: ellipsis;
              overflow: hidden;
              white-space: nowrap;">{{ $content }}</p>
    </div>
    <div class="card-footer d-flex justify-content-between">
      <small class="date_Added">{{ $createdAt }}</small>
      <small class="date_Added">{{ $comments }} commments</small> 
    </div>
  </div>