{{-- $posts to acccess posts related data from model via posts controller --}}
<?php
use App\Models\Posts;
    $comments = $posts->comments()->LatestComments()->get();
?>

    @singlePost(['posts' => $posts, 'Data' => $Data])
    @endsinglePost

<div class="container px-4 mb-4 comments_Container" id="comments_Container">
    @comments(['posts' => $posts, 'comments' => $comments])
    @endcomments
</div>

