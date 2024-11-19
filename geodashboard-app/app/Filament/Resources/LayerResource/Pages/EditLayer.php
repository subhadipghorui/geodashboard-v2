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

    protected function mutateFormDataBeforeSave(array $data): array
    {
        $data['g_meta'] = gettype($data['g_meta']) == 'string' ? json_decode($data['g_meta']) : $data['g_meta'];
        $data['g_layer_config'] = gettype($data['g_layer_config']) == 'string' ? json_decode($data['g_layer_config']): $data['g_layer_config'];
        return $data;
    }
}
