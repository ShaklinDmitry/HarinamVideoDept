<?php

namespace App\Modules\VideoDepartment\Infrastructure\Statistics;

use App\Modules\VideoDepartment\Domain\StatisticsInterface;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Statistics implements StatisticsInterface
{
    /**
     * @param array $video
     * @return mixed|\Symfony\Component\HttpFoundation\BinaryFileResponse
     * @throws \PhpOffice\PhpSpreadsheet\Writer\Exception
     */
    public function createFile(array $video)
    {
        $spreadsheet = new Spreadsheet();

//        $arrayData = [
//            [NULL, 2010, 2011, 2012],
//            ['Q1',   12,   15,   21],
//            ['Q2',   56,   73,   86],
//            ['Q3',   52,   61,   69],
//            ['Q4',   30,   32,    0],
//        ];

        $spreadsheet->getActiveSheet()
            ->fromArray(
                $video,  // The data to set
                NULL,        // Array values with this value will not be set
                'A1'         // Top left coordinate of the worksheet range where
            );

        $writer = new Xlsx($spreadsheet);
        $writer->save($path = storage_path('videoStatistics.xlsx'));

        return response()->download($path)->deleteFileAfterSend();
    }
}
