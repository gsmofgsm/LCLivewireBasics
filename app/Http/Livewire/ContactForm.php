<?php

namespace App\Http\Livewire;

use Livewire\Component;

class ContactForm extends Component
{
    public $successMessage = '';

    public function render()
    {
        return view('livewire.contact-form');
    }
}
