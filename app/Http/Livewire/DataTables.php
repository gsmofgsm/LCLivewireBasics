<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;

class DataTables extends Component
{
    public function render()
    {
        return view('livewire.data-tables', [
            'users' => User::paginate(10),
        ]);
    }
}
