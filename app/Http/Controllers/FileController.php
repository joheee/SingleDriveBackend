<?php

namespace App\Http\Controllers;

use App\Models\File;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Response as FacadesResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class FileController extends Controller
{
    function GetAllFile($filter) {
        if($filter === '`') return File::all();
        return File::with([])->where('name','like','%'.$filter.'%')->get();
    }

    function Uploadfile(Request $req) {
        $valid = Validator::make($req-> all(), [
            'file' => 'required'
        ]);

        if($valid->fails()) return $valid->messages();

        $file = $req->file;
        $fileName = $file->getClientOriginalName();
        Storage::putFileAs('/public/file/',$file,$fileName);

        $f = new File;
        $f->name = $fileName;
        $f->picture = 'file-icon.webp';
        $f->size = $file->getSize();
        $f->save();

        return 'success put file to storage';
    }

    function DeleteFile($id) {
        $f = File::find($id);
        $f->delete();
        return true;
    }


    function DownloadFile($file) {
        $path = 'public/file/'.$file;
        if(Storage::exists($path)){
            return Storage::download($path, $file);
        }
        return 'gaada bos';
    }

}
