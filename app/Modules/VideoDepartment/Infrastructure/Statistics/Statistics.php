<?php

namespace App\Modules\VideoDepartment\Infrastructure\Statistics;

use App\Modules\VideoDepartment\Domain\StatisticsInterface;
use App\Modules\VideoDepartment\Domain\VideoRepositoryInterface;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Spatie\SimpleExcel\SimpleExcelReader;
use Spatie\SimpleExcel\SimpleExcelWriter;

class Statistics implements StatisticsInterface
{

    const FILE_NAME = 'statistics.xlsx';
    const STATISTICS_FOLDER_PATH = 'statistics/';

    /**
     * @param array $video
     * @return string
     * @throws \Exception
     */
    public function createFile(array $video): string
    {
        $statisticsFolderName = Str::random(5);
        $fileTempFolderPath = storage_path('app/') . self::STATISTICS_FOLDER_PATH . $statisticsFolderName;
        if (File::makeDirectory($fileTempFolderPath, 0777, true))
        {
            $writer = SimpleExcelWriter::create($fileTempFolderPath . '/' . self::FILE_NAME);

            if (isset($video[0]))
            {
                $keys = array_keys($video[0]);
            }

            $writer->addHeader($keys);

            for ($i = 0; $i < count($video); $i++)
            {
                $writer->addRow($video[$i]);

                if ($i % 1000 === 0)
                {
                    flush(); // Flush the buffer every 1000 rows
                }
            }

            return 'statistics/'. $statisticsFolderName . '/' . self::FILE_NAME;

        } else
        {
            throw new \Exception('Folder for statistics file not created.');
        }

    }


    public function readFile(string $fileName)
    {
        $rows = SimpleExcelReader::create(storage_path('app/statistics/' . $fileName))->getRows();

        $videoRepository = app(VideoRepositoryInterface::class);

        $rows->each(function (array $rowProperties) {
            dd($rowProperties);
            //   $video = new Video();

            //   $videoRepository->addVideo();
        });
    }
}
