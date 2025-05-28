<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Room;
use Faker\Factory as Faker;

class RoomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        $types = ['Standard', 'Deluxe', 'Suite', 'Family'];
        $statuses = ['available', 'booked', 'maintenance'];
        for ($i = 0; $i < 20; $i++) {
            Room::create([
                'name' => 'Phòng ' . ($i + 1),
                'type' => $faker->randomElement($types),
                'price' => $faker->numberBetween(300000, 2000000),
                'description' => $faker->sentence(10),
                'status' => $faker->randomElement($statuses),
                'capacity' => $faker->numberBetween(2, 6),
                'image' => $faker->imageUrl(640, 480, 'hotel', true),
            ]);
        }
    }
}
