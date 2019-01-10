<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\User;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Vendor as vendorModel;

class Vendor extends TestCase
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
    */
    public function index_passes_variables_to_view()
    {
        $vendorId = factory(vendorModel::class)->create()->id;
        $this->actingAs($this->user)
            ->get('vendor')->assertViewHas(['vendors', 'totalExpenses']);
    }

    /**
    * @test
    */
    public function show_passes_variables_to_view()
    {
        $vendorId = factory(vendorModel::class)->create()->id;
        $this->actingAs($this->user)
            ->get("vendor/{$vendorId}")->assertViewHas(['vendor', 'expenses']);
    }

    /**
     * User can create a vendor
     *
     * @test
     *
     * @return void
     */
    public function user_can_create_a_vendor()
    {
        $attributes = [
            'name' => $this->faker->company,
        ];
        $this->actingAs($this->user)->post('vendor', $attributes);

        $this->assertDatabaseHas('vendors', $attributes);
    }
}
