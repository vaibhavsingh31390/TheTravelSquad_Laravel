<div class="mb-3">
<label for="postImage" class="form-label">Upload Thumbnail</label>
<input id="upload" name="postImage" type="file" class="form-control border-0">
</div>

<div class="mb-3">
<label for="title" class="form-label">Title</label>
<input type="text" class="form-control  {{ $errors->has('title') ? 'is-invalid' : '' }}"
id="title" name="title" value="{{ old('content', optional($post ?? null)->title) }}">
</div>

<div class="mb-3">
<label for="content" class="form-label">Content</label>
<textarea class="form-control" name="content" id="content" rows="7">{{ old('content', optional($post ?? null)->content) }}</textarea>
</div>

<div class="mb-0">
<input type="hidden" value="{{ encrypt(Auth::id()) }}" name="users_id" id="users_id">
</div>




