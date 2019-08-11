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

    public function setup() :void
    {
        parent::setUp();
        $this->user = factory(User::class)->create();
    }

    /**
     * Unauthorized user.
     * @test
     *
     * @return void
     */
    public function unauthorized_user_is_redirected()
    {
        $response = $this->call('GET', '/');

        $this->assertEquals(302, $response->getStatusCode());
    }

    /**
     * variables passed to view.
     * @test
     *
     * @return void
     */
    public function dashboard_index_passes_variables()
    {
        $this->actingAs($this->user);
        $this->get('/')->assertViewHas(['totalExpenses', 'categories']);
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
