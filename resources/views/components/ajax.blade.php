<?php
if (isset($_POST['requestType'])) {
    switch ($_POST['requestType']) {
        case 'load_Data':
        case 'load_Data_Category':
        ?>
            @foreach ($allCards as $card)
            <div class="col">
            @postCard(['route'=>'posts.show', 'id'=>$card->id, 'media'=>$card->media, 'path' => $card->media->url(), 'title'=>$card->title,
            'content'=>$card->content, 'createdAt'=>$card->created_at->diffForHumans(),
            'comments'=>$card->comments->count(), 'post'=>$card])
            @endpostCard
            </div>
            @endforeach
            <?php
        break;
        
        case 'posted_Comment':
        ?>
            @comments(['posts' => $posts, 'comments' => $comments])
            @endcomments
        <?php
        break;

        default:
            //
            break;
    }
}
?>



