<?php

namespace App\Modules\VideoDepartment\Infrastructure\Repositories;

use App\Modules\VideoDepartment\Domain\Video;
use App\Modules\VideoDepartment\Domain\VideoRepositoryInterface;
use App\Modules\VideoDepartment\Infrastructure\Eloquent\VideosEloquent;
use Illuminate\Support\Facades\DB;

class VideoRepository implements VideoRepositoryInterface
{
    /**
     * @param string $guid
     * @param string $videoName
     * @param \DateTime $recordDate
     * @return Video
     */
    public function addVideo(string $guid, string $videoName, \DateTime $recordDate): Video
    {

        $video = VideosEloquent::create(
            [
                'guid' => $guid,
                'video_name' => $videoName,
                'record_date' => $recordDate
            ]
        );

        return new Video($video->video_name, $video->record_date, $video->guid);
    }
}
