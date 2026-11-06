<?php

namespace App\Http\Controllers;

use App\Content\ContentRepository;
use Illuminate\Support\Facades\App;
use Illuminate\View\View;

/**
 * Editorial inner pages. Each passes its copy from config/pages.php to pages/{name}.blade.php.
 */
class PageController extends Controller
{
    public function __construct(private ContentRepository $content) {}

    public function ourStory(): View
    {
        return $this->render('our-story', 'our_story');
    }

    public function authenticCork(): View
    {
        return $this->render('authentic-cork', 'authentic_cork');
    }

    public function youThinkCork(): View
    {
        return $this->render('you-think-cork', 'you_think_cork', [
            'atelier' => $this->content->home(App::getLocale())['atelier'],
        ]);
    }

    public function press(): View
    {
        return $this->render('press', 'press');
    }

    public function contact(): View
    {
        $faqs = $this->content->page('faqs', App::getLocale());
        $page = $this->content->page('contact', App::getLocale());

        // The contact page repeats a few answers from the FAQ page (indexes into its "Orders" and "Shipping" groups).
        $all = [...$faqs['groups'][1]['items'], ...$faqs['groups'][2]['items']];

        return $this->render('contact', 'contact', [
            'atelier' => $this->content->home(App::getLocale())['atelier'],
            'questions' => array_values(array_filter(array_map(fn (int $i) => $all[$i] ?? null, $page['faq']['items']))),
        ]);
    }

    public function faqs(): View
    {
        return $this->render('faqs', 'faqs');
    }

    /** @param array<string, mixed> $data */
    private function render(string $view, string $key, array $data = []): View
    {
        $locale = App::getLocale();

        return view('pages.'.$view, [
            'page' => $this->content->page($key, $locale),
            'shared' => $this->content->page('shared', $locale),
            ...$data,
        ]);
    }
}
