<?php

namespace App;

enum MapTypeEnum: string
{
    case Mapbox = 'Mapbox';
    case Leaflet = 'Leaflet';
    case Openlayer = 'Openlayer';
    case Cesium = 'Cesium';

    public function getLabel(): ?string
    {
        return match ($this) {
            self::Mapbox => 'Mapbox',
            self::Leaflet => 'Leaflet',
            self::Openlayer => 'Openlayer',
            self::Cesium => 'Cesium',
            default => 'NA'
        };
    }

    public function getColor(): string | array | null
    {
        return match ($this) {
            self::Mapbox => 'info',
            self::Leaflet => 'warning',
            self::Openlayer => 'dark',
            self::Cesium => 'success',
            default => 'dark'
        };
    }
}
