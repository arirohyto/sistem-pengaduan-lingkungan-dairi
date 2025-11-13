<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Area extends Model
{
    protected $table = 'area';

    protected $fillable = ['name', 'level', 'parent_id'];

    public function parent(): BelongsTo
    {
        return $this->belongsTo(Area::class, 'parent_id');
    }

    public function children(): HasMany
    {
        return $this->hasMany(Area::class, 'parent_id');
    }

    public function lokasi(): HasMany
    {
        return $this->hasMany(Lokasi::class, 'area_id');
    }

    public function laporan(): HasMany
    {
        return $this->hasMany(Laporan::class, 'area_id');
    }

    public function scopeByLevel($query, string $level)
    {
        return $query->where('level', $level);
    }

    public function scopeKabupaten($query)
    {
        return $query->where('level', 'kabupaten');
    }

    public function scopeKecamatan($query)
    {
        return $query->where('level', 'kecamatan');
    }
}