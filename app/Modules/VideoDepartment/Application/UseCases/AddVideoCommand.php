<?php

namespace App\Modules\VideoDepartment\Application\UseCases;

use App\Modules\VideoDepartment\Application\DTOs\VideoDTO;
use App\Modules\VideoDepartment\Domain\Video;
use App\Modules\VideoDepartment\Domain\VideoRepositoryInterface;

class AddVideoCommand implements AddVideoCommandInterface
{
    /**
     * @param VideoRepositoryInterface $videoRepository
     */
    public function __construct(private VideoRepositoryInterface $videoRepository)
    {
    }

    /**
     * @param string $videoName
     * @param \DateTime $recordDate
     * @return VideoDTO
     */
    public function execute(string $videoName, \DateTime $recordDate): VideoDTO
    {
        $video = new Video($videoName, $recordDate);

        $video = $this->videoRepository->addVideo($video->getGuid(), $video->getVideoName(), $video->getRecordDate());

        return new VideoDTO($video->getGuid(), $video->getVideoName(), $video->getRecordDate());
    }
}
