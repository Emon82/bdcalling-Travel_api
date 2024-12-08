<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
// use Illuminate\Database\Seeder;
use App\Models\TravelData;

class TravelDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Add sample travel data with additional details
        $travelData = [
            [
                'from' => 'Dhaka',
                'to' => 'Faridpur',
                'type' => 'bus',
                'route' => 'N4 Highway',
                'best_way' => 'Best for budget travelers',
                'available_time' => '06:00:00',
            ],
            [
                'from' => 'Dhaka',
                'to' => 'Faridpur',
                'type' => 'train',
                'route' => 'Main Railway Line',
                'best_way' => 'Best for comfort',
                'available_time' => '08:00:00',
            ],
            [
                'from' => 'Dhaka',
                'to' => 'Faridpur',
                'type' => 'flight',
                'route' => 'Shahjalal International to Barisal Airport',
                'best_way' => 'Fastest way',
                'available_time' => '10:00:00',
            ],
            [
                'from' => 'Dhaka',
                'to' => 'Chittagong',
                'type' => 'bus',
                'route' => 'N1 Expressway',
                'best_way' => 'Best for fast travel',
                'available_time' => '07:00:00',
            ],

            [
                'from' => 'Dhaka',
                'to' => 'Chittagong',
                'type' => 'train',
                'route' => 'Main Railway Line',
                'best_way' => 'Best for scenic views',
                'available_time' => '09:00:00',
            ],
            [
                'from' => 'Dhaka',
                'to' => 'Chittagong',
                'type' => 'flight',
                'route' => 'Dhaka to Shah Amanat Airport',
                'best_way' => 'Fastest and most expensive',
                'available_time' => '12:00:00',
            ],
            [
                'from' => 'Dhaka',
                'to' => 'Sylhet',
                'type' => 'bus',
                'route' => 'Sylhet Expressway',
                'best_way' => 'Comfortable but longer',
                'available_time' => '05:00:00',
            ],
            [
                'from' => 'Dhaka',
                'to' => 'Rajshahi',
                'type' => 'train',
                'route' => 'Rajshahi Railway Route',
                'best_way' => 'Best for local experience',
                'available_time' => '15:00:00',
            ],
            [
                'from' => 'Dhaka',
                'to' => 'Barisal',
                'type' => 'flight',
                'route' => 'Dhaka to Barisal Airport',
                'best_way' => 'Fastest',
                'available_time' => '14:00:00',
            ],
            [
                'from' => 'Dhaka',
                'to' => 'Delhi, India',
                'type' => 'flight',
                'route' => 'Shahjalal International to Indira Gandhi International',
                'best_way' => 'Direct flight, Fastest',
                'available_time' => '20:00:00',
            ],
            [
                'from' => 'Dhaka',
                'to' => 'Singapore',
                'type' => 'flight',
                'route' => 'Dhaka to Changi Airport',
                'best_way' => 'Direct flight, Fastest',
                'available_time' => '22:00:00',
            ],
            [
                'from' => 'Dhaka',
                'to' => 'Dubai, UAE',
                'type' => 'flight',
                'route' => 'Direct flight, Dhaka to Dubai',
                'best_way' => 'Direct flight, Quick and efficient',
                'available_time' => '18:00:00',
            ],
            [
                'from' => 'Dhaka',
                'to' => 'New York, USA',
                'type' => 'flight',
                'route' => 'Direct flight, Dhaka to JFK Airport',
                'best_way' => 'Fastest, Long flight',
                'available_time' => '03:00:00',
            ],
            [
                'from' => 'Dhaka',
                'to' => 'London, UK',
                'type' => 'flight',
                'route' => 'Dhaka to Heathrow Airport',
                'best_way' => 'Direct flight, Comfortable',
                'available_time' => '05:00:00',
            ],
            [
                'from' => 'Dhaka',
                'to' => 'Tokyo, Japan',
                'type' => 'flight',
                'route' => 'Direct flight, Dhaka to Narita International Airport',
                'best_way' => 'Direct flight, Efficient and fast',
                'available_time' => '23:00:00',
            ],
            [
                'from' => 'Dhaka',
                'to' => 'Paris, France',
                'type' => 'flight',
                'route' => 'Dhaka to Charles de Gaulle Airport',
                'best_way' => 'Comfortable and scenic flight',
                'available_time' => '01:00:00',
            ],
            [
                'from' => 'Dhaka',
                'to' => 'Sydney, Australia',
                'type' => 'flight',
                'route' => 'Dhaka to Kingsford Smith Airport',
                'best_way' => 'Direct flight, Long but comfortable',
                'available_time' => '10:00:00',
            ],
            [
                'from' => 'Dhaka',
                'to' => 'Berlin, Germany',
                'type' => 'flight',
                'route' => 'Dhaka to Tegel Airport',
                'best_way' => 'Comfortable and scenic route',
                'available_time' => '06:00:00',
            ],
            [
                'from' => 'Dhaka',
                'to' => 'Rome, Italy',
                'type' => 'flight',
                'route' => 'Dhaka to Leonardo da Vinci International Airport',
                'best_way' => 'Direct flight, Best for comfort',
                'available_time' => '04:00:00',
            ],

            [
                'from' => 'Dhaka',
                'to' => 'Bangkok, Thailand',
                'type' => 'flight',
                'route' => 'Dhaka to Suvarnabhumi Airport',
                'best_way' => 'Direct flight, Short and fast',
                'available_time' => '20:00:00',
            ],
            [
                'from' => 'Dhaka',
                'to' => 'Kuala Lumpur, Malaysia',
                'type' => 'flight',
                'route' => 'Dhaka to Kuala Lumpur International Airport',
                'best_way' => 'Fast and affordable flight',
                'available_time' => '17:00:00',
            ],
            [
                'from' => 'Dhaka',
                'to' => 'Istanbul, Turkey',
                'type' => 'flight',
                'route' => 'Dhaka to Istanbul Airport',
                'best_way' => 'Direct flight, Efficient and fast',
                'available_time' => '19:00:00',
            ],
            [
                'from' => 'Dhaka',
                'to' => 'Cairo, Egypt',
                'type' => 'flight',
                'route' => 'Dhaka to Cairo International Airport',
                'best_way' => 'Direct flight, Comfortable and efficient',
                'available_time' => '02:00:00',
            ],
            [
                'from' => 'Dhaka',
                'to' => 'Moscow, Russia',
                'type' => 'flight',
                'route' => 'Dhaka to Sheremetyevo International Airport',
                'best_way' => 'Fastest option, Direct flight',
                'available_time' => '13:00:00',
            ],


            [
                'from' => 'Dhaka',
                'to' => 'Cape Town, South Africa',
                'type' => 'flight',
                'route' => 'Dhaka to Cape Town International Airport',
                'best_way' => 'Comfortable and scenic',
                'available_time' => '21:00:00',
            ],

            [
                'from' => 'Dhaka',
                'to' => 'Rio de Janeiro, Brazil',
                'type' => 'flight',
                'route' => 'Dhaka to Galeão International Airport',
                'best_way' => 'Fastest flight with layovers',
                'available_time' => '04:00:00',
            ],
            [
                'from' => 'Dhaka',
                'to' => 'Buenos Aires, Argentina',
                'type' => 'flight',
                'route' => 'Dhaka to Ministro Pistarini International Airport',
                'best_way' => 'Fastest option with layovers',
                'available_time' => '15:00:00',
            ],

            [
                'from' => 'Dhaka',
                'to' => 'Lagos, Nigeria',
                'type' => 'flight',
                'route' => 'Dhaka to Murtala Muhammed International Airport',
                'best_way' => 'Efficient and fast flight',
                'available_time' => '12:00:00',
            ],

            [
                'from' => 'Dhaka',
                'to' => 'New Delhi, India',
                'type' => 'flight',
                'route' => 'Dhaka to Indira Gandhi International Airport',
                'best_way' => 'Direct flight, Fast and comfortable',
                'available_time' => '23:00:00',
            ],
            [
                'from' => 'Dhaka',
                'to' => 'Seoul, South Korea',
                'type' => 'flight',
                'route' => 'Dhaka to Incheon International Airport',
                'best_way' => 'Direct flight, Fast and efficient',
                'available_time' => '09:00:00',
            ],
            [
                'from' => 'Dhaka',
                'to' => 'Hong Kong',
                'type' => 'flight',
                'route' => 'Dhaka to Hong Kong International Airport',
                'best_way' => 'Fast and convenient flight',
                'available_time' => '16:00:00',
            ],
            [
                'from' => 'Dhaka',
                'to' => 'Taipei, Taiwan',
                'type' => 'flight',
                'route' => 'Dhaka to Taoyuan International Airport',
                'best_way' => 'Direct flight, Efficient and fast',
                'available_time' => '05:00:00',
            ],
            [
                'from' => 'Dhaka',
                'to' => 'Jakarta, Indonesia',
                'type' => 'flight',
                'route' => 'Dhaka to Soekarno-Hatta International Airport',
                'best_way' => 'Direct flight, Short and affordable',
                'available_time' => '23:00:00',
            ],
            [
                'from' => 'Dhaka',
                'to' => 'Lima, Peru',
                'type' => 'flight',
                'route' => 'Dhaka to Jorge Chávez International Airport',
                'best_way' => 'Efficient, with layovers',
                'available_time' => '14:00:00',
            ],

            [
                'from' => 'Dhaka',
                'to' => 'Singapore',
                'type' => 'flight',
                'route' => 'Dhaka to Changi Airport',
                'best_way' => 'Direct flight, Fastest',
                'available_time' => '20:00:00',
            ],
            [
                'from' => 'Dhaka',
                'to' => 'Manila, Philippines',
                'type' => 'flight',
                'route' => 'Dhaka to Ninoy Aquino International Airport',
                'best_way' => 'Fast and direct flight',
                'available_time' => '10:00:00',
            ],
            [
                'from' => 'Dhaka',
                'to' => 'Doha, Qatar',
                'type' => 'flight',
                'route' => 'Dhaka to Hamad International Airport',
                'best_way' => 'Direct flight, Comfortable',
                'available_time' => '22:00:00',
            ],
            [
                'from' => 'Dhaka',
                'to' => 'Copenhagen, Denmark',
                'type' => 'flight',
                'route' => 'Dhaka to Copenhagen Airport',
                'best_way' => 'Direct flight, Efficient and fast',
                'available_time' => '05:00:00',
            ],
            [
                'from' => 'Dhaka',
                'to' => 'Toronto, Canada',
                'type' => 'flight',
                'route' => 'Dhaka to Pearson International Airport',
                'best_way' => 'Direct flight, Fast and efficient',
                'available_time' => '23:00:00',
            ]

      ];

        // Bulk insert data
        TravelData::insert($travelData);
    }
}
