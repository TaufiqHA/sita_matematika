<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Mahasiswa extends Model
{
    protected $guarded = ['id'];

    public function user(): BelongsTo
    {
        return $this->BelongsTo(User::class);
    }
}
