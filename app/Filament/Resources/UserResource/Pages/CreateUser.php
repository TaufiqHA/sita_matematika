<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Models\User;
use Filament\Actions;
use App\Models\Mahasiswa;
use App\Filament\Resources\UserResource;
use Filament\Resources\Pages\CreateRecord;
use AnourValar\EloquentSerialize\Tests\Models\Post;

class CreateUser extends CreateRecord
{
    protected static string $resource = UserResource::class;

    protected function afterCreate(): void
    {
        $roles = $this->record->roles->first()->name;
        $name = $this->record->name;

        if($roles === 'mahasiswa'){
            Mahasiswa::create([
                'user_id' => User::where('name', $name)->first()->id,
            ]);
        }
    }
}
