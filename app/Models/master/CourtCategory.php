<?php

namespace App\Models\master;

use App\Models\master\Court;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class CourtCategory extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'court_categories';
    protected $fillable = [
        'name',
    ];

    public function courts(): BelongsToMany
    {
        return $this->belongsToMany(Court::class, 'court_court_categories','court_category_id','court_id')->withTimestamps();
    }
}
