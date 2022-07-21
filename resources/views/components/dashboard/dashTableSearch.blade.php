<div class="col-lg-12 col-md-12 col-sm-12 px-3 dataSection findPosts">
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
<input type="checkbox" class="custom-control-input check_One" id="check_One_Toggle"
data-id="{{ $findPost->id }}">
</form>
</th>
<th class="text-center" style="width: 3%" scope="row">{{ $findPost->id }}</th>
<td style="width: 20%">{{ Str::of($findPost->title)->words(5) }}</td>
<td style="width: 40%">{{ Str::of($findPost->content)->words(10) }}</td>
<td style="width: 15%">
<p> {{ $findPost->category()->first()->category_Menu ?? 'No Category' }}</p>
</td>
<td class="text-center">
<form action="#" method="post" id="delete_edit_Form">
@csrf
@method('DELETE')
<button class="btn btn-Dashboard edit_This_Post" type="button" id="toggleEdit" data-id="{{ $findPost->id }}">Edit</button>
<button class="btn btn-Dashboard delete_This_Post ms-4" type="submit" id="toggleDelete" data-id="{{ $findPost->id }}">Delete</button>
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