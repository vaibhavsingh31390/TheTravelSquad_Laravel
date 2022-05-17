<?php
    use App\Models\Posts;
    if(isset($_GET['id'])){
    $id=$_GET['id'];
    $post = Posts::find($id);
    }
?>
            @csrf
            <div class="mb-3">
                <label for="image_url" class="form-label">Image (url/hosted links only)</label>
                <input type="text" class="form-control  {{ $errors->has('image_url') ? 'is-invalid' : '' }}"
                    id="title" name="image_url" value="{{ old('image_url', optional($post ?? null)->image_url) }}">
            </div>
            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" class="form-control  {{ $errors->has('title') ? 'is-invalid' : '' }}"
                    id="title" name="title" value="{{ old('title', optional($post  ?? null)->title) }}">
            </div>
            <div class="mb-3">
                <label for="content" class="form-label">Content</label>
                <textarea class="form-control" name="content" id="Textarea1" rows="10">{{ old('content', optional($post  ?? null)->content) }}</textarea>
            </div>
            <div class="mb-0">
            <input type="hidden" value="{{ Auth::id() }}" name="users_id">
            </div>




