<?php

namespace App\Filament\Resources\MapResource\Pages;

use App\Filament\Resources\MapResource;
use App\Models\Layer;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateMap extends CreateRecord
{
    protected static string $resource = MapResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        // $data['g_layers'] = array_map(function($item){
        //     if(!empty($item['layers'])){
        //         $item['layers'] = array_map(function($layer){
        //             $res = [];
        //             $res = Layer::findOrFail($layer["id"])->toArray();
        //             $res["checked"] = $layer["checked"];
        //             $res["status"] = $layer["status"];
        //             return $res;
        //         }, $item['layers']);
        //     }
        //     return $item;
        // }, $data['g_layers']);

        $data['g_meta'] = json_decode($data['g_meta']);
        return $data;
    }
}
