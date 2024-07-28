<?php

namespace App\Models;

use App\Models\CourtCase;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CaseNxtHearDate extends Model
{
    use HasFactory;

    protected $table = 'case_nxt_hear_dates';
    protected $fillable = [
        'court_case_id',
        'nxt_hear_date',
    ];

    public function courtcase(): BelongsTo
    {
        return $this->belongsTo(CourtCase::class, 'court_case_id');
    }
}
