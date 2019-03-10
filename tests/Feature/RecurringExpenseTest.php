<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;
use App\Models\RecurringExpense as Recurring;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Carbon\Carbon;

class RecurringExpense extends TestCase
{
    use RefreshDatabase, WithFaker;
    protected $user;

    public function setup()
    {
        parent::setUp();
        $this->user = factory(User::class)->create();
    }

    /**
     * @test
     */
    public function a_user_can_create_recurring_expense()
    {
        $this->withoutExceptionHandling();
        $recur = factory(Recurring::class)->raw();
        $this->actingAs($this->user)->post('recurring', $recur);
        $recur['end_date'] = $recur['end_date'] ? $recur['end_date']->format('Y-m-d') : null;
        $this->assertDatabaseHas('recurring_expenses', $recur);
    }

    /**
     * @test
     */
    public function guests_cannot_create_recurring_expense()
    {
        $recur = factory(Recurring::class)->raw();
        $this->post('recurring', $recur)
                ->assertRedirect('login');
    }

    /**
    * @test
    */
    public function recurring_expense_must_have_a_parent_expense()
    {
        $recur = factory(Recurring::class)->raw(['parent_expense_id' => null]);
        $this->actingAs($this->user)
                ->post('recurring', $recur)
                ->assertSessionHasErrors('parent_expense_id');
    }

    /**
    * @test
    */
    public function recurring_expense_must_have_a_recurring_day()
    {
        $recur = factory(Recurring::class)->raw(['day_of_month' => null]);
        $this->actingAs($this->user)
                ->post('recurring', $recur)
                ->assertSessionHasErrors('day_of_month');
    }

    /**
    * @test
    */
    public function recurring_expense_recurring_day_of_month_must_be_valid()
    {
        $recur = factory(Recurring::class)->raw(['day_of_month' => 32]);
        $this->actingAs($this->user)
                ->post('recurring', $recur)
                ->assertSessionHasErrors('day_of_month');
    }

    /**
    * @test
    */
    public function current_scope_returns_only_recurring_expenses_due_today()
    {
        factory(Recurring::class, 3)->create(['day_of_month' => (new Carbon)->day]);
        factory(Recurring::class, 3)->create(['day_of_month' => (new Carbon)->subDay(1)->day]);
        $expenses = Recurring::current()
            ->where('day_of_month', '<>', (new Carbon)->day)->get()->count();

        $this->assertEquals(0, $expenses);
    }
}
