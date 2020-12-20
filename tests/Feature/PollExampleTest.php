<?php

namespace Tests\Feature;

use App\Http\Livewire\PollExample;
use App\Models\Order;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class PollExampleTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function examples_page_contains_livewire_poll_example_component()
    {
        $this->get('/examples')
            ->assertSeeLivewire('poll-example');
    }

    /** @test */
    public function poll_sums_orders_correctly()
    {
        $orderA = Order::create(['price' => 20]);
        $orderB = Order::create(['price' => 10]);

        Livewire::test(PollExample::class)
            ->assertSet('revenue', 30)
            ->assertSee('$30');

        $orderC = Order::create(['price' => 50]);

        Livewire::test(PollExample::class)
            ->assertSet('revenue', 80)
            ->assertSee('$80');
    }
}
