<?php

namespace App\Filament\Resources\LayerResource\Pages;

use App\Filament\Resources\LayerResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditLayer extends EditRecord
{
    protected static string $resource = LayerResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
