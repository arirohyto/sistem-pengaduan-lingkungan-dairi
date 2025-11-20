<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name', 'email', 'phone', 'password', 'role', 'status',
    ];

    protected $hidden = ['password', 'remember_token'];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // Relationships
    public function laporan(): HasMany
    {
        return $this->hasMany(Laporan::class, 'reporter_id');
    }

    public function lampiranUploaded(): HasMany
    {
        return $this->hasMany(LampiranLaporan::class, 'uploaded_by');
    }

    public function riwayatPerubahan(): HasMany
    {
        return $this->hasMany(RiwayatPerubahanStatus::class, 'changed_by');
    }

    // Helper methods
    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    public function isMasyarakat(): bool
    {
        return $this->role === 'masyarakat';
    }

    public function isActive(): bool
    {
        return $this->status === 'active';
    }

    // Scopes
    public function scopeAdmin($query)
    {
        return $query->where('role', 'admin');
    }

    public function scopeMasyarakat($query)
    {
        return $query->where('role', 'masyarakat');
    }

    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }
}