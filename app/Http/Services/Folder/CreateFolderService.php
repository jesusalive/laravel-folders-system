<?php

namespace App\Http\Services\Folder;

use App\Models\Folder;

class CreateFolderService
{
    public function __invoke($requestData)
    {
        return Folder::create($requestData);
    }
}
