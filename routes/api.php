<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StorageController;

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

Route::group(['middleware' => ['api_key']], function() {
    Route::get('file/upload', function (Request $request) {
        dd($_SERVER['DOCUMENT_ROOT']);

        # Создаём папку
        Storage::disk('public')->makeDirectory('mods/' . $request->folder . '/' . $request->mod_id);
    
        \Illuminate\Support\Facades\DB::table('api_storage')->insert([
            'name' => $request->folder,
            'size' => $request->mod_id,
            'type' => $request->attachment,
        ]);
    
        # Загружаем файл
        move_uploaded_file($request->attachment, '/var/www/www-root/data/www/stalkerok.ru/storage/app/public/mods/' . $request->folder . '/' . $request->mod_id . '/' . $request->file_name);
    
        return response()->json([
            'success' => true,
            'ololo' => 'asfdodasf'
        ]);
    });

    Route::get('file/get', function () {
        return 'Получаем файл';
    });
    #Route::get('testing', [StorageController::class, 'index']);
    #Route::post('upload', [StorageController::class, 'upload'])->name('upload');
});