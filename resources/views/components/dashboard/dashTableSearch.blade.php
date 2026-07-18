<div class="col-12 px-3 dataSection findPosts">
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
<input type="checkbox" class="form-check-input check_One" id="check_One_Toggle" data-id="{{ $findPost->id }}">
</form>
</th>
<th class="text-center" style="width: 3%" scope="row">{{ $findPost->id }}</th>
<td style="width: 20%" class="fw-bold text-uppercase" style="font-size: 0.8rem;">{{ Str::of($findPost->title)->words(5) }}</td>
<td style="width: 40%" class="dash-table-muted" style="font-size: 0.8rem;">{{ Str::of(strip_tags($findPost->content))->words(10) }}</td>
<td style="width: 15%">
<span class="dash-badge">{{ $findPost->category()->first()->category_Menu ?? 'None' }}</span>
</td>
<td class="text-center">
<form action="#" method="post" id="delete_edit_Form" class="d-inline-flex gap-2 justify-content-center">
@csrf
@method('DELETE')
<button class="btn btn-Dashboard edit_This_Post" type="button" id="toggleEdit" data-id="{{ $findPost->id }}">Edit</button>
<button class="btn btn-Dashboard delete_This_Post" type="submit" id="toggleDelete" data-id="{{ $findPost->id }}">Delete</button>
</form>
</td>
</tr>
@empty
<tr>
<td colspan="6" class="text-center dash-empty">
<div class="dash-empty__icon" aria-hidden="true"><i class='bx bx-search-alt'></i></div>
<p class="dash-empty__title">No results</p>
<p class="dash-empty__text">Try a different search term or create a new post.</p>
<a href="#" class="btn btn-search toggleNewPost">Create Post</a>
</td>
</tr>
@endforelse
</tbody>
</table>
</div>
</div>
