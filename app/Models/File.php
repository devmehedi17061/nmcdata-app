<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class File extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'title',
        'file_name',
        'file_path',
        'file_type',
        'file_size',
        'description',
        'is_public',
    ];

    protected $casts = [
        'is_public' => 'boolean',
        'file_size' => 'integer',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the file URL
     */
    public function getFileUrlAttribute()
    {
        return Storage::url($this->file_path);
    }

    /**
     * Get human readable file size
     */
    public function getFormattedSizeAttribute()
    {
        $bytes = $this->file_size;
        if ($bytes >= 1073741824) {
            return number_format($bytes / 1073741824, 2) . ' GB';
        } elseif ($bytes >= 1048576) {
            return number_format($bytes / 1048576, 2) . ' MB';
        } elseif ($bytes >= 1024) {
            return number_format($bytes / 1024, 2) . ' KB';
        }
        return $bytes . ' B';
    }

    /**
     * Get file icon based on type
     */
    public function getFileIconAttribute()
    {
        $extension = pathinfo($this->file_name, PATHINFO_EXTENSION);
        
        $iconMap = [
            'pdf' => 'fi-rr-file-pdf',
            'doc' => 'fi-rr-file-word',
            'docx' => 'fi-rr-file-word',
            'xls' => 'fi-rr-file-excel',
            'xlsx' => 'fi-rr-file-excel',
            'ppt' => 'fi-rr-file-powerpoint',
            'pptx' => 'fi-rr-file-powerpoint',
            'jpg' => 'fi-rr-image',
            'jpeg' => 'fi-rr-image',
            'png' => 'fi-rr-image',
            'gif' => 'fi-rr-image',
            'zip' => 'fi-rr-file-zip',
            'rar' => 'fi-rr-file-zip',
            'txt' => 'fi-rr-file-lines',
        ];

        return $iconMap[$extension] ?? 'fi-rr-file';
    }
}
