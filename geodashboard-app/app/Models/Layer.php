<?php

namespace App\Models;

use App\FeatureTypeEnum;
use App\LayerTypeEnum;
use App\Traits\LogActionBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;

class Layer extends Model 
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, LogActionBy;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'g_uuid',
        'g_label',
        'g_slug',
        'g_groups',
        'g_layer_type',
        'g_layer_url',
        'g_feature_type',
        'g_meta',
        'g_feature_label_visibility',
        'g_feature_label_value',
        'g_feature_hover_enabled',
        'g_feature_hover_value',
        'g_feature_click_enabled',
        'g_feature_click_value',
        'status',
        'created_by',
        'updated_by'
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'g_groups' => 'array',
            'g_meta' => 'collection',
            'g_layer_type' => LayerTypeEnum::class,
            'g_feature_type' => FeatureTypeEnum::class,
        ];
    }

    protected static function booted()
    {
        static::creating(function ($model) {
                $model->g_uuid = (string) Str::uuid();
                $model->g_slug = (string) Str::slug($model->g_label);
        });
        static::updating(function ($model) {
            $model->g_slug = (string) Str::slug($model->g_label);
        });
    }
}
