<?php

namespace App\Modules\VideoDepartment\Infrastructure\ServiceProviders;

use App\Modules\VideoDepartment\Application\UseCases\AddVideo\AddVideoCommand;
use App\Modules\VideoDepartment\Application\UseCases\AddVideo\AddVideoCommandInterface;
use App\Modules\VideoDepartment\Application\UseCases\GetVideo\GetVideoCommand;
use App\Modules\VideoDepartment\Application\UseCases\GetVideo\GetVideoCommandInterface;
use App\Modules\VideoDepartment\Application\UseCases\GetVideoStatistics\GetVideoStatisticsCommand;
use App\Modules\VideoDepartment\Application\UseCases\GetVideoStatistics\GetVideoStatisticsCommandInterface;
use App\Modules\VideoDepartment\Application\UseCases\SaveVideoFromFile\SaveVideoFromFileCommand;
use App\Modules\VideoDepartment\Application\UseCases\SaveVideoFromFile\SaveVideoFromFileCommandInterface;
use App\Modules\VideoDepartment\Domain\StatisticsInterface;
use App\Modules\VideoDepartment\Domain\VideoAddedFireEventInterface;
use App\Modules\VideoDepartment\Domain\VideoRepositoryInterface;
use App\Modules\VideoDepartment\Infrastructure\Events\VideoAddedFireEvent;
use App\Modules\VideoDepartment\Infrastructure\Repositories\VideoRepository;
use App\Modules\VideoDepartment\Infrastructure\Statistics\Statistics;
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
        $this->app->bind(VideoAddedFireEventInterface::class, function () {
            return new VideoAddedFireEvent();
        });

        $this->app->bind(VideoRepositoryInterface::class, function () {
            return new VideoRepository();
        });

        $this->app->bind(AddVideoCommandInterface::class, function () {
            $videoRepository = app(VideoRepositoryInterface::class);
            $videoAddedFireEvent = app(VideoAddedFireEventInterface::class);
            return new AddVideoCommand($videoRepository, $videoAddedFireEvent);
        });

        $this->app->bind(StatisticsInterface::class, function () {
            return new Statistics();
        });

        $this->app->bind(GetVideoStatisticsCommandInterface::class, function () {

            return new GetVideoStatisticsCommand(app(VideoRepositoryInterface::class),
                app(StatisticsInterface::class));
        });

        $this->app->bind(SaveVideoFromFileCommandInterface::class, function () {
            return new SaveVideoFromFileCommand(app(StatisticsInterface::class));
        });

        $this->app->bind(GetVideoCommandInterface::class, function () {
            return new GetVideoCommand(app(VideoRepositoryInterface::class));
        });

    }
}
