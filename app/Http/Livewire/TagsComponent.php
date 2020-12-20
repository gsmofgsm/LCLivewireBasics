<?php

namespace App\Http\Livewire;

use App\Models\Tag;
use Livewire\Component;

class TagsComponent extends Component
{
    public $tags;

//    protected $listeners = ['postAdded' => 'incrementPostCount'];
    // if method name is the same
    // no key value pair needed
    protected $listeners = ['tagAdded', 'tagRemoved'];

    public function mount()
    {
        $allTags = Tag::all();
        $this->tags = json_encode($allTags->pluck('name'));
    }

    public function render()
    {
        return view('livewire.tags-component');
    }

    public function tagAdded($tag)
    {
        Tag::create(['name' => $tag]);
    }

    public function tagRemoved($tag)
    {
        Tag::where('name', $tag)->first()->delete();
    }
}
