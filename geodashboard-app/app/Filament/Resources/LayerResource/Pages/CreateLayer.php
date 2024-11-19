<?php

namespace App\Filament\Resources\LayerResource\Pages;

use App\Filament\Resources\LayerResource;
use App\Models\Layer;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateLayer extends CreateRecord
{
    protected static string $resource = LayerResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['g_meta'] = gettype($data['g_meta']) == "string" ?  json_decode($data['g_meta']) : $data['g_meta'];
        $data['g_layer_config'] = gettype($data['g_layer_config']) == "string" ? json_decode($data['g_layer_config']) : $data['g_layer_config'];
        return $data;
    }
}
