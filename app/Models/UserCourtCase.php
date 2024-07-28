<?php

namespace App\Models;

use App\Models\User;
use App\Models\CourtCase;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class UserCourtCase extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'user_court_cases';
    protected $fillable = [
        'court_case_id',
        'user_id',
    ];

    public function courtcase(): BelongsTo
    {
        return $this->belongsTo(CourtCase::class, 'court_case_id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
