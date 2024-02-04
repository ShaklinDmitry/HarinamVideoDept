<?php

namespace App\Modules\VideoDepartment\Domain;

interface VideoRepositoryInterface
{
    /**
     * @param string $guid
     * @param string $videoName
     * @param \DateTime $recordDate
     * @return Video
     */
    public function addVideo(string $guid, string $videoName, \DateTime $recordDate): Video;
}
