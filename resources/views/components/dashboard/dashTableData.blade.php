<div class="col-lg-12 col-md-12 col-sm-12 px-3 dataSection">
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
                    <th style="width: 5%" scope="col" class="text-center">#</th>
                    <th style="width: 19%" scope="col">Title</th>
                    <th style="width: 39%" scope="col">Content</th>
                    <th style="width: 15%" scope="col">Category</th>
                    <th style="width: 20%" scope="col" class="text-center">Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($findPosts['findIt'] as $data)
                <tr data-id="{{ $data->id }}">
                    <th style="width: 2%" scope="col">
                        <form action="post">
                            @csrf
                            <input type="checkbox" class="custom-control-input" id="customCheck1"
                                data-id="{{ $data->id }}">
                        </form>
                    </th>
                    <th class="text-center" style="width: 5%" scope="row">
                        <p id="dataID">{{ $data->id }}</p></th>
                    <td style="width: 19%"><p>{{ Str::of($data->title )->limit(25)}}</p></td>
                    <td style="width: 39%"><p>{{ Str::of($data->content)->limit(55) }}</p></td>
                    <td style="width: 15%">
                        <p> {{ $data->category()->first()->category_Menu ?? 'No Category' }}</p>
                    </td>
                    <td class="text-center">
                        <form action="{{ route('posts.destroy', ['post'=>$data->id]) }}" method="post">
                            @csrf
                            @method('DELETE')
                            <a href="{{ route('user.Dashboard', ['action'=>'editPosts', 'id'=>$data->id]) }}">
                                <button data-id="{{ $data->id }}" type="button"
                                    class="btn btn-Dashboard">Edit</button>
                            </a> 
                            <a href="{{ route('posts.destroy', ['post' => $data->id]) }}">
                                <button data-id="{{ $data->id }}" type="submit"
                                    class="btn btn-Dashboard ms-4">Delete</button>
                                </a>
                        </form>
                    </td>
                <tr>
                    @empty
                <tr>
                    <th>
                        <h1 class="text-center">No Posts Created Please Create Your Very First Post <a href="{{ route('user.Dashboard', ['action' => 'newPosts']) }}">Post</a></h1>
                    </th>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
{{-- DATA SECTION ALL Posts [userDashboard/myPosts] --}}