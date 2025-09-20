<?php

namespace Database\Seeders;

use App\Models\StreamType;
use Illuminate\Database\Seeder;

class StreamTypeSeeder extends Seeder
{
    public function run()
    {
        $types = ['Sports', 'E-Book', 'Podcast', 'Arts', 'Music'];
        foreach ($types as $type) {
            StreamType::create(['name' => $type]);
        }
    }
}
