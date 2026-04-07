<?php

namespace App\Http\Controllers;

use App\Models\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class FileController extends Controller
{
    /**
     * Display a listing of the user's files.
     */
    public function index()
    {
        $files = File::where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->get();
        
        return view('files.index', compact('files'));
    }

    /**
     * Display all files (for admin/superadmin).
     */
    public function allFiles()
    {
        $files = File::with('user')
            ->orderBy('created_at', 'desc')
            ->get();
        
        return view('files.all', compact('files'));
    }

    /**
     * Show the form for creating a new file.
     */
    public function create()
    {
        return view('files.create');
    }

    /**
     * Store a newly uploaded file.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'file' => 'required|file|max:10240', // Max 10MB
            'description' => 'nullable|string',
            'is_public' => 'boolean',
        ]);

        $uploadedFile = $request->file('file');
        
        // Store file in storage/app/public/uploads
        $path = $uploadedFile->store('uploads', 'public');
        
        $file = File::create([
            'user_id' => Auth::id(),
            'title' => $validated['title'],
            'file_name' => $uploadedFile->getClientOriginalName(),
            'file_path' => $path,
            'file_type' => $uploadedFile->getMimeType(),
            'file_size' => $uploadedFile->getSize(),
            'description' => $validated['description'] ?? null,
            'is_public' => $request->boolean('is_public'),
        ]);

        return redirect()->route('files.index')
            ->with('success', 'File uploaded successfully!');
    }

    /**
     * Display the specified file.
     */
    public function show(File $file)
    {
        // Check if user can view this file
        if (!$file->is_public && $file->user_id !== Auth::id() && !Auth::user()->isSuperAdmin()) {
            abort(403, 'You do not have permission to view this file.');
        }

        return view('files.show', compact('file'));
    }

    /**
     * Download the specified file.
     */
    public function download(File $file)
    {
        // Check if user can download this file
        if (!$file->is_public && $file->user_id !== Auth::id() && !Auth::user()->isSuperAdmin()) {
            abort(403, 'You do not have permission to download this file.');
        }

        return Storage::disk('public')->download($file->file_path, $file->file_name);
    }

    /**
     * Remove the specified file from storage.
     */
    public function destroy(File $file)
    {
        // Check if user can delete this file
        if ($file->user_id !== Auth::id() && !Auth::user()->isSuperAdmin()) {
            abort(403, 'You do not have permission to delete this file.');
        }

        // Delete file from storage
        Storage::disk('public')->delete($file->file_path);
        
        // Delete record from database
        $file->delete();

        return redirect()->back()
            ->with('success', 'File deleted successfully!');
    }

    /**
     * Display public files on frontend.
     */
    public function publicFiles()
    {
        $files = File::with('user')
            ->where('is_public', true)
            ->orderBy('created_at', 'desc')
            ->get();
        
        return view('files.public', compact('files'));
    }
}
