<?php

use App\Http\Controllers\FileController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('/all-files/{filter}', [FileController::class, 'GetAllFile']);
Route::post('/file-upload', [FileController::class, 'UploadFile']);
Route::delete('/file-delete/{id}', [FileController::class, 'DeleteFile']);
Route::get('/download-file/{file}', [FileController::class, 'DownloadFile'])->excludedMiddleware('cors');
