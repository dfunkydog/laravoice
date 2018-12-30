<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\User;

class CategoryTest extends TestCase
{
    /**
     * A basic test example.
     * @test
     *
     * @return void
     */
    public function category_index_has_totalExpenses()
    {
        $user = new User(['name' => 'John']);
        $this->be($user);
        $this->get('/category')->assertViewHas(['categories', 'totalExpenses']);
    }
}
