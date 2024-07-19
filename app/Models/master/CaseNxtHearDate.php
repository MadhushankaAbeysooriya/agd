<?php

namespace App\Models\master;

use App\Models\master\CourtCase;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CaseNxtHearDate extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'case_statuses';
    protected $fillable = [
        'court_case_id',
        'nxt_hear_date',
    ];

    public function courtcase(): BelongsTo
    {
        return $this->belongsTo(CourtCase::class, 'court_case_id');
    }
}
