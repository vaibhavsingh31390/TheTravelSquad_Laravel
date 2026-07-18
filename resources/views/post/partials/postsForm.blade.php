<div class="mb-3">
<label for="upload" class="form-label">Thumbnail</label>
<div class="thumbnail-upload" id="thumbnail-upload">
@if (isset($post) && $post->media)
<div class="thumbnail-upload__preview" id="thumbnail-preview">
<img src="{{ $post->media->url() }}" alt="Current thumbnail" id="thumbnail-preview-img">
</div>
@else
<div class="thumbnail-upload__preview d-none" id="thumbnail-preview">
<img src="" alt="Thumbnail preview" id="thumbnail-preview-img">
</div>
@endif
<div class="thumbnail-upload__controls">
<label for="upload" class="thumbnail-upload__btn">Choose image</label>
<input id="upload" name="postImage" type="file" accept="image/jpeg,image/png,image/gif,image/webp,image/svg+xml" class="thumbnail-upload__input">
<span class="thumbnail-upload__hint" id="thumbnail-filename">
@if (isset($post) && $post->media)
{{ basename($post->media->path) }}
@else
JPG, PNG, GIF, WebP, or SVG — optional
@endif
</span>
</div>
</div>
</div>

<div class="mb-3">
<label for="title" class="form-label">Title</label>
<input type="text" class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}"
id="title" name="title" value="{{ old('title', optional($post ?? null)->title) }}">
</div>

<div class="mb-3">
<label for="content" class="form-label">Content</label>
<p class="form-text text-muted mb-2">Use Visual mode for the toolbar, or switch to HTML to paste raw markup directly.</p>
<div class="rich-text-shell">
<div class="rich-text-mode-tabs" role="tablist" aria-label="Editor mode">
<button type="button" class="rich-text-mode-btn active" data-mode="visual" role="tab" aria-selected="true">Visual</button>
<button type="button" class="rich-text-mode-btn" data-mode="html" role="tab" aria-selected="false">HTML</button>
</div>
<div class="rich-text-panel rich-text-panel--visual" id="content-editor-visual">
<div id="content-editor" class="rich-text-editor"></div>
</div>
<div class="rich-text-panel rich-text-panel--html d-none" id="content-editor-html">
<textarea id="content-html" class="rich-text-html" rows="14" spellcheck="false" placeholder="Paste or write HTML here — headings, lists, images, blockquotes…"></textarea>
</div>
<textarea class="d-none" name="content" id="content" aria-hidden="true">{{ old('content', optional($post ?? null)->content) }}</textarea>
</div>
</div>

<div class="mb-3">
<label for="tags" class="form-label">Tags</label>
<div class="tags-field">
<input type="text" class="tags-input" id="tags" value="{{ old('tags', collect(optional($post ?? null)->tags)->pluck('name')->join(', ')) }}" placeholder="Type to search or add tags…" autocomplete="off">
<input type="hidden" name="tags" id="tags-value" value="{{ old('tags', collect(optional($post ?? null)->tags)->pluck('name')->join(', ')) }}">
<div id="tags-autocomplete" class="tags-autocomplete d-none" role="listbox" aria-label="Tag suggestions"></div>
</div>
<small class="form-text text-muted">Up to 8 tags — type to search, click a suggestion, or press Enter to add.</small>
@if (isset($popularTags) && $popularTags->isNotEmpty())
<div class="tag-suggestions" aria-label="Popular tags">
<span class="tag-suggestions__label">Popular</span>
<div class="tag-suggestions__list">
@foreach ($popularTags->take(12) as $tag)
<button type="button" class="tag-suggestion-pill" data-tag="{{ $tag->name }}">#{{ $tag->name }}</button>
@endforeach
</div>
</div>
@endif
</div>

<div class="mb-0">
<input type="hidden" value="{{ encrypt(Auth::id()) }}" name="users_id" id="users_id">
</div>
