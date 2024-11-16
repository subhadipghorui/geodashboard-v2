<?php

namespace App;

enum LayerTypeEnum: string
{
    case MVT = 'MVT';
    case Geojson = 'Geojson';
    case Tile = 'Tile';

    public function getLabel(): ?string
    {
        return match ($this) {
            self::MVT => 'MVT',
            self::Geojson => 'Geojson',
            self::Tile => 'Tile',
            default => 'NA'
        };
    }

    public function getColor(): string | array | null
    {
        return match ($this) {
            self::MVT => 'grey',
            self::Geojson => 'info',
            self::Tile => 'violet',
            default => 'dark'
        };
    }
}
