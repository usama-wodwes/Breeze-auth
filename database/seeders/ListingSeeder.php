<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Listing;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class ListingSeeder extends Seeder
{
    public function run()
    {
        // Ensure at least 5 users exist
        if (User::count() < 5) {
            User::factory(5)->create();
        }

        // Get random users
        $userIds = User::pluck('id')->toArray();

        // Truncate table to prevent duplicates (Optional, use with caution)
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('listings')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        // Create 20 fake listings
        for ($i = 1; $i <= 20; $i++) {
            Listing::create([
                'user_id' => $userIds[array_rand($userIds)], // Picks a valid user
                'title' => 'Demo Listing ' . $i,
                'logo' => 'logos/demo-logo.png', // Change to actual file path if needed
                'tags' => implode(',', ['Laravel', 'PHP', 'Backend']), // Randomized tags
                'company' => 'Company ' . $i,
                'location' => 'City ' . $i,
                'email' => 'demo' . $i . '@example.com',
                'website' => 'https://example' . $i . '.com',
                'description' => 'This is a demo listing for Company ' . $i . '.',
                'status' => ['pending', 'approved', 'rejected'][rand(0, 2)], // Randomized status
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        echo "✅ 20 Demo Listings Created Successfully!\n";
    }
}
