<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\User;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Carbon\Carbon;

class PeriodTest extends TestCase
{
    use WithFaker, RefreshDatabase;

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
    public function sets_preset_month_to_session()
    {
        $end = Carbon::now();
        $response = $this->actingAs($this->user)
                ->post('/period', [
                    'preset' => 'month',
                ]);
        $this->assertEquals(Carbon::now()->startOfMonth(), session('period')[0]);
        $this->assertTrue(session('period')[1]->isSameDay(Carbon::now()));
    }

    /**
     * @test
     *
     * @return void
     */
    public function sets_preset_week_to_session()
    {
        $end = Carbon::now();
        $response = $this->actingAs($this->user)
                ->post('/period', [
                    'preset' => 'week',
                ]);
        $this->assertEquals(Carbon::now()->startOfWeek(), session('period')[0]);
        $this->assertTrue(session('period')[1]->isSameDay(Carbon::now()));
    }

    /**
     * @test
     *
     * @return void
     */
    public function sets_preset_year_to_session()
    {
        $end = Carbon::now();
        $response = $this->actingAs($this->user)
                ->post('/period', [
                    'preset' => 'year',
                ]);
        $this->assertEquals(Carbon::now()->startOfYear(), session('period')[0]);
        $this->assertTrue(session('period')[1]->isSameDay(Carbon::now()));
    }

    /**
     * @test
     *
     * @return void
     */
    public function sets_preset_7days_to_session()
    {
        $end = Carbon::now();
        $response = $this->actingAs($this->user)
                ->post('/period', [
                    'preset' => '7days',
                ]);
        $this->assertTrue(session('period')[0]->isSameDay(Carbon::now()->subWeek()));
        $this->assertTrue(session('period')[1]->isSameDay(Carbon::now()));
    }

    /**
     * @test
     *
     * @return void
     */
    public function sets_preset_1month_to_session()
    {
        $end = Carbon::now();
        $response = $this->actingAs($this->user)
                ->post('/period', [
                    'preset' => '1mth',
                ]);
        $this->assertTrue(session('period')[0]->isSameDay(Carbon::now()->subMonth()));
        $this->assertTrue(session('period')[1]->isSameDay(Carbon::now()));
    }

    /**
     * @test
     *
     * @return void
     */
    public function sets_preset_3months_to_session()
    {
        $end = Carbon::now();
        $response = $this->actingAs($this->user)
                ->post('/period', [
                    'preset' => '3mths',
                ]);
        $this->assertTrue(session('period')[0]->isSameDay(Carbon::now()->subMonth(3)));
        $this->assertTrue(session('period')[1]->isSameDay(Carbon::now()));
    }

    /**
     * @test
     *
     * @return void
     */
    public function sets_preset_1year_to_session()
    {
        $end = Carbon::now();
        $response = $this->actingAs($this->user)
                ->post('/period', [
                    'preset' => '1year',
                ]);
        $this->assertTrue(session('period')[0]->isSameDay(Carbon::now()->subYear(1)));
        $this->assertTrue(session('period')[1]->isSameDay(Carbon::now()));
    }

    /**
     * @test
     *
     * @return void
     */
    public function sets_custom_period_to_session()
    {
        $end = Carbon::now();
        $start = Carbon::now()->subMonth();
        $response = $this->actingAs($this->user)
                ->post('/period/custom', [
                    'start_date' => $start,
                    'end_date' => $end,
                ]);
        $this->assertTrue(session('period')[0]->isSameDay($start));
        $this->assertTrue(session('period')[1]->isSameDay($end));
    }

    /**
     * @test
     *
     * @return void
     */
    public function end_date_must_be_after_start_date()
    {
        $end = Carbon::now();
        $start = Carbon::now()->addMonth();
        $response = $this->actingAs($this->user)
                ->post('/period/custom', [
                    'start_date' => $start,
                    'end_date' => $end,
                ]);
        $response->assertSessionHasErrors(['start_date']);
    }
}
