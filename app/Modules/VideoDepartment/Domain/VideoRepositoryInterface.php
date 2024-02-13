<?php

namespace App\Modules\VideoDepartment\Domain;

interface VideoRepositoryInterface
{

    /**
     * @param Video $video
     * @return mixed
     */
    public function addVideo(Video $video);
}
