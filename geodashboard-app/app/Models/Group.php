<?php

namespace App\Models;

use App\Traits\LogActionBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;

class Group extends Model
{
    use HasFactory, Notifiable, LogActionBy;
    protected $fillable = [
        'g_label',
        'g_slug',
        'status',
        'created_by',
        'updated_by'
    ];

    protected static function booted()
    {
        static::creating(function ($model) {
                $model->g_slug = (string) Str::slug($model->g_label);
        });
        static::updating(function ($model) {
            $model->g_slug = (string) Str::slug($model->g_label);
        });
    }
}
