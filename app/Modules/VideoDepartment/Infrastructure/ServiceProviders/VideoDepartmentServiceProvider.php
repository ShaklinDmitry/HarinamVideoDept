<?php

namespace App\Modules\VideoDepartment\Infrastructure\ServiceProviders;

use App\Modules\VideoDepartment\Application\UseCases\AddVideoCommand;
use App\Modules\VideoDepartment\Application\UseCases\AddVideoCommandInterface;
use App\Modules\VideoDepartment\Domain\VideoAddedFireEventInterface;
use App\Modules\VideoDepartment\Domain\VideoRepositoryInterface;
use App\Modules\VideoDepartment\Infrastructure\Events\VideoAddedFireEvent;
use App\Modules\VideoDepartment\Infrastructure\Repositories\VideoRepository;
use Illuminate\Support\ServiceProvider;

class VideoDepartmentServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        $this->app->bind(VideoAddedFireEventInterface::class, function (){
            return new VideoAddedFireEvent();
        });

        $this->app->bind(VideoRepositoryInterface::class, function (){
            return new VideoRepository();
        });

        $this->app->bind(AddVideoCommandInterface::class, function (){
            $videoRepository = app(VideoRepositoryInterface::class);
            $videoAddedFireEvent = app(VideoAddedFireEventInterface::class);
            return new AddVideoCommand($videoRepository, $videoAddedFireEvent);
        });


    }
}
