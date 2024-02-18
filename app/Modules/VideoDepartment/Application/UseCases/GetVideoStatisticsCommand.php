<?php

namespace App\Modules\VideoDepartment\Application\UseCases;

use App\Modules\VideoDepartment\Domain\StatisticsInterface;
use App\Modules\VideoDepartment\Domain\VideoRepositoryInterface;

class GetVideoStatisticsCommand implements GetVideoStatisticsCommandInterface
{

    /**
     * @param VideoRepositoryInterface $videoRepository
     * @param StatisticsInterface $statistics
     */
    public function __construct(private VideoRepositoryInterface $videoRepository,
                                private StatisticsInterface      $statistics)
    {
    }

    /**
     * @param \DateTime $startRecordDate
     * @param \DateTime $endRecordDate
     * @return mixed|void
     */
    public function execute(\DateTime $startRecordDate, \DateTime $endRecordDate)
    {
        $video = $this->videoRepository->getVideo($startRecordDate, $endRecordDate);

        $file = $this->statistics->createFile($video);

        return $file;
    }
}
