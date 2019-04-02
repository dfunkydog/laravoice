<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RecurringExpense extends TestCase
{
    /**
     * A basic test example.
     * @test
     *
     * @return void
     */
    public function recurring_expense_index_returns_200()
    {
        $this->get('/recurring')->assertStatus(200);
    }
}
