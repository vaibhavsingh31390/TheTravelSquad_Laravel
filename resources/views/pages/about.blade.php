@extends('partisals.layout')
@section('title', 'About Us | The Travel Squad')
@section('meta_description', 'Learn about The Travel Squad — a community-driven travel publication sharing destination guides, stories, and practical tips from explorers around the world.')
@section('canonical_url', route('pages.about'))
@section('structured_data')
<script type="application/ld+json">
{!! json_encode([
    '@context' => 'https://schema.org',
    '@type' => 'AboutPage',
    'name' => 'About The Travel Squad',
    'description' => 'Community-driven travel stories and destination guides.',
    'url' => route('pages.about'),
    'isPartOf' => [
        '@type' => 'WebSite',
        'name' => config('app.name', 'The Travel Squad'),
        'url' => url('/'),
    ],
], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) !!}
</script>
@endsection
@section('section')
<article class="page-wrap static-page py-5">
<header class="section-header mb-4">
<p class="static-eyebrow">Our story</p>
<h1 class="heading">About The Travel Squad</h1>
<p class="section-subtitle">Stories worth the journey — written by travellers, for travellers.</p>
</header>

<div class="static-content">
<p>The Travel Squad is an independent travel publication built around one idea: the best trip advice comes from people who have actually been there. Our writers share honest destination guides, food discoveries, cultural notes, and practical planning tips you can use on your next adventure.</p>

<h2>What we publish</h2>
<ul>
<li><strong>Destination guides</strong> with itineraries, neighbourhoods, and seasonal advice</li>
<li><strong>Food &amp; culture</strong> stories that go beyond the tourist checklist</li>
<li><strong>Practical travel tips</strong> on packing, budgets, safety, and sustainable choices</li>
<li><strong>Community voices</strong> from contributors across travel, technology, sports, and lifestyle</li>
</ul>

<h2>Our editorial approach</h2>
<p>Every article is written to be useful first and inspiring second. We favour clear structure — headings, lists, and images where they help — so you can scan quickly or read in depth. We do not accept paid placement disguised as editorial content.</p>

<h2>Join the community</h2>
<p>Create a free account to save posts, leave comments, and — if you are a contributor — publish your own stories from the dashboard. Have a question or partnership enquiry? Visit our <a href="{{ route('pages.contact') }}">contact page</a>.</p>
</div>
</article>
@endsection
