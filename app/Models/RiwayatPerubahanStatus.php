<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RiwayatPerubahanStatus extends Model
{
    protected $table = 'riwayat_perubahan_status';

    public $timestamps = false;

    protected $fillable = [
        'report_id', 'from_status', 'to_status', 
        'note', 'changed_by', 'created_at'
    ];

    protected $casts = ['created_at' => 'datetime'];

    public function laporan(): BelongsTo
    {
        return $this->belongsTo(Laporan::class, 'report_id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'changed_by');
    }

    public function getFromStatusLabelAttribute(): ?string
    {
        if (!$this->from_status) return null;

        return match($this->from_status) {
            'pending' => 'Menunggu',
            'diproses' => 'Diproses',
            'selesai' => 'Selesai',
            'ditolak' => 'Ditolak',
            default => $this->from_status,
        };
    }

    public function getToStatusLabelAttribute(): string
    {
        return match($this->to_status) {
            'pending' => 'Menunggu',
            'diproses' => 'Diproses',
            'selesai' => 'Selesai',
            'ditolak' => 'Ditolak',
            default => $this->to_status,
        };
    }
}