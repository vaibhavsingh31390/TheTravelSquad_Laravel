@extends('partisals.layout')
@section('title', 'Privacy Policy | The Travel Squad')
@section('meta_description', 'Read The Travel Squad privacy policy. Learn how we collect, use, and protect your personal information when you browse articles, create an account, or interact with our community.')
@section('canonical_url', route('pages.privacy'))
@section('meta_robots', 'index, follow')
@section('section')
<article class="page-wrap static-page py-5">
<header class="section-header mb-4">
<p class="static-eyebrow">Legal</p>
<h1 class="heading">Privacy Policy</h1>
<p class="section-subtitle">Last updated: {{ now()->format('F j, Y') }}</p>
</header>

<div class="static-content">
<p>The Travel Squad ("we", "us", "our") respects your privacy. This policy explains what information we collect when you use our website and how we use it.</p>

<h2>Information we collect</h2>
<ul>
<li><strong>Account information:</strong> name, email address, and password when you register</li>
<li><strong>User content:</strong> posts, comments, and media you upload</li>
<li><strong>Usage data:</strong> pages visited, interactions (likes/dislikes), and technical logs such as IP address and browser type</li>
<li><strong>Cookies:</strong> session cookies required for authentication and site functionality</li>
</ul>

<h2>How we use your information</h2>
<ul>
<li>Provide and improve our publishing platform</li>
<li>Authenticate users and secure accounts</li>
<li>Display your contributions (posts, comments, profile images) to other visitors as you intend</li>
<li>Respond to support requests and enforce our terms</li>
</ul>

<h2>Data sharing</h2>
<p>We do not sell your personal information. We may share data with service providers who help us operate the site (hosting, email), subject to confidentiality obligations, or when required by law.</p>

<h2>Your rights</h2>
<p>Depending on your location, you may have rights to access, correct, or delete your personal data. Contact us at <a href="mailto:hello@thetravelsquad.com">hello@thetravelsquad.com</a> to make a request.</p>

<h2>Data retention</h2>
<p>We retain account and content data while your account is active. You may request deletion of your account and associated content by contacting us.</p>

<h2>Security</h2>
<p>We use industry-standard measures to protect data in transit and at rest. No method of transmission over the internet is 100% secure.</p>

<h2>Children</h2>
<p>Our service is not directed at children under 13. We do not knowingly collect personal information from children.</p>

<h2>Changes</h2>
<p>We may update this policy from time to time. Continued use of the site after changes constitutes acceptance of the updated policy.</p>

<h2>Contact</h2>
<p>Questions about this policy? Email <a href="mailto:hello@thetravelsquad.com">hello@thetravelsquad.com</a> or visit our <a href="{{ route('pages.contact') }}">contact page</a>.</p>
</div>
</article>
@endsection
