<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Booking;
use App\Models\Room;
use Faker\Factory as Faker;

class BookingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        $statuses = ['pending', 'confirmed', 'checked_in', 'checked_out', 'cancelled'];
        $roomIds = Room::pluck('id')->toArray();
        $userIds = \App\Models\User::pluck('id', 'username');
        for ($i = 0; $i < 30; $i++) {
            $checkIn = $faker->dateTimeBetween('-1 month', '+1 month');
            $checkOut = (clone $checkIn)->modify('+' . rand(1, 5) . ' days');
            $username = $faker->randomElement(array_keys($userIds->toArray()));
            Booking::create([
                'user_id' => $userIds[$username],
                'room_id' => $faker->randomElement($roomIds),
                'customer_name' => $faker->name,
                'customer_username' => $username,
                'check_in' => $checkIn->format('Y-m-d'),
                'check_out' => $checkOut->format('Y-m-d'),
                'status' => $faker->randomElement($statuses),
                'note' => $faker->optional()->sentence(8),
            ]);
        }
    }
}
