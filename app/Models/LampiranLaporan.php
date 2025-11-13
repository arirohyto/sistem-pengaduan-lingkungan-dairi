<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class LampiranLaporan extends Model
{
    protected $table = 'lampiran_laporan';

    protected $fillable = [
        'report_id', 'file_path', 'file_name', 
        'mime_type', 'file_size', 'uploaded_by'
    ];

    protected $casts = ['file_size' => 'integer'];

    public function laporan(): BelongsTo
    {
        return $this->belongsTo(Laporan::class, 'report_id');
    }

    public function uploader(): BelongsTo
    {
        return $this->belongsTo(User::class, 'uploaded_by');
    }

    public function getUrlAttribute(): string
    {
        return Storage::url($this->file_path);
    }

    public function getFileSizeHumanAttribute(): string
    {
        $bytes = $this->file_size;
        $units = ['B', 'KB', 'MB', 'GB'];
        
        for ($i = 0; $bytes > 1024; $i++) {
            $bytes /= 1024;
        }
        
        return round($bytes, 2) . ' ' . $units[$i];
    }

    public function isImage(): bool
    {
        return Str::startsWith($this->mime_type, 'image/');
    }
}