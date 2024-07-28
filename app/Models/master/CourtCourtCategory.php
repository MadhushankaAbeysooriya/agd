<?php

namespace App\Models\master;

use App\Models\master\Court;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CourtCourtCategory extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'court_court_categories';
    protected $fillable = [
        'court_id',
        'court_category_id',
    ];

    public function court(): BelongsTo
    {
        return $this->belongsTo(Court::class, 'court_id');
    }

    public function courtcategory(): BelongsTo
    {
        return $this->belongsTo(CourtCategory::class, 'court_category_id');
    }
}
