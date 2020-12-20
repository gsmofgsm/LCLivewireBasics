<?php

namespace App\Http\Livewire;

use App\Models\Comment;
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

    public $comment;

    protected $rules = [
        'comment' => 'required|min:4'
    ];

    public function postComment()
    {
        $this->validate();

        Comment::create([
            'post_id' => $this->post->id,
            'username' => 'Guest',
            'content' => $this->comment,
        ]);

        session()->flash('success_message', 'Comment was posted!');
    }

    public function render()
    {
        return view('livewire.comments-section');
    }
}
