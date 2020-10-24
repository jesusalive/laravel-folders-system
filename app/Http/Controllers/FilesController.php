<?php

namespace App\Http\Controllers;

use App\Http\Resources\Application\ErrorResource;
use App\Http\Resources\File\FileResource;
use App\Http\Services\File\AddFileService;
use App\Http\Services\File\DeleteFileService;
use App\Http\Services\File\UpdateFileService;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class FilesController extends Controller
{
    public function addFile(Request $request)
    {
        $data = (new AddFileService())($request->file('file'), $request->get('folderId'));
        return new FileResource($data);
    }

    public function update($id, Request $request)
    {
        try {
            $data = (new UpdateFileService())($id, $request->all());
            return new FileResource($data);
        } catch (ModelNotFoundException $e) {
            return response()->json(new ErrorResource('File not found'), 400);
        }
    }

    public function delete($id)
    {
        try {
            (new DeleteFileService())($id);
            return response()->json(['data' => ['message' => 'Deleted']]);
        } catch (ModelNotFoundException $e) {
            return response()->json(new ErrorResource('File not found'), 400);
        }
    }
}
