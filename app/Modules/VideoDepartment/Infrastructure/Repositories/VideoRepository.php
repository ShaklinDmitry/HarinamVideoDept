<?php

namespace App\Modules\VideoDepartment\Infrastructure\Repositories;

use App\Modules\VideoDepartment\Domain\Video;
use App\Modules\VideoDepartment\Domain\VideoRepositoryInterface;
use App\Modules\VideoDepartment\Infrastructure\Eloquent\CameramanEloquent;
use App\Modules\VideoDepartment\Infrastructure\Eloquent\VideosEloquent;
use Illuminate\Support\Facades\DB;

class VideoRepository implements VideoRepositoryInterface
{
    /**
     * @param Video $video
     * @return mixed|void
     */
    public function addVideo(Video $video)
    {

        DB::transaction(function () use ($video) {

            $cameraman = $video->getCameraman();

            CameramanEloquent::create(
                [
                    'guid' => $cameraman->getGuid(),
                    'name' => $cameraman->getName()
                ]
            );

            VideosEloquent::create(
                [
                    'guid' => $video->getGuid(),
                    'video_name' => $video->getVideoName(),
                    'record_date' => $video->getRecordDate(),
                    'cameraman_guid' => $video->getCameraman()->getGuid()
                ]
            );

        });

    }
}
