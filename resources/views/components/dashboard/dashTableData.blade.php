<div class="col-12 px-3 dataSection">
<div class="table-wrapper-scroll-y my-custom-scrollbar">
<table class="table mb-0">
<thead>
<tr>
<th style="width: 2%" scope="col">
<form action="post">
@csrf
<input type="checkbox" class="form-check-input" id="check_All">
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
<input type="checkbox" class="form-check-input check_One" id="check_One_Toggle" data-id="{{ $data->id }}">
</form>
</th>
<th class="text-center" style="width: 5%" scope="row">
<p id="dataID" class="mb-0">{{ $data->id }}</p>
</th>
<td style="width: 19%"><p class="mb-0 fw-bold text-uppercase" style="font-size: 0.8rem;">{{ Str::of($data->title)->limit(20) }}</p></td>
<td style="width: 39%"><p class="mb-0 dash-table-muted" style="font-size: 0.8rem;">{{ Str::of(strip_tags($data->content))->limit(50) }}</p></td>
<td style="width: 15%">
<span class="dash-badge">{{ $data->category()->first()->category_Menu ?? 'None' }}</span>
</td>
<td class="text-center">
<form class="delete_edit_Form d-inline-flex gap-2 justify-content-center" action="#" method="POST">
@csrf
@method('DELETE')
<button class="btn btn-Dashboard edit_This_Post" type="button" id="toggleEdit" data-id="{{ $data->id }}">Edit</button>
<button class="btn btn-Dashboard delete_This_Post" type="submit" id="toggleDelete" data-id="{{ $data->id }}">Delete</button>
</form>
</td>
</tr>
@empty
<tr>
<td colspan="6" class="text-center dash-empty">
<div class="dash-empty__icon" aria-hidden="true"><i class='bx bx-file-blank'></i></div>
<p class="dash-empty__title">No posts yet</p>
<p class="dash-empty__text">Create your first story and share it with the squad.</p>
<a href="#" class="btn btn-search toggleNewPost">Create Post</a>
</td>
</tr>
@endforelse
</tbody>
</table>
</div>
</div>
