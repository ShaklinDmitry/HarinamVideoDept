<?php

namespace App\Modules\VideoDepartment\Infrastructure\Eloquent;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CameramanEloquent extends Model
{
    use HasFactory;

    protected $primaryKey = 'guid';

    protected $guarded = [];

    protected $table = 'cameraman';

    /**
     * @return CameramanEloquentFactory
     */
    protected static function newFactory()
    {
        return CameramanEloquentFactory::new();
    }
}
