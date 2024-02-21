<?php

use App\Imports\UsersImport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/video', [\App\Modules\VideoDepartment\Infrastructure\Controllers\VideoController::class, 'addVideo']);

Route::get('/statistics', [\App\Modules\VideoDepartment\Infrastructure\Controllers\VideoController::class, 'getStatistics']);

Route::get('/test', function (){

    $spreadsheet = new Spreadsheet();
  //  $activeWorksheet = $spreadsheet->getActiveSheet();
   // $activeWorksheet->setCellValue('A1', 'Hello World !');

    $arrayData = [
        [NULL, 2010, 2011, 2012],
        ['Q1',   12,   15,   21],
        ['Q2',   56,   73,   86],
        ['Q3',   52,   61,   69],
        ['Q4',   30,   32,    0],
    ];

    $spreadsheet->getActiveSheet()
        ->fromArray(
            $arrayData,  // The data to set
            NULL,        // Array values with this value will not be set
            'A1'         // Top left coordinate of the worksheet range where
        //    we want to set these values (default is A1)
        );

    $writer = new Xlsx($spreadsheet);
    $writer->save($path = storage_path('new1.xlsx'));

    return response()->download($path)->deleteFileAfterSend();
});
