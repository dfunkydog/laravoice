<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Expense;
use App\Services\ExpenseServices;

class ExpenseServicesTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @test
     *
     * @return void
     */
    public function expense_services_descriptions_returns_iterable()
    {
        $descriptions = (new ExpenseServices(new Expense()))->getDescriptions();
        $this->assertIsIterable($descriptions);
    }
}
