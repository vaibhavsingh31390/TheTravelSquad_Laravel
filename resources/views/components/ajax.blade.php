
<?php
if (isset($_POST['load_Data'])) {
    ?>
        @foreach ($allCards as $card)
        <div class="col">
            @postCard(['route'=>'posts.show', 'id'=>$card->id, 'imageUrl'=>$card->image_url, 'title'=>$card->title,
            'content'=>$card->content, 'createdAt'=>$card->created_at->diffForHumans(),
            'comments'=>$card->comments->count()])
            @endpostCard
        </div>
        @endforeach
        <?php
}
if (isset($_POST['posted_Comment'])) {
    ?>
            @comments(['posts' => $posts, 'comments' => $comments])
            @endcomments
        <?php
}
?>

