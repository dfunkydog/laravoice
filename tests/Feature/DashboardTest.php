<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\User;

class DashboardTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testHasCategories()
    {
        $user = new User(['name' => 'John']);
        $this->be($user);
        $this->get('/')->assertViewHas('categories');
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testHasTotalexpenses()
    {
        $user = new User(['name' => 'John']);
        $this->be($user);
        $this->get('/')->assertViewHas('categories');
    }
}
