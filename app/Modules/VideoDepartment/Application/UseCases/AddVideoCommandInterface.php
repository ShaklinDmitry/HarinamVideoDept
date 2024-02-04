<?php

namespace App\Modules\VideoDepartment\Application\UseCases;

use App\Modules\VideoDepartment\Application\DTOs\VideoDTO;

interface AddVideoCommandInterface
{
    /**
     * @param string $videoName
     * @param \DateTime $recordDate
     * @return VideoDTO
     */
    public function execute(string $videoName, \DateTime $recordDate): VideoDTO;
}
