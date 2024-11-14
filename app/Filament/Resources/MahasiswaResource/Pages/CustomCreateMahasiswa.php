<?php

namespace App\Filament\Resources\MahasiswaResource\Pages;

use App\Models\User;
use Filament\Actions;
use Filament\Forms\Form;
use App\Models\Mahasiswa;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Select;
use App\Filament\Resources\UserResource;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Builder;
use Filament\Resources\Pages\createRecord;
use App\Filament\Resources\MahasiswaResource;

class CustomCreateMahasiswa extends createRecord
{
    protected static string $resource = UserResource::class;

    protected static string $view = 'filament.mahasiswa.resource.page.create';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->required(),
                TextInput::make('email')
                    ->email()
                    ->required(),
                Select::make('roles')
                    ->relationship('roles', 'name', fn (Builder $query) => $query->where('name', 'mahasiswa'))
                    ->multiple()
                    ->preload()
                    ->searchable()
                    ->required(),
                TextInput::make('password')
                    ->password()
                    ->required(),
            ]);
    }

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

    public function getTitle(): string
    {
        return 'Tambah Mahasiswa';
    }

    public function getBreadcrumbs(): array
    {
        $breadcrumbs = [
            '/admin/mahasiswas' => 'Mahasiswa',
            '/admin/mahasiswas/create' => 'Create',
        ];
        
        return $breadcrumbs;
    }

}
