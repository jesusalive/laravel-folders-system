<?php

namespace App\Http\Services\Folder;

use App\Models\Folder;

class UpdateFolderService
{
    public function __invoke($id, $requestData)
    {
        $folder = Folder::findOrFail($id);
        $folder->fill($requestData);
        $folder->save();

        return $folder;
    }
}
