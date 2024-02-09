<?php

namespace App\Modules\VideoDepartment\Application\UseCases;

use App\Modules\VideoDepartment\Application\DTOs\VideoDTO;
use App\Modules\VideoDepartment\Domain\VideoAddedFireEventInterface;
use App\Modules\VideoDepartment\Domain\Video;
use App\Modules\VideoDepartment\Domain\VideoRepositoryInterface;

class AddVideoCommand implements AddVideoCommandInterface
{
    /**
     * @param VideoRepositoryInterface $videoRepository
     * @param VideoAddedFireEventInterface $videoAddedFireEvent
     */
    public function __construct(private VideoRepositoryInterface $videoRepository, private VideoAddedFireEventInterface $videoAddedFireEvent)
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

        $this->videoAddedFireEvent->execute($video->getVideoName(), $video->getRecordDate());

        return new VideoDTO($video->getGuid(), $video->getVideoName(), $video->getRecordDate());
    }
}
