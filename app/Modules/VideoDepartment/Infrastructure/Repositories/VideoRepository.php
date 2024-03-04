<?php

namespace App\Modules\VideoDepartment\Infrastructure\Repositories;

use App\Models\User;
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
    public function addVideo(Video $video): void
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

    /**
     * @param \DateTime $startRecordDate
     * @param \DateTime $endRecordDate
     * @return array
     */
    public function getVideo(\DateTime $startRecordDate, \DateTime $endRecordDate): array
    {
//        $result = DB::select(
//            "SELECT  v.guid as video_guid, v.video_name, v.record_date as record_date,
//                            c_m.guid as cameraman_guid, c_m.name as cameraman_name
//                    FROM videos v
//                    JOIN cameraman c_m ON v.cameraman_guid = c_m.guid
//                    WHERE record_date BETWEEN :startRecordDate AND :endRecordDate",
//            ['startRecordDate' => $startRecordDate, 'endRecordDate' => $endRecordDate]);

        //      $videoArray = json_decode(json_encode($video), true);

        $result = DB::table('videos AS v')
            ->join('cameraman', 'v.cameraman_guid', '=', 'cameraman.guid')
            ->select(DB::raw('v.guid as video_guid, v.video_name, v.record_date as record_date,
                            cameraman.guid as cameraman_guid, cameraman.name as cameraman_name'))
            ->get();


        $resultArray = json_decode(json_encode($result), true);

        return $resultArray;
    }

    /**
     * @param string $guid
     * @param \DateTime $startRecordDate
     * @param int $chunkLength
     * @return array
     */
    public function getVideosByChunks(string $guid, \DateTime $startRecordDate, int $chunkLength): array
    {

        $video = DB::select(
            "SELECT  v.guid as video_guid, v.video_name, v.record_date as record_date,
                            c_m.guid as cameraman_guid, c_m.name as cameraman_name
                    FROM videos v
                    JOIN cameraman c_m ON v.cameraman_guid = c_m.guid
                    WHERE (record_date,v.guid) >= (:startRecordDate, :guid)
                    ORDER BY record_date
                    LIMIT :chunkLength",
            ['startRecordDate' => $startRecordDate, 'guid' => $guid, 'chunkLength' => $chunkLength]);

        $videoArray = json_decode(json_encode($video), true);

        return $videoArray;
    }
}
