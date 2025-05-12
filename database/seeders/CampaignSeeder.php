<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Campaign;

class CampaignSeeder extends Seeder
{
    public function run()
    {
        Campaign::create([
            'title' => 'Clean Water for All',
            'description' => 'Providing clean water to remote villages.',
            'target_amount' => 5000000,
            'contact_email' => 'mike.johnson@example.com',
           // 'image' => null,
        ]);

        Campaign::create([
            'title' => 'School Supplies for Children',
            'description' => 'Donate to help underprivileged children go to school.',
            'target_amount' => 3000000,
            'contact_email' => 'mike.johnson@example.com',
            //'image' => null,
        ]);
    }
}
