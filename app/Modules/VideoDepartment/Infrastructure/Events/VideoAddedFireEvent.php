<?php

namespace App\Modules\VideoDepartment\Infrastructure\Events;

use App\Modules\VideoDepartment\Domain\VideoAddedFireEventInterface;

class VideoAddedFireEvent implements VideoAddedFireEventInterface
{
    public function execute(string $videoName, \DateTime $recordDate)
    {
        VideoAdded::dispatch($videoName, $recordDate);
    }
}
