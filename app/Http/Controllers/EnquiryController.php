<?php

namespace App\Http\Controllers;

use App\Http\Requests\EnquiryRequest;
use App\Mail\EnquiryReceived;
use App\Models\Enquiry;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Throwable;

class EnquiryController extends Controller
{
    public function store(EnquiryRequest $request): RedirectResponse
    {
        $enquiry = Enquiry::create([
            ...$request->validated(),
            'locale' => App::getLocale(),
            'ip_address' => $request->ip(),
            'user_agent' => Str::limit((string) $request->userAgent(), 250, ''),
        ]);

        // The enquiry is already saved, so a mail outage must not lose it or show the client an error.
        try {
            Mail::to(config('sildel.enquiry_recipient'))->send(new EnquiryReceived($enquiry));
            $enquiry->update(['mailed_at' => now()]);
        } catch (Throwable $e) {
            Log::error('Enquiry e-mail could not be sent.', ['enquiry' => $enquiry->id, 'error' => $e->getMessage()]);
        }

        return redirect()->to(url()->previous().'#atelier')
            ->with('toast', ['type' => 'success', 'message' => __('forms.received')]);
    }
}
