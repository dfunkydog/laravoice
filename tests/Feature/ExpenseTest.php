<?php

namespace Tests\Feature;

use App\User;
use Carbon\Carbon;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class Expense extends TestCase
{
    use RefreshDatabase, WithFaker;
    protected $user;

    public function setup() :void
    {
        parent::setUp();
        $this->user = factory(User::class)->create();
    }

    /**
    * @test
    */
    public function a_user_can_create_an_expense()
    {
        $date = Carbon::createFromTimestamp($this->faker->dateTimeBetween('-4 months')->getTimestamp());
        $data = [
            'description' => $this->faker->sentence,
            'amount' => $this->faker->numberBetween(1, 40),
            'paid_on' => $date,
            'type_id' => 1,
            'vendorName' => 'Amazon',
        ];
        $attributes = [
            'paid_on' => (new Carbon($data['paid_on']))->format('Y-m-d'),
            'amount' => $data['amount'],
            'description' => $data['description'],
            'type_id' => $data['type_id'],
        ];

        $this->actingAs($this->user)->post('expense', $data);
        $this->assertDatabaseHas('expenses', $attributes);
    }

    /**
    * @test
    */
    public function guests_cannot_add_expenses()
    {
        $expense = factory('App\Models\Expense')->raw();
        $this->post('expense', $expense)->assertStatus(302);
    }

    /**
    * @test
    */
    public function an_expense_must_have_a_type_id()
    {
        $expense = factory('App\Models\Expense')->raw(['type_id' => '']);
        $this->actingAs($this->user)->post('expense', $expense)->assertSessionHasErrors('type_id');
    }

    /**
    * @test
    */
    public function an_expense_type_id_must_be_an_integer()
    {
        $expense = factory('App\Models\Expense')->raw(['type_id' => 'string']);
        $this->actingAs($this->user)->post('expense', $expense)->assertSessionHasErrors('type_id');
    }

    /**
    * @test
    */
    public function an_expense_must_have_a_date()
    {
        $expense = factory('App\Models\Expense')->raw(['paid_on' => '']);
        $this->actingAs($this->user)->post('expense', $expense)->assertSessionHasErrors('paid_on');
    }

    /**
    * @test
    */
    public function an_expense_must_have_an_amount()
    {
        $expense = factory('App\Models\Expense')->raw(['amount' => '']);
        $this->actingAs($this->user)->post('expense', $expense)->assertSessionHasErrors('amount');
    }

    /**
    * @test
    */
    public function an_expense_must_have_a_description()
    {
        $expense = factory('App\Models\Expense')->raw(['description' => '']);
        $this->actingAs($this->user)->post('expense', $expense)->assertSessionHasErrors('description');
    }

    /**
    * @test
    */
    public function an_expense_may_not_have_a_vendorName()
    {
        $expense = factory('App\Models\Expense')->raw(['vendorName' => '']);
        $this->actingAs($this->user)->post('expense', $expense)->assertSessionHasNoErrors('vendorName');
    }

    /**
    * @test
    */
    public function a_recurred_expense_must_be_flagged_as_scheduled()
    {
        $parentExpense = factory('App\Models\Expense')->create(['is_scheduled' => false]);
        $generatedExpense = $parentExpense->scheduled();
        $this->assertTrue($generatedExpense->is_scheduled);
    }
}
