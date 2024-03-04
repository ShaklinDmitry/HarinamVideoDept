<?php

namespace App\Modules\VideoDepartment\Application\UseCases\GetVideo;

use App\Modules\VideoDepartment\Domain\VideoRepositoryInterface;

class GetVideoCommand implements GetVideoCommandInterface
{

    /**
     * @param VideoRepositoryInterface $videoRepository
     */
    public function __construct(private VideoRepositoryInterface $videoRepository)
    {
    }

    /**
     * @param string $guid
     * @param \DateTime $startRecordDate
     * @param int $chunkLength
     * @return array
     */
    public function execute(string $guid, \DateTime $startRecordDate, int $chunkLength): array
    {
        return $this->videoRepository->getVideosByChunks($guid, $startRecordDate, $chunkLength);
    }
}
