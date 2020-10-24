<?php

namespace App\Http\Services\Folder;

use App\Models\Folder;

class GetFolderService
{
    public function __invoke($id)
    {
        return Folder::findOrFail($id);
    }
}
