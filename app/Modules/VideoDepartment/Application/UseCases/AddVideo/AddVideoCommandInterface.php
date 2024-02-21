<?php

namespace App\Modules\VideoDepartment\Application\UseCases\AddVideo;

use App\Modules\VideoDepartment\Application\DTOs\VideoDTO;

interface AddVideoCommandInterface
{
    /**
     * @param string $videoName
     * @param \DateTime $recordDate
     * @param string $cameraManName
     * @return VideoDTO
     */
    public function execute(string $videoName, \DateTime $recordDate, string $cameraManName): VideoDTO;
}
