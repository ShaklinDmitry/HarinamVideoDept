<?php

namespace Tests\Feature;

use App\Modules\VideoDepartment\Application\UseCases\GetVideoStatistics\GetVideoStatisticsCommandInterface;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Tests\TestCase;

class CreateStatisticsTest extends TestCase
{

    public function test_create_statistics(): void
    {
        $getVideoStatisticsCommand =  app(GetVideoStatisticsCommandInterface::class);

        $file = $getVideoStatisticsCommand->execute(new \DateTime('yesterday'), new \DateTime('now'));

        $this->assertInstanceOf(BinaryFileResponse::class, $file);
    }

    public function test_create_statistics_api(){
        $response = $this->get('/api/statistics?startRecordDate=2024-01-12 00:11:00&endRecordDate=2024-01-12 12:11:00');

        $this->assertInstanceOf(BinaryFileResponse::class, $response->baseResponse);
    }

}
