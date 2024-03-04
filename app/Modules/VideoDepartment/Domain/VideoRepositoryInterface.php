<?php

namespace App\Modules\VideoDepartment\Domain;

interface VideoRepositoryInterface
{

    /**
     * @param Video $video
     * @return mixed
     */
    public function addVideo(Video $video);


    /**
     * @param \DateTime $startRecordDate
     * @param \DateTime $endRecordDate
     * @return mixed
     */
    public function getVideo(\DateTime $startRecordDate, \DateTime $endRecordDate);

    /**
     * @param string $guid
     * @param \DateTime $startRecordDate
     * @param int $chunkLength
     * @return mixed
     */
    public function getVideosByChunks(string $guid, \DateTime $startRecordDate, int $chunkLength);

}
