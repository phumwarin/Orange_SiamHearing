<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BackupFolder extends Model
{
    protected $fillable = ['name', 'parent_id'];

    public function parent()
    {
        return $this->belongsTo(BackupFolder::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(BackupFolder::class, 'parent_id');
    }

    public function files()
    {
        return $this->hasMany(BackupFile::class, 'folder_id');
    }
}