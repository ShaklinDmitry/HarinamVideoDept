<?php

namespace App\Modules\VideoDepartment\Infrastructure\Eloquent;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VideosEloquent extends Model
{
    use HasFactory;

    protected $primaryKey = 'guid';

    protected $guarded = [];

    protected $table = 'videos';

    protected static function newFactory()
    {
        return VideoEloquentFactory::new();
    }

}
