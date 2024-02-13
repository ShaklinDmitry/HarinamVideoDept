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
    public function execute(string $videoName, \DateTime $recordDate, string $cameraManName): VideoDTO
    {
        $video = new Video($videoName, $recordDate);

        $cameraMan = $video->addCameraMan($cameraManName);

        $this->videoRepository->addVideo($video);

        $this->videoAddedFireEvent->execute($video->getVideoName(), $video->getRecordDate());

        return new VideoDTO($video->getGuid(), $video->getVideoName(), $video->getRecordDate());
    }
}
