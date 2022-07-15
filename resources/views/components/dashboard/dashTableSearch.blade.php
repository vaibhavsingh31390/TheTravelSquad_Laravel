<div class="col-lg-12 col-md-12 col-sm-12 px-3 dataSection findPosts">
    <div class="table-wrapper-scroll-y my-custom-scrollbar">
        <table class="table table-striped mb-0">
            <thead>
                <tr>
                    <th style="width: 2%" scope="col">
                        <form action="post">
                            @csrf
                            <input type="checkbox" class="custom-control-input" id="customCheck1">
                        </form>
                    </th>
                    <th style="width: 3%" scope="col" class="text-center">#</th>
                    <th style="width: 20%" scope="col">Title</th>
                    <th style="width: 40%" scope="col">Content</th>
                    <th style="width: 15%" scope="col">Category</th>
                    <th style="width: 20%" scope="col" class="text-center">Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($findPosts['findIt'] as $findPost)
                <tr data-id="{{ $findPost->id }}">
                    <th style="width: 2%" scope="col">
                        <form action="post">
                            @csrf
                            <input type="checkbox" class="custom-control-input" id="customCheck1"
                                data-id="{{ $findPost->id }}">
                        </form>
                    </th>
                    <th class="text-center" style="width: 3%" scope="row">{{ $findPost->id }}</th>
                    <td style="width: 20%">{{ Str::of($findPost->title)->words(5) }}</td>
                    <td style="width: 40%">{{ Str::of($findPost->content)->words(10) }}</td>
                    <td style="width: 15%">
                        <select data-id="{{ $findPost->id }}" class="form-select"
                            aria-label="Default select example">
                            <option value="Travel">Travel</option>
                            <option value="Technology">Technology</option>
                            <option value="Food">Food</option>
                            <option value="Movies">Movies</option>
                            <option value="Sports">Sports</option>
                            <option value="Others">Others</option>
                        </select>
                    </td>
                    <td class="text-center">
                        <form action="#" method="post" id="delete_edit_Form">
                            @csrf
                            @method('DELETE')
                                <button data-id="{{ $findPost->id }}" type="button" class="btn btn-Dashboard" id="edit_This_Post">Edit</button>
                                <button data-id="{{ $findPost->id }}" type="submit" class="btn btn-Dashboard ms-4" id="delete_This_Post">Delete</button>
                        </form>
                    </td>
                <tr>
                    @empty
                <tr>
                    <th>
                        <h1 class="text-center">No Posts found. <a href="{{ route('user.Dashboard', ['action'=>'newPosts']) }}">Create One!</a></h1>
                    </th>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
<script>
    $(".delete_edit_Form").submit(function(e) {
        e.preventDefault();
    });
</script>