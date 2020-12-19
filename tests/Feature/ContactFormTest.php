<?php

namespace Tests\Feature;

use App\Http\Livewire\ContactForm;
use App\Mail\ContactFormMailable;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Mail;
use Livewire\Livewire;
use Tests\TestCase;

class ContactFormTest extends TestCase
{
    /** @test */
    public function examples_page_contains_livewire_contact_form_component()
    {
        $this->get('/examples')
            ->assertSeeLivewire('contact-form');
    }

    /** @test */
    public function contact_form_sends_out_an_email()
    {
        Mail::fake();
        Livewire::test(ContactForm::class)
            ->set('name', 'someone')
            ->set('email', 'someone@test.nl')
            ->set('phone', '0612345678')
            ->set('message', 'qing said')
            ->call('submitForm')
            ->assertSee('We received your message successfully and will get back to you shortly!');
        Mail::assertSent(function (ContactFormMailable $mail) {
            $mail->build();

            return $mail->hasTo('qing@qing.com') &&
                $mail->hasFrom('someone@test.nl') &&
                $mail->subject === 'Contact Form Submission';
        });
    }
}
