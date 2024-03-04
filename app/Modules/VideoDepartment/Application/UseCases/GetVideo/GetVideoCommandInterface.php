<?php

namespace App\Modules\VideoDepartment\Application\UseCases\GetVideo;

interface GetVideoCommandInterface
{
    /**
     * @param string $guid
     * @param \DateTime $startRecordDate
     * @param int $chunkLength
     * @return mixed
     */
    public function execute(string $guid, \DateTime $startRecordDate, int $chunkLength): array;
}
