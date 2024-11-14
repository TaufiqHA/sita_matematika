<?php

namespace App\Filament\Kajur\Resources\PengajuanJudulResource\Pages;

use Filament\Actions;
use Filament\Forms\Form;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Pages\EditRecord;
use App\Filament\Kajur\Resources\PengajuanJudulResource;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\RichEditor;
use Filament\Tables\Columns\TextColumn;

use function Laravel\Prompts\select;

class EditPengajuanJudul extends EditRecord
{
    protected static string $resource = PengajuanJudulResource::class;

    protected static string $view = 'filament.kajur.resource.page.edit';

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
                            ->readOnly(),
                        Fieldset::make()
                            ->relationship('mahasiswa')
                            ->schema([
                                TextInput::make('nim')
                                    ->readOnly(),
                                TextInput::make('sks')
                                    ->readOnly(),
                            ]),
                    ]),
                TextInput::make('judul')
                    ->required(),
                RichEditor::make('outline')
                    ->required(),
                Select::make('status')
                    ->options([
                        'diajukan' => 'Diajukan',
                        'diterima' => 'Diterima',
                        'dalam tinjauan' => 'Dalam Tinjauan',
                        'disetujui' => 'Disetujui',
                        'ditolak' => 'Ditolak',
                    ]),
            ])
            ->columns(1);
    }
}
