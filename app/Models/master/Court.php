<?php

namespace App\Models\master;

use App\Models\master\CourtCategory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Court extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'courts';
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

    public function courtcategories(): BelongsToMany
    {
        return $this->belongsToMany(CourtCategory::class, 'court_court_categories', 'court_id', 'court_category_id')->withTimestamps();
    }
}
