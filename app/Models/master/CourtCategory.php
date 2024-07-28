<?php

namespace App\Models\master;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CourtCategory extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'court_categories';
    protected $fillable = [
        'name',
    ];
}
