<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Folder extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'belongs_to_folder'
    ];

    public function files()
    {
        return $this->hasMany(File::class, 'folder_id');
    }

    public function folders()
    {
        return $this->hasMany($this, 'belongs_to_folder');
    }
}
