<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;
use App\Models\ScheduledExpense as Scheduled;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ScheduledExpense extends TestCase
{
    use RefreshDatabase, WithFaker, DatabaseMigrations;
    protected $user;

    public function setup() :void
    {
        parent::setUp();
        $this->user = factory(User::class)->create();
    }

    /**
     * @test
     *
     * @return void
     */
    public function scheduled_expense_index_returns_200()
    {
        $this->actingAs($this->user);
        $this->get('/scheduled')->assertStatus(200);
    }

    /**
     * @test
     *
     * @return void
     */
    public function scheduled_expense_list_returns_200()
    {
        $this->actingAs($this->user);
        $this->get('/scheduled/list')->assertStatus(200);
    }

    /**
     * @test
     */
    public function a_user_can_create_scheduled_expense()
    {
        $this->withoutExceptionHandling();
        $scheduled = factory(Scheduled::class)->raw();
        $this->actingAs($this->user)->post('scheduled', $scheduled);
        $scheduled['end_date'] = $scheduled['end_date'] ? $scheduled['end_date']->format('Y-m-d') : null;
        $this->assertDatabaseHas('scheduled_expenses', $scheduled);
    }

    /**
     * @test
     */
    public function guests_cannot_create_scheduled_expense()
    {
        $scheduled = factory(Scheduled::class)->raw();
        $this->post('scheduled', $scheduled)
                ->assertRedirect('login');
    }

    /**
    * @test
    */
    public function scheduled_expense_must_have_a_parent_expense()
    {
        $scheduled = factory(Scheduled::class)->raw(['parent_expense_id' => null]);
        $this->actingAs($this->user)
                ->post('scheduled', $scheduled)
                ->assertSessionHasErrors('parent_expense_id');
    }

    /**
    * @test
    */
    public function scheduled_expense_must_have_a_scheduled_day()
    {
        $scheduled = factory(Scheduled::class)->raw(['scheduled_day' => null]);
        $this->actingAs($this->user)
                ->post('scheduled', $scheduled)
                ->assertSessionHasErrors('scheduled_day');
    }

    /**
    * @test
    */
    public function scheduled_expense_scheduled_scheduled_day_must_be_valid()
    {
        $scheduled = factory(Scheduled::class)->raw(['scheduled_day' => 32]);
        $this->actingAs($this->user)
                ->post('scheduled', $scheduled)
                ->assertSessionHasErrors('scheduled_day');
    }

    /**
    * @test
    */
    public function current_scope_returns_monthly_and_weekly_scheduled_expenses_due_today()
    {
        factory(Scheduled::class, 1)->create(['scheduled_day' => (new Carbon)->day, 'schedule_pattern_id' => 1]);
        factory(Scheduled::class, 2)->create(['scheduled_day' => (new Carbon)->dayOfWeekIso, 'schedule_pattern_id' => 2]);
        factory(Scheduled::class, 4)->create(['scheduled_day' => (new Carbon)->subDay(1)->day, 'schedule_pattern_id' => 1]);
        factory(Scheduled::class, 8)->create(['scheduled_day' => (new Carbon)->subDay(1)->dayOfWeekIso, 'schedule_pattern_id' => 2]);
        $expenses = Scheduled::current()->get()->count();

        $this->assertEquals(3, $expenses);
    }
}
