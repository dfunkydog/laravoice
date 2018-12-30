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

    public function setup()
    {
        parent::setUp();
        $this->user = factory(User::class)->create();
    }

    /**
     * @test
     *
     * @return void
     */
    public function sets_start_preset_month_to_session()
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
    public function sets_start_preset_week_to_session()
    {
        $end = Carbon::now();
        $response = $this->actingAs($this->user)
                ->post('/period', [
                    'preset' => 'week',
                ]);
        $this->assertEquals(Carbon::now()->startOfWeek(), session('period')[0]);
        $this->assertTrue(session('period')[1]->isSameDay(Carbon::now()));
    }
}
