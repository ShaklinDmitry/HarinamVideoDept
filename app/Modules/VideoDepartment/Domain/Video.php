<?php

namespace App\Modules\VideoDepartment\Domain;

use Illuminate\Support\Str;

class Video
{

    /**
     * @param string $videoName
     * @param \DateTime $recordDate
     * @param string|null $guid
     */
    public function __construct(private string $videoName, private \DateTime $recordDate, private ?string $guid = null)
    {
        if (!$this->guid)
        {
            $this->guid = Str::uuid();
        }
    }

    /**
     * @return string
     */
    public function getVideoName(): string
    {
        return $this->videoName;
    }


    /**
     * @return \DateTime
     */
    public function getRecordDate(): \DateTime
    {
        return $this->recordDate;
    }

    /**
     * @return string|null
     */
    public function getGuid(): ?string
    {
        return $this->guid;
    }
}
