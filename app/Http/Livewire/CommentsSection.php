<?php

namespace App\Http\Livewire;

use App\Models\Post;
use Livewire\Component;

class CommentsSection extends Component
{
    public $post;

    // this is not necessary
    // as long as the name $post is the same as :post
    // livewire will know to initiate it for you
//    public function mount(Post $post)
//    {
//        $this->post = $post;
//    }

    public function render()
    {
        return view('livewire.comments-section');
    }
}
