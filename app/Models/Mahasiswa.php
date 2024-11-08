<?php

namespace App\Models;

use Filament\Panel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Mahasiswa extends Authenticatable
{
    protected $guarded = ['id'];

    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    public function canAccessPanel(Panel $panel): bool
    {
        if ($panel->getId() === 'mahasiswa') {
            return $this->role === 'mahasiswa';
        }
        
        return false;
    }
}
