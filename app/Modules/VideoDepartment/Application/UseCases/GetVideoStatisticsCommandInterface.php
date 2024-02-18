<?php

namespace App\Modules\VideoDepartment\Application\UseCases;

interface GetVideoStatisticsCommandInterface
{
    /**
     * @param \DateTime $startRecordDate
     * @param \DateTime $endRecordDate
     * @return mixed
     */
    public function execute(\DateTime $startRecordDate, \DateTime $endRecordDate);
}
