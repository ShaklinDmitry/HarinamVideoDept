<?php

namespace App\Modules\VideoDepartment\Application\UseCases\SaveVideoFromFile;


interface SaveVideoFromFileCommandInterface
{

    public function execute(string $fileName);
}
