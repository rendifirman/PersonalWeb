<?php

namespace Database\Seeders;

use App\Models\Experience;
use App\Models\HomepageSetting;
use App\Models\Project;
use App\Models\Review;
use App\Models\Service;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Admin Portfolio',
            'email' => 'admin@example.com',
            'password' => 'secret123',
            'role' => 'admin',
        ]);

        User::factory()->create([
            'name' => 'Visitor User',
            'email' => 'user@example.com',
            'password' => 'secret123',
            'role' => 'user',
        ]);

        HomepageSetting::create([
            'hero_title' => 'Hi, I’m Rendi — a creative web developer',
            'hero_subtitle' => 'I help brands grow with clean, modern websites and digital products.',
            'hero_description' => 'Saya menggabungkan desain elegan dengan fungsi yang mudah digunakan, fokus pada user experience dan hasil yang nyata untuk bisnis dan personal branding.',
            'cta_text' => 'Lihat Project',
            'name' => 'Rendi Firmansyah',
            'title' => 'Web Developer & UI/UX Designer',
            'bio' => 'Membangun website modern dengan fokus pada brand, user experience, dan performa yang cepat.',
            'email' => 'hello@rendifirmansyah.dev',
            'phone' => '+62 812 3456 7890',
            'location' => 'Jakarta, Indonesia',
            'about_title' => 'Tentang Saya',
            'about_text' => 'Saya memiliki pengalaman membuat website brand, portofolio, dan aplikasi kecil dengan fokus pada UI/UX yang bersih, interaksi yang responsif, dan performa optimal.',
            'skills' => 'Laravel, PHP, Tailwind CSS, JavaScript, Figma, Git',
            'linkedin' => 'https://linkedin.com/in/rendifirmansyah',
            'instagram' => 'https://instagram.com/rendifirmansyah',
            'github' => 'https://github.com/rendifirmansyah',
            'twitter' => 'https://twitter.com/rendifirmansyah',
        ]);

        Experience::create([
            'title' => 'Web Developer',
            'company' => 'Freelance Projects',
            'period' => '2023 - Sekarang',
            'description' => 'Membangun situs portofolio, landing page branding, dan dashboard admin dengan sistem CRUD serta integrasi database.',
            'show_on_homepage' => true,
        ]);

        Experience::create([
            'title' => 'Junior Front-End Developer',
            'company' => 'Startup Digital',
            'period' => '2022 - 2023',
            'description' => 'Mengembangkan antarmuka responsif dan animasi interaktif untuk meningkatkan engagement pengguna.',
            'show_on_homepage' => true,
        ]);

        Project::create([
            'title' => 'Portfolio Website',
            'description' => 'Situs portofolio terintegrasi database dengan admin dashboard untuk mengelola project, pengalaman, dan konten utama.',
            'tags' => 'Laravel, Tailwind, CRUD',
            'show_on_homepage' => true,
        ]);

        Project::create([
            'title' => 'Brand Landing Page',
            'description' => 'Landing page brand dengan elemen visual modern, testimonial, dan formulir kontak yang responsif.',
            'tags' => 'UI/UX, Responsif, Branding',
            'show_on_homepage' => true,
        ]);

        Review::create([
            'name' => 'Aulia',
            'role' => 'Client',
            'rating' => 5,
            'message' => 'Profesional, cepat tanggap, dan hasilnya sangat memuaskan. Website saya jadi tampil lebih modern.',
            'approved' => true,
        ]);

        Review::create([
            'name' => 'Dwi',
            'role' => 'Partner',
            'rating' => 5,
            'message' => 'Kerja sama yang lancar dan desainnya sangat menarik. Direkomendasikan untuk personal branding.',
            'approved' => true,
        ]);

        $this->call([
            ServiceSeeder::class,
        ]);
    }
}
