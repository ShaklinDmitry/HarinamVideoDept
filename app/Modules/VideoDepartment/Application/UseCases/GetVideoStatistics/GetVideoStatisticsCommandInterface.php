<?php

namespace App\Modules\VideoDepartment\Application\UseCases\GetVideoStatistics;

interface GetVideoStatisticsCommandInterface
{
    /**
     * @param \DateTime $startRecordDate
     * @param \DateTime $endRecordDate
     * @return mixed
     */
    public function execute(\DateTime $startRecordDate, \DateTime $endRecordDate);
}
