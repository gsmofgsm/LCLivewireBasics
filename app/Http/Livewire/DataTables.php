<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class DataTables extends Component
{
    use withPagination;

    public $active = true;
    public $search;

    public function render()
    {
        return view('livewire.data-tables', [
            'users' => User::where('name', 'like', '%' . $this->search . '%')
                ->where('active', $this->active)
                ->paginate(10),
        ]);
    }

//    public function paginationView()
//    {
//        return 'livewire.custom-pagination-links-view';
//    }
}
