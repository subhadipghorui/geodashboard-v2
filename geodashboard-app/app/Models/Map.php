<?php

namespace App\Models;

use App\Traits\LogActionBy;
use Illuminate\Database\Eloquent\Casts\AsCollection;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;

class Map extends Model 
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
        'g_template',
        'g_meta',
        'g_layers',
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
            'g_layers' => 'array',
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
    // public function setGMetaAttribute($value){
    //     $this->attributes['g_meta'] =  gettype($value) == "string" ? collect(json_decode($value)) : $value;
    // }


    public function groups(){
        return Group::whereIn('id', $this->g_groups)->get();
    }
}
