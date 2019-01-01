<?php

namespace Tests\Feature;

use App\User;
use Carbon\Carbon;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;

class Expense extends TestCase
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
    public function a_user_can_create_an_expense()
    {
        $this->withoutExceptionHandling();
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
}
