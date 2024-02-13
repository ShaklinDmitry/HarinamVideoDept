<?php

namespace App\Modules\VideoDepartment\Domain;

use Illuminate\Support\Str;

class Cameraman
{

    /**
     * @param string $name
     * @param string|null $guid
     */
    public function __construct(private string $name, private ?string $guid = null)
    {
        if (!$this->guid)
        {
            $this->guid = Str::uuid();
        }
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string|null
     */
    public function getGuid(): ?string
    {
        return $this->guid;
    }
}
