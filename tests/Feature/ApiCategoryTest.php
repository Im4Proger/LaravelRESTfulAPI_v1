<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ApiCategoryTest extends TestCase
{
    use WithFaker;

    private $token = '2|02dvmPMiQZDfGmP4dqTeyk6DWfxHIcG4I0kX8wgO';

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testCategoryStoreSuccessfully()
    {
        $payload = [
            'data' => [
                'name' => $this->faker->sentence(2),
                'url' => $this->faker->slug(),
            ]
        ];

        $this->withHeaders([
            'Authorization' => 'Bearer '. $this->token,
        ])->json('post', 'api/category/create', $payload)
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
    public function testCategoryDestroySuccessfully()
    {
        $payload = [
            'data' => [
                'id' => $this->faker->numberBetween(1,10),
            ]
        ];

        $this->withHeaders([
            'Authorization' => 'Bearer '. $this->token,
        ])->json('delete', 'api/category/delete', $payload)
            ->assertStatus(200)
            ->assertJsonStructure(
                [
                    'success',
                    'message'
                ]
            );
    }
}
