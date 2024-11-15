<?php

namespace App\Filament\Kajur\Resources\PengajuanJudulResource\Pages;

use Filament\Actions;
use Filament\Tables\Table;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Resources\Pages\ListRecords;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\DeleteBulkAction;
use App\Filament\Kajur\Resources\UserResource;

class CustomListPengajuanJudul extends ListRecords
{
    protected static string $resource = UserResource::class;

    protected static string $view = 'filament.kajur.resource.page.list';

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label('Name')
                    ->sortable(),
                TextColumn::make('mahasiswa.nim')
                    ->label('NIM')
                    ->searchable(),
                TextColumn::make('mahasiswa.sks')
                    ->label('SKS')
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
            ->filters(filters: [
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

    public function getTitle(): string
    {
        return 'Pengauan Judul';
    }

    public function getBreadcrumbs(): array
    {
        $breadcrumbs = [
            '/kajur/pengajuan-juduls' => 'Pengajuan Judul',
            '/kajur/pengajuan-juduls/list' => 'List',
        ];
        
        return $breadcrumbs;
    }
}
