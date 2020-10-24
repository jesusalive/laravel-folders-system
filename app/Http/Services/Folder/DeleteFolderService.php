<?php

namespace App\Http\Services\Folder;

use App\Models\Folder;
use Illuminate\Support\Facades\Storage;

class DeleteFolderService
{
    public function __invoke($id)
    {
        $folder = Folder::findOrFail($id);
        $folder->delete();
        Storage::deleteDirectory("public/uploads/folder$id");
    }
}
