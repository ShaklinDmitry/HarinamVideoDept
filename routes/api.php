<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::post('/test', function (){
    \Illuminate\Support\Facades\Mail::to('shaklin.ru@mail.ru')->send(new \App\Modules\MailSender\Infrastructure\Mailable\EmailSend());
});
