<?php

namespace App\Filament\Resources\MahasiswaResource\Pages;

use Filament\Actions;
use Filament\Forms\Form;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Pages\EditRecord;
use App\Filament\Resources\MahasiswaResource;
use Filament\Forms\Components\Card;

class EditMahasiswa extends EditRecord
{
    protected static string $resource = MahasiswaResource::class;

    protected static string $view = 'filament.mahasiswa.resource.page.edit';

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Fieldset::make('Informasi Mahasiswa')
                ->relationship('user')
                ->schema([
                    TextInput::make('name')
                        ->label('Nama Pengguna')
                        ->required(),
                    TextInput::make('email')
                        ->label('Email Pengguna')
                        ->email()
                        ->required(),
                ]),
                Fieldset::make()
                    ->schema([
                        TextInput::make('nim')
                            ->required(),
                        TextInput::make('sks')
                            ->required(),
                    ])
                    ->columns(2),
            ]);
    }
}
