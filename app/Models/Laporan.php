<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Laporan extends Model
{
    use SoftDeletes;

    protected $table = 'laporan';

    protected $fillable = [
        'code',
        'title',
        'description',
        'jenis_laporan',
        'status',
        'reporter_id',
        'reporter_name',
        'reporter_email',
        'reporter_phone',
        'is_anonymous',
        'location_id',
        'area_id',
        'address',
        'latitude',
        'longitude',
    ];

    protected $casts = [
        'is_anonymous' => 'boolean',
        'latitude' => 'decimal:7',
        'longitude' => 'decimal:7',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($laporan) {
            if (empty($laporan->code)) {
                $laporan->code = static::generateCode();
            }
        });
    }

    public static function generateCode(): string
    {
        $date = now()->format('Ymd');
        $count = static::whereDate('created_at', now())->count() + 1;
        return 'DLH-' . $date . '-' . str_pad($count, 4, '0', STR_PAD_LEFT);
    }

    // Relationships
    public function reporter(): BelongsTo
    {
        return $this->belongsTo(User::class, 'reporter_id');
    }

    public function location(): BelongsTo
    {
        return $this->belongsTo(Lokasi::class, 'location_id');
    }

    public function area(): BelongsTo
    {
        return $this->belongsTo(Area::class);
    }

    public function lampiran(): HasMany
    {
        return $this->hasMany(LampiranLaporan::class, 'report_id');
    }

    public function riwayatStatus(): HasMany
    {
        return $this->hasMany(RiwayatPerubahanStatus::class, 'report_id')
            ->orderBy('created_at', 'desc');
    }

    // Scopes
    public function scopeByStatus($query, string $status)
    {
        return $query->where('status', $status);
    }

    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    public function scopeDiproses($query)
    {
        return $query->where('status', 'diproses');
    }

    public function scopeSelesai($query)
    {
        return $query->where('status', 'selesai');
    }

    public function scopeDitolak($query)
    {
        return $query->where('status', 'ditolak');
    }

    // Accessors
    public function getStatusLabelAttribute(): string
    {
        return match ($this->status) {
            'pending' => 'Menunggu',
            'diproses' => 'Diproses',
            'selesai' => 'Selesai',
            'ditolak' => 'Ditolak',
            default => $this->status,
        };
    }

    public function getStatusBadgeAttribute(): array
    {
        return match ($this->status) {
            'pending' => [
                'bg' => 'bg-yellow-100 dark:bg-yellow-900/30',
                'text' => 'text-yellow-800 dark:text-yellow-400'
            ],
            'diproses' => [
                'bg' => 'bg-blue-100 dark:bg-blue-900/30',
                'text' => 'text-blue-800 dark:text-blue-400'
            ],
            'selesai' => [
                'bg' => 'bg-green-100 dark:bg-green-900/30',
                'text' => 'text-green-800 dark:text-green-400'
            ],
            'ditolak' => [
                'bg' => 'bg-red-100 dark:bg-red-900/30',
                'text' => 'text-red-800 dark:text-red-400'
            ],
            default => [
                'bg' => 'bg-gray-100',
                'text' => 'text-gray-800'
            ],
        };
    }
}
