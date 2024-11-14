<?php

namespace App\Filament\Kajur\Resources\PengajuanJudulResource\Pages;

use App\Filament\Kajur\Resources\PengajuanJudulResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPengajuanJuduls extends ListRecords
{
    protected static string $resource = PengajuanJudulResource::class;

    protected function getHeaderActions(): array
    {
        return [];
    }
}
