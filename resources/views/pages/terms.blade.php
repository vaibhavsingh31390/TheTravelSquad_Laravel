@extends('partisals.layout')
@section('title', 'Terms of Service | The Travel Squad')
@section('meta_description', 'The Travel Squad terms of service — rules for using our website, publishing content, commenting, and participating in our travel community.')
@section('canonical_url', route('pages.terms'))
@section('meta_robots', 'index, follow')
@section('section')
<article class="page-wrap static-page py-5">
<header class="section-header mb-4">
<p class="static-eyebrow">Legal</p>
<h1 class="heading">Terms of Service</h1>
<p class="section-subtitle">Last updated: {{ now()->format('F j, Y') }}</p>
</header>

<div class="static-content">
<p>By accessing or using The Travel Squad website, you agree to these Terms of Service. If you do not agree, please do not use the site.</p>

<h2>Using the service</h2>
<ul>
<li>You must provide accurate information when creating an account</li>
<li>You are responsible for maintaining the security of your login credentials</li>
<li>You must be at least 13 years old to use the service</li>
</ul>

<h2>User content</h2>
<p>You retain ownership of content you publish. By posting, you grant The Travel Squad a non-exclusive licence to display, distribute, and promote your content on the platform.</p>
<p>You agree not to publish content that:</p>
<ul>
<li>Is unlawful, defamatory, harassing, or hateful</li>
<li>Infringes intellectual property or privacy rights</li>
<li>Contains malware, spam, or deceptive links</li>
<li>Impersonates another person or organisation</li>
</ul>

<h2>Community conduct</h2>
<p>Comments and interactions must be respectful. We may remove content or suspend accounts that violate these terms or harm the community.</p>

<h2>Disclaimer</h2>
<p>Travel articles are for informational purposes only. Conditions, prices, and regulations change. Always verify details independently before travelling. We are not liable for decisions made based on published content.</p>

<h2>Intellectual property</h2>
<p>The Travel Squad name, branding, and site design are our property. Do not copy or reuse them without permission.</p>

<h2>Termination</h2>
<p>We may suspend or terminate access at our discretion for violations of these terms. You may stop using the service at any time.</p>

<h2>Limitation of liability</h2>
<p>To the fullest extent permitted by law, The Travel Squad is not liable for indirect, incidental, or consequential damages arising from use of the site.</p>

<h2>Changes</h2>
<p>We may update these terms. Material changes will be reflected on this page with an updated date.</p>

<h2>Contact</h2>
<p>Questions about these terms? Email <a href="mailto:hello@thetravelsquad.com">hello@thetravelsquad.com</a>.</p>
</div>
</article>
@endsection
