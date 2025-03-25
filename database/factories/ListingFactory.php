<?php

use App\Models\User;
use App\Models\Listing;
use Illuminate\Database\Eloquent\Factories\Factory;

class ListingFactory extends Factory
{
    protected $model = Listing::class;

    public function definition()
    {
        return [
            'title' => $this->faker->sentence(3),
            'company' => $this->faker->company,
            'location' => $this->faker->city,
            'email' => $this->faker->unique()->safeEmail,
            'website' => $this->faker->url,
            'tags' => implode(',', $this->faker->words(3)),
            'description' => $this->faker->paragraph(3),
            'user_id' => User::inRandomOrder()->first()->id ?? 1, // Ensure it picks an existing user
            'logo' => 'logos/demo-logo.png', // Change as needed
            'status' => $this->faker->randomElement(['pending', 'approved', 'rejected']),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
