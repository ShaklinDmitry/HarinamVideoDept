<?php

namespace App\Modules\VideoDepartment\Domain;

interface StatisticsInterface
{
    /**
     * @param array $video
     * @return mixed
     */
    public function createFile(array $video);


    /**
     * @param string $fileName
     * @return mixed
     */
    public function readFile(string $fileName);
}
