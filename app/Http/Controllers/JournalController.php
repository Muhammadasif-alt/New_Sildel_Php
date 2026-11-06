<?php

namespace App\Http\Controllers;

use App\Content\ContentRepository;
use App\Data\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\View\View;

class JournalController extends Controller
{
    public function __construct(private ContentRepository $content) {}

    /** Articles per listing page (the first page shows the newest one featured large, then five). */
    public const PER_PAGE = 6;

    public function index(Request $request): View
    {
        $locale = App::getLocale();
        $all = $this->content->articles($locale);
        $pages = max(1, (int) ceil(count($all) / self::PER_PAGE));
        $current = (int) $request->query('page', 1);

        // ?page=1 is the canonical first page; anything out of range does not exist.
        abort_if($current < 1 || $current > $pages, 404);

        return view('pages.journal.index', [
            'page' => $this->content->page('journal', $locale),
            'articles' => array_slice($all, ($current - 1) * self::PER_PAGE, self::PER_PAGE),
            'pagination' => ['current' => $current, 'last' => $pages],
            'ui' => $this->content->settings($locale)->ui,
        ]);
    }

    public function show(Request $request): View
    {
        $locale = App::getLocale();
        $article = $this->content->article((string) $request->route('slug'), $locale);

        abort_if($article === null, 404);

        return view('pages.journal.show', [
            'article' => $article,
            'page' => $this->content->page('journal', $locale),
            'more' => array_slice(array_values(array_filter(
                $this->content->articles($locale),
                fn (Article $other) => $other->slug !== $article->slug,
            )), 0, 3),
        ]);
    }
}
