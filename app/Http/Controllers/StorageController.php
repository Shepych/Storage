<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class StorageController extends Controller
{
    # СТРАНИЦА ЗАГРУЗКИ ФАЙЛА
    public function index() {
        return view('upload');
    }

    # ЗАГРУЗКА ФАЙЛА НА СЕРВЕР
    public function upload(Request $request) {
        $validator = Validator::make($request->all(), [
            'upload_file' => 'required|mimes:zip',
        ]);

        if($validator->fails()) {
            return 'только ZIP';
        }

        # Валидация на ZIP
        $file = fopen($request->file('upload_file'), 'r');
        # http://storage.stalkerok.ru/api/upload/file
        # Получаем ID мода
        # АПИ ключ и файл
        Http::attach('attachment', $file)->post('https://stalkerok.ru/api/testing', [
            'mod_id' => 2200,
            'folder' => 15,
            'file_name' => $request->file('upload_file')->getClientOriginalName()
        ]);
        echo 'success';
    }
}
