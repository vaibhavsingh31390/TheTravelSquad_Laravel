@singlePost(['posts' => $posts, 'author' => $author, 'comments' => $comments])
@endsinglePost

<section class="post-layout comments_Container pb-5" id="comments_Container">
@comments(['posts' => $posts, 'comments' => $comments])
@endcomments
</section>
