<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BackupFolder;
use App\Models\BackupFile;
use Illuminate\Support\Facades\Storage;

class BackupFileController extends Controller
{
    public function index($parentId = null)
    {
        $folders = BackupFolder::where('parent_id', $parentId)->latest()->paginate(10);
        $files = collect(); // default ค่าว่าง

        if ($parentId && $folders->isEmpty()) {
            $folder = BackupFolder::findOrFail($parentId);
            $files = $folder->files()->latest()->paginate(10);
        }

        return view('admin.backup_file.index', compact('folders', 'files', 'parentId'));
    }

    public function create(Request $request)
    {
        $parentId = $request->input('parent_id');
        return view('admin.backup_file.create_folder', compact('parentId'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'folder_name' => 'required|string|max:255',
        ]);

        BackupFolder::create([
            'name' => $request->folder_name,
            'parent_id' => $request->parent_id,
        ]);

        return redirect()->route('backup-file.index', ['parentId' => $request->parent_id])
            ->with('success', 'Folder created successfully.');
    }

    public function createFile(Request $request)
    {
        $parentId = $request->input('parent_id');

        $folder = BackupFolder::findOrFail($parentId);

        return view('admin.backup_file.upload_file', compact('parentId', 'folder'));
    }

    public function storeFile(Request $request)
    {
        $request->validate([
            'file_upload' => 'required|file|max:20480', // max 20MB
            'parent_id' => 'required|exists:backup_folders,id',
        ]);

        $file = $request->file('file_upload');
        $path = $file->store('backup_files');

        BackupFile::create([
            'folder_id' => $request->parent_id,
            'file_name' => $file->getClientOriginalName(),
            'file_path' => $path,
            'file_type' => $file->getClientMimeType(),
            'file_size' => $file->getSize(),
        ]);

        return redirect()->route('backup-file.index', ['parentId' => $request->parent_id])
            ->with('success', 'File uploaded successfully.');
    }
}