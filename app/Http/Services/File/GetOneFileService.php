<?php

namespace App\Http\Services\File;

use App\Models\File;

class GetOneFileService
{
    public function __invoke($id)
    {
        return File::findOrFail($id);
    }
}
