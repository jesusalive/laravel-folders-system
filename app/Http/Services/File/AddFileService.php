<?php

namespace App\Http\Services\File;

use App\Models\File;
use Illuminate\Http\UploadedFile;

class AddFileService
{
    public function __invoke(UploadedFile $file, $folderId)
    {
        $fileName = $file->getClientOriginalName();
        $path = $file->store('public/uploads');

        return File::create([
            'name' => $fileName,
            'path' => $path,
            'folder_id' => $folderId
        ]);
    }
}
