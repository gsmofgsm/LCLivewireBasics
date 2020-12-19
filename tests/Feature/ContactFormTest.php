<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ContactFormTest extends TestCase
{
    /** @test */
    public function examples_page_contains_livewire_contact_form_component()
    {
        $this->get('/examples')
            ->assertSeeLivewire('contact-form');
    }
}
