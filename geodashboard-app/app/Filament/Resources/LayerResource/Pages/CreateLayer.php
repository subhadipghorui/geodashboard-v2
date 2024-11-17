<?php

namespace App\Filament\Resources\LayerResource\Pages;

use App\Filament\Resources\LayerResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateLayer extends CreateRecord
{
    protected static string $resource = LayerResource::class;
    
    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['g_meta'] = json_decode($data['g_meta']);
        $data['g_layer_config'] = json_decode($data['g_layer_config']);
        return $data;
    }
}
