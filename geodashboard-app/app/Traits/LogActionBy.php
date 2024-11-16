<?php
namespace App\Traits;

use App\Models\User;
use Illuminate\Http\Request;

trait LogActionBy {

    /**
     * @param Request $request
     * @return $this|false|string
     */
    protected static function bootLogActionBy()
    {
       
        static::creating(function ($model) {
            // Set the default role_id if it's not already set
                $model->created_by = auth()->id(); 
                $model->updated_by = auth()->id();
        });

        static::updating(function ($model) {
                $model->updated_by = auth()->id();
        });

        static::deleting(function ($model) {
                $model->updated_by = auth()->id();
        });
    }

    public function createdBy(){
        return $this->belongsTo(User::class, 'created_by', 'id');
    }
    public function updatedBy(){
        return $this->belongsTo(User::class, 'updated_by', 'id');
    }
}