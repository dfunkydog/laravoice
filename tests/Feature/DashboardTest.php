<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\User;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DashboardTest extends TestCase
{
    use WithFaker, RefreshDatabase;
    protected $user;

    public function setup()
    {
        parent::setUp();
        $this->user = factory(User::class)->create();
    }

    /**
     * A basic test example.
     * @test
     *
     * @return void
     */
    public function dashboard_index_has_totalExpenses()
    {
        $this->actingAs($this->user)
            ->get('/')->assertViewHas(['totalExpenses', 'categories']);
    }
}
