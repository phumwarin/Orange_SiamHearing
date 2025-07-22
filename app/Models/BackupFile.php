<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BackupFile extends Model
{
    use HasFactory;

    protected $fillable = [
        'folder_id',
        'file_name',
        'file_path',
        'file_type',
        'file_size',
    ];

    public function folder()
    {
        return $this->belongsTo(BackupFolder::class, 'folder_id');
    }
}