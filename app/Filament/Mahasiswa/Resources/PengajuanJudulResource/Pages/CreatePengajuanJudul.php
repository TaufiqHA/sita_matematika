<?php

namespace App\Filament\Mahasiswa\Resources\PengajuanJudulResource\Pages;

use App\Filament\Mahasiswa\Resources\PengajuanJudulResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreatePengajuanJudul extends CreateRecord
{
    protected static string $resource = PengajuanJudulResource::class;

    public function getTitle(): string 
    {
       return 'Pengajuan Judul';
    }

}
