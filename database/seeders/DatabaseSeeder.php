<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        \App\Models\Angkatan::create([
            'angkatan' => 2021,
        ]);
        \App\Models\Angkatan::create([
            'angkatan' => 2022,
        ]);
        \App\Models\Kategori::create([
            'name_kategori' => 'HIMTI',
        ]);
        \App\Models\Kategori::create([
            'name_kategori' => 'Kampus',
        ]);
        \App\Models\Kategori::create([
            'name_kategori' => 'Teknologi',
        ]);

        \App\Models\Anggota::create([
            'name' => 'Test User',
            'nim' => '2255201000',
            'no_hp' => '',
            'email' => 'test@example.com',
            'id_angkatan' => mt_rand(1, 2),
        ]);
        \App\Models\Anggota::create([
            'name' => 'Test User',
            'nim' => '2255201001',
            'no_hp' => '',
            'email' => 'test1@example.com',
            'id_angkatan' => mt_rand(1, 2),
        ]);
        \App\Models\User::create([
            'name' => 'Muhamad Luthfi Sadli',
            'no_hp' => '',
            'email' => 'super-admin@email.com',
            'password' => '$2y$10$j4pyuZ7ms6XaueOOXbR/ZeBjL6aILK07e8SsxuxWNFcGmynPA9/E2' //admin123
        ]);
        \App\Models\Acara::create([
            'title' => 'ini Acara',
            'deskripsi' => 'Ini adalah acara',
            'jadwal' => '2022-12-27 08:26:49',
            'id_kategori' => mt_rand(1, 2),
            'image' => '',
        ]);
        \App\Models\Sharing::create([
            'title' => 'ini Sharing',
            'deskripsi' => 'Ini adalah Sharing',
            'jadwal' => now(),
            'id_kategori' => mt_rand(1, 2),
            'image' => '',
        ]);
        \App\Models\Artikel::create([
            'title' => 'ini Artikel',
            'deskripsi' => 'ini adalah artikel',
            'id_kategori' => mt_rand(1, 2),
            'image' => '',
        ]);
    }
}
