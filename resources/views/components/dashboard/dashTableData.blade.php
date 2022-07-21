<div class="col-lg-12 col-md-12 col-sm-12 px-3 dataSection">
<div class="table-wrapper-scroll-y my-custom-scrollbar">
<table class="table table-striped mb-0">
<thead>
<tr>
<th style="width: 2%" scope="col">
<form action="post">
@csrf
<input type="checkbox" class="custom-control-input" id="check_All">
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
<input type="checkbox" class="custom-control-input check_One" id="check_One_Toggle"
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
<form class="delete_edit_Form" action="#" method="POST">
@csrf
@method('DELETE')
<button class="btn btn-Dashboard edit_This_Post" type="button" id="toggleEdit" data-id="{{ $data->id }}">Edit</button>
<button class="btn btn-Dashboard delete_This_Post ms-4" type="submit" id="toggleDelete" data-id="{{ $data->id }}">Delete</button>
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
