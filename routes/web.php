<?php

use App\Http\Controllers\EnquiryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\JournalController;
use App\Http\Controllers\LegalController;
use App\Http\Controllers\NewsletterController;
use App\Http\Controllers\NotFoundController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\SeoController;
use App\Http\Controllers\StorageFallbackController;
use App\Http\Controllers\TreasureController;
use App\Http\Middleware\RejectHoneypot;
use Illuminate\Support\Facades\Route;

// Home. The default locale lives at "/", others under their prefix ("/pt").
Route::get('/', HomeController::class)->name('home');
Route::get('/{locale}', HomeController::class)
    ->whereIn('locale', ['pt'])
    ->name('home.localized');

// Inner pages, registered once for the default locale and once under /{locale}
// (route names prefixed "localized."). Link to them with $site->route('name').
$pages = function () {
    Route::get('/our-story', [PageController::class, 'ourStory'])->name('our-story');
    Route::get('/authentic-cork', [PageController::class, 'authenticCork'])->name('authentic-cork');
    Route::get('/you-think-cork', [PageController::class, 'youThinkCork'])->name('you-think-cork');
    Route::get('/press', [PageController::class, 'press'])->name('press');
    Route::get('/contact', [PageController::class, 'contact'])->name('contact');
    Route::get('/faqs', [PageController::class, 'faqs'])->name('faqs');

    Route::get('/treasures', [TreasureController::class, 'index'])->name('treasures.index');
    Route::get('/treasures/{slug}', [TreasureController::class, 'show'])->where('slug', '[a-z0-9-]+')->name('treasures.show');

    Route::get('/journal', [JournalController::class, 'index'])->name('journal.index');
    Route::get('/journal/{slug}', [JournalController::class, 'show'])->where('slug', '[a-z0-9-]+')->name('journal.show');

    Route::get('/shipping-and-returns', LegalController::class)->defaults('page', 'shipping-and-returns')->name('legal.shipping');
    Route::get('/terms-and-conditions', LegalController::class)->defaults('page', 'terms-and-conditions')->name('legal.terms');
    Route::get('/privacy-policy', LegalController::class)->defaults('page', 'privacy-policy')->name('legal.privacy');
};

Route::group([], $pages);
Route::prefix('{locale}')->whereIn('locale', ['pt'])->name('localized.')->group($pages);

// Forms: CSRF (web group), 5 submissions per minute per IP, honeypot.
Route::middleware('throttle:forms')->group(function () {
    Route::post('/enquiry', [EnquiryController::class, 'store'])
        ->middleware(RejectHoneypot::class.':atelier')
        ->name('enquiry.store');

    Route::post('/newsletter', [NewsletterController::class, 'store'])
        ->middleware(RejectHoneypot::class.':newsletter')
        ->name('newsletter.store');
});

// SEO
Route::get('/sitemap.xml', [SeoController::class, 'sitemap'])->name('sitemap');
Route::get('/robots.txt', [SeoController::class, 'robots'])->name('robots');

// Serves storage/app/public when the public/storage symlink cannot be created (see DEPLOY.md).
Route::get('/storage/{path}', StorageFallbackController::class)->where('path', '.*')->name('storage.fallback');

// Any other URL: the designed 404 page (inside the web group, so the header and footer render).
Route::fallback(NotFoundController::class);
