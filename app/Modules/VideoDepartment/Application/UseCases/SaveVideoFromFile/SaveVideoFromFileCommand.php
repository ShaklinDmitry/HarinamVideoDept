<?php

namespace App\Modules\VideoDepartment\Application\UseCases\SaveVideoFromFile;

use App\Modules\VideoDepartment\Domain\StatisticsInterface;

class SaveVideoFromFileCommand implements SaveVideoFromFileCommandInterface
{
    /**
     * @param StatisticsInterface $statistics
     */
    public function __construct(private StatisticsInterface $statistics)
    {
    }

    /**
     * @param string $fileName
     * @return void
     */
    public function execute(string $fileName)
    {
        $this->statistics->readFile($fileName);
    }
}
