<div class="col-lg-12 col-md-12 col-sm-12 px-3 newPost">
    <div class="content_wrapper p-3">
        <h2>New Post</h2>
        <form action="{{ route('posts.store') }}" method="post">
            @csrf
            <div class="mb-3">
                <label for="image_url" class="form-label">Image (url/hosted links only)</label>
                <input type="text" class="form-control  {{ $errors->has('name') ? 'is-invalid' : '' }}"
                    id="title" name="image_url">
            </div>
            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" class="form-control  {{ $errors->has('name') ? 'is-invalid' : '' }}"
                    id="title" name="title">
            </div>
            <div class="mb-3">
                <label for="content" class="form-label">Content</label>
                <textarea class="form-control" name="content" id="Textarea1" rows="3"></textarea>
            </div>
            <div class="mb-0">
            <input type="hidden" value="{{ Auth::id() }}" name="users_id">
            </div>
            {{-- <div class="mb-3">
                <label for="Status" class="form-label">Status</label>
                <select data-id="temp" class="form-select" name="Status">
                    <option selected value="active">Active</option>
                    <option value="inactive">Inactive</option>
                </select>
            </div> --}}
            <button type="submit" class="btn btn-search w-25">Save</button>
        </form>
    </div>
</div>

