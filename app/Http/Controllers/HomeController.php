<?php

namespace App\Http\Controllers;

use App\Content\ContentRepository;
use Illuminate\Support\Facades\App;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function __invoke(ContentRepository $content): View
    {
        return view('pages.home', $content->home(App::getLocale()));
    }
}
