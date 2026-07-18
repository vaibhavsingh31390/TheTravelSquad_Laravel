<div class="col-12 px-3 dataSection">
<div class="dash-likes-summary row g-3 mb-4">
<div class="col-sm-6">
<div class="stat-card">
<div class="stat-icon"><i class='bx bx-heart'></i></div>
<div class="stat-value">{{ number_format($totalLikes) }}</div>
<div class="stat-label">Total Likes</div>
</div>
</div>
<div class="col-sm-6">
<div class="stat-card">
<div class="stat-icon"><i class='bx bx-dislike'></i></div>
<div class="stat-value">{{ number_format($totalDislikes) }}</div>
<div class="stat-label">Total Dislikes</div>
</div>
</div>
</div>

<div class="table-wrapper-scroll-y my-custom-scrollbar">
<table class="table mb-0">
<thead>
<tr>
<th style="width: 8%" scope="col" class="text-center">#</th>
<th style="width: 42%" scope="col">Title</th>
<th style="width: 25%" scope="col" class="text-center">Likes</th>
<th style="width: 25%" scope="col" class="text-center">Dislikes</th>
</tr>
</thead>
<tbody>
@forelse ($posts as $post)
<tr>
<th class="text-center" style="width: 8%" scope="row">{{ $post->id }}</th>
<td style="width: 42%"><p class="mb-0 fw-bold" style="font-size: 0.85rem;">{{ Str::of($post->title)->limit(60) }}</p></td>
<td class="text-center" style="width: 25%">
<span class="dash-badge"><i class='bx bx-heart me-1'></i>{{ $likeCounts[$post->id] ?? 0 }}</span>
</td>
<td class="text-center" style="width: 25%">
<span class="dash-badge"><i class='bx bx-dislike me-1'></i>{{ $dislikeCounts[$post->id] ?? 0 }}</span>
</td>
</tr>
@empty
<tr>
<td colspan="4" class="text-center dash-empty">
<div class="dash-empty__icon" aria-hidden="true"><i class='bx bx-heart'></i></div>
<p class="dash-empty__title">No engagement yet</p>
<p class="dash-empty__text">Publish a post to start receiving likes from readers.</p>
<a href="#" class="btn btn-search toggleNewPost">Create Post</a>
</td>
</tr>
@endforelse
</tbody>
</table>
</div>
</div>
