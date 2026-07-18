<div class="col-12 newPost dash-welcome">
<div class="content_wrapper">
<div class="welcome-card">
<h1>Welcome, {{ $authenticated_User->name ?? 'Traveler' }}</h1>
<p>Manage your posts and share your next adventure.</p>
</div>
<div class="row g-3">
<div class="col-sm-4">
<div class="stat-card">
<div class="stat-icon"><i class='bx bx-file'></i></div>
<div class="stat-value">{{ auth()->user()->posts()->count() }}</div>
<div class="stat-label">Total Posts</div>
</div>
</div>
<div class="col-sm-4">
<div class="stat-card stat-card--action toggleNewPost" role="button" tabindex="0">
<div class="stat-icon"><i class='bx bx-plus-circle'></i></div>
<div class="stat-value">+</div>
<div class="stat-label">New Post</div>
</div>
</div>
<div class="col-sm-4">
<div class="stat-card stat-card--action toggleTotalLikes" role="button" tabindex="0">
<div class="stat-icon"><i class='bx bx-trending-up'></i></div>
<div class="stat-value">{{ number_format(\App\Models\Posts::totalLikesForUser(auth()->id())) }}</div>
<div class="stat-label">Total Likes</div>
</div>
</div>
</div>
</div>
</div>
