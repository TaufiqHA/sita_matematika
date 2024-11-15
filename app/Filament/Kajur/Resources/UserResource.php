<?php

namespace App\Filament\Kajur\Resources;

use App\Filament\Kajur\Resources\UserResource\Pages;
use App\Filament\Kajur\Resources\UserResource\RelationManagers;
use App\Filament\Kajur\Resources\UserResource\RelationManagers\PengajuanJudulRelationManager;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static bool $shouldRegisterNavigation = false;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Fieldset::make()
                    ->schema([
                        Forms\Components\TextInput::make('name')
                        ->readOnly(),
                    Forms\Components\TextInput::make('email')
                        ->email()
                        ->readOnly(),
                    ]),
                
                Forms\Components\Fieldset::make()
                    ->relationship('mahasiswa')
                    ->schema([
                        Forms\Components\TextInput::make('nim')
                            ->label('NIM')
                            ->readOnly(),
                        Forms\Components\TextInput::make('sks')
                            ->readOnly()
                            ->label('SKS')
                    ])
            ]);
    }
    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
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
            PengajuanJudulRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->whereHas('roles', function($query){
            $query->where('name', 'mahasiswa');
        });
    }
}
