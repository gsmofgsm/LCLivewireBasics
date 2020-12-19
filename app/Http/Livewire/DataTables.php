<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class DataTables extends Component
{
    use withPagination;

    public function render()
    {
        return view('livewire.data-tables', [
            'users' => User::paginate(10),
        ]);
    }
}