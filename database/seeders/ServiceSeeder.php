<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Service::create([
            'title' => 'UI/UX Design',
            'description' => 'Desain antarmuka yang bersih, rapi, dan nyaman dipakai.',
            'icon' => 'design',
            'order' => 1,
            'is_active' => true,
        ]);

        Service::create([
            'title' => 'Web Design',
            'description' => 'Tampilan website modern untuk personal brand atau bisnis.',
            'icon' => 'web',
            'order' => 2,
            'is_active' => true,
        ]);

        Service::create([
            'title' => 'App Design',
            'description' => 'Desain aplikasi yang sederhana dan mudah dipahami.',
            'icon' => 'app',
            'order' => 3,
            'is_active' => true,
        ]);

        Service::create([
            'title' => 'Graphic Design',
            'description' => 'Visual pendukung seperti banner, poster, dan konten media sosial.',
            'icon' => 'graphic',
            'order' => 4,
            'is_active' => true,
        ]);
    }
}
