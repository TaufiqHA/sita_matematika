<?php

namespace App\Filament\Mahasiswa\Resources\PengajuanJudulResource\Pages;

use Filament\Actions;
use Illuminate\Support\Facades\Auth;
use Filament\Resources\Pages\ListRecords;
use App\Filament\Mahasiswa\Resources\PengajuanJudulResource;

class ListPengajuanJuduls extends ListRecords
{
    protected static string $resource = PengajuanJudulResource::class;

    protected function getHeaderActions(): array
    {
        if(Auth::user()->pengajuanJudul->count() < 3) {
            return [
                Actions\CreateAction::make(),
            ];
        } else {
            return [];
        }
    }
}
