<div class="filter-bar">
<form action="{{ route('posts.search') }}" method="GET" class="archive-search-form {{ request('q') ? 'is-open' : '' }}" role="search">
<button type="button" class="search-btn" data-search-toggle aria-label="Search articles" aria-expanded="{{ request('q') ? 'true' : 'false' }}" aria-controls="archive-search-input">
<i class='bx bx-search'></i>
</button>
<div class="archive-search-field">
<input type="search" name="q" id="archive-search-input" class="archive-search-input" placeholder="Search articles…" value="{{ request('q', '') }}" autocomplete="off" required>
</div>
</form>
<div class="category-pills">
<a href="{{ route('posts.index') }}" class="category-pill {{ Route::is('posts.index') ? 'active' : '' }}">All</a>
@foreach ($category->unique() as $key)
<a href="{{ route('postByCategory', ['category' => $key]) }}" class="category-pill {{ request()->is("type/$key") ? 'active' : '' }}">{{ $key }}</a>
@endforeach
</div>
</div>
