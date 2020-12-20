<?php

namespace Tests\Feature;

use App\Http\Livewire\PostEdit;
use App\Models\Post;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Livewire\Livewire;
use Tests\TestCase;

class PostEditTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function post_edit_page_contains_livewire_comments_post_edit()
    {
        $post = Post::factory()->create();
        $this->get(route('post.edit', $post))
            ->assertSeeLivewire('post-edit');
    }

    /** @test */
    public function post_edit_page_form_works()
    {
        $post = Post::factory()->create();
        Livewire::test(PostEdit::class, ['post' => $post])
            ->set('title', 'New title')
            ->set('content', 'New content')
            ->call('submitForm')
            ->assertSee('updated successfully');

        $post->refresh();
        $this->assertSame('New title', $post->title);
        $this->assertSame('New content', $post->content);
    }

    /** @test */
    public function post_edit_page_upload_works_for_images()
    {
        $post = Post::factory()->create();

        Storage::fake('public');
        $file = UploadedFile::fake()->image('photo.jpg');

        Livewire::test(PostEdit::class, ['post' => $post])
            ->set('title', 'New title')
            ->set('content', 'New content')
            ->set('photo', $file)
            ->call('submitForm')
            ->assertSee('updated successfully');

        $post->refresh();
        $this->assertNotNull($post->photo);
        Storage::disk('public')->assertExists($post->photo);
    }

    /** @test */
    public function post_edit_page_upload_does_not_work_for_none_images()
    {
        $post = Post::factory()->create();

        Storage::fake('public');
        $file = UploadedFile::fake()->create('document.pdf', 1000);

        Livewire::test(PostEdit::class, ['post' => $post])
            ->set('title', 'New title')
            ->set('content', 'New content')
            ->set('photo', $file)
            ->call('submitForm')
            ->assertSee('The photo must be an image')
            ->assertHasErrors(['photo' => 'image']);

        $post->refresh();
        $this->assertNull($post->photo);
        Storage::disk('public')->assertMissing($post->photo);
    }
}
