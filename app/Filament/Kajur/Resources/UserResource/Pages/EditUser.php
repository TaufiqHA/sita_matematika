<?php

namespace App\Filament\Kajur\Resources\UserResource\Pages;

use App\Filament\Kajur\Resources\UserResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditUser extends EditRecord
{
    protected static string $resource = UserResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function getFormActions(): array
    {
        return [];
    }

    public function getTitle(): string
    {
        return 'Pengauan Judul';
    }

    public function getBreadcrumbs(): array
    {
        $breadcrumbs = [
            '/kajur/pengajuan-juduls' => 'Pengajuan Judul',
            '/kajur/pengajuan-juduls/edit' => 'Edit',
        ];
        
        return $breadcrumbs;
    }
}
