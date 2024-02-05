<?php

namespace Database\Seeders;

use App\Modules\VideoDepartment\Infrastructure\Eloquent\VideosEloquent;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class VideoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        VideosEloquent::factory(10000)->create();
    }
}
