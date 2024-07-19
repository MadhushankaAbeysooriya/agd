<?php

namespace App\Models\master;

use App\Models\master\Court;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CourtCase extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'court_cases';
    protected $fillable = [
        'case_no',
        'case_file_no',
        'title',
        'client_name',
        'started_date',
        'closed_date',
        'court_id',
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

    public function court(): BelongsTo
    {
        return $this->belongsTo(Court::class, 'court_id');
    }
}
