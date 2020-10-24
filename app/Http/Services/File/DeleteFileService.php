<?php

namespace App\Http\Services\File;

use App\Models\File;
use Illuminate\Support\Facades\Storage;

class DeleteFileService
{
    public function __invoke($id)
    {
        $file = File::findOrFail($id);
        $file->delete();
        Storage::delete($file->path);
    }
}
