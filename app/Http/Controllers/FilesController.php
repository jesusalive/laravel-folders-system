<?php

namespace App\Http\Controllers;

use App\Http\Resources\File\FileResource;
use App\Http\Services\File\AddFileService;
use Illuminate\Http\Request;

class FilesController extends Controller
{
    public function addFile(Request $request)
    {
        $data = (new AddFileService())($request->file('file'), $request->get('folderId'));
        return new FileResource($data);
    }
}
