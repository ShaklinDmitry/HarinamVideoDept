<?php

namespace Database\Seeders;

use App\Modules\VideoDepartment\Infrastructure\Eloquent\CameramanEloquent;
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
        $video = [];
        $cameraman = [];
        for($i = 0; $i < 10000; $i++){

            $video[$i]['cameraman_guid'] = fake()->uuid();

            $cameraman[$i]['guid'] = $video[$i]['cameraman_guid'];

            CameramanEloquent::factory()->create([
                'guid' => $cameraman[$i]['guid'],
            ]);

            VideosEloquent::factory()->create(
                [
                    'cameraman_guid' => $video[$i]['cameraman_guid']
                ]
            );

        }


    }
}
