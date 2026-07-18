@foreach ($allCards as $card)
<div class="col d-flex">
@postCard([
    'route' => 'posts.show',
    'id' => $card->id,
    'media' => $card->media,
    'path' => $card->media?->url(),
    'title' => $card->title,
    'content' => $card->content,
    'createdAt' => $card->created_at->format('M d, Y'),
    'comments' => $card->comments->count(),
    'post' => $card,
    'categoryName' => $card->category()->first()->category_Menu ?? 'Travel',
    'tags' => $card->tags,
])
@endpostCard
</div>
@endforeach
