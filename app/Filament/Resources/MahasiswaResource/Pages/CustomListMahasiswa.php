<?php

namespace App\Filament\Resources\MahasiswaResource\Pages;

use Filament\Tables\Table;
use Filament\Actions\Action;
use Filament\Actions\CreateAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Resources\Pages\listRecords;
use Filament\Tables\Actions\BulkActionGroup;
use App\Filament\Resources\MahasiswaResource;
use Filament\Tables\Actions\DeleteBulkAction;

class CustomListMahasiswa extends listRecords
{
    protected static string $resource = MahasiswaResource::class;

    protected static string $view = 'filament.mahasiswa.resource.page.list';

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('user.name'),
                TextColumn::make('nim')
                    ->searchable(),
                TextColumn::make('sks')
                    ->searchable(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                EditAction::make(),
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()
                ->label('Tambah Mahasiswa')
        ];
    }
}
