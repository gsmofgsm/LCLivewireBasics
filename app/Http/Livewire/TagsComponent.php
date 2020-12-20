<?php

namespace App\Http\Livewire;

use App\Models\Tag;
use Livewire\Component;

class TagsComponent extends Component
{
    public $tags;

    public function mount()
    {
        $allTags = Tag::all();
        $this->tags = json_encode($allTags->pluck('name'));
    }

    public function render()
    {
        return view('livewire.tags-component');
    }
}
