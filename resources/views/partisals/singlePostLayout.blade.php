{{-- $posts to acccess posts related data from model via posts controller --}}
@singlePost(['posts' => $posts, 'author' => $author, 'comments' => $comments])
@endsinglePost
<div class="container px-4 mb-4 comments_Container" id="comments_Container">
@comments(['posts' => $posts, 'comments' => $comments])
@endcomments
</div>

