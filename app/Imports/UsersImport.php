<?php

namespace App\Imports;

use App\Models\User;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;

class UsersImport implements ToCollection
{
    public function collection(Collection $rows)
    {
        $collection = new Collection();

        for($i=0; $i<30; $i++){
            $collection[] = array(fake()->text(), fake()->text(), fake()->text());
        }

    }
}
