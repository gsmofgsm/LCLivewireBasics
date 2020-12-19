<?php

namespace Tests\Feature;

use App\Http\Livewire\DataTables;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class DataTablesTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function examples_page_contains_livewire_data_tables_component()
    {
        $this->get('/examples')
            ->assertSeeLivewire('data-tables');
    }

    /** @test */
    public function datatables_active_checkbox_works_correctly()
    {
        $userA = User::factory()->create(['active' => true]);
        $userB = User::factory()->create(['active' => false]);

        Livewire::test(DataTables::class)
            ->assertSee($userA->name)
            ->assertDontSee($userB->name)
            ->set('active', false)
            ->assertDontSee($userA->name)
            ->assertSee($userB->name);
    }

    /** @test */
    public function datatables_searches_name_correctly()
    {
        $userA = User::factory()->create(['active' => true]);
        $userB = User::factory()->create(['active' => true]);

        Livewire::test(DataTables::class)
            ->set('search', $userA->name)
            ->assertSee($userA->name)
            ->assertDontSee($userB->name);
    }

    /** @test */
    public function datatables_searches_email_correctly()
    {
        $userA = User::factory()->create(['active' => true]);
        $userB = User::factory()->create(['active' => true]);

        Livewire::test(DataTables::class)
            ->set('search', $userA->email)
            ->assertSee($userA->name)
            ->assertDontSee($userB->name);
    }

    /** @test */
    public function datatables_sorts_name_asc_correctly()
    {
        $userA = User::factory()->create(['name' => 'Andre', 'active' => true]);
        $userB = User::factory()->create(['name' => 'Brian', 'active' => true]);
        $userC = User::factory()->create(['name' => 'Cathy', 'active' => true]);

        Livewire::test(DataTables::class)
            ->call('sortBy', 'name')
            ->assertSeeInOrder([$userA->name, $userB->name, $userC->name]);
    }

    /** @test */
    public function datatables_sorts_name_desc_correctly()
    {
        $userA = User::factory()->create(['name' => 'Andre', 'active' => true]);
        $userB = User::factory()->create(['name' => 'Brian', 'active' => true]);
        $userC = User::factory()->create(['name' => 'Cathy', 'active' => true]);

        Livewire::test(DataTables::class)
            ->call('sortBy', 'name')
            ->call('sortBy', 'name')
            ->assertSeeInOrder([$userC->name, $userB->name, $userA->name]);
    }

    /** @test */
    public function datatables_sorts_email_asc_correctly()
    {
        $userA = User::factory()->create(['email' => 'Andre@test.nl', 'active' => true]);
        $userB = User::factory()->create(['email' => 'Brian@test.nl', 'active' => true]);
        $userC = User::factory()->create(['email' => 'Cathy@test.nl', 'active' => true]);

        Livewire::test(DataTables::class)
            ->call('sortBy', 'email')
            ->assertSeeInOrder([$userA->name, $userB->name, $userC->name]);
    }

    /** @test */
    public function datatables_sorts_email_desc_correctly()
    {
        $userA = User::factory()->create(['email' => 'Andre@test.nl', 'active' => true]);
        $userB = User::factory()->create(['email' => 'Brian@test.nl', 'active' => true]);
        $userC = User::factory()->create(['email' => 'Cathy@test.nl', 'active' => true]);

        Livewire::test(DataTables::class)
            ->call('sortBy', 'email')
            ->call('sortBy', 'email')
            ->assertSeeInOrder([$userC->name, $userB->name, $userA->name]);
    }
}
