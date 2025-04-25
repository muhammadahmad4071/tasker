<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Tier;

class TierSeeder extends Seeder
{
    public function run(): void
    {
        Tier::truncate(); // Optional: clear old data first

        $tiers = [
            [
                'name' => 'Bronze',
                'benefits' => <<<TEXT
1x Earning
Get up to 5,000 views
Get up to 500 subscribers
Get up to 1,000 watch hours
Complete daily tasks to get rewards
TEXT,
                'required_tasks' => 0,
                'badge' => '🟫',
                'days_threshold' => 0,
                'default' => true,
            ],
            [
                'name' => 'Silver',
                'benefits' => <<<TEXT
1x Earning
100 Points Bonus
Get up to 10,000 views
Get up to 1,000 subscribers
Get up to 2,000 watch hours
Complete daily tasks to get rewards
TEXT,
                'required_tasks' => 30,
                'badge' => '🟪',
                'days_threshold' => 7,
                'default' => false,
            ],
            [
                'name' => 'Gold',
                'benefits' => <<<TEXT
1x Earning
250 Points Bonus
Get up to 50,000 views
Get up to 5,000 subscribers
Get up to 3,000 watch hours
Complete daily tasks to get rewards
TEXT,
                'required_tasks' => 50,
                'badge' => '🟨',
                'days_threshold' => 14,
                'default' => false,
            ],
            [
                'name' => 'Platinum',
                'benefits' => <<<TEXT
1.5x Faster Earning
500 Points Bonus
Get up to 100,000 views
Get up to 10,000 subscribers
Get up to 4,000 watch hours
Complete daily tasks to get rewards
Win 5,000 points every month
TEXT,
                'required_tasks' => 100,
                'badge' => '🟦',
                'days_threshold' => 28,
                'default' => false,
            ],
            [
                'name' => 'Diamond',
                'benefits' => <<<TEXT
2x Faster Earning
1000 Points Bonus
Unlimited views
Unlimited subscribers
Unlimited watch hours on multiple channels
Complete daily tasks to get rewards
Win 10,000 points every month
Win 1 monetized youtube channel
TEXT,
                'required_tasks' => 200,
                'badge' => '🟩',
                'days_threshold' => 48,
                'default' => false,
            ]
        ];

        foreach ($tiers as $tier) {
            Tier::create($tier);
        }
    }
}
