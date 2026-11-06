<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EnquiryRequest extends FormRequest
{
    /** Errors live in their own bag so they never collide with the newsletter form. */
    protected $errorBag = 'enquiry';

    public function authorize(): bool
    {
        return true;
    }

    /** @return array<string, list<string>> */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:120'],
            'email' => ['required', 'email', 'max:190'],
            'subject' => ['nullable', 'string', 'max:190'],
            'message' => ['required', 'string', 'max:3000'],
        ];
    }

    /** @return array<string, string> */
    public function attributes(): array
    {
        return [
            'name' => __('forms.attributes.name'),
            'email' => __('forms.attributes.email'),
            'subject' => __('forms.attributes.subject'),
            'message' => __('forms.attributes.message'),
        ];
    }

    /** Return to the form itself, not the top of the page. */
    protected function getRedirectUrl(): string
    {
        return url()->previous().'#atelier';
    }
}
