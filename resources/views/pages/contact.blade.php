@extends('partisals.layout')
@section('title', 'Contact Us | The Travel Squad')
@section('meta_description', 'Get in touch with The Travel Squad for editorial enquiries, partnerships, corrections, or general questions about our travel articles and community.')
@section('canonical_url', route('pages.contact'))
@section('structured_data')
<script type="application/ld+json">
{!! json_encode([
    '@context' => 'https://schema.org',
    '@type' => 'ContactPage',
    'name' => 'Contact The Travel Squad',
    'url' => route('pages.contact'),
    'mainEntity' => [
        '@type' => 'Organization',
        'name' => config('app.name', 'The Travel Squad'),
        'url' => url('/'),
        'email' => 'hello@thetravelsquad.com',
        'contactPoint' => [
            '@type' => 'ContactPoint',
            'contactType' => 'customer support',
            'email' => 'hello@thetravelsquad.com',
            'availableLanguage' => ['English'],
        ],
    ],
], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) !!}
</script>
@endsection
@section('section')
<article class="page-wrap static-page py-5">
<header class="section-header mb-4">
<p class="static-eyebrow">Get in touch</p>
<h1 class="heading">Contact Us</h1>
<p class="section-subtitle">Questions, feedback, or partnership ideas — we would love to hear from you.</p>
</header>

<div class="static-content">
<div class="contact-grid">
<div class="contact-card">
<h2>Editorial &amp; general enquiries</h2>
<p>For article suggestions, corrections, or community questions:</p>
<p><a href="mailto:hello@thetravelsquad.com">hello@thetravelsquad.com</a></p>
</div>
<div class="contact-card">
<h2>Contributors</h2>
<p>Interested in writing for The Travel Squad? Sign in and create a post from your dashboard, or email us with writing samples and your areas of expertise.</p>
</div>
<div class="contact-card">
<h2>Response time</h2>
<p>We aim to reply within 2–3 business days. For urgent corrections on published articles, include the article URL in your message.</p>
</div>
</div>

<h2>Before you write</h2>
<ul>
<li>Check our <a href="{{ route('pages.privacy') }}">Privacy Policy</a> for how we handle personal data</li>
<li>Review our <a href="{{ route('pages.terms') }}">Terms of Service</a> for community guidelines</li>
<li>Browse <a href="{{ route('posts.index') }}">all articles</a> to see the topics we cover</li>
</ul>
</div>
</article>
@endsection
