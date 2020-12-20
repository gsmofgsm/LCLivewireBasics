<?php

namespace Tests\Feature;

use App\Http\Livewire\TagsComponent;
use App\Models\Tag;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class TagsComponentTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function examples_page_contains_livewire_component_tags_component()
    {
        $this->get('/examples')
            ->assertSeeLivewire('tags-component');
    }

    /** @test */
    public function loads_existing_tags_correctly()
    {
        $tagA = Tag::factory()->create();
        $tagB = Tag::factory()->create();

        Livewire::test(TagsComponent::class)
            ->assertSet('tags', json_encode([$tagA->name, $tagB->name]));
    }

    /** @test */
    public function adds_tags_correctly()
    {
        $tagA = Tag::factory()->create();
        $tagB = Tag::factory()->create();

        Livewire::test(TagsComponent::class)
            ->emit('tagAdded', 'three')
            ->assertEmitted('tagAddedFromBackend', 'three');

        $this->assertDatabaseHas('tags', ['name' => 'three']);
    }

    /** @test */
    public function removes_tags_correctly()
    {
        $tagA = Tag::factory()->create();
        $tagB = Tag::factory()->create();

        Livewire::test(TagsComponent::class)
            ->emit('tagRemoved', $tagB->name);

        $this->assertDatabaseMissing('tags', ['name' => $tagB->name]);
    }
}
