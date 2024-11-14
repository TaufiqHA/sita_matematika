<?php

namespace App\Filament\Kajur\Resources;

use App\Filament\Kajur\Resources\PengajuanJudulResource\Pages;
use App\Filament\Kajur\Resources\PengajuanJudulResource\RelationManagers;
use App\Models\PengajuanJudul;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PengajuanJudulResource extends Resource
{
    protected static ?string $model = PengajuanJudul::class;

    protected static ?string $navigationIcon = 'heroicon-o-queue-list';

    protected static ?string $navigationGroup = 'Judul Management';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Fieldset::make('Informasi Mahasiswa')
                    ->relationship('user')
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->readOnly(),
                        Forms\Components\Fieldset::make()
                            ->relationship('mahasiswa')
                            ->schema([
                                Forms\Components\TextInput::make('nim')
                                    ->readOnly(),
                                Forms\Components\TextInput::make('sks')
                                    ->readOnly(),
                            ]),
                    ]),
                Forms\Components\TextInput::make('judul')
                    ->required(),
                Forms\Components\RichEditor::make('outline')
                    ->required(),
                Forms\Components\Select::make('status')
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

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('user.name')
                    ->label('Name')
                    ->sortable(),
                Tables\Columns\TextColumn::make('judul')
                    ->searchable(),
                Tables\Columns\TextColumn::make('status')
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPengajuanJuduls::route('/'),
            // 'create' => Pages\CreatePengajuanJudul::route('/create'),
            // 'edit' => Pages\EditPengajuanJudul::route('/{record}/edit'),
        ];
    }
}
