<?php

namespace App\Http\Services\File;

use App\Models\File;
use Illuminate\Support\Facades\Storage;

class UpdateFileService
{
    public function __invoke($id, $requestData)
    {
        $file = File::findOrFail($id);
        $oldName = $file->name;
        $oldFileFolder = $file->folder_id;

        $file->fill($requestData);

        if (array_key_exists('name', $requestData)) {
            $file->name .= "." . $this->getFileExtension($oldName);
        }

        if (array_key_exists('folder_id', $requestData)) {
            if ($requestData['folder_id'] != $oldFileFolder) {
                $newFolderPath = "public/uploads/folder" . $requestData['folder_id'];
                $newPath = $this->moveFileToNewPath($file->path, $newFolderPath);

                $file->path = $newPath;
            }
        }

        $file->save();

        return $file;
    }

    public function moveFileToNewPath(string $folderPath, string $newFolderPath)
    {
        $brokenFolderPath = explode('/', $folderPath);
        $folderFileName = $brokenFolderPath[count($brokenFolderPath) - 1];
        $updatedFilePath = $newFolderPath . '/' . $folderFileName;

        if (!Storage::exists($newFolderPath))
            Storage::makeDirectory($newFolderPath);

        Storage::move($folderPath, $updatedFilePath);

        return $updatedFilePath;
    }

    private function getFileExtension(string $oldFileName)
    {
        $breakedName = explode('.', $oldFileName);
        return $breakedName[count($breakedName) - 1];
    }
}
