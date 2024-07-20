<?php

namespace App\Models\master;

use App\Models\User;
use App\Models\master\Court;
use App\Models\master\CaseStatus;
use App\Models\master\CaseCategory;
use App\Models\master\CaseNxtHearDate;
use Illuminate\Database\Eloquent\Model;
use App\Models\master\CourtCaseCategory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

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

    /**
     * Get all of the comments for the CourtCase
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function casenxtneardates(): HasMany
    {
        return $this->hasMany(CaseNxtHearDate::class, 'court_case_id', 'id');
    }

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'user_court_cases','court_case_id','user_id')->withTimestamps();
    }

    public function casestatuses(): HasMany
    {
        return $this->hasMany(CaseStatus::class, 'court_case_id', 'id');
    }

    public function casecategories(): BelongsToMany
    {
        return $this->belongsToMany(CaseCategory::class, 'court_case_categories','court_case_id','case_category_id')->withTimestamps();
    }
}
