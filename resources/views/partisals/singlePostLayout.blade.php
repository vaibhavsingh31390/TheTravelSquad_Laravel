{{-- $posts to acccess posts related data from model via posts controller --}}
<?php
use App\Models\Posts;
    $comments = $posts->comments()->LatestComments()->get();
?>

@singlePost(['posts' => $posts, 'Data' => $Data])
@endsinglePost

@comments(['posts' => $posts, 'comments' => $comments])
@endcomments



