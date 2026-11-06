<?php

namespace App\Http\Controllers;

use App\Content\ContentRepository;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\App;

/** Unknown URLs: the designed 404 page with the full header and footer. */
class NotFoundController extends Controller
{
    public function __invoke(ContentRepository $content): Response
    {
        return response()->view('pages.not-found', [
            'page' => $content->page('not_found', App::getLocale()),
        ], 404);
    }
}
