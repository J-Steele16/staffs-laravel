<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ordertest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_example()
    {
        $response = $this->get('/chirps.favourites');

        $response->assertSee('chirps.favourites');
        $response->assertDontSee('chirps');
    }

    public function test_data()
    {
        $favourites = [['pizza1', 'cheese, tomato', 'medium', 8.00], ['pizza2', 'cheese, tomato', 'large', 15.00]];

        $this->assertContains(['pizza1', 'cheese, tomato', 'medium', 8.00], $favourites);

    }
}
