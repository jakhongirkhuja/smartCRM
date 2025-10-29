<?php

namespace Database\Seeders;

use App\Models\Customer;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CustomerSeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Customer::factory(10)->create();
        Customer::factory()->create([
            'name' => 'Test',
            'phone' => '+998906121812',
            'email' => 'test@test.test',
        ]);
    }
}
