@component('mail::message')
# Like received on your post!

{{ $userAction->name }} liked your profile.
@component('mail::button', ['url' => route('posts.show', ['post' => $post->id ]), 'class' => 'Btn'])
See Post!
@endcomponent


@endcomponent
