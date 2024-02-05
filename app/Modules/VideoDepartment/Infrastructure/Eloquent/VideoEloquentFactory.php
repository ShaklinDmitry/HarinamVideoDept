<?php

namespace App\Modules\VideoDepartment\Infrastructure\Eloquent;

use App\Modules\Pictures\Infrastructure\Eloquent\ImageEloquent;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Modules\VideoDepartment\Infrastructure\Eloquent\VideosEloquent>
 */
class VideoEloquentFactory extends Factory
{

    protected $model = VideosEloquent::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'guid' => fake()->uuid(),
            'video_name' => fake()->text(10),
            'record_date' => fake()->dateTime(),
        ];
    }
}
