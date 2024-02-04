<?php

namespace App\Modules\VideoDepartment\Application\DTOs;

class VideoDTO
{

    /**
     * @param string $guid
     * @param string $videoName
     * @param \DateTime $recordDate
     */
    public function __construct(private string $guid, private string $videoName, private \DateTime $recordDate)
    {
    }

    /**
     * @return string
     */
    public function getGuid(): string
    {
        return $this->guid;
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
     * @return array
     */
    public function toArray(): array
    {
        return get_object_vars($this);
    }

}
