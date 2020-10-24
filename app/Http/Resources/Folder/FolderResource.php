<?php

namespace App\Http\Resources\Folder;

use Illuminate\Http\Resources\Json\JsonResource;

class FolderResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->resource->id,
            'name' => $this->resource->name,
            'belongsToFolder' => $this->resource->belongs_to_folder,
            'folders' => FolderResource::collection($this->resource->folders),
            'archives' => $this->resource->archives
        ];
    }
}
