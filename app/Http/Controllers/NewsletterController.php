<?php

namespace App\Http\Controllers;

use App\Http\Requests\NewsletterRequest;
use App\Models\Subscriber;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\App;

class NewsletterController extends Controller
{
    public function store(NewsletterRequest $request): RedirectResponse
    {
        Subscriber::create([
            'email' => $request->validated('email'),
            'locale' => App::getLocale(),
            'ip_address' => $request->ip(),
        ]);

        return redirect()->to(url()->previous().'#newsletter')
            ->with('toast', ['type' => 'success', 'message' => __('forms.subscribed')]);
    }
}
