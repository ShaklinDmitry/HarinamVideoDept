<?php

namespace App\Modules\VideoDepartment\Application\UseCases;

use App\Modules\VideoDepartment\Domain\VideoRepositoryInterface;

class GetVideoStatisticsCommand implements GetVideoStatisticsCommandInterface
{

    public function __construct(private VideoRepositoryInterface $videoRepository,
                                private StatisticsInterface $statisticsInfrastructure)
    {
    }

    /**
     * @param \DateTime $startDate
     * @param \DateTime $endDate
     * @return mixed|void
     */
    public function execute(\DateTime $startDate, \DateTime $endDate)
    {
        $video = $this->videoRepository->getVideo($startDate, $endDate);
//
//        через интерфейс получить сервис для работы с excel и csv

        $file = $this->statisticsInfrastructure->createFile($video);

        return $file;
    }
}
