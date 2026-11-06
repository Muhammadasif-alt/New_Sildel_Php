<?php

namespace App\Http\Controllers;

use App\Content\ContentRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\View\View;

/**
 * Shipping and Returns, Terms and Conditions, Privacy Policy: one template, Markdown bodies
 * in resources/content/{locale}/legal/. The page is set by the route's "page" default.
 */
class LegalController extends Controller
{
    public function __invoke(Request $request, ContentRepository $content): View
    {
        $locale = App::getLocale();
        $slug = (string) $request->route('page');
        $legal = $content->legal($slug, $locale);

        abort_if($legal === null, 404);

        return view('pages.legal', [
            'legal' => $legal,
            'slug' => $slug,
            'labels' => $content->page('legal', $locale),
        ]);
    }
}
