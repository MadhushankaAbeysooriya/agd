<?php

namespace App\Models\master;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CaseCategory extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'case_categories';
    protected $fillable = [
        'name',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->created_by_user_id = auth()->id();
        });

        static::updating(function ($model) {
            $model->updated_by_user_id = auth()->id();
        });

        static::deleting(function ($model) {
            $model->deleted_by_user_id = auth()->id();
            $model->save();
        });
    }
}
