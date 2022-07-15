            <div class="mb-2">
                @errors
                @enderrors
            </div>
            
            @csrf
            <div class="mb-3">
                <label for="postImage" class="form-label">Upload Thumbnail</label>
                <input id="upload" name="postImage" type="file" class="form-control border-0">
            </div>

            <div class="mb-3">
                <label for="category_Menu" class="form-label">Category</label>
                <select name="category_Menu" class="form-select {{ $errors->has('title') ? 'is-invalid' : '' }}"
                    aria-label="Default select example">
                    <option value="Travel">Travel</option>
                    <option value="Technology">Technology</option>
                    <option value="Sports">Sports</option>
                    <option value="Food">Food</option>
                    <option value="Fashion">Fashion</option>
                    <option value="Others">Others</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" class="form-control  {{ $errors->has('title') ? 'is-invalid' : '' }}"
                    id="title" name="title" value="{{ old('title', optional($post  ?? null)->title) }}">
            </div>

            <div class="mb-3">
                <label for="content" class="form-label">Content</label>
                <textarea class="form-control" name="content" id="Textarea1" rows="7">{{ old('content', optional($post  ?? null)->content) }}</textarea>
            </div>

            <div class="mb-0">
            <input type="hidden" value="{{ encrypt(Auth::id()) }}" name="users_id" id="">
            </div>




