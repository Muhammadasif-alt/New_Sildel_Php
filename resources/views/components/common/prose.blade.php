{{--
    common/prose: long-form text (articles, legal pages) rendered from Markdown.
    html: trusted HTML produced by the content repository (Markdown with raw HTML stripped).

    <x-common.prose :html="$article->body" />
--}}
@props(['html'])

<div {{ $attributes->class('prose') }}>{!! $html !!}</div>
