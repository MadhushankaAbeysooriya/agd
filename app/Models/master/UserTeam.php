<?php

namespace App\Models\master;

use App\Models\User;
use App\Models\master\Team;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class UserTeam extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'user_teams';
    protected $fillable = [
        'user_id',
        'team_id',
    ];



    /**
     * Get the user that owns the UserTeam
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function team(): BelongsTo
    {
        return $this->belongsTo(Team::class, 'user_id');
    }
}
