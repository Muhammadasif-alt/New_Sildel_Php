<?php

namespace Tests\Feature;

use App\Mail\EnquiryReceived;
use App\Models\Enquiry;
use App\Models\Subscriber;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;

class FormsTest extends TestCase
{
    use RefreshDatabase;

    private array $enquiry = [
        'name' => 'Ana Silva',
        'email' => 'ana@example.com',
        'subject' => 'Crescent commission',
        'message' => 'I would love a bespoke Crescent for my dining room.',
    ];

    public function test_enquiry_is_saved_mailed_and_flashed(): void
    {
        Mail::fake();

        $this->from('/')->post('/enquiry', $this->enquiry)
            ->assertRedirect(url('/').'#atelier')
            ->assertSessionHas('toast.type', 'success');

        $this->assertDatabaseHas('enquiries', ['email' => 'ana@example.com', 'subject' => 'Crescent commission']);
        Mail::assertSent(EnquiryReceived::class, fn ($mail) => $mail->hasTo('sildel@sildel.pt') && $mail->hasReplyTo('ana@example.com'));
        $this->assertNotNull(Enquiry::first()->mailed_at);
    }

    public function test_enquiry_validation_errors_use_their_own_bag(): void
    {
        $this->from('/')->post('/enquiry', ['name' => '', 'email' => 'not-an-email', 'message' => str_repeat('a', 3001)])
            ->assertRedirect(url('/').'#atelier')
            ->assertSessionHasErrorsIn('enquiry', ['name', 'email', 'message']);

        $this->assertDatabaseCount('enquiries', 0);
    }

    public function test_enquiry_honeypot_pretends_success_but_stores_nothing(): void
    {
        Mail::fake();

        $this->from('/')->post('/enquiry', [...$this->enquiry, 'company_website' => 'http://spam.example'])
            ->assertRedirect()
            ->assertSessionHas('toast.type', 'success');

        $this->assertDatabaseCount('enquiries', 0);
        Mail::assertNothingSent();
    }

    public function test_newsletter_subscribes_and_rejects_duplicates(): void
    {
        $this->from('/')->post('/newsletter', ['email' => 'Client@Example.com '])
            ->assertSessionHas('toast.type', 'success');

        $this->assertDatabaseHas('subscribers', ['email' => 'client@example.com']);

        $this->from('/')->post('/newsletter', ['email' => 'client@example.com'])
            ->assertSessionHasErrorsIn('newsletter', ['email']);

        $this->assertSame(1, Subscriber::count());
    }

    public function test_forms_are_rate_limited_to_five_per_minute(): void
    {
        Mail::fake();

        foreach (range(1, 5) as $i) {
            $this->from('/')->post('/enquiry', $this->enquiry)->assertSessionHas('toast.type', 'success');
        }

        $this->from('/')->post('/enquiry', $this->enquiry)
            ->assertRedirect()
            ->assertSessionHas('toast.type', 'error');

        $this->assertDatabaseCount('enquiries', 5);
    }

    public function test_portuguese_submission_gets_portuguese_message(): void
    {
        Mail::fake();

        $this->from('/pt')->post('/enquiry', [...$this->enquiry, 'locale' => 'pt'])
            ->assertSessionHas('toast.message', __('forms.received', [], 'pt'));

        $this->assertDatabaseHas('enquiries', ['locale' => 'pt']);
    }
}
