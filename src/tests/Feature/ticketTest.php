<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ticketTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {
        $data = [
            'name' => 'TestName',
            'email' => 'testemail@email.com',
            'phone' => '+998991234567',
            'subject' => 'test theme',
            'message' => 'message test',
        ];

        $response = $this->postJson('api/tickets', $data);
        $response->assertStatus(201);
        $this->assertDatabaseHas('tickets', ['theme' => 'test theme']);
    }
}
