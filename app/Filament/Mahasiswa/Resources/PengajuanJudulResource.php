<?php

namespace App\Filament\Mahasiswa\Resources;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use App\Models\PengajuanJudul;
use Filament\Resources\Resource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Mahasiswa\Resources\PengajuanJudulResource\Pages;
use App\Filament\Mahasiswa\Resources\PengajuanJudulResource\RelationManagers;

class PengajuanJudulResource extends Resource
{
    protected static ?string $model = PengajuanJudul::class;

    protected static ?string $navigationIcon = 'heroicon-o-queue-list';

    protected static ?string $navigationGroup = 'Judul Management';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Hidden::make('user_id')
                    ->required()
                    ->default(Auth::user()->id),
                Forms\Components\TextInput::make('judul')
                    ->required(),
                Forms\Components\RichEditor::make('outline')
                    ->required(),
                Forms\Components\Hidden::make('status')
                    ->default('diajukan'),
            ])
            ->columns(1);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([ 
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
                Tables\Actions\ViewAction::make(),
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
            'create' => Pages\CreatePengajuanJudul::route('/create'),
            // 'edit' => Pages\EditPengajuanJudul::route('/{record}/edit'),
        ];
    }
}
