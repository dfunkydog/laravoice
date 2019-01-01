<?php

namespace Tests\Controllers;

use Tests\TestCase;
use App\User;

class DashboardTest extends TestCase
{
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
        $user = new User(['name' => 'John']);
        $this->be($user);
        $this->call('GET', '/')->assertViewHas(['totalExpenses', 'categories']);
    }
}
