{{-- abort(404) inside a page (unknown piece or article): the same designed page as unknown URLs. --}}
@include('pages.not-found', ['page' => app(\App\Content\ContentRepository::class)->page('not_found', app()->getLocale())])
