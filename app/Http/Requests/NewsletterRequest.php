<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class NewsletterRequest extends FormRequest
{
    protected $errorBag = 'newsletter';

    public function authorize(): bool
    {
        return true;
    }

    protected function prepareForValidation(): void
    {
        $this->merge(['email' => mb_strtolower(trim((string) $this->input('email')))]);
    }

    /** @return array<string, list<mixed>> */
    public function rules(): array
    {
        return [
            'email' => ['required', 'email', 'max:190', Rule::unique('subscribers', 'email')],
        ];
    }

    /** @return array<string, string> */
    public function messages(): array
    {
        return [
            'email.unique' => __('forms.newsletter_duplicate'),
        ];
    }

    /** @return array<string, string> */
    public function attributes(): array
    {
        return ['email' => __('forms.attributes.email')];
    }

    protected function getRedirectUrl(): string
    {
        return url()->previous().'#newsletter';
    }
}
