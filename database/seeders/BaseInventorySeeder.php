<?php

namespace Database\Seeders;

use App\Models\Item;
use Illuminate\Database\Seeder;

class BaseInventorySeeder extends Seeder
{
    public function run(): void
    {
        $items = [
            ['name' => 'Dewalt 20V Max Cordless Drill', 'category' => 'Class IX'],
            ['name' => '5x8 Utility Trailer', 'category' => 'Class VII'],
            ['name' => 'Tactical Rucksack (OCP)', 'category' => 'Class II'],
            ['name' => 'Heavy Duty Floor Jack', 'category' => 'Class IX'],
            ['name' => 'KitchenAid Stand Mixer', 'category' => 'General'],
            ['name' => 'Portable Pressure Washer', 'category' => 'Class VII'],
            ['name' => 'Camping Tent (4-Person)', 'category' => 'Class II'],
            ['name' => 'Generator 5000W', 'category' => 'Class VII'],
            ['name' => 'Portable Space Heater', 'category' => 'Class IV'],
            ['name' => 'Folding Table & Chairs Set', 'category' => 'General'],
            ['name' => 'Welding Mask & Gloves', 'category' => 'Class IX'],
            ['name' => 'High-Speed Shop Vac', 'category' => 'Class IX'],
            ['name' => 'Air Compressor', 'category' => 'Class VII'],
            ['name' => 'Ladder 12ft Extension', 'category' => 'Class IV'],
            ['name' => 'Moving Dolly', 'category' => 'Class VII'],
        ];

        foreach ($items as $item) {
            Item::create([
                'user_id' => 1,
                'name' => $item['name'],
                'description' => 'Reliable, well-maintained equipment for base community use.',
                'category' => $item['category'],
                'condition' => 'Good',
                'availability_status' => 'available'
            ]);
        }
    }
}