<?php

namespace App\Services;

class HtmlSanitizer
{
    private const ALLOWED_TAGS = [
        'p', 'br', 'strong', 'b', 'em', 'i', 'u', 's', 'del',
        'h1', 'h2', 'h3', 'h4', 'h5', 'h6',
        'ul', 'ol', 'li', 'blockquote', 'pre', 'code',
        'a', 'img', 'hr', 'span', 'div', 'sub', 'sup', 'figure', 'figcaption',
    ];

    public static function clean(string $html): string
    {
        if (trim($html) === '') {
            return '';
        }

        $html = preg_replace('/<(script|style)\b[^>]*>.*?<\/\1>/is', '', $html) ?? $html;

        $allowed = '<'.implode('><', self::ALLOWED_TAGS).'>';
        $html = strip_tags($html, $allowed);

        $dom = new \DOMDocument('1.0', 'UTF-8');
        libxml_use_internal_errors(true);
        $wrapped = '<?xml encoding="utf-8" ?><div>'.$html.'</div>';
        $dom->loadHTML($wrapped, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
        libxml_clear_errors();

        $root = $dom->getElementsByTagName('div')->item(0);
        if (! $root) {
            return '';
        }

        self::sanitizeNode($root);

        $clean = '';
        foreach ($root->childNodes as $child) {
            $clean .= $dom->saveHTML($child);
        }

        return trim($clean);
    }

    private static function sanitizeNode(\DOMNode $node): void
    {
        if ($node->nodeType !== XML_ELEMENT_NODE) {
            return;
        }

        /** @var \DOMElement $element */
        $element = $node;

        if ($element->tagName === 'a') {
            self::sanitizeAnchor($element);
        } elseif ($element->tagName === 'img') {
            self::sanitizeImage($element);
        } else {
            self::stripAttributes($element, []);
        }

        if ($element->hasChildNodes()) {
            $children = [];
            foreach ($element->childNodes as $child) {
                $children[] = $child;
            }
            foreach ($children as $child) {
                self::sanitizeNode($child);
            }
        }
    }

    private static function sanitizeAnchor(\DOMElement $element): void
    {
        $href = $element->getAttribute('href');
        self::stripAttributes($element, ['href', 'target', 'rel']);

        if ($href === '' || preg_match('/^\s*javascript:/i', $href) || preg_match('/^\s*data:/i', $href)) {
            $element->removeAttribute('href');

            return;
        }

        $element->setAttribute('href', $href);
        $element->setAttribute('target', '_blank');
        $element->setAttribute('rel', 'noopener noreferrer');
    }

    private static function sanitizeImage(\DOMElement $element): void
    {
        $src = $element->getAttribute('src');
        self::stripAttributes($element, ['src', 'alt', 'class']);

        if (! self::isSafeImageSrc($src)) {
            $element->parentNode?->removeChild($element);

            return;
        }

        $element->setAttribute('src', $src);
        $element->setAttribute('class', 'content-image');
        if (! $element->hasAttribute('alt')) {
            $element->setAttribute('alt', '');
        }
    }

    private static function isSafeImageSrc(string $src): bool
    {
        if ($src === '') {
            return false;
        }

        if (preg_match('/^\s*javascript:/i', $src) || preg_match('/^\s*data:/i', $src)) {
            return false;
        }

        if (str_starts_with($src, '/storage/') || str_starts_with($src, '/assets/')) {
            return true;
        }

        $appUrl = rtrim(config('app.url'), '/');
        if (str_starts_with($src, $appUrl.'/storage/')) {
            return true;
        }

        return (bool) preg_match('/^https?:\/\//i', $src);
    }

    private static function stripAttributes(\DOMElement $element, array $keep): void
    {
        if (! $element->hasAttributes()) {
            return;
        }

        $remove = [];
        foreach ($element->attributes as $attr) {
            $name = strtolower($attr->nodeName);
            if (str_starts_with($name, 'on') || ! in_array($name, $keep, true)) {
                $remove[] = $name;
            }
        }

        foreach ($remove as $name) {
            $element->removeAttribute($name);
        }
    }

    public static function plainTextLength(string $html): int
    {
        $text = html_entity_decode(strip_tags($html));

        return strlen(trim(preg_replace('/\s+/', ' ', $text)));
    }
}
