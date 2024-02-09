<?php

namespace App\Modules\VideoDepartment\Domain;

interface VideoAddedFireEventInterface
{
    /**
     * @param string $videoName
     * @param \DateTime $recordDate
     * @return mixed
     */
    public function execute(string $videoName, \DateTime $recordDate);
}
