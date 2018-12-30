<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\User;

class DashboardTest extends TestCase
{
    /**
     * A basic test example.
     * @test
     *
     * @return void
     */
    public function dashboard_index_has_categories()
    {
        $user = new User(['name' => 'John']);
        $this->be($user);
        $this->get('/')->assertViewHas('categories');
    }

    /**
     * A basic test example.
     * @test
     *
     * @return void
     */
    public function dashboard_index_has_totalExpenses()
    {
        $user = new User(['name' => 'John']);
        $this->be($user);
        $this->get('/')->assertViewHas('totalExpenses');
    }
}
