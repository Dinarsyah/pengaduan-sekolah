<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * 1. Ubah fillable: tambahkan 'role' dan 'nama'
     */
    protected $fillable = [
        'nama',       // Tambahan
        'email',
        'password',
        'role',       // Tambahan
    ];

    /**
     * 2. Tambahkan relasi ke tabel Aspirasi
     */
    public function aspirasis()
    {
        return $this->hasMany(Aspirasi::class);
    }

    /**
     * 3. Konfigurasi casting (bawaan Laravel)
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}
