<?php

namespace Tests\Feature;

use App\Modules\VideoDepartment\Application\UseCases\AddVideoCommandInterface;
use App\Modules\VideoDepartment\Infrastructure\Events\VideoAdded;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Event;
use Tests\TestCase;

class AddVideoCommandTest extends TestCase
{

    use RefreshDatabase;

    public function test_add_video_command(): void
    {
        Event::fake();

        $videoName = 'testName';
        $recordDate = new \DateTime();
        $cameraManName = 'testname';

        $addVideoCommand = app(AddVideoCommandInterface::class);
        $addVideoCommand->execute($videoName, $recordDate, $cameraManName);

        Event::assertDispatched(VideoAdded::class);

        $this->assertDatabaseHas(
            'videos',
            [
                'video_name' => $videoName,
                'record_date' => $recordDate
            ]
        );

        $this->assertDatabaseHas(
            'cameraman',
            [
                'name' => $cameraManName
            ]
        );
    }


    public function test_add_video_api()
    {
        $response = $this->post('/api/video',
            [
                'videoName' => 'Harinam Jan 9st',
                'recordDate' => '2024-01-12 12:11:00',
                'cameramanName' => 'testName'
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
