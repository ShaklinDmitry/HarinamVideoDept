<?php

namespace App\Modules\VideoDepartment\Infrastructure\Eloquent;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Modules\VideoDepartment\Infrastructure\Eloquent\CameramanEloquent>
 */
class CameramanEloquentFactory extends Factory
{

    protected $model = CameramanEloquent::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'guid' => fake()->uuid(),
            'name' => fake()->text(10),
        ];
    }
}
