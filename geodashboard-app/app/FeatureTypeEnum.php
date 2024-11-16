<?php

namespace App;

enum FeatureTypeEnum: string
{
    case Point = 'Point';
    case Line = 'Line';
    case Polygon = 'Polygon';
    case Mixed = 'Mixed';

    public function getLabel(): ?string
    {
        return match ($this) {
            self::Point => 'Point',
            self::Line => 'Line',
            self::Polygon => 'Polygon',
            self::Mixed => 'Mixed',
            default => 'NA'
        };
    }

    public function getColor(): string | array | null
    {
        return match ($this) {
            self::Point => 'grey',
            self::Line => 'info',
            self::Polygon => 'violet',
            self::Mixed => 'success',
            default => 'dark'
        };
    }
}
