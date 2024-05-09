<?php

namespace Tests\Feature;

use App\Models\Chirp;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class pizzatest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_example()
    {
        $response = $this->get('/chirps');

        $response->assertSee('chirps');
        $response->assertDontSee('chirps.favourites');
    }

    public function test_data()
    {
        $chirp = new Chirp(['pizza1', 'cheese, tomato', 'medium', 8.00]);

        $chirp->assertContains($chirp->name);
        $chirp->assertContains($chirp->toppings);
        $chirp->assertContains($chirp->size);
        $chirp->assertContains($chirp->price);

    }
}
