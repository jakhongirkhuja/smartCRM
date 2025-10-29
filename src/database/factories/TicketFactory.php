<?php

namespace Database\Factories;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Ticket>
 */
class TicketFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $status = $this->faker->randomElement(['new', 'progress', 'done']);
        $data = [
            'theme' => $this->faker->sentence(),
            'message' => $this->faker->paragraph(),
            'status' => $status,
            'customer_id' => null,
        ];

        if (in_array($status, ['in_progress', 'done'])) {
            $data['user_id'] = User::inRandomOrder()->first()?->id ?? 1;
            $data['reply_at'] = Carbon::now()->addDays(rand(1, 5));
        }
        return $data;
    }
}
