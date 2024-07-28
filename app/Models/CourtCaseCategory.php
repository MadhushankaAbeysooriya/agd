<?php

namespace App\Models;

use App\Models\CourtCase;
use App\Models\master\CaseCategory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CourtCaseCategory extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'court_case_categories';
    protected $fillable = [
        'court_case_id',
        'case_category_id',
    ];

    public function courtcase(): BelongsTo
    {
        return $this->belongsTo(CourtCase::class, 'court_case_id');
    }

    public function casecategory(): BelongsTo
    {
        return $this->belongsTo(CaseCategory::class, 'case_category_id');
    }
}
