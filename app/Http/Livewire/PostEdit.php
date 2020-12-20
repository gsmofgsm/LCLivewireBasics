<?php

namespace App\Http\Livewire;

use App\Models\Post;
use Livewire\Component;

class PostEdit extends Component
{
    public $post;
    public $title;
    public $content;
    public $photo;

    protected $rules = [
        'title' => 'required',
        'content' => 'required',
//        'photo' => 'nullable|sometimes|image|max:5000',
    ];

    public function mount(Post $post)
    {
        $this->post = $post;
        $this->title = $post->title;
        $this->content = $post->content;
        $this->photo = $post->photo;
    }

    public function submitForm()
    {
        $this->validate();

        $this->post->update([
            'title' => $this->title,
            'content' => $this->content,
//            'photo' => $this->photo ? $request->file('photo')->store('photos', 'public') : $post->photo,
        ]);

        session()->flash('success_message', 'Post was updated successfully!');
    }

    public function render()
    {
        return view('livewire.post-edit');
    }
}
