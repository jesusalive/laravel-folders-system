<?php

namespace App\Http\Controllers;

use App\Http\Resources\Application\ErrorResource;
use App\Http\Resources\Folder\FolderResource;
use App\Http\Services\Folder\CreateFolderService;
use App\Http\Services\Folder\DeleteFolderService;
use App\Http\Services\Folder\GetFolderService;
use App\Http\Services\Folder\UpdateFolderService;
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
        return new FolderResource((new CreateFolderService())($request->all()));
    }

    public function update($id, Request $request)
    {
        try {
            return new FolderResource((new UpdateFolderService())($id, $request->all()));
        } catch (ModelNotFoundException $e) {
            return response()->json(new ErrorResource('Folder not found'), 400);
        }
    }

    public function delete($id)
    {
        try {
            ((new DeleteFolderService())($id));
            return response()->json(['data' => ['message' => 'Deleted']]);
        } catch (ModelNotFoundException $e) {
            return response()->json(new ErrorResource('Folder not found'), 400);
        }
    }
}
