<?php

namespace App\Services;

class RichPostContent
{
    /**
     * @param  array<int, string>  $imageUrls
     */
    public static function generate(string $title, string $category, array $imageUrls): string
    {
        $img1 = $imageUrls[0] ?? Media::placeholderPostUrl();
        $img2 = $imageUrls[1] ?? $img1;
        $safeTitle = e($title);
        $safeCategory = e($category);

        $templates = [
            <<<HTML
<h2>{$safeTitle}</h2>
<p>Planning a {$safeCategory} adventure starts with knowing what to expect on the ground. This guide covers the essentials — from when to go to what to pack — so you can focus on the experience instead of the logistics.</p>
<img src="{$img1}" alt="{$safeTitle} — scenic view" class="content-image">
<h2>Why this destination stands out</h2>
<p>Every trip has a moment that stays with you. For many travellers, it is the combination of landscape, local culture, and the small surprises along the way that make a place unforgettable.</p>
<ul>
<li>Best season for comfortable weather and fewer crowds</li>
<li>Must-see landmarks and hidden neighbourhoods worth exploring</li>
<li>Local food and markets that reflect the region's character</li>
<li>Practical tips for getting around safely and affordably</li>
</ul>
<h3>Quick planning checklist</h3>
<ol>
<li>Book accommodation near public transport or walkable areas</li>
<li>Save offline maps and key phrases before you arrive</li>
<li>Leave one unscheduled day for spontaneous discoveries</li>
</ol>
<img src="{$img2}" alt="{$safeTitle} — travel highlight" class="content-image">
<blockquote>The best journeys are not always the longest — they are the ones where you slow down enough to notice the details.</blockquote>
<p>Whether you are travelling solo, with friends, or as a family, a little preparation goes a long way. Share your own tips in the comments and help fellow readers plan their next trip.</p>
HTML,
            <<<HTML
<h2>{$safeTitle}</h2>
<p>From street food to sunrise viewpoints, {$safeCategory} travel offers more variety than a single itinerary can capture. We broke this story into sections you can mix and match based on your pace and budget.</p>
<h2>Getting started</h2>
<p>Start with one anchor experience — a museum, a coastal walk, or a cooking class — and build your days around it. That keeps the trip feeling relaxed instead of rushed.</p>
<img src="{$img1}" alt="{$safeTitle} — getting started" class="content-image">
<h2>What to experience</h2>
<ul>
<li><strong>Morning:</strong> Explore local cafés and markets while they are quiet</li>
<li><strong>Afternoon:</strong> Visit a landmark or neighbourhood on foot</li>
<li><strong>Evening:</strong> Try a recommended dish you have never had before</li>
</ul>
<h3>Budget-friendly ideas</h3>
<p>You do not need a luxury budget to travel well. Public transit, free walking tours, and picnic lunches from local bakeries stretch your money without dulling the adventure.</p>
<img src="{$img2}" alt="{$safeTitle} — local highlights" class="content-image">
<p>Pack light, keep your documents backed up digitally, and always leave room for one detour. That is usually where the best stories begin.</p>
HTML,
            <<<HTML
<h2>{$safeTitle}</h2>
<p>If you are researching {$safeCategory} destinations for your next break, this article walks through what worked for us — including what we would do differently on a return visit.</p>
<img src="{$img1}" alt="{$safeTitle} — overview" class="content-image">
<h2>Highlights at a glance</h2>
<ol>
<li>Scenic routes worth the early start</li>
<li>Neighbourhoods with great food and independent shops</li>
<li>Day-trip options when you want a change of pace</li>
</ol>
<h3>Practical notes</h3>
<p>Check visa requirements and travel insurance before booking. Shoulder seasons often deliver better prices and milder weather than peak summer weeks.</p>
<ul>
<li>Carry a reusable water bottle and a light rain layer</li>
<li>Photograph respectfully — ask before taking portraits</li>
<li>Support local guides and small businesses when you can</li>
</ul>
<img src="{$img2}" alt="{$safeTitle} — on the road" class="content-image">
<p>Have you been here before? Drop your recommendations below — our community relies on real traveller insights.</p>
HTML,
        ];

        return $templates[array_rand($templates)];
    }
}
