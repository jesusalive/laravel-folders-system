<?php

namespace App\Http\Controllers;

use App\Http\Resources\Application\ErrorResource;
use App\Http\Resources\Folder\FolderResource;
use App\Http\Services\Folder\CreateFolderService;
use App\Http\Services\Folder\GetFolderService;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class FoldersController extends Controller
{
    public function getFolder($id)
    {
        try {
            $data = (new GetFolderService())($id);
            return new FolderResource($data);
        } catch (ModelNotFoundException $e) {
            return response()->json(new ErrorResource('Folder not found'), 400);
        }
    }

    public function create(Request $request)
    {
        try {
            return new FolderResource((new CreateFolderService())($request->all()));
        } catch (\Exception $e) {
            return response()->json(new ErrorResource($e->getMessage()), 400);
        }
    }
}
