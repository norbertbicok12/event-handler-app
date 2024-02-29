<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $dateOfEvent1 = Carbon::create(2024, 3, 4, 18, 30, 0);
        $dateOfEvent2 = Carbon::create(2024, 3, 7, 15, 00, 0);
        $dateOfEvent3 = Carbon::create(2024, 3, 8, 20, 30, 0);

        DB::table('events')->insert([
            'title' => 'Grand Chess Tournament: Battle of the Minds',
            'location' => 'Ady tér 10',
            'place_of_event' => 'Szeged',
            'image' => 'default_image.jpg',
            'description' => 'Experience the thrill of competitive chess like never before at the Grand Chess Tournament: Battle of the Minds! Whether you\'re a seasoned player or a curious spectator, there\'s something for everyone at this premier chess event. Reserve your spot today and embark on an unforgettable journey into the world of chess excellence.',
            'date_of_event' => $dateOfEvent1,
            'user_visibility' => 'All',
            'creator_user_id' => '1',
        ]);

        DB::table('events')->insert([
            'title' => 'Art Exhibition',
            'location' => 'Ady tér 10',
            'place_of_event' => 'Szeged',
            'image' => 'default_image.jpg',
            'description' => 'Immerse yourself in the world of art at the Art Exhibition in Paris. Admire stunning works by renowned artists and discover emerging talents from around the globe.',
            'date_of_event' => $dateOfEvent2,
            'user_visibility' => 'All',
            'creator_user_id' => '1',
        ]);

        DB::table('events')->insert([
            'title' => 'Tech Conference',
            'location' => 'Ady tér 10',
            'place_of_event' => 'Szeged',
            'image' => 'default_image.jpg',
            'description' => 'Discover the latest trends and innovations in technology at the Tech Conference. Network with industry leaders, attend insightful talks, and explore cutting-edge products.',
            'date_of_event' => $dateOfEvent3,
            'user_visibility' => 'All',
            'creator_user_id' => '1',
        ]);
    }
}
