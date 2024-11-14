<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Filament\Panel;
use App\Models\PengajuanJudul;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Filament\Models\Contracts\FilamentUser;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements FilamentUser
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function mahasiswa(): HasOne
    {
        return $this->hasOne(Mahasiswa::class);
    }

    public function pengajuanJudul(): HasMany
    {
        return $this->hasMany(PengajuanJudul::class);
    }

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function canAccessPanel(Panel $panel): bool
    {
        if($panel->getId() === 'admin') {
            if(Auth::user()->roles->contains('name', 'super_admin')) {
                return true;
            } else {
                return false;
            }
        } elseif ($panel->getId() === 'mahasiswa') {
            if(Auth::user()->roles->contains('name', 'mahasiswa')) {
                return true;
            } else {
                return false;
            }
        } elseif ($panel->getId() === 'kajur') {
            if(Auth::user()->roles->contains('name', 'kps')) {
                return true;
            } else {
                return false;
            }
        }

        return false;
    }
}
