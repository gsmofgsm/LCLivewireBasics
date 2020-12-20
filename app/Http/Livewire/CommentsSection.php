<?php

namespace App\Http\Livewire;

use App\Models\Comment;
use App\Models\Post;
use Livewire\Component;

class CommentsSection extends Component
{
    public $post;

    // this is not necessary for browser to show
    // as long as the name $post is the same as :post
    // livewire will know to initiate it for you
    // however, this is needed for tests
    public function mount(Post $post)
    {
        $this->post = $post;
    }

    public $comment;

    public $successMessage;

    protected $rules = [
        'post' => 'required',
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

        $this->comment = '';

        $this->post = Post::find($this->post->id);

        $this->successMessage = 'Comment was posted!';
    }

    public function render()
    {
        return view('livewire.comments-section');
    }
}
