<?php

namespace App\Http\Services\File;

use App\Models\File;

class UpdateFileService
{
    public function __invoke($id, $requestData)
    {
        $file = File::findOrFail($id);
        $oldFileName = $file->name;
        $file->fill($requestData);

        if ($requestData['name']) {
            $breakedName = explode('.', $oldFileName);
            $fileExtension = $breakedName[count($breakedName) - 1];

            $file->name .= ".$fileExtension";
        }

        $file->save();

        return $file;
    }
}
