<?php

namespace Tests\Feature;

use App\Modules\VideoDepartment\Application\UseCases\AddVideoCommandInterface;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AddVideoCommandTest extends TestCase
{

    use RefreshDatabase;

    public function test_add_video_command(): void
    {
        $videoName = 'testName';
        $recordDate = new \DateTime();

        $addVideoCommand = app(AddVideoCommandInterface::class);
        $addVideoCommand->execute($videoName, $recordDate);

        $this->assertDatabaseHas(
            'videos',
            [
                'video_name' => $videoName,
                'record_date' => $recordDate
            ]
        );
    }


    public function test_add_video_api()
    {
        $response = $this->post('/api/video',
            [
                'videoName' => 'Harinam Jan 9st',
                'recordDate' => '2024-01-12 12:11:00'
            ],
            ["Accept" => "application/json"]);

        $response->assertJson(
            [
                "data" => [
                    "message" => "Video was added.",
                    "video" => [
                        'videoName' => 'Harinam Jan 9st',
                        'recordDate' => '2024-01-12 12:11:00'
                    ]
                ]
            ]
        );


    }

}
