<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\User;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testBasicTest()
    {
        $this->assertTrue(true);
    }

    public function testItHasExpensePage()
    {
        $user = new User(['name' => 'John']);
        $this->be($user);
        $this->get('/expense')->assertSee('expense');
    }
}
