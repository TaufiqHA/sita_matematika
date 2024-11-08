<?php

namespace App\Models;

use Filament\Panel;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Mahasiswa extends Authenticatable
{
    protected $guarded = ['id'];

    protected $fillable = [
        'name',
        'nim',
        'sks',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'password' => 'hashed',
        ];
    }

    public function canAccessPanel(Panel $panel): bool
    {
        if ($panel->getId() === 'mahasiswa') {
            return $this->role === 'mahasiswa';
        }
        
        return false;
    }
}
