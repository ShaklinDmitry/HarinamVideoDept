<?php

namespace App\Modules\VideoDepartment\Application\UseCases;

interface GetVideoStatisticsCommandInterface
{
    /**
     * @param \DateTime $startDate
     * @param \DateTime $endDate
     * @return mixed
     */
    public function execute(\DateTime $startDate, \DateTime $endDate);
}
