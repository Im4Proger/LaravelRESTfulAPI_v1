<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ApiGoodTest extends TestCase
{
    use WithFaker;

    private $token = '2|02dvmPMiQZDfGmP4dqTeyk6DWfxHIcG4I0kX8wgO';

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testGoodStoreSuccessfully()
    {
        $payload = [
            'data' => [
                'name' => $this->faker->sentence(5),
                'text' => $this->faker->text(255),
                'price' => $this->faker->numberBetween(100,500),
                'url' => $this->faker->slug(),
                'is_public' => $this->faker->numberBetween(0,1),
                'categories' => array(random_int(1,10)),
            ]
        ];

        $this->withHeaders([
            'Authorization' => 'Bearer '. $this->token,
        ])->json('post', 'api/good/create', $payload)
            ->assertStatus(200)
            ->assertJsonStructure(
                [
                    'success',
                    'message'
                ]
            );
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testGoodUpdateSuccessfully()
    {
        $payload = [
            'data' => [
                'id' => $this->faker->numberBetween(1,10),
                'name' => $this->faker->sentence(5),
                'text' => $this->faker->text(255),
                'price' => $this->faker->numberBetween(100,500),
                'url' => $this->faker->slug(),
                'is_public' => $this->faker->numberBetween(0,1),
            ]
        ];

        $this->withHeaders([
            'Authorization' => 'Bearer '. $this->token,
        ])->json('put', 'api/good/edit', $payload)
            ->assertStatus(200)
            ->assertJsonStructure(
                [
                    'success',
                    'message'
                ]
            );
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testGoodDestroySuccessfully()
    {
        $payload = [
            'data' => [
                'id' => $this->faker->numberBetween(1,10),
            ]
        ];

        $this->withHeaders([
            'Authorization' => 'Bearer '. $this->token,
        ])->json('delete', 'api/good/delete', $payload)
            ->assertStatus(200)
            ->assertJsonStructure(
                [
                    'success',
                    'message'
                ]
            );
    }
}
