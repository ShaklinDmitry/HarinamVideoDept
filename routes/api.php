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
Route::get('/video', [\App\Modules\VideoDepartment\Infrastructure\Controllers\VideoController::class, 'getVideoByChunks']);

Route::get('/statistics', [\App\Modules\VideoDepartment\Infrastructure\Controllers\VideoController::class, 'getStatistics']);

Route::post('/statistics', [\App\Modules\VideoDepartment\Infrastructure\Controllers\VideoController::class, 'saveVideoFromFile']);

Route::get('/test', function (){

  //  \Spatie\SimpleExcel\SimpleExcelWriter::create('app/public/123.xlsx');
    // return asset('statistics/1.txt');


});
