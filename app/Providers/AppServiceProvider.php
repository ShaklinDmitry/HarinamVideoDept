<?php

namespace App\Providers;

use App\Modules\VideoDepartment\Application\UseCases\AddVideoCommand;
use App\Modules\VideoDepartment\Application\UseCases\AddVideoCommandInterface;
use App\Modules\VideoDepartment\Domain\VideoRepositoryInterface;
use App\Modules\VideoDepartment\Infrastructure\Repositories\VideoRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $this->app->bind(VideoRepositoryInterface::class, function (){
            return new VideoRepository();
        });

        $this->app->bind(AddVideoCommandInterface::class, function (){
            $videoRepository = app(VideoRepositoryInterface::class);
            return new AddVideoCommand($videoRepository);
        });
    }
}
