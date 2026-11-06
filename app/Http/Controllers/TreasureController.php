<?php

namespace App\Http\Controllers;

use App\Content\ContentRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\View\View;

/**
 * The Treasures catalogue and the reusable product page (pages/treasures/show).
 */
class TreasureController extends Controller
{
    public function __construct(private ContentRepository $content) {}

    public function index(Request $request): View
    {
        $locale = App::getLocale();
        $categories = $this->content->categories($locale);
        $category = $request->query('category');

        return view('pages.treasures.index', [
            'page' => $this->content->page('treasures', $locale),
            'products' => $this->content->products($locale),
            'categories' => $categories,
            // ?category=lighting pre-selects a filter (works without JavaScript too).
            'active' => is_string($category) && isset($categories[$category]) ? $category : null,
        ]);
    }

    public function show(Request $request): View
    {
        $locale = App::getLocale();
        // Read by name: on /{locale}/treasures/{slug} the first positional parameter is the locale.
        $product = $this->content->product((string) $request->route('slug'), $locale);

        abort_if($product === null, 404);

        return view('pages.treasures.show', [
            'product' => $product,
            'labels' => $this->content->page('product', $locale),
            'related' => $this->content->relatedProducts($product, $locale),
            'treasures' => $this->content->page('treasures', $locale),
        ]);
    }
}
