<?php

namespace Database\Seeders;

use App\Models\Topic;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TopicSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Topic::create([
            'name' => 'Laravel',
        ]);
        Topic::create([
            'name' => 'PHP',
        ]);
        Topic::create([
            'name' => 'Business',
        ]);
        Topic::create([
            'name' => 'JavaScript',
        ]);
    }
}
